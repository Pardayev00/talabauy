<?php
	namespace Elementor;
	class listfoliopro_Add_new_listing_Widget extends Widget_Base {
		public function get_name() {
			return 'listfoliopro_add_new_listing';
		}
		public function get_title() {
			return esc_html__( 'Add Listing', 'listfoliopro' );
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
			$shortcode ="[listfoliopro_add_listing]";
		?>
		<div class="elementor-shortcode"><?php echo do_shortcode( shortcode_unautop( $shortcode ) );  ?></div>
		<?php
		}
	}
Plugin::instance()->widgets_manager->register( new listfoliopro_Add_new_listing_Widget );