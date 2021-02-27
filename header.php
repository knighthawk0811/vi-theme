<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package vi_theme
 */

@session_start();
$_SESSION['timer_start'] = microtime(true);

$display_header = true;
if( in_array( 'blank-iframe', vi_theme_body_class() ) ){
    $display_header = false;
}

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body id="top" <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if( $display_header && 'yes' == get_theme_mod( 'modal_toggle', 'yes' )): ?>

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'vi_theme' ); ?></a>

	<div id="modal-main-shade"></div>
	<div id="modal-main-container">
		<div id="modal-bg"></div>
		<div id="modal-area">
		<?php
			get_template_part( 'sidebar-templates/sidebar', 'modal-1' );
			if ( has_nav_menu( 'modal' ) ) {
				echo('<div id="nav-modal">');
				wp_nav_menu( array(
					'theme_location' => 'modal',
				) );
				echo('</div>');
			}
			get_template_part( 'sidebar-templates/sidebar', 'modal-2' );
		?>
		</div>
	</div>
	<div id="modal-button">MENU<a class="toggle-closed"><i class="fa fa-bars" aria-hidden="true"></i></a><a class="toggle-open"><i class="fa fa-times" aria-hidden="true"></i></a></div>

<?php endif; //if display_header ?>


<div id="page" class="site">


<?php if( $display_header ): ?>

	<?php get_template_part( 'sidebar-templates/sidebar', 'urgent-notice-1' ); ?>

	<header id="masthead" class="site-header">
		<?php if ( !empty(get_theme_mod( 'header_image', '0' ) ) ) : ?>
			<a class="site-logo" href="<?php echo get_bloginfo('url'); ?>">
				<img src="<?php echo get_theme_mod( 'header_image', '0' ); ?>" / alt="<?php echo get_bloginfo('name'); ?>">
			</a>
		<?php endif; ?>
		<?php get_template_part( 'sidebar-templates/sidebar', 'header-1' ); ?>

		    <?php
		    if ( has_nav_menu( 'header-1' ) ):
		    	if( 'bs' == get_theme_mod( 'nav_001_type', 'bs' ) ):
		    		?>
			    	<nav  class="primary-navigation navbar navbar-expand-md" role="navigation">
			        <div id="nav-header-1">
			        <?php if( '0' != get_theme_mod( 'nav_001_image', '0' ) ): ?>
			        <a class="navbar-brand" href="<?php echo get_bloginfo('url'); ?>"><img src="<?php echo get_theme_mod( 'nav_001_image', '0' ); ?>" / alt="<?php echo get_bloginfo('name'); ?>"></a>
			        <?php endif; ?>

			        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-navbar-collapse-1" aria-controls="bs-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
			            <span class="navbar-toggler-icon"></span>
			        </button>

			        <?php
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
			        ?>

			        </div>
			    	</nav><!-- .primary-navigation -->
			    <?php elseif( 'wp' == get_theme_mod( 'nav_001_type', 'bs' ) ): ?>
			    	<nav class="main-navigation">
			        <div id="nav-header-1">
			        <?php
			            wp_nav_menu( array(
			                'theme_location' => 'header-1',
			            ) );
			        ?>
			        </div>
			    	</nav><!-- .primary-navigation -->
			    <?php endif; ?>
		    <?php endif; ?>

		    <?php if ( has_nav_menu( 'header-2' ) ):
		    	if( 'bs' == get_theme_mod( 'nav_002_type', 'bs' ) ):
		    		?>
			    	<nav  class="primary-navigation navbar navbar-expand-md" role="navigation">
			        <div id="nav-header-1">
			        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-navbar-collapse-2" aria-controls="bs-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
			            <span class="navbar-toggler-icon"></span>
			        </button>
			        <?php if( '0' != get_theme_mod( 'nav_002_image', '0' ) ): ?>
			        <a class="navbar-brand" href="<?php echo get_bloginfo('url'); ?>"><img src="<?php echo get_theme_mod( 'nav_002_image', '0' ); ?>" / alt="<?php echo get_bloginfo('name'); ?>"></a>
			        <?php endif; ?>

			        <?php
			            wp_nav_menu( array(
			                'theme_location' => 'header-2',
			                'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
			                'container'       => 'div',
			                'container_class' => 'collapse navbar-collapse',
			                'container_id'    => 'bs-navbar-collapse-2',
			                'menu_class'      => 'navbar-nav mr-auto',
			                'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
			                'walker'          => new WP_Bootstrap_Navwalker(),
			            ) );
			        ?>

			        </div>
			    	</nav><!-- .secondary-navigation -->
			    <?php elseif( 'wp' == get_theme_mod( 'nav_002_type', 'bs' ) ): ?>
			    	<nav class="main-navigation">
			        <div id="nav-header-2">
			        <?php
			            wp_nav_menu( array(
			                'theme_location' => 'header-2',
			            ) );
			        ?>
			        </div>
			    	</nav><!-- .secondary-navigation -->
			    <?php endif; ?>
		    <?php endif; ?>

		<?php get_template_part( 'sidebar-templates/sidebar', 'header-2' ); ?>
	</header><!-- #masthead -->

	<?php get_template_part( 'sidebar-templates/sidebar', 'urgent-notice-2' ); ?>

	<div class="featured-image-header">
	</div><!-- .featured-image-header -->

<?php endif; //if display_header ?>

<div id="content" class="site-content">
