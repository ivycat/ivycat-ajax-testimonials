jQuery( 'document' ).ready( function( $ ){
    var ic_ajax_testimonials = function ( ) {
        var featured_posts = false,
            play;
        
        jQuery.ivycat_ajax_do = function( ajaxData, callback ){
            return $.post( ICSaconn.ajaxurl, ajaxData, callback );       
        }
       
        if( jQuery( '#ivycat-testimonial' ).length ){
            testimonial_start = 1;
             jQuery.ivycat_ajax_do( { 'action' : 'get-testimonials', 'testimonial-dets' : jQuery( '#testimonial-dets' ).val() }, function( resp ){
                testimonials = $.parseJSON( resp );
                //console.log( testimonials );
            });
             
            function advance_slideshow(){
                //console.log( posts );
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
                
                jQuery( '#ivycat-testimonial' ).customFadeOut( 1000, function(){
                    jQuery( '#ivycat-testimonial cite' ).html( testimonials[current].testimonial_title  );
                    jQuery( '#ivycat-testimonial div.content' ).html( testimonials[current].testimonial_content  );
                    jQuery( '#ivycat-testimonial' ).customFadeIn( 1000, function(){});
                }); 
            }
            
            rotateSwitch = function( ){
                play = setInterval(function( ){ //Set timer - this will repeat itself every 8 seconds
                    if( typeof( testimonials ) !== 'undefined' ) advance_slideshow();
                }, 8000); //Timer speed in milliseconds (8 seconds)
            };
            
             rotateSwitch(  );
            
            jQuery('#ivycat-testimonial').hover( function() {
                clearInterval(play);
            }, function() {
                advance_slideshow();
                rotateSwitch();
            } );
        }
        
        function testimonial_length(){
                var count = 0;
                jQuery.each( testimonials, function(){ count +=1; });
                return count;
            };
        
        //alert($.browser.version);
        jQuery.fn.customFadeIn = function(speed, callback) {
            $(this).fadeIn(speed, function() {
                if(jQuery.browser.msie)
                    jQuery(this).get(0).style.removeAttribute('filter');
                if(callback != undefined)
                    callback();
            });
        };
        jQuery.fn.customFadeOut = function(speed, callback) {
            jQuery(this).fadeOut(speed, function() {
                if(jQuery.browser.msie)
                    jQuery(this).get(0).style.removeAttribute('filter');
                if(callback != undefined)
                    callback();
            });
        };
    }
    ic_ajax_testimonials( );
});