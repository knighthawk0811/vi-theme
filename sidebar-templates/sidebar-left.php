<?php
/**
 * Sidebar - left.
 *
 * @package vi_theme
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php if ( is_active_sidebar( 'sidebar-left' ) ) : ?>
    <div id="sidebar-left-1">
	<?php dynamic_sidebar( 'sidebar-left' ); ?>
</div>
<?php endif; ?>