<?php
/*
Plugin Name: GON Categories
Plugin URI: http://mydomain.com
Description: My first widget
Author: Me
Version: 1.0
Author URI: http://mydomain.com
*/
// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');

add_action( 'widgets_init', function(){
     register_widget( 'GON_Categories' );
});
/**
 * Adds GON_Categories widget.
 */
class GON_Categories extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'GON_Categories', // Base ID
			__('GON Categories', 'text_domain'), // Name
			array( 'description' => __( 'My first widget!', 'text_domain' ), ) // Args
		);
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

        echo '<div class="post-ad-widget"><a href="/classified-ads/post-an-ad/" class="cform_button button">Post an Ad</a></div>';

     	echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
            echo '<h4>'.$instance['title'].'</h4>';
		}

        global $current_user;
        wp_get_current_user();
        $terms = get_terms('classifieds-categories', array(
            'orderby' => 'count',
            'hide_empty' => 0
        ));


        foreach ($terms as $term)
        {

            echo '<p class="gon-category-links"><a href="'. get_category_link( $term->term_taxonomy_id ).'">'.$term->name.'</a></p>';
        }

        echo $args['after_widget'];
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
} // class GON_Categories