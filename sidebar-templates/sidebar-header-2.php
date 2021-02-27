<?php
/**
 * Sidebar - header 2.
 *
 * @package vi_theme
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>


<?php if ( is_active_sidebar( 'sidebar-header-2' ) ): ?>
    <div id="sidebar-header-2">
        <?php dynamic_sidebar( 'sidebar-header-2' ); ?>

    </div><!-- #sidebar-header-2 -->
<?php endif; ?>