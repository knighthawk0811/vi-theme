<?php
/**
 * Sidebar - footer.
 *
 * @package vi_theme
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php if ( is_active_sidebar( 'sidebar-footer-2' ) ) : ?>
    <div id="sidebar-footer-2">
	   <?php dynamic_sidebar( 'sidebar-footer-2' ); ?>
    </div>
<?php endif; ?>