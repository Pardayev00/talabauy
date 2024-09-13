<?php
 if ( ! defined( 'ABSPATH' ) ) exit; 
?>
<ul>
	<?php
	$tag_array= wp_get_object_terms( $listingid,  $listfoliopro_directory_url.'-tag');
	$i=0;
	foreach($tag_array as $one_tag){
		?>
        <li>
            <a href="<?php echo get_tag_link($one_tag->term_id); ?>">
				<?php
				$tag_image = get_term_meta($one_tag->term_id, 'listfoliopro_term_image', true);
				if (!empty($tag_image)) : ?>
                    <img src="<?php echo $tag_image;?>" alt="tag-image">
				<?php endif; ?>
				<?php echo esc_attr($one_tag->name); ?>
            </a>
        </li>
		<?php
		$i++;
	}
	?>
</ul>

