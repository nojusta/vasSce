const init_admin_weglot_code_editor = function () {
	const $ = jQuery

	const execute = () => {
		jQuery(document).ready(function($) {
			const $overrideCss = $('#override_css'); // Cache the jQuery selector
			if ($overrideCss.length) {
				wp.codeEditor.initialize($overrideCss, cm_settings);
			}
		  })
	}

	document.addEventListener('DOMContentLoaded', () => {
		execute();
	})
}

export default init_admin_weglot_code_editor;
