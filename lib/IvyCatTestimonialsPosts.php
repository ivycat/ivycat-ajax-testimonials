<?php
/**
	 *	Page Posts Class, main workhorse for the ic_add_testimonials shortcode.
	 */

if ( ! function_exists( 'add_action' ) ) {
	wp_die( __( 'You are trying to access this file in a manner not allowed.', 'ivycat-ajax-testimonials' ), __( 'Direct Access Forbidden', 'ivycat-ajax-testimonials' ), array( 'response' => '403' ) );
}

class ICTestimonialPosts {

	protected $args = array(
		'post_type'		=> 'testimonials',
		'post_status'		=> 'publish',
		'orderby'		=> 'date',
		'order'			=> 'DESC',
		'paginate'		=> false,
		'template'		=> false,
	); // set defaults for wp_parse_args

	public function __construct( $atts ) {
		self::set_args( $atts );
	}

	/**
	 *	Output's the testimonials
	 *
	 *	@return string output of template file
	 */
	public function output_testimonials() {
		if ( ! $this->args ) {
					return '';
		}
		$page_testimonials = apply_filters( 'testimonials_in_page_results', new WP_Query( $this->args ) ); // New WP_Query object
		$output = '';
		if ( $page_testimonials->have_posts( ) ):
			while ( $page_testimonials->have_posts( ) ):
			$output .= self::add_template_part( $page_testimonials );
			endwhile;
			$output .= ( $this->args['paginate'] ) ? '<div class="pip-nav">' . apply_filters( 'testimonials_in_page_paginate',
				$this->paginate_links( $page_testimonials )
			) . '</div>' : '';
		endif;
		wp_reset_postdata( );

		// remove our filters for excerpt more and length
		remove_filter( 'excerpt_more', array( 'IvyCatTestimonials', 'ivycat_custom_excerpt_more' ) );
		remove_filter( 'excerpt_length', array( 'IvyCatTestimonials', 'ivycat_custom_excerpt_length' ) );

		return $output;
	}

	protected function paginate_links( $posts ) {
		global $wp_query;
		$page_url = home_url( '/' . $wp_query->post->post_name . '/' );
		$page = isset( $_GET['page'] ) ? $_GET['page'] : 1;
		$total_pages = $posts->max_num_pages;
		$per_page = $posts->query_vars['posts_per_page'];
		$curr_page = ( isset( $posts->query_vars['paged'] ) && $posts->query_vars['paged'] > 0 ) ? $posts->query_vars['paged'] : 1;
		$prev = ( $curr_page && $curr_page > 1 ) ? '<li><a href="' . $page_url . '?page=' . ( $curr_page - 1 ) . '">Previous</a></li>' : '';
		$next = ( $curr_page && $curr_page < $total_pages ) ? '<li><a href="' . $page_url . '?page=' . ( $curr_page + 1 ) . '">Next</a></li>' : '';
		return '<ul>' . $prev . $next . '</ul>';
	}

	/**
	 *	Build additional Arguments for the WP_Query object
	 *
	 *	@param array $atts Attritubes for building the $args array.
	 */
	protected function set_args( $atts ) {
		global $wp_query;
		$this->args['posts_per_page'] = get_option( 'posts_per_page' );
		// parse the arguments using the defaults
		$this->args = wp_parse_args( $atts, $this->args );

		// Use a specified template
		if ( isset( $atts['template'] ) ) {
			$this->args['template'] = $atts['template'];
		}

		// show number of posts (default is 10, showposts or posts_per_page are both valid, only one is needed)
		if ( isset( $atts['showposts'] ) ) {
			$this->args['posts_per_page'] = $atts['showposts'];
		}

		// handle pagination (for code, template pagination is in the template)
		if ( isset( $wp_query->query_vars['page'] ) && $wp_query->query_vars['page'] > 1 ) {
			$this->args['paged'] = $wp_query->query_vars['page'];
		}
		if ( false !== $atts['group'] ) {
			$this->args['tax_query'] = array(
					array(
					'taxonomy' => 'testimonial-group',
					'field' => is_numeric( $atts['group'] ) ? 'id' : 'slug',
					'terms' => $atts['group'],
				)
			);
		}
		$this->args = apply_filters( 'testimonials_in_page_args', $this->args );
	}

	/**
	 *	Tests if a theme has a theme template file that exists
	 *
	 *	@return string|false if template exists, false otherwise.
	 */
	protected function has_theme_template( ) {
		$template_file = ( $this->args['template'] )
			? get_stylesheet_directory( ) . '/' . $this->args['template'] // use specified template file
			: get_stylesheet_directory( ) . '/testimonials-loop-template.php'; // use default template file
		return ( file_exists( $template_file ) ) ? $template_file : false;
	}

	/**
	 *	Retrieves the post loop template and returns the output
	 *
	 *	@return string results of the output
	 */
   protected function add_template_part( $ic_testimonials, $singles = false ) {
		if ( $singles ) {
			setup_postdata( $ic_testimonials );
		} else {
			$ic_testimonials->the_post( );
		}
		$output = '';
		ob_start( );
		$output .= apply_filters( 'testimonials_in_page_pre_loop', '' );
		require ( $file_path = self::has_theme_template( ) )
			? $file_path // use template file in theme
			: ICTESTI_DIR . '/testimonials-loop-template.php'; // use default plugin template file
		$output .= ob_get_contents( );
		$output .= apply_filters( 'testimonials_in_page_post_loop', '' );
		return ob_get_clean( );
   }

}
