<?php

class SatineElatedRawHTMLWidget extends SatineElatedWidget {
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'eltdf_raw_html_widget',
            esc_html__('Elated Raw HTML Widget', 'satine'),
            array( 'description' => esc_html__( 'Add raw HTML holder to widget areas', 'satine'))
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'type' => 'textfield',
                'name' => 'extra_class',
                'title' => esc_html__('Extra Class Name', 'satine')
            ),
            array(
                'type' => 'textfield',
                'name' => 'widget_title',
                'title' => esc_html__('Widget Title', 'satine')
            ),
            array(
                'type' => 'textarea',
                'name' => 'content',
                'title' => esc_html__('Content', 'satine')
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

        $extra_class = '';
        if (!empty($instance['extra_class']) && $instance['extra_class'] !== '') {
            $extra_class = $instance['extra_class'];
        }
        ?>

        <div class="widget eltdf-raw-html-widget <?php echo esc_html($extra_class); ?>">
            <?php
                if (!empty($instance['widget_title']) && $instance['widget_title'] !== '') {
                    print $args['before_title'].$instance['widget_title'].$args['after_title'];
                }
                if (!empty($instance['content'])) {
                    print $instance['content'];
                }
            ?>
        </div>
    <?php 
    }
}