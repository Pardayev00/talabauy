<?php
	 if ( ! defined( 'ABSPATH' ) ) exit; 
	$dir_map_api=get_option('listfoliopro_map_api');
	if($dir_map_api==""){$dir_map_api='';}	
	$listfoliopro_directory_url=get_option('listfoliopro_ep_url');
	if($listfoliopro_directory_url==""){$listfoliopro_directory_url='listing';}
	$map_api_have='no';
?>
<div class="border-bottom pb-15 mb-3 toptitle-sub"><?php esc_html_e("Roʻyxatni tahrirlash", 'listfoliopro'); ?>
</div>	

	
			<div class="tab-content">
				<?php					
					// Check Max\
					$package_id=get_user_meta($current_user->ID,'listfoliopro_package_id',true);
					$max=get_post_meta($package_id, 'listfoliopro_package_max_post_no', true);
					$curr_post_id=sanitize_text_field($_REQUEST['post-id']);
					$current_post = $curr_post_id;
					$post_edit = get_post($curr_post_id); 
					$have_edit_access='yes';
					$exp_date= get_user_meta($current_user->ID, 'listfoliopro_exprie_date', true);
					if($exp_date!=''){
						$package_id=get_user_meta($current_user->ID,'listfoliopro_package_id',true);
						$dir_hide= get_post_meta($package_id, 'listfoliopro_package_hide_exp', true);
						if($dir_hide=='yes'){								
							if(strtotime($exp_date) < time()){	
								$have_edit_access='no';		
							}
						}
					}
					if($post_edit->post_author != $current_user->ID ){
						$have_edit_access='no';	
					}
					if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
						$have_edit_access='yes';					
					}	
					if ( $have_edit_access=='no') { 
						$iv_redirect = get_option('listfoliopro_login_page');
						$reg_page= get_permalink( $iv_redirect); 
					?>
					<?php  esc_html_e('Please ','listfoliopro'); ?>
					<a href="<?php echo esc_url($reg_page).'?&profile=level'; ?>" title="Upgarde"><b><?php  esc_html_e('Login or upgrade ','listfoliopro'); ?> </b></a>
					<?php  esc_html_e('To Edit The Post.','listfoliopro'); ?>
					<?php
						}else{
						$title = esc_html($post_edit->post_title);
						$content = $post_edit->post_content;
					?>					
					<div class="row">
						<div class="col-md-12">	 
							<form action="" id="new_post" name="new_post"  method="POST" role="form">
								<div class=" form-group">
									<label for="text" class=" control-label"><?php  esc_html_e('Title','listfoliopro'); ?></label>
									<div class="  "> 
										<input type="text" class="form-control" name="title" id="title" value="<?php echo esc_attr($title);?>" placeholder="<?php  esc_html_e('Enter Title Here','listfoliopro'); ?>">
									</div>																		
								</div>	
								<?php
								$listfoliopro_active_chatGPT=get_option('listfoliopro_active_chatGPT');
								if($listfoliopro_active_chatGPT==""){$listfoliopro_active_chatGPT='yes';}
								if($listfoliopro_active_chatGPT=="yes"){
								?>
								<div class="row">
									<div class="col-md-12 "> <hr/>											
										<button type="button" onclick="listfoliopro_chatgtp_settings_popup();"  class="btn green-haze mt-2 mb-2"><?php  esc_html_e('Create Post Using ChatGPT ',	'listfoliopro'); ?></button>
										<div id="chatgpt-message"></div>
									</div>						
								</div>	
								<?php
								}
								?>
								
								<div class=" form-group row">																
										<div class=" col-md-6" id="post_image_div">	
											<?php $feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $curr_post_id ), 'thumbnail' );
												if(isset($feature_image[0])){ ?>
												<img title="profile image" class=" img-responsive rounded "  src="<?php  echo esc_url($feature_image[0]); ?>">
												<?php
												}
												$feature_image_id=get_post_thumbnail_id( $curr_post_id );
											?>
										</div> 
									<div class=" form-group col-md-12 my-account-img-up-button">
											<div class="" id="post_image_edit">	
												<button type="button" onclick="listfoliopro_edit_post_image('post_image_div');"  class="btn btn-small-ar"><?php  esc_html_e('Asosiy Rasimdi yuklang','listfoliopro'); ?> </button>
											</div>									
									</div>								
								</div>	
								<input type="hidden" name="feature_image_id" id="feature_image_id" value="<?php echo esc_attr($feature_image_id); ?>">	
								
									<span class="caption-subject">											
									<?php  esc_html_e('Rasim yuklang','listfoliopro'); ?>
								</span>
								<hr/>
								
									
									<div class="row" id="gallery_image_div">
									</div>									
								
								<div class="row">										
									<div class="  form-group col-md-12">	
										<?php
											$gallery_ids=get_post_meta($curr_post_id ,'image_gallery_ids',true);
											$gallery_ids_array = array_filter(explode(",", $gallery_ids));
										?>
										<input type="hidden" name="gallery_image_ids" id="gallery_image_ids" value="<?php echo esc_attr($gallery_ids); ?>">
										<div class="row" id="gallery_image_div">
											<?php
												if(sizeof($gallery_ids_array)>0){
													foreach($gallery_ids_array as $slide){
													?>
													<div id="gallery_image_div<?php echo esc_attr($slide);?>" class="col-md-3">
                                                        <div class="metabox-img-gallery-item">
                                                            <img  class="img-responsive"  src="<?php echo wp_get_attachment_url( $slide ); ?>">
                                                            <button type="button" onclick="listfoliopro_remove_gallery_image('gallery_image_div<?php echo esc_attr($slide);?>', <?php echo esc_attr($slide);?>);"  class="btn btn-small-ar btn-danger"><?php esc_html_e('X','listfoliopro'); ?> </button>
                                                        </div>

                                                    </div>
													<?php
													}
												}
											?>
										</div>
										<button type="button" onclick="listfoliopro_edit_gallery_image('gallery_image_div');"  class="btn btn-small-ar mt-2"><?php  esc_html_e('Add Images','listfoliopro'); ?></button>
									</label>						
								</div>
							</div>
							
								<div class="form-group">
									<label for="text" class="control-label"><?php  esc_html_e("Joy haqida qisqacha ma'lumot yozing",'listfoliopro'); ?>  </label>
									<?php
										$settings_a = array(															
										'textarea_rows' =>8,
										'editor_class' => 'form-control'															 
										);
										$editor_id = 'new_post_content';
										wp_editor( $content, $editor_id,$settings_a );										
									?>
								</div>
							
											
								<div class="  form-group ">
									<label for="text" class="  control-label"><?php  esc_html_e('Holat','listfoliopro'); ?>  </label>
									<select name="post_status" id="post_status"  class="form-control">
										<?php
											$listfoliopro_user_can_publish=get_option('listfoliopro_user_can_publish');
											if($listfoliopro_user_can_publish==""){$listfoliopro_user_can_publish='yes';}
											if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){?>
											<option value="publish"><?php esc_html_e('Nashir qilish','listfoliopro'); ?></option>
											<?php
											}
											if(isset($current_user->roles[0]) and $current_user->roles[0]!='administrator'){
												if($listfoliopro_user_can_publish=="yes"){
												?>
												<option value="publish"><?php esc_html_e('Publish','listfoliopro'); ?></option>
												<?php
												}
											}
										?>												
										<option value="pending" <?php echo (get_post_status( $post_edit->ID )=='pending'?'selected="selected"':'' ) ; ?>><?php esc_html_e("Ko‘rib chiqish kutilmoqda",'listfoliopro'); ?></option>
										<option value="draft" <?php echo (get_post_status( $post_edit->ID )=='draft'?'selected="selected"':'' ) ; ?> ><?php esc_html_e('Qoralama','listfoliopro'); ?></option>
									</select>	
								</div>
								
								
								<div class="row">
									<div class=" col-md-6 form-group">
										<label for="text" class=" control-label"><?php  esc_html_e('Narxi','listfoliopro'); ?></label>
										<input type="text" class="form-control" name="price" id="price" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'price',true));?>" placeholder="<?php  esc_html_e('Enter Price ','listfoliopro'); ?>">
									</div>
									<div class="col-md-6  form-group">
										<label for="text" class=" control-label"><?php  esc_html_e('Chegirmali narx','listfoliopro'); ?></label>
										<input type="text" class="form-control" name="discount" id="discount" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'discount',true));?>" placeholder="<?php  esc_html_e('Enter Discount Price','listfoliopro'); ?>">
									</div>
								</div>	
							
								<span class="caption-subject">														
									<?php  esc_html_e("Aloqa ma'lumotlari",'listfoliopro'); ?>
								</span>
								<hr/>
								<?php
									$listing_contact_source=get_post_meta($post_edit->ID,'listing_contact_source',true);
									if($listing_contact_source==''){$listing_contact_source='user_info';}
								?>
								<div class=" form-group">	
									<div class="radio">											
										<label><input type="radio" name="contact_source" value="user_info" class="mr-1" <?php echo ($listing_contact_source=='user_info'?'checked':''); ?> > <?php  esc_html_e("Profil ma'lumotdan foydalanish"); ?> <?php echo ucfirst($current_user->display_name); ?><?php  esc_html_e(" (Rasim, Email, Telefon raqam)",); ?> <a href="<?php echo get_permalink().'?profile=setting';?>" target="_blank"> <?php  esc_html_e('','listfoliopro'); ?> </a></label>
									</div>
									<div class="radio">
										<label><input type="radio" name="contact_source" value="new_value" class="mr-1" <?php echo ($listing_contact_source=='new_value'?'checked':''); ?>><?php  esc_html_e("Yangi ma'lumot qo'shish",'listfoliopro'); ?>  </label>
									</div>
								</div>
								
								
								<div  class="row" id="new_contact_div" <?php echo ($listing_contact_source=='user_info'?'style="display:none"':''); ?> >
																		
									<div class=" form-group col-md-6">																
										<div class=" col-md-6" id="post_image_div">	
											<?php $feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $curr_post_id ), 'thumbnail' );
												if(isset($feature_image[0])){ ?>
												<img title="profile image" class=" img-responsive" src="<?php  echo esc_url($feature_image[0]); ?>">
												<?php
												}
												$feature_image_id=get_post_thumbnail_id( $curr_post_id );
											?>
										</div> 
																	
									</div>	
									
									<div class="col-md-12 mb-3" id="post_image_edit">
																			
											<button type="button" onclick="listfoliopro_edit_post_image('post_image_div');"  class="btn btn-small-ar"><?php  esc_html_e('Rasim yuklash','listfoliopro'); ?> </button>
											<?php
												if(isset($feature_image[0])){ ?>											
											<button type="button" onclick="listfoliopro_remove_post_image('post_image_div');" class="btn btn-small-ar"> <i class="far fa-trash-alt"></i> </button>
											
											<?php
												}
											?>
									</div>	
									<div class=" form-group col-md-6">
										<label for="text" class=" control-label"><?php  esc_html_e('Nomi','listfoliopro'); ?></label>
										<input type="text" class="form-control" name="company_name" id="company_name" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'company_name',true)); ?>" placeholder="<?php  esc_html_e('Company name','listfoliopro'); ?>">
									</div>
									<div class=" form-group col-md-6">
										<label for="text" class=" control-label"><?php  esc_html_e('Telefon raqam','listfoliopro'); ?></label>
										<input type="text" class="form-control" name="phone" id="phone" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'phone',true)); ?>" placeholder="<?php  esc_html_e('telefon raqam kiriting','listfoliopro'); ?>">
									</div>
									<div class=" form-group col-md-6">
										<label for="text" class=" control-label"><?php  esc_html_e('WhatsApp','listfoliopro'); ?></label>
										<input type="text" class="form-control" name="whatsapp" id="whatsapp" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'whatsapp',true)); ?>" placeholder="<?php  esc_attr_e('Watsap raqam kiriting','listfoliopro'); ?>">
									</div>										
									<div class=" form-group col-md-6">
										<label for="text" class=" control-label"><?php  esc_html_e('Viber','listfoliopro'); ?></label>
										<input type="text" class="form-control" name="viber" id="viber" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'viber',true)); ?>" placeholder="<?php  esc_attr_e('raqam kiriting','listfoliopro'); ?>">
									</div>		
									<div class=" form-group col-md-12">
										<label for="text" class=" control-label"><?php  esc_html_e("Manzil avtomatik to'ldirish yordamchisi",'listfoliopro'); ?></label>
										<div id="map"></div>
										<div id="search-box"></div>
										<div id="result"></div>
									</div>
									<div class=" form-group col-md-12">
										<label for="text" class=" control-label"><?php  esc_html_e("Manzil (roʻyxat maydonida saqlang)",'listfoliopro'); ?></label>
										<input type="text" class="form-control" name="address" id="address" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'address',true)); ?>"  placeholder="<?php  esc_html_e('manzilni kiriting','listfoliopro'); ?>">
									</div>
									
									
									<div class=" form-group col-md-6">
									<label for="text" class=" control-label"><?php  esc_html_e('Shahar','listfoliopro'); ?></label>
										<input type="text" class="form-control" name="city" id="city" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'shahar',true)); ?>" placeholder="<?php  esc_attr_e('shahar','listfoliopro'); ?>">
									</div>	
									<div class=" form-group col-md-6">
										<label for="text" class=" control-label"><?php  esc_html_e('State','listfoliopro'); ?></label>
										<input type="text" class="form-control" name="state" id="state" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'state',true)); ?>" placeholder="<?php  esc_attr_e('mamlakatdi kiritng','listfoliopro'); ?>">
									</div>	
									<div class=" form-group col-md-6">
										<label for="text" class=" control-label"><?php  esc_html_e('Pochta indeksi','listfoliopro'); ?></label>
										<input type="text" class="form-control" name="postcode" id="postcode" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'postcode',true)); ?>" placeholder="<?php  esc_attr_e('pochta manzil','listfoliopro'); ?>">
									</div>	
																		
									<div class=" form-group col-md-6">
										<label for="text" class=" control-label"><?php  esc_html_e('Mamlakat','listfoliopro'); ?></label>
										<input type="text" class="form-control" name="country" id="country" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'country',true)); ?>" placeholder="<?php  esc_attr_e('mamlakat','listfoliopro'); ?>">
									</div>
									<div class=" form-group col-md-6">
										<label for="text" class=" control-label"><?php  esc_html_e('Geografik Kenglik ','listfoliopro'); ?></label>
										<input type="text" class="form-control" name="latitude" id="latitude" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'latitude',true)); ?>" placeholder="<?php  esc_attr_e('kenglik','listfoliopro'); ?>">
									</div>	
										<div class=" form-group col-md-6">
										<label for="text" class=" control-label"><?php  esc_html_e('Geografik Uzoqlik','listfoliopro'); ?></label>
										<input type="text" class="form-control" name="longitude" id="longitude" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'longitude',true)); ?>" placeholder="<?php  esc_attr_e('uzoqlik','listfoliopro'); ?>">
									</div>	
									
									<div class=" form-group col-md-6">
										<label for="text" class=" control-label"><?php  esc_html_e('Email manzil','listfoliopro'); ?></label>
										<input type="text" class="form-control" name="contact-email" id="contact-email" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'contact-email',true)); ?>" placeholder="<?php  esc_html_e('email kiriting','listfoliopro'); ?>">
									</div>
									<div class=" form-group col-md-6">
										<label for="text" class=" control-label"><?php  esc_html_e("Web-sayt (agar mavjud bo'lsa)",'listfoliopro'); ?></label>
										<input type="text" class="form-control" name="contact_web" id="contact_web" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'contact_web',true)); ?>"  placeholder="<?php  esc_html_e('talabauy.uz','listfoliopro'); ?>">
									</div>
								</div>	
								<hr/>
								<div class="clearfix"></div>
								<span class="caption-subject">												
									<?php  esc_html_e('Toifalar','listfoliopro'); ?>
								</span>
								<hr/>
								<div class=" form-group row " id="listfolioprocats-container">
									<?php
										$currentCategory=wp_get_object_terms( $post_edit->ID, $listfoliopro_directory_url.'-category');
										$post_cats=array();
										foreach($currentCategory as $c)
										{
											array_push($post_cats,$c->slug);
										}
										$selected='';									
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
										foreach ( $terms as $term_parent ) {
											if(in_array($term_parent->slug,$post_cats)){
												$selected=$term_parent->slug;
											}
											if($term_parent->name!=''){
										?>
										<div class="col-md-6">
											<label class="form-group"> <input type="checkbox" name="postcats[]" id="postcats" <?php echo ($selected==$term_parent->slug?'checked':'' );?> value="<?php echo esc_attr($term_parent->slug); ?>" class="listfolioprocats-fields" > <?php echo esc_html($term_parent->name); ?> </label>
										</div>
																				
										<?php
											}
											$i++;
										}
										endif;
										
									?>
									<div class="col-md-12">
										<input type="text" class="form-control" name="new_category" id="new_category" value="" placeholder="<?php  esc_html_e('Boshqa toifa','listfoliopro'); ?>">
									</div>
								</div>
								<div class="clearfix"></div>
								<span class="caption-subject">												
									<?php  esc_html_e('Qulayliklar','listfoliopro'); ?>
								</span>
								<hr/>
								<div class=" row">		
									<?php
										$args =array();								
										
										
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
										$tags_all= wp_get_object_terms( $post_edit->ID,  $listfoliopro_directory_url.'-tag');
										
										if ( $main_tag && !is_wp_error( $main_tag ) ) :
										foreach ( $main_tag as $term_m ) {
											$checked='';
											foreach ( $tags_all as $term ) {
												if( $term->term_id==$term_m->term_id){
													$checked=' checked';
												}
											}
										?>
										<div class="col-md-6">
											<label class="form-group"> <input type="checkbox" name="tag_arr[]" id="tag_arr[]" <?php echo esc_attr($checked);?> value="<?php echo esc_attr($term_m->slug); ?>"> <?php echo esc_html($term_m->name); ?> </label>
										</div>
										<?php
										}
										endif;
										
									?>
								</div>
								<div class=" form-group">	
									<input type="text" class="form-control" name="new_tag" id="new_tag" value="" placeholder="<?php  esc_attr_e('Boshqa toifa','listfoliopro'); ?>">
								</div>			
								<div class="clearfix"></div>
								<span class="caption-subject">												
									<?php  esc_html_e('Viloyatni tanlang','listfoliopro'); ?>
								</span>
								<hr/>
								<div class=" row">		
									<?php
										$args =array();								
										
										
										$args3 = array(
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
										$main_tag = get_categories( $args3 );
										$tags_all= wp_get_object_terms( $post_edit->ID,  $listfoliopro_directory_url.'-locations');
										if ( $main_tag && !is_wp_error( $main_tag ) ) :
										foreach ( $main_tag as $term_m ) {
											$checked='';
											foreach ( $tags_all as $term ) {
												if( $term->term_id==$term_m->term_id){
													$checked=' checked';
												}
											}
										?>
										<div class="col-md-6">
											<label class="form-group"> <input type="checkbox" name="location_arr[]" id="location_arr" <?php echo esc_attr($checked);?> value="<?php echo esc_attr($term_m->slug); ?>"> <?php echo esc_html($term_m->name); ?> </label>
										</div>
										<?php
										}
										endif;
										
									?>
										<div class="col-md-12">
											<input type="text" class="form-control" name="new_location" id="new_location" value="" placeholder="<?php  esc_html_e('Boshqa manzil'); ?>">
										</div>	
								</div>
								<div class="clearfix mb-2"></div>												
								<span class="caption-subject">											
									<?php  esc_html_e("Videosi (agar mavjud bo'lsa)",'listfoliopro'); ?>
								</span>
								<hr/>
								
									<div class="row">
										<div class=" col-md-6 form-group">
											<label for="text" class=" control-label"><?php  esc_html_e('Youtube','listfoliopro'); ?></label>
											<input type="text" class="form-control" name="youtube" id="youtube" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'youtube',true));?>" placeholder="<?php  esc_attr_e('Enter Youtube video ID, e.g : bU1QPtOZQZU ','listfoliopro'); ?>">
										</div>
										<div class="col-md-6  form-group">
											<label for="text" class=" control-label"><?php  esc_html_e('vimeo','listfoliopro'); ?></label>
											<input type="text" class="form-control" name="vimeo" id="vimeo" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'vimeo',true));?>" placeholder="<?php  esc_html_e('Enter vimeo ID, e.g : 134173961','listfoliopro'); ?>">
										</div>
									</div>	
									
						
							<hr/>
							<span class="caption-subject">											
								<?php  esc_html_e("Qo'shimcha fayil(agar mavjud bo'lsa)",'listfoliopro'); ?>
								</span>
							<hr/>			
								
								<?php
									$attached_ids=get_post_meta($curr_post_id ,'attached_ids',true);
									$attached_ids_array = array_filter(explode(",", $attached_ids));
								?>
								<input type="hidden" name="attached_ids" id="attached_ids"  value="<?php echo esc_attr($attached_ids); ?>">
								<div id="attached_div">
										<?php
												if(is_array($attached_ids_array)){
													foreach($attached_ids_array as $slide){
														$filename_only = basename( get_attached_file( $slide ) );
													?>
													<div id="attached_div<?php echo esc_attr($slide);?>"  class="row mb-2">
														<label class="col-md-10 control-label"><?php echo esc_html($filename_only); ?></label>
														<div class="col-md-2">
														<button type="button" onclick="listfoliopro_remove_attached_doc('attached_div<?php echo esc_attr($slide);?>', <?php echo esc_attr($slide);?>);"  class="btn btn-small-ar"><?php esc_html_e('X','listfoliopro'); ?> </button> </div></div>
													<?php
													}
												}
											?>
								</div>									
							
							<div class="row">										
								<div class="  form-group col-md-12">									
									<button type="button" onclick="listfoliopro_attached_doc('attached_div');"  class="btn btn-small-ar mt-2"><?php  esc_html_e('fayil yuklash','listfoliopro'); ?></button>
								</label>						
								</div>
								
							</div>
							<hr/>
							<span class="caption-subject">	
								<?php  esc_html_e('Batafsil','listfoliopro'); ?>
							</span>								
							<hr/>
							<div class="row" id="listfoliopro_fields">
								<?php							
															
									echo  ''.$main_class->listfoliopro_listing_fields($post_edit->ID, $post_cats );
								?>			
							</div>
							
							<span class="caption-subject">	
								<?php  esc_html_e('Ish soatlari ','listfoliopro'); ?>
							</span>									
							<hr/>
							<div class="">
								<?php							
									include( listfoliopro_ep_template. 'private-profile/listing-open-close-time.php');
									?>		
							</div>
							
							<span class="caption-subject">	
								<?php  esc_html_e("Tez-tez so'raladigan savollar",'listfoliopro'); ?>
							</span>								
							<hr/>
							<div class="row">
								<?php							
									include( listfoliopro_ep_template. 'private-profile/profile-add-edit-faq.php');
									?>		
							</div>
							
							<div class="clearfix"></div>	
							<span class="caption-subject">	
								<?php  esc_html_e('Ijtimoiy profil ','listfoliopro'); ?>
							</span>								
							<hr/>
							<div class="row">
								<?php							
									include( listfoliopro_ep_template. 'private-profile/profile-social.php');
									?>		
							</div>
							
														
							
							<div class="clearfix"></div>	
							<div class="row">
								<div class="col-md-12  "> <hr/>
									<div class="" id="update_message"></div>
									
									<input type="hidden" name="user_post_id" id="user_post_id" value="<?php echo esc_attr($curr_post_id); ?>">
									<button type="button" onclick="listfoliopro_update_post();"  class="btn green-haze"><?php  esc_html_e('Postni yangilash',	'listfoliopro'); ?></button>
								</div>	
							</div>	
						</form>
					</div>
				</div>
				<?php
				} // for Role
			?>
		

<!-- END PROFILE CONTENT -->
<?php
	$save_address=get_post_meta($curr_post_id ,'address',true);
	
	$my_theme = wp_get_theme();
	$theme_name= strtolower($my_theme->get( 'Name' ));
	wp_enqueue_script('listfoliopro_add-edit-listing', listfoliopro_ep_URLPATH . 'admin/files/js/add-edit-listing.js');
	wp_localize_script('listfoliopro_add-edit-listing', 'realpro_data', array(
	'ajaxurl' 					=> admin_url( 'admin-ajax.php' ),
	'loading_image'			=> '<img src="'.listfoliopro_ep_URLPATH.'admin/files/images/loader.gif">',
	'current_user_id'		=>get_current_user_id(),
	'Set_Feature_Image'	=> esc_html__('Set Feature Image','listfoliopro'),
	'Set_plan_Image'		=> esc_html__('Set Image ','listfoliopro'),
	'Set_Event_Image'		=> esc_html__(' Set Image ','listfoliopro'),
	'Gallery_Images'		=> esc_html__('Gallery Images','listfoliopro'),
	'attached_doc'		=> esc_html__('Set Doc','listfoliopro'),
	'permalink'				=> get_permalink(),
	'save_address'			=>$save_address,
	'dirwpnonce'			=> wp_create_nonce("addlisting"),
	'theme_name'			=> $theme_name,
	) );
	?> 		