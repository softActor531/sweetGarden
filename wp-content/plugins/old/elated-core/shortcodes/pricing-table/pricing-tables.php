<?php
namespace ElatedCore\CPT\Shortcodes\PricingTables;

use ElatedCore\Lib;

class PricingTables implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltdf_pricing_tables';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map(
			array(
				'name' => esc_html__('Elated Pricing Tables', 'eltdf-core'),
				'base' => $this->base,
				'as_parent' => array('only' => 'eltdf_pricing_table'),
				'content_element' => true,
				'category' => esc_html__('by ELATED', 'eltdf-core'),
				'icon' => 'icon-wpb-pricing-tables extended-custom-icon',
				'show_settings_on_create' => true,
				'js_view' => 'VcColumnView',
				'params' => array(
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Number of Columns', 'eltdf-core'),
						'param_name' => 'columns',
						'value' => array(
							esc_html__('One', 'eltdf-core') => 'eltdf-one-column',
							esc_html__('Two', 'eltdf-core') => 'eltdf-two-columns',
							esc_html__('Three', 'eltdf-core') => 'eltdf-three-columns',
							esc_html__('Four', 'eltdf-core') => 'eltdf-four-columns',
							esc_html__('Five', 'eltdf-core') => 'eltdf-five-columns',
						)
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'space_between_columns',
						'heading'    => esc_html__('Space Between Columns', 'eltdf-core'),
						'value'      => array(
							esc_html__('Normal', 'eltdf-core') => 'normal',
							esc_html__('Small', 'eltdf-core') => 'small',
							esc_html__('Tiny', 'eltdf-core') => 'tiny',
							esc_html__('No Space', 'eltdf-core') => 'no'
						)
					)
				)
			)
		);
	}

	public function render($atts, $content = null) {
		$args = array(
			'columns'         	    => 'eltdf-two-columns',
			'space_between_columns' => 'normal'
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);

		$holder_class = '';
		
		if (!empty($columns)) {
			$holder_class .= ' '.$columns;
		}

		if (!empty($space_between_columns)) {
			$holder_class .= ' eltdf-pt-'.$space_between_columns.'-space';
		}
		
		$html = '<div class="eltdf-pricing-tables clearfix '.esc_attr($holder_class).'">';
			$html .= '<div class="eltdf-pt-wrapper">';
				$html .= do_shortcode($content);
			$html .= '</div>';
		$html .= '</div>';

		return $html;
	}
}