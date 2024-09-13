<?php
	if ( ! defined( 'ABSPATH' ) ) exit; 
?>
<?php
	if (!function_exists('listfoliopro_get_icon')) {	
		function listfoliopro_get_icon($active_single_icon_saved, $field_key, $onpage ){
			$saved_icon=''; 		
			if(isset($active_single_icon_saved[$field_key]) and $active_single_icon_saved[$field_key]!=""){ 			
				if($field_key!='category'){				
					if(trim($active_single_icon_saved [$field_key])!=''){ 						
						$saved_icon=$active_single_icon_saved [$field_key].' mr-2 icon-color';
						}else{
					}
				}	
				}else{
				if($onpage=='single'){ 
					$archive_page_icon_saved=get_option('listfoliopro_archive_icon_saved');
					if(isset($archive_page_icon_saved[$field_key]) and $archive_page_icon_saved[$field_key]!=""){ 
						$saved_icon=$archive_page_icon_saved [$field_key].' mr-2 icon-color';
					}				
				}
				if($onpage=='archive'){ 
					$archive_page_icon_saved=get_option('listfoliopro_single_icon_saved');
					if(isset($archive_page_icon_saved[$field_key]) and $archive_page_icon_saved[$field_key]!=""){ 
						$saved_icon=$archive_page_icon_saved [$field_key].' mr-2 icon-color';
					}
				}
			}	
			return $saved_icon;	
		}
	}	
	if (!function_exists('listfoliopro_get_cat_icon')) {		
		function listfoliopro_get_cat_icon($term_id){
			$saved_icon='';
			$caticon= get_term_meta($term_id, 'listfoliopro_term_icon', true);
			$saved_icon=$caticon.' mr-1 icon-color';
			return $saved_icon;	
		}
	}	
	if (!function_exists('listfoliopro_check_field_display_access')) {	
		function listfoliopro_check_field_display_access($saved_fields_arr, $field_key){
			
			return '';
		}
	}	
	if (!function_exists('listfoliopro_get_archive_field')) {	
		function listfoliopro_get_archive_field($active_fields_arr, $field_icon_saved){
			
			return '';
		}
	}
	
	if (!function_exists('listfoliopro_default_custom_fields_with_type')) {		
		function listfoliopro_default_custom_fields_with_type(){
			$default_custom_fields=array();	
			$default_custom_fields['specialties']='Specialties';			
			$default_custom_fields['history']='History';
			$default_custom_fields['area']='Area';			
			$default_custom_fields['rooms']='Rooms';
			$default_custom_fields['bathrooms']='Area';			
			$default_custom_fields['bedrooms']='Rooms';
			$default_custom_fields['ac']='AC';			
			$default_custom_fields['rack']='Rack';					
			$default_custom_fields['facebook']='Facebook';
			$default_custom_fields['twitter']='Twitter';			
			$default_custom_fields['linkedin']='Linkedin';
			$default_custom_fields['instagram']='Instagram';			
			$default_custom_fields['rooms']='Rooms';
			
			$default_custom_fields_type=array();	
			$default_custom_fields_type['specialties']='textarea';			
			$default_custom_fields_type['history']='textarea';
			$default_custom_fields_type['area']='text';			
			$default_custom_fields_type['rooms']='text';
			$default_custom_fields_type['bathrooms']='text';			
			$default_custom_fields_type['bedrooms']='text';
			$default_custom_fields_type['ac']='text';			
			$default_custom_fields_type['rack']='text';					
			$default_custom_fields_type['facebook']='text';
			$default_custom_fields_type['twitter']='text';			
			$default_custom_fields_type['linkedin']='text';
			$default_custom_fields_type['instagram']='text';			
			$default_custom_fields_type['rooms']='text';
		
			return array($default_custom_fields, $default_custom_fields_type);
		}
	}	
	if (!function_exists('listfoliopro_get_listing_fields_all_single')) {		
		function listfoliopro_get_listing_fields_all_single(){
			$available_fields_main=array();	
			$available_fields_main['image-gallery']='Image Gallery';
			$available_fields_main['open_status']='Business Hours';
			$available_fields_main['open_status_table']='Business Hours Table';
			$available_fields_main['company-logo']='Company Logo';
			$available_fields_main['company-name']='Company Name';	
			$available_fields_main['social-profile']='Social Profile';
			$available_fields_main['title']='Title';
			$available_fields_main['description']='Description';	
			$available_fields_main['category']='Category';
			$available_fields_main['tag']='Tag';
			$available_fields_main['review']='Review';
			$available_fields_main['location']='Location';	
			$available_fields_main['post_date']='Post Date';	
			$available_fields_main['contact_button']='Contact Form';
			$available_fields_main['booking_button']='Booking Button';
			$available_fields_main['report_button']='Report Button';
			$available_fields_main['pdf_button']='PDF Button';
			$available_fields_main['favorite']='Favorite Button';
			$available_fields_main['video']='Video';
			$available_fields_main['faq']='FAQ';			
			$available_fields_main['map']='Map';
			$available_fields_main['address']='Address';
			$available_fields_main['price']='Price/Discount';			
			$available_fields_main['whatsapp']='Whatsapp';
			$available_fields_main['attachments']='Attachments';			
			
			$available_fields_main['social-share']='Social Share';
			$new_field_set=	get_option('listfoliopro_li_fields' );
			
			if(is_array($new_field_set)){
				foreach($new_field_set  as $field_key => $field_value){
					$available_fields_main[$field_key]=$field_value;
				}
			}
			return $available_fields_main;
		}
	}
	if (!function_exists('listfoliopro_get_listing_fields_all')) {	
		function listfoliopro_get_listing_fields_all(){			
			
			$available_fields_main['top_search_form']='Top Filter';
			$available_fields_main['image']='Image';			
			$available_fields_main['title']='Title';
			$available_fields_main['category']='Category';
			$available_fields_main['open_status']='Business Hours';
			$available_fields_main['description']='Description';	
			$available_fields_main['location']='Location';		
			$available_fields_main['price']='Price/Discount';
			$available_fields_main['review']='Review';		
			$available_fields_main['post_date']='Post Date';				
			$available_fields_main['favorite']='Favorite Button';	
			
			
			return $available_fields_main;
		}
	}
	if (!function_exists('listfoliopro_get_archive_fields_all')) {
		function listfoliopro_get_archive_fields_all(){
			$active_archive_fields_saved=get_option('listfoliopro_archive_fields_saved' );	
			if($active_archive_fields_saved==''){
				$active_archive_fields=array();	
				$active_archive_fields['top_search_form']='Top Filter';
				$active_archive_fields['image']='Image';			
				$active_archive_fields['title']='Title';
				$active_archive_fields['category']='Category';
				$active_archive_fields['open_status']='Business Hours';
				$active_archive_fields['description']='Description';	
				$active_archive_fields['location']='Location';		
				$active_archive_fields['price']='Price/Discount';
				$active_archive_fields['review']='Review';		
				$active_archive_fields['post_date']='Post Date';				
				$active_archive_fields['favorite']='Favorite Button';				
				}else{
				$active_archive_fields=array();
				$active_archive_fields=$active_archive_fields_saved;
			}
			return $active_archive_fields;
		}
	}
	if (!function_exists('listfoliopro_text_translate_array_all')) {
		function listfoliopro_text_translate_array_all(){
			$listfoliopro_directory_url=get_option('listfoliopro_ep_url');
			if($listfoliopro_directory_url==""){$listfoliopro_directory_url='listing';}
			$data_for_translate=array();	
			$data_for_translate['category']=esc_html__( 'Category', 'listfoliopro' );				
			$data_for_translate['location']=esc_html__( 'Location', 'listfoliopro' );	
			$data_for_translate['social-share']=esc_html__( 'Social Share', 'listfoliopro' );		
			$data_for_translate[$listfoliopro_directory_url.'-category']=esc_html__( 'Categories', 'listfoliopro' );
			$data_for_translate[$listfoliopro_directory_url.'-tag']=esc_html__( 'Tags', 'listfoliopro' );
			$data_for_translate[$listfoliopro_directory_url.'-locations']=esc_html__( 'Locations', 'listfoliopro' );
			$data_for_translate['title']=esc_html__( 'Title', 'listfoliopro' );				
			$data_for_translate['city']=esc_html__( 'City', 'listfoliopro' );	
			$data_for_translate['postcode']=esc_html__( 'Post code', 'listfoliopro' );	
			$data_for_translate['state']=esc_html__( 'State', 'listfoliopro' );	
			$data_for_translate['country']=esc_html__( 'Country', 'listfoliopro' );	
			$data_for_translate['review']=esc_html__( 'Review', 'listfoliopro' );	
			$data_for_translate['post_date']=esc_html__( 'Post Date', 'listfoliopro' );
			$new_field_set=	get_option('listfoliopro_li_fields' );	
			if(is_array($new_field_set)){
				foreach($new_field_set  as $field_key_custom => $field_value_custom){
					$data_for_translate[$field_key_custom]=$field_value_custom;	
				}
			}	
			return $data_for_translate;
		}
	}
	if (!function_exists('listfoliopro_text_translate')) {
		function listfoliopro_text_translate($key_text){		
			$data_for_translate=listfoliopro_text_translate_array_all();		
			$display_title= (isset($data_for_translate[$key_text])? $data_for_translate[$key_text]:$key_text);	
			return $display_title;
		}
	}
	if (!function_exists('listfoliopro_get_search_fields_default')) {
		function listfoliopro_get_search_fields_default(){
			$listfoliopro_directory_url=get_option('listfoliopro_ep_url');
			if($listfoliopro_directory_url==""){$listfoliopro_directory_url='listing';}
			$active_search_fields=array();
			$active_search_fields[$listfoliopro_directory_url.'-category']='multi-checkbox';		
			$active_search_fields[$listfoliopro_directory_url.'-locations']='multi-checkbox';		
			$active_search_fields['review']='multi-checkbox';
			return $active_search_fields;
		}
	}	
	if (!function_exists('listfoliopro_get_color_changer_js')) {
		function listfoliopro_get_color_changer_js(){
			$big_button_color=get_option('listfoliopro_big_button_color');	
			if($big_button_color==""){$big_button_color='#2e7ff5';}	
			$small_button_color=get_option('listfoliopro_small_button_color');	
			if($small_button_color==""){$small_button_color='#5f9df7';}
			$icon_color=get_option('listfoliopro_icon_color');	
			if($icon_color==""){$icon_color='#5b5b5b';}	
			$title_color=get_option('listfoliopro_title_color');	
			if($title_color==""){$title_color='#5b5b5b';}
			$button_font_color=get_option('listfoliopro_button_font_color');	
			if($button_font_color==""){$button_font_color='#fffff';}
			$button_small_font_color=get_option('listfoliopro_button_small_font_color');	
			if($button_small_font_color==""){$button_small_font_color='#fffff';}	
			$content_font_color=get_option('listfoliopro_content_font_color');	
			if($content_font_color==""){$content_font_color='#66789C';}	
			$border_color=get_option('listfoliopro_border_color');	
			if($border_color==""){$border_color='#E0E6F7';}	
			wp_enqueue_script('listfoliopro-dynamic-color', listfoliopro_ep_URLPATH . 'admin/files/js/dynamic-color.js');
			wp_localize_script('listfoliopro-dynamic-color', 'listfoliopro_color', array(
			'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
			'big_button'=>$big_button_color,
			'small_button'=>$small_button_color,
			'button_font'=>$button_font_color,
			'button_small_font'=>$button_small_font_color,
			'title_color'=>$title_color,
			'content_font_color'=>$content_font_color,
			'icon_color'=>$icon_color,
			'max_border_color'=>$border_color,	
			) );	
		}
	}
	if (!function_exists('listfoliopro_get_search_args')) {
		function listfoliopro_get_search_args($listfoliopro_directory_url){
			$search_arg= array();
			global $listfoliopro_filter_badge;
			$listfoliopro_filter_badge=0;
			$other_field_mq= array();
			$field_prefix='sf';
			$dir_listing_sort=get_option('_dir_listing_sort');
			if($dir_listing_sort==""){$dir_listing_sort='date-desc';}
			if(isset($_REQUEST[$field_prefix.'sort_listing']) AND $_REQUEST[$field_prefix.'sort_listing']!=''){
				$dir_listing_sort=sanitize_text_field($_REQUEST[$field_prefix.'sort_listing']);
			}
			if($dir_listing_sort=='asc'){
				$search_arg['orderby']='title';
				$search_arg['order']='ASC';
			}
			if($dir_listing_sort=='desc'){
				$search_arg['orderby']='title';
				$search_arg['order']='DESC';
			}
			// Date
			if($dir_listing_sort=='date-desc'){
				$search_arg['orderby']='date';
				$search_arg['order']='DESC';
			}
			if($dir_listing_sort=='date-asc'){
				$search_arg['orderby']='date';
				$search_arg['order']='ASC';
			}
			if($dir_listing_sort=='rand'){
				$search_arg['orderby']='rand';
				$search_arg['order']='ASC';
			}
			// Search Fields****************
			$active_search_fields_saved=get_option('listfoliopro_search_fields_saved' );	
			if($active_search_fields_saved==''){		
				$active_search_fields =listfoliopro_get_search_fields_default();				
				}else{
				$active_search_fields=array();
				$active_search_fields=$active_search_fields_saved;
			}	
			//atts atts
			if(isset($atts['field-name']) ){	
				$field_name= $atts['field-name'];
				$field_type= $atts['field-type'];
				$field_name_arr= explode(",",$field_name);
				$field_type_arr= explode(",",$field_type);
				$i=0;
				$active_search_fields=array();
				foreach($field_name_arr as $one_field){		
					if(isset($field_type_arr[$i])){
						$active_search_fields[$one_field]=$field_type_arr[$i];
					}
					$i++;
				}		
			}
			$category_query=''; $tag_query=''; $location_query='';
			if(is_array($active_search_fields)){
				foreach($active_search_fields  as $field_key => $field_value){	 				
					if(isset($_REQUEST[$field_prefix.$field_key]) AND $_REQUEST[$field_prefix.$field_key]!='' AND $field_key!='sort_listing'){
						$listfoliopro_filter_badge=$listfoliopro_filter_badge+1;
						if($field_key=='title'){
							$search_title= sanitize_text_field($_REQUEST[$field_prefix.$field_key]);
							if(is_array($search_title)){
								$title_arr=array();
								foreach($search_title as $one_title){
									$title_arr[]= sanitize_text_field($one_title);
								}	
								$search_arg['post__in']= $title_arr;
								}else{
								$search_arg['s']=   sanitize_text_field($_REQUEST[$field_prefix.$field_key]);
							}
							}elseif($field_key==$listfoliopro_directory_url.'-category'){	
							if(isset($_REQUEST[$field_prefix.$listfoliopro_directory_url.'-category']) AND $_REQUEST[$field_prefix.$listfoliopro_directory_url.'-category']!=''){
								$categories= $_REQUEST[$field_prefix.$listfoliopro_directory_url.'-category'];
								$categories_arr=array();							
								if(is_array($categories)){
									foreach($categories as $one_category){
										$categories_arr[]= sanitize_text_field($one_category);
									}
									}else{
									$categories_arr[]= sanitize_text_field($categories);
								}	
								$category_query = 
								array(
								'taxonomy'  => $listfoliopro_directory_url.'-category',
								'field'		=> 	'slug',
								'terms'   	=> $categories_arr,
								'compare' 	=> 'IN'
								);
							}	
							}elseif($field_key==$listfoliopro_directory_url.'-tag'){		
							if(isset($_REQUEST[$field_prefix.$listfoliopro_directory_url.'-tag'])  AND $_REQUEST[$field_prefix.$listfoliopro_directory_url.'-tag']!=''){
								$tags= $_REQUEST[$field_prefix.$listfoliopro_directory_url.'-tag'];
								$tags_arr=array();							
								if(is_array($tags)){
									foreach($tags as $one_tag){
										$tags_arr[]= sanitize_text_field($one_tag);
									}
									}else{
									$tags_arr[]= sanitize_text_field($tags);
								}	
								$tag_query = 
								array(
								'taxonomy'  => $listfoliopro_directory_url.'-tag',
								'field'		=> 	'slug',
								'terms'   	=> $tags_arr,
								'compare' 	=> 'IN'
								);
							}	
							}elseif(trim($field_key)==$listfoliopro_directory_url.'-locations'){
							if(isset($_REQUEST[$field_prefix.$listfoliopro_directory_url.'-locations'])  AND $_REQUEST[$field_prefix.$listfoliopro_directory_url.'-locations']!=''){
								$locations= $_REQUEST[$field_prefix.$listfoliopro_directory_url.'-locations'];
								$locations_arr=array();
								if(is_array($locations)){
									foreach($locations as $one_location){
										$locations_arr[]= sanitize_text_field($one_location);
									}
									}else{
									$locations_arr[]= sanitize_text_field($locations);
								}	
								$location_query = 
								array(
								'taxonomy'  => $listfoliopro_directory_url.'-locations',
								'field'		=> 	'slug',
								'terms'   	=> $locations_arr,
								'compare' 	=> 'IN'
								);
							}		
							}else{
							if(isset($_REQUEST[$field_prefix.$field_key])  AND $_REQUEST[$field_prefix.$field_key]!=''){ 
								$other_field= $_REQUEST[$field_prefix.$field_key];
								$other_field_arr=array();
								if(is_array($other_field)){								
									foreach($other_field as $one_field){
										$other_field_arr[]= sanitize_text_field($one_field);
									}
									}else{
									$other_field_arr[]= sanitize_text_field($_REQUEST[$field_prefix.$field_key]);
								}	
								$field_mq = 
								array(
								'key'     => $field_key,
								'value'   => $other_field_arr,
								'compare' => 'IN'							
								);
								array_push( $other_field_mq, $field_mq );
							}	
						}					
					}
				}
			}	
			$search_arg['tax_query'] = array(
			'relation' => 'AND',
			$category_query, $tag_query, $location_query,
			);
			$search_arg['meta_query'] = array(
			'relation' => 'AND',
			$other_field_mq,
			);
			if(isset($_REQUEST['latitude']) AND $_REQUEST['latitude']!=''){
				$search_arg['lat']=sanitize_text_field($_REQUEST['latitude']);
				$listfoliopro_filter_badge=$listfoliopro_filter_badge+1;
			}
			if(isset($_REQUEST['longitude']) AND $_REQUEST['longitude']!=''){
				$search_arg['lng']=sanitize_text_field($_REQUEST['longitude']);
			}
			if(isset($_REQUEST['near_km']) AND $_REQUEST['near_km']!=''){
				$search_arg['distance']=sanitize_text_field($_REQUEST['near_km']);
			}
			return $search_arg;
		}
	}	