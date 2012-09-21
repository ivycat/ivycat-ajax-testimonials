<?php
class IvyCatTestimonialsWidget extends WP_Widget {

    public function __construct() {
        $widget_ops = array( 'description' => __( 'Displays testimonial custom post type content in a widget', 'ivycat-ajax-testimonials' ) );
        $this->WP_Widget( 'IvyCatTestimonialsWidget', __( 'IvyCat Testimonial Widget', 'ivycat-ajax-testimonials' ), $widget_ops );
    }
    
    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array(
            'testimonial_group'    => false,
            'testimonial_quantity' => '',
            'title' => ''
        ) );
        
        $title = wp_strip_all_tags( $instance['title'] );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" id="<?php echo $this->get_field_id( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'testimonial_group' ); ?>"><?php _e( 'Testimonial Group to Display:', 'ivycat-ajax-testimonials' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'testimonial_group' ); ?>" id="<?php echo $this->get_field_id( 'testimonial_group' ); ?>" class="widefat">
                <option><?php _e( 'All Groups', 'ivycat-ajax-testimonials' ); ?></option>
                <?php
                $cats = get_terms( 'testimonial-group', array( 'hide_empty' => 0 ) );
                foreach( $cats as $cat ) :
                    printf( '<option value="%s"%s">%s</option>',
                        $cat->slug,
                        selected( $instance['testimonial_group'], $cat->slug, false ),
                        $cat->name
                    );
                endforeach;
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'testimonial_quantity' ); ?>"><?php _e( 'Quantity:', 'ivycat-ajax-testimonials' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'testimonial_quantity' ); ?>" id="<?php echo $this->get_field_id( 'testimonial_quantity' ); ?>" value="<?php echo esc_attr( $instance['testimonial_quantity'] ); ?>" class="small-text">
        </p>
        <?php
    }
    
    public function widget( $args, $instance ) {
        extract($args);
        
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Testimonials', 'ivycat-ajax-testimonials' ) : $instance['title'], $instance, $this->id_base );
        
        $quantity = ( $instance['testimonial_quantity'] ) ? absint( $instance['testimonial_quantity'] ) : 1;
        $group = ( isset( $instance['testimonial_group'] ) && 'All Groups' !== $instance['testimonial_group'] ) ? $instance['testimonial_group'] : false;
        $testimonials = IvyCatTestimonials::get_testimonials( 1, $group );
        ?>
        <article class="widget widget-text">
            <?php echo $before_title . $title . $after_title; ?>
            
            <div id="ivycat-testimonial" class="container">
                <blockquote class="testimonial-content">
                    <div class="content"><?php echo $testimonials[0]['testimonial_content']; ?></div>
                    <footer>
                        <cite>
                            <?php echo $testimonials[0]['testimonial_title']; ?>
                        </cite>
                    </footer>
                </blockquote>
                <input id="testimonial-dets" type="hidden" name="testimonial-dets" value="<?php echo $quantity . '|' . $instance['testimonial_group']; ?>">
            </div>
        </article>
        <?php
        
        wp_enqueue_script( 'ict-ajax-scripts' );
    }
    
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        
        $instance['testimonial_group'] = wp_strip_all_tags( $new_instance['testimonial_group'] );
        $instance['testimonial_quantity'] = absint( $new_instance['testimonial_quantity'] );
        $instance['title'] = wp_strip_all_tags( $new_instance['title'] );
        
        return $instance;
    }
    
}