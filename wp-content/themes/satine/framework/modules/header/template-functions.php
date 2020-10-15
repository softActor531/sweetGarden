<?php
use Satine\Modules\Header\Lib\HeaderFactory;

if (!function_exists('satine_elated_get_header')) {
    /**
     * Loads header HTML based on header type option. Sets all necessary parameters for header
     * and defines satine_elated_header_type_parameters filter
     */
    function satine_elated_get_header() {
        $id = satine_elated_get_page_id();

        //will be read from options
        $header_type = satine_elated_get_meta_field_intersect('header_type', $id);

        $menu_area_in_grid = satine_elated_get_meta_field_intersect('menu_area_in_grid', $id);

        $header_behavior = satine_elated_get_meta_field_intersect('header_behaviour', $id);

        if (HeaderFactory::getInstance()->validHeaderObject()) {
            $parameters = array(
                'hide_logo' => satine_elated_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
                'menu_area_in_grid' => $menu_area_in_grid == 'yes' ? true : false,
                'show_sticky' => in_array($header_behavior, array(
                    'sticky-header-on-scroll-up',
                    'sticky-header-on-scroll-down-up'
                )) ? true : false,
                'show_fixed_wrapper' => in_array($header_behavior, array('fixed-on-scroll')) ? true : false,
            );

            $parameters = apply_filters('satine_elated_header_type_parameters', $parameters, $header_type);

            HeaderFactory::getInstance()->getHeaderObject()->loadTemplate($parameters);
        }
    }
}

if (!function_exists('satine_elated_get_header_top')) {
    /**
     * Loads header top HTML and sets parameters for it
     */
    function satine_elated_get_header_top() {

        //generate column width class
        switch (satine_elated_options()->getOptionValue('top_bar_layout')) {
            case ('two-columns'):
                $column_widht_class = 'eltdf-' . satine_elated_options()->getOptionValue('top_bar_two_column_widths');
                break;
            case ('three-columns'):
                $column_widht_class = 'eltdf-' . satine_elated_options()->getOptionValue('top_bar_column_widths');
                break;
        }

        $params = array(
            'column_widths' => $column_widht_class,
            'show_widget_center' => satine_elated_options()->getOptionValue('top_bar_layout') == 'three-columns' ? true : false,
            'show_header_top' => satine_elated_is_top_bar_enabled(),
            'show_header_top_background_div' => satine_elated_get_meta_field_intersect('header_type') == 'header-box' ? true : false,
            'top_bar_in_grid' => satine_elated_get_meta_field_intersect('top_bar_in_grid') == 'yes' ? true : false,
        );

        $params = apply_filters('satine_elated_header_top_params', $params);

        satine_elated_get_module_template_part('templates/parts/header-top', 'header', '', $params);
    }
}

if (!function_exists('satine_elated_get_logo')) {
    /**
     * Loads logo HTML
     *
     * @param $slug
     */
    function satine_elated_get_logo($slug = '') {
        $id = satine_elated_get_page_id();

        if ($slug == 'sticky') {
            $logo_image = satine_elated_get_meta_field_intersect('logo_image_sticky', $id);
        } else {
            $logo_image = satine_elated_get_meta_field_intersect('logo_image', $id);
        }

        $logo_image_dark = satine_elated_get_meta_field_intersect('logo_image_dark', $id);
        $logo_image_light = satine_elated_get_meta_field_intersect('logo_image_light', $id);

        //get logo image dimensions and set style attribute for image link.
        $logo_dimensions = satine_elated_get_image_dimensions($logo_image);

        $logo_height = '';
        $logo_styles = '';
        if (is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
            $logo_height = $logo_dimensions['height'];
            $logo_styles = 'height: ' . intval($logo_height / 2) . 'px;'; //divided with 2 because of retina screens
        }

        $params = array(
            'logo_image' => $logo_image,
            'logo_image_dark' => $logo_image_dark,
            'logo_image_light' => $logo_image_light,
            'logo_styles' => $logo_styles
        );

        satine_elated_get_module_template_part('templates/parts/logo', 'header', $slug, $params);
    }
}

if (!function_exists('satine_elated_get_main_menu')) {
    /**
     * Loads main menu HTML
     *
     * @param string $additional_class addition class to pass to template
     */
    function satine_elated_get_main_menu($additional_class = 'eltdf-default-nav') {
        satine_elated_get_module_template_part('templates/parts/navigation', 'header', '', array('additional_class' => $additional_class));
    }
}

if (!function_exists('satine_elated_get_header_widget_logo_area')) {
    /**
     * Loads header widgets area HTML
     */
    function satine_elated_get_header_widget_logo_area() {
        $page_id = satine_elated_get_page_id();
        if (satine_elated_is_woocommerce_installed() && satine_elated_is_woocommerce_shop()) {
            //get shop page id from options table
            $shop_id = get_option('woocommerce_shop_page_id');

            if (!empty($shop_id)) {
                $page_id = $shop_id;
            } else {
                $page_id = '-1';
            }
        }

        if (get_post_meta($page_id, 'eltdf_disable_header_widget_logo_area_meta', 'true') !== 'yes') {
            if (is_active_sidebar('eltdf-header-widget-logo-area') && get_post_meta($page_id, 'eltdf_custom_logo_area_sidebar_meta', true) === '') {
                dynamic_sidebar('eltdf-header-widget-logo-area');
            } else if (get_post_meta($page_id, 'eltdf_custom_logo_area_sidebar_meta', true) !== '') {
                $sidebar = get_post_meta($page_id, 'eltdf_custom_logo_area_sidebar_meta', true);
                if (is_active_sidebar($sidebar)) {
                    dynamic_sidebar($sidebar);
                }
            }
        }
    }
}

if (!function_exists('satine_elated_get_header_widget_menu_area')) {
    /**
     * Loads header widgets area HTML
     */
    function satine_elated_get_header_widget_menu_area() {
        $page_id = satine_elated_get_page_id();
        if (satine_elated_is_woocommerce_installed() && satine_elated_is_woocommerce_shop()) {
            //get shop page id from options table
            $shop_id = get_option('woocommerce_shop_page_id');

            if (!empty($shop_id)) {
                $page_id = $shop_id;
            } else {
                $page_id = '-1';
            }
        }

        if (get_post_meta($page_id, 'eltdf_disable_header_widget_menu_area_meta', 'true') !== 'yes') {
            if (is_active_sidebar('eltdf-header-widget-menu-area') && get_post_meta($page_id, 'eltdf_custom_menu_area_sidebar_meta', true) === '') {
                dynamic_sidebar('eltdf-header-widget-menu-area');
            } else if (get_post_meta($page_id, 'eltdf_custom_menu_area_sidebar_meta', true) !== '') {
                $sidebar = get_post_meta($page_id, 'eltdf_custom_menu_area_sidebar_meta', true);
                if (is_active_sidebar($sidebar)) {
                    dynamic_sidebar($sidebar);
                }
            }
        }
    }
}

if (!function_exists('satine_elated_get_header_widget_menu_area_left')) {
    /**
     * Loads header widgets area HTML
     */
    function satine_elated_get_header_widget_menu_area_left() {
        $page_id = satine_elated_get_page_id();

        if (satine_elated_is_woocommerce_installed() && satine_elated_is_woocommerce_shop()) {
            //get shop page id from options table
            $shop_id = get_option('woocommerce_shop_page_id');

            if (!empty($shop_id)) {
                $page_id = $shop_id;
            } else {
                $page_id = '-1';
            }
        }

        if (get_post_meta($page_id, 'eltdf_disable_header_widget_menu_area_meta', 'true') !== 'yes') {
            if (is_active_sidebar('eltdf-header-widget-menu-area-left') && get_post_meta($page_id, 'eltdf_custom_menu_area_sidebar_meta', true) === '') {
                dynamic_sidebar('eltdf-header-widget-menu-area-left');
            } else if (get_post_meta($page_id, 'eltdf_custom_menu_area_left_sidebar_meta', true) !== '') {
                $sidebar = get_post_meta($page_id, 'eltdf_custom_menu_area_left_sidebar_meta', true);
                if (is_active_sidebar($sidebar)) {
                    dynamic_sidebar($sidebar);
                }
            }
        }
    }
}

if (!function_exists('satine_elated_get_divided_left_main_menu')) {
    /**
     * Loads main menu HTML
     *
     * @param string $additional_class addition class to pass to template
     */
    function satine_elated_get_divided_left_main_menu($additional_class = 'eltdf-default-nav') {
        satine_elated_get_module_template_part('templates/parts/divided-left-navigation', 'header', '', array('additional_class' => $additional_class));
    }
}

if (!function_exists('satine_elated_get_sticky_divided_left_main_menu')) {
    /**
     * Loads main menu HTML
     *
     * @param string $additional_class addition class to pass to template
     */
    function satine_elated_get_sticky_divided_left_main_menu($additional_class = 'eltdf-default-nav') {
        satine_elated_get_module_template_part('templates/parts/sticky-divided-left-navigation', 'header', '', array('additional_class' => $additional_class));
    }
}

if (!function_exists('satine_elated_get_divided_right_main_menu')) {
    /**
     * Loads main menu HTML
     *
     * @param string $additional_class addition class to pass to template
     */
    function satine_elated_get_divided_right_main_menu($additional_class = 'eltdf-default-nav') {
        satine_elated_get_module_template_part('templates/parts/divided-right-navigation', 'header', '', array('additional_class' => $additional_class));
    }
}

if (!function_exists('satine_elated_get_sticky_divided_right_main_menu')) {
    /**
     * Loads main menu HTML
     *
     * @param string $additional_class addition class to pass to template
     */
    function satine_elated_get_sticky_divided_right_main_menu($additional_class = 'eltdf-default-nav') {
        satine_elated_get_module_template_part('templates/parts/sticky-divided-right-navigation', 'header', '', array('additional_class' => $additional_class));
    }
}

if (!function_exists('satine_elated_get_vertical_main_menu')) {
    /**
     * Loads vertical menu HTML
     */
    function satine_elated_get_vertical_main_menu($slug = '') {
        satine_elated_get_module_template_part('templates/parts/vertical-navigation', 'header', $slug);
    }
}

if (!function_exists('satine_elated_vertical_haeder_holder_class')) {
    /**
     * return holder class
     */
    function satine_elated_vertical_haeder_holder_class() {
        $holder_class = '';
        $center_content = satine_elated_get_meta_field_intersect('vertical_header_center_content', satine_elated_get_page_id());
        if ($center_content == 'yes') {
            $holder_class .= 'eltdf-vertical-alignment-center';
        } else {
            $holder_class .= 'eltdf-vertical-alignment-top';
        }

        return $holder_class;
    }
}

if (!function_exists('satine_elated_get_header_vertical_widget_areas')) {
    /**
     * Loads header widgets area HTML
     */
    function satine_elated_get_header_vertical_widget_areas() {
        $page_id = satine_elated_get_page_id();
        if (satine_elated_is_woocommerce_installed() && satine_elated_is_woocommerce_shop()) {
            //get shop page id from options table
            $shop_id = get_option('woocommerce_shop_page_id');

            if (!empty($shop_id)) {
                $page_id = $shop_id;
            } else {
                $page_id = '-1';
            }
        }

        if (is_active_sidebar('eltdf-vertical-area') && get_post_meta($page_id, 'eltdf_custom_vertical_area_sidebar_meta', true) === '') {
            dynamic_sidebar('eltdf-vertical-area');
        } else if (get_post_meta($page_id, 'eltdf_custom_vertical_area_sidebar_meta', true) !== '') {
            $sidebar = get_post_meta($page_id, 'eltdf_custom_vertical_area_sidebar_meta', true);
            if (is_active_sidebar($sidebar)) {
                dynamic_sidebar($sidebar);
            }
        }
    }
}

if (!function_exists('satine_elated_get_header_vertical_widget_top_areas')) {
    /**
     * Loads header widgets area HTML
     */
    function satine_elated_get_header_vertical_widget_top_areas() {
        $page_id = satine_elated_get_page_id();
        if (satine_elated_is_woocommerce_installed() && satine_elated_is_woocommerce_shop()) {
            //get shop page id from options table
            $shop_id = get_option('woocommerce_shop_page_id');

            if (!empty($shop_id)) {
                $page_id = $shop_id;
            } else {
                $page_id = '-1';
            }
        }

        if (is_active_sidebar('eltdf-vertical-area-top') && get_post_meta($page_id, 'eltdf_custom_vertical_area_sidebar_meta', true) === '') {
            dynamic_sidebar('eltdf-vertical-area-top');
        } else if (get_post_meta($page_id, 'eltdf_custom_vertical_area_sidebar_meta', true) !== '') {
            $sidebar = get_post_meta($page_id, 'eltdf_custom_vertical_area_sidebar_meta', true);
            if (is_active_sidebar($sidebar)) {
                dynamic_sidebar($sidebar);
            }
        }
    }
}

if (!function_exists('satine_elated_get_sticky_menu')) {
    /**
     * Loads sticky menu HTML
     *
     * @param string $additional_class addition class to pass to template
     */
    function satine_elated_get_sticky_menu($additional_class = 'eltdf-default-nav') {
        satine_elated_get_module_template_part('templates/parts/sticky-navigation', 'header', '', array('additional_class' => $additional_class));
    }
}

if (!function_exists('satine_elated_get_sticky_header')) {
    /**
     * Loads sticky header behavior HTML
     */
    function satine_elated_get_sticky_header($slug = '') {

        $id  = satine_elated_get_page_id();

        $parameters = array(
            'hide_logo' => satine_elated_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
            'sticky_header_in_grid' => satine_elated_get_meta_field_intersect('sticky_header_in_grid') == 'yes' ? true : false,
            'menu_area_position' => 'right'
        );

        if(satine_elated_get_meta_field_intersect('header_type') == 'header-standard') {
            $parameters['menu_area_position'] = satine_elated_get_meta_field_intersect('menu_area_position_header_standard',$id);
        }

        satine_elated_get_module_template_part('templates/behaviors/sticky-header', 'header', $slug, $parameters);
    }
}

if (!function_exists('satine_elated_get_mobile_header')) {
    /**
     * Loads mobile header HTML only if responsiveness is enabled
     */
    function satine_elated_get_mobile_header() {
        if (satine_elated_is_responsive_on()) {

            $mobile_menu_title = satine_elated_options()->getOptionValue('mobile_menu_title');

            $has_navigation = false;
            if (has_nav_menu('main-navigation') || has_nav_menu('mobile-navigation')) {
                $has_navigation = true;
            }

            $parameters = array(
                'show_logo' => satine_elated_options()->getOptionValue('hide_logo') == 'yes' ? false : true,
                'show_navigation_opener' => $has_navigation,
                'mobile_menu_title' => $mobile_menu_title
            );

            satine_elated_get_module_template_part('templates/types/mobile-header', 'header', '', $parameters);
        }
    }
}

if (!function_exists('satine_elated_get_mobile_logo')) {
    /**
     * Loads mobile logo HTML. It checks if mobile logo image is set and uses that, else takes normal logo image
     *
     * @param string $slug
     */
    function satine_elated_get_mobile_logo($slug = '') {

        $slug = $slug !== '' ? $slug : satine_elated_options()->getOptionValue('header_type');

        //check if mobile logo has been set and use that, else use normal logo
        if (satine_elated_options()->getOptionValue('logo_image_mobile') !== '') {
            $logo_image = satine_elated_options()->getOptionValue('logo_image_mobile');
        } else {
            $logo_image = satine_elated_options()->getOptionValue('logo_image');
        }

        //get logo image dimensions and set style attribute for image link.
        $logo_dimensions = satine_elated_get_image_dimensions($logo_image);

        $logo_height = '';
        $logo_styles = '';
        if (is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
            $logo_height = $logo_dimensions['height'];
            $logo_styles = 'height: ' . intval($logo_height / 2) . 'px'; //divided with 2 because of retina screens
        }

        //set parameters for logo
        $parameters = array(
            'logo_image' => $logo_image,
            'logo_dimensions' => $logo_dimensions,
            'logo_height' => $logo_height,
            'logo_styles' => $logo_styles
        );

        satine_elated_get_module_template_part('templates/parts/mobile-logo', 'header', $slug, $parameters);
    }
}

if (!function_exists('satine_elated_get_mobile_nav')) {
    /**
     * Loads mobile navigation HTML
     */
    function satine_elated_get_mobile_nav() {

        satine_elated_get_module_template_part('templates/parts/mobile-navigation', 'header', '');
    }
}

if (!function_exists('satine_elated_header_area_style')) {
    /**
     * Function that return styles for header area
     */
    function satine_elated_header_area_style($style) {
        $id = satine_elated_get_page_id();
        $class_id = satine_elated_get_page_id();
        if (satine_elated_is_woocommerce_installed() && is_product()) {
            $class_id = get_the_ID();
        }

        $class_prefix = satine_elated_get_unique_page_class($class_id);

        $current_style = '';

        $menu_area_style = array();
        $menu_area_grid_style = array();
        $menu_area_enable_border = get_post_meta($id, 'eltdf_menu_area_border_meta', true) == 'yes';
        $menu_area_enable_grid_border = get_post_meta($id, 'eltdf_menu_area_in_grid_border_meta', true) == 'yes';
        $menu_area_enable_shadow = get_post_meta($id, 'eltdf_menu_area_shadow_meta', true) == 'yes';
        $menu_area_enable_grid_shadow = get_post_meta($id, 'eltdf_menu_area_in_grid_shadow_meta', true) == 'yes';
        $menu_area_height = get_post_meta($id, 'eltdf_menu_area_height_meta', true);

        $menu_area_selector = array($class_prefix . ' .eltdf-page-header .eltdf-menu-area');
        $menu_area_grid_selector = array($class_prefix . ' .eltdf-page-header .eltdf-menu-area .eltdf-grid .eltdf-vertical-align-containers');

        /* menu area style - start */

        $menu_area_background_color = get_post_meta($id, 'eltdf_menu_area_background_color_meta', true);
        $menu_area_background_transparency = get_post_meta($id, 'eltdf_menu_area_background_transparency_meta', true);

        if ($menu_area_background_transparency === '') {
            $menu_area_background_transparency = 1;
        }

        $menu_area_background_color_rgba = satine_elated_rgba_color($menu_area_background_color, $menu_area_background_transparency);

        if ($menu_area_background_color_rgba !== null) {
            $menu_area_style['background-color'] = $menu_area_background_color_rgba;
        }

        if ($menu_area_enable_shadow) {
            $menu_area_style['box-shadow'] = '0px 1px 3px rgba(0,0,0,0.15)';
        }

        if ($menu_area_enable_border) {
            $header_border_color = get_post_meta($id, 'eltdf_menu_area_border_color_meta', true);

            if ($header_border_color !== '') {
                $menu_area_style['border-bottom'] = '1px solid ' . $header_border_color;
            }
        }

        if ($menu_area_height) {
            $max_height = intval(satine_elated_filter_px($menu_area_height) * 0.9).'px';
            $current_style .= satine_elated_dynamic_css('.eltdf-page-header .eltdf-menu-area .eltdf-logo-wrapper a', array('max-height' => $max_height));
            $menu_area_style['height'] = satine_elated_filter_px($menu_area_height).'px !important';
        }

        /* menu area style - end */

        /* menu area in grid style - start */

        if ($menu_area_enable_grid_shadow) {
            $menu_area_grid_style['box-shadow'] = '0px 1px 3px rgba(0,0,0,0.15)';
        }

        if ($menu_area_enable_grid_border) {
            $header_grid_border_color = get_post_meta($id, 'eltdf_menu_area_in_grid_border_color_meta', true);

            if ($header_grid_border_color !== '') {
                $menu_area_grid_style['border-bottom'] = '1px solid ' . $header_grid_border_color;
            }
        }

        $menu_area_grid_background_color = get_post_meta($id, 'eltdf_menu_area_grid_background_color_meta', true);
        $menu_area_grid_background_transparency = get_post_meta($id, 'eltdf_menu_area_grid_background_transparency_meta', true);

        if ($menu_area_grid_background_transparency === '') {
            $menu_area_grid_background_transparency = 1;
        }

        $menu_area_grid_background_color_rgba = satine_elated_rgba_color($menu_area_grid_background_color, $menu_area_grid_background_transparency);

        if ($menu_area_grid_background_color_rgba !== null) {
            $menu_area_grid_style['background-color'] = $menu_area_grid_background_color_rgba;
        }

        /* menu area in grid style - end */

        $current_style .= satine_elated_dynamic_css($menu_area_selector, $menu_area_style);
        $current_style .= satine_elated_dynamic_css($menu_area_grid_selector, $menu_area_grid_style);


        $logo_area_style = array();
        $logo_area_grid_style = array();
        $logo_area_enable_border = get_post_meta($id, 'eltdf_logo_area_border_meta', true) == 'yes';
        $logo_area_enable_grid_border = get_post_meta($id, 'eltdf_logo_area_in_grid_border_meta', true) == 'yes';

        $logo_area_selector = array($class_prefix . ' .eltdf-page-header .eltdf-logo-area');
        $logo_area_grid_selector = array($class_prefix . ' .eltdf-page-header .eltdf-logo-area .eltdf-grid .eltdf-vertical-align-containers');

        /* logo area style - start */

        $logo_area_background_color = get_post_meta($id, 'eltdf_logo_area_background_color_meta', true);
        $logo_area_background_transparency = get_post_meta($id, 'eltdf_logo_area_background_transparency_meta', true);

        if ($logo_area_background_transparency === '') {
            $logo_area_background_transparency = 1;
        }

        $logo_area_background_color_rgba = satine_elated_rgba_color($logo_area_background_color, $logo_area_background_transparency);

        if ($logo_area_background_color_rgba !== null) {
            $logo_area_style['background-color'] = $logo_area_background_color_rgba;
        }

        if ($logo_area_enable_border) {
            $header_border_color = get_post_meta($id, 'eltdf_logo_area_border_color_meta', true);

            if ($header_border_color !== '') {
                $logo_area_style['border-bottom'] = '1px solid ' . $header_border_color;
            }
        }

        $logo_area_logo_padding = get_post_meta($id, 'eltdf_logo_wrapper_padding_header_centered_meta', true);
        if ($logo_area_logo_padding !== '') {
            $current_style .= satine_elated_dynamic_css($class_prefix . '.eltdf-header-centered .eltdf-logo-area .eltdf-logo-wrapper', array('padding' => $logo_area_logo_padding));
        }

        /* logo area style - end */

        /* logo area in grid style - start */

        if ($logo_area_enable_grid_border) {
            $header_grid_border_color = get_post_meta($id, 'eltdf_logo_area_in_grid_border_color_meta', true);

            if ($header_grid_border_color !== '') {
                $logo_area_grid_style['border-bottom'] = '1px solid ' . $header_grid_border_color;
            }
        }

        $logo_area_grid_background_color = get_post_meta($id, 'eltdf_logo_area_grid_background_color_meta', true);
        $logo_area_grid_background_transparency = get_post_meta($id, 'eltdf_logo_area_grid_background_transparency_meta', true);

        if ($logo_area_grid_background_transparency === '') {
            $logo_area_grid_background_transparency = 1;
        }

        $logo_area_grid_background_color_rgba = satine_elated_rgba_color($logo_area_grid_background_color, $logo_area_grid_background_transparency);

        if ($logo_area_grid_background_color_rgba !== null) {
            $logo_area_grid_style['background-color'] = $logo_area_grid_background_color_rgba;
        }

        /* logo area in grid style - end */

        /* vertical area style - start */
        $vertical_area_style = array();
        $vertical_area_selector = array($class_prefix . '.eltdf-header-vertical .eltdf-vertical-area-background');

        $vertical_header_background_color = get_post_meta($id, 'eltdf_vertical_header_background_color_meta', true);
        $disable_vertical_background_image = get_post_meta($id, 'eltdf_disable_vertical_header_background_image_meta', true);
        $vertical_background_image = get_post_meta($id, 'eltdf_vertical_header_background_image_meta', true);
        $vertical_shadow = get_post_meta($id, 'eltdf_vertical_header_shadow_meta', true);
        $vertical_border = get_post_meta($id, 'eltdf_vertical_header_border_meta', true);

        if ($vertical_header_background_color !== '') {
            $vertical_area_style['background-color'] = $vertical_header_background_color;
        }

        if ($disable_vertical_background_image == 'yes') {
            $vertical_area_style['background-image'] = 'none';
        } elseif ($vertical_background_image !== '') {
            $vertical_area_style['background-image'] = 'url(' . $vertical_background_image . ')';
        }

        if ($vertical_shadow == 'yes') {
            $vertical_area_style['box-shadow'] = '1px 0 3px rgba(0, 0, 0, 0.05)';
        }

        if ($vertical_border == 'yes') {
            $header_border_color = get_post_meta($id, 'eltdf_vertical_header_border_color_meta', true);

            if ($header_border_color !== '') {
                $vertical_area_style['border-right'] = '1px solid ' . $header_border_color;
            }
        }

        /* vertical area style - end */

        $current_style .= satine_elated_dynamic_css($logo_area_selector, $logo_area_style);
        $current_style .= satine_elated_dynamic_css($logo_area_grid_selector, $logo_area_grid_style);
        $current_style .= satine_elated_dynamic_css($vertical_area_selector, $vertical_area_style);


        $current_style = $current_style . $style;

        return $current_style;
    }

    add_filter('satine_elated_add_page_custom_style', 'satine_elated_header_area_style');
}