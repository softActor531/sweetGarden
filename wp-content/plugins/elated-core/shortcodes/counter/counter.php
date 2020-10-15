<?php
namespace ElatedCore\CPT\Shortcodes\Counter;

use ElatedCore\Lib;

class Counter implements Lib\ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'eltdf_counter';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Elated Counter', 'eltdf-core'),
			'base' => $this->getBase(),
			'category' => esc_html__('by ELATED', 'eltdf-core'),
			'icon' => 'icon-wpb-counter extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params' => array(
				array(
					'type'       => 'dropdown',
					'param_name' => 'type',
					'heading'    => esc_html__('Type', 'eltdf-core'),
					'value'      => array(
						esc_html__('Zero Counter', 'eltdf-core') => 'eltdf-zero-counter',
						esc_html__('Random Counter', 'eltdf-core') => 'eltdf-random-counter'
					)
				),
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'boxed',
                    'heading'    => esc_html__('In a box', 'eltdf-core'),
                    'value'       => array_flip(satine_elated_get_yes_no_select_array(false))
                ),
                array(
                    'type'       => 'colorpicker',
                    'param_name' => 'boxed_border_color',
                    'heading'    => esc_html__('Border color', 'eltdf-core'),
                    'dependency' => array('element' => 'boxed', 'value' => 'yes')
                ),
				array(
					'type'       => 'textfield',
					'param_name' => 'digit',
					'heading'    => esc_html__('Digit', 'eltdf-core')
				),
				array(
					'type'       => 'textfield',
					'param_name' => 'digit_font_size',
					'heading'    => esc_html__('Digit Font Size (px)', 'eltdf-core'),
					'dependency' => array('element' => 'digit', 'not_empty' => true)
				),
                array(
					'type'       => 'colorpicker',
					'param_name' => 'digit_color',
					'heading'    => esc_html__('Digit Color', 'eltdf-core'),
					'dependency' => array('element' => 'digit', 'not_empty' => true)
                ),
				array(
					'type'       => 'textfield',
					'param_name' => 'title',
					'heading'    => esc_html__('Title', 'eltdf-core')
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
					'type'        => 'dropdown',
					'param_name'  => 'title_font_weight',
					'heading'     => esc_html__('Title Font Weight', 'eltdf-core'),
					'value'       => array_flip(satine_elated_get_font_weight_array(true)),
					'save_always' => true,
					'dependency'  => array('element' => 'title', 'not_empty' => true)
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
                )
			)
		) );
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {
		$args = array(
			'type'              => 'eltdf-zero-counter',
            'boxed'             => 'no',
            'boxed_border_color' => '',
			'digit'             => '123',
			'digit_font_size'   => '',
			'digit_color'       => '',
			'title'             => '',
			'title_tag'         => 'h6',
			'title_color'       => '',
			'title_font_weight' => '',
			'text'              => '',
			'text_color'        => ''
		);

		$params = shortcode_atts($args, $atts);

		$params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : $args['title_tag'];

        $params['holder_class'] = $this->getHolderClass($params);
        $params['counter_boxed_styles'] = $this->getCounterBoxedStyles($params);
		$params['counter_styles'] = $this->getCounterStyles($params);
		$params['counter_title_styles'] = $this->getCounterTitleStyles($params);
		$params['counter_text_styles'] = $this->getCounterTextStyles($params);

		//Get HTML from template
		$html = eltdf_core_get_shortcode_module_template_part('templates/counter', 'counter', '', $params);

		return $html;
	}


    /**
     * Return Counter boxed bored styles
     *
     * @param $params
     * @return string
     */
    private function getCounterBoxedStyles($params) {
        $styles = array();

        if ($params['boxed'] === 'yes') {
            $styles[] = 'border: 1px solid '.$params['boxed_border_color'];
        }

        return implode(';', $styles);
    }

    /**
     * Return counter holder classes
     *
     * @param $params
     * @return array
     */
    private function getHolderClass($params) {
        $itemClass = array();

        if ($params['boxed'] === 'yes') {
            $itemClass[] = 'eltdf-counter-boxed';
        }

        return implode(' ', $itemClass);
    }

	/**
	 * Return Counter styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getCounterStyles($params) {
		$styles = array();

		if (!empty($params['digit_font_size'])) {
			$styles[] = 'font-size: '.satine_elated_filter_px($params['digit_font_size']).'px';
		}

        if (!empty($params['digit_color'])) {
	        $styles[] = 'color: '.$params['digit_color'];
        }

		return implode(';', $styles);
	}

    private function getCounterTitleStyles($params) {
	    $styles = array();

        if (!empty($params['title_color'])) {
	        $styles[] = 'color: '.$params['title_color'];
        }
	
	    if (!empty($params['title_font_weight'])) {
		    $styles[] = 'font-weight: '.$params['title_font_weight'];
	    }

        return implode(';', $styles);
    }

    private function getCounterTextStyles($params) {
	    $styles = array();

        if (!empty($params['text_color'])) {
	        $styles[] = 'color: '.$params['text_color'];
        }

        return implode(';', $styles);
    }
}