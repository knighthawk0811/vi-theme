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

    <nav  class="primary-navigation navbar navbar-expand-md navbar-light bg-light" role="navigation">
        <div id="nav-header-1">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-navbar-collapse-1" aria-controls="bs-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <?php if( get_theme_mod( 'site_logo', '0' ) != '0' ): ?>
        <a class="navbar-brand" href="<?php echo get_bloginfo('url'); ?>"><img src="<?php echo get_theme_mod( 'site_logo', '0' ); ?>" / alt="<?php echo get_bloginfo('name'); ?>"></a>
        <?php endif; ?>

        <?php
        if ( has_nav_menu( 'header-1' ) ) {
            wp_nav_menu( array(
                'theme_location' => 'header-1',
                'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
                'container'       => 'div',
                'container_class' => 'collapse navbar-collapse',
                'container_id'    => 'bs-navbar-collapse-1',
                'menu_class'      => 'navbar-nav mr-auto',
                'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                'walker'          => new WP_Bootstrap_Navwalker(),
            ) );
        }
        ?>
        </div>
    </nav><!-- .main-navigation -->
</div><!-- #sidebar-header-1 -->