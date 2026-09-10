<?php
/**
* Body Classes.
* @package CommExpress
*/
 
 if (!function_exists('comm_express_body_classes')) :

    function comm_express_body_classes($classes) {

        $comm_express_default = comm_express_get_default_theme_options();
        global $post;
        // Adds a class of hfeed to non-singular pages.
        if ( !is_singular() ) {
            $classes[] = 'hfeed';
        }

        // Adds a class of no-sidebar when there is no sidebar present.
        if ( !is_active_sidebar( 'sidebar-1' ) ) {
            $classes[] = 'no-sidebar';
        }

        $comm_express_global_sidebar_layout = esc_html( get_theme_mod( 'comm_express_global_sidebar_layout',$comm_express_default['comm_express_global_sidebar_layout'] ) );

        if ( is_active_sidebar( 'sidebar-1' ) ) {
            if( is_single() || is_page() ){
                $comm_express_post_sidebar = esc_html( get_post_meta( $post->ID, 'comm_express_post_sidebar_option', true ) );
                if (empty($comm_express_post_sidebar) || ($comm_express_post_sidebar == 'global-sidebar')) {
                    $classes[] = esc_attr( $comm_express_global_sidebar_layout );
                } else{
                    $classes[] = esc_attr( $comm_express_post_sidebar );
                }
            }else{
                $classes[] = esc_attr( $comm_express_global_sidebar_layout );
            }
            
        }
        
        return $classes;
    }

endif;

add_filter('body_class', 'comm_express_body_classes');