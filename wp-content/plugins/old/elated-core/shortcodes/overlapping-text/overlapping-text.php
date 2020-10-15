<?php
namespace ElatedCore\CPT\Shortcodes\OverlappingText;

use ElatedCore\Lib;

class OverlappingText implements Lib\ShortcodeInterface {
	private $base; 
	
	function __construct() {
		$this->base = 'eltdf_overlapping_text';

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
			'name' => esc_html__('Elated Overlapping Text', 'eltdf-core'),
			'base' => $this->base,
			'category' => esc_html__('by ELATED', 'eltdf-core'),
			'icon' => 'icon-wpb-overlapping-text extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params' =>	array(
                array(
                    'type'       => 'textfield',
                    'param_name' => 'background_text',
                    'heading'    => esc_html__('Background Text', 'eltdf-core'),
					'admin_label' => true
                ),
                array(
                    'type'       => 'textfield',
                    'param_name' => 'background_text_mark',
                    'heading'    => esc_html__('Background Superscript Text', 'eltdf-core'),
					'admin_label' => true
                ),
				array(
                    'type'       => 'textfield',
                    'param_name' => 'foreground_text',
                    'heading'    => esc_html__('Foreground Text', 'eltdf-core'),
					'admin_label' => true
                ),
                array(
                        'type'       => 'colorpicker',
                        'param_name' => 'foreground_text_color',
                        'heading'    => esc_html__('Foreground Text Color', 'eltdf-core'),
                        'admin_label' => true
                ),
               	array(
					'type'       => 'dropdown',
					'param_name' => 'position',
					'heading'    => esc_html__('Horizontal Position', 'eltdf-core'),
					'value'      => array(
						esc_html__('Left', 'eltdf-core') => 'left',
                        esc_html__('Center', 'eltdf-core') => 'center',
						esc_html__('Right', 'eltdf-core') => 'right'
					),
					'save_always' => true
				),
			)
        ));
	}

	public function render($atts, $content = null) {
		$args = array(
			'background_text' 		=> '',
			'background_text_mark' 	=> '',
			'foreground_text' 		=> '',
			'foreground_text_color' => '',
			'position'				=> ''
        );
		$params = shortcode_atts($args, $atts);
	
		$params['holder_styles'] = $this->getHolderStyles($params);
		$params['holder_classes'] = $this->getHolderClasses($params);

		$html = eltdf_core_get_shortcode_module_template_part('templates/overlapping-text', 'overlapping-text', '', $params);
		
		return $html;
	}

	private function getHolderStyles($params) {
		$styles = array();
		
		if (!empty($params['position'])) {
			$styles[] = 'text-align: '.$params['position'];
		}

		if (!empty($params['foreground_text_color'])) {
			$styles[] = 'color: '.$params['foreground_text_color'];
		}
		
		return implode(';', $styles);
	}


    private function getHolderClasses($params) {
        $holderClasses = array(
            'eltdf-overlapping-text-holder',
        );

        if(!empty($params['position'])) {
            $holderClasses[] = 'eltdf-overlapping-text-holder-' . $params['position'];
        }

        return $holderClasses;
    }

}