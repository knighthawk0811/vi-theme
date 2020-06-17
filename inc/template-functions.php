<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package vi_theme
 */


/**
 * Adds custom classes to the array of body classes.
 *
 * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/body_class
 * @version 8.3.2003
 * @since 8.3.1904
 * @uses version_8_body_add_class
 */
if ( ! function_exists( 'vi_theme_body_classes' ) ) :
function vi_theme_body_classes( $classes = null ) {

	//must be array
	if(!is_array( $classes ))
	{
		$temp = explode(' ', $classes);
		unset($classes);
		$classes = array();
		foreach( $temp as $item)
		{
			$classes[] = $item;
		}
		unset($temp);
	}

	//add built up classes
	foreach( vi_theme_body_add_class() as $item)
	{
		$classes[] = $item;
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	//add post category to classes for single posts
	if (is_single() )
	{
		global $post;
		foreach((get_the_category($post->ID)) as $category)
		{
			// add category slug to the $classes array
			$classes[] = $category->category_nicename;
		}
    }

	return $classes;
}
add_filter( 'body_class', 'vi_theme_body_classes' );
endif;

/**
 * Adds dynamic classes to the array for body classes.
 *
 * call before the header, static variable will ensure viability when the header calls the body_class action/filter
 * vi_theme_body_add_class( 'home-page' );
 *
 * @link https://wordpress.stackexchange.com/a/48683
 * @version 8.3.2003
 * @since 8.3.1908
 */
if ( ! function_exists( 'vi_theme_body_add_class' ) ) :
function vi_theme_body_add_class( $input = null ) {

	static $vi_body_add_class_array = array();

	//must be an array so we can merge them.
	if(!is_array( $input ))
	{
		$temp = explode(' ', $input);
		unset($input);
		$input = array();
		foreach( $temp as $item)
		{
			$input[] = $item;
		}
		unset($temp);
	}

	$vi_body_add_class_array = array_merge($vi_body_add_class_array, $input);

	return $vi_body_add_class_array;
}
endif;

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function vi_theme_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'vi_theme_pingback_header' );
