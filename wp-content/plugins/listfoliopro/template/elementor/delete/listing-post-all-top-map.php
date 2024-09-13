<?php
namespace Elementor;
class listfoliopro_Posts_Topmap_Widget extends Widget_Base {

	public function get_name() {

		return 'listfoliopro_post_topmap';
	}

	public function get_title() {
		return esc_html__( 'All Listings Top Map', 'listfoliopro' );
	}

	public function get_icon() {

		return 'eicon-post-excerpt';
	}

	public function get_categories() {
		return [ 'listfoliopro_elements' ];
	}


	protected function register_controls() {

		$this->start_controls_section(
			'recent_post_settings',
			[
				'label' => esc_html__( 'All Listing : Top Map', 'listfoliopro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'search_option',
			[
			'label'       => esc_html__( 'Search Form Type', 'listfoliopro' ),
			'type'        => Controls_Manager::SELECT,
			'label_block' => true,			
			'default' => 'popup',
				'options' => [
					'popup'  => esc_html__( 'Popup/Modal Search', 'listfoliopro' ),
					'on-page' => esc_html__( 'Search Form on The Page', 'listfoliopro' ),
					'no-search' => esc_html__( 'No Search Form', 'listfoliopro' ),
				],	
			]
			);	

		$this->add_control(
			'category',
			[
				'label'       => esc_html__( 'Categories', 'listfoliopro' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'options'     => ep_listfoliopro_post_categories_topmap(),
			]
		);
		$this->add_control(
			'locations',
			[
				'label'       => esc_html__( 'Locations', 'listfoliopro' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'options'     => ep_listfoliopro_post_locations_topmap(),
			]
		);
		$this->add_control(
			'tag',
			[
				'label'       => esc_html__( 'Tags', 'listfoliopro' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'options'     => ep_listfoliopro_post_tag_topmap(),
			]
		);
		

		$this->end_controls_section();

	}

	//Render
	protected function render() {
		$settings = $this->get_settings_for_display();		
		$atts='';
		if ( ! empty( $settings['category'] ) ) {
			if(is_array($settings['category'])){
				$atts=$atts.' category="'.implode(",",$settings['category']).'"';
			}else{
				$atts=$atts.' category="'.$settings['category'].'"';
			}
		}
		if ( ! empty( $settings['locations'] ) ) {
			if(is_array($settings['locations'])){
				$atts=$atts.' locations="'.implode(",",$settings['locations']).'"';
			}else{
				$atts=$atts.' locations="'.$settings['locations'].'"';
			}
		}
		if ( ! empty( $settings['tag'] ) ) {
			if(is_array($settings['tag'])){
				$atts=$atts.' tag="'.implode(",",$settings['tag']).'"';
			}else{
				$atts=$atts.' tag="'.$settings['tag'].'"';
			}
		}
		if ( ! empty( $settings['search_option'] ) ) {			
				$atts=$atts.' search-form="'.$settings['search_option'].'"';
		}
		
		$shortcode ="[listfoliopro_archive_grid_top_map ".$atts." ]";
				
		?>
		<div class="elementor-shortcode"><?php echo do_shortcode( shortcode_unautop( $shortcode ) );  ?></div>
		<?php
	}
}
Plugin::instance()->widgets_manager->register( new listfoliopro_Posts_Topmap_Widget );
//Post Category
function ep_listfoliopro_post_categories_topmap() {
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
function ep_listfoliopro_post_tag_topmap() {
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
function ep_listfoliopro_post_locations_topmap() {
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