<?php
	 if ( ! defined( 'ABSPATH' ) ) exit; 
	$dir_map_api=get_option('listfoliopro_map_api');
	if($dir_map_api==""){$dir_map_api='';}	
	$listfoliopro_directory_url=get_option('listfoliopro_ep_url');
	if($listfoliopro_directory_url==""){$listfoliopro_directory_url='listing';}
	$map_api_have='no';
?>

		
<?php					
	global $wpdb;
	// Check Max\
	$max=999999;									 
	 
	$listfoliopro_pack='listfoliopro_pack';
	$sql=$wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_type = '%s'  and post_status='draft' ",$listfoliopro_pack );
	$membership_pack = $wpdb->get_results($sql);
	$total_package = count($membership_pack);
	$max=999999;
	$package_id=get_user_meta($current_user->ID,'listfoliopro_package_id',true);
					
	if($package_id!=""){  					
		$max=get_post_meta($package_id, 'listfoliopro_package_max_post_no', true);
	}											
	if($package_id=="" OR $package_id=="0"){  						
		global $wpdb;
		$sql=$wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_type = '%s' and post_status='draft'", $listfoliopro_pack);
		$membership_pack = $wpdb->get_results($sql);
		$total_package=count($membership_pack);								
		if($total_package>0){		  						
			$max=get_post_meta($package_id, 'listfoliopro_package_max_post_no', true);
		}else{ 
			 $max=999999;
		}	
	}		
	
	if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
		$max=999999;
	}		
						 
	
	$sql=$wpdb->prepare("SELECT count(*) as total FROM $wpdb->posts WHERE post_type ='%s' and post_status IN ('publish','pending','draft') and post_author='%d'",$listfoliopro_directory_url, $current_user->ID);
	$all_post = $wpdb->get_row($sql);
	$my_post_count=$all_post->total;
	if ( $my_post_count>=$max or !current_user_can('edit_posts') )  { 
		$iv_redirect = get_option('listfoliopro_profile_page');
		$reg_page= get_permalink( $iv_redirect); 							
	?>
	<?php  esc_html_e("Yangi ro'yxatdan o'tgan foydalanuvchilarimiz 24 soat ichida o'z e'lonlarini joylashi mumkin ",'listfoliopro'); ?>
	<a href="<?php echo esc_url($reg_page).'?&profile=level'; ?>" title="Upgarde"><b><?php  esc_html_e('','listfoliopro'); ?> </b></a>
	<?php  esc_html_e('.','listfoliopro'); ?>
	<?php
		}else{	
	?>					
	<div class="row">
		<div class="col-md-12">	 
			<form action="" id="new_post" name="new_post"  method="POST" role="form">
				<div class=" form-group">
					<label for="text" class=" control-label"><?php  esc_html_e('Sarlavha','listfoliopro'); ?></label>
					<div class="  "> 
						<input type="text" class="form-control" name="title" id="title" value="" placeholder="<?php  esc_html_e('Sarlavhani shu yerga kiriting','listfoliopro'); ?>">
					</div>																		
				</div>
				<?php
				$listfoliopro_active_chatGPT=get_option('listfoliopro_active_chatGPT');
				if($listfoliopro_active_chatGPT==""){$listfoliopro_active_chatGPT='yes';}
				if($listfoliopro_active_chatGPT=="yes"){
				?>
				<div class="row">
					<div class="col-md-12 "> <hr/>											
						<button type="button" onclick="listfoliopro_chatgtp_settings_popup();"  class="btn green-haze mt-2 mb-2"><?php  esc_html_e('ChatGPT yordamida post yarating ',	'listfoliopro'); ?></button>
						<div id="chatgpt-message"></div>
					</div>						
				</div>	
				<?php
				}
				?>
				<input type="hidden" name="feature_image_id" id="feature_image_id" value="">
				
				<div class=" form-group row">	
						<div class="col-md-6" id="post_image_div">				
						</div> 
						
						<div class="col-md-6" id="post_image_edit">	
							<button type="button" onclick="listfoliopro_edit_post_image('post_image_div');"  class="btn btn-small-ar"><?php  esc_html_e('Asosiy rasimnni joylang','listfoliopro'); ?> </button>
						</div>									
				</div>
				
				<span class="caption-subject">											
					<?php  esc_html_e('Rasimlarni joylang','listfoliopro'); ?>
				</span>
				<hr/>
			
					<input type="hidden" name="gallery_image_ids" id="gallery_image_ids" value="">
					<div class="row" id="gallery_image_div">
					
					</div>									
				
				<div class="row">										
					<div class="  form-group col-md-12">									
						<button type="button" onclick="listfoliopro_edit_gallery_image('gallery_image_div');"  class="btn btn-small-ar mt-2"><?php  esc_html_e("Rasmlar tanlang",'listfoliopro'); ?></button>
					</label>						
					</div>
				</div>
			
			
			<input type="hidden" name="topbanner_image_id" id="topbanner_image_id" value="">	
				<div class="form-group">
					<label for="text" class="control-label"><?php  esc_html_e("Batafsil ma'lumot kiriting ",'listfoliopro'); ?>  </label>
					<?php
						$settings_a = array(															
						'textarea_rows' =>8,
						'editor_class' => 'form-control'															 
						);
						$editor_id = 'new_post_content';
						wp_editor( '', $editor_id,$settings_a );										
					?>
				</div>
				
									
				
				
				<div class="  form-group ">
					<label for="text" class="  control-label"><?php  esc_html_e('Holat','listfoliopro'); ?>  </label>
					<select name="post_status" id="post_status"  class="form-control">
						<?php
								$listfoliopro_user_can_publish=get_option('listfoliopro_user_can_publish');
								if($listfoliopro_user_can_publish==""){$listfoliopro_user_can_publish='yes';}
								if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){?>
								<option value="publish"><?php esc_html_e('Publish','listfoliopro'); ?></option>
								<?php
								}
								if(isset($current_user->roles[0]) and $current_user->roles[0]!='administrator'){
									if($listfoliopro_user_can_publish=="yes"){
									?>
									<option value="publish"><?php esc_html_e('Nashr qilish','listfoliopro'); ?></option>
									<?php
									}
								}
							?>											
						<option value="pending"><?php esc_html_e("Ko‘rib chiqish kutilmoqda",'listfoliopro'); ?></option>
						<option value="draft" ><?php esc_html_e('Qoralama','listfoliopro'); ?></option>
					</select>	
				</div>										
				
				<div class="row">
					<div class=" col-md-6 form-group">
						<label for="text" class=" control-label"><?php  esc_html_e('Narxi','listfoliopro'); ?></label>
						<input type="text" class="form-control" name="price" id="price" value="" placeholder="<?php  esc_html_e("Joriy narxi",'listfoliopro'); ?>">
					</div>
					<div class="col-md-6  form-group">
						<label for="text" class=" control-label"><?php  esc_html_e('Chegirmali narx','listfoliopro'); ?></label>
						<input type="text" class="form-control" name="discount" id="discount" value="" placeholder="<?php  esc_html_e('Chegirma narxi','listfoliopro'); ?>">
					</div>
				</div>	
				
				<span class="caption-subject">														
					<?php  esc_html_e("Aloqa ma'lumotlari",'listfoliopro'); ?>
				</span>
				<hr/>
				<?php
				
					$listing_contact_source='';
					if($listing_contact_source==''){$listing_contact_source='user_info';}
				?>
				<div class=" form-group">	
					<div class="radio">											
						<label><input type="radio" name="contact_source" value="user_info"  class="mr-1" <?php echo ($listing_contact_source=='user_info'?'checked':''); ?> > <?php  esc_html_e("Shaxsiy ma'lumotlarimdan foydalanish  ->",'listfoliopro'); ?> <?php echo ucfirst($current_user->display_name); ?><?php  esc_html_e(' : Rasim, Email, Telefon raqam','listfoliopro'); ?> <a href="<?php echo get_permalink().'?profile=setting';?>" target="_blank"> <?php  esc_html_e('','listfoliopro'); ?> </a></label>
					</div>
					<div class="radio">
						<label><input type="radio" name="contact_source" value="new_value" class="mr-1" <?php echo ($listing_contact_source=='new_value'?'checked':''); ?>><?php  esc_html_e("Yangi aloqa ma'lumotlari",'listfoliopro'); ?>  </label>
					</div>
				</div>
				<div  class="row" id="new_contact_div" <?php echo ($listing_contact_source=='user_info'?'style="display:none"':''); ?> >
					
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Foydalanuvchi nomi','listfoliopro'); ?></label>
						<input type="text" class="form-control" name="company_name" id="company_name" value="" placeholder="<?php  esc_attr_e('nomi','listfoliopro'); ?>">
					</div>
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Telefon raqam 1','listfoliopro'); ?></label>
						<input type="text" class="form-control" name="phone" id="phone" value="" placeholder="<?php  esc_attr_e('Telefon raqam','listfoliopro'); ?>">
					</div>
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Telefon raqam 2','listfoliopro'); ?></label>
						<input type="text" class="form-control" name="whatsapp" id="whatsapp" value="" placeholder="<?php  esc_attr_e('Aloqa uchun 2-raqam','listfoliopro'); ?>">
					</div>
					
					
					
					<div class=" form-group col-md-12">
						<label for="text" class=" control-label"><?php  esc_html_e("Manzil avtomatik to'ldirish yordamchisi",'listfoliopro'); ?></label>
						<div id="map"></div>
						<div id="search-box"></div>

						<div id="result"></div>
					</div>
					<div class=" form-group col-md-12">
						<label for="text" class=" control-label"><?php  esc_html_e('Manzil (roʻyxat maydonida saqlang)','listfoliopro'); ?></label>
						<input type="text" class="form-control" name="address" id="address" value=""  placeholder="<?php  esc_html_e('Manzilni kiriting','listfoliopro'); ?>">
					</div>
				
				
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Shahar','listfoliopro'); ?></label>
						<input type="text" class="form-control" name="city" id="city" value="" placeholder="<?php  esc_attr_e('Shaharni kiriting','listfoliopro'); ?>">
					</div>	
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Viloyat','listfoliopro'); ?></label>
						<input type="text" class="form-control" name="state" id="state" value="" placeholder="<?php  esc_attr_e('Viloyatni kiriting','listfoliopro'); ?>">
					</div>	
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Pochta indeksi','listfoliopro'); ?></label>
						<input type="text" class="form-control" name="postcode" id="postcode" value="" placeholder="<?php  esc_attr_e('Pochta indeksi','listfoliopro'); ?>">
					</div>	
						
					<div class=" form-group col-md-6">
					<label for="text" class=" control-label"><?php  esc_html_e('Latitude ','listfoliopro'); ?></label>
					<input type="text" class="form-control" name="latitude" id="latitude" value="" placeholder="<?php  esc_attr_e('geografik kenglik','listfoliopro'); ?>">
				</div>	
					<div class=" form-group col-md-6">
					<label for="text" class=" control-label"><?php  esc_html_e('Longitude','listfoliopro'); ?></label>
					<input type="text" class="form-control" name="longitude" id="longitude" value="" placeholder="<?php  esc_attr_e('Enter Longitude','listfoliopro'); ?>">
				</div>	
					
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('E-pochta manzili','listfoliopro'); ?></label>
						<input type="text" class="form-control" name="contact-email" id="contact-email" value="" placeholder="<?php  esc_attr_e('E-pochta manzil','listfoliopro'); ?>">
					</div>
					
				</div>	
				
				
				<hr/>
				<div class="clearfix"></div>
				<span class="caption-subject">												
					<?php  esc_html_e('Kategoriyalar','listfoliopro'); ?>
				</span>
				<hr/>
				
					<div class=" form-group row"  id="listfolioprocats-container">
						<?php $selected='';
						
							
							//listing
							$taxonomy = $listfoliopro_directory_url.'-category';
							$args = array(
							'orderby'           => 'name', 
							'taxonomy'   => 	$taxonomy ,
							'order'             => 'ASC',
							'hide_empty'        => false, 
							'exclude'           => array(), 
							'exclude_tree'      => array(), 
							'include'           => array(),
							'number'            => '', 
							'fields'            => 'all', 
							'slug'              => '',
						
							'hierarchical'      => true, 
							'child_of'          => 0,
							'childless'         => false,
							'get'               => '', 
							);
							$terms = get_terms($args); // Get all terms of a taxonomy
							if ( $terms && !is_wp_error( $terms ) ) :
							$i=0;
							foreach ( $terms as $term_parent ) {  ?>												
							<?php  
							if($term_parent->name!=''){	
							?>	
								<div class="col-md-6">
									<label class="form-group "> <input type="checkbox" name="postcats[]" id="postcats"  value="<?php echo esc_attr($term_parent->slug); ?>" class="listfolioprocats-fields" > <?php echo esc_html($term_parent->name); ?> </label>
								</div>
							<?php
							}
								$i++;
							} 								
							endif;	
							
						?>	
							
						<div class="col-md-12">
							<input type="text" class="form-control" name="new_category" id="new_category" value="" placeholder="<?php  esc_html_e('Yangi toifalarni kiriting: vergul bilan ajrating','listfoliopro'); ?>">
						</div>		
						
					</div>
					
				<div class="clearfix"></div>
				<span class="caption-subject">												
					<?php  esc_html_e('Qulayliklar','listfoliopro'); ?>
				</span>
				<hr/>
				
				<div class=" row">		
				<?php
					$args2 = array(
					'type'                     => $listfoliopro_directory_url,
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => 0,
					'hierarchical'             => 1,
					'exclude'                  => '',
					'include'                  => '',
					'number'                   => '',
					'taxonomy'                 => $listfoliopro_directory_url.'-tag',
					'pad_counts'               => false
					);
					$main_tag = get_categories( $args2 );	
					$tags_all= '';													
					if ( $main_tag && !is_wp_error( $main_tag ) ) :
					foreach ( $main_tag as $term_m ) {
					?>
					<div class="col-md-6">
						<label class="form-group"> 
							<input type="checkbox" name="tag_arr[]" id="tag_arr[]"  value="<?php echo esc_attr($term_m->slug); ?>"> <?php echo esc_html($term_m->name); ?> </label>  
					</div>
					<?php	
					}
					endif;	
				?>
				</div>
				<div class=" form-group">	
						<input type="text" class="form-control" name="new_tag" id="new_tag" value="" placeholder="<?php  esc_html_e('Yangi qulayliklarni kiriting: vergul bilan ajrating','listfoliopro'); ?>">
				</div>															
				<div class="clearfix"></div>
				<span class="caption-subject">												
					<?php  esc_html_e('Viloyatni tanlang','listfoliopro'); ?>
				</span>
				<hr/>
				
				<div class=" row mb-3">		
				<?php
					$args2 = array(
					'type'                     => $listfoliopro_directory_url,
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => 0,
					'hierarchical'             => 1,
					'exclude'                  => '',
					'include'                  => '',
					'number'                   => '',
					'taxonomy'                 => $listfoliopro_directory_url.'-locations',
					'pad_counts'               => false
					);
					$main_tag = get_categories( $args2 );	
					$tags_all= '';													
					if ( $main_tag && !is_wp_error( $main_tag ) ) :
					foreach ( $main_tag as $term_m ) {
					?>
					<div class="col-md-6">
						<label class="form-group"> 
							<input type="checkbox" name="location_arr[]" id="location_arr"  value="<?php echo esc_attr($term_m->slug); ?>"> <?php echo esc_html($term_m->name); ?> </label>  
					</div>
					<?php	
					}
					endif;	
				?>
						<div class="col-md-12">
							<input type="text" class="form-control" name="new_location" id="new_location" value="" placeholder="<?php  esc_html_e('boshqa','listfoliopro'); ?>">
							
				</div>
				
				<div class="clearfix"></div>	
				<div class="row">
					<div class="col-md-12  "> <hr/>
						<div class="" id="update_message"></div>
						<input type="hidden" name="user_post_id" id="user_post_id" value="0">
						<button type="button" onclick="listfoliopro_save_post();"  class="btn green-haze"><?php  esc_html_e('Postni saqlash',	'listfoliopro'); ?></button>
						
					</div>	
					
				</div>	
			</form>
		</div>
	
	<?php
	} // for Role
?>
				
		
<!-- END PROFILE CONTENT -->
<?php
	$save_address='';
	$my_theme = wp_get_theme();
	$theme_name= strtolower($my_theme->get( 'Name' ));
	wp_enqueue_script('listfoliopro_add-edit-listing', listfoliopro_ep_URLPATH . 'admin/files/js/add-edit-listing.js');
	wp_localize_script('listfoliopro_add-edit-listing', 'realpro_data', array(
	'ajaxurl' 					=> admin_url( 'admin-ajax.php' ),
	'loading_image'			=> '<img src="'.listfoliopro_ep_URLPATH.'admin/files/images/loader.gif">',
	'current_user_id'		=>get_current_user_id(),
	'Set_Feature_Image'	=> esc_html__('Set Feature Image','listfoliopro'),
	'Set_plan_Image'		=> esc_html__('Set plan Image','listfoliopro'),
	'Set_Event_Image'		=> esc_html__('Set Event Image','listfoliopro'),
	'Gallery_Images'		=> esc_html__('Gallery Images','listfoliopro'),
	'attached_doc'		=> esc_html__('Set Doc','listfoliopro'),
	'permalink'				=> get_permalink(),
	'save_address'			=> $save_address,
	'dirwpnonce'			=> wp_create_nonce("addlisting"),
	'theme_name'			=> $theme_name,
	) );
?> 