<?php
/**
* Header Options.
*
* @package CommExpress
*/

$comm_express_default = comm_express_get_default_theme_options();

// Header Section.
$wp_customize->add_section( 'comm_express_social_media_setting',
	array(
	'title'      => esc_html__( 'Social Media Settings', 'comm-express' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
	'panel'      => 'comm_express_theme_option_panel',
	)
);

$wp_customize->add_setting( 'comm_express_footer_layout_facebook_link',
    array(
    'default'           => $comm_express_default['comm_express_footer_layout_facebook_link'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'comm_express_footer_layout_facebook_link',
    array(
    'label'    => esc_html__( 'Facebook Link', 'comm-express' ),
    'section'  => 'comm_express_social_media_setting',
    'type'     => 'url',
    )
);

$wp_customize->add_setting( 'comm_express_footer_layout_twitter_link',
    array(
    'default'           => $comm_express_default['comm_express_footer_layout_twitter_link'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'comm_express_footer_layout_twitter_link',
    array(
    'label'    => esc_html__( 'Twitter Link', 'comm-express' ),
    'section'  => 'comm_express_social_media_setting',
    'type'     => 'url',
    )
);

$wp_customize->add_setting( 'comm_express_footer_layout_pintrest_link',
    array(
    'default'           => $comm_express_default['comm_express_footer_layout_pintrest_link'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'comm_express_footer_layout_pintrest_link',
    array(
    'label'    => esc_html__( 'Pintrest Link', 'comm-express' ),
    'section'  => 'comm_express_social_media_setting',
    'type'     => 'url',
    )
);

$wp_customize->add_setting( 'comm_express_footer_layout_instagram_link',
    array(
    'default'           => $comm_express_default['comm_express_footer_layout_instagram_link'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'comm_express_footer_layout_instagram_link',
    array(
    'label'    => esc_html__( 'Instagram Link', 'comm-express' ),
    'section'  => 'comm_express_social_media_setting',
    'type'     => 'url',
    )
);

$wp_customize->add_setting( 'comm_express_footer_layout_youtube_link',
    array(
    'default'           => $comm_express_default['comm_express_footer_layout_youtube_link'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'comm_express_footer_layout_youtube_link',
    array(
    'label'    => esc_html__( 'Youtube Link', 'comm-express' ),
    'section'  => 'comm_express_social_media_setting',
    'type'     => 'url',
    )
);