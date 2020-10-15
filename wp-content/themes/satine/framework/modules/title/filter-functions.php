<?php

if(!function_exists('satine_elated_title_classes')) {
    /**
     * Function that adds classes to title div.
     * All other functions are tied to it with add_filter function
     * @param array $classes array of classes
     * @param string $module name of module calling title
     */
    function satine_elated_title_classes($classes = array()) {
        $classes = array();
        $classes = apply_filters('satine_elated_title_classes', $classes);

        if(is_array($classes) && count($classes)) {
            echo implode(' ', $classes);
        }
    }
}

if(!function_exists('satine_elated_title_type_class')) {
    /**
     * Function that adds class on title based on title type option
     * @param $classes original array of classes
     * @return array changed array of classes
     */
    function satine_elated_title_type_class($classes) {
		$id = satine_elated_get_page_id();

		if((satine_elated_is_product_category() || satine_elated_is_product_tag()) && satine_elated_get_woo_shop_page_id()) {
			$id = satine_elated_get_woo_shop_page_id();
		}

        $title_type = satine_elated_get_meta_field_intersect('title_area_type', $id);

	    if(!empty($title_type)) {
		    $classes[] = 'eltdf-'.$title_type.'-type';
	    }

        return $classes;
    }

    add_filter('satine_elated_title_classes', 'satine_elated_title_type_class');
}

if(!function_exists('satine_elated_title_grid_class')) {
    /**
     * Function that adds class on title based on title grid option
     * @param $classes original array of classes
     * @return array changed array of classes
     */
    function satine_elated_title_grid_class($classes) {
		$id = satine_elated_get_page_id();

		if((satine_elated_is_product_category() || satine_elated_is_product_tag()) && satine_elated_get_woo_shop_page_id()) {
			$id = satine_elated_get_woo_shop_page_id();
		}

        $title_in_grid = array();
        $title_in_grid = (satine_elated_get_meta_field_intersect('title_in_grid') === 'yes') ? true : false;

	    if($title_in_grid == false) {
		    $classes[] = 'eltdf-title-full-width';
	    } 

        return $classes;
    }

    add_filter('satine_elated_title_classes', 'satine_elated_title_grid_class');
}

if(!function_exists('satine_elated_title_content_alignment_class')) {
	/**
	 * Function that adds class on title based on title content alignmnt option
	 * Could be left, centered or right
	 * @param $classes original array of classes
	 * @return array changed array of classes
	 */
	function satine_elated_title_content_alignment_class($classes) {
		$id = satine_elated_get_page_id();

		if((satine_elated_is_product_category() || satine_elated_is_product_tag()) && satine_elated_get_woo_shop_page_id()) {
			$id = satine_elated_get_woo_shop_page_id();
		}

		$title_content_alignment = satine_elated_get_meta_field_intersect('title_area_content_alignment', $id);
		
		if(!empty($title_content_alignment)) {
			$classes[] = 'eltdf-content-'.$title_content_alignment.'-alignment';
		}
		
		return $classes;
	}
	
	add_filter('satine_elated_title_classes', 'satine_elated_title_content_alignment_class');
}

if(!function_exists('satine_elated_title_background_image_classes')) {
    function satine_elated_title_background_image_classes($classes) {
        //init variables
        $id                      = satine_elated_get_page_id();
		if((satine_elated_is_product_category() || satine_elated_is_product_tag()) && satine_elated_get_woo_shop_page_id()) {
			$id = satine_elated_get_woo_shop_page_id();
		}
		$title_img				 = apply_filters('satine_elated_title_image_exists', satine_elated_get_meta_field_intersect('title_area_background_image', $id));
	    $is_img_responsive 		 = satine_elated_get_meta_field_intersect('title_area_background_image_responsive', $id);
	    $is_image_parallax		 = satine_elated_get_meta_field_intersect('title_area_background_image_parallax', $id);
	    $is_image_parallax_array = array('yes', 'yes_zoom');
		$hide_title_img			 = get_post_meta($id, "eltdf_hide_background_image_meta", true) == 'yes' ? true : false;

        //is title image set and visible?
		// Removed check for is title image set because of blog single module title (featured image used as title image). Added css for container auto heihgt.
		if($title_img != '' && !$hide_title_img) {
            //is image not responsive and parallax title is set?
            $classes[] = 'eltdf-preload-background';
            $classes[] = 'eltdf-has-background';

            if($is_img_responsive == 'no' && in_array($is_image_parallax, $is_image_parallax_array)) {
                $classes[] = 'eltdf-has-parallax-background';

                if($is_image_parallax == 'yes_zoom') {
                    $classes[] = 'eltdf-zoom-out';
                }
            }

            //is image not responsive
            elseif($is_img_responsive == 'yes'){
                $classes[] = 'eltdf-has-responsive-background';
            }
        }

        return $classes;
    }

    add_filter('satine_elated_title_classes', 'satine_elated_title_background_image_classes');
}

if(!function_exists('satine_elated_title_background_image_div_classes')) {
	function satine_elated_title_background_image_div_classes($classes) {
		//init variables
		$id                 = satine_elated_get_page_id();
		if((satine_elated_is_product_category() || satine_elated_is_product_tag()) && satine_elated_get_woo_shop_page_id()) {
			$id = satine_elated_get_woo_shop_page_id();
		}
		$title_img			= apply_filters('satine_elated_title_image_exists', satine_elated_get_meta_field_intersect('title_area_background_image', $id));
		$is_img_responsive 	= satine_elated_get_meta_field_intersect('title_area_background_image_responsive', $id);
		$hide_title_img			 = get_post_meta($id, "eltdf_hide_background_image_meta", true) == 'yes' ? true : false;
		
		//is title image set, visible and responsive?
		// Removed check for is title image set because of blog single module title (featured image used as title image). Added css for container auto heihgt.
		if($title_img != '' && !$hide_title_img) {
			
			//is image responsive?
			if($is_img_responsive == 'yes') {
				$classes[] = 'eltdf-title-image-responsive';
			}
			//is image not responsive?
			elseif($is_img_responsive == 'no') {
				$classes[] = 'eltdf-title-image-not-responsive';
			}
		}
		
		return $classes;
	}
	
	add_filter('satine_elated_title_classes', 'satine_elated_title_background_image_div_classes');
}