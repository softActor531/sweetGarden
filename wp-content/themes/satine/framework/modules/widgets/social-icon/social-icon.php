<?php

class SatineElatedSocialIconWidget extends SatineElatedWidget {
    public function __construct() {
        parent::__construct(
            'eltdf_social_icon_widget',
            esc_html__('Elated Social Icon Widget', 'satine'),
            array( 'description' => esc_html__( 'Add social network icons to widget areas', 'satine'))
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array_merge(
            satine_elated_icon_collections()->getSocialIconWidgetParamsArray(),
            array(
                array(
                    'type'  => 'textfield',
                    'name'  => 'link',
                    'title' => esc_html__('Link', 'satine')
                ),
                array(
                    'type'    => 'dropdown',
                    'name'    => 'target',
                    'title'   => esc_html__('Target', 'satine'),
                    'options' => satine_elated_get_link_target_array()
                ),
                array(
                    'type'    => 'dropdown',
                    'name'    => 'type',
                    'title'   => esc_html__('Type', 'satine'),
                    'options' => array(
                        'eltdf-normal' => esc_html__('Normal', 'satine'),
                        'eltdf-circle'  => esc_html__('Circle', 'satine'),
                        'eltdf-square'   => esc_html__('Square', 'satine'),
                    )
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'icon_size',
                    'title' => esc_html__('Icon Size (px)', 'satine')
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'color',
                    'title' => esc_html__('Color', 'satine')
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'hover_color',
                    'title' => esc_html__('Hover Color', 'satine')
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'background_color',
                    'title' => esc_html__('Background Color', 'satine')
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'hover_background_color',
                    'title' => esc_html__('Hover Background Color', 'satine')
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'border_color',
                    'title' => esc_html__('Border Color', 'satine')
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'hover_border_color',
                    'title' => esc_html__('Hover Border Color', 'satine')
                ),
                array(
                    'type'        => 'textfield',
                    'name'        => 'margin',
                    'title'       => esc_html__('Margin', 'satine'),
                    'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'satine')
                ),
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
        $icon_styles = array();

        if (!empty($instance['color'])) {
            $icon_styles[] = 'color: '.$instance['color'].';';
        }

        if (!empty($instance['background_color']) && $instance['type'] != 'eltdf-normal') {
            $icon_styles[] = 'background-color: '.$instance['background_color'].';';
        }

        if (!empty($instance['border_color']) && $instance['type'] != 'eltdf-normal') {
            $icon_styles[] = 'border-color: '.$instance['border_color'].';';
        }

        if (!empty($instance['icon_size'])) {
            $icon_styles[] = 'font-size: '.satine_elated_filter_px($instance['icon_size']).'px';
        }

        if (!empty($instance['margin'])) {
            $icon_styles[] = 'margin: '.$instance['margin'].';';
        }

        $link = '#';
        if (!empty($instance['link'])) {
            $link = $instance['link'];
        }

        $target = '_self';
        if (!empty($instance['target'])) {
            $target = $instance['target'];
        }

        $hover_color = '';
        if (!empty($instance['hover_color'])) {
            $hover_color = $instance['hover_color'];
        }

        $hover_border_color = '';
        if (!empty($instance['hover_border_color']) && $instance['type'] != 'eltdf-normal') {
            $hover_border_color = $instance['hover_border_color'];
        }

        $hover_background_color = '';
        if (!empty($instance['hover_background_color']) && $instance['type'] != 'eltdf-normal') {
            $hover_background_color = $instance['hover_background_color'];
        }

        $icon_html = 'fa-facebook';
        $icon_holder_html = '';
        if (!empty($instance['icon_pack']) && $instance['icon_pack'] !== '') {
            if (!empty($instance['fa_icon']) && $instance['fa_icon'] !== '' && $instance['icon_pack'] === 'font_awesome') {
                $icon_html = $instance['fa_icon'];
                $icon_holder_html = '<i class="eltdf-social-icon-widget fa '.$icon_html.'"></i>';
            } else if (!empty($instance['fe_icon']) && $instance['fe_icon'] !== '' && $instance['icon_pack'] === 'font_elegant') {
                $icon_html = $instance['fe_icon'];
                $icon_holder_html = '<span class="eltdf-social-icon-widget '.$icon_html.'"></span>';
            } else if (!empty($instance['ion_icon']) && $instance['ion_icon'] !== '' && $instance['icon_pack'] === 'ion_icons') {
                $icon_html = $instance['ion_icon'];
                $icon_holder_html = '<span class="eltdf-social-icon-widget '.$icon_html.'"></span>';
            } else if (!empty($instance['simple_line_icons']) && $instance['simple_line_icons'] !== '' && $instance['icon_pack'] === 'simple_line_icons') {
                $icon_html = $instance['simple_line_icons'];
                $icon_holder_html = '<span class="eltdf-social-icon-widget '.$icon_html.'"></span>';
            } else {
                $icon_holder_html = '<i class="eltdf-social-icon-widget fa '.$icon_html.'"></i>';
            }
        }
        ?>

        <a class="eltdf-social-icon-widget-holder eltdf-icon-has-hover <?php echo $instance['type'];?>" <?php echo satine_elated_get_inline_attr($hover_color, 'data-hover-color'); ?> <?php echo satine_elated_get_inline_attr($hover_border_color, 'data-hover-border-color'); ?> <?php echo satine_elated_get_inline_attr($hover_background_color, 'data-hover-background-color'); ?><?php satine_elated_inline_style($icon_styles) ?> href="<?php echo esc_html($link); ?>" target="<?php echo esc_attr($target); ?>">
            <?php print $icon_holder_html; ?>
        </a>
    <?php
    }
}