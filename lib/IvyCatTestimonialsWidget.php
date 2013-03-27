<?php
class IvyCatTestimonialsWidget extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'description' => __( 'Displays testimonial custom post type content in a widget', 'ivycat-ajax-testimonials' ) );
		$this->WP_Widget( 'IvyCatTestimonialsWidget', __( 'IvyCat Testimonial Widget', 'ivycat-ajax-testimonials' ), $widget_ops );
	}
	
	function form( $instance ) {	
		$title = wp_strip_all_tags( $this->set_field( 'title', 'is_string', '', $instance ) );
		$slider_speed = $this->set_field( 'testimonial_slide_speed', 'is_numeric', 8000, $instance );
		$slider_fadein = $this->set_field( 'testimonial_fadein', 'is_numeric', 1000, $instance );
		$slider_fadeout = $this->set_field( 'testimonial_fadeout', 'is_numeric', 1000, $instance );
		$group = isset( $instance['testimonial_group'] ) ? $instance['testimonial_group'] : 0 ;
		$ajax_on = isset( $instance['testimonial_ajax_on'] ) ? $instance['testimonial_ajax_on'] : 'n';
		$linked_testimonials = isset( $instance['testimonial_link_testimonials'] ) ? $instance['testimonial_link_testimonials'] : false; ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" id="<?php echo $this->get_field_id( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'testimonial_group' ); ?>"><?php _e( 'Testimonial Group to Display:', 'ivycat-ajax-testimonials' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'testimonial_group' ); ?>" id="<?php echo $this->get_field_id( 'testimonial_group' ); ?>" class="widefat">
				<option><?php _e( 'All Groups', 'ivycat-ajax-testimonials' ); ?></option><?php
				$cats = get_terms( 'testimonial-group', array( 'hide_empty' => 0 ) );
				foreach ( ( object ) $cats as $cat ) :
					printf( '<option value="%s"%s">%s</option>',
						$cat->slug,
						selected( $instance['testimonial_group'], $cat->slug, false ),
						$cat->name
					);
				endforeach; ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'testimonial_quantity' ); ?>"><?php _e( 'Quantity to Display', 'ivycat-ajax-testimonials' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'testimonial_quantity' ); ?>"
				id="<?php echo $this->get_field_id( 'testimonial_quantity' ); ?>" class="widefat" value="<?php echo $this->set_field( 'testimonial_quantity', 'is_numeric', 3, $instance ); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'testimonial_num_words' ); ?>"><?php _e( 'Number of Words (0 for all)', 'ivycat-ajax-testimonials' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'testimonial_num_words' ); ?>"
				id="<?php echo $this->get_field_id( 'testimonial_num_words' ); ?>" class="widefat" value="<?php echo $this->set_field( 'testimonial_num_words', 'is_numeric', -1, $instance ); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'testimonial_read_more' ); ?>"><?php _e( 'Read More Text', 'ivycat-ajax-testimonials' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'testimonial_read_more' ); ?>"
				id="<?php echo $this->get_field_id( 'testimonial_read_more' ); ?>" class="widefat" value="<?php echo $this->set_field( 'testimonial_read_more', 'is_string', 'Read More...', $instance ); ?>"/>
		</p>
		<p>
			<input type="checkbox" name="<?php echo $this->get_field_name( 'testimonial_ajax_on' ); ?>"
				id="<?php echo $this->get_field_id( 'testimonial_ajax_on' ); ?>" class="checkbox" value="no"<?php checked( $ajax_on, 'no' ); ?>"/>
			<label for="<?php echo $this->get_field_id( 'testimonial_ajax_on' ); ?>"><?php _e( 'Disable Ajax', 'ivycat-ajax-testimonials' ); ?></label>
		</p>
		<p>
			<input type="checkbox" name="<?php echo $this->get_field_name( 'testimonial_link_testimonials' ); ?>"
				id="<?php echo $this->get_field_id( 'testimonial_link_testimonials' ); ?>" class="checkbox" value="yes"<?php checked( $linked_testimonials, 'yes' ); ?>"/>
			<label for="<?php echo $this->get_field_id( 'testimonial_link_testimonials' ); ?>"><?php _e( 'Link Individual Testimonials', 'ivycat-ajax-testimonials' ); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'testimonial_show_all' ); ?>"><?php _e( 'Link to all Testimonials', 'ivycat-ajax-testimonials' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'testimonial_show_all' ); ?>"
				id="<?php echo $this->get_field_id( 'testimonial_show_all' ); ?>" class="widefat" value="<?php echo $this->set_field( 'testimonial_show_all', 'is_string', '', $instance );?>"/>
		</p>
		<h3>Slider Settings</h3>
		<p>
			<label for="<?php echo $this->get_field_id( 'testimonial_slide_speed' ); ?>"><?php _e( 'Slider Speed (in miliseconds)', 'ivycat-ajax-testimonials' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'testimonial_slide_speed' ); ?>"
				id="<?php echo $this->get_field_id( 'testimonial_slide_speed' ); ?>" class="widefat" value="<?php echo $slider_speed; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'testimonial_fadein' ); ?>"><?php _e( 'Fade In Duration (in miliseconds)', 'ivycat-ajax-testimonials' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'testimonial_fadein' ); ?>"
				id="<?php echo $this->get_field_id( 'testimonial_fadein' ); ?>" class="widefat" value="<?php echo $slider_fadein; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'testimonial_fadeout' ); ?>"><?php _e( 'Fade Out Duration (in miliseconds)', 'ivycat-ajax-testimonials' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'testimonial_fadeout' ); ?>"
				id="<?php echo $this->get_field_id( 'testimonial_fadeout' ); ?>" class="widefat" value="<?php echo $slider_fadeout; ?>"/>
		</p>
		<?php
		do_action( 'ic_testimonials_widget_form', $instance );
	}
	
	public function widget( $args, $instance ) {
		
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Testimonials', 'ivycat-ajax-testimonials' ) : $instance['title'], $instance, $this->id_base );
	   
		$quantity = ( $instance['testimonial_quantity'] ) ? absint( $instance['testimonial_quantity'] ) : 1;
		$group = ( isset( $instance['testimonial_group'] ) && 'All Groups' !== $instance['testimonial_group'] ) ? $instance['testimonial_group'] : false;
		$atts = array(
			'quantity' => ( is_numeric( $quantity ) ) ? $quantity : 3,
			'group' => $group,
			'title' => $title,
			'link_testimonials' => $instance['testimonial_link_testimonials'],
			'num_words' => ( is_numeric( $instance['testimonial_num_words'] ) ) ? $instance['testimonial_num_words'] : false,
			'more_tag' => ( strlen( $instance['testimonial_read_more'] ) > 1 ) ? $instance['testimonial_read_more'] : 'Read More...',
			'ajax_on' => ( 'no' == $instance['testimonial_ajax_on'] ) ? 'no' : 'yes',
			'all_url' =>  ( strlen( $instance['testimonial_show_all'] ) > 1 ) ? $instance['testimonial_show_all'] : false,
			'fadeIn' => $instance['testimonial_fadein'],
			'fadeOut' => $instance['testimonial_fadeout'],
			'speed' => $instance['testimonial_slide_speed']
		);
		echo IvyCatTestimonials::do_testimonials( $atts );
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$widget_id = 'widget-' . $_POST['id_base'] . '-' . $_POST['widget_number'] . '-';
		$instance['testimonial_group'] = wp_strip_all_tags( $new_instance['testimonial_group'] );
		$instance['testimonial_quantity'] = absint( $new_instance['testimonial_quantity'] );
		$instance['testimonial_num_words'] = absint( $new_instance['testimonial_num_words'] );
		$instance['testimonial_read_more'] = wp_strip_all_tags( $new_instance['testimonial_read_more'] );
		$instance['testimonial_ajax_on'] = $new_instance['testimonial_ajax_on'];
		$instance['testimonial_show_all'] = $new_instance['testimonial_show_all'];
		$instance['title'] = wp_strip_all_tags( $new_instance['title'] );
		$instance['testimonial_slide_speed'] = absint( $new_instance['testimonial_slide_speed'] );
		$instance['testimonial_fadein'] = absint( $new_instance['testimonial_fadein'] );
		$instance['testimonial_fadeout'] = absint( $new_instance['testimonial_fadeout'] );
		$instance['testimonial_link_testimonials'] = $new_instance['testimonial_link_testimonials'];
		
		return apply_filters( 'ic_testimonials_widget_save', $instance, $new_instance );
	}
	
	protected function set_field( $field, $condition, $default, $instance ){
		if( !function_exists( $condition ) || ! isset( $instance[ $field ] ) )
			return $default;;
		return $condition( $instance[ $field] ) ? $instance[ $field ] : $default;
		
	}
}
