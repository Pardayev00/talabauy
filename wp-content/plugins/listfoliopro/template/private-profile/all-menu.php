<?php
	 if ( ! defined( 'ABSPATH' ) ) exit; 
?>
<ul>
	<?php
		$account_menu_check= '';
		if( get_option('epjblistfoliopro_menu_listinghome' ) ) {
			$account_menu_check= get_option('epjblistfoliopro_menu_listinghome');
		}
		if($account_menu_check!='yes'){
		?>
		<li class="">
			<a href="<?php echo get_post_type_archive_link( $listfoliopro_directory_url ) ; ?>">
				<i class="fas fa-home"></i>
			<?php  esc_html_e("Barcha e'lonlar ",'listfoliopro');	 ?> </a>
		</li>
		<?php
		}
	?>
	<?php
		$account_menu_check= '';
		if( get_option('epjblistfoliopro_mylevel' ) ) {
			$account_menu_check= get_option('epjblistfoliopro_mylevel');
		}
		if($account_menu_check!='yes'){
		?>
		<li class="<?php echo ($active=='level'? 'active':''); ?> ">
			<a href="<?php echo get_permalink(); ?>?&profile=level">
				<i class="fas fa-user-clock"></i>
			<?php  esc_html_e("A'zolik",'listfoliopro');	 ?> </a>
		</li>
		<?php
		}
	?>
	
	
	
	<?php
		$account_menu_check= '';
		if( get_option('epjblistfoliopro_menusetting' ) ) {
			$account_menu_check= get_option('epjblistfoliopro_menusetting');
		}
		if($account_menu_check!='yes'){
		?>
		<li class="<?php echo ($active=='setting'? 'active':''); ?> ">
			<a href="<?php echo get_permalink(); ?>?&profile=setting">
				<i class="fas fa-user-cog"></i>
			<?php  esc_html_e('Profilni tahrirlash','listfoliopro');?> </a>
		</li>
		<?php
		}
	?>
	
		
	<?php
		$account_menu_check= '';
		if( get_option('epjblistfoliopro_menuallpost' ) ) {
			$account_menu_check= get_option('epjblistfoliopro_menuallpost');
		}
		if($account_menu_check!='yes'){
		?>
		<li class="<?php echo ($active=='all-post'? 'active':''); ?> ">
			<a href="<?php echo get_permalink(); ?>?&profile=all-post">
				<i class="far fa-copy"></i>
			<?php  esc_html_e("Ro'yxatlarni boshqarish",'listfoliopro');?>  </a>
		</li>
		<?php
		}
	?>	
	<?php
		$account_menu_check= '';
		if( get_option('epjblistfoliopro_messageboard' ) ) {
			$account_menu_check= get_option('epjblistfoliopro_messageboard');
		}
		if($account_menu_check!='yes'){
		?>
		<li class="<?php echo ($active=='messageboard'? 'active':''); ?> ">
		<a href="<?php echo get_permalink(); ?>?&profile=messageboard">
			<i class="far fa-envelope"></i>
		<?php  esc_html_e('Xabar','listfoliopro');?></a>
	</li>
	<?php
		}
	?>
	<?php
		$account_menu_check= '';
		if( get_option('epjblistfoliopro_booking' ) ) {
			$account_menu_check= get_option('epjblistfoliopro_booking');
		}
		if($account_menu_check!='yes'){
		?>
		<li class="<?php echo ($active=='booking'? 'active':''); ?> ">
		<a href="<?php echo get_permalink(); ?>?&profile=booking">
			<i class="fa-regular fa-calendar-days"></i>
		<?php  esc_html_e('Bron qilish buyicha xabarlar','listfoliopro');?></a>
		</li>
	<?php
		}
	?>
	
	<?php
		$account_menu_check= '';
		if( get_option('epjblistfoliopro_notification' ) ) {
			$account_menu_check= get_option('epjblistfoliopro_notification');
		}
		if($account_menu_check!='yes'){
		?>
	<li class="<?php echo ($active=='notification'? 'active':''); ?> ">
		<a href="<?php echo get_permalink(); ?>?&profile=notification">
			<i class="far fa-bell"></i>
		<?php  esc_html_e("Ro'yxat bildirishnomalari",'listfoliopro');?> </a>
	</li>
	<?php
		}
	?>
	
	<?php
		$account_menu_check= '';
		if( get_option('epjblistfoliopro_author_bookmarks' ) ) {
			$account_menu_check= get_option('epjblistfoliopro_author_bookmarks');
		}
		if($account_menu_check!='yes'){ 
		?>
		<li class="<?php echo ($active=='author_bookmarks'? 'active':''); ?> ">
			<a href="<?php echo get_permalink(); ?>?&profile=author_bookmarks">
				<i class="fas fa-user-check"></i>
			<?php   esc_html_e('Saqlangan muallif','listfoliopro');?> </a>
		</li>
		<?php
		}
	?>
	<?php
		$account_menu_check= '';
		if( get_option('epjblistfoliopro_listing_bookmarks' ) ) {
			$account_menu_check= get_option('epjblistfoliopro_listing_bookmarks');
		}
		if($account_menu_check!='yes'){
		?>
		<li class="<?php echo ($active=='listing_bookmark'? 'active':''); ?> ">
			<a href="<?php echo get_permalink(); ?>?&profile=listing_bookmark">
				<i class="fas fa-chalkboard-teacher"></i>
			<?php   esc_html_e("Saqlangan roʻyxat",'listfoliopro');?> </a>
		</li>
		<?php
		}
	?>
	
	
	
	
	<li class="<?php echo ($active=='log-out'? 'active':''); ?> ">
		<a href="<?php echo wp_logout_url( home_url() ); ?>" >
			<i class="fas fa-sign-out-alt"></i>
			<?php  esc_html_e('Tizimdan chiqish','listfoliopro');?>
		</a>
	</li>
</ul>