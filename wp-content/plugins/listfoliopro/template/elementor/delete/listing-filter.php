<?php
	namespace Elementor;
	use WP_Query;
	use WP_User_Query;
	class listfoliopro_Filter_Widget extends Widget_Base {
		public function get_name() {
			return 'listfoliopro_filter';
		}
		public function get_title() {
			return esc_html__( 'Listings Filter', 'listfoliopro' );
		}
		public function get_icon() {
			return 'eicon-post-excerpt';
		}
		public function get_categories() {
			return [ 'listfoliopro_elements' ];
		}
		protected function register_controls() {
			$this->start_controls_section(
			'filter_post_settings',
			[
			'label' => esc_html__( 'Filter Settings', 'listfoliopro' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
			]
			);
			$this->add_control(
			'post_count_filter',
			[
			'label'   => esc_html__( 'Number Of Post To Show', 'listfoliopro' ),
			'type'    => Controls_Manager::NUMBER,
			'min'     => - 1,
			'max'     => '',
			'step'    => 1,
			'default' => 6,
			]
			);
			$this->add_control(
			'sort_filter',
			[
			'label'       => esc_html__( 'Sort', 'listfoliopro' ),
			'type'        => Controls_Manager::SELECT,
			'label_block' => true,			
			'default' => 'date-desc',
				'options' => [
					'date-desc'  => esc_html__( 'Newest Listing', 'listfoliopro' ),
					'date-asc' => esc_html__( 'Oldest Listing', 'listfoliopro' ),
					'asc' => esc_html__( 'A to Z (title)', 'listfoliopro' ),
					'desc' => esc_html__( 'Z to A (title)', 'listfoliopro' ),
					'rand' => esc_html__( 'Random', 'listfoliopro' ),					
				],	
			]
			);
			
			$this->add_control(
			'author_filter',
			[
			'label'       => esc_html__( 'Author', 'listfoliopro' ),
			'type'        => Controls_Manager::SELECT2,
			'label_block' => true,
			'multiple'    => true,
			'options'     => get_author_value_filter(),			
			]
			);
			
			
			
			$this->add_control(
			'category_filter',
			[
			'label'       => esc_html__( 'Categories', 'listfoliopro' ),
			'type'        => Controls_Manager::SELECT2,
			'label_block' => true,
			'multiple'    => true,
			'options'     => ep_listfoliopro_post_categories_filter(),			
			]
			);
			$this->add_control(
			'locations_filter',
			[
			'label'       => esc_html__( 'Locations', 'listfoliopro' ),
			'type'        => Controls_Manager::SELECT2,
			'label_block' => true,
			'multiple'    => true,
			'options'     => ep_listfoliopro_post_locations_filter(),			
			]
			);
			$this->add_control(
			'tag_filter',
			[
			'label'       => esc_html__( 'Tags', 'listfoliopro' ),
			'type'        => Controls_Manager::SELECT2,
			'label_block' => true,
			'multiple'    => true,
			'options'     => ep_listfoliopro_post_tag_filter(),			
			]
			);
			$this->end_controls_section();
		}
		//Render
		protected function render() {
			$settings = $this->get_settings_for_display();			
			$atts='';
			if ( ! empty( $settings['post_count_filter'] ) ) {			
				$atts=$atts.' post_limit="'.$settings['post_count_filter'].'"';
			}
			if ( ! empty( $settings['author_filter'] ) ) {								
					$atts=$atts.' author__in="'.$settings['author_filter'].'"';				
			}
			if ( ! empty( $settings['sort_filter'] ) ) {						
					$atts=$atts.' sort="'.$settings['sort_filter'].'"';
				
			}
					
						
				
			if ( ! empty( $settings['category_filter'] ) ) {
				if(is_array($settings['category_filter'])){
					$atts=$atts.' category="'.implode(",",$settings['category_filter']).'"';
					}else{
					$atts=$atts.' category="'.$settings['category'].'"';
				}
			}
			if ( ! empty( $settings['locations_filter'] ) ) {
				if(is_array($settings['locations_filter'])){
					$atts=$atts.' locations="'.implode(",",$settings['locations_filter']).'"';
					}else{
					$atts=$atts.' locations="'.$settings['locations_filter'].'"';
				}
			}
			if ( ! empty( $settings['tag_filter'] ) ) {
				if(is_array($settings['tag_filter'])){
					$atts=$atts.' tag="'.implode(",",$settings['tag_filter']).'"';
					}else{
					$atts=$atts.' tag="'.$settings['tag_filter'].'"';
				}
			}
			
			
			$shortcode ="[listfoliopro_listing_filter ".$atts." ]";
		?>
		<div class="elementor-shortcode"><?php echo do_shortcode( shortcode_unautop( $shortcode ) );  ?></div>
		<?php
		}
	}
	Plugin::instance()->widgets_manager->register( new listfoliopro_Filter_Widget );
	function get_meta_value_by_key_filter($meta_key){	
		$listfoliopro_directory_url=get_option('listfoliopro_ep_url');
		if($listfoliopro_directory_url==""){$listfoliopro_directory_url='listing';}
		$args_metadata = array(
		'post_type'  => $listfoliopro_directory_url,
		'posts_per_page' => -1,
		'meta_query' => array(
		array(
		'key'     => $meta_key,
		'orderby' => 'meta_value',
		'order' => 'ASC',
		),
		),
		);
		$args_metadata_arr = new WP_Query( $args_metadata );
		$args_metadata_arr_all = $args_metadata_arr->posts;
		$get_val_arr =array();
		foreach ( $args_metadata_arr_all as $term ) {
			$new_fields_val="";
			$new_fields_val=get_post_meta($term->ID,$meta_key,true);
			if(is_array($new_fields_val)){
				foreach ( $new_fields_val as $new_fields_val_one ) {				
					if (!in_array($new_fields_val_one,$get_val_arr )) {	
						$get_val_arr[$new_fields_val_one]=$new_fields_val_one;  						
					}
				}
				}else{
				if (!in_array($new_fields_val, $get_val_arr)) {	
					$get_val_arr[$new_fields_val]=$new_fields_val;					
				}
			}
		}		
		return $get_val_arr;
	}
	function get_author_value_filter(){
		$options = array();
		$args = array();
		$args['number']='99999';		
		$args['orderby']='display_name';
		$args['order']='ASC'; 
		
		
		$user_query = new WP_User_Query( $args );
		if ( ! empty( $user_query->results ) ) {
			foreach ( $user_query->results as $user ) {
				$name=(get_user_meta($user->ID,'full_name',true)!=''? get_user_meta($user->ID,'full_name',true) : $user->display_name );
				$options[$user->ID]= $name;
			}
		}	
		return $options;
	}
	//Post Category
	function ep_listfoliopro_post_categories_filter() {
		$options = array();
		$listfoliopro_directory_url=get_option('listfoliopro_ep_url');
		if($listfoliopro_directory_url==""){$listfoliopro_directory_url='listing';}
		$taxonomy = $listfoliopro_directory_url.'-category';
		$args = array(
		'orderby'           => 'name',
		'taxonomy'   => 	$taxonomy ,
		'order'             => 'ASC',
		'hide_empty'        => true,	
		);
		$terms = get_terms($args);
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$options[ $term->slug ] = $term->name;
			}
		}
		return $options;
	}
	//Post tag
	function ep_listfoliopro_post_tag_filter() {
		$options = array();
		$listfoliopro_directory_url=get_option('listfoliopro_ep_url');
		if($listfoliopro_directory_url==""){$listfoliopro_directory_url='listing';}
		$taxonomy = $listfoliopro_directory_url.'-tag';
		$args = array(
		'orderby'           => 'name',
		'taxonomy'   => 	$taxonomy ,
		'order'             => 'ASC',
		'hide_empty'        => true,	
		);
		$terms = get_terms($args);
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$options[ $term->slug ] = $term->name;
			}
		}
		return $options;
	}
	//Post locations
	function ep_listfoliopro_post_locations_filter() {
		$options = array();
		$listfoliopro_directory_url=get_option('listfoliopro_ep_url');
		if($listfoliopro_directory_url==""){$listfoliopro_directory_url='listing';}
		$taxonomy = $listfoliopro_directory_url.'-locations';
		$args = array(
		'orderby'           => 'name',
		'taxonomy'   => 	$taxonomy ,
		'order'             => 'ASC',
		'hide_empty'        => true,	
		);
		$terms = get_terms($args);
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$options[ $term->slug ] = $term->name;
			}
		}
		return $options;
	}	