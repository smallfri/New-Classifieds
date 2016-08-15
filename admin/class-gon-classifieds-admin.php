<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Gon_Classifieds
 * @subpackage Gon_Classifieds/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Gon_Classifieds
 * @subpackage Gon_Classifieds/admin
 * @author     Your Name <email@example.com>
 */
class Gon_Classifieds_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $Gon_Classifieds The ID of this plugin.
     */
    private $Gon_Classifieds;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string $Gon_Classifieds The name of this plugin.
     * @param      string $version The version of this plugin.
     */
    public function __construct($Gon_Classifieds, $version)
    {

        $this->Gon_Classifieds = $Gon_Classifieds;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Gon_Classifieds_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Gon_Classifieds_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->Gon_Classifieds, plugin_dir_url(__FILE__).'css/gon-classifieds-admin.css', array(),
            $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Gon_Classifieds_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Gon_Classifieds_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->Gon_Classifieds, plugin_dir_url(__FILE__).'js/gon-classifieds-admin.js',
            array('jquery'), $this->version, false);

    }

    /**
     * Classifieds Custom Post Type for Ads
     *
     *
     * @since      1.0.0
     */

    function classifieds_custom_post_type()
    {

        $labels = array(
            'name' => _x('Ads', 'Post Type General Name', 'text_domain'),
            'singular_name' => _x('Ad', 'Post Type Singular Name', 'text_domain'),
            'menu_name' => __('Classifieds', 'text_domain'),
            'name_admin_bar' => __('Classifieds', 'text_domain'),
            'archives' => __('Item Archives', 'text_domain'),
            'parent_item_colon' => __('Parent Item:', 'text_domain'),
            'all_items' => __('All Items', 'text_domain'),
            'add_new_item' => __('Add New Item', 'text_domain'),
            'add_new' => __('Add New', 'text_domain'),
            'new_item' => __('New Item', 'text_domain'),
            'edit_item' => __('Edit Item', 'text_domain'),
            'update_item' => __('Update Item', 'text_domain'),
            'view_item' => __('View Item', 'text_domain'),
            'search_items' => __('Search Item', 'text_domain'),
            'not_found' => __('Not found', 'text_domain'),
            'not_found_in_trash' => __('Not found in Trash', 'text_domain'),
            'featured_image' => __('Featured Image', 'text_domain'),
            'set_featured_image' => __('Set featured image', 'text_domain'),
            'remove_featured_image' => __('Remove featured image', 'text_domain'),
            'use_featured_image' => __('Use as featured image', 'text_domain'),
            'insert_into_item' => __('Insert into item', 'text_domain'),
            'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
            'items_list' => __('Items list', 'text_domain'),
            'items_list_navigation' => __('Items list navigation', 'text_domain'),
            'filter_items_list' => __('Filter items list', 'text_domain'),

        );
        $args = array(
            'label' => __('Ad', 'text_domain'),
            'description' => __('Ads Post Type', 'text_domain'),
            'labels' => $labels,
            'supports' => array(),
            'taxonomies' => array('gon_classifieds_category'),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => false,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'post',
            //            'rewrite' => array( 'slug' => 'brands' )

        );
        register_post_type('classifieds', $args);

    }

    /**
     *  Add submenu pages
     *
     * @since      1.0.0
     *
     */
    function gon_add_options_link()
    {

        add_submenu_page('edit.php?post_type=classifieds', 'Classifieds Settings', 'Settings', 'edit_posts',
            'settings', array(&$this, 'gon_admin_page_extensions'));
        add_submenu_page('edit.php?post_type=classifieds', 'Classifieds Search', 'Search', 'edit_posts', 'search',
            array(&$this, 'gon_admin_page_search'));
    }

    /**
     *
     * Saves settings from admin options page
     *
     * @since      1.0.0
     *
     */
    function gon_admin_page_extensions()
    {

        if (gon_request('gon-settings-submit'))
        {
            update_option('gon-classifieds-ad-limit', gon_request('ad_limit'));
            update_option('gon-classifieds-expires', gon_request('expires'));
            update_option('gon-classifieds-template', gon_request('template'));
            update_option('gon-classifieds-reply-to', gon_request('reply_to'));
            update_option('gon-classifieds-column-count', gon_request('column_count'));
            update_option('gon-classifieds-ads-per-page', gon_request('ads_per_page'));
            update_option('gon-classifieds-sub-image-limit', gon_request('image_limit'));
            update_option('gon-classifieds-sub-image-limit2', gon_request('image_limit2'));
        }

        if (gon_request('gon-status-submit'))
        {
            update_user_meta(gon_request('user'), 'gon-status', gon_request('gon-user-option'));
        }
        if (gon_request('user-options-submit'))
        {
            $options = get_option('gon-user-option');
            $newOptions = [];
            $newOptions[] = gon_request('user_option');
            $optionsArray = $newOptions;

            if (!empty($options))
            {
                $optionsArray = array_merge((array)$options, $newOptions);
            }

            update_option('gon-user-option', $optionsArray);
        }
        if (gon_request('remove-ban-submit'))
        {
            update_user_meta(gon_request('user_id'), 'gon-status', 'active');
        }

        $message = __('Settings Saved');
        gon_message(array("info" => $message));

        include(plugin_dir_path(__FILE__).'partials/gon-ads-plugin-options.php');

    }

    /**
     *  Handles search function for admin
     *
     * @since      1.0.0
     *
     */
    function gon_admin_page_search()
    {

        $category = $taxonomy = null;
        $meta = array();

        $query = gon_request("query");
        $location = gon_request("location");

        if ($location)
        {
            $meta[] = array('key' => 'city', 'value' => $location, 'compare' => 'LIKE');
        }

        if ($category)
        {
            $taxonomy = array(
                array(
                    'taxonomy' => 'classifieds',
                    'field' => 'term_id',
                    'terms' => $category,
                ),
            );
        }
        $args = apply_filters("classifieds_list_query", array(
            'post_type' => 'classifieds',
            'post_status' => 'publish',
            'posts_per_page' => get_option('gon-classifieds-ads-per-page'),
            'paged' => gon_request("pg", 1),
            's' => $query,
            'meta_query' => $meta,
            'orderby' => array('menu_order' => 'DESC', 'date' => 'DESC')
        ));
        if ($category&&is_tax('classifieds'))
        {
            $pbase = get_term_link(get_queried_object()->term_id, 'classifieds');
        }
        else
        {
            $pbase = @add_query_arg('pg', '%#%');
        }
        $paginate_base = $pbase;
        $paginate_format = stripos($paginate_base, '?')?'&pg=%#%':'?pg=%#%';
        gon_request('pg')>1?$current = gon_request('pg'):$current = 1;

        $loop = new WP_Query($args);

        $items = $loop->posts;

        if (is_array($items)||is_object($items))
        {
            $search_bar = 'enabled';
            echo '<div style="width:600px">';
            include(plugin_dir_path(__FILE__).'partials/gon-ads-plugin-search-bar.php');

            include(gonPath.'/public/partials/gon-ads-plugin-list-view.php');
            echo '</div>';

        }

    }

    /**
     * Register taxonomies for classifieds CPT
     *
     * @since      1.0.0
     *
     */

    function register_taxonomies()
    {

        $labels = array(
            'name' => _x('Classified Categories', 'taxonomy general name'),
            'singular_name' => _x('Classified Category', 'taxonomy singular name'),
            'search_items' => __('Search Classified Categories'),
            'all_items' => __('All Classified Categories'),
            'parent_item' => __('Parent Classified Category'),
            'parent_item_colon' => __('Parent Classified Category:'),
            'edit_item' => __('Edit Classified Category'),
            'update_item' => __('Update Classified Category'),
            'add_new_item' => __('Add New Classified Category'),
            'new_item_name' => __('New Classified Category'),
            'menu_name' => __('Classified Categories'),
        );
        $args = array(
            'labels' => $labels,
            'hierarchical' => true,
        );
        register_taxonomy('classifieds-categories', 'classifieds', $args);

        $term = term_exists('Default', 'classifieds-categories');

        if ($term==0)
        {
            wp_insert_term(
                'Default', // the term
                'classifieds-categories', // the taxonomy
                array(
                    'description' => 'Default Category.',
                    'slug' => 'default',
                ));
        }
    }

}
