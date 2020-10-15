<?php
namespace ElatedCore\CPT\Shortcodes\AnimationHolder;

use ElatedCore\Lib;

class AnimationHolder implements Lib\ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'eltdf_animation_holder';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return	$this->base;
	}

	public function vcMap() {
		vc_map( array(
			'name' =>  esc_html__('Elated Animation Holder', 'eltdf-core'),
			'base' => $this->base,
			"as_parent" => array('except' => 'vc_row'),
			'content_element' => true,
			'category' => esc_html__('by ELATED', 'eltdf-core'),
			'icon' => 'icon-wpb-animation-holder extended-custom-icon',
			'show_settings_on_create' => true,
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type'       => 'dropdown',
					'param_name' => 'animation',
					'heading'    => esc_html__('Animation Type', 'eltdf-core'),
					'value'      => array(
						esc_html__('Element Grow In', 'eltdf-core') => 'eltdf-grow-in',
						esc_html__('Element Fade In Down', 'eltdf-core') => 'eltdf-fade-in-down',
						esc_html__('Element From Fade', 'eltdf-core') => 'eltdf-element-from-fade',
						esc_html__('Element From Left', 'eltdf-core') => 'eltdf-element-from-left',
						esc_html__('Element From Right', 'eltdf-core') => 'eltdf-element-from-right',
						esc_html__('Element From Top', 'eltdf-core') => 'eltdf-element-from-top',
						esc_html__('Element From Bottom', 'eltdf-core') => 'eltdf-element-from-bottom',
						esc_html__('Element Flip In', 'eltdf-core') => 'eltdf-flip-in',
						esc_html__('Element X Rotate', 'eltdf-core') => 'eltdf-x-rotate',
						esc_html__('Element Z Rotate', 'eltdf-core') => 'eltdf-z-rotate',
						esc_html__('Element Y Translate', 'eltdf-core') => 'eltdf-y-translate',
						esc_html__('Element Fade In X Rotate', 'eltdf-core') => 'eltdf-fade-in-left-x-rotate',
					)
				),
                array(
                    'type'       => 'textfield',
                    'param_name' => 'animation_delay',
                    'heading'    => esc_html__('Animation Delay (ms)', 'eltdf-core')
                )
			)
		) );
	}

	public function render($atts, $content = null) {
		$args = array(
			'animation'       => '',
			'animation_delay' => ''
        );

        extract(shortcode_atts($args, $atts));

        $html = '<div class="eltdf-animation-holder '. esc_attr($animation) .'" data-animation="'.esc_attr($animation).'" data-animation-delay="'.esc_attr($animation_delay).'"><div class="eltdf-animation-inner">'.do_shortcode($content).'</div></div>';

        return $html;
	}
}