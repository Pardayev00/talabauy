<?php

// Create banner options
CSF::createSection( $listihub_theme_option, array(
	'title'  => esc_html__( 'Banner Options', 'listihub' ),
	'id'     => 'banner_default_options',
	'icon'   => 'fa fa-flag-o',
	'fields' => array(

		array(
			'id'                    => 'banner_default_background',
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
			'output'                => '.banner-area',
			'desc'                  => esc_html__( 'Select banner background color and image. You can change this settings on individual page / post.', 'listihub' ),
		),

		array(
			'id'      => 'banner_default_text_align',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Banner Text Align', 'listihub' ),
			'options' => array(
				'start'   => esc_html__( 'Left', 'listihub' ),
				'center' => esc_html__( 'Center', 'listihub' ),
				'end'  => esc_html__( 'Right', 'listihub' ),
			),
			'default' => 'center',
			'desc'    => esc_html__( 'Select banner text align. You can change this settings on individual page / post.', 'listihub' ),
		),

		array(
			'id'      => 'hide_banner_title',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Hide Banner Title', 'listihub' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'listihub' ),
				'no'  => esc_html__( 'No', 'listihub' ),
			),
			'default' => 'no',
			'desc'    => esc_html__( 'Hide banner title. You can change this settings on individual page / post.', 'listihub' ),
		),

		array(
			'id'      => 'hide_banner_breadcrumb',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Hide Banner Breadcrumb', 'listihub' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'listihub' ),
				'no'  => esc_html__( 'No', 'listihub' ),
			),
			'default' => 'no',
			'desc'    => esc_html__( 'Hide banner breadcrumb. You can change this settings on individual page / post.', 'listihub' ),
		),

		array(
			'id'            => 'banner_default_height',
			'type'          => 'dimensions',
			'title'         => esc_html__( 'Banner Height', 'listihub' ),
			'output'        => '.banner-area',
			'width'         => false,
			'height'        => true,
			'desc'          => esc_html__( 'Select banner height. You can change this settings on individual page / post.', 'listihub' ),
		),
	)
) );