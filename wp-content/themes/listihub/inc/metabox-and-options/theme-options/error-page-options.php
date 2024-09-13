<?php

CSF::createSection( $listihub_theme_option, array(
	'title'  => esc_html__( 'Error 404', 'listihub' ),
	'id'     => 'archive_page_options',
	'icon'   => 'fa fa-exclamation-triangle',
	'fields' => array(
		array(
			'id'       => 'error_banner',
			'type'     => 'switcher',
			'title'    => esc_html__( 'Enable Error Banner', 'listihub' ),
			'default'  => false,
			'text_on'  => esc_html__( 'Yes', 'listihub' ),
			'text_off' => esc_html__( 'No', 'listihub' ),
			'desc'     => esc_html__( 'Enable or disable error / not found page banner.', 'listihub' ),
		),

		array(
			'id'                    => 'error_banner_background_options',
			'type'                  => 'background',
			'title'                 => esc_html__( 'Banner Background', 'listihub' ),
			'background_gradient'   => true,
			'background_origin'     => false,
			'background_clip'       => false,
			'background_blend-mode' => false,
			'background_attachment' => false,
			'background_size'       => false,
			'background_position'   => false,
			'background_repeat'     => false,
			'dependency'            => array( 'error_banner', '==', true ),
			'output'                => '.banner-area.error-page-banner',
			'desc'                  => esc_html__( 'If you want different banner background settings for error / not found page then select error / not found page banner background options from here.', 'listihub' ),
		),

		array(
			'id'         => 'error_page_title',
			'type'       => 'text',
			'title'      => esc_html__( 'Error Banner Title', 'listihub' ),
			'desc'       => esc_html__( 'Type error banner title here.', 'listihub' ),
			'dependency' => array( 'error_banner', '==', true ),
		),

		array(
			'id'           => 'error_image',
			'type'         => 'media',
			'title'        => esc_html__( 'Error Image', 'listihub' ),
			'library'      => 'image',
			'url'          => false,
			'button_title' => esc_html__( 'Upload Image', 'listihub' ),
			'desc'         => esc_html__( 'Upload error image', 'listihub' ),

		),

		array(
			'id'            => 'not_found_text',
			'type'          => 'wp_editor',
			'title'         => esc_html__( 'Not Found Text', 'listihub' ),
			'tinymce'       => true,
			'quicktags'     => true,
			'media_buttons' => false,
			'height'        => '150px',
			'desc'          => esc_html__( 'Type not found text here.', 'listihub' ),
		),

		array(
			'id'       => 'go_back_home',
			'type'     => 'switcher',
			'title'    => esc_html__( 'Enable Go Back Home Button', 'listihub' ),
			'text_on'  => esc_html__( 'Yes', 'listihub' ),
			'text_off' => esc_html__( 'No', 'listihub' ),
			'desc'     => esc_html__( 'Enable or disable go back home button.', 'listihub' ),
			'default'  => true
		),
	)
) );