jQuery( 'document' ).ready( function( $ ){
	( function ( ) {
		var featured_posts = false,
			testimonials = {},
			play;

		jQuery.ivycat_ajax_do = function( ajaxData, callback ){
			return $.post( ICTaconn.ajaxurl, ajaxData, callback );
		};

		if( typeof( ICTaconn ) !== 'undefined' ){
			testimonial_start = 1;
			jQuery.ivycat_ajax_do( {
					'action' : 'get-testimonials',
					'ict_quantity' : ICTaconn.ict_quantity,
					'ict_group' : ICTaconn.ict_group,
					'num_words' : ICTaconn.num_words,
					'more_tag' : ICTaconn.more_tag,
					'all_title' : ICTaconn.all_title,
					'all_url' : ICTaconn.all_url,
					'link_testimonials' : ICTaconn.link_testimonials
				}, function( resp ){
				testimonials = $.parseJSON( resp );
				//console.log( testimonials );
			});

			advance_slideshow = function (){
				//console.log( posts );
				var testimonial_cite;
				var total = testimonial_length();
				if( total < 2 ) return;

				var current = testimonial_start;

				var next = current+1;
				if( total == next ){
					testimonial_start = 0;
					next = 0;
				}else{
					testimonial_start = current +1;
				}

				if( ICTaconn.link_testimonials ){
					testimonial_cite = '<a href="' + testimonials[current].testimonial_link+ '">' + testimonials[current].testimonial_title + '</a>';
				}else{
					testimonial_cite = testimonials[current].testimonial_title;
				}

				jQuery( '#ivycat-testimonial blockquote' ).customFadeOut( parseInt( ICTaconn.fade_out, 10 ), function(){
				jQuery( '#ivycat-testimonial cite' ).html( testimonial_cite );
				jQuery( '#ivycat-testimonial div.ict-content' ).html( testimonials[current].testimonial_content  );
				jQuery( '#ivycat-testimonial blockquote' ).customFadeIn( parseInt( ICTaconn.fade_in, 10 ), function(){});
				});
			};

			rotateSwitch = function( ){
				play = setInterval(function( ){ //Set timer - this will repeat itself every 8 seconds
					if( typeof( ICTaconn ) !== 'undefined' ) advance_slideshow();
				}, ICTaconn.speed); //Timer speed in milliseconds (8 seconds)
			};

			rotateSwitch(  );

			jQuery('#ivycat-testimonial').hover( function() {
				clearInterval(play);
			}, function() {
				if( typeof ICTaconn !== 'undefined' ){
					advance_slideshow();
				}
				rotateSwitch();
			} );
		}

		function testimonial_length(){
			var count = 0;
			jQuery.each( testimonials, function(){ count +=1; });
			return count;
		}

		//alert($.browser.version);
		jQuery.fn.customFadeIn = function(speed, callback) {
			$(this).fadeIn(speed, function() {
				if(jQuery.browser.msie)
					jQuery(this).get(0).style.removeAttribute('filter');
				if(callback !== undefined)
					callback();
			});
		};
		jQuery.fn.customFadeOut = function(speed, callback) {
			jQuery(this).fadeOut(speed, function() {
				if(jQuery.browser.msie)
					jQuery(this).get(0).style.removeAttribute('filter');
				if(callback !== undefined)
					callback();
			});
		};
	})();
});
