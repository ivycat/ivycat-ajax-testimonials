<?php
class IvyCatTestimonialsWidget extends WP_Widget {

    public function __construct() {
        $widget_ops = array( 'description' => __( 'Displays testimonial custom post type content in a widget', 'ivycat-ajax-testimonials' ) );
        $this->WP_Widget( 'IvyCatTestimonialsWidget', __( 'IvyCat Testimonial Widget', 'ivycat-ajax-testimonials' ), $widget_ops );
    }
    
    function form( $instance ) {	
        $title = wp_strip_all_tags( $instance['title'] );
        ?>
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
			<label for="<?php echo $this->get_field_id( 'testimonial_quantity' ); ?>"><?php _e( 'Quantity to Display:', 'ivycat-ajax-testimonials' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'testimonial_quantity' ); ?>"
					id="<?php echo $this->get_field_id( 'testimonial_quantity' ); ?>" class="widefat" value="<?php echo $instance['testimonial_quantity'] ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'testimonial_num_words' ); ?>"><?php _e( 'Number of Words (leave blank if all)', 'ivycat-ajax-testimonials' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'testimonial_num_words' ); ?>"
					id="<?php echo $this->get_field_id( 'testimonial_num_words' ); ?>" class="widefat" value="<?php echo $instance['testimonial_num_words'] ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'testimonial_read_more' ); ?>"><?php _e( 'Read More Text', 'ivycat-ajax-testimonials' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'testimonial_read_more' ); ?>"
					id="<?php echo $this->get_field_id( 'testimonial_read_more' ); ?>" class="widefat" value="<?php echo $instance['testimonial_read_more'] ?>"/>
		</p>
		<p>
			<input type="checkbox" name="<?php echo $this->get_field_name( 'testimonial_ajax_on' ); ?>"
					id="<?php echo $this->get_field_id( 'testimonial_ajax_on' ); ?>" class="widefat" value="y"<?php checked( $instance['testimonial_ajax_on'], 'y' ); ?>"/>
			<label for="<?php echo $this->get_field_id( 'testimonial_ajax_on' ); ?>"><?php _e( 'Disable Ajax', 'ivycat-ajax-testimonials' ); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'testimonial_show_all' ); ?>"><?php _e( 'Link to all Testimonials', 'ivycat-ajax-testimonials' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'testimonial_show_all' ); ?>"
					id="<?php echo $this->get_field_id( 'testimonial_show_all' ); ?>" class="widefat" value="<?php echo $instance['testimonial_show_all'] ?>"/>
		</p>
		<?php
    }
    
    public function widget( $args, $instance ) {
        
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Testimonials', 'ivycat-ajax-testimonials' ) : $instance['title'], $instance, $this->id_base );
       
        $quantity = ( $instance['testimonial_quantity'] ) ? absint( $instance['testimonial_quantity'] ) : 1;
        $group = ( isset( $instance['testimonial_group'] ) && 'All Groups' !== $instance['testimonial_group'] ) ? $instance['testimonial_group'] : false;
		$atts = array(
			'quantity' => ( is_numeric( $quantity ) ) ? $quantity : 3,
			'group' => $group,
			'title' => $title,
			'num_words' => ( is_numeric( $instance['testimonial_num_words'] ) ) ? $instance['testimonial_num_words'] : false,
			'more_tag' => ( strlen( $instance['testimonial_read_more'] ) > 1 ) ? $instance['testimonial_read_more'] : false,
			'ajax_on' => ( 'yes' == $instance['testimonial_ajax_on'] ) ? false : true,
			'all_url' =>  ( strlen( $instance['testimonial_show_all'] ) ) ? $instance['testimonial_show_all'] : false
		);
        echo apply_filters( 'the_content', IvyCatTestimonials::do_testimonials( $atts ) );
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
		
        return $instance;
    }
    
}