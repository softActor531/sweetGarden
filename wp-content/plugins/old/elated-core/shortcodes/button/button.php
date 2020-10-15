<?php
namespace ElatedCore\CPT\Shortcodes\Button;

use ElatedCore\Lib;

class Button implements Lib\ShortcodeInterface {
    private $base;
	
    public function __construct() {
        $this->base = 'eltdf_button';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base attribute
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     */
    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Elated Button', 'eltdf-core'),
            'base'                      => $this->base,
            'admin_enqueue_css' => array(satine_elated_get_skin_uri().'/assets/css/eltdf-vc-extend.css'),
            'category'                  => esc_html__('by ELATED', 'eltdf-core'),
            'icon'                      => 'icon-wpb-button extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array_merge(
                array(
                    array(
                        'type'        => 'textfield',
                        'param_name'  => 'custom_class',
                        'heading'     => esc_html__('Custom CSS Class', 'eltdf-core')
                    ),
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'type',
                        'heading'     => esc_html__('Type', 'eltdf-core'),
                        'value'       => array(
                            esc_html__('With Arrow', 'eltdf-core')   => 'with-arrow',
						    esc_html__('Solid', 'eltdf-core')   => 'solid',
						    esc_html__('Outline', 'eltdf-core') => 'outline',
						    esc_html__('Simple', 'eltdf-core')  => 'simple'
                        ),
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'size',
                        'heading'     => esc_html__('Size', 'eltdf-core'),
                        'value'       => array(
						    esc_html__('Default', 'eltdf-core') => '',
						    esc_html__('Small', 'eltdf-core')   => 'small',
						    esc_html__('Medium', 'eltdf-core')  => 'medium',
						    esc_html__('Large', 'eltdf-core')   => 'large',
						    esc_html__('Huge', 'eltdf-core')    => 'huge'
                        ),
                        'dependency'  => array('element' => 'type', 'value' => array('solid', 'outline', 'with-arrow'))
                    ),
                    array(
                        'type'        => 'textfield',
                        'param_name'  => 'text',
                        'heading'     => esc_html__('Text', 'eltdf-core'),
                        'value'       => esc_html__('Button Text', 'eltdf-core'),
                        'save_always' => true,
                        'admin_label' => true
                    ),
                    array(
                        'type'       => 'textfield',
                        'param_name' => 'link',
                        'heading'    => esc_html__('Link', 'eltdf-core')
                    ),
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'target',
                        'heading'    => esc_html__('Link Target', 'eltdf-core'),
                        'value'      => array_flip(satine_elated_get_link_target_array())
                    )
                ),
                satine_elated_icon_collections()->getVCParamsArray(array('element' => 'type', 'value' => array('outline', 'solid', 'simple')), '', true),
                array(
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'color',
                        'heading'    => esc_html__('Color', 'eltdf-core'),
                        'group'      => esc_html__('Design Options', 'eltdf-core')
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'hover_color',
                        'heading'    => esc_html__('Hover Color', 'eltdf-core'),
                        'group'      => esc_html__('Design Options', 'eltdf-core')
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'background_color',
                        'heading'    => esc_html__('Background Color', 'eltdf-core'),
                        'dependency' => array('element' => 'type', 'value' => array('solid','with-arrow')),
                        'group'      => esc_html__('Design Options', 'eltdf-core')
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'hover_background_color',
                        'heading'    => esc_html__('Hover Background Color', 'eltdf-core'),
                        'group'      => esc_html__('Design Options', 'eltdf-core')
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'border_color',
                        'heading'    => esc_html__('Border Color', 'eltdf-core'),
                        'group'      => esc_html__('Design Options', 'eltdf-core')
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'hover_border_color',
                        'heading'    => esc_html__('Hover Border Color', 'eltdf-core'),
                        'group'      => esc_html__('Design Options', 'eltdf-core')
                    ),
                    array(
                        'type'       => 'textfield',
                        'param_name' => 'font_size',
                        'heading'    => esc_html__('Font Size (px)', 'eltdf-core'),
                        'group'      => esc_html__('Design Options', 'eltdf-core')
                    ),
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'font_weight',
                        'heading'     => esc_html__('Font Weight', 'eltdf-core'),
                        'value'       => array_flip(satine_elated_get_font_weight_array(true)),
                        'save_always' => true,
                        'group'       => esc_html__('Design Options', 'eltdf-core')
                    ),
                    array(
                        'type'        => 'textfield',
                        'param_name'  => 'margin',
                        'heading'     => esc_html__('Margin', 'eltdf-core'),
                        'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'eltdf-core'),
                        'group'       => esc_html__('Design Options', 'eltdf-core')
                    )
                )
            )
        ));
    }

    /**
     * Renders HTML for button shortcode
     *
     * @param array $atts
     * @param null $content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $default_atts = array(
            'size'                   => '',
            'type'                   => 'with-arrow',
            'text'                   => '',
            'link'                   => '',
            'target'                 => '_self',
            'color'                  => '',
            'hover_color'            => '',
            'background_color'       => '',
            'hover_background_color' => '',
            'border_color'           => '',
            'hover_border_color'     => '',
            'font_size'              => '',
            'font_weight'            => '',
            'margin'                 => '',
            'custom_class'           => '',
            'html_type'              => 'anchor',
            'input_name'             => '',
            'custom_attrs'           => array()
        );

        $default_atts = array_merge($default_atts, satine_elated_icon_collections()->getShortcodeParams());
        $params       = shortcode_atts($default_atts, $atts);

        if($params['html_type'] !== 'input') {
            $iconPackName   = satine_elated_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
            $params['icon'] = $iconPackName ? $params[$iconPackName] : '';
        }

        $params['size'] = !empty($params['size']) ? $params['size'] : 'medium';
        $params['type'] = !empty($params['type']) ? $params['type'] : 'with-arrow';


        $params['link']   = !empty($params['link']) ? $params['link'] : '#';
        $params['target'] = !empty($params['target']) ? $params['target'] : $default_atts['target'];

        //prepare params for template
        $params['button_classes']      = $this->getButtonClasses($params);
        $params['button_custom_attrs'] = !empty($params['custom_attrs']) ? $params['custom_attrs'] : array();
        $params['button_styles']       = $this->getButtonStyles($params);
        $params['button_data']         = $this->getButtonDataAttr($params);

        return eltdf_core_get_shortcode_module_template_part('templates/'.$params['html_type'], 'button', '', $params);
    }

    /**
     * Returns array of button styles
     *
     * @param $params
     *
     * @return array
     */
    private function getButtonStyles($params) {
        $styles = array();

        if(!empty($params['color'])) {
            $styles[] = 'color: '.$params['color'];
        }

        if(!empty($params['background_color']) && $params['type'] !== 'outline') {
            $styles[] = 'background-color: '.$params['background_color'];
        }

        if(!empty($params['border_color'])) {
            $styles[] = 'border-color: '.$params['border_color'];
        }

        if(!empty($params['font_size'])) {
            $styles[] = 'font-size: '.satine_elated_filter_px($params['font_size']).'px';
        }

        if(!empty($params['font_weight']) && $params['font_weight'] !== '') {
            $styles[] = 'font-weight: '.$params['font_weight'];
        }

        if(!empty($params['margin'])) {
            $styles[] = 'margin: '.$params['margin'];
        }

        return $styles;
    }

    /**
     *
     * Returns array of button data attr
     *
     * @param $params
     *
     * @return array
     */
    private function getButtonDataAttr($params) {
        $data = array();

        if(!empty($params['hover_color'])) {
            $data['data-hover-color'] = $params['hover_color'];
        }

        if(!empty($params['hover_background_color'])) {
            $data['data-hover-bg-color'] = $params['hover_background_color'];
        }

        if(!empty($params['hover_border_color'])) {
            $data['data-hover-border-color'] = $params['hover_border_color'];
        }

        return $data;
    }

    /**
     * Returns array of HTML classes for button
     *
     * @param $params
     *
     * @return array
     */
    private function getButtonClasses($params) {
        $buttonClasses = array(
            'eltdf-btn',
            'eltdf-btn-'.$params['size'],
            'eltdf-btn-'.$params['type']
        );

        if(!empty($params['hover_background_color'])) {
            $buttonClasses[] = 'eltdf-btn-custom-hover-bg';
        }

        if(!empty($params['hover_border_color'])) {
            $buttonClasses[] = 'eltdf-btn-custom-border-hover';
        }

        if(!empty($params['hover_color'])) {
            $buttonClasses[] = 'eltdf-btn-custom-hover-color';
        }

        if(!empty($params['icon'])) {
            $buttonClasses[] = 'eltdf-btn-icon';
        }

        if(!empty($params['custom_class'])) {
            $buttonClasses[] = esc_attr($params['custom_class']);
        }

        return $buttonClasses;
    }
}