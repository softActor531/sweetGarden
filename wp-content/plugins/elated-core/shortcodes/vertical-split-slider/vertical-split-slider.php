<?php
namespace ElatedCore\CPT\Shortcodes\VerticalSplitSlider;

use ElatedCore\Lib;

class VerticalSplitSlider implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltdf_vertical_split_slider';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Elated Vertical Split Slider', 'eltdf-core'),
			'base' => $this->base,
			'icon' => 'icon-wpb-vertical-split-slider extended-custom-icon',
			'category' => esc_html__('by ELATED', 'eltdf-core'),
			'as_parent'	=> array('only' => 'eltdf_vertical_split_slider_left_panel, eltdf_vertical_split_slider_right_panel'),
			'show_settings_on_create' => true,
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type'       => 'dropdown',
					'param_name' => 'custom_sidebar',
					'heading'    => esc_html__('Custom Sidebar', 'eltdf-core'),
					'description'=> esc_html__('Choose custom sidebar to be displayed over Vertical Split slider', 'eltdf-core'),
					'value'      => satine_elated_get_custom_sidebars(true)
				),
				array(
					'type' => 'dropdown',
					'param_name' => 'frame_slider',
					'heading'    => esc_html__('Enable Frame Slider', 'eltdf-core'),
					'value'       => array_flip(satine_elated_get_yes_no_select_array(false, true))
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'custom_sidebar'	=> '',
			'frame_slider' => 'yes',
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);

		$params['content'] = $content;
		$params['vertical_split_classes'] = $this->getVerticalSplitClasses($params);


//		$html .= '<div class="eltdf-vertical-split-slider">';
//		if($custom_sidebar !== ''){
//			$html .= '<div class="eltdf-vertical-split-slider-widget-area">';
//			$html .= dynamic_sidebar($custom_sidebar);
//			$html .= '</div>';
//		}
//		$html .= do_shortcode($content);
//		$html .= '</div>';



		$html = eltdf_core_get_shortcode_module_template_part('templates/vertical-split-slider-template', 'vertical-split-slider', '', $params);

		return $html;
	}

	/**
     * Returns array of holder classes
     *
     * @param $params
     *
     * @return array
     */
    private function getVerticalSplitClasses($params) {

        $classes = array('eltdf-vertical-split-slider');

	    if($params['frame_slider'] !== 'no') {
		    $classes[] = 'eltdf-frame-slider';
	    }

        return $classes;
    }
}
