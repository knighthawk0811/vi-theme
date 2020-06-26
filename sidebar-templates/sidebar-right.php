<?php
/**
 * Sidebar - right.
 *
 * @package vi_theme
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php if ( is_active_sidebar( 'sidebar-right' ) ) : ?>
    <div id="sidebar-right">
	<?php dynamic_sidebar( 'sidebar-right' ); ?>
</div>
<?php endif; ?>