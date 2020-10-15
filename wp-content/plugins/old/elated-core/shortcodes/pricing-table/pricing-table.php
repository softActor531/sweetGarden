<?php
namespace ElatedCore\CPT\Shortcodes\PricingTable;

use ElatedCore\Lib;

class PricingTable implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltdf_pricing_table';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Elated Pricing Table', 'eltdf-core'),
			'base' => $this->base,
			'icon' => 'icon-wpb-pricing-table extended-custom-icon',
			'category' => esc_html__('by ELATED', 'eltdf-core'),
			'allowed_container_element' => 'vc_row',
			'as_child' => array('only' => 'eltdf_pricing_tables'),
			'params' => array(
				array(
					'type'       => 'colorpicker',
					'param_name' => 'content_background_color',
					'heading'    => esc_html__('Content Background Color', 'eltdf-core')
				),
                array(
                    'type'       => 'colorpicker',
                    'param_name' => 'border_color',
                    'heading'    => esc_html__('Border Color', 'eltdf-core')
                ),
				array(
					'type'        => 'textfield',
					'param_name'  => 'title',
					'heading'     => esc_html__('Title', 'eltdf-core'),
					'value'       => esc_html__('STARTER', 'eltdf-core'),
					'save_always' => true
				),
				array(
					'type'       => 'colorpicker',
					'param_name' => 'title_color',
					'heading'    => esc_html__('Title Color', 'eltdf-core'),
					'dependency' => array('element' => 'title', 'not_empty' => true)
				),
				array(
					'type'       => 'colorpicker',
					'param_name' => 'title_border_color',
					'heading'    => esc_html__('Title Bottom Border Color', 'eltdf-core'),
					'dependency' => array('element' => 'title', 'not_empty' => true)
				),
                array(
                    'type'       => 'textfield',
                    'param_name' => 'subtitle',
                    'heading'    => esc_html__('Subtitle', 'eltdf-core')
                ),
                array(
                    'type'       => 'colorpicker',
                    'param_name' => 'subtitle_color',
                    'heading'    => esc_html__('Subtitle Color', 'eltdf-core'),
                    'dependency' => array('element' => 'subtitle', 'not_empty' => true)
                ),
				array(
					'type'       => 'textfield',
					'param_name' => 'price',
					'heading'    => esc_html__('Price', 'eltdf-core')
				),
				array(
					'type'       => 'colorpicker',
					'param_name' => 'price_color',
					'heading'    => esc_html__('Price Color', 'eltdf-core'),
					'dependency' => array('element' => 'price', 'not_empty' => true)
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'currency',
					'heading'     => esc_html__('Currency', 'eltdf-core'),
					'description' => esc_html__('Default mark is $', 'eltdf-core')
				),
				array(
					'type'       => 'colorpicker',
					'param_name' => 'currency_color',
					'heading'    => esc_html__('Currency Color', 'eltdf-core'),
					'dependency' => array('element' => 'currency', 'not_empty' => true)
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'price_period',
					'heading'     => esc_html__('Price Period', 'eltdf-core'),
					'description' => esc_html__('Default label is monthly', 'eltdf-core')
				),
				array(
					'type'       => 'colorpicker',
					'param_name' => 'price_period_color',
					'heading'    => esc_html__('Price Period Color', 'eltdf-core'),
					'dependency' => array('element' => 'price_period', 'not_empty' => true)
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'button_text',
					'heading'     => esc_html__('Button Text', 'eltdf-core'),
					'value'       => esc_html__('PURCHASE', 'eltdf-core'),
					'save_always' => true
				),
				array(
					'type'       => 'textfield',
					'param_name' => 'link',
					'heading'    => esc_html__('Button Link', 'eltdf-core'),
					'dependency' => array('element' => 'button_text',  'not_empty' => true)
				),
				array(
					'type'       => 'textarea_html',
					'param_name' => 'content',
					'heading'    => esc_html__('Content', 'eltdf-core'),
					'value'      => '<li>content content content</li><li>content content content</li><li>content content content</li>'
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'content_background_color' => '',
            'border_color'    => '',
			'title'         		=> '',
			'title_color'           => '',
			'title_border_color'    => '',
            'subtitle'              => '',
            'subtitle_color'        => '',
			'price'         		=> '100',
			'price_color'           => '',
			'currency'      		=> '$',
			'currency_color'        => '',
			'price_period'  		=> 'monthly',
			'price_period_color'    => '',
			'button_text'   		=> '',
			'link'          		=> '',
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);

		$html = '';
		
		$params['content']= preg_replace('#^<\/p>|<p>$#', '', $content); // delete p tag before and after content
		$params['holder_styles'] = $this->getHolderStyles($params);
		$params['title_styles'] = $this->getTitleStyles($params);
        $params['subtitle_styles'] = $this->getSubTitleStyles($params);
		$params['price_styles'] = $this->getPriceStyles($params);
		$params['currency_styles'] = $this->getCurrencyStyles($params);
		$params['price_period_styles'] = $this->getPricePeriodStyles($params);

		$html .= eltdf_core_get_shortcode_module_template_part('templates/pricing-table-template', 'pricing-table', '', $params);
		
		return $html;
	}

	private function getHolderStyles($params) {
		$itemStyle = array();
		
		if (!empty($params['content_background_color'])) {
			$itemStyle[] = 'background-color: '.$params['content_background_color'];
		}

        if(!empty($params['border_color'])) {
            $itemStyle[] = 'border-color: '.$params['border_color'];
        }
		
		return implode(';', $itemStyle);
	}
	
	private function getTitleStyles($params) {
		$itemStyle = array();

		if (!empty($params['title_color'])) {
            $itemStyle[] = 'color: '.$params['title_color'];
        }
        
        if(!empty($params['title_border_color'])) {
	        $itemStyle[] = 'border-color: '.$params['title_border_color'];
        }

		return implode(';', $itemStyle);
	}

    private function getSubTitleStyles($params) {
        $itemStyle = array();

        if (!empty($params['subtitle_color'])) {
            $itemStyle[] = 'color: '.$params['subtitle_color'];
        }

        return implode(';', $itemStyle);
    }
	
	private function getPriceStyles($params) {
		$itemStyle = array();
		
		if (!empty($params['price_color'])) {
			$itemStyle[] = 'color: '.$params['price_color'];
		}
		
		return implode(';', $itemStyle);
	}
	
	private function getCurrencyStyles($params) {
		$itemStyle = array();
		
		if (!empty($params['currency_color'])) {
			$itemStyle[] = 'color: '.$params['currency_color'];
		}
		
		return implode(';', $itemStyle);
	}
	
	private function getPricePeriodStyles($params) {
		$itemStyle = array();
		
		if (!empty($params['price_period_color'])) {
			$itemStyle[] = 'color: '.$params['price_period_color'];
		}
		
		return implode(';', $itemStyle);
	}
}