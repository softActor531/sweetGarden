<?php

if (!function_exists('eltdf_core_map_portfolio_meta')) {
    function eltdf_core_map_portfolio_meta() {
        global $satine_Framework;

        $eltdf_pages = array();
        $pages = get_pages();
        foreach ($pages as $page) {
            $eltdf_pages[$page->ID] = $page->post_title;
        }

        //Portfolio Images

        $eltdfPortfolioImages = new SatineElatedMetaBox('portfolio-item', esc_html__('Portfolio Images (multiple upload)', 'eltdf-core'), '', '', 'portfolio_images');
        $satine_Framework->eltdfMetaBoxes->addMetaBox('portfolio_images', $eltdfPortfolioImages);

        $eltdf_portfolio_image_gallery = new SatineElatedMultipleImages('eltdf-portfolio-image-gallery', esc_html__('Portfolio Images', 'eltdf-core'), esc_html__('Choose your portfolio images', 'eltdf-core'));
        $eltdfPortfolioImages->addChild('eltdf-portfolio-image-gallery', $eltdf_portfolio_image_gallery);

        //Portfolio Images/Videos 2

        $eltdfPortfolioImagesVideos2 = new SatineElatedMetaBox('portfolio-item', esc_html__('Portfolio Images/Videos (single upload)', 'eltdf-core'));
        $satine_Framework->eltdfMetaBoxes->addMetaBox('portfolio_images_videos2', $eltdfPortfolioImagesVideos2);

        $eltdf_portfolio_images_videos2 = new SatineElatedImagesVideosFramework('', '');
        $eltdfPortfolioImagesVideos2->addChild('eltdf_portfolio_images_videos2', $eltdf_portfolio_images_videos2);

        //Portfolio Additional Sidebar Items

        $eltdfAdditionalSidebarItems = satine_elated_add_meta_box(
            array(
                'scope' => array('portfolio-item'),
                'title' => esc_html__('Additional Portfolio Sidebar Items', 'eltdf-core'),
                'name' => 'portfolio_properties'
            )
        );

        $eltdf_portfolio_properties = satine_elated_add_options_framework(
            array(
                'label' => esc_html__('Portfolio Properties', 'eltdf-core'),
                'name' => 'eltdf_portfolio_properties',
                'parent' => $eltdfAdditionalSidebarItems
            )
        );
    }

    add_action('satine_elated_meta_boxes_map', 'eltdf_core_map_portfolio_meta', 40);
}