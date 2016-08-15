<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Gon_Classifieds
 * @subpackage Gon_Classifieds/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Gon_Classifieds
 * @subpackage Gon_Classifieds/includes
 * @author     Your Name <email@example.com>
 */
class Gon_Classifieds_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate()
 {

     add_option("gon_classifieds_delayed_install", "yes");

     /**
* on FIRST activation do this.
*/
//        if (get_option("gon_classifieds_first_run", "1")=="0") {
//            return;
//        }

     /**
      * make sure this will not be ran again.
      */
     add_option("gon_classifieds_first_run", "0", '', false);

     $hid = wp_insert_post(array(
         'post_type' => 'page',
         'post_status' => 'publish',
         'post_title' => 'Gon Classifieds',
         'comment_status' => 'closed',
         'ping_status' => 'closed',
         'post_content' => "[gon_classifieds_list type='list']"
     ));

     $aid = wp_insert_post(array(
         'post_type' => 'page',
         'post_status' => 'publish',
         'post_title' => 'Post an Ad',
         'post_parent' => $hid,
         'comment_status' => 'closed',
         'ping_status' => 'closed',
         'post_content' => "[gon_classifieds_add]"
     ));

     $mid = wp_insert_post(array(
         'post_type' => 'page',
         'post_status' => 'publish',
         'post_title' => 'Manage Classifieds',
         'post_parent' => $hid,
         'comment_status' => 'closed',
         'ping_status' => 'closed',
         'post_content' => "[gon_classifieds_manage]"
     ));

     $reg = wp_insert_post(array(
         'post_type' => 'page',
         'post_status' => 'publish',
         'post_title' => 'Register',
         'post_parent' => $hid,
         'comment_status' => 'closed',
         'ping_status' => 'closed',
         'post_content' => "[gon_classifieds_register]"
     ));

     $reg = wp_insert_post(array(
         'post_type' => 'page',
         'post_status' => 'publish',
         'post_title' => 'Gallery View',
         'post_parent' => $hid,
         'comment_status' => 'closed',
         'ping_status' => 'closed',
         'post_content' => "[gon_classifieds_list type='gallery']"
     ));

     wp_insert_term(
         'Default',
         'gon_classifieds_category'
     );

     $optionsArray = ['free','active','banned','dealer'];

     update_option('gon-user-option', $optionsArray);

     $mdw_role = get_role( 'administrator' );

     	/* If the administrator role exists, add required capabilities for the plugin. */
     	if ( !empty( $mdw_role ) ) {

     		$mdw_role->add_cap( 'manage_classifieds' );
     		$mdw_role->add_cap( 'create_classifieds' );
     		$mdw_role->add_cap( 'edit_classifieds'   );
     		$mdw_role->add_cap( 'publish_classifieds'   );
     		$mdw_role->add_cap( 'edit_others_classifieds'   );
     		$mdw_role->add_cap( 'delete_classifieds'   );
     		$mdw_role->add_cap( 'delete_others_classifieds'   );
     		$mdw_role->add_cap( 'read_private_classifieds'   );
     		$mdw_role->add_cap( 'upload_classifieds_files'   );
     		$mdw_role->add_cap( 'unfiltered_upload_classifieds_files'   );
     	}

 }

}
