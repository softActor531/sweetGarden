<?php
namespace ElatedCore\CPT\Shortcodes\VideoButton;

use ElatedCore\Lib;

class VideoButton implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'eltdf_video_button';

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
        vc_map(array(
            'name'                      => esc_html__('Elated Video Button', 'eltdf-core'),
            'base'                      => $this->getBase(),
            'category'                  => esc_html__('by ELATED', 'eltdf-core'),
            'icon'                      => 'icon-wpb-video-button extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
	            array(
		            'type'       => 'textfield',
		            'param_name' => 'video_link',
		            'heading'    => esc_html__('Video Link', 'eltdf-core')
	            ),
	            array(
		            'type'		  => 'attach_image',
		            'param_name'  => 'video_image',
		            'heading'	  => esc_html__('Video Image', 'eltdf-core'),
		            'description' => esc_html__('Select image from media library', 'eltdf-core')
	            ),
	            array(
		            'type'       => 'colorpicker',
		            'param_name' => 'play_button_color',
		            'heading'    => esc_html__('Play Button Color', 'eltdf-core')
	            ),
	            array(
		            'type'       => 'textfield',
		            'param_name' => 'play_button_size',
		            'heading'    => esc_html__('Play Button Size (px)', 'eltdf-core')
	            ),
	            array(
		            'type'		  => 'attach_image',
		            'param_name'  => 'play_button_image',
		            'heading'	  => esc_html__('Play Button Custom Image', 'eltdf-core'),
		            'description' => esc_html__('Select image from media library. If you use this field then play button color and button size options will not work', 'eltdf-core')
	            ),
	            array(
		            'type'		  => 'attach_image',
		            'param_name'  => 'play_button_hover_image',
		            'heading'	  => esc_html__('Play Button Custom Hover Image', 'eltdf-core'),
		            'description' => esc_html__('Select image from media library. If you use this field then play button color and button size options will not work', 'eltdf-core')
	            )
            )
        ));
    }
	
	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 *
	 * @return string
	 */
	public function render($atts, $content = null) {
		$args = array(
			'video_link'              => '#',
			'video_image'             => '',
			'play_button_color'       => '',
			'play_button_size'        => '',
			'play_button_image'       => '',
			'play_button_hover_image' => ''
		);
		
		$params = shortcode_atts($args, $atts);
		
		$params['play_button_styles'] = $this->getPlayButtonStyles($params);
		
		//Get HTML from template
		$html = eltdf_core_get_shortcode_module_template_part('templates/video-button', 'video-button', '', $params);
		
		return $html;
	}
	
	private function getPlayButtonStyles($params) {
		$styles = array();
		
		if (!empty($params['play_button_color'])) {
			$styles[] = 'color: '.$params['play_button_color'];
		}
		
		if (!empty($params['play_button_size'])) {
			$styles[] = 'font-size: '.satine_elated_filter_px($params['play_button_size']) .'px';
		}
		
		return implode(';', $styles);
	}
}