<?php

if (!function_exists('satine_elated_search_opener_icon_size')) {
	function satine_elated_search_opener_icon_size() {
		$icon_size = satine_elated_options()->getOptionValue('header_search_icon_size');
		
		if (!empty($icon_size)) {
			echo satine_elated_dynamic_css('.eltdf-search-opener', array(
				'font-size' => satine_elated_filter_px($icon_size) . 'px'
			));
		}
	}

	add_action('satine_elated_style_dynamic', 'satine_elated_search_opener_icon_size');
}

if (!function_exists('satine_elated_search_opener_icon_colors')) {
	function satine_elated_search_opener_icon_colors() {
		$icon_color       = satine_elated_options()->getOptionValue('header_search_icon_color');
		$icon_hover_color = satine_elated_options()->getOptionValue('header_search_icon_hover_color');
		
		if (!empty($icon_color)) {
			echo satine_elated_dynamic_css('.eltdf-search-opener', array(
				'color' => $icon_color
			));
		}

		if (!empty($icon_hover_color)) {
			echo satine_elated_dynamic_css('.eltdf-search-opener:hover', array(
				'color' => $icon_hover_color
			));
		}
	}

	add_action('satine_elated_style_dynamic', 'satine_elated_search_opener_icon_colors');
}

if (!function_exists('satine_elated_search_opener_text_styles')) {
	function satine_elated_search_opener_text_styles() {
		$item_styles = satine_elated_get_typography_styles('search_icon_text');
		
		$item_selector = array(
			'.eltdf-search-icon-text'
		);
		
		echo satine_elated_dynamic_css($item_selector, $item_styles);
		
		$text_hover_color = satine_elated_options()->getOptionValue('search_icon_text_color_hover');
		
		if (!empty($text_hover_color)) {
			echo satine_elated_dynamic_css('.eltdf-search-opener:hover .eltdf-search-icon-text', array(
				'color' => $text_hover_color
			));
		}
	}

	add_action('satine_elated_style_dynamic', 'satine_elated_search_opener_text_styles');
}