<?php
/**
 * The template for displaying woocommerce pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @link https://docs.woocommerce.com/document/woocommerce-theme-developer-handbook/
 *
 * @package vi_theme
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			HERE
			
		<?php woocommerce_content(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
