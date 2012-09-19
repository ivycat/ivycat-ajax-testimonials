<?php

/**
 *  Plugin Name: IvyCat AJAX Testimonials
 *  Plugin URI: http://wordpress.org/extend/plugins/ivycat-ajax-testimonials/
 *  Description: Simple plugin for adding dynamic testimonials to your site.
 *  Author: IvyCat Web Services
 *  Author URI: http://www.ivycat.com
 *  version: 1.2
 *  License: GNU General Public License v2.0
 *  License URI: http://www.gnu.org/licenses/gpl-2.0.html
 
 ------------------------------------------------------------------------
	IvyCat AJAX Testimonials, Copyright 2012 IvyCat, Inc. (admins@ivycat.com)
	
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA

 */
define( 'ICTESTI_DIR', dirname( __FILE__ ) );
define( 'ICTESTI_URL', str_replace( ABSPATH, site_url( '/' ), ICTESTI_DIR ) );
require_once 'lib/IvyCatTestimonialsWidget.php';
class IvyCatTestimonials{
    
    public function __construct(){
        add_action( 'init', array( $this, 'post_type_init' ) );
        add_action( 'admin_init' , array( &$this, 'metabox_init' ) );
        add_action( 'save_post' , array( &$this, 'save_testimonial_metadata' ) );
        add_shortcode( 'ic_do_testimonials', array( &$this, 'do_testimonials' ) );
        add_action( 'wp_ajax_get-testimonials',  array( &$this, 'more_testimonials' ) );
        add_action( 'wp_ajax_nopriv_get-testimonials',  array( &$this, 'more_testimonials' ) );
        add_action( 'widgets_init', array( &$this, 'init_widgets' ) );
        wp_enqueue_script( 'ict-ajax-scripts', ICTESTI_URL . '/assets/ivycat_testimonials_scripts.js', array( 'jquery' ) );
        wp_localize_script( 'ict-ajax-scripts', 'ICSaconn', array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'themeurl' => get_bloginfo( 'stylesheet_directory' ).'/',
                'pluginurl' => ICTESTI_URL
            )
        );
    }
    
    public function init_widgets(){
        register_widget( 'IvyCatTestimonialsWidget' );
    }
    
    public function post_type_init(){
        $labels = array(
            'name'=>__( "Testimonials" ),
            'singular_name'=>__( "Testimonial" ),
            'add_new'=>__( 'New Testimonial' ),
            'add_new_item'=>__( 'Add New Testimonial' ),
            'edit_item'=>__( 'Edit Testimonial' ),
            'new_item'=>__( 'Add New Testimonial' ),
            'view_item'=>__( 'View Testimonial' ),
            'search_items'=>__( 'Search Testimonials' )
        );
        
        $supports = array('title','editor');
        
        $args = array(
            'label'=> __( "Testimonials" ),
            'labels'=>$labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true, 
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_position' => 4,
            'supports' => $supports
        );

        register_post_type( 'testimonials' ,$args);
        
        $tax = array("hierarchical" => true,
            "label" => "Testimonial Groups",
            "singular_label" =>"Testimonial Group",
            "rewrite" => array('hierarchical'=>true));
        register_taxonomy( 'testimonial-group', 'testimonials', $tax );
    }
    
    public function metabox_init(){
        add_meta_box(
            'Testimonialinfo-meta',
            'Testimonial Data',
            array( &$this, 'testimonial_metabox' ),
            'testimonials', 'side', 'high'
        );
    }
    
    public function testimonial_metabox(){
        global $post;
        $testimonial_order = get_post_meta( $post->ID, 'ivycat_testimonial_order', true);
        ?>
        <ul>
            <li>
                <label for="test-order">Order: </label>
                <input id="test-order" type="text" name="testimonial_order" value="<?php echo ( $testimonial_order ) ? $testimonial_order : '0'; ?>" />
            </li>
        </ul>
        <?php
    }
    
    public function save_testimonial_metadata(){
        if( defined( 'DOING_AJAX') ) return;
        global $post;
        update_post_meta( $post->ID, 'ivycat_testimonial_order', $_POST['testimonial_order'] );
    }
    
    public function do_testimonials( $atts ){
        $quantity = ( $atts['quantity'] ) ? $atts['quantity'] : 3;
        $testimonial_group = ( $atts['group'] ) ?  $atts['group'] : false;
        $testimonials = self::get_testimonials( 1, $testimonial_group );
        ob_start();
        
        ?>
        <div id="ivycat-testimonial">
            
            <blockquote class="testimonial-content">
                <div class="content"><?php echo $testimonials[0]['testimonial_content'] ?></div>
                <footer>
                    <cite>
                        <?php echo $testimonials[0]['testimonial_title']; ?>
                    </cite>
                </footer>
            </blockquote>
            <input id="testimonial-dets" type="hidden" name="testimonial-dets" value="<?php echo $quantity . '|' . $testimonial_group; ?>">
        </div>
        <?php
        $contents = ob_get_contents();
        ob_clean();
        return $contents;
    }
    
    public function more_testimonials(){
        $dets = explode( '|', $_POST['testimonial-dets'] );
        $group = ( $dets[1] == 'All Groups' ) ? false : $dets[1];
        $testimonials = self::get_testimonials( $dets[0], $group );
        echo json_encode( $testimonials );
        exit;
    }
    
    public function get_testimonials( $quantity , $group ){
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
    
    
} new IvyCatTestimonials();
