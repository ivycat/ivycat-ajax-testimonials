<?php

class IvyCatTestimonialsWidget extends WP_Widget{

    public function __construct(){
        $widget_ops = array('description' => __('Displays testimonial custom post type content in a widget', 'ivycat-testimonial-widget'));
		parent::WP_Widget('IvyCatTestimonialsWidget', __('IvyCat Testimonial Widget', 'ivycat-testimonial-widget'), $widget_ops);
    }
    
    function form( $instance ) {
		$testimonial_group = esc_attr( $instance['testimonial_group'] );
        $testimonial_quantity = esc_attr( $instance['testimonial_quantity'] );
        ?>
		<p>
			<label for="<?php echo $this->get_field_id('IvyCatTestimonialsWidget'); ?>"> <?php echo __('Testimonial Group to Display:', 'ivycat-testimonial-widget') ?>
				<select class="widefat" id="<?php echo $this->get_field_id('IvyCatTestimonialsWidget'); ?>" name="<?php echo $this->get_field_name('testimonial_group'); ?>">
				<option>All Groups</option>
                <?php $cats = get_terms( 'testimonial-group', array( "hide_empty"=>0) );
                foreach( $cats as $cat ):
                    $current = ( $testimonial_group == $cat->slug ) ? ' selected="selected"' : '';
                    echo '<option value="'.$cat->slug.'"'.$current.'>'. $cat->name.'</option>';
                endforeach; ?>
				</select>
			</label>
            <label>Quantity: <input type="text" value="<?php echo $testimonial_quantity; ?>" name="<?php echo $this->get_field_name('testimonial_quantity'); ?>"/></label>
		</p>
		
		<input type="hidden" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $widgetExtraTitle; ?>" />
		<?php //wp_reset_query(); 
	}
    
    public function widget( $args, $instance ){
        extract($args);
        $quantity = ( $instance['testimonial_quantity'] ) ? $instance['testimonial_quantity']  : 1 ;
        $testimonials = self::get_testimonials( 1, $instance['testimonial_group'] );
        ?>
        <article class="widget widget-text">
            <h3>Testimonials</h3>
            <div id="ivycat-testimonial" class="container">
                <blockquote class="testimonial-content">
                    <div class="content"><?php echo $testimonials[0]['testimonial_content'] ?></div>
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
    }
    
    public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['testimonial_group'] = strip_tags( $new_instance['testimonial_group'] );
        $instance['testimonial_quantity'] = strip_tags( $new_instance['testimonial_quantity'] );
		return $instance;
	}
    
    protected function get_testimonials( $quantity, $group ){
         $args = array(
                "post_type" => "testimonials",
                "orderby" => 'meta_value_num',
                'meta_key' => 'ivycat_testimonial_order',
                'order' => 'DESC',
                "posts_per_page" => $quantity,
            );
        if( $group ){
            $args["tax_query"] = array(
                array(
                    "taxonomy" => "testimonial-group",
                    "field" => "slug",
                    "terms" => $group
                )
            );
        }
        $testimonials = new WP_Query( $args );
        wp_reset_postdata();
        $testimonial_data = array();
        foreach( $testimonials->posts as $row ){
            $testimonial_data[] = array(
                "testimonial_id" => $row->ID,
                "testimonial_title" => $row->post_title,
                "testimonial_content" => $row->post_content
            );
        }
        return $testimonial_data;
    }
}