<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Gon_Classifieds
 * @subpackage Gon_Classifieds/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Gon_Classifieds
 * @subpackage Gon_Classifieds/public
 * @author     Your Name <email@example.com>
 */
class Gon_Classifieds_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $Gon_Classifieds    The ID of this plugin.
	 */
	private $Gon_Classifieds;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $Gon_Classifieds       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $Gon_Classifieds, $version ) {

		$this->Gon_Classifieds = $Gon_Classifieds;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

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
		wp_enqueue_style( $this->Gon_Classifieds, plugin_dir_url( __FILE__ ) . 'css/gon-classifieds-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

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

		wp_enqueue_script( $this->Gon_Classifieds, plugin_dir_url( __FILE__ ) . 'js/gon-classifieds-public.js', array( 'jquery' ), $this->version, false );

	}

}
