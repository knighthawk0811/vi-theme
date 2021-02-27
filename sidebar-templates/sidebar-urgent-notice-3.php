<?php
/**
 * Sidebar - urgent-notice.
 *
 * @package vi_theme
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php if ( is_active_sidebar( 'sidebar-urgent-notice-3' ) ) : ?>
    <div id="sidebar-urgent-notice-3" class="urgent-notice box-shadow-t">
		<div id="sidebar-urgent-notice-3-bg"></div>
    	<?php dynamic_sidebar( 'sidebar-urgent-notice-3' ); ?>
        <button id="sidebar-urgent-notice-3-button" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
<?php endif; ?>