<?php
namespace ElatedCore\CPT\Shortcodes\Parallax;

use ElatedCore\Lib;

class Parallax implements Lib\ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'eltdf_parallax';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map(
			array(
				'name' => esc_html__('Elated Parallax', 'eltdf-core'),
				'base' => $this->base,
				'category' => esc_html__('by ELATED', 'eltdf-core'),
				'icon' => 'icon-wpb-parallax extended-custom-icon',
				'as_parent' => array('except' => 'vc_row, vc_accordion'),
				'allowed_container_element' => 'vc_row',
				'content_element' => true,
				'js_view' => 'VcColumnView',
				'params' => array(
					array(
						'type'       => 'textfield',
						'param_name' => 'class_name',
						'heading'    => esc_html__('Custom CSS Class', 'eltdf-core')
					),
					array(
						'type'       => 'attach_image',
						'param_name' => 'background_image',
						'heading'    => esc_html__('Parallax Background Image', 'eltdf-core')
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'parallax_speed',
						'heading'     => esc_html__('Parallax Speed', 'eltdf-core'),
						'description' => esc_html__('Set your parallax speed. Default value is 1.', 'eltdf-core')
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'parallax_full_height',
						'heading'     => esc_html__('Enable Full Height Parallax', 'eltdf-core'),
						'value'       => array_flip(satine_elated_get_yes_no_select_array(false, false)),
						'description' => esc_html__('Please note that this option will be available only if the Row is set on Full Height value', 'eltdf-core')
					),
					array(
						'type'       => 'textfield',
						'param_name' => 'parallax_height',
						'heading'    => esc_html__('Parallax Section Height (px)', 'eltdf-core'),
						'dependency'  => array('element' => 'parallax_full_height', 'value' => array('no'))
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'parallax_content_alignment',
						'heading'     => esc_html__('Set Parallax Content Vertical Alignment In Middle', 'eltdf-core'),
						'value'       => array_flip(satine_elated_get_yes_no_select_array(false, true))
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'disable_parallax_on_touch',
						'heading'     => esc_html__('Disable Parallax For Touch Devices', 'eltdf-core'),
						'value'       => array_flip(satine_elated_get_yes_no_select_array(false, true))
					)
				)
			)
		);
	}

	public function render($atts, $content = null) {
		$args = array(
			'class_name'	             =>	'',
			'background_image'           => '',
			'parallax_speed'             => '1',
			'parallax_full_height'		 => '',
			'parallax_height'            => '400',
			'parallax_content_alignment' => 'yes',
			'disable_parallax_on_touch'  => 'yes'
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);
		
		$params['content'] = $content;
		
		$params['holder_class'] = $this->getHolderClass($params);
		$params['holder_data'] = $this->getHolderData($params);
		$params['holder_style'] = $this->getHolderStyles($params);
		
		$html = eltdf_core_get_shortcode_module_template_part('templates/parallax', 'parallax', '', $params);

		return $html;
	}
	
	/**
	 * Return parallax holder classes
	 *
	 * @param $params
	 * @return array
	 */
	private function getHolderClass($params) {
		$itemClass = array();

		if (!empty($params['class_name'])) {
			$itemClass[] = esc_attr($params['class_name']);
		}
		if ($params['parallax_content_alignment'] === 'yes') {
			$itemClass[] = 'eltdf-vertical-middle-align';
		}
		if ($params['disable_parallax_on_touch'] === 'yes') {
			$itemClass[] = 'eltdf-disabled-parallax-on-touch';
		}
		if ($params['parallax_full_height'] === 'yes') {
			$itemClass[] = 'eltdf-parallax-full-height';
		}

		return implode(' ', $itemClass);
	}
	
	/**
	 * Return parallax holder data attributes
	 *
	 * @param $params
	 * @return array
	 */
	private function getHolderData($params) {
		$itemData = array();
		
		$itemData['data-parallax-speed'] = (!empty($params['parallax_speed'])) ? $params['parallax_speed'] : '1';
		
		return $itemData;
	}

	/**
	 * Return parallax holder style
	 *
	 * @param $params
	 * @return array
	 */
	private function getHolderStyles($params) {
		$styles = array();
		
		if (!empty($params['background_image'])) {
			$id = $params['background_image'];
			$image_src = wp_get_attachment_image_src($id, 'full');
			
			$styles[] = 'background-image: url('.$image_src[0].')';
		}
		
		if(!empty($params['parallax_height'])) {
			$styles[] = 'min-height: '.satine_elated_filter_px($params['parallax_height']).'px';
			$styles[] = 'height: '.satine_elated_filter_px($params['parallax_height']).'px';
		}

		if(!empty($params['parallax_full_height'] === 'yes')) {
			$styles[] = 'height: 100vh';
		}

		
		return implode(';', $styles);
	}
}