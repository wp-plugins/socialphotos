<?php
 /*
 Plugin Name: Socialphotos
 Description: Discover and Integrate your customers Instagram visual content, increase brand credibility and drive more sales.
 */

 /* WARNING IF YOU DO NOT KNOW WHAT THIS MUMBO JUMBO MEANS, DO NOT EDIT THIS CODE. */
 
 /* Start Adding Functions Below this Line */

// Creating the widget 
class wpb_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'wpb_widget', 

// Widget name will appear in UI
__('Socialphotos', 'wpb_widget_domain'), 

// Widget description
array( 'description' => __( 'Integrate user generated content in seconds', 'wpb_widget_domain' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes

echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];
echo "<script type=\"text/javascript\" async=\"\" src=\"https://d1jk2robjk8azk.cloudfront.net/widget/shopify-embed.js\"></script>";
echo $instance['socialphotos-plugin-code'];

// This is where you run the code and display the output

echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'New title', 'wpb_widget_domain' );
}

if ( isset( $instance[ 'socialphotos-plugin-code' ] ) ) {
$socialPhotosPluginCode = $instance[ 'socialphotos-plugin-code' ];
}
else {
$socialPhotosPluginCode = __( '', 'wpb_widget_domain' );
}
// Widget admin form
?>
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" placeholder="Title will be displayed above the widget, if any." />
</p>
<p>
	<label>Generated Gallery code*</label>
	<input type="text" name="<?php echo $this->get_field_name( 'socialphotos-plugin-code' ); ?>"
		class="widefat form-control" value="<?php echo esc_attr( $socialPhotosPluginCode ); ?>" placeholder="Paste your generated gallery code here">
	<label><small>*customization is done in your Socialphotos account</small></label>
</p>

<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['socialphotos-plugin-code'] = ( ! empty( $new_instance['socialphotos-plugin-code'] ) ) ? $new_instance['socialphotos-plugin-code'] : '';
return $instance;
}
} // Class wpb_widget ends here

// Register and load the widget
function wpb_load_widget() {
	register_widget( 'wpb_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );

 /* Stop Adding Functions Below this Line */
?>