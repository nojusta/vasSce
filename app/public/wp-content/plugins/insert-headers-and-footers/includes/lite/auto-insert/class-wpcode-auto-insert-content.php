<?php
/**
 * Class for auto-insert inside content.
 *
 * @package wpcode
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class WPCode_Auto_Insert_Single.
 */
class WPCode_Auto_Insert_Content_Lite extends WPCode_Auto_Insert_Type {

	/**
	 * The type unique name (slug).
	 *
	 * @var string
	 */
	public $name = 'content';

	/**
	 * The category of this type.
	 *
	 * @var string
	 */
	public $category = 'page';

	/**
	 * Not available to select.
	 *
	 * @var string
	 */
	public $code_type = 'pro';

	/**
	 * Text to display next to optgroup label.
	 *
	 * @var string
	 */
	public $label_pill = 'PRO';

	/**
	 * Load the available options and labels.
	 *
	 * @return void
	 */
	public function init() {
		$this->label         = __( 'Content', 'insert-headers-and-footers' );
		$this->locations     = array(
			'after_words'           => array(
				'label'       => esc_html__( 'Insert After # Words', 'insert-headers-and-footers' ),
				'description' => esc_html__( 'Insert snippet after a minimum number of words.', 'insert-headers-and-footers' ),
			),
			'every_words'           => array(
				'label'       => esc_html__( 'Insert Every # Words', 'insert-headers-and-footers' ),
				'description' => esc_html__( 'Insert snippet every # number of words.', 'insert-headers-and-footers' ),
			),
			'content_half'          => array(
				'label'       => esc_html__( 'Insert in the Middle of the Content', 'insert-headers-and-footers' ),
				'description' => esc_html__( 'Insert snippet in the middle of the post content.', 'insert-headers-and-footers' ),
			),
			'content_quarter'       => array(
				'label'       => esc_html__( 'Insert after first Quarter (25%)', 'insert-headers-and-footers' ),
				'description' => esc_html__( 'Insert snippet after the first quarter of the post content.', 'insert-headers-and-footers' ),
			),
			'content_quarter_third' => array(
				'label'       => esc_html__( 'Insert after 3rd Quarter (75%)', 'insert-headers-and-footers' ),
				'description' => esc_html__( 'Insert snippet after the third quarter of the post content.', 'insert-headers-and-footers' ),
			),
			'content_one_third'     => array(
				'label'       => esc_html__( 'Insert after first Third (33%)', 'insert-headers-and-footers' ),
				'description' => esc_html__( 'Insert snippet after the first third of the post content.', 'insert-headers-and-footers' ),
			),
			'content_two_thirds'    => array(
				'label'       => esc_html__( 'Insert after second Third (66%)', 'insert-headers-and-footers' ),
				'description' => esc_html__( 'Insert snippet after the second third of the post content.', 'insert-headers-and-footers' ),
			),
			'content_80'            => array(
				'label'       => esc_html__( 'Insert after 80%', 'insert-headers-and-footers' ),
				'description' => esc_html__( 'Insert snippet after 80% of the post content.', 'insert-headers-and-footers' ),
			),
		);
		$this->upgrade_title = __( 'Word-based content locations are a PRO feature', 'insert-headers-and-footers' );
		$this->upgrade_text  = __( 'Upgrade to PRO today and get access to automatic word-count based insert locations.', 'insert-headers-and-footers' );
		$this->upgrade_link  = wpcode_utm_url( 'https://wpcode.com/lite/', 'edit-snippet', 'auto-insert', 'content' );
	}

}

new WPCode_Auto_Insert_Content_Lite();
