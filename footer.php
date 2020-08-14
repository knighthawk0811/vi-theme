<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package vi_theme
 */

?>

    </div><!-- #content -->


<?php if( !in_array( 'blank-iframe', vi_theme_body_add_class() ) ): ?>

    <div class="featured-image-footer">
    </div><!-- .featured-image-footer -->

	<footer id="colophon" class="site-footer">
		<?php get_template_part( 'sidebar-templates/sidebar', 'footer-1' ); ?>
        <?php
            if ( has_nav_menu( 'footer-1' ) ) {
                echo('<div id="nav-footer-1">');
                wp_nav_menu( array(
                    'theme_location' => 'footer-1',
                ) );
                echo('</div>');
            }
            if ( has_nav_menu( 'footer-2' ) ) {
                echo('<div id="nav-footer-2">');
                wp_nav_menu( array(
                    'theme_location' => 'footer-2',
                ) );
                echo('</div>');
            }
        ?>
        <?php get_template_part( 'sidebar-templates/sidebar', 'footer-2' ); ?>
	</footer><!-- #colophon -->


<?php endif; //body class blank-iframe ?>

<?php get_template_part( 'sidebar-templates/sidebar', 'urgent-notice-3' ); ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
