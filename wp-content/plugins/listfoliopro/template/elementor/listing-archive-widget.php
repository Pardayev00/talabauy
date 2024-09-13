<?php
namespace Elementor;

class ListFolioPro_Listing_Archive_Widget extends Widget_Base {

	public function get_name() {
		return 'listfoliopro_listing_archive_widget';
	}

	public function get_title() {
		return esc_html__( 'Listing Archive', 'listfoliopro' );
	}

	public function get_icon() {
		return 'eicon-post-excerpt';
	}

	public function get_categories() {
		return [ 'listfoliopro_elements' ];
	}


	protected function register_controls() {

        $this->start_controls_section(
            'top_search_form',
            [
                'label' => esc_html__( 'Top Search', 'listfoliopro' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

		$repeater = new Repeater();
		$repeater->add_control(
			'field_label',
			[
				'label'       => __( 'Label', 'listfoliopro' ),
				'label_block'       => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Field Label', 'listfoliopro' ),
			]
		);

		$repeater->add_control(
			'field_name',
			[
				'label'   => __( 'Select Form Field', 'listfoliopro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'title'                    => __( 'Title', 'listfoliopro' ),
					'listing-category'             => __( 'Categories', 'listfoliopro' ),
					'listing-tag'                  => __( 'Tags', 'listfoliopro' ),
					'listing-locations'            => __( 'Locations', 'listfoliopro' ),
					'sort_listing'             => __( 'Short Listing', 'listfoliopro' ),
					'near_to_me'               => __( 'Near To Me', 'listfoliopro' ),
					'post_date'                => __( 'Post Date', 'listfoliopro' ),
					'listing_type'                 => __( 'Listing Type', 'listfoliopro' ),
				],
			]
		);

		$repeater->add_control(
			'field_type',
			[
				'label'   => __( 'Form Field Type', 'listfoliopro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'text-field',
				'options' => [
					'text-field'           => __( 'Text', 'listfoliopro' ),
					'drop-down'            => __( 'DropDown', 'listfoliopro' ),
					'multi-checkbox'       => __( 'Multi Checkbox', 'listfoliopro' ),
					'multi-checkbox-group' => __( 'Multi Checkbox Group', 'listfoliopro' ),
					'datefield'            => __( 'Date', 'listfoliopro' ),

				],
			]
		);

		$this->add_control(
			'form_fields',
			[
				'label'       => __( 'Form Fields', 'listfoliopro' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'field_name' => '',
						'field_type' => 'text-field',
					],
				],
				'title_field' => '{{{ field_label }}}',
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'listing_option',
			[
				'label' => esc_html__( 'Listing Option', 'listfoliopro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'listing_count',
			[
				'label'   => __( 'Number Of Listing To Show', 'listfoliopro' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => - 1,
				'max'     => '',
				'step'    => 1,
				'default' => 4,
			]
		);

		$this->add_control(
			'category',
			[
				'label'       => __( 'Categories', 'listfoliopro' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'options'     => listfoliopro_listing_categories(),
			]
		);
		
		$this->add_control(			
			'listingtype',
			[
				'label'       => __( 'Listing Type', 'listfoliopro' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'options'     => listfoliopro_listing_type(),
			]
		);

		$this->add_control(
			'pagination',
			[
				'label'     => esc_html__( 'Enable Pagination', 'listfoliopro' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'listfoliopro' ),
				'label_off' => esc_html__( 'No', 'listfoliopro' ),
				'default'   => 'no',
			]
		);

		$this->add_control(
			'show_excerpt',
			[
				'label'   => __( 'Excerpt', 'listfoliopro' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'excerpt_length',
			[
				'label'     => __( 'Excerpt Lenth', 'listfoliopro' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => '',
				'step'      => 1,
				'default'   => 14,
				'condition' => [
					'show_excerpt' => 'yes',
				]
			]
		);

        $this->add_control(
            'enable_category_rating',
            [
                'label'     => esc_html__( 'Enable Category & Rating', 'listfoliopro' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'Yes', 'listfoliopro' ),
                'label_off' => esc_html__( 'No', 'listfoliopro' ),
                'default'   => 'yes',
            ]
        );

		$this->add_control(
			'enable_date',
			[
				'label'     => esc_html__( 'Enable Date', 'listfoliopro' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'listfoliopro' ),
				'label_off' => esc_html__( 'No', 'listfoliopro' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'enable_location',
			[
				'label'     => esc_html__( 'Enable Location', 'listfoliopro' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'listfoliopro' ),
				'label_off' => esc_html__( 'No', 'listfoliopro' ),
				'default'   => 'yes',
			]
		);

		

		$this->add_control(
			'enable_price',
			[
				'label'     => esc_html__( 'Enable Price', 'listfoliopro' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'listfoliopro' ),
				'label_off' => esc_html__( 'No', 'listfoliopro' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'desktop_col',
			[
				'label'   => __( 'Columns On Desktop', 'listfoliopro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'col-xl-6',
				'options' => [
					'col-xl-12' => __( '1 Column', 'listfoliopro' ),
					'col-xl-6'  => __( '2 Column', 'listfoliopro' ),
					'col-xl-4'  => __( '3 Column', 'listfoliopro' ),
					'col-xl-3'  => __( '4 Column', 'listfoliopro' ),
				],
			]
		);

		$this->add_control(
			'iPad_pro_col',
			[
				'label'   => __( 'Columns On iPad Pro', 'listfoliopro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'col-lg-6',
				'options' => [
					'col-lg-12' => __( '1 Column', 'listfoliopro' ),
					'col-lg-6'  => __( '2 Column', 'listfoliopro' ),
					'col-lg-4'  => __( '3 Column', 'listfoliopro' ),
					'col-lg-3'  => __( '4 Column', 'listfoliopro' ),
				],
			]
		);

		$this->add_control(
			'tab_col',
			[
				'label'   => __( 'Columns On Tab', 'listfoliopro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'col-sm-6',
				'options' => [
					'col-sm-12' => __( '1 Column', 'listfoliopro' ),
					'col-sm-6'  => __( '2 Column', 'listfoliopro' ),
					'col-sm-4'  => __( '3 Column', 'listfoliopro' ),
					'col-sm-3'  => __( '4 Column', 'listfoliopro' ),
				],
			]
		);

        $this->add_control(
            'enable_map',
            [
                'label'     => esc_html__( 'Enable Map', 'listfoliopro' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'Yes', 'listfoliopro' ),
                'label_off' => esc_html__( 'No', 'listfoliopro' ),
                'default'   => 'yes',
            ]
        );

        $this->end_controls_section();

	}

	//Render
	protected function render() {
		$settings = $this->get_settings_for_display();

    ?>

		<?php
		if ( ! defined( 'ABSPATH' ) ) exit;
		wp_enqueue_script("jquery");
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jquery-ui-autocomplete');
		wp_enqueue_script('popper', listfoliopro_ep_URLPATH . 'admin/files/js/popper.min.js');
		wp_enqueue_script('bootstrap', listfoliopro_ep_URLPATH . 'admin/files/js/bootstrap.min-4.js');
		wp_enqueue_style('bootstrap', listfoliopro_ep_URLPATH . 'admin/files/css/iv-bootstrap.css');
		wp_enqueue_style('listfoliopro_listing_style_alphabet_sort', listfoliopro_ep_URLPATH . 'admin/files/css/archive-listing.css');
		wp_enqueue_style('colorbox', listfoliopro_ep_URLPATH . 'admin/files/css/colorbox.css');
		wp_enqueue_script('colorbox', listfoliopro_ep_URLPATH . 'admin/files/js/jquery.colorbox-min.js');
		wp_enqueue_style('jquery-ui', listfoliopro_ep_URLPATH . 'admin/files/css/jquery-ui.css');
		wp_enqueue_style('font-awesome', listfoliopro_ep_URLPATH . 'admin/files/css/all.min.css');
		wp_enqueue_style('flaticon', listfoliopro_ep_URLPATH . 'admin/files/fonts/flaticon/flaticon.css');
		wp_enqueue_style('listfoliopro_post-paging', listfoliopro_ep_URLPATH . 'admin/files/css/post-paging.css');
		$main_class = new \listfoliopro_eplugins;
		global $post,$wpdb,$tag,$listfoliopro_query,$listfoliopro_filter_badge;
		$listfoliopro_directory_url=get_option('listfoliopro_ep_url');
		if($listfoliopro_directory_url==""){$listfoliopro_directory_url='listing';}
				
		$ins_lat='';$ins_lng='';$dirs_json_map='';
	
		$defaul_feature_img= $main_class->listfoliopro_listing_default_image();
		$dirs_data =array();
		$tag_arr= array();
		$search_arg= array();
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

		$args = array(
			'post_type' => $listfoliopro_directory_url, // enter your custom post type
			'paged' => $paged,
			'post_status' => 'publish',
			'posts_per_page'=> $settings['listing_count'],  // overrides posts per page in theme settings
		);

		$search_arg= listfoliopro_get_search_args($listfoliopro_directory_url);
		$args= array_merge( $args, $search_arg );
		$lat='';$long='';$keyword_post='';$address='';$postcats ='';$selected='';
		// Add new shortcode only category
		if ( ! empty( $settings['category'] ) ) {
			$args[$listfoliopro_directory_url.'-category']=$settings['category'];
		}
		if ( ! empty( $settings['listingtype'] ) ) {
			$args[$listfoliopro_directory_url.'-type']=$settings['listingtype'];
		}
		
		if( isset($_REQUEST['listing-author'])){
			$author = sanitize_text_field($_REQUEST['listing-author']);
			$args['author']= (int)sanitize_text_field($author);
		}
		// For featrue listing***********
		$feature_listing_all =array();
		$feature_listing_all =$args;
		if(isset($search_arg['lng']) and $search_arg['lng']!=''){
			$listfoliopro_query = new \WP_GeoQuery( $args );
		}else{
			$listfoliopro_query = new \WP_Query( $args );
		}
		
						
		$active_archive_fields=listfoliopro_get_archive_fields_all();
		$active_archive_icon_saved=get_option('listfoliopro_archive_icon_saved' );		
		$column = $settings['desktop_col'] . ' ' . $settings['iPad_pro_col'] . ' ' . $settings['tab_col'];
        if($settings['enable_map'] == 'yes') {
            $item_wrapper = 'col-xl-7 col-lg-12  archivescroll';
        }else{
	        $item_wrapper = 'col-12';
        }
		?>
        <!-- wrap everything for our isolated bootstrap -->
        <div class="bootstrap-wrapper listfoliopro-archive-page">
            <!-- archieve page own design font and others -->
            <section class="">
                <div class="container-fluid ">
                    <!-- Search Form -->

                    <div class="row" id="full_grid">
                        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 " >
	                        <?php
	                        if($settings['form_fields']){
		                        $form_fields = array();
		                        $form_field_types = array();
		                        foreach ($settings['form_fields'] as $form_field){
			                        $form_fields[] = $form_field['field_name'];
			                        $form_field_types[] = $form_field['field_type'];
		                        }
		                        $field_list= implode(",",$form_fields);
		                        $field_type_list= implode(",",$form_field_types);
	                        }
	                        echo do_shortcode( '[listfoliopro_search action="same_page" field-name="'.$field_list.'" field-type="'.$field_type_list.'" ]' );
	                        ?>
                        </div>

                        <!-- end of search form -->


                        <div class="<?php echo $item_wrapper;?>" id="dirpro_directories" >
                            <div class="row listing-top-button-wrapper">
                                <div class="col-xl-3 col-lg-3 col-md-3  col-sm-6 col-6 ">
                                    <div class="pull-left clearfix">
										<?php echo esc_html($listfoliopro_query->found_posts);?><?php esc_html_e(' Results','listfoliopro');?>
                                    </div>
                                </div>
                                <div class="col-xl-9 col-lg-9 col-md-9  col-sm-6 col-6 ">
                                    <div class="listing-top-layout">
									
                                        <ul class="listing-layout-btn">
                                            <li class="listing-grid-btn">
                                                <i class="fa-solid fa-grip-vertical" aria-hidden="true"></i>
                                            </li>

                                            <li class="listing-list-btn">
                                                <i class="fa-solid fa-grip" aria-hidden="true"></i>
                                            </li>

											<?php
											if( $listfoliopro_filter_badge>0 ){
												?>
                                                <li class="topicon-border">
                                                    <a id="resetmainpage"  href="#" data-placement="top" data-toggle="tooltip"  title="<?php  esc_html_e('Reset Search','listfoliopro'); ?>"><i class="fa fa-refresh" aria-hidden="true"></i>
                                                    </a>
                                                </li>
												<?php
											}
											?>
                                        </ul>
                                    </div>


                                </div>
                            </div>
                            <div class="clearfix"></div>


                            <div class="row" >
								<?php
								


								$i=0;
								if ( $listfoliopro_query->have_posts() ) :
									while ( $listfoliopro_query->have_posts() ) : $listfoliopro_query->the_post();
										$id = get_the_ID();
										if(get_post_meta($id, 'listfoliopro_featured', true)=='featured'){
											$feature_img='';
											if(has_post_thumbnail()){
												$feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'large' );
												if(isset($feature_image[0])){
													$feature_img =$feature_image[0];
												}
											}else{
												$feature_img= $defaul_feature_img;
											}
											$dir_data['title']=esc_html($post->post_title);
											$dir_data['dlink']=get_permalink($id);
											$dir_data['address']= get_post_meta($id,'address',true);
											$dir_data['image']=  $feature_img;
											$dir_data['locations']= '';
											$dir_data['lat']=(get_post_meta($id,'latitude',true)!='' ? get_post_meta($id,'latitude',true) :'0');
											$dir_data['lng']=(get_post_meta($id,'longitude',true)!='' ? get_post_meta($id,'longitude',true) :'0');

											$dir_data['marker_icon']= $main_class->listfoliopro_get_categories_mapmarker($id,$listfoliopro_directory_url);
											$ins_lat=get_post_meta($id,'latitude',true);
											$ins_lng=get_post_meta($id,'longitude',true);

											$cat_link='';$cat_name='';$cat_slug='';
											// VIP
											$post_author_id= $listfoliopro_query->post->post_author;
											$current_date=time();
											?>

                                            <div class="<?php echo esc_attr($column);?> listingdata-col" id="<?php echo esc_html( $i ); ?>">
                                                <div class="listfoliopro-listing-item">
													<?php
													$listing_contact_source = get_post_meta( $id, 'listing_contact_source', true );
													if ( $listing_contact_source == '' ) {
														$listing_contact_source = 'user_info';
													}
													if ( $listing_contact_source == 'new_value' ) {
														$company_name    = get_post_meta( $id, 'company_name', true );
														$company_address = get_post_meta( $id, 'address', true );
														$company_web     = get_post_meta( $id, 'contact_web', true );
														$company_phone   = get_post_meta( $id, 'phone', true );
														$company_email   = get_post_meta( $id, 'contact-email', true );

													} else {
														$company_name    = get_user_meta( $post_author_id, 'full_name', true );
														$company_address = get_user_meta( $post_author_id, 'address', true );
														$company_web     = get_user_meta( $post_author_id, 'website', true );
														$company_phone   = get_user_meta( $post_author_id, 'phone', true );
														$company_logo    = get_user_meta( $post_author_id, 'listfoliopro_profile_pic_thum', true );
														$user_info       = get_userdata( $post_author_id );
														$company_email   = $user_info->user_email;
													}


													if ( isset( $active_archive_fields['image'] ) ) {
														?>
                                                        <div class="card-img-container">
                                                            <a href="<?php echo get_the_permalink( $id ); ?>">
                                                                <img src="<?php echo esc_html( $feature_img ); ?>" class="card-img-top-listing">
                                                            </a>
															<?php
															if ( get_post_meta( $id, 'listfoliopro_featured', true ) == 'featured' ) {
																?>
                                                                <label class="btn-urgent-right"><?php esc_html_e( 'Featured', 'listfoliopro' ); ?></label>
																<?php
															}
															?>
															<?php
															if ( isset( $active_archive_fields['favorite'] ) ) {
																$saved_icon = listfoliopro_get_icon( $active_archive_icon_saved, 'favorite', 'archive' );
																if ( $saved_icon == '' ) {
																	$saved_icon = 'fa-regular fa-heart';
																}

																$user_ID    = get_current_user_id();
																$favourites = 'no';
																if ( $user_ID > 0 ) {
																	$my_favorite = get_post_meta( $id, '_favorites', true );
																	$all_users   = explode( ",", $my_favorite );
																	if ( in_array( $user_ID, $all_users ) ) {
																		$favourites = 'yes';
																	}
																}
																if ( $favourites != 'yes' ) {
																	?>
                                                                    <label class="btn-urgent-left btn-add-favourites listingbookmark"
                                                                           id="listingbookmark<?php echo esc_html( $id ); ?>"><i
                                                                                class="fa-regular fa-heart"></i></label>
																	<?php
																} else {
																	?>
                                                                    <label class="btn-urgent-left btn-added-favourites listingbookmark"
                                                                           id="listingbookmark<?php echo esc_html( $id ); ?>"><i
                                                                                class="fa-solid fa-heart"></i></label>
																	<?php
																}
															}
															?>
                                                        </div>
														<?php
													}
													?>
                                                    <div class="card-body">

                                                        <?php if ($settings['enable_category_rating'] == 'yes') : ?>
                                                        <div class="first-category-and-rating">
															<?php
															if ( isset( $active_archive_fields['category'] ) ) { ?>
                                                                <div class="list-fast-cat">
																	<?php

																	$categories = get_the_terms(get_the_ID(), 'listing-category');

																	if (!empty($categories)) {
																		// Display only the first category
																		$first_category = $categories[0];
																		echo '<a href="' . esc_url(get_term_link($first_category)) . '"><img src="' . listfoliopro_ep_URLPATH . 'assets/images/building-07.svg" alt="icon">' . esc_html($first_category->name) . '</a>';

																	}
																	?>
                                                                </div>
																<?php
															}
															?>
															<?php
															if ( isset( $active_archive_fields['review'] ) ) { ?>
                                                                <div class="review-count">
																	<?php
																	$post_type = 'listfoliopro_review';
																	$total_review_point = 0;
																	$sql = $wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_type ='listfoliopro_review' and post_author='%s' and post_status='publish' ORDER BY ID DESC", $id);
																	$author_reviews = $wpdb->get_results($sql);
																	$total_reviews = count($author_reviews);

																	$avg_review = 0;
																	if ($total_reviews > 0) {
																		foreach ($author_reviews as $review) {
																			$review_val2 = (float) get_post_meta($review->ID, 'review_value', true);
																			$total_review_point += $review_val2;
																		}

																		$avg_review = number_format($total_review_point / $total_reviews, 2, '.', '');
																	}

																	// Ensure it always displays two decimal places, even if they are zeros
																	$avg_review = sprintf("%.2f", $avg_review);

																	$saved_listing_avg_rating = get_post_meta($id, 'review', true);
																	if ($avg_review != $saved_listing_avg_rating) {
																		update_post_meta($id, 'review', $avg_review);
																	}
																	?>

                                                                    <div class="review-wrapper">
                                                                        <div class="star-icon">
                                                                            <i class="fas fa-star"></i>
                                                                        </div>

                                                                        <div class="listing-review">
                                                                            <div class="review-point"><?php echo esc_html__($avg_review);?></div>
                                                                            <div class="total-review">( <?php echo esc_html__($total_reviews);?> )</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
																<?php
															}
															?>
                                                        </div>
                                                        <?php endif; ?>

														<?php if ( isset( $active_archive_fields['title'] ) ) { ?>
                                                            <div class="listing-title">
                                                                <a href="<?php echo get_permalink( $id ); ?>" class="">
																	<?php echo esc_html( $post->post_title ); ?>
                                                                </a>
                                                            </div>
														<?php } ?>
                                                        <div class="location-date-wrapper">
															<?php if ( $settings['enable_location'] == 'yes' && isset( $active_archive_fields['location'] ) ) { ?>
                                                                <div class="location">

																	<?php
																	$term_list = get_the_term_list($id, 'listing-locations', '', ', ', '');

																	if (!is_wp_error($term_list)) {
																		$terms = wp_get_post_terms($id, 'listing-locations');

																		if (!empty($terms)) {
																			$first_term = $terms[0]->name;
																			$term_link = get_term_link($terms[0]);

																			echo '<a href="' . esc_url($term_link) . '">' . esc_html($first_term) . '</a>';
																		}
																	}
																	?>
                                                                </div>
															<?php } ?>
															<?php if ( $settings['enable_date'] == 'yes' && isset( $active_archive_fields['post_date'] ) ) { ?>
                                                                <div class="listing-date">
                                                                    <i class="fa fa-clock"></i><?php echo get_the_date( 'd M-Y ', $id ); ?>
                                                                </div>
															<?php } ?>
                                                        </div>

														<?php if ( $settings['show_excerpt'] == 'yes' && isset( $active_archive_fields['description'] ) ) { ?>
                                                            <div class="listing-desc">
																<?php echo wp_trim_words(get_the_content($id), $settings['excerpt_length'], '...');?>
                                                            </div>
														<?php } ?>
														<?php if ( $settings['enable_location'] == 'yes' && isset( $active_archive_fields['price'] ) ) { ?>
															<?php
															if ( get_post_meta( $id, 'price', true ) != '' or get_post_meta( $id, 'discount', true ) != '' ) {
																?>
                                                                <div class="listfoliopro-listing-price">
																	<?php if ( get_post_meta( $id, 'discount', true ) != '' ) { ?>
                                                                        <strike class="listfoliopro-main-price"><?php echo esc_html( get_post_meta( $id, 'price', true ) ); ?></strike>
                                                                        <span class="listfoliopro-discount-price"><?php echo esc_html( get_post_meta( $id, 'discount', true ) ); ?></span>
																		<?php
																	} else { ?>
																		<?php echo esc_html( get_post_meta( $id, 'price', true ) ); ?>
																		<?php
																	}
																	?>
                                                                </div>
																<?php
															}
															?>
														<?php } ?>

                                                    </div>

                                                </div>
                                            </div>
											<?php
											array_push( $dirs_data, $dir_data );
											$i++;
										}
									endwhile;

								endif;

								wp_reset_query();


								if ( $listfoliopro_query->have_posts() ) :
									while ( $listfoliopro_query->have_posts() ) : $listfoliopro_query->the_post();
										$id = get_the_ID();
										$post_author_id= get_post_field( 'post_author', $id );

										$main_class->check_listing_expire_date($id, $post_author_id, $listfoliopro_directory_url);

										if(get_post_meta($id, 'listfoliopro_featured', true)!='featured'){
											$feature_img='';
											if(has_post_thumbnail()){
												$feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'large' );
												if(isset($feature_image[0])){
													$feature_img =$feature_image[0];
												}
											}else{
												$feature_img = $defaul_feature_img;
											}
											$dir_data['title']=esc_html($post->post_title);
											$dir_data['dlink']=get_permalink($id);
											$dir_data['address']= get_post_meta($id,'address',true);
											$dir_data['image']=  $feature_img;
											$currentlocation = $main_class->listfoliopro_get_location_caching($id,$listfoliopro_directory_url);
											$locations='';
											if(isset($currentlocation[0]->slug)){
												foreach($currentlocation as $c){
													$locations = $locations .' '.$c->name;
												}
											}
											$dir_data['locations']= $locations;
											$dir_data['lat']=(get_post_meta($id,'latitude',true)!=''? get_post_meta($id,'latitude',true):0);
											$dir_data['lng']=(get_post_meta($id,'longitude',true)!=''? get_post_meta($id,'longitude',true):0);
											$dir_data['marker_icon']= $main_class->listfoliopro_get_categories_mapmarker($id,$listfoliopro_directory_url);
											$ins_lat=get_post_meta($id,'latitude',true);
											$ins_lng=get_post_meta($id,'longitude',true);
											$cat_link='';$cat_name='';$cat_slug='';
											// VIP
											$post_author_id= $listfoliopro_query->post->post_author;
											$author_package_id=get_user_meta($post_author_id, 'iv_directories_package_id', true);
											$have_vip_badge= get_post_meta($author_package_id,'iv_directories_package_vip_badge',true);
											$exprie_date= strtotime (get_user_meta($post_author_id, 'iv_directories_exprie_date', true));
											$current_date=time();
											?>
                                            <div class="<?php echo esc_attr($column);?> listingdata-col" id="<?php echo esc_html( $i ); ?>">
                                                <div class="listfoliopro-listing-item">
													<?php
                                                    if ( isset( $active_archive_fields['image'] ) ) {
														?>
                                                        <div class="card-img-container">
                                                            <a href="<?php echo get_the_permalink( $id ); ?>">
                                                                <img src="<?php echo esc_html( $feature_img ); ?>" class="card-img-top-listing">
                                                            </a>
															<?php
															if ( get_post_meta( $id, 'listfoliopro_featured', true ) == 'featured' ) {
																?>
                                                                <label class="btn-urgent-right"><?php esc_html_e( 'Featured', 'listfoliopro' ); ?></label>
																<?php
															}
															?>
															<?php
															if ( isset( $active_archive_fields['favorite'] ) ) {
																$saved_icon = listfoliopro_get_icon( $active_archive_icon_saved, 'favorite', 'archive' );
																if ( $saved_icon == '' ) {
																	$saved_icon = 'fa-regular fa-heart';
																}

																$user_ID    = get_current_user_id();
																$favourites = 'no';
																if ( $user_ID > 0 ) {
																	$my_favorite = get_post_meta( $id, '_favorites', true );
																	$all_users   = explode( ",", $my_favorite );
																	if ( in_array( $user_ID, $all_users ) ) {
																		$favourites = 'yes';
																	}
																}
																if ( $favourites != 'yes' ) {
																	?>
                                                                    <label class="btn-urgent-left btn-add-favourites listingbookmark"
                                                                           id="listingbookmark<?php echo esc_html( $id ); ?>"><i
                                                                                class="fa-regular fa-heart"></i></label>
																	<?php
																} else {
																	?>
                                                                    <label class="btn-urgent-left btn-added-favourites listingbookmark"
                                                                           id="listingbookmark<?php echo esc_html( $id ); ?>"><i
                                                                                class="fa-solid fa-heart"></i></label>
																	<?php
																}
															}
															?>
                                                        </div>
														<?php
													}
													?>
                                                    <div class="card-body">
                                                        <?php if ($settings['enable_category_rating'] == 'yes'): ?>
                                                        <div class="first-category-and-rating">
															<?php
															if ( isset( $active_archive_fields['category'] ) ) { ?>
                                                                <div class="list-fast-cat">
																	<?php

																	$categories = get_the_terms(get_the_ID(), 'listing-category');

																	if (!empty($categories)) {
																		// Display only the first category
																		$first_category = $categories[0];
																		echo '<a href="' . esc_url(get_term_link($first_category)) . '"><img src="' . listfoliopro_ep_URLPATH . 'assets/images/building-07.svg" alt="icon">' . esc_html($first_category->name) . '</a>';

																	}
																	?>
                                                                </div>
																<?php
															}
															?>
															<?php
															if ( isset( $active_archive_fields['review'] ) ) { ?>
                                                                <div class="review-count">
																	<?php
																	$post_type = 'listfoliopro_review';
																	$total_review_point = 0;
																	$sql = $wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_type ='listfoliopro_review' and post_author='%s' and post_status='publish' ORDER BY ID DESC", $id);
																	$author_reviews = $wpdb->get_results($sql);
																	$total_reviews = count($author_reviews);

																	$avg_review = 0;
																	if ($total_reviews > 0) {
																		foreach ($author_reviews as $review) {
																			$review_val2 = (float) get_post_meta($review->ID, 'review_value', true);
																			$total_review_point += $review_val2;
																		}

																		$avg_review = number_format($total_review_point / $total_reviews, 2, '.', '');
																	}

																	// Ensure it always displays two decimal places, even if they are zeros
																	$avg_review = sprintf("%.2f", $avg_review);

																	$saved_listing_avg_rating = get_post_meta($id, 'review', true);
																	if ($avg_review != $saved_listing_avg_rating) {
																		update_post_meta($id, 'review', $avg_review);
																	}
																	?>

                                                                    <div class="review-wrapper">
                                                                        <div class="star-icon">
                                                                            <i class="fas fa-star"></i>
                                                                        </div>

                                                                        <div class="listing-review">
                                                                            <div class="review-point"><?php echo esc_html__($avg_review);?></div>
                                                                            <div class="total-review">( <?php echo esc_html__($total_reviews);?> )</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
																<?php
															}
															?>
                                                        </div>
                                                        <?php endif; ?>

														<?php if ( isset( $active_archive_fields['title'] ) ) { ?>
                                                            <div class="listing-title">
                                                                <a href="<?php echo get_permalink( $id ); ?>" class="">
																	<?php echo esc_html( $post->post_title ); ?>
                                                                </a>
                                                            </div>
														<?php } ?>
                                                        <div class="location-date-wrapper">
															<?php if ( $settings['enable_location'] == 'yes' && isset( $active_archive_fields['location'] ) ) { ?>
                                                                <div class="location">

																	<?php
																	$term_list = get_the_term_list($id, 'listing-locations', '', ', ', '');

																	if (!is_wp_error($term_list)) {
																		$terms = wp_get_post_terms($id, 'listing-locations');

																		if (!empty($terms)) {
																			$first_term = $terms[0]->name;
																			$term_link = get_term_link($terms[0]);

																			echo '<a href="' . esc_url($term_link) . '">' . esc_html($first_term) . '</a>';
																		}
																	}
																	?>
                                                                </div>
															<?php } ?>
															<?php if ( $settings['enable_date'] == 'yes' && isset( $active_archive_fields['post_date'] ) ) { ?>
                                                                <div class="listing-date">
                                                                    <i class="fa fa-clock"></i><?php echo get_the_date( 'd M-Y ', $id ); ?>
                                                                </div>
															<?php } ?>
                                                        </div>

														<?php if ( $settings['show_excerpt'] == 'yes' && isset( $active_archive_fields['description'] ) ) { ?>
                                                            <div class="listing-desc">
																<?php echo wp_trim_words(get_the_content($id), $settings['excerpt_length'], '...');?>
                                                            </div>
														<?php } ?>
														<?php if ( $settings['enable_price'] == 'yes' && isset( $active_archive_fields['price'] ) ) { ?>
															<?php
															if ( get_post_meta( $id, 'price', true ) != '' or get_post_meta( $id, 'discount', true ) != '' ) {
																?>
                                                                <div class="listfoliopro-listing-price">
																	<?php if ( get_post_meta( $id, 'discount', true ) != '' ) { ?>
                                                                        <strike class="listfoliopro-main-price"><?php echo esc_html( get_post_meta( $id, 'price', true ) ); ?></strike>
                                                                        <span class="listfoliopro-discount-price"><?php echo esc_html( get_post_meta( $id, 'discount', true ) ); ?></span>
																		<?php
																	} else { ?>
																		<?php echo esc_html( get_post_meta( $id, 'price', true ) ); ?>
																		<?php
																	}
																	?>
                                                                </div>
																<?php
															}
															?>
														<?php } ?>
                                                    </div>

                                                </div>
                                            </div>
											<?php
											array_push( $dirs_data, $dir_data );
											$i++;
										}
									endwhile;
									$dirs_json_map = wp_json_encode($dirs_data);
									?>
								<?php else :
									$dirs_json=''; ?>
									
								<?php endif; ?>
                            </div>

		                    <?php if($settings['pagination'] == 'yes') : ?>
                            <div class="row mt-1 post-pagination">
                                <div class="col-lg-12 text-center ep-list-style">
									<?php
									$GLOBALS['wp_query']->max_num_pages = $listfoliopro_query->max_num_pages;
									the_posts_pagination(array(
										'next_text' => '<i class="fas fa-angle-double-right"></i>',
										'prev_text' => '<i class="fas fa-angle-double-left"></i>',
										'screen_reader_text' => ' ',
										'type'                => 'list'
									));
									?>
                                </div>
                            </div>
		                    <?php endif; ?>
                        </div>
                        
                        <?php if ($settings['enable_map'] == 'yes') : ?>
                        <div class="col-xl-5 col-lg-12" id="archivemap">
							<?php include(listfoliopro_ep_template.'listing/map/map.php'); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <!-- end of arhiece page -->
        </div>

        <!-- end of bootstrap wrapper -->
		<?php
		$dir_addedit_contactustitle=get_option('dir_addedit_contactustitle');
		if($dir_addedit_contactustitle==""){$dir_addedit_contactustitle='Contact US';}
		?>
		<?php
		wp_enqueue_script('listfoliopro_message', listfoliopro_ep_URLPATH . 'admin/files/js/user-message.js');
		wp_localize_script('listfoliopro_message', 'listfoliopro_data_message', array(
			'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
			'loading_image'		=> '<img src="'.listfoliopro_ep_URLPATH.'admin/files/images/loader.gif">',
			'Please_put_your_message'=>esc_html__('Please put your name,email & message', 'listfoliopro' ),
			'contact'=> wp_create_nonce("contact"),
			'listing'=> wp_create_nonce("listing"),
		) );

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
			'dirwpnonce'=> wp_create_nonce("myaccount"),
			'listing'=> wp_create_nonce("listing"),
			'cv'=> wp_create_nonce("Doc/CV/PDF"),
			'listfoliopro_ep_URLPATH'=>listfoliopro_ep_URLPATH,
		) );

		?>
		<?php
		wp_reset_query();
		?>

<?php
	}
}

Plugin::instance()->widgets_manager->register( new ListFolioPro_Listing_Archive_Widget );