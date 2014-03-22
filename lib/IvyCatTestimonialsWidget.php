<?php
class IvyCatTestimonialsWidget extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'description' => __( 'Displays testimonial custom post type content in a widget', 'ivycat-ajax-testimonials' ) );
		$this->WP_Widget( 'IvyCatTestimonialsWidget', __( 'IvyCat Testimonial Widget', 'ivycat-ajax-testimonials' ), $widget_ops );
	}
	
	function form( $instance ) {	
		$title = isset( $instance['testimonial_title'] ) ? $instance['testimonial_title'] : 'Testimonials' ;
		$group = isset( $instance['testimonial_group'] ) ? $instance['testimonial_group'] : 0;
		$quantity = isset( $instance['testimonial_quantity'] ) ? $instance['testimonial_quantity'] : 3;
		$num_words = isset( $instance['testimonial_num_words'] ) ? $instance['testimonial_num_words'] : 0;
		$read_more = isset( $instance['testimonial_read_more'] ) ? $instance['testimonial_read_more'] : 'Read More...';
		$ajax_on = isset( $instance['testimonial_ajax_on'] ) ? $instance['testimonial_ajax_on'] : false;
		$linked_testimonials = isset( $instance['testimonial_link'] ) ? $instance['testimonial_link'] : false; 
		$linkto_title = isset( $instance['testimonial_show_all_title'] ) ? $instance['testimonial_show_all_title'] : 'See All Testimonials'; 
		$linkto_url = isset( $instance['testimonial_show_all'] ) ? $instance['testimonial_show_all'] : get_bloginfo( 'url' ); 
		$slider_speed = isset(  $instance['testimonial_slide_speed'] ) ? $instance['testimonial_slide_speed'] : 8000;
		$slider_fadein = isset(  $instance['testimonial_fadein'] ) ? $instance['testimonial_fadein'] : 1000;
		$slider_fadeout = isset(  $instance['testimonial_fadeout'] ) ? $instance['testimonial_fadeout'] : 1000; ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'testimonial_title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'testimonial_title' ); ?>" id="<?php echo $this->get_field_id( 'testimonial_title' ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'testimonial_group' ); ?>"><?php _e( 'Display Testimonial Group:', 'ivycat-ajax-testimonials' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'testimonial_group' ); ?>" id="<?php echo $this->get_field_id( 'testimonial_group' ); ?>" class="widefat">
				<option><?php _e( 'All Groups', 'ivycat-ajax-testimonials' ); ?></option><?php
				$cats = get_terms( 'testimonial-group', array( 'hide_empty' => 0 ) );
				foreach ( ( object ) $cats as $cat ) :
					if ( array_key_exists('testimonial_group', $instance ) ) {
						printf( '<option value="%s"%s">%s</option>',
							$cat->slug,
							selected( absint( $instance['testimonial_group'] ), $cat->slug, false ),
							$cat->name
						);
					}
				endforeach; ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'testimonial_quantity' ); ?>"><?php _e( 'How many testimonials in rotation?', 'ivycat-ajax-testimonials' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'testimonial_quantity' ); ?>"
				id="<?php echo $this->get_field_id( 'testimonial_quantity' ); ?>" class="widefat" value="<?php echo absint( $quantity ); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'testimonial_num_words' ); ?>"><?php _e( 'Number of Words (0 for all)', 'ivycat-ajax-testimonials' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'testimonial_num_words' ); ?>"
				id="<?php echo $this->get_field_id( 'testimonial_num_words' ); ?>" class="widefat" value="<?php echo absint( $num_words ); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'testimonial_read_more' ); ?>"><?php _e( 'Read More Text', 'ivycat-ajax-testimonials' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'testimonial_read_more' ); ?>"
				id="<?php echo $this->get_field_id( 'testimonial_read_more' ); ?>" class="widefat" value="<?php echo esc_attr( $read_more ); ?>"/>
		</p>
		<p>
			<input type="checkbox" name="<?php echo $this->get_field_name( 'testimonial_ajax_on' ); ?>"
				id="<?php echo $this->get_field_id( 'testimonial_ajax_on' ); ?>" class="checkbox" value="no"<?php checked( $ajax_on ); ?>/>
			<label for="<?php echo $this->get_field_id( 'testimonial_ajax_on' ); ?>"><?php _e( 'Disable AJAX', 'ivycat-ajax-testimonials' ); ?></label>
		</p>
		<p>
			<input type="checkbox" name="<?php echo $this->get_field_name( 'testimonial_link' ); ?>"
				id="<?php echo $this->get_field_id( 'testimonial_link' ); ?>" class="checkbox" value="yes"<?php checked( $linked_testimonials ); ?>/>
			<label for="<?php echo $this->get_field_id( 'testimonial_link' ); ?>"><?php _e( 'Link Individual Testimonials', 'ivycat-ajax-testimonials' ); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'testimonial_show_all_title' ); ?>"><?php _e( 'Title for Link to all Testimonials', 'ivycat-ajax-testimonials' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'testimonial_show_all_title' ); ?>"
				id="<?php echo $this->get_field_id( 'testimonial_show_all_title' ); ?>" class="widefat" value="<?php echo esc_attr( $linkto_title );?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'testimonial_show_all' ); ?>"><?php _e( 'Link to all Testimonials', 'ivycat-ajax-testimonials' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'testimonial_show_all' ); ?>"
				id="<?php echo $this->get_field_id( 'testimonial_show_all' ); ?>" class="widefat" value="<?php echo esc_url( $linkto_url );?>"/>
		</p>
		<h3>Testimonial Rotation Settings</h3>
		<p>
			<label for="<?php echo $this->get_field_id( 'testimonial_slide_speed' ); ?>"><?php _e( 'Testimonial Rotation (miliseconds)', 'ivycat-ajax-testimonials' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'testimonial_slide_speed' ); ?>"
				id="<?php echo $this->get_field_id( 'testimonial_slide_speed' ); ?>" class="widefat" value="<?php echo absint( $slider_speed ); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'testimonial_fadein' ); ?>"><?php _e( 'Testimonial Fade In (miliseconds)', 'ivycat-ajax-testimonials' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'testimonial_fadein' ); ?>"
				id="<?php echo $this->get_field_id( 'testimonial_fadein' ); ?>" class="widefat" value="<?php echo absint ($slider_fadein ); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'testimonial_fadeout' ); ?>"><?php _e( 'Testimonial Fade Out (miliseconds)', 'ivycat-ajax-testimonials' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'testimonial_fadeout' ); ?>"
				id="<?php echo $this->get_field_id( 'testimonial_fadeout' ); ?>" class="widefat" value="<?php echo absint( $slider_fadeout ); ?>"/>
		</p>
		<?php
		do_action( 'ic_testimonials_widget_form', $instance );
	}
	
	public function widget( $args, $instance ) {
		
		$title = empty($instance['testimonial_title']) ? ' ' : apply_filters('widget_title', $instance['testimonial_title']);
		$quantity = ( $instance['testimonial_quantity'] ) ? absint( $instance['testimonial_quantity'] ) : 1;
		$group = ( isset( $instance['testimonial_group'] ) && 'All Groups' !== $instance['testimonial_group'] ) ? $instance['testimonial_group'] : false;
		$atts = array(
			'quantity' => ( is_numeric( $quantity ) ) ? $quantity : 3,
			'group' => $group,
			'link_testimonials' => $instance['testimonial_link'],
			'num_words' => ( is_numeric( $instance['testimonial_num_words'] ) ) ? $instance['testimonial_num_words'] : false,
			'more_tag' => ( strlen( $instance['testimonial_read_more'] ) > 1 ) ? $instance['testimonial_read_more'] : 'Read More...',
			'ajax_on' => ( 'no' == $instance['testimonial_ajax_on'] ) ? 'no' : 'yes',
			'all_title' =>  ( strlen( $instance['testimonial_show_all_title'] ) > 1 ) ? $instance['testimonial_show_all_title'] : false,
			'all_url' =>  ( strlen( $instance['testimonial_show_all'] ) > 1 ) ? $instance['testimonial_show_all'] : false,
			'fade_in' => $instance['testimonial_fadein'],
			'fade_out' => $instance['testimonial_fadeout'],
			'speed' => $instance['testimonial_slide_speed']
		);
		echo $args[ 'before_widget' ];
		echo ( empty( $title ) ) ? '' : $args['before_title'] . $title . $args['after_title'];
		echo $GLOBALS['IvyCatTestimonials_Object']->do_testimonials( $atts );
		echo $args[ 'after_widget' ];
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$widget_id = 'widget-' . $_POST['id_base'] . '-' . $_POST['widget_number'] . '-';
		$instance['testimonial_group'] = wp_strip_all_tags( $new_instance['testimonial_group'] );
		$instance['testimonial_quantity'] = absint( $new_instance['testimonial_quantity'] );
		$instance['testimonial_num_words'] = absint( $new_instance['testimonial_num_words'] );
		$instance['testimonial_read_more'] = wp_strip_all_tags( $new_instance['testimonial_read_more'] );
		$instance['testimonial_ajax_on'] = ( isset( $new_instance['testimonial_ajax_on'] ) ? true : false );
		$instance['testimonial_show_all_title'] = sanitize_text_field( $new_instance['testimonial_show_all_title'] );
		$instance['testimonial_show_all'] = esc_url( $new_instance['testimonial_show_all'] );
		$instance['testimonial_title'] = wp_strip_all_tags( $new_instance['testimonial_title'] );
		$instance['testimonial_slide_speed'] = absint( $new_instance['testimonial_slide_speed'] );
		$instance['testimonial_fadein'] = absint( $new_instance['testimonial_fadein'] );
		$instance['testimonial_fadeout'] = absint( $new_instance['testimonial_fadeout'] );
		$instance['testimonial_link'] = ( isset( $new_instance['testimonial_link'] ) ? true : false );
		
		return apply_filters( 'ic_testimonials_widget_save', $instance, $new_instance );
	}
}
