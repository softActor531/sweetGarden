<?php

class SatineElatedSeparatorWidget extends SatineElatedWidget {
    public function __construct() {
        parent::__construct(
            'eltdf_separator_widget',
	        esc_html__('Elated Separator Widget', 'satine'),
	        array( 'description' => esc_html__( 'Add a separator element to your widget areas', 'satine'))
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'type' => 'dropdown',
                'name' => 'type',
                'title' => esc_html__('Type', 'satine'),
                'options' => array(
                    'normal' => esc_html__('Normal', 'satine'),
                    'full-width' => esc_html__('Full Width', 'satine')
                )
            ),
            array(
                'type' => 'dropdown',
                'name' => 'position',
                'title' => esc_html__('Position', 'satine'),
                'options' => array(
                    'center' => esc_html__('Center', 'satine'),
                    'left' => esc_html__('Left', 'satine'),
                    'right' => esc_html__('Right', 'satine')
                )
            ),
            array(
                'type' => 'dropdown',
                'name' => 'border_style',
                'title' => esc_html__('Style', 'satine'),
                'options' => array(
                    'solid' => esc_html__('Solid', 'satine'),
                    'dashed' => esc_html__('Dashed', 'satine'),
                    'dotted' => esc_html__('Dotted', 'satine')
                )
            ),
            array(
                'type' => 'textfield',
                'name' => 'color',
                'title' => esc_html__('Color', 'satine')
            ),
            array(
                'type' => 'textfield',
                'name' => 'width',
                'title' => esc_html__('Width', 'satine')
            ),
            array(
                'type' => 'textfield',
                'name' => 'thickness',
                'title' => esc_html__('Thickness (px)', 'satine')
            ),
            array(
                'type' => 'textfield',
                'name' => 'top_margin',
                'title' => esc_html__('Top Margin', 'satine')
            ),
            array(
                'type' => 'textfield',
                'name' => 'bottom_margin',
                'title' => esc_html__('Bottom Margin', 'satine')
            )
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {
        extract($args);

        //prepare variables
        $params = '';

        //is instance empty?
        if(is_array($instance) && count($instance)) {
            //generate shortcode params
            foreach($instance as $key => $value) {
                $params .= " $key='$value' ";
            }
        }

        echo '<div class="widget eltdf-separator-widget">';
            echo do_shortcode("[eltdf_separator $params]"); // XSS OK
        echo '</div>';
    }
}