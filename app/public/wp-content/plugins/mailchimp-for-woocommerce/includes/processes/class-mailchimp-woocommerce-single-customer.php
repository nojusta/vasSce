<?php

class MailChimp_Woocommerce_Single_Customer extends Mailchimp_Woocommerce_Job
{
    public $customer_data;
    public $id;

    public function __construct($customer_lookup)
    {
        $this->customer_data = $customer_lookup;
        $this->id = $this->customer_data->customer_id;
    }

    public function handle()
    {
        $this->process();
        return false;
    }

    /**
     * @return false
     * @throws MailChimp_WooCommerce_Error
     * @throws MailChimp_WooCommerce_RateLimitError
     */
    public function process()
    {
        if (!mailchimp_is_configured() || !($api = mailchimp_get_api())) {
            mailchimp_debug(get_called_class(), 'Mailchimp is not configured properly');
            return false;
        }

        $email = $this->customer_data->email;

        // make sure we don't need to skip this email
        if (!mailchimp_email_is_allowed($email)) {
            mailchimp_debug('email.filter', "$email is either blocked, or invalid");
            return false;
        }

        $store_id = mailchimp_get_store_id();
        $list_id = mailchimp_get_list_id();

        if (!$store_id || !$list_id) {
            mailchimp_debug(get_called_class(), 'StoreID or ListID are not configured');
            return false;
        }

        $wordpress_user_id = $this->customer_data->user_id;
        $user = get_user_by('email', $email);

        $customer = new MailChimp_WooCommerce_Customer();

        if ($user && is_null($wordpress_user_id)) {
            $data = array(
                'id' => $this->customer_data->user_id,
                'email_address' => $this->customer_data->email,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name
            );
        } else {
            $data = array(
                'id' => null,
                'email_address' => $this->customer_data->email,
                'first_name' => $this->customer_data->first_name ?? '',
                'last_name' => $this->customer_data->last_name ?? ''
            );
        }

        if ($user) {
            // get user language
            $language = get_user_meta($wordpress_user_id, 'locale', true);
            if (strpos($language, '_') !== false) {
                $languageArray = explode('_', $language);
                $language = $languageArray[0];
            }

            $restricted_roles = array('administrator');
            $allowed_roles = array();
            $allowed_roles = apply_filters('mailchimp_campaign_user_roles', $allowed_roles);
            if ((count($allowed_roles) && count(array_intersect($allowed_roles, $user->roles)) === 0) || (count(array_intersect($restricted_roles, $user->roles)) !== 0)) {
                mailchimp_log('customer_process', "Customer #{$email} skipped, user role is not in the list");
                return false;
            }
        } else {
            $language = get_locale();
        }

        $customer->fromArray($data);

        // Configure merge tags
        $fn = trim($data['first_name']);
        $ln = trim($data['last_name']);

        $merge_fields_system = array();

        if (!empty($fn)) $merge_fields_system['FNAME'] = $fn;
        if (!empty($ln)) $merge_fields_system['LNAME'] = $ln;

        // allow users to hook into the merge field submission
        $merge_fields = apply_filters('mailchimp_sync_user_mergetags', $merge_fields_system, $user);

        // for whatever reason if this isn't an array we need to skip it.
        if (!is_array($merge_fields)) {
            mailchimp_error("custom.merge_fields", "The filter for mailchimp_sync_user_mergetags needs to return an array, using the default setup instead.");
            $merge_fields = $merge_fields_system;
        }


        // see if this store has the auto subscribe setting enabled on initial sync
        $plugin_options = \Mailchimp_Woocommerce_DB_Helpers::get_option('mailchimp-woocommerce');
        $subscribe_setting = (string)$plugin_options['mailchimp_auto_subscribe'];
        $should_auto_subscribe = $subscribe_setting === '1';
        $only_sync_existing = $subscribe_setting === '2';
        $new_status = $subscribe_setting === '0' ? 'transactional' : 'subscribed';
        $status_meta = mailchimp_get_subscriber_status_options($new_status);

        try {
            $subscriber = $api->member(mailchimp_get_list_id(), $email);
            $current_status = $subscriber['status'];

            if ($only_sync_existing) {
                if ($current_status != 'archived' && isset($subscriber)) {
                    $status = !in_array($subscriber['status'], array('unsubscribed', 'transactional'));
                    $customer->setOptInStatus($status);

                    if ($subscriber['status'] === 'transactional') {
                        $new_status = '0';
                    } else if ($subscriber['status'] === 'subscribed') {
                        $new_status = '1';
                    } else {
                        $new_status = $subscriber['status'];
                    }
                    // if the wordpress user id is not empty, and the status is subscribed, we can update the
                    // subscribed status meta so it reflects the current status of Mailchimp during a sync.
                    if ($wordpress_user_id && $current_status) {
                        update_user_meta($wordpress_user_id, 'mailchimp_woocommerce_is_subscribed', $new_status);
                    }
                }

                return false;
            }


            if (isset($subscriber['status'])) {
                if ( in_array($subscriber['status'], ['subscribed', 'transactional', 'unsubscribed', 'archived', 'cleaned']) ) {
                    $subscriber['status'] = $subscribe_setting === '0' ? 'transactional' : 'subscribed';
                }

                // ok let's update this member
                $api->update($list_id, $email, $subscriber['status'], $merge_fields, null, $language);

                // update the member tags but fail silently just in case.
                $api->updateMemberTags(mailchimp_get_list_id(), $email, true);

                mailchimp_tell_system_about_user_submit($email, $status_meta);
                mailchimp_log('member.sync', "Updated Member {$email}", array(
                    'status' => $subscriber['status'],
                    'language' => $language,
                    'merge_fields' => $merge_fields,
                    'gdpr_fields' => [],
                ));

                return false;
            }

        } catch (MailChimp_WooCommerce_RateLimitError $e) {
            sleep(3);
            mailchimp_error('member.sync.error', mailchimp_error_trace($e, "RateLimited :: user #{$this->id}"));
            $this->retry();
        } catch (Exception $e) {
            $compliance_state = mailchimp_string_contains($e->getMessage(), 'compliance state');

            if ($compliance_state) {
                return $this->handleComplianceState($email, $merge_fields);
            }

            if ($e->getCode() == 404) {

                try {
                    $uses_doi = isset($status_meta['requires_double_optin']) && $status_meta['requires_double_optin'];
                    $status_if_new = $uses_doi && $should_auto_subscribe ? 'pending' : $status_meta['created'];

                    $api->subscribe($list_id, $email, $status_if_new, $merge_fields, null, $language);

                    // update the member tags but fail silently just in case.
                    $api->updateMemberTags(mailchimp_get_list_id(), $email, true);

                    mailchimp_tell_system_about_user_submit($email, $status_meta);

                    if ($status_meta['created']) {
                        mailchimp_log('member.sync', "Subscribed Member {$email}", array('status_if_new' => $status_if_new, 'has_doi' => $uses_doi, 'merge_fields' => $merge_fields));
                    } else {
                        mailchimp_log('member.sync', "{$email} is Pending Double OptIn", array('status_if_new' => $status_if_new, 'has_doi' => $uses_doi, 'status_meta' => $status_meta));
                    }
                } catch (Exception $e) {
                    mailchimp_log('member.sync', $e->getMessage());
                }
                return false;
            }
        }

        return false;
    }

    /**
     * @param $email
     * @param array $fields
     * @param array $interests
     * @throws \Throwable
     */
    protected function handleComplianceState($email, $fields = [], $interests = [])
    {
        mailchimp_log('subscriber_sync', "member {$email} is in compliance state, sending double opt in.");
        return mailchimp_get_api()->updateOrCreate(mailchimp_get_list_id(), $email, 'pending', $fields, $interests);
    }
}