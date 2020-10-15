<?php
namespace ElatedCore\CPT\Shortcodes\QuoteSection;

use ElatedCore\Lib;

class QuoteSection implements Lib\ShortcodeInterface {
	private $base; 
	
	function __construct() {
		$this->base = 'eltdf_quote_section';

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
			'name' => esc_html__('Elated Quote Section', 'eltdf-core'),
			'base' => $this->base,
			'category' => esc_html__('by ELATED', 'eltdf-core'),
			'icon' => 'icon-wpb-quote-section extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params' =>	array(
                array(
                    'type'       => 'textfield',
                    'param_name' => 'quote_text',
                    'heading'    => esc_html__('Quote Text', 'eltdf-core'),
					'admin_label' => true
                ),
				array(
                    'type'       => 'textfield',
                    'param_name' => 'additional_text',
                    'heading'    => esc_html__('Additional Text', 'eltdf-core'),
					'admin_label' => true
                ),
			)
        ));
	}

	public function render($atts, $content = null) {
		$args = array(
			'quote_text' 		=> '',
			'additional_text' 	=> '',
        );
		$params = shortcode_atts($args, $atts);
	

		$html = eltdf_core_get_shortcode_module_template_part('templates/quote-section', 'quote-section', '', $params);
		
		return $html;
	}

}