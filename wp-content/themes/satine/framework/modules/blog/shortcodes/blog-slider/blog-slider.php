<?php
namespace ElatedCore\CPT\Shortcodes\BlogSlider;

use ElatedCore\Lib;

class BlogSlider implements Lib\ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'eltdf_blog_slider';

        add_action('vc_before_init', array($this,'vcMap'));

        //Category filter
        add_filter( 'vc_autocomplete_eltdf_blog_slider_category_callback', array( &$this, 'blogListCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

        //Category render
        add_filter( 'vc_autocomplete_eltdf_blog_slider_category_render', array( &$this, 'blogListCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
    }

    public function getBase() {
        return $this->base;
    }
    
    public function vcMap() {
        vc_map( array(
            'name' => esc_html__('Elated Blog Slider', 'satine'),
            'base' => $this->base,
            'icon' => 'icon-wpb-blog-slider extended-custom-icon',
            'category' => esc_html__('by ELATED', 'satine'),
            'allowed_container_element' => 'vc_row',
            'params' => array(
                array(
                    'type'       => 'textfield',
                    'param_name' => 'number_of_posts',
                    'heading'    => esc_html__('Number of Posts', 'satine')
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'order_by',
                    'heading'     => esc_html__('Order By', 'satine'),
                    'value'       => array_flip(satine_elated_get_query_order_by_array()),
                    'save_always' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'order',
                    'heading'     => esc_html__('Order', 'satine'),
                    'value'       => array_flip(satine_elated_get_query_order_array()),
                    'save_always' => true
                ),
                array(
                    'type'        => 'autocomplete',
                    'param_name'  => 'category',
                    'heading'     => esc_html__('Category', 'satine'),
                    'description' => esc_html__('Enter one category slug (leave empty for showing all categories)', 'satine')
                ),
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'image_size',
                    'heading'    => esc_html__('Image Size', 'satine'),
                    'value'      => array(
                        esc_html__('Original', 'satine') => 'full',
                        esc_html__('Square', 'satine') => 'square',
                        esc_html__('Landscape', 'satine') => 'landscape',
                        esc_html__('Portrait', 'satine') => 'portrait',
                        esc_html__('Medium', 'satine') => 'medium',
                        esc_html__('Large', 'satine') => 'large'
                    )
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'title_tag',
                    'heading'     => esc_html__('Title Tag', 'satine'),
                    'value'       => array_flip(satine_elated_get_title_tag(true)),
                    'group'       => esc_html__('Post Info', 'satine')
                ),
            )
        ) );
    }
    
    public function render($atts, $content = null) {
        $default_atts = array(
            'number_of_posts' => '-1',
            'order_by' => 'title',
            'order' => 'ASC',
            'category' => '',
            'image_size' => 'full',
            'title_tag' => 'h2',
        );

        $params = shortcode_atts($default_atts, $atts);
        extract($params);

        $queryArray = $this->generateBlogQueryArray($params);
        $query_result = new \WP_Query($queryArray);
        $params['query_result'] = $query_result;

        $params['slider_data']      = $this->getSliderData($params);
        $params['thumb_image_size'] = $this->generateImageSize($params);

        ob_start();

        satine_elated_get_module_template_part('shortcodes/blog-slider/holder', 'blog', '', $params);

        $html = ob_get_contents();

        ob_end_clean();

        return $html;
    }

    /**
     * Generates query array
     *
     * @param $params
     *
     * @return array
     */
    public function generateBlogQueryArray($params){
        $queryArray = array(
            'post_status'    => 'publish',
            'post_type'      => 'post',
            'orderby'        => $params['order_by'],
            'order'          => $params['order'],
            'posts_per_page' => $params['number_of_posts'],
            'post__not_in'   => get_option('sticky_posts')
        );

        if(!empty($params['category'])){
            $queryArray['category_name'] = $params['category'];
        }

        return $queryArray;
    }

    /**
     * Return all configuration data for slider
     *
     * @param $params
     * @return array
     */
    private function getSliderData($params) {
        $slider_data = array();

        $slider_data['data-number-of-items']   = '2';
        $slider_data['data-slider-margin']     = '15';
        $slider_data['data-enable-center']     = 'yes';
        $slider_data['data-enable-navigation'] = 'no';
        $slider_data['data-enable-pagination'] = 'yes';

        return $slider_data;
    }

    /**
     * Generates image size option
     *
     * @param $params
     *
     * @return string
     */
    private function generateImageSize($params){
        $thumb_size = '';
        $image_size = $params['image_size'];

        switch ($image_size) {
            case 'landscape':
                $thumb_size = 'satine_landscape';
                break;
            case 'portrait':
                $thumb_size = 'satine_portrait';
                break;
            case 'square':
                $thumb_size = 'satine_square';
                break;
            case 'medium':
                $thumb_size = 'medium';
                break;
            case 'large':
                $thumb_size = 'large';
                break;
            case 'full':
                $thumb_size = 'full';
                break;
        }

        return $thumb_size;
    }

    /**
     * Filter categories
     *
     * @param $query
     *
     * @return array
     */
    public function blogListCategoryAutocompleteSuggester( $query ) {
        global $wpdb;
        $post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

        $results = array();
        if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
            foreach ( $post_meta_infos as $value ) {
                $data          = array();
                $data['value'] = $value['slug'];
                $data['label'] = ( ( strlen( $value['category_title'] ) > 0 ) ? esc_html__( 'Category', 'satine' ) . ': ' . $value['category_title'] : '' );
                $results[]     = $data;
            }
        }

        return $results;
    }

    /**
     * Find categories by slug
     * @since 4.4
     *
     * @param $query
     *
     * @return bool|array
     */
    public function blogListCategoryAutocompleteRender( $query ) {
        $query = trim( $query['value'] ); // get value from requested
        if ( ! empty( $query ) ) {
            // get category
            $category = get_term_by( 'slug', $query, 'category' );
            if ( is_object( $category ) ) {

                $category_slug = $category->slug;
                $category_title = $category->name;

                $category_title_display = '';
                if ( ! empty( $category_title ) ) {
                    $category_title_display = esc_html__( 'Category', 'satine' ) . ': ' . $category_title;
                }

                $data          = array();
                $data['value'] = $category_slug;
                $data['label'] = $category_title_display;

                return ! empty( $data ) ? $data : false;
            }

            return false;
        }

        return false;
    }
}
