<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package listihub
 */


$post_author = listihub_option('single_post_author', true);
$post_date = listihub_option('single_post_date', true);
$post_comment_number = listihub_option('single_post_cmnt', true);
$post_cat_name = listihub_option('single_post_cat', true);
$post_tag = listihub_option('single_post_tag', true);
$post_share = listihub_option('post_share', true);
$author_details = listihub_option('author_details', false);

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	if ( get_post_format() === 'gallery' ) {
		get_template_part( 'template-parts/post/post-format-gallery' );
	} else if ( get_post_format() === 'video' ) {
		get_template_part( 'template-parts/post/post-format-video' );
	} else if ( get_post_format() === 'audio' ) {
		get_template_part( 'template-parts/post/post-format-audio' );
	} else {
		get_template_part( 'template-parts/post/post-format-others' );
	}
	?>

	<?php if ( 'post' === get_post_type() ) : ?>
        <div class="post-meta post-details-meta">
            <ul class="ep-list-style">
				<?php if ($post_author == true) :?>
                    <li><?php listihub_posted_by(); ?></li>
				<?php endif; ?>

				<?php if ($post_date == true) :?>
                    <li><?php listihub_posted_on(); ?></li>
				<?php endif; ?>

				<?php if ( get_comments_number() != 0 && $post_comment_number == true) : ?>
                    <li class="comment-number"><?php listihub_comment_count(); ?></li>
				<?php endif; ?>

				<?php if ($post_cat_name == true) :?>
                    <li><?php listihub_post_categories(); ?></li>
				<?php endif; ?>
            </ul>
        </div>
	<?php endif; ?>


    <div class="entry-content">
		<?php

		the_title( '<h3 class="post-title single-blog-post-title">', '</h3>' );

		the_content( sprintf(
			wp_kses(
			/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'listihub' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'listihub' ),
			'after'  => '</div>',
		) );
		?>
    </div><!-- .entry-content -->

	<?php if (has_tag() && $post_tag == true) :?>
        <footer class="post-footer">
            <div class="post-tags">
				<?php listihub_post_tags(); ?>
            </div>
        </footer><!-- .entry-footer -->
	<?php endif; ?>

	<?php if ( function_exists( 'listihub_post_share' ) && $post_share == true) {
		listihub_post_share();
	} ?>
</article><!-- #post-<?php the_ID(); ?> -->
