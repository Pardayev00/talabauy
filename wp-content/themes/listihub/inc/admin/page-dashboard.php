<?php if (!defined('ABSPATH')) {
	die;
} // Cannot access directly. ?>

<div class="wrap ep-wrap">

    <div class="ep-admin-page-header">

        <div class="ep-admin-page-header-text">
            <h1><?php esc_html_e('Welcome to listihub!', 'listihub'); ?></h1>
            <p><?php esc_html_e('listihub is a directory listing WordPress theme', 'listihub'); ?></p>
        </div>

        <div class="ep-admin-page-header-logo">
            <img src="<?php echo get_theme_file_uri('inc/admin/assets/images/admin-logo.png'); ?>"/>
            <strong>V-<?php echo wp_get_theme()->get('Version'); ?></strong>
        </div>
    </div>

    <div class="ep-admin-boxes">

        <div class="ep-admin-box">

            <div class="ep-admin-box-header">
                <h2><?php esc_html_e('Theme Documentation', 'listihub'); ?></h2>
            </div>

            <div class="ep-admin-box-inside">
                <p><?php esc_html_e('You can find everything about theme settings. See our online documentation.', 'listihub'); ?></p>
                <a href="http://listihub.e-plugins.com/docs/" target="_blank"
                   class="button"><?php esc_html_e('Go to Documentation', 'listihub'); ?></a>
            </div>

        </div>

        <div class="ep-admin-box">

            <div class="ep-admin-box-header">
                <h2><?php esc_html_e('Theme Support', 'listihub'); ?></h2>
            </div>

            <div class="ep-admin-box-inside">
                <p><?php esc_html_e('Do you need help? Feel to free ask any question.', 'listihub'); ?></p>
                <a href="#" target="_blank"
                   class="button"><?php esc_html_e('Go to Support Forum', 'listihub'); ?></a>
            </div>

        </div>

    </div>

</div>
