<?php
namespace ElatedCore\CPT\Team;

use ElatedCore\Lib\PostTypeInterface;

/**
 * Class TeamRegister
 * @package ElatedCore\CPT\Team
 */
class TeamRegister implements PostTypeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'team-member';
        $this->taxBase = 'team-category';
    }

    /**
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Registers custom post type with WordPress
     */
    public function register() {
        $this->registerPostType();
        $this->registerTax();
    }
	

    /**
     * Registers custom post type with WordPress
     */
    private function registerPostType() {
        global $satine_Framework;

        $menuPosition = 4;
        $menuIcon = 'dashicons-admin-users';
        $slug = $this->base;

        register_post_type( $this->base,
            array(
                'labels' => array(
                    'name'          => esc_html__('Elated Team','eltdf-core'),
                    'singular_name' => esc_html__('Elated Team Member','eltdf-core'),
                    'add_item'      => esc_html__('New Team Member','eltdf-core'),
                    'add_new_item'  => esc_html__('Add New Team Member','eltdf-core'),
                    'edit_item'     => esc_html__('Edit Team Member','eltdf-core')
                ),
                'public'        => false,
                'show_in_menu'  =>  true,
                'has_archive'   => false,
                'rewrite'       => array('slug' => $slug),
                'menu_position' => $menuPosition,
                'show_ui'       => true,
                'hierarchical'  =>  false,
                'supports'      => array('author', 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'comments'),
                'menu_icon'     =>  $menuIcon
            )
        );
    }

    /**
     * Registers custom taxonomy with WordPress
     */
    private function registerTax() {
        $labels = array(
            'name'              => esc_html__('Team Categories', 'eltdf-core'),
            'singular_name'     => esc_html__('Team Category', 'eltdf-core'),
            'search_items'      => esc_html__('Search Team Categories','eltdf-core'),
            'all_items'         => esc_html__('All Team Categories','eltdf-core'),
            'parent_item'       => esc_html__('Parent Team Category','eltdf-core'),
            'parent_item_colon' => esc_html__('Parent Team Category:','eltdf-core'),
            'edit_item'         => esc_html__('Edit Team Category','eltdf-core'),
            'update_item'       => esc_html__('Update Team Category','eltdf-core'),
            'add_new_item'      => esc_html__('Add New Team Category','eltdf-core'),
            'new_item_name'     => esc_html__('New Team Category Name','eltdf-core'),
            'menu_name'         => esc_html__('Team Categories','eltdf-core')
        );

        register_taxonomy($this->taxBase, array($this->base), array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'query_var'         => true,
            'show_admin_column' => true,
            'rewrite'           => array('slug' => $this->taxBase)
        ));
    }
}