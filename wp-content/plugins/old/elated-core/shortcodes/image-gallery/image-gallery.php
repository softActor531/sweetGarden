<?php
namespace ElatedCore\CPT\Shortcodes\ImageGallery;

use ElatedCore\Lib;

class ImageGallery implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'eltdf_image_gallery';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Elated Image Gallery', 'eltdf-core'),
			'base'                      => $this->getBase(),
			'category'                  => esc_html__('by ELATED', 'eltdf-core'),
			'icon' 						=> 'icon-wpb-image-gallery extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'       => 'dropdown',
					'param_name' => 'type',
					'heading'    => esc_html__('Gallery Type', 'eltdf-core'),
					'value'      => array(
						esc_html__('Image Grid', 'eltdf-core')	=> 'image_grid',
						esc_html__('Slider', 'eltdf-core')	=> 'slider',
						esc_html__('Carousel', 'eltdf-core') => 'carousel'
					),
					'admin_label' => true
				),
				array(
					'type'		  => 'attach_images',
					'param_name'  => 'images',
					'heading'	  => esc_html__('Images', 'eltdf-core'),
					'description' => esc_html__('Select images from media library', 'eltdf-core')
				),
				array(
					'type'		  => 'textfield',
					'param_name'  => 'image_size',
					'heading'	  => esc_html__('Image Size', 'eltdf-core'),
					'description' => esc_html__('Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'eltdf-core')
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'number_of_columns',
					'heading'    => esc_html__('Number of Columns', 'eltdf-core'),
					'value' => array(
						esc_html__('Two', 'eltdf-core') => '2',
						esc_html__('Three', 'eltdf-core') => '3',
						esc_html__('Four', 'eltdf-core') => '4',
						esc_html__('Five', 'eltdf-core') => '5',
						esc_html__('Six', 'eltdf-core') => '6'
					),
					'save_always' => true,
					'dependency'  => array('element' => 'type', 'value' => array('image_grid'))
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'space_between_columns',
					'heading'    => esc_html__('Space Between Columns', 'eltdf-core'),
					'value'      => array(
						esc_html__('Normal', 'eltdf-core') => 'normal',
						esc_html__('Small', 'eltdf-core') => 'small',
						esc_html__('Tiny', 'eltdf-core') => 'tiny',
						esc_html__('No Space', 'eltdf-core') => 'no'
					),
					'dependency'  => array('element' => 'type', 'value' => array('image_grid'))
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'number_of_visible_items',
					'heading'    => esc_html__('Number Of Visible Items', 'eltdf-core'),
					'value'      => array(
						esc_html__('Two', 'eltdf-core') => '2',
						esc_html__('Three', 'eltdf-core') => '3',
						esc_html__('Four', 'eltdf-core') => '4',
						esc_html__('Five', 'eltdf-core') => '5',
						esc_html__('Six', 'eltdf-core') => '6'
					),
					'dependency'  => array('element' => 'type', 'value' => array('carousel'))
				),
				array(
					'type'		 => 'dropdown',
					'param_name' => 'autoplay',
					'heading'	 => esc_html__('Slide Duration', 'eltdf-core'),
					'value'		 => array(
						'3'	=> '3',
						'4'	=> '4',
						'5'	=> '5',
						'6'	=> '6',
						'7'	=> '7',
						'8'	=> '8',
						'9'	=> '9',
						'10' => '10',
						esc_html__('Disable', 'eltdf-core') => 'disable'
					),
					'description' => esc_html__('Auto rotate slides each X seconds', 'eltdf-core'),
					'dependency'  => array('element' => 'type', 'value' => array('slider', 'carousel'))
				),
				array(
					'type'		 => 'dropdown',
					'param_name' => 'slide_animation',
					'heading'	 => esc_html__('Slide Animation', 'eltdf-core'),
					'value'		 => array(
						esc_html__('Slide', 'eltdf-core')	=> 'slide',
						esc_html__('Fade', 'eltdf-core') => 'fade',
						esc_html__('Fade Up', 'eltdf-core') => 'fadeUp',
						esc_html__('Back Slide', 'eltdf-core') => 'backSlide',
						esc_html__('Go Down', 'eltdf-core') => 'goDown'
					),
					'dependency'  => array('element' => 'type', 'value' => array('slider'))
				),
				array(
					'type'		  => 'dropdown',
					'param_name'  => 'pretty_photo',
					'heading'	  => esc_html__('Open PrettyPhoto On Click', 'eltdf-core'),
					'value'       => array_flip(satine_elated_get_yes_no_select_array(false))
				),
                array(
                    'type'        => 'textarea',
                    'param_name'  => 'custom_links',
                    'heading'     => esc_html__('Custom Links', 'eltdf-core'),
                    'description' => esc_html__('Delimit links by comma', 'eltdf-core'),
                    'dependency'  => Array('element' => 'pretty_photo', 'value' => array('no'))
                ),
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'custom_link_target',
                    'heading'    => esc_html__('Custom Link Target', 'eltdf-core'),
                    'value'      => array_flip(satine_elated_get_link_target_array()),
                    'dependency' => Array('element' => 'pretty_photo', 'value' => array('no'))
                ),
				array(
					'type'        => 'dropdown',
					'param_name'  => 'grayscale',
					'heading'     => esc_html__('Grayscale Images', 'eltdf-core'),
					'value'       => array_flip(satine_elated_get_yes_no_select_array(false)),
					'dependency'  => array('element' => 'type', 'value' => array('image_grid'))
				),
				array(
					'type'		  => 'dropdown',
					'param_name'  => 'navigation',
					'heading'	  => esc_html__('Show Navigation Arrows', 'eltdf-core'),
					'value'       => array_flip(satine_elated_get_yes_no_select_array(false, true)),
					'dependency'  => array('element' => 'type', 'value' => array('slider', 'carousel'))
				),
				array(
					'type'		  => 'dropdown',
					'param_name'  => 'pagination',
					'heading'	  => esc_html__('Show Pagination', 'eltdf-core'),
					'value'       => array_flip(satine_elated_get_yes_no_select_array(false, true)),
					'dependency'  => array('element' => 'type', 'value' => array('slider', 'carousel'))
				)
			)
		));
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {
		$args = array(
			'type'                    => 'image_grid',
			'images'			      => '',
			'image_size'		      => 'thumbnail',
			'number_of_columns'		  => '3',
			'space_between_columns'   => 'normal',
			'number_of_visible_items' => '1',
			'autoplay'			      => '5000',
			'slide_animation'	      => 'slide',
			'pretty_photo'		      => '',
			'custom_links'		      => '',
			'custom_link_target'      => '_self',
			'grayscale'			      => '',
			'navigation'		      => 'yes',
			'pagination'		      => 'yes'
		);

		$params = shortcode_atts($args, $atts);
		$params['gallery_classes'] = $this->getGalleryClasses($params);
		
		$params['slider_classes'] = '';
		if ($params['navigation'] === 'yes' && $params['pagination'] === 'yes' ) {
			$params['slider_classes'] = 'eltdf-nav-pag-enabled';
		}
		
		$params['slider_data'] = $this->getSliderData($params);
		
		$params['images'] = $this->getGalleryImages($params);
		$params['image_size'] = $this->getImageSize($params['image_size']);
		$params['pretty_photo'] = ($params['pretty_photo'] == 'yes') ? true : false;
		
		$params['enable_links'] = false;
        if(!$params['pretty_photo']) {
            $params['links'] = $this->getGalleryLinks($params);
            if(count($params['images']) == count($params['links'])){
                $params['enable_links'] = true;
            };
        }

        $params['custom_link_target'] = !empty($params['custom_link_target']) ? $params['custom_link_target'] : $args['custom_link_target'];
		
		if ($params['type'] === 'image_grid') {
			$template = 'image-gallery';
		} elseif ($params['type'] === 'slider' || $params['type'] === 'carousel') {
			$template = 'image-slider';
		}

		$html = eltdf_core_get_shortcode_module_template_part('templates/' . $template, 'image-gallery', '', $params);

		return $html;
	}
	
	/**
	 * Generates gallery classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getGalleryClasses($params) {
		$holderClasses = '';
		
		$holderClasses .= !empty($params['number_of_columns']) ? ' eltdf-ig-columns-' . $params['number_of_columns'] : ' eltdf-ig-columns-3';
		$holderClasses .= !empty($params['space_between_columns']) ? ' eltdf-ig-' . $params['space_between_columns'] . '-space' : ' eltdf-ig-normal-space';
		$holderClasses .= $params['grayscale'] === 'yes' ? ' eltdf-ig-grayscale' : '';
		
		return $holderClasses;
	}
	
	/**
	 * Return all configuration data for slider
	 *
	 * @param $params
	 * @return array
	 */
	private function getSliderData($params) {
		$slider_data = array();
		
		$slider_data['data-number-of-visible-items'] = ($params['number_of_visible_items'] !== '' && $params['type'] === 'carousel') ? $params['number_of_visible_items'] : '1';
		$slider_data['data-autoplay'] = ($params['autoplay'] !== '') ? $params['autoplay'] : '5000';
		$slider_data['data-animation'] = ($params['slide_animation'] !== '' && $params['type'] !== 'carousel') ? $params['slide_animation'] : 'slide';
		$slider_data['data-navigation'] = ($params['navigation'] !== '') ? $params['navigation'] : '';
		$slider_data['data-pagination'] = ($params['pagination'] !== '') ? $params['pagination'] : '';

		return $slider_data;
	}

	/**
	 * Return images for gallery
	 *
	 * @param $params
	 * @return array
	 */
	private function getGalleryImages($params) {
		$image_ids = array();
		$images = array();
		$i = 0;

		if ($params['images'] !== '') {
			$image_ids = explode(',', $params['images']);
		}

		foreach ($image_ids as $id) {

			$image['image_id'] = $id;
			$image_original = wp_get_attachment_image_src($id, 'full');
			$image['url'] = $image_original[0];
			$image['title'] = get_the_title($id);
			$image['alt'] = get_post_meta( $id, '_wp_attachment_image_alt', true);

			$images[$i] = $image;
			$i++;
		}

		return $images;
	}

	/**
	 * Return image size or custom image size array
	 *
	 * @param $image_size
	 * @return array
	 */
	private function getImageSize($image_size) {
		$image_size = trim($image_size);
		//Find digits
		preg_match_all( '/\d+/', $image_size, $matches );
		if(in_array( $image_size, array('thumbnail', 'thumb', 'medium', 'large', 'full'))) {
			return $image_size;
		} elseif(!empty($matches[0])) {
			return array(
				$matches[0][0],
				$matches[0][1]
			);
		} else {
			return 'thumbnail';
		}
	}

    /**
     * Return links for gallery
     *
     * @param $params
     * @return array
     */
    private function getGalleryLinks($params) {
        $custom_links = array();

        if (!empty($params['custom_links'])) {
            $custom_links = array_map('trim', explode(',', $params['custom_links']));
	    }

        return $custom_links;
    }
}