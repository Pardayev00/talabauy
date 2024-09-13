<?php
	 if ( ! defined( 'ABSPATH' ) ) exit;
	wp_enqueue_style('flexslider', listfoliopro_ep_URLPATH . 'admin/files/css/flexslider.css');
	wp_enqueue_style('slickslider', listfoliopro_ep_URLPATH . 'admin/files/css/slick/slick.css');

    $gallery_ids=get_post_meta($listingid ,'image_gallery_ids',true);
    $gallery_ids_array = array_filter(explode(",", $gallery_ids));
?>

    <div id="listfoliopro-listing-details-slider" class="listfoliopro-listing-details-slider">
        <?php
        foreach($gallery_ids_array as $slide){
	        if($slide!=''){ ?>
                <div class="listfoliopro-listing-details-slider-item" style="background-image: url(<?php echo esc_url(wp_get_attachment_url( $slide )); ?>)"></div>
		        <?php
	        }
        }
        ?>
    </div>

    <div id="listfoliopro-listing-slider-nav" class="listfoliopro-listing-slider-nav">
		<?php
		foreach($gallery_ids_array as $slide){
			if($slide!=''){ ?>
                <div class="listfoliopro-listing-slider-nav-item" style="background-image: url(<?php echo esc_url(wp_get_attachment_url( $slide )); ?>)"></div>
				<?php
			}
		}
		?>
    </div>
    <div class="gallery-slider-progress" role="progressbar" aria-valuemin="0" aria-valuemax="100">
        <span class="gallery_slider_label screen-reader-text"></span>
    </div>





<?php
wp_enqueue_script('jquery.slickslider', listfoliopro_ep_URLPATH . 'admin/files/css/slick/slick.min.js');
wp_enqueue_script('jquery.flexslider', listfoliopro_ep_URLPATH . 'admin/files/js/jquery.flexslider.js');
wp_enqueue_script('jquery.easing', listfoliopro_ep_URLPATH . 'admin/files/js/jquery.easing.js"');
wp_enqueue_script('jquery.mousewheel', listfoliopro_ep_URLPATH . 'admin/files/js/jquery.mousewheel.js"');
wp_enqueue_script('listfoliopro-single-listing-flexslider', listfoliopro_ep_URLPATH . 'admin/files/js/flexslider-single-listing.js"');
?>