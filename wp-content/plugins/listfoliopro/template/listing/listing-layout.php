<?php
	 if ( ! defined( 'ABSPATH' ) ) exit; 
	get_header(); 
$listfoliopro_archive_layout=get_option('listfoliopro_archive_layout');
if($listfoliopro_archive_layout==""){$listfoliopro_archive_layout='archive-left-map';}
if($listfoliopro_archive_layout=='archive-left-map'){
	echo do_shortcode('[listfoliopro_archive_grid]');
}elseif($listfoliopro_archive_layout=='archive-top-map'){
	echo do_shortcode('[listfoliopro_archive_grid_top_map]');
}elseif($listfoliopro_archive_layout=='archive-no-map'){
	echo do_shortcode('[listfoliopro_archive_grid_no_map]');
}else{
	echo do_shortcode('[listfoliopro_archive_grid]');
}	
get_footer();
 ?>
