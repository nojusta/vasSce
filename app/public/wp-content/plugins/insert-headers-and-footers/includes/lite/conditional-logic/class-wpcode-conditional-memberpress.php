<?php
/**
 * Class that handles conditional logic related to MemberPress.
 *
 * @package WPCode
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * The WPCode_Conditional_MemberPress class.
 */
class WPCode_Conditional_MemberPress_Lite extends WPCode_Conditional_Type {

	/**
	 * The type unique name (slug).
	 *
	 * @var string
	 */
	public $name = 'memberpress';

	/**
	 * The type category.
	 *
	 * @var string
	 */
	public $category = 'ecommerce';

	/**
	 * Set the translatable label.
	 *
	 * @return void
	 */
	protected function set_label() {
		$this->label = 'MemberPress (PRO)';
	}

	/**
	 * Set the type options for the admin mainly.
	 *
	 * @return void
	 */
	public function load_type_options() {
		$this->options = array(
			'memberpress_page' => array(
				'label'       => __( 'MemberPress Page', 'insert-headers-and-footers' ),
				'description' => __( 'Load the snippet on specific MemberPress pages.', 'insert-headers-and-footers' ),
				'type'        => 'select',
				'upgrade'     => array(
					'title' => __( 'MemberPress Page Rules is a Pro Feature', 'insert-headers-and-footers' ),
					'text'  => __( 'Get access to advanced conditional logic rules for MemberPress by upgrading to PRO today.', 'insert-headers-and-footers' ),
					'link'  => wpcode_utm_url( 'https://wpcode.com/lite/', 'edit-snippet', 'conditional-logic', 'memberpress-page' ),
				),
				'options'     => array(
					array(
						'label' => __( 'Registration Page', 'insert-headers-and-footers' ),
						'value' => 'registration',
					),
					array(
						'label' => __( 'Thank You Page', 'insert-headers-and-footers' ),
						'value' => 'thankyou',
					),
					array(
						'label' => __( 'Account Page', 'insert-headers-and-footers' ),
						'value' => 'account',
					),
					array(
						'label' => __( 'Login Page', 'insert-headers-and-footers' ),
						'value' => 'login',
					),
				),
			),
			'memberpress_user' => array(
				'label'       => __( 'User active membership', 'insert-headers-and-footers' ),
				'description' => __( 'Check if the current user has a specific MemberPress subscription active.', 'insert-headers-and-footers' ),
				'type'        => 'select',
				'options'     => array(),
				'upgrade'     => array(
					'title' => __( 'MemberPress Active Membership Rules is a Pro Feature', 'insert-headers-and-footers' ),
					'text'  => __( 'Get access to advanced conditional logic rules for MemberPress by upgrading to PRO today.', 'insert-headers-and-footers' ),
					'link'  => wpcode_utm_url( 'https://wpcode.com/lite/', 'edit-snippet', 'conditional-logic', 'memberpress-user' ),
				),
			),
		);
	}
}

new WPCode_Conditional_MemberPress_Lite();
