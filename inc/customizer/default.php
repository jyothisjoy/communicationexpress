<?php
/**
 * Default Values.
 *
 * @package CommExpress
 */

if ( ! function_exists( 'comm_express_get_default_theme_options' ) ) :
	function comm_express_get_default_theme_options() {

		$comm_express_defaults = array();
		
        // Options.
        $comm_express_defaults['logo_width_range']                                                      = 300;
	$comm_express_defaults['comm_express_global_sidebar_layout']	                  = 'right-sidebar';
        $comm_express_defaults['comm_express_header_search']                                  = 0;
        $comm_express_defaults['comm_express_display_header_toggle']                          = 0;
        $comm_express_defaults['comm_express_theme_pagination_options_alignment']             = 'Center';
        $comm_express_defaults['comm_express_theme_breadcrumb_options_alignment']             = 'Left';
        $comm_express_defaults['comm_express_pagination_layout']                              = 'numeric';
        $comm_express_defaults['comm_express_menu_text_transform']                            = 'uppercase';
        $comm_express_defaults['comm_express_single_page_content_alignment']                  = 'left';
        $comm_express_defaults['comm_express_footer_column_layout'] 		            = 3;
        $comm_express_defaults['comm_express_menu_font_size']                                 = 12;
        $comm_express_defaults['comm_express_copyright_font_size']                            = 16;
        $comm_express_defaults['comm_express_breadcrumb_font_size']                           = 16;
        $comm_express_defaults['comm_express_excerpt_limit']                                  = 10;
        $comm_express_defaults['comm_express_per_columns']                                    = 3;
        $comm_express_defaults['comm_express_product_per_page']                               = 9;
        $comm_express_defaults['comm_express_footer_copyright_text'] 		          = esc_html__( 'All rights reserved.', 'comm-express' );
        $comm_express_defaults['twp_navigation_type']              			                  = 'theme-normal-navigation';
        $comm_express_defaults['comm_express_post_author']                	                  = 1;
        $comm_express_defaults['comm_express_post_date']                		          = 1;
        $comm_express_defaults['comm_express_post_category']                	          = 1;
        $comm_express_defaults['comm_express_post_tags']                		          = 1;
        $comm_express_defaults['comm_express_floating_next_previous_nav']                     = 1;
        $comm_express_defaults['comm_express_category_section']                               = 0;
        $comm_express_defaults['comm_express_courses_category_section']                       = 0;
        $comm_express_defaults['comm_express_sticky']                                         = 0;
        $comm_express_defaults['comm_express_background_color']                               = '#fff';

        // Social Icon
        $comm_express_defaults['comm_express_footer_layout_facebook_link']              = esc_url( '#', 'kindergarten-toys' );
        $comm_express_defaults['comm_express_footer_layout_twitter_link']               = esc_url( '#', 'kindergarten-toys' );
        $comm_express_defaults['comm_express_footer_layout_pintrest_link']              = esc_url( '#', 'kindergarten-toys' );
        $comm_express_defaults['comm_express_footer_layout_instagram_link']             = esc_url( '#', 'kindergarten-toys' );
        $comm_express_defaults['comm_express_footer_layout_youtube_link']               = esc_url( '#', 'kindergarten-toys' );

        //slider
        $comm_express_defaults['comm_express_header_slider']                                  = 0;
        $comm_express_defaults['comm_express_header_phone_number']                            = esc_html__( '+91123456789', 'comm-express' );
        $comm_express_defaults['comm_express_header_email_id']                                = esc_html__( 'digi@example.com', 'comm-express' );
        $comm_express_defaults['comm_express_header_location']                                = esc_html__( '775 Rolling Green Rd.', 'comm-express' );
        $comm_express_defaults['comm_express_banner_background_image']                        = esc_url(get_template_directory_uri() . '/assets/images/slide-bg.png');

        // Courses Section
        $comm_express_defaults['comm_express_header_case_studies']                                        = 0;
        $comm_express_defaults['comm_express_team_section_subtitle']                          = esc_html__( 'Our Case Studies', 'comm-express' );
        $comm_express_defaults['comm_express_team_section_title']                             = esc_html__( 'We provide most popular repair services', 'comm-express' );
        
        
	// Pass through filter.
	$comm_express_defaults = apply_filters( 'comm_express_filter_default_theme_options', $comm_express_defaults );

		return $comm_express_defaults;
	}
endif;
