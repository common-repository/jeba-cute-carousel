<?php
/*
Plugin Name: Jeba Cute Carousel 
Plugin URI: http://prowpexpert.com/jeba-cute-carousel/
Description: This is Jeba cute wordpress Carousel plugin really looking awesome sliding. Everyone can use the cute Carousel plugin easily like other wordpress plugin. Here everyone can slide image from post, page or other custom post. Also can use different style slide by using id="" jeba1, jeba2, jeba3 and jeba4. By using [jeba_Carousel] shortcode use the Carousel every where post, page and template.
Author: Md Jahed
Version: 1.0
Author URI: http://prowpexpert.com/
*/
function jebas_wp_latest_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'jebas_wp_latest_jquery');
function plugin_function_jeba_carousel() {
    wp_enqueue_script( 'jeba-carousel-js', plugins_url( '/js/jquery.flexisel.js', __FILE__ ), true);
    wp_enqueue_style( 'jeba-carousel-css', plugins_url( '/js/style_carousel.css', __FILE__ ));
}
add_action('init','plugin_function_jeba_carousel');
function jeba_script_function_carousel() {?>
	<script type="text/javascript">
jQuery(window).load(function() {
    jQuery("#jeba1").flexisel();
    jQuery("#jeba2").flexisel({
        enableResponsiveBreakpoints: true,
        responsiveBreakpoints: { 
            portrait: { 
                changePoint:480,
                visibleItems: 1
            }, 
            landscape: { 
                changePoint:640,
                visibleItems: 2
            },
            tablet: { 
                changePoint:768,
                visibleItems: 3
            }
        }
    });

    jQuery("#jeba3").flexisel({
        visibleItems: 5,
        animationSpeed: 1000,
        autoPlay: true,
        autoPlaySpeed: 3000,            
        pauseOnHover: true,
        enableResponsiveBreakpoints: true,
        responsiveBreakpoints: { 
            portrait: { 
                changePoint:480,
                visibleItems: 1
            }, 
            landscape: { 
                changePoint:640,
                visibleItems: 2
            },
            tablet: { 
                changePoint:768,
                visibleItems: 3
            }
        }
    });

    jQuery("#jeba4").flexisel({
        clone:false
    });
    
});
</script>
<?php
}
add_action('wp_footer','jeba_script_function_carousel');
function jeba_carousel_shortcode_carousel($atts){
	extract( shortcode_atts( array(
		'id' => 'jeba3',
		'post_type' => 'jeba-carousel',
		'count' => '6',
	), $atts) );
	
    $q = new WP_Query(
        array('posts_per_page' => $count, 'post_type' => $post_type)
        );		
	$list = '   
	<ul id="'.$id.'">
	';
	while($q->have_posts()) : $q->the_post();
		$idd = get_the_ID();
		$link = get_post_meta($idd, 'link', true);
		$jeba_img_thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumb-carousel' );
		
		$list .= '
			<li><a href="'.$link.'"><img src="'.$jeba_img_thumb[0].'"/></a></li>

		';        
	endwhile;
	$list.= '
	
	</ul>
	
	';
	wp_reset_query();
	return $list;
}
add_shortcode('jeba_carousel', 'jeba_carousel_shortcode_carousel');
add_action( 'init', 'jeba_siler_custom_post_carousel' );
function jeba_siler_custom_post_carousel() {

	register_post_type( 'jeba-carousel',
		array(
			'labels' => array(
				'name' => __( 'JebaCarousels' ),
				'singular_name' => __( 'JebaCarousel' )
			),
			'public' => true,
			'supports' => array('title', 'thumbnail', 'custom-fields'),
			'has_archive' => true,
			'rewrite' => array('slug' => 'jeba-Carousel'),
		)
	);	
	}
function jeba_add_mce_button_carousel() {
if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
return;
}
if ( 'true' == get_user_option( 'rich_editing' ) ) {
add_filter( 'mce_external_plugins', 'jeba_add_cutemce_plugin_carousel' );
add_filter( 'mce_buttons', 'jeba_register_mce_button_carousel' );
}
}
add_action('admin_head', 'jeba_add_mce_button_carousel');
function jeba_add_cutemce_plugin_carousel( $plugin_array ) {
$plugin_array['jeba_carousel_button_carousel'] = plugins_url('/js/cutemce-button.js', __FILE__ );
return $plugin_array;
}
function jeba_register_mce_button_carousel( $buttons ) {
array_push( $buttons, 'jeba_carousel_button_carousel' );
return $buttons;
}
add_theme_support( 'post-thumbnails', array( 'post', 'jeba-carousel' ) );
add_image_size( 'thumb-carousel', 100, 50, true );
?>