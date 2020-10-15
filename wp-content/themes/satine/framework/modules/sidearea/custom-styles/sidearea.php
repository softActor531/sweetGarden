<?php

if (!function_exists('satine_elated_side_area_slide_from_right_type_style')) {

	function satine_elated_side_area_slide_from_right_type_style()	{
		$width = satine_elated_options()->getOptionValue('side_area_width');
		
		if ($width !== '') {
			echo satine_elated_dynamic_css('.eltdf-side-menu-slide-from-right .eltdf-side-menu', array(
				'right' => '-'.satine_elated_filter_px($width) . 'px',
				'width' => satine_elated_filter_px($width) . 'px'
			));
		}
	}

	add_action('satine_elated_style_dynamic', 'satine_elated_side_area_slide_from_right_type_style');
}

if (!function_exists('satine_elated_side_area_icon_color_styles')) {

	function satine_elated_side_area_icon_color_styles() {
		$icon_color             = satine_elated_options()->getOptionValue('side_area_icon_color');
		$icon_hover_color       = satine_elated_options()->getOptionValue('side_area_icon_hover_color');
		$close_icon_color       = satine_elated_options()->getOptionValue('side_area_close_icon_color');
		$close_icon_hover_color = satine_elated_options()->getOptionValue('side_area_close_icon_hover_color');
		
		$icon_hover_selector    = array(
			'.eltdf-side-menu-button-opener:hover',
			'.eltdf-side-menu-button-opener.opened'
		);
		
		if (!empty($icon_color)) {
			echo satine_elated_dynamic_css('.eltdf-side-menu-button-opener', array(
				'color' => $icon_color
			));
		}

		if (!empty($icon_hover_color)) {
			echo satine_elated_dynamic_css($icon_hover_selector, array(
				'color' => $icon_hover_color . '!important'
			));
		}

		if (!empty($close_icon_color)) {
			echo satine_elated_dynamic_css('.eltdf-side-menu a.eltdf-close-side-menu', array(
				'color' => $close_icon_color
			));
		}

		if (!empty($close_icon_hover_color)) {
			echo satine_elated_dynamic_css('.eltdf-side-menu a.eltdf-close-side-menu:hover', array(
				'color' => $close_icon_hover_color
			));
		}
	}

	add_action('satine_elated_style_dynamic', 'satine_elated_side_area_icon_color_styles');
}

if (!function_exists('satine_elated_side_area_styles')) {
	function satine_elated_side_area_styles() {
		
		$side_area_styles = array();
		$background_color = satine_elated_options()->getOptionValue('side_area_background_color');
		$padding          = satine_elated_options()->getOptionValue('side_area_padding');
		$text_alignment   = satine_elated_options()->getOptionValue('side_area_aligment');

		if (!empty($background_color)) {
			$side_area_styles['background-color'] = $background_color;
		}

		if (!empty($padding)) {
			$side_area_styles['padding'] = esc_attr($padding);
		}
		
		if (!empty($text_alignment)) {
			$side_area_styles['text-align'] = $text_alignment;
		}

		if (!empty($side_area_styles)) {
			echo satine_elated_dynamic_css('.eltdf-side-menu', $side_area_styles);
		}
		
		if($text_alignment === 'center') {
			echo satine_elated_dynamic_css('.eltdf-side-menu .widget img', array(
				'margin' => '0 auto'
			));
		}
	}

	add_action('satine_elated_style_dynamic', 'satine_elated_side_area_styles');
}