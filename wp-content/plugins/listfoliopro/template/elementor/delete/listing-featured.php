<?php
	namespace Elementor;
	class listfoliopro_Featured_Widget extends Widget_Base {
		public function get_name() {
			return 'listfoliopro_featured';
		}
		public function get_title() {
			return esc_html__( 'Featured Listings', 'listfoliopro' );
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
			$shortcode ="[listfoliopro_featured]";
		?>
		<div class="elementor-shortcode"><?php echo do_shortcode( shortcode_unautop( $shortcode ) );  ?></div>
		<?php
		}
	}
Plugin::instance()->widgets_manager->register( new listfoliopro_Featured_Widget );