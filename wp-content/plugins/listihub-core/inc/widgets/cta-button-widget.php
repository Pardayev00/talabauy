<?php

// Control core classes for avoid errors
if ( class_exists( 'CSF' ) ) {

	CSF::createWidget( 'hijobs_cta_button_widget', array(
		'title'       => esc_html__( 'hijobs : CTA Button', 'hijobs-core' ),
		'classname'   => 'ep_cta_button_widget',
		'description' => esc_html__( 'hijobs call to action widget.', 'hijobs-core' ),
		'fields'      => array(

			array(
				'id'    => 'title',
				'type'  => 'text',
				'title' => esc_html__( 'Title', 'hijobs-core' ),
			),

			array(
				'id'           => 'cta_image',
				'type'         => 'media',
				'title'        => esc_html__( 'Image', 'hijobs-core' ),
				'library'      => 'image',
				'url'          => false,
				'button_title' => esc_html__( 'Upload Image', 'hijobs-core' ),

			),

			array(
				'id'      => 'cta_title',
				'type'    => 'textarea',
				'title'   => esc_html__('CTA Title','hijobs-core'),
			),

			array(
				'id'    => 'phone',
				'type'  => 'text',
				'title' => esc_html__( 'Phone Number', 'hijobs-core' ),
			),

			array(
				'id'       => 'enable_overlay',
				'type'     => 'switcher',
				'title'    => esc_html__( 'Enable Overlay', 'hijobs' ),
				'text_on'  => esc_html__( 'Yes', 'hijobs' ),
				'text_off' => esc_html__( 'No', 'hijobs' ),
				'desc'     => esc_html__( 'Enable or disable overlay.', 'hijobs' ),
				'default'  => true
			),

			array(
				'id'          => 'overlay_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Overlay Color', 'hijobs' ),
				'desc'        => esc_html__( 'Select overlay background color.', 'hijobs' ),
				'dependency'  => array( 'enable_overlay', '==', true ),
			),
		)
	) );

	//
	// Front-end display of widget
	// Attention: This function named considering above widget base id.
	//
	if ( ! function_exists( 'hijobs_cta_button_widget' ) ) {
		function hijobs_cta_button_widget( $args, $instance ) {

		    $image_src = $instance['cta_image']['url'];
		    $phone = $instance['phone'];
		    $overlay = $instance['enable_overlay'];
		    $overlay_color = $instance['overlay_color'];

			echo $args['before_widget'];

			if ( ! empty( $instance['title'] ) ) {
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
			} ?>

            <div class="cta-widget-wrapper">
                <div class="cta-widget-content ep-cover-bg" <?php if($image_src) : ?> style="background-image: url('<?php echo esc_url( $image_src ); ?>')" <?php endif;?>>

					<?php if ( ! empty( $instance['cta_title'] ) ) { ?>

                        <h3 class="cta-widget-title">
							<?php echo esc_html( $instance['cta_title'] ); ?>
                        </h3>
					<?php } ?>

					<?php if ( ! empty( $phone ) ) {
						$tel = preg_replace('/\s+/', '', $phone);
					    ?>

                        <a href="tel:<?php echo $tel;?>" class="cta-widget-button ep-primary-bg"><i class="fas fa-phone-volume"></i></a>
                        <div></div>
                        <a href="tel:<?php echo $tel;?>" class="cta-widget-number"><?php echo $phone;?></a>
					<?php } ?>

                    <?php if($overlay == true) : ?>
                    <div class="cta-widget-overlay" <?php if($overlay_color) : ?>style="background-color: <?php echo $overlay_color;?>"<?php endif; ?>></div>
                    <?php endif; ?>
                </div>
            </div>

			<?php
			echo $args['after_widget'];
		}
	}
}