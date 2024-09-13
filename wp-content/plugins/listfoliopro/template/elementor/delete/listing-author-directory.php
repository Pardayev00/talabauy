<?php
	namespace Elementor;
	class listfoliopro_Employer_Widget extends Widget_Base {
		public function get_name() {
			return 'listfoliopro_author';
		}
		public function get_title() {
			return esc_html__( 'Author Directory', 'listfoliopro' );
		}
		public function get_icon() {
			return 'eicon-post-excerpt';
		}
		public function get_categories() {
			return [ 'listfoliopro_elements' ];
		}
		protected function register_controls() {
		}
		//Render
		protected function render() {
			$shortcode ="[listfoliopro_author_directory]";		
		?>
		<div class="elementor-shortcode"><?php echo do_shortcode( shortcode_unautop( $shortcode ) );  ?></div>
		<?php
		}
	}
Plugin::instance()->widgets_manager->register( new listfoliopro_Employer_Widget );