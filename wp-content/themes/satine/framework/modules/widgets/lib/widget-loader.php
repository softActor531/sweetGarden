<?php

if (!function_exists('satine_elated_register_widgets')) {
	function satine_elated_register_widgets() {
		$widgets = array(
			'SatineElatedBlogListWidget',
			'SatineElatedButtonWidget',
			'SatineElatedImageWidget',
			'SatineElatedImageSliderWidget',
			'SatineElatedRawHTMLWidget',
			'SatineElatedSearchOpener',
			'SatineElatedSeparatorWidget',
			'SatineElatedSideAreaOpener',
			'SatineElatedSocialIconWidget',
			'SatineElatedIconWidget',
		);

		if ( satine_elated_contact_form_7_installed() ) {
			$widgets[] = 'SatineElatedContactForm7Widget';
		}

		foreach ($widgets as $widget) {
			register_widget($widget);
		}
	}
	
	add_action('widgets_init', 'satine_elated_register_widgets');
}