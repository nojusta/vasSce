<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="error settings-error notice is-dismissible">
	<p>
		<?php
			// translators: 1 HTML Tag, 2 HTML Tag
			echo esc_html__( 'Words limit reached: You have reached the maximum number of translated words in your plan. Please upgrade your account to translate more words.', 'weglot' );
		?>
	</p>
</div>
