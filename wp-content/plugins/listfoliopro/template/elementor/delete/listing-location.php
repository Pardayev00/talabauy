<?php
	namespace Elementor;
	class listfoliopro_Location_Widget extends Widget_Base {
		public function get_name() {
			return 'listfoliopro_location';
		}
		public function get_title() {
			return esc_html__( 'Locations', 'listfoliopro' );
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
			'label' => esc_html__( 'Locations Settings', 'listfoliopro' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
			]
			);
			$this->add_control(
			'post_count_filter',
			[
			'label'   => esc_html__( 'Number Of Locations To Show', 'listfoliopro' ),
			'type'    => Controls_Manager::NUMBER,
			'min'     => - 1,
			'max'     => '',
			'step'    => 1,
			'default' => 4,
			]
			);
			$this->add_control(
			'locations_filter',
			[
			'label'       => esc_html__( 'Locations', 'listfoliopro' ),
			'type'        => Controls_Manager::SELECT2,
			'label_block' => true,
			'multiple'    => true,
			'options'     => ep_listfoliopro_post_locations_location(),			
			]
			);
			$this->end_controls_section();
		}
		//Render
		protected function render() {
			$settings = $this->get_settings_for_display();		
			$atts='';
			if ( ! empty( $settings['locations_filter'] ) ) {
				if(is_array($settings['locations_filter'])){
					$atts=$atts.' locations="'.implode(",",$settings['locations_filter']).'"';
					}else{
					$atts=$atts.' locations="'.$settings['locations_filter'].'"';
				}
			}
			if ( ! empty( $settings['post_count_filter'] ) ) {			
				$atts=$atts.' post_limit="'.$settings['post_count_filter'].'"';
			}
			$shortcode ="[listfoliopro_locations  ".$atts." ]";		
			
		?>
		<div class="elementor-shortcode"><?php echo do_shortcode( shortcode_unautop( $shortcode ) );  ?></div>
		<?php
		}
	}
Plugin::instance()->widgets_manager->register( new listfoliopro_Location_Widget );
function ep_listfoliopro_post_locations_location() {
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