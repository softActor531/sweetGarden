<!DOCTYPE html>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    
        $(".eltdf-position-center:first").removeClass("eltdf-position-center") .addClass("eltdf-position-right");
    });

</script>
<html <?php language_attributes(); ?>>
<head>
    <?php
    /**
     * satine_elated_header_meta hook
     *
     * @see satine_elated_header_meta() - hooked with 10
     * @see satine_elated_user_scalable_meta - hooked with 10
     */
    do_action('satine_elated_header_meta');

    wp_head(); ?>
</head>

<body <?php body_class();?> itemscope itemtype="http://schema.org/WebPage">
    <?php
    /**
     * satine_elated_after_body_tag hook
     *
     * @see satine_elated_get_side_area() - hooked with 10
     * @see satine_elated_smooth_page_transitions() - hooked with 10
     */
    do_action('satine_elated_after_body_tag'); ?>
    <div class="eltdf-wrapper">

        <div class="eltdf-wrapper-inner">
 
 
 <?php satine_elated_get_header(); ?>
<a href="<?php echo get_home_url();?>" class="my_imgae_text_un">
        <img src="<?php echo get_site_url();?>/wp-content/uploads/2020/01/Banner.jpg" height="200px" class="my_images_main_headre"/></a>
	        <?php
	        /**
	         * satine_elated_after_header_area hook
	         *
	         * @see satine_elated_back_to_top_button() - hooked with 10
	         * @see satine_elated_get_full_screen_menu() - hooked with 10
	         */
	        do_action('satine_elated_after_header_area'); ?>
	        
            <div class="eltdf-content" <?php satine_elated_content_elem_style_attr(); ?>>
                <div class="eltdf-content-inner">