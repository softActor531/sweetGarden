<?php
namespace ElatedCore\CPT\Shortcodes\ProcessItem;

use ElatedCore\Lib;

class ProcessItem implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'eltdf_process_item';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                    => esc_html__('Process Item', 'eltdf-core'),
            'base'                    => $this->base,
            'as_child'                => array('only' => 'eltdf_process_holder'),
            'as_parent'               => array('except' => 'vc_row'),
            'content_element'         => true,
            'category'                => esc_html__('by ELATED', 'eltdf-core'),
            'icon'                    => 'icon-wpb-process-item extended-custom-icon',
            'show_settings_on_create' => true,
            'params'                  => array(
                array(
                    'type'       => 'attach_image',
                    'heading'    => esc_html__('Image', 'eltdf-core'),
                    'param_name' => 'process_image'
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Title', 'eltdf-core'),
                    'param_name'  => 'title',
                    'save_always' => true,
                    'admin_label' => true
                ),
                array(
                    'type'        => 'textarea',
                    'heading'     => esc_html__('Text', 'eltdf-core'),
                    'param_name'  => 'text',
                    'save_always' => true,
                    'admin_label' => true
                )
            )
        ));
    }

    public function render($atts, $content = null) {
        $default_atts = array(
            'process_image'         => '',
            'hover_gradient_style'  => '',
            'title'                 => '',
            'text'                  => '',
        );

        $params = shortcode_atts($default_atts, $atts);

        $params['image_style'] = $this->getBackgroundStyle($params);
        $params['item_classes'] = $this->getItemClasses($params);

        return eltdf_core_get_shortcode_module_template_part('templates/process-item-template', 'process', '', $params);
    }

    /**
     * Return Process background style
     *
     * @param $params
     *
     * @return false|string
     */

    private function getBackgroundStyle($params){
        $image_style = array();

        if ($params['process_image']){
            $image_style[] = wp_get_attachment_url($params['process_image']);
        }

        return implode('; ', $image_style);
    }

    /**
     * Return Process holder classes
     *
     * @param $params
     *
     * @return false|string
     */

    private function getItemClasses($params){
        $item_classes = array(
            'eltdf-process-item-holder'
        );

        if($params['process_image']) {
            $item_classes[] = 'eltdf-process-background-image';
        }

        if($params['hover_gradient_style'] === 'yes') {
            $item_classes[] = 'eltdf-process-gradient-hover';
        }

        return implode(' ', $item_classes);
    }

}