<?php
namespace ElatedCore\CPT\Shortcodes\SectionTitle;

use ElatedCore\Lib;

class SectionTitle implements Lib\ShortcodeInterface {
	private $base; 
	
	function __construct() {
		$this->base = 'eltdf_section_title';

		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	/**
	* Returns base for shortcode
	* @return string
	 */
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Elated Section Title', 'eltdf-core'),
			'base' => $this->base,
			'category' => esc_html__('by ELATED', 'eltdf-core'),
			'icon' => 'icon-wpb-section-title extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params' =>	array(
				array(
					'type'       => 'dropdown',
					'param_name' => 'position',
					'heading'    => esc_html__('Horizontal Position', 'eltdf-core'),
					'value'      => array(
                        esc_html__('Center', 'eltdf-core') => 'center',
						esc_html__('Left', 'eltdf-core') => 'left',
						esc_html__('Right', 'eltdf-core') => 'right'
					),
					'save_always' => true
				),
				array(
					'type'       => 'textfield',
					'param_name' => 'holder_padding',
					'heading'    => esc_html__('Holder Side Padding (px or %)', 'eltdf-core')
				),
                array(
                    'type'       => 'textfield',
                    'param_name' => 'title',
                    'heading'    => esc_html__('Title', 'eltdf-core'),
					'admin_label' => true
                ),
				array(
					'type'        => 'dropdown',
					'param_name'  => 'title_tag',
					'heading'     => esc_html__('Title Tag', 'eltdf-core'),
					'value'       => array_flip(satine_elated_get_title_tag(true)),
					'save_always' => true,
					'dependency'  => array('element' => 'title', 'not_empty' => true)
				),
				array(
					'type'       => 'colorpicker',
					'param_name' => 'title_color',
					'heading'    => esc_html__('Title Color', 'eltdf-core'),
					'dependency' => array('element' => 'title', 'not_empty' => true)
				),
				array(
                    'type'       => 'textfield',
                    'param_name' => 'subtitle',
                    'heading'    => esc_html__('Subtitle', 'eltdf-core'),
					'admin_label' => true
                ),
				array(
					'type'        => 'dropdown',
					'param_name'  => 'subtitle_tag',
					'heading'     => esc_html__('Subtitle Tag', 'eltdf-core'),
					'value'       => array_flip(satine_elated_get_title_tag(true)),
					'save_always' => true,
					'dependency'  => array('element' => 'subtitle', 'not_empty' => true)
				),
				array(
					'type'       => 'colorpicker',
					'param_name' => 'subtitle_color',
					'heading'    => esc_html__('Subtitle Color', 'eltdf-core'),
					'dependency' => array('element' => 'subtitle', 'not_empty' => true)
				),
				array(
					'type'       => 'textfield',
					'param_name' => 'subtitle_margin',
					'heading'    => esc_html__('Subtitle Bottom Margin (px)', 'eltdf-core'),
					'dependency' => array('element' => 'subtitle', 'not_empty' => true)
				),
				array(
					'type'       => 'textarea',
					'param_name' => 'text',
					'heading'    => esc_html__('Text', 'eltdf-core')
				),
				array(
					'type'       => 'colorpicker',
					'param_name' => 'text_color',
					'heading'    => esc_html__('Text Color', 'eltdf-core'),
					'dependency' => array('element' => 'text', 'not_empty' => true)
				),
				array(
					'type'       => 'textfield',
					'param_name' => 'text_font_size',
					'heading'    => esc_html__('Text Font Size (px)', 'eltdf-core'),
					'dependency' => array('element' => 'text', 'not_empty' => true)
				),
				array(
					'type'       => 'textfield',
					'param_name' => 'text_line_height',
					'heading'    => esc_html__('Text Line Height (px)', 'eltdf-core'),
					'dependency' => array('element' => 'text', 'not_empty' => true)
				),
				array(
					'type'        => 'dropdown',
					'param_name'  => 'text_font_weight',
					'heading'     => esc_html__('Text Font Weight', 'eltdf-core'),
					'value'       => array_flip(satine_elated_get_font_weight_array(true)),
					'save_always' => true
				),
				array(
					'type'       => 'textfield',
					'param_name' => 'text_margin',
					'heading'    => esc_html__('Text Top Margin (px)', 'eltdf-core'),
					'dependency' => array('element' => 'text', 'not_empty' => true)
				),
            )
		) );
	}

	public function render($atts, $content = null) {
		$args = array(
			'position'         => 'center',
			'holder_padding'   => '',
			'title'            => '',
			'title_tag'        => 'h2',
			'title_color'      => '',
			'subtitle'		   => '',
			'subtitle_tag'	   => 'h6',
			'subtitle_color'   => '',
			'subtitle_margin'  => '',
			'text'             => '',
			'text_color'       => '',
			'text_font_size'   => '',
			'text_line_height' => '',
			'text_font_weight' => '',
			'text_margin'      => ''
        );
		$params = shortcode_atts($args, $atts);
		
		$params['holder_styles'] = $this->getHolderStyles($params);
		$params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : $args['title_tag'];
		$params['subtitle_tag'] = !empty($params['subtitle_tag']) ? $params['subtitle_tag'] : $args['subtitle_tag'];
		$params['title_styles'] = $this->getTitleStyles($params);
		$params['subtitle_styles'] = $this->getSubtitleStyles($params);
		$params['subtitle_holder_styles'] = $this->getSubtitleHolderStyles($params);
		$params['text_styles'] = $this->getTextStyles($params);

		$html = eltdf_core_get_shortcode_module_template_part('templates/section-title', 'section-title', '', $params);
		
		return $html;
	}
	
	private function getHolderStyles($params) {
		$styles = array();
		
		if (!empty($params['holder_padding'])) {
			$styles[] = 'padding: 0 '.$params['holder_padding'];
		}
		
		if (!empty($params['position'])) {
			$styles[] = 'text-align: '.$params['position'];
		}
		
		return implode(';', $styles);
	}
	
	private function getTitleStyles($params) {
		$styles = array();
		
		if (!empty($params['title_color'])) {
			$styles[] = 'color: '.$params['title_color'];
		}
		
		return implode(';', $styles);
	}

	private function getSubtitleStyles($params) {
		$styles = array();
		
		if (!empty($params['subtitle_color'])) {
			$styles[] = 'color: '.$params['subtitle_color'];
		}
		
		return implode(';', $styles);
	}
	
	private function getSubtitleHolderStyles($params) {
		$styles = array();
		
		if (!empty($params['subtitle_margine'])) {
			$styles[] = 'margin-bottom: '.$params['subtitle_margine'];
		}
		
		return implode(';', $styles);
	}

	private function getTextStyles($params) {
		$styles = array();
		
		if (!empty($params['text_color'])) {
			$styles[] = 'color: '.$params['text_color'];
		}
		
		if (!empty($params['text_font_size'])) {
			$styles[] = 'font-size: '.satine_elated_filter_px($params['text_font_size']).'px';
		}
		
		if (!empty($params['text_line_height'])) {
			$styles[] = 'line-height: '.satine_elated_filter_px($params['text_line_height']).'px';
		}
		
		if (!empty($params['text_font_weight'])) {
			$styles[] = 'font-weight: '.$params['text_font_weight'];
		}
		
		if (!empty($params['text_margin'])) {
			$styles[] = 'margin-top: '.satine_elated_filter_px($params['text_margin']).'px';
		}
		
		return implode(';', $styles);
	}
}