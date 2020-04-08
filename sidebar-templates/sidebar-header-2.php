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

<div id="sidebar-header-2">

    <nav class="main-navigation">
        <div id="nav-header-2">
        <?php
        if ( has_nav_menu( 'header-2' ) ) {
            wp_nav_menu( array(
                'theme_location' => 'header-2',
            ) );
        }
        ?>
        </div>
    </nav><!-- .main-navigation -->

<?php
    if ( is_active_sidebar( 'sidebar-header-2' ) ) {
        dynamic_sidebar( 'sidebar-header-2' );
    }
?>
</div><!-- #sidebar-header-2 -->