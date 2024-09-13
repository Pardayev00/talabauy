<div id="update_message"> </div>		 
<form class="form-horizontal listfoliopro-general-settings" role="form"  name='directory_settings' id='directory_settings'>
	<?php
		$listfoliopro_archive_layout=get_option('listfoliopro_archive_layout');
		if($listfoliopro_archive_layout==""){$listfoliopro_archive_layout='archive-left-map';}
	?>
	<div class="form-group row">
		<label  class="col-md-3 control-label"> <?php esc_html_e('Default All Listing Page Layout','listfoliopro');  ?></label>
		<div class="col-md-2">
			<label>												
				<input type="radio" name="listfoliopro_archive_layout" id="listfoliopro_archive_layout" value='archive-left-map' <?php echo ($listfoliopro_archive_layout=='archive-left-map' ? 'checked':'' ); ?> > <?php esc_html_e( 'Listing + Map', 'listfoliopro' );?>
			</label>	
		</div>
		
		<div class="col-md-2">	
			<label>											
				<input type="radio"  name="listfoliopro_archive_layout" id="listfoliopro_archive_layout" value='archive-no-map' <?php echo ($listfoliopro_archive_layout=='archive-no-map' ? 'checked':'' );  ?> > <?php esc_html_e( 'Listing Without Map', 'listfoliopro' );?>
			</label>
		</div>	
		<div class="col-md-5">	
		<label  class=" control-label"> <?php esc_html_e('For more customization use Elementor widget: ListiHub Elements-> Listing Archive','listfoliopro');  ?></label>
			<a href="<?php echo esc_url(listfoliopro_ep_URLPATH.'admin/files/images/archive-listing.png'); ?>"><image height="100px" src="<?php echo esc_url(listfoliopro_ep_URLPATH.'admin/files/images/archive-listing.png'); ?>"></a>
		</div>
	</div>	
	<?php
		$listfoliopro_user_can_publish=get_option('listfoliopro_user_can_publish');
		if($listfoliopro_user_can_publish==""){$listfoliopro_user_can_publish='yes';}
	?>
	<div class="form-group row">
		<label  class="col-md-3 control-label"> <?php esc_html_e('Publish Listing','listfoliopro');  ?></label>
		<div class="col-md-2">
			<label>												
				<input type="radio" name="listfoliopro_user_can_publish" id="listfoliopro_user_can_publish" value='no' <?php echo ($listfoliopro_user_can_publish=='yes' ? 'checked':'' ); ?> > <?php esc_html_e( 'Admin will Publish', 'listfoliopro' );?>
			</label>	
		</div>
		<div class="col-md-2">	
			<label>											
				<input type="radio"  name="listfoliopro_user_can_publish" id="listfoliopro_user_can_publish" value='yes' <?php echo ($listfoliopro_user_can_publish=='no' ? 'checked':'' );  ?> > <?php esc_html_e( 'All user can publish', 'listfoliopro' );?>
			</label>
		</div>	
	</div>
	<?php
		$listing_hide=get_option('listfoliopro_listing_hide_opt');
		if($listing_hide==""){$listing_hide='package';}	
	?>
	<div class="form-group row">
		<label  class="col-md-3 control-label"> <?php esc_html_e('Listing hide','listfoliopro');  ?></label>
		<div class="col-md-3">
			<label>												
				<input type="radio" name="listing_hide" id="listing_hide" value='package' <?php echo ($listing_hide=='package' ? 'checked':'' ); ?> > <?php esc_html_e( 'When User Package Expire ', 'listfoliopro' );?>
			</label>	
		</div>
		
		<div class="col-md-3">
			<label>											
				<input type="radio"  name="listing_hide" id="listing_hide" value='admin' <?php echo ($listing_hide=='admin' ? 'checked':'' );  ?> > <?php esc_html_e( 'Admin will hide/delete', 'listfoliopro' );?>
			</label>
		</div>	
		
	</div>
	
	<?php											
		$opt_style=	get_option('listfoliopro_archive_template');
		
	?>	
	<div class="form-group row">
		<label  class="col-md-3 control-label"> <?php esc_html_e('Default listing Image','listfoliopro');  ?>
		</label>
		<div class="col-md-2" id="listing_defaultimage">
				<?php
					if(get_option('listfoliopro_listing_defaultimage')!=''){
						$default_image= wp_get_attachment_image_src(get_option('listfoliopro_listing_defaultimage'));
						if(isset($default_image[0])){									
							$default_image=$default_image[0] ;
						}
						}else{
							$default_image=listfoliopro_ep_URLPATH."/assets/images/default-directory.jpg";
						}
					?>
				<img class="w80"   src="<?php echo esc_url($default_image);?>">
				
		</div>
		<div class="col-md-5">	
			
				<input type="hidden" name="listfoliopro_listing_defaultimage" id="listfoliopro_listing_defaultimage" >
				<button type="button" onclick="return  listfoliopro_listing_defaultimage_fun();" class="btn btn-primary btn-xs mt-1"><?php esc_html_e('Set Image','listfoliopro');  ?></button>
				<p class="btn-label"><?php esc_html_e('Best Fit 520px X 260px','listfoliopro');  ?> </p>
		</div>
	</div>
	<div class="form-group row">
		<label  class="col-md-3 control-label"> <?php esc_html_e('Default Location Image','listfoliopro');  ?>
		</label>
		<div class="col-md-2" id="location_defaultimage">
			<?php
					if(get_option('listfoliopro_location_defaultimage')!=''){
						$default_image= wp_get_attachment_image_src(get_option('listfoliopro_location_defaultimage'));
						if(isset($default_image[0])){									
							$default_image=$default_image[0] ;
						}
						}else{
							$default_image=listfoliopro_ep_URLPATH."/assets/images/location.jpg";
						}
					?>
				<img class="w80"   src="<?php echo esc_url($default_image);?>">
				
		</div>
		<div class="col-md-5">	
				<input type="hidden" name="listfoliopro_location_defaultimage" id="listfoliopro_location_defaultimage" >
				<button type="button" onclick="return  listfoliopro_location_defaultimage_fun();" class="btn btn-primary btn-xs mt-1"><?php esc_html_e('Set Image','listfoliopro');  ?></button>
				<p class="btn-label"><?php esc_html_e('Best Fit 450px X 400px','listfoliopro');  ?> </p>
		</div>
	</div>
	
	<div class="form-group row">
		<label  class="col-md-3 control-label"> <?php esc_html_e('Default Category Image','listfoliopro');  ?>
		</label>
		<div class="col-md-2" id="category_defaultimage">
					<?php
					if(get_option('listfoliopro_category_defaultimage')!=''){
						$default_image= wp_get_attachment_image_src(get_option('listfoliopro_category_defaultimage'));
						if(isset($default_image[0])){									
							$default_image=$default_image[0] ;
						}
						}else{
							$default_image=listfoliopro_ep_URLPATH."/assets/images/category.png";
						}
					?>
				<img class="w80"  src="<?php echo esc_url($default_image);?>">
				
		</div>
		<div class="col-md-5">	
				<input type="hidden" name="listfoliopro_category_defaultimage" id="listfoliopro_category_defaultimage" >
				<button type="button" onclick="return  listfoliopro_category_defaultimage_fun();" class="btn btn-primary btn-xs mt-1"><?php esc_html_e('Set Image','listfoliopro');  ?></button>
				<p class="btn-label"><?php esc_html_e('Best Fit 330px X 280px','listfoliopro');  ?> </p>
		</div>
	</div>
	
	
	<div class="form-group row">
		<?php
			$dir_style5_perpage='20';						
			$dir_style5_perpage=get_option('listfoliopro_dir_perpage');
			if($dir_style5_perpage==""){$dir_style5_perpage=20;}
		?>	
		<label  class="col-md-3 control-label">	<?php esc_html_e('Load Per Page','listfoliopro');  ?> </label>
		<div class="col-md-2">																	
			<input  class="form-control" type="input" name="listfoliopro_dir_perpage" id="listfoliopro_dir_perpage" value='<?php echo esc_attr($dir_style5_perpage); ?>'>
		</div>						
	</div>

	<?php
		$listfoliopro_url=get_option('listfoliopro_ep_url');
		if($listfoliopro_url==""){$listfoliopro_url='listing';}
	?>
	<div class="form-group row">
		<label  class="col-md-3 control-label"> <?php esc_html_e('Custom Post Type','listfoliopro');  ?></label>
		<div class="col-md-2">													
				<input  class="form-control"  type="input" name="listfoliopro_url" id="listfoliopro_url" value='<?php echo esc_attr($listfoliopro_url); ?>' >
			
		</div>
		<div class="col-md-5">
			<?php esc_html_e('No special characters, no upper case, no space','listfoliopro');  ?>
		</div>
	</div>
	<hr>
	

	
	<div class="form-group row">
		<div class="col-md-8">
			<div id="update_message49"> </div>	
			<button type="button" onclick="return  listfoliopro_update_dir_setting();" class="listfoliopro-button"><?php esc_html_e('Save & Update','listfoliopro');  ?></button>
		</div>
	</div>
</form>