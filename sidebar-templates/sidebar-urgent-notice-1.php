<?php
/**
 * Sidebar - urgent-notice.
 *
 * @package version_8
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php if ( is_active_sidebar( 'sidebar-urgent-notice-1' ) ) : ?>
    <div id="sidebar-urgent-notice-1" class="urgent-notice">
    <div class="content-container" >
	<?php dynamic_sidebar( 'sidebar-urgent-notice-1' ); ?>
    </div><!-- .content-container -->
    </div>
<?php endif; ?>