<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
wp_enqueue_script("jquery");
wp_enqueue_script('jquery-ui-core');
wp_enqueue_script('jquery-ui-accordion');
wp_enqueue_style('bootstrap', 	listfoliopro_ep_URLPATH . 'admin/files/css/iv-bootstrap.css');
wp_enqueue_style('fontawesome', listfoliopro_ep_URLPATH . 'admin/files/css/fontawesome.css');
wp_enqueue_style('jquery.fancybox', listfoliopro_ep_URLPATH . 'admin/files/css/jquery.fancybox.css');
wp_enqueue_style('colorbox', listfoliopro_ep_URLPATH . 'admin/files/css/colorbox.css');
wp_enqueue_style('jquery-ui', listfoliopro_ep_URLPATH . 'admin/files/css/jquery-ui.css');
wp_enqueue_script('colorbox', listfoliopro_ep_URLPATH . 'admin/files/js/jquery.colorbox-min.js');
wp_enqueue_script('jquery.fancybox',listfoliopro_ep_URLPATH . 'admin/files/js/jquery.fancybox.js');
wp_enqueue_style('listfoliopro_single-listing', listfoliopro_ep_URLPATH . 'admin/files/css/single-listing.css');

$main_class = new listfoliopro_eplugins;
$listfoliopro_directory_url=get_option('listfoliopro_ep_url');
if($listfoliopro_directory_url==""){$listfoliopro_directory_url='listing';}
global $post,$wpdb, $current_user;
$favorite_icon='';
$listingid = get_the_ID();
$post_id_1 = get_post($listingid);
$post_id_1->post_title;
$active_single_fields_saved=get_option('listfoliopro_single_fields_saved' );
if(empty($active_single_fields_saved)){$active_single_fields_saved=listfoliopro_get_listing_fields_all_single();}
$single_page_icon_saved=get_option('listfoliopro_single_icon_saved' );
$wp_directory= new listfoliopro_eplugins();
while ( have_posts() ) : the_post();
	$currentCategory = $main_class->listfoliopro_get_categories_caching($listingid,$listfoliopro_directory_url);
	$cat_name2='';
	if(isset($currentCategory[0]->slug)){
		foreach($currentCategory as $c){
			$cat_name2 = $cat_name2. $c->name.' / ';
		}
	}
	$listing_contact_source=get_post_meta($listingid,'listing_contact_source',true);
	if($listing_contact_source==''){$listing_contact_source='user_info';}
	if($listing_contact_source=='new_value'){
		$company_logo='';
	}else{
		$company_logo='';
	}
	// View Count***
	$current_count=get_post_meta($listingid,'listing_views_count',true);
	$current_count=(int)$current_count+1;
	update_post_meta($listingid,'listing_views_count',$current_count);
	$data_for_top=array();
	$data_for_top['category']='category';
	$data_for_top['post_date']='post_date';
	$data_not_for_all_section=array();
	$data_not_for_all_section['title']='title';
	$data_not_for_all_section['address']='address';
	$data_not_for_all_section['price']='price';
	$data_not_for_all_section['category']='category';
	$data_not_for_all_section['contact_button']='contact_button';
	$data_not_for_all_section['pdf_button']='pdf_button';
	$data_not_for_all_section['favorite']='favorite';
	$data_not_for_all_section['simillar_listing']='simillar_listing';
	$data_not_for_all_section['review']='review';
	$data_not_for_all_section['whatsapp']='whatsapp';
	$dir_detail= get_post($listingid);
	$author_id=$dir_detail->post_author;
	$user_info = get_userdata( $author_id);
	$company_email =$user_info->user_email;
	if($listing_contact_source=='new_value'){
		$company_name= get_post_meta($listingid, 'company_name',true);
		$company_address= get_post_meta($listingid, 'address',true);
		$company_web=get_post_meta($listingid, 'contact_web',true);
		$company_phone=get_post_meta($listingid, 'phone',true);
		$company_email= get_post_meta($listingid, 'contact-email',true);
		if(has_post_thumbnail()){
			$feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $listingid ), 'large' );
			if(isset($feature_image[0])){
				$company_logo =$feature_image[0];
			}
		}
	}else{
		$company_name= get_user_meta($author_id,'full_name', true);
		$company_address= get_user_meta($author_id,'address', true);
		$company_web=get_user_meta($author_id,'website', true);
		$company_phone=get_user_meta($author_id,'phone', true);
		$company_logo=get_user_meta($author_id, 'listfoliopro_profile_pic_thum',true);
	}

$not_show_sp_his=array('specialties','history');
	$custom_fields=get_option('listfoliopro_li_fields' );	
	if ( is_array( $custom_fields ) ) {
		foreach($not_show_sp_his as $delete_one_item ){
			unset($custom_fields[$delete_one_item]);
		}
	}	
	if($custom_fields==''){$custom_fields=array();}

	?>

    <div class="bootstrap-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xl-5">
					   <?php					   
						if ( array_key_exists( 'image-gallery', $active_single_fields_saved ) ) {
						?>
							<div class="list-single-slider">							
								<?php include(listfoliopro_ep_template . '/listing/single-template/slider.php'); ?>
							</div>
						<?php
						}
						?>
                    <div class="listing-company-info-wrapper">
                        <div class="listing-contact-info-and-button-wrapper">
	                        <?php
	                        if ( array_key_exists( 'company-logo', $active_single_fields_saved ) ) {
		                        if ( trim( $company_logo ) != '' ) {
			                        ?>
                                    <div class="company-logo"
                                         style="background-image: url(<?php echo esc_url( $company_logo ); ?>)"></div>
			                        <?php
		                        } else {
			                        ?>
                                    <div class="blank-rounded-logo-"></div>
			                        <?php
		                        }
	                        }
	                        ?>
						
                            <div class="contact-title-and-buttons">
	                            <?php esc_html_e("Aloqa ma'lumotlari", 'listfoliopro'); ?>

                                <div class="booking-and-claim-button">
	                                <?php
	                                if ( array_key_exists( 'booking_button', $active_single_fields_saved ) ) {
		                                ?>
                                        <button type="button" onclick="listfoliopro_listing_booking_popup('<?php echo esc_html( $listingid ); ?>')"><?php esc_html_e( 'Band qilish', 'listfoliopro' ); ?></button>
		                                <?php
	                                }

	                                if(array_key_exists('report_button',$active_single_fields_saved)){
		                                ?>
                                        <button type="button" onclick="listfoliopro_claim_popup('<?php echo esc_html($listingid);?>')"><?php esc_html_e( 'Hsobot', 'listfoliopro' ); ?></button>
		                                <?php

	                                }
	                                ?>
									<?php
										if ( array_key_exists( 'open_status', $active_single_fields_saved ) ) {
											$openStatus = listfoliopro_check_time( $listingid );
											?>
											<span class="card-time ml-3"><?php
												$saved_icon = listfoliopro_get_icon( $single_page_icon_saved, 'open_status', 'single' );
												?><i class=" <?php echo esc_html( $saved_icon ); ?>   <?php echo( $openStatus == 'Open Now' ? " open-green" : ' close-red' ) ?>"></i><strong
														class="small-heading  <?php echo( $openStatus == 'Open Now' ? " open-green" : ' close-red' ) ?>"><?php echo esc_html( $openStatus ); ?>
												</strong>
											</span>
											<?php
										}
										?>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="company-info">
                            <div>
							  <?php
                                    if(array_key_exists('company-name',$active_single_fields_saved)){
                                        ?>								
                                <span class="company-name"><?php echo esc_html($company_name); ?></span>
									<?php } ?>
								 <?php
                                    if(array_key_exists('location',$active_single_fields_saved)){
                                        ?>		
                                <div class="company-location">
                                    <?php include(listfoliopro_ep_template . '/listing/single-template/locations.php'); ?>
                                </div>
								<?php } ?>
                                <div class="listing-company-details">
                                    <?php
                                    if(array_key_exists('address',$active_single_fields_saved)){
                                        ?>
                                        <ul>
                                            <?php if($company_address!=''){  ?>
                                                <li><span class="info-title"><?php esc_html_e('Manzil:','listfoliopro'); ?></span><?php echo esc_html($company_address); ?></li>
                                                <?php
                                            }
                                            ?>

                                            <?php if($company_phone!=''){  ?>
                                                <li><span class="info-title"><?php esc_html_e('Telefon raqam:','listfoliopro'); ?></span><?php echo esc_html($company_phone); ?></li>
                                                <?php
                                            }
                                            ?>

                                            <?php if($company_email!=''){  ?>
                                                <li><span class="info-title"><?php esc_html_e('Email:','listfoliopro'); ?></span><?php echo esc_html($company_email); ?></li>
                                                <?php
                                            }
                                            ?>

                                            <?php if($company_web!=''){  ?>
                                                <li><span class="info-title"><?php esc_html_e('web-sayt:','listfoliopro'); ?></span><?php echo esc_html($company_web); ?></li>
                                                <?php
                                            }
                                            ?>

                                        </ul>
                                        <?php
                                    }
                                    ?>
                                </div>
									<?php
                                    if(array_key_exists('social-profile',$active_single_fields_saved)){
                                        ?>
										<div class="company-social-wrapper">
											<ul>
											<?php 
														if(get_post_meta($listingid ,'facebook',true)!=''){
														?>
												<li><a href="<?php echo esc_url(get_post_meta($listingid ,'facebook',true)); ?>"><i class="fab fa-facebook"></i></a></li>
												<?php  
													} ?>
												<?php 
														if(get_post_meta($listingid ,'twitter',true)!=''){
														?>
												<li><a href="<?php echo esc_url(get_post_meta($listingid ,'twitter',true)); ?>"><i class="fab fa-twitter"></i></a></li>
												<?php  
														} ?>
												<?php 
														if(get_post_meta($listingid ,'instagram',true)!=''){
														?>
												<li><a href="<?php echo esc_url(get_post_meta($listingid ,'instagram',true)); ?>"><i class="fab fa-instagram"></i></a></li>
												<?php 
														} ?>
												<?php
														if(get_post_meta($listingid ,'linkedin',true)!=''){
														?>
												<li><a href="<?php echo esc_url(get_post_meta($listingid ,'linkedin',true)); ?>"><i class="fab fa-linkedin"></i></a></li>
												<?php 
														} ?>
												<?php if(array_key_exists('whatsapp',$active_single_fields_saved)){ 
														if(get_post_meta($listingid ,'whatsapp',true)!=''){
														?>
													<li><a href="<?php echo esc_url('https://api.whatsapp.com/send?phone=');?><?php echo esc_html(get_post_meta($listingid ,'whatsapp',true)); ?>"><i class="fab fa-whatsapp"></i></a></li> 
														<?php } 
														} ?>		
											</ul>
										</div>
								<?php } ?>
                              
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-7">
                    <div class="single-listing-main-wrapper">
						<?php
						if(array_key_exists('title',$active_single_fields_saved)){
							?>
                            <h2 class="single-listing-title">
                                <?php echo get_the_title($listingid); ?>
	                            <?php
	                            if ( array_key_exists( 'pdf_button', $active_single_fields_saved ) ) {
		                            ?>
                                    <a class="single-listing-pdf-button" href="<?php echo get_permalink(); ?>?&listfoliopropdfpost=<?php echo esc_attr( $listingid ); ?>"
                                       target="_blank">
                                        <i class="fas fa-download"></i>
                                    </a>
		                            <?php
	                            }
	                            ?>
                            </h2>
							<?php
						}
						?>
                        <div class="single-listing-category-rating-wrapper">
                            <div class="single-listing-first-category">
								<?php
								if (array_key_exists('category', $active_single_fields_saved)) {
									$currentCategory = $main_class->listfoliopro_get_categories_caching($id, $listfoliopro_directory_url);

									// Check if $currentCategory is not empty before accessing its elements
									if (!empty($currentCategory) && isset($currentCategory[0]->slug)) {
										$cat_name2 = esc_html($currentCategory[0]->name);
										$cat_link = get_category_link($currentCategory[0]->term_id);

										// Output the category name and link
										echo '<a href="' . esc_url($cat_link) . '">' . $cat_name2 . '</a>';
									}
								}
								?>
                            </div>
								
							<?php
								if (array_key_exists('review', $active_single_fields_saved)) { ?>
                            <div class="single-listing-rating-count">
								<?php
								$user_id=$id;
								$total_review_point=0;
								$one_review_total=0;
								$two_review_total=0;
								$three_review_total=0;
								$four_review_total=0;
								$five_review_total=0;
								$post_type='listfoliopro_review';
								$sql= $wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_type ='listfoliopro_review'  and post_author='%s' 	and post_status='publish' ORDER BY ID DESC",$user_id);
								$reg_page_user='';
								$iv_redirect_user = get_option( '_ep_ivproperty_profile_public_page');
								if($iv_redirect_user!='defult'){
									$reg_page_user= get_permalink( $iv_redirect_user) ;
								}
								$listing_author_link=get_option('listing_author_link');
								if($listing_author_link==""){$listing_author_link='author';}
								$author_reviews = $wpdb->get_results($sql);
								$total_reviews=count($author_reviews);
								if($total_reviews>0){
									foreach ( $author_reviews as $review )
									{
										$review_val=(int)get_post_meta($review->ID,'review_value',true);
										$review_val2=(float)get_post_meta($review->ID,'review_value',true);
										$total_review_point=$total_review_point+ $review_val2;
										if($review_val=='1'){
											$one_review_total=$one_review_total+1;
										}
										if($review_val=='2'){
											$two_review_total=$two_review_total+1;
										}
										if($review_val=='3'){
											$three_review_total=$three_review_total+1;
										}
										if($review_val=='4'){
											$four_review_total=$four_review_total+1;
										}
										if($review_val=='5'){
											$five_review_total=$five_review_total+1;
										}
									}
								}
								$avg_review=0;
								if($total_review_point>0){
									$avg_review= (float)$total_review_point/(float)$total_reviews;
								}
								$saved_listing_avg_rating=get_post_meta($id,'review',true);
								if($avg_review!=$saved_listing_avg_rating){
									update_post_meta($id,'review',$avg_review);
								}
								?>

                                <div class="single-listing-review-star">
									<?php
									if($avg_review >=.75 ){ ?><i class="fas fa-star off-white"></i><?php }elseif($avg_review >=.1){ ?><i class="fas fa-star-half-alt  half-off-white"></i> <?php }else{?> <i class="far fa-star off-white"></i><?php } ?>
									<?php
									if($avg_review >=1.75 ){ ?><i class="fas fa-star off-white"></i><?php }elseif($avg_review >=1.1){ ?><i class="fas fa-star-half-alt  half-off-white"></i> <?php }else{?> <i class="far fa-star off-white"></i><?php } ?>
									<?php
									if($avg_review >=2.75 ){ ?><i class="fas fa-star off-white"></i><?php }elseif($avg_review >=2.1){ ?><i class="fas fa-star-half-alt  half-off-white"></i> <?php }else{?> <i class="far fa-star off-white"></i><?php } ?>
									<?php
									if($avg_review >=3.75 ){ ?><i class="fas fa-star off-white"></i><?php }elseif($avg_review >=3.1){ ?>
                                        <i class="fas fa-star-half-alt  half-off-white"></i> <?php }else{?> <i class="far fa-star off-white"></i><?php } ?>
									<?php
									if($avg_review >=4.75 ){ ?><i class="fas fa-star off-white"></i><?php }elseif($avg_review >=4.1){ ?><i class="fas fa-star-half-alt  half-off-white"></i> <?php }else{?> <i class="far fa-star off-white"></i><?php } ?>
                                </div>


                                <span class="total-review"><?php echo esc_html($total_reviews);?>&nbsp;</span>
								<?php if ($total_reviews <= 1){
									echo esc_html__('Review', 'listfoliopro');
								}else{
									echo esc_html__('Reviews','listfoliopro');
								} ?>

                            </div>
								<?php } ?>	
						</div>
						<?php
							if (array_key_exists('tag', $active_single_fields_saved)) { ?>	
								<div class="single-listing-facilities">
									<?php include(listfoliopro_ep_template . '/listing/single-template/tags.php'); ?>
								</div>
							<?php } ?>	
						<?php
							if (array_key_exists('price', $active_single_fields_saved)) { ?>	
                        <div class="single-listing-price">
							<?php include(listfoliopro_ep_template . '/listing/single-template/price.php'); ?>
                        </div>
						<?php } ?>	
                        <hr>

                        <div class="single-listing-location-and-date-wrapper">
								<?php
							if (array_key_exists('location', $active_single_fields_saved)) { ?>	
                            <div class="location-wrap">
								<?php include(listfoliopro_ep_template . '/listing/single-template/locations.php'); ?>
                            </div>
							<?php } ?>	
							<?php
							if (array_key_exists('post_date', $active_single_fields_saved)) { ?>	
                            <div class="date-wrap">
                                    <span><?php
										$saved_icon = listfoliopro_get_icon( $single_page_icon_saved, 'post_date', 'single' );
										?><i class="fa-solid fa-location-dot"></i><?php echo get_the_date( 'd F - Y g:i a ', $id ); ?>
					            </span>
                            </div>
							<?php } ?>	
                        </div>

                        <div class="listfoliopro-list-details-tab-wrapper">
                            <ul class="nav nav-tabs" id="single-listing-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="true"><?php echo esc_html__("Batafsil",'listfoliopro'); ?></button>
                                </li>
								<?php
									if(array_key_exists('review',$active_single_fields_saved)){ ?>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false"><?php echo esc_html__("Fikrlar",'listfoliopro'); ?></button>
                                </li>
								<?php } ?>
								<?php
									if(array_key_exists('faq',$active_single_fields_saved)){ ?>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="faq-tab" data-bs-toggle="tab" data-bs-target="#faq" type="button" role="tab" aria-controls="faq" aria-selected="false"><?php echo esc_html__("Savol&Javob",'listfoliopro'); ?></button>
                                </li>
								<?php } ?>
								<?php
									if(array_key_exists('contact_button',$active_single_fields_saved)){ ?>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false"><?php echo esc_html__("Bog'lanish",'listfoliopro'); ?></button>
                                </li>
									<?php } ?>
                            </ul>
                            <div class="tab-content" id="single-listing-tab-content">
                                <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                                    <div class="single-listing-desc-wrapper">
										<?php
										$saved_icon_cat = '';
										if ( is_array( $active_single_fields_saved ) ) {
											foreach ( $active_single_fields_saved as $field_key => $field_value ) {
												$saved_icon = listfoliopro_get_icon( $single_page_icon_saved, $field_key, 'single' );
												if ( ! in_array( $field_key, $data_for_top ) and ! in_array( $field_key, $data_not_for_all_section ) ) {
													switch ( $field_key ) {
														case "description":
															?>

                                                            <div class="single-listing-desc">
																<?php

																$content_post = get_post( $listingid );
																$content      = $content_post->post_content;
																$content      = apply_filters( 'the_content', $content );
																$content      = str_replace( ']]>', ']]&gt;', $content );
																echo do_shortcode( $content );
																?>
                                                                <figure class="wp-block-table">
                                                                    <table>
                                                                        <tbody>
																		<?php

																		if ( is_array( $custom_fields ) ) {
																			foreach ( $custom_fields as $cus_field_key => $cus_field_value ) {
																				if ( array_key_exists( $cus_field_key, $active_single_fields_saved ) ) {
																					$saved_icon_c_field = listfoliopro_get_icon( $single_page_icon_saved, $cus_field_key, 'single' );
																					?>
                                                                                    <tr>
                                                                                        <td class="text-left">
																							<?php if ( $saved_icon_c_field != '' ) { ?>
                                                                                                <i class="<?php echo esc_html( $saved_icon_c_field ); ?>"></i>
																								<?php
																							}
																							?>

																							<?php echo esc_html( $cus_field_value ); ?>
                                                                                        </td>
                                                                                        <td><?php echo esc_html( get_post_meta( $listingid, $cus_field_key, true ) ); ?></td>
                                                                                    </tr>
																					<?php

																				}
																			}
																		}
																		?>
                                                                        </tbody>
                                                                    </table>
                                                                </figure>
                                                            </div>
															<?php
															break;
														case "video":
															include( listfoliopro_ep_template . '/listing/single-template/video.php' );
															break;
														case "attachments":
															include( listfoliopro_ep_template . '/listing/single-template/attachments.php' );
															break;

														default:
														    
															if(!array_key_exists($field_key, $custom_fields)){
														
																if ( get_post_meta( $id, $field_key, true ) != '' ) {
																	$custom_meta_data = get_post_meta( $id, $field_key, true );
																	if ( is_array( $custom_meta_data ) ) {
																		$full_data = '';
																		foreach ( $custom_meta_data as $one_data ) {
																			$full_data = $full_data . '<span class="btn btn-small background-urgent btn-pink mr-1">' . $one_data . '</span>';
																		}
																		$custom_meta_data = $full_data;
																	}
																	?>
																	<div class="single-section-title"><i
																				class="<?php echo esc_html( $saved_icon ); ?>"></i> <?php echo esc_html( ucwords( str_replace( '_', ' ', $field_key ) ) ); ?>
																	</div>
																	<div class="single-listing-custom-field-content"> <?php echo wp_kses( $custom_meta_data, 'post' ); ?></div>
																	<?php
																}
															}	
															break;
													}
												}
											}
										}
										?>
                                    </div>
									<?php 
									if ( array_key_exists( 'map', $active_single_fields_saved ) ) { ?>
                                    <div class="location-map">
                                        <div class="location-title single-section-title">
                                            <img src="<?php echo esc_url(listfoliopro_ep_URLPATH."/assets/images/lmap.svg"); ?>" alt="locationicon">
											<?php esc_html_e('Location', 'listfoliopro'); ?>
                                        </div>
										<?php										
											 $latitude  = trim(get_post_meta( $listingid, 'latitude', true ));
											 $longitude = trim(get_post_meta( $listingid, 'longitude', true ));
											if ( $latitude != '' and $longitude != '' ) {
												?>                                               
												 <iframe src="https://maps.google.com/maps?q=<?php echo esc_attr( $company_address ); ?>&amp;ie=UTF8&amp;&amp;output=embed"></iframe>
												<?php
											} else {
												?>
                                                <iframe src="https://maps.google.com/maps?q=<?php echo esc_attr( $company_address ); ?>&amp;ie=UTF8&amp;&amp;output=embed"></iframe>
												<?php
											}
										
										?>
                                    </div>
									<?php } ?>
									<?php
										if (array_key_exists('category', $active_single_fields_saved)) { ?>
                                    <div class="single-listing-category-wrapper">
                                        <div class="category-title single-section-title">
                                            <img src="<?php echo esc_url(listfoliopro_ep_URLPATH."/assets/images/grid-01.svg"); ?>" alt="locationicon">
											<?php esc_html_e('Categories', 'listfoliopro'); ?>
                                        </div>
	
											<?php
											$currentCategory = $main_class->listfoliopro_get_categories_caching($id, $listfoliopro_directory_url);
											$saved_icon = '';
											$cat_name2 = '';
											$i = 0;

											if (isset($currentCategory[0]->slug)) {
												foreach ($currentCategory as $c) {
													$cat_name2 .= '<a href="' . esc_url(get_category_link($c->term_id)) . '">' . esc_html($c->name) . '</a>';
													$i++;
												}

												echo $cat_name2;
											}
										
										?>

                                    </div>
										<?php } ?>
                                </div>

                                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
									<?php
									if(array_key_exists('review',$active_single_fields_saved)){
										include(listfoliopro_ep_template.'/listing/single-template/reviews.php');
									}
									?>
                                </div>

                                <div class="tab-pane fade" id="faq" role="tabpanel" aria-labelledby="faq-tab">
									<?php
											if(array_key_exists('faq',$active_single_fields_saved)){ ?>
									<?php include( listfoliopro_ep_template . '/listing/single-template/faqs.php' ); ?>
									<?php } ?>
                                </div>

                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
									<?php
									if(array_key_exists('contact_button',$active_single_fields_saved)){ ?>
									<?php include(listfoliopro_ep_template . '/listing/contact-form.php'); ?>
									<?php } ?>
                                </div>
                            </div>
                        </div>

						<?php
						if(array_key_exists('social-share',$active_single_fields_saved)){
							?>
                            <div class="social-share">

                                <span class="single-list-share-title"><?php esc_html_e('Share:', 'listfoliopro'); ?> </span>
                                <div class="single-list-share-icon-wrapper">
                                    <a class=" d-inline-block d-middle" href="<?php echo esc_url('https://www.facebook.com/sharer/sharer.php?u='.get_the_permalink($listingid ));?>">
                                        <img alt="" src="<?php echo esc_url(listfoliopro_ep_URLPATH.'/assets/images/share-fb.svg'); ?>"></a>
                                    <a class=" d-inline-block d-middle" href="<?php echo esc_url('https://twitter.com/home?status='.get_the_permalink($listingid ));?>">
                                        <img alt="" src="<?php echo esc_url(listfoliopro_ep_URLPATH.'/assets/images/share-tw.svg'); ?>"></a>
                                    <a class=" d-inline-block d-middle" href="<?php echo esc_url('http://www.reddit.com/submit?url='. get_the_permalink($listingid ));?>">
                                        <img alt="" src="<?php echo esc_url(listfoliopro_ep_URLPATH.'/assets/images/share-red.svg'); ?>"></a>
                                    <a class="d-inline-block d-middle" href="<?php echo esc_url('https://api.whatsapp.com/send?text='.get_the_permalink($listingid ));?>">
                                        <img alt="" src="<?php echo esc_url(listfoliopro_ep_URLPATH.'/assets/images/share-whatsapp.svg'); ?>"></a>
                                </div>
                            </div>
							<?php
						}
						?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Items For Use Later -->
    <div class="item-for-use-letter" style="display: none">
		<?php
		$topbanner = get_post_meta( $listingid, 'topbanner', true );
		if ( trim( $topbanner ) != '' ) {
			$default_image_banner = wp_get_attachment_url( $topbanner );
		} else {
			if ( get_option( 'listfoliopro_banner_defaultimage' ) != '' ) {
				$default_image_banner = wp_get_attachment_image_src( get_option( 'listfoliopro_banner_defaultimage' ), 'large' );
				if ( isset( $default_image_banner[0] ) ) {
					$default_image_banner = $default_image_banner[0];
				}
			} else {
				$default_image_banner = listfoliopro_ep_URLPATH . "/assets/images/banner.png";
			}
		}

		?>
		<?php
		if ( array_key_exists( 'top-image', $active_single_fields_saved ) ) {
			?>
            <div class=" banner-hero banner-image-single mt-1"
                 style="background:url(<?php echo esc_url( $default_image_banner ); ?>) no-repeat; background-size:cover;"></div>
			<?php
		}
		?>

		<?php
		if ( array_key_exists( 'open_status', $active_single_fields_saved ) ) {
			$openStatus = listfoliopro_check_time( $listingid );
			?>
            <span class="card-time ml-3"><?php
				$saved_icon = listfoliopro_get_icon( $single_page_icon_saved, 'open_status', 'single' );
				?><i class=" <?php echo esc_html( $saved_icon ); ?>   <?php echo( $openStatus == 'Open Now' ? " open-green" : ' close-red' ) ?>"></i><strong
                        class="small-heading  <?php echo( $openStatus == 'Open Now' ? " open-green" : ' close-red' ) ?>"><?php echo esc_html( $openStatus ); ?></strong>
    </span>
			<?php
		}
		?>

        <div class="btn-feature text-right">
			<?php
			$user_ID    = get_current_user_id();
			$favourites = 'no';
			if ( $user_ID > 0 ) {
				$my_favorite = get_post_meta( $id, '_favorites', true );
				$all_users   = explode( ",", $my_favorite );
				if ( in_array( $user_ID, $all_users ) ) {
					$favourites = 'yes';
				}
			}
			?>





			<?php
			if ( array_key_exists( 'favorite', $active_single_fields_saved ) ) {

				$favorite_icon = listfoliopro_get_icon( $single_page_icon_saved, 'favorite', 'single' );
				if ( $favorite_icon == '' ) {
					$favorite_icon = 'far fa-heart';
				} else {
					$favorite_icon = str_replace( 'mr-2', '', $favorite_icon );
				}
				?>
                <span id="fav_dir<?php echo esc_html( $listingid ); ?>">
                        <?php
                        if ( $favourites == 'yes' ) { ?>
                            <button class="btn btn-big mb-2" data-placement="left" data-toggle="tooltip"
                                    href="javascript:;"
                                    onclick="listfoliopro_save_unfavorite('<?php echo esc_attr( $listingid ); ?>')">
                                <i class="<?php echo esc_html( $favorite_icon ); ?>"></i>
                            </button>
	                        <?php
                        } else {
	                        ?>
                            <button class="btn btn-border mb-2" data-placement="left" data-toggle="tooltip"
                                    href="javascript:;"
                                    onclick="listfoliopro_save_favorite('<?php echo esc_attr( $listingid ); ?>')">
                                <i class="<?php echo esc_html( $favorite_icon ); ?>"></i>
                            </button>
	                        <?php
                        }
                        ?>
                    </span>
				<?php
			}
			?>
        </div>

		<?php

		if ( array_key_exists( 'whatsapp', $active_single_fields_saved ) ) {
			include( listfoliopro_ep_template . '/listing/single-template/whatsapp_contact.php' );
		}
		if ( array_key_exists( 'open_status_table', $active_single_fields_saved ) ) {
			include( listfoliopro_ep_template . '/listing/single-template/business_hours.php' );
		}
		?>
		<?php
		if ( array_key_exists( 'simillar_listing', $active_single_fields_saved ) ) {
			include( listfoliopro_ep_template . '/listing/single-template/similar-listings.php' );
		}
		?>

        <div class="sidebar-list-listing">

			<?php
			if(array_key_exists('address',$active_single_fields_saved)){
				?>
                <ul class="ul-disc">
					<?php if($company_address!=''){  ?>
                        <li><?php echo esc_html($company_address); ?></li>
						<?php
					}
					?>
					<?php if($company_phone!=''){  ?>
                        <li><?php esc_html_e('Phone','listfoliopro'); ?> : <?php echo esc_html($company_phone); ?></li>
						<?php
					}
					?>
					<?php if($company_email!=''){  ?>
                        <li><?php esc_html_e('Email','listfoliopro'); ?> : <?php echo esc_html($company_email); ?></li>
						<?php
					}
					?>

                </ul>
				<?php
			}
			?>
        </div>
    </div>

<?php
endwhile;
wp_enqueue_script('popper', listfoliopro_ep_URLPATH . 'admin/files/js/popper.min.js');
wp_enqueue_script('bootstrap', listfoliopro_ep_URLPATH . 'admin/files/js/bootstrap.min-4.js');

wp_enqueue_script('listfoliopro_single-listing', listfoliopro_ep_URLPATH . 'admin/files/js/single-listing.js');
wp_localize_script('listfoliopro_single-listing', 'listfoliopro_data', array(
	'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
	'loading_image'		=> '<img src="'.listfoliopro_ep_URLPATH.'admin/files/images/loader.gif">',
	'current_user_id'	=>get_current_user_id(),
	'Please_login'=>esc_html__('Please login', 'listfoliopro' ),
	'Add_to_Favorites'=>esc_html__('Save', 'listfoliopro' ),
	'Added_to_Favorites'=>esc_html__('Saved', 'listfoliopro' ),
	'Please_put_your_message'=>esc_html__('Please put your detail', 'listfoliopro' ),
	'contact'=> wp_create_nonce("contact"),
	'listing'=> wp_create_nonce("listing"),
	'cv'=> wp_create_nonce("Doc/CV/PDF"),
	'listfoliopro_ep_URLPATH'=>listfoliopro_ep_URLPATH,
	'favorite_icon'=>$favorite_icon,
) );


?>
<?php
wp_reset_query();
?>
<?php
get_footer();
?>