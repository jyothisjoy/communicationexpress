<?php

$comm_express_custom_css = "";

$comm_express_theme_pagination_options_alignment = get_theme_mod('comm_express_theme_pagination_options_alignment', 'Center');
if ($comm_express_theme_pagination_options_alignment == 'Center') {
	$comm_express_custom_css .= '.pagination{';
	$comm_express_custom_css .= 'text-align: center;';
	$comm_express_custom_css .= '}';
} else if ($comm_express_theme_pagination_options_alignment == 'Right') {
	$comm_express_custom_css .= '.pagination{';
	$comm_express_custom_css .= 'text-align: Right;';
	$comm_express_custom_css .= '}';
} else if ($comm_express_theme_pagination_options_alignment == 'Left') {
	$comm_express_custom_css .= '.pagination{';
	$comm_express_custom_css .= 'text-align: Left;';
	$comm_express_custom_css .= '}';
}

$comm_express_theme_breadcrumb_options_alignment = get_theme_mod('comm_express_theme_breadcrumb_options_alignment', 'Left');
if ($comm_express_theme_breadcrumb_options_alignment == 'Center') {
	$comm_express_custom_css .= '.breadcrumbs ul{';
	$comm_express_custom_css .= 'text-align: center !important;';
	$comm_express_custom_css .= '}';
} else if ($comm_express_theme_breadcrumb_options_alignment == 'Right') {
	$comm_express_custom_css .= '.breadcrumbs ul{';
	$comm_express_custom_css .= 'text-align: Right !important;';
	$comm_express_custom_css .= '}';
} else if ($comm_express_theme_breadcrumb_options_alignment == 'Left') {
	$comm_express_custom_css .= '.breadcrumbs ul{';
	$comm_express_custom_css .= 'text-align: Left !important;';
	$comm_express_custom_css .= '}';
}

$comm_express_menu_text_transform =
	get_theme_mod('comm_express_menu_text_transform', 'uppercase');
if
($comm_express_menu_text_transform == 'capitalize') {
	$comm_express_custom_css .= '.site-navigation .primary-menu > li a{';
	$comm_express_custom_css .= 'text-transform: capitalize !important;';
	$comm_express_custom_css .= '}';
} else if
($comm_express_menu_text_transform == 'uppercase') {
	$comm_express_custom_css .= '.site-navigation .primary-menu > li a{';
	$comm_express_custom_css .= 'text-transform: uppercase !important;';
	$comm_express_custom_css .= '}';
} else if
($comm_express_menu_text_transform == 'lowercase') {
	$comm_express_custom_css .= '.site-navigation .primary-menu > li a{';
	$comm_express_custom_css .= 'text-transform: lowercase !important;';
	$comm_express_custom_css .= '}';
}

$comm_express_single_page_content_alignment = get_theme_mod('comm_express_single_page_content_alignment', 'left');
if ($comm_express_single_page_content_alignment == 'left') {
	$comm_express_custom_css .= '#single-page .type-page{';
	$comm_express_custom_css .= 'text-align: left !important;';
	$comm_express_custom_css .= '}';
} else if ($comm_express_single_page_content_alignment == 'center') {
	$comm_express_custom_css .= '#single-page .type-page{';
	$comm_express_custom_css .= 'text-align: center !important;';
	$comm_express_custom_css .= '}';
} else if ($comm_express_single_page_content_alignment == 'right') {
	$comm_express_custom_css .= '#single-page .type-page{';
	$comm_express_custom_css .= 'text-align: right !important;';
	$comm_express_custom_css .= '}';
}