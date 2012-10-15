<?php
class IvyCatTestimonialsWidget extends WP_Widget {

    public function __construct() {
        $widget_ops = array( 'description' => __( 'Displays testimonial custom post type content in a widget', 'ivycat-ajax-testimonials' ) );
        $this->WP_Widget( 'IvyCatTestimonialsWidget', __( 'IvyCat Testimonial Widget', 'ivycat-ajax-testimonials' ), $widget_ops );
    }
    
    function form( $instance ) {
        
		$fields = array(
			'testimonial_quantity' => array( 'Quantity:', 'text' ),
			'testimonial_num_words' => array( 'Number of Words (leave blank if all)', 'text' ),
			'testimonial_read_more' => array( 'Read More Text', 'text' ),
			'testimonial_ajax_on' => array( 'Disable Ajax', 'checkbox' ),
			'testimonial_show_all' => array( 'Link to all Testimonials (leave blank for no link)', 'text' )
		);			
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
        </p><?php
		foreach ( $fields as $field => $field_atts ):
			$field_id = $this->get_field_id( $field );
			$value = ( 'checkbox' == $field_atts[1] ) ? 'yes' : esc_attr( $instance[$field] );
			$checked = (  'checkbox' == $field_atts[1] && 'yes' == $instance[$field] ) ? ' checked="checked"' : ''; 
			
			printf( '<p><label for="%s">%s</label>
				   <input type="%s" id="%s" name="%s" value="%s"%s/></p>',
				$field_id, $field_atts[0], $field_atts[1], $field_id, $field_id, $value, $checked
			); 
		endforeach;
    }
    
    public function widget( $args, $instance ) {
        
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Testimonials', 'ivycat-ajax-testimonials' ) : $instance['title'], $instance, $this->id_base );
       
        $quantity = ( $instance['testimonial_quantity'] ) ? absint( $instance['testimonial_quantity'] ) : 1;
        $group = ( isset( $instance['testimonial_group'] ) && 'All Groups' !== $instance['testimonial_group'] ) ? $instance['testimonial_group'] : false;
		$atts = array(
			'quantity' => $quantity,
			'group' => $group,
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
        $instance['testimonial_quantity'] = wp_strip_all_tags( $_POST[$widget_id . 'testimonial_quantity'] );
		$instance['testimonial_num_words'] = wp_strip_all_tags( $_POST[$widget_id . 'testimonial_num_words'] );
		$instance['testimonial_read_more'] = wp_strip_all_tags( $_POST[$widget_id . 'testimonial_read_more'] );
		$instance['testimonial_ajax_on'] = wp_strip_all_tags( $_POST[$widget_id . 'testimonial_ajax_on'] );
		$instance['testimonial_show_all'] = wp_strip_all_tags( $_POST[$widget_id . 'testimonial_show_all'] );
        $instance['title'] = wp_strip_all_tags( $new_instance['title'] );
		
        return $instance;
    }
    
}