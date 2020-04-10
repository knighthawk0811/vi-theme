<?php
/**
 * Sidebar - header 1.
 *
 * @package vi_theme
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div id="sidebar-header-1">
<?php
    if ( is_active_sidebar( 'sidebar-header-1' ) ) {
        dynamic_sidebar( 'sidebar-header-1' );
    }
?>
</div><!-- #sidebar-header-1 -->