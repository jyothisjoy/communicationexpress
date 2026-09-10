<?php
/**
* Widget Functions.
*
* @package CommExpress
*/

function comm_express_widgets_init(){

	register_sidebar(array(
	    'name' => esc_html__('Main Sidebar', 'comm-express'),
	    'id' => 'sidebar-1',
	    'description' => esc_html__('Add widgets here.', 'comm-express'),
	    'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h3 class="widget-title"><span>',
	    'after_title' => '</span></h3>',
	));

	register_sidebar(array(
	    'name' => esc_html__('Home Page Sidebar', 'comm-express'),
	    'id' => 'sidebar-2',
	    'description' => esc_html__('Add widgets here.', 'comm-express'),
	    'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h3 class="widget-title"><span>',
	    'after_title' => '</span></h3>',
	));


    $comm_express_default = comm_express_get_default_theme_options();
    $comm_express_footer_column_layout = absint( get_theme_mod( 'comm_express_footer_column_layout',$comm_express_default['comm_express_footer_column_layout'] ) );

    for( $i = 0; $i < $comm_express_footer_column_layout; $i++ ){
    	
    	if( $i == 0 ){ $count = esc_html__('One','comm-express'); }
    	if( $i == 1 ){ $count = esc_html__('Two','comm-express'); }
    	if( $i == 2 ){ $count = esc_html__('Three','comm-express'); }

	    register_sidebar( array(
	        'name' => esc_html__('Footer Widget ', 'comm-express').$count,
	        'id' => 'comm-express-footer-widget-'.$i,
	        'description' => esc_html__('Add widgets here.', 'comm-express'),
	        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	        'after_widget' => '</div>',
	        'before_title' => '<h2 class="widget-title">',
	        'after_title' => '</h2>',
	    ));
	}

}

add_action('widgets_init', 'comm_express_widgets_init');