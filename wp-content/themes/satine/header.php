<!DOCTYPE html>
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