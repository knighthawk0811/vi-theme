<?php
/**
 * vi_theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package vi_theme
 */

/*--------------------------------------------------------------
# generic functions
--------------------------------------------------------------*/


/**
 * parallelize-downloads-across-hostnames
 *
 * use only by itself and not with any other parallelize implementations
 *
 * @link https://stackoverflow.com/questions/34404336/how-to-parallelize-downloads-across-hostnames-on-wordpress
 * @version 8.3.1906
 * @since 8.3.1906
 * @uses parallelize_get_hostname(), add_filter()
 */
function parallelize_hostnames($url, $id) {
	$hostname = parallelize_get_hostname($url); //call supplemental function
	$url = str_replace(parse_url(get_bloginfo('url'), PHP_URL_HOST), $hostname, $url);
	return $url;
}
/**
 * get a hostname from an array
 *
 * return a single hostname from an array, based on the input
 * same input will always return the same hostname
 *
 * @link https://stackoverflow.com/questions/34404336/how-to-parallelize-downloads-across-hostnames-on-wordpress
 * @version 8.3.1906
 * @since 8.3.1906
 */
function parallelize_get_hostname($name) {
	/*
	$subdomains = array('static1.domain.com','static2.domain.com');
	$host = abs(crc32(basename($name)) % count($subdomains));
	$hostname = $subdomains[$host];
	*/
	//single second domain
	$hostname = 'static1.domain.com';
	return $hostname;
}
//add_filter('wp_get_attachment_url', 'parallelize_hostnames', 10, 2);



/**
 * var_dump into a pre html element
 *
 * @link
 * @version 8.3.1906
 * @since 8.3.1906
 */
if ( ! function_exists( 'vi_var_dump_pre' ) ) :
function vi_var_dump_pre($mixed = NULL, $label = NULL)
{
	if(is_string($label)){$label .= ': ';}else{$label = '';}
	echo '<pre>' . $label . "\n";
	var_dump($mixed);
	echo '</pre>';
	return NULL;
}
endif;
/**
 * var_dump return as a pre html element
 *
 * @link
 * @version 8.3.1906
 * @since 8.3.1906
 */
if ( ! function_exists( 'vi_var_dump_return_pre' ) ) :
function vi_var_dump_return_pre($mixed = NULL, $label = NULL)
{
	ob_start();
	if(is_string($label)){$label .= ': ';}else{$label = '';}
	echo '<pre>' . $label . "\n";
	var_dump($mixed);
	echo '</pre>';
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
endif;
/**
* var_dump returned as a string
*
* @link
* @version 8.3.1906
* @since 8.3.1906
*/
if ( ! function_exists( 'vi_var_dump_return' ) ) :
function vi_var_dump_return($mixed = NULL)
{
	ob_start();
	var_dump($mixed);
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
endif;


/**
 * URL query parameters/variables let WP know ahead of time to avoid errors
 *
 * @link
 * @version 8.3.1906
 * @since 8.3.1906
 */
if ( ! function_exists( 'vi_add_query_param' ) ) :
function vi_add_query_param($param) {
	$param[] = "surl"; // URl param
	return $param;
}
//add_filter('query_vars', 'vi_add_query_param');
endif;


/*--------------------------------------------------------------
# setup theme
--------------------------------------------------------------*/

if ( ! function_exists( 'vi_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function vi_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on vi_theme, use a find and replace
		 * to change 'vi_theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'vi_theme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'modal' => __( 'Modal', 'vi_theme' ),
			'header-1' => __( 'Header-1', 'vi_theme' ),
			'header-2' => __( 'Header-2', 'vi_theme' ),
			'footer-1' => __( 'Footer-1', 'vi_theme' ),
			'footer-2' => __( 'Footer-2', 'vi_theme' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		/*add_theme_support( 'custom-background', apply_filters( 'vi_theme_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );*/

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		/*add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );*/

		//custom image sizes
		add_theme_support( 'crop-portrait' );
		add_image_size( 'crop-portrait', 576, 1024, array( 'center', 'center' ) );
		add_theme_support( 'crop-landscape' );
		add_image_size( 'crop-landscape', 1024, 576, array( 'center', 'center' ) );
	}
endif;
add_action( 'after_setup_theme', 'vi_theme_setup' );


// Register the image sizes for use in Add Media modal
function vi_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'crop-portrait' => __( 'Portrait' ),
        'crop-landscape' => __( 'Landscape' ),
    ) );
}
add_filter( 'image_size_names_choose', 'vi_custom_image_sizes' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function vi_theme_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'vi_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'vi_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function vi_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Modal - 1', 'vi_theme' ),
		'id'            => 'sidebar-modal-1',
		'description'   => esc_html__( 'The modal area. Before the menu.', 'vi_theme' ),
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Modal - 2', 'vi_theme' ),
		'id'            => 'sidebar-modal-2',
		'description'   => esc_html__( 'The modal area. After the menu.', 'vi_theme' ),
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Urgent Notice - 1', 'vi_theme' ),
		'id'            => 'sidebar-urgent-notice-1',
		'description'   => esc_html__( 'very top of the page.', 'vi_theme' ),
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Header - 1', 'vi_theme' ),
		'id'            => 'sidebar-header-1',
		'description'   => esc_html__( 'Before the menu.', 'vi_theme' ),
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Header - 2', 'vi_theme' ),
		'id'            => 'sidebar-header-2',
		'description'   => esc_html__( 'After the menu.', 'vi_theme' ),
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Urgent Notice - 2', 'vi_theme' ),
		'id'            => 'sidebar-urgent-notice-2',
		'description'   => esc_html__( 'after the header, before the content.', 'vi_theme' ),
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Left', 'vi_theme' ),
		'id'            => 'sidebar-left',
		'description'   => esc_html__( 'Left side of page.', 'vi_theme' ),
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Right', 'vi_theme' ),
		'id'            => 'sidebar-right',
		'description'   => esc_html__( 'Right side of page.', 'vi_theme' ),
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer - 1', 'vi_theme' ),
		'id'            => 'sidebar-footer-1',
		'description'   => esc_html__( 'Before the menus.', 'vi_theme' ),
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer - 2', 'vi_theme' ),
		'id'            => 'sidebar-footer-2',
		'description'   => esc_html__( 'After the menus.', 'vi_theme' ),
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Urgent Notice - 3', 'vi_theme' ),
		'id'            => 'sidebar-urgent-notice-3',
		'description'   => esc_html__( 'Auto pop-up at the very bottom of the page. Keep it short or it will cover the page.', 'vi_theme' ),
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title">',
		'after_title'   => '</div>',
	) );
}
add_action( 'widgets_init', 'vi_theme_widgets_init' );


/**
 * run shortcode inside text widgets
 *
 * @link https://dannyvankooten.com/enabling-shortcodes-in-widgets-quick-wordpress-tip/
 * @version 8.3.1906
 * @since 8.3.1906
 */
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode', 11);


/**
 * REGISTER SCRIPTS AND STYLES
 *
 * done early, can be overwritten by child theme
 * wp_register_style( string $handle, string|bool $src, array $deps = array(), string|bool|null $ver = false, string $media = 'all' )
 * wp_register_script( string $handle, string|bool $src, array $deps = array(), string|bool|null $ver = false, bool $in_footer = false )
 *
 * @link https://developer.wordpress.org/themes/basics/including-css-javascript/#stylesheets
 * @version 8.3.1906
 * @since 8.3.1906
 */
if ( ! function_exists( 'vi_theme_register_scripts' ) ) :
function vi_theme_register_scripts() {
	//
	wp_register_script( 'vi-navigation', get_template_directory_uri() . '/js/navigation.js', array(), false, true );
	wp_register_script( 'vi-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), false, true );
	//the base style sheet
	wp_register_style( 'vi-style_foundation', get_template_directory_uri() . '/style.css' );
	//this custom style sheet is created OTF
	vi_theme_customize_css();
	//$today = intval(date('YmdHi'));
	wp_register_style( 'vi-style_customize', get_template_directory_uri() . '/style_customize_' . get_current_blog_id() . '.css', 'vi-style_foundation' , null , 'all' );
	//JS (non-AJAX)
	//included in header
	//wp_register_script( 'vi-JS_head', get_template_directory_uri() . '/js/common_head.js', array('jquery'), false, false );
	//included in footer
	wp_register_script( 'vi-JS_foot', get_template_directory_uri() . '/js/common_foot.js', array('jquery'), false, true );
	//AJAX
	//wp_register_script( 'vi-AJAX', get_template_directory_uri() . '/js/common_ajax.js', array('jquery'), false, true );
}
add_action( 'init', 'vi_theme_register_scripts', 10 );
endif;
/**
 * ENQUEUE SCRIPTS AND STYLES
 *
 * can be overwritten by child theme
 * wp_enqueue_style( string $handle, string $src = '', array $deps = array(), string|bool|null $ver = false, string $media = 'all' )
 * wp_enqueue_script( string $handle, string $src = '', array $deps = array(), string|bool|null $ver = false, bool $in_footer = false )
 *
 * @link https://developer.wordpress.org/themes/basics/including-css-javascript/#stylesheets
 * @version 8.3.1906
 * @since 8.3.1906
 */
if ( ! function_exists( 'vi_theme_enqueue_scripts' ) ) :
function vi_theme_enqueue_scripts() {
	//
	wp_enqueue_script( 'vi-navigation' );
	wp_enqueue_script( 'vi-skip-link-focus-fix' );
	//the base style sheet
	wp_enqueue_style( 'vi-style_foundation' );
	//this custom style sheet is created OTF
	wp_enqueue_style( 'vi-style_customize' );
	//JS (non-AJAX)
	//included in header
	//wp_enqueue_script('vi-JS_head');
	//included in footer
	wp_enqueue_script('vi-JS_foot');

	//AJAX
	//wp_enqueue_script('vi-AJAX');
	//localize the script for proper AJAX functioning
	//_wp_localize_script( 'vi-AJAX', 'theurl', array('ajaxurl' => admin_url( 'admin-ajax.php' )));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'vi_theme_enqueue_scripts', 10 );
endif;


/**
 * need style in visual editor?
 * must create an editor.css file for this to operate.
 * there's a body tag issue
 *
 * @link
 * @version 8.3.1906
 * @since 8.3.1906
 */
if ( ! function_exists( 'vi_theme_editor_styles' ) ) :
function vi_theme_editor_styles() {
	add_editor_style();
}
//add_action( 'init', 'vi_theme_editor_styles' );
endif;


/**
 * ENQUEUE SCRIPTS for ADMIN section
 *
 *
 * @link https://developer.wordpress.org/themes/basics/including-css-javascript/#stylesheets
 * @link https://wordpress.stackexchange.com/questions/110895/adding-custom-stylesheet-to-wp-admin
 */
if ( ! function_exists( 'version_8_scripts_admin_section' ) ) :
	function version_8_scripts_admin_section() {
		//enqueue style sheet
		wp_register_style( 'version_8-style-admin', get_template_directory_uri() . '/style-admin.css', NULL , NULL , 'all' );
		wp_enqueue_style( 'version_8-style-admin' );

	}
	add_action( 'admin_enqueue_scripts', 'version_8_scripts_admin_section' );
endif;


/**
 * insert the featured image as a backgroun dimage to the .featured-image-header
 *
 * @link
 * @version 8.3.1910
 * @since 8.3.1906
 */
if ( ! function_exists( 'vi_featured_image_header' ) ) :
function vi_featured_image_header()
{
    global $post;

    //featured image
    if( has_post_thumbnail($post->ID) ) :
        //set to thumbnail
        $featured_image_landscape = 'background-image:url(' . get_the_post_thumbnail_url($post->ID, 'crop-landscape') . ');';
        $featured_image_portrait = 'background-image:url(' . get_the_post_thumbnail_url($post->ID, 'crop-portrait') . ');';
    elseif( get_theme_mod( 'content_image', '0' ) != '0' ) :
        //set to default image
        $featured_image_landscape = 'background-image:url(' . get_theme_mod( 'content_image' ) . ');';
        $featured_image_portrait = 'background-image:url(' . get_theme_mod( 'content_image_portrait' ) . ');';
        if( get_theme_mod( 'content_image_portrait' ) == ( get_template_directory_uri() . '/image/default-image.png' ) ):

			$featured_image_portrait = $featured_image_landscape;
        endif;
    else :
        //set to nothing
        $featured_image_landscape = 'background-image:none;';
        $featured_image_portrait = 'background-image:none;';
    endif;

    //secondary featured image
    $secondary_image_id = get_post_meta( $post->ID, 'vi-secondary-image-id', true );
    if( $secondary_image_id > 0 ) :
        //set to secondary thumbnail
        $secondary_image_landscape = 'background-image:url(' . wp_get_attachment_image_src($secondary_image_id, 'crop-landscape')[0] . ');';
        $secondary_image_portrait = 'background-image:url(' . wp_get_attachment_image_src($secondary_image_id, 'crop-portrait')[0] . ');';
    elseif( get_theme_mod( 'content_image_002', '0' ) != '0' ) :
        //set to default image
        $secondary_image_landscape = 'background-image:url(' . get_theme_mod( 'content_image_002' ). ');';
        $secondary_image_portrait = 'background-image:url(' . get_theme_mod( 'content_image_002_portrait' ). ');';
    else :
        //set to the primary image
        $secondary_image_landscape = 'background-image:none;';
        $secondary_image_portrait = 'background-image:none;';
    endif;

    ?>
    <style type="text/css">
        .featured-image-header {
            <?php echo($featured_image_portrait); ?>
        }
        .featured-image-footer {
            <?php echo($secondary_image_portrait); ?>
        }
        @media only screen and (min-width: 768px) {
        /*900px width and larger*/
            .featured-image-header {
                <?php echo($featured_image_landscape); ?>
            }
        	.featured-image-footer {
                <?php echo($secondary_image_landscape); ?>
            }
        }
    </style>
    <?php

}
add_action( 'wp_head', 'vi_featured_image_header');
endif;

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Security related functions
 */
require get_template_directory() . '/inc/security.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load Bootstrap Nav-walker file.
 */
function vi_register_navwalker()
{
	require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'vi_register_navwalker' );



/*--------------------------------------------------------------
# prettyphoto lightbox
--------------------------------------------------------------*/
/**
 * REGISTER SCRIPTS AND STYLES
 *
 * @link https://developer.wordpress.org/themes/basics/including-css-javascript/#stylesheets
 * @version 8.3.1908
 * @since 8.3.1908
 */
if ( ! function_exists( 'vi_register_prettyPhoto_scripts' ) ) :
function vi_register_prettyPhoto_scripts() {

	wp_register_style( 'vi-prettyPhoto_style', get_template_directory_uri() . '/prettyPhoto.css', NULL , NULL , 'all' );

	//JS (non-AJAX)
	wp_register_script( 'vi-prettyPhoto_script', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array('jquery'), false, false );

}
add_action( 'init', 'vi_register_prettyPhoto_scripts' );
endif;
/**
 * ENQUEUE SCRIPTS AND STYLES
 *
 * @link https://developer.wordpress.org/themes/basics/including-css-javascript/#stylesheets
 * @version 8.3.1908
 * @since 8.3.1908
 *
 */
if ( ! function_exists( 'vi_enqueue_prettyPhoto_scripts' ) ) :
function vi_enqueue_prettyPhoto_scripts() {
	wp_enqueue_style( 'vi-prettyPhoto_style' );
	wp_enqueue_script('vi-prettyPhoto_script');
}
add_action( 'wp_enqueue_scripts', 'vi_enqueue_prettyPhoto_scripts' );
endif;

/**
* prettyPhoto
* put the action in the footer
*
* @link
* @version 8.3.1908
* @since 8.3.1908
*/
if ( ! function_exists( 'vi_prettyPhoto_custom_action' ) ) :
function vi_prettyPhoto_custom_action() {
	if ( !is_admin())
	{
		//class="prettyPhoto" for singles
		//class="prettyGallery" for gallery
	?>
        <script type="text/javascript">
        	//prettyPhoto

        	//add single lightbox
			jQuery(function($) {
				//$(".prettyPhoto a[href*='.jpg'], .prettyPhoto a[href*='.jpeg'], .prettyPhoto a[href*='.gif'], .prettyPhoto a[href*='.png']").attr('rel','prettyPhoto');
				$(".prettyPhoto a[href*='.jpg'], .prettyPhoto a[href*='.jpeg'], .prettyPhoto a[href*='.gif'], .prettyPhoto a[href*='.png'], a[href*='.jpg'].prettyPhoto, a[href*='.jpeg'].prettyPhoto, a[href*='.gif'].prettyPhoto, a[href*='.png'].prettyPhoto").prettyPhoto({
					animationSpeed: 'fast', /* fast/slow/normal */
					padding: 40, /* padding for each side of the picture */
					opacity: 0.35, /* Value betwee 0 and 1 */
					theme: 'pp_default', /* pp_default / light_rounded / dark_rounded / light_square / dark_square / facebook */
					social_tools: false, /*leave blank for default, or add html, or false */
					show_title: true /* true/false */
				});
			})

			//add to gallery
			jQuery(function($) {
				//this works great on a single gallery per page
				//$(".prettyGallery a[href*='.jpg'][href*='.jpeg'][href*='.gif'][href*='.png']").attr('rel','prettyPhoto[pp_gal]');

				//ability to have multiple galleries per page
				var i = 0;
				//get all the galleries
				$( ".prettyGallery" ).each(function(index, item) {
					i++;
					//find ALL the children of said gallery
					$( this ).find("a[href*='.jpg'], a[href*='.jpeg'], a[href*='.gif'], a[href*='.png']").each( function( index, item) {
						//place the gallery id on the children
						//should be matching for all children in a single gallery
						$( this ).attr( 'rel', 'prettyPhoto[gal-' + i + ']')
					});
				});
			})
        </script>
    <?php
	}
}
endif; // prettyPhoto_custom_action
add_action( 'wp_footer', 'vi_prettyPhoto_custom_action' );
/***********************
END prettyphoto lightbox
***********************/



/**
 * Changes 'Username' to 'Email Address' on wp-admin login form
 * and the forgotten password form
 *
 * @link https://wpartisan.me/tutorials/wordpress-how-to-change-the-text-labels-on-login-and-lost-password-pages
 * @version 8.3.1906
 * @since 8.3.1906
 */
if ( ! function_exists( 'vi_theme_login_head' ) ) :
function vi_theme_login_head()
{
	function vi_theme_username_label( $translated_text, $text, $domain )
	{
		if ( 'Username or E-mail:' === $text || 'Username' === $text || 'Username or Email Address' === $text)
		{
			$translated_text = __( 'Email Address' , 'vi_theme' );
		}
		return $translated_text;
	}
	add_filter( 'gettext', 'vi_theme_username_label', 20, 3 );
	add_filter( 'ngettext', 'vi_theme_username_label', 20, 3 );
}
add_action( 'login_head', 'vi_theme_login_head' );
endif;




/*--------------------------------------------------------------
# Secondary Featured Image
--------------------------------------------------------------*/
abstract class VI_theme_featured_image_02
{
	/**
	 * Adds a meta box to the post editing screen
	 *
	 * @link https://themefoundation.com/wordpress-meta-boxes-guide/
	 * @link https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/
	 * @version 9.0.2006
	 * @since 9.0.2003
	 */
	function add()
	{
	    add_meta_box( 'vi_theme_featured_image_02', __( 'Secondary Image', 'vi_theme' ), [self::class, 'callback'], 'page', 'side' );
	    add_meta_box( 'vi_theme_featured_image_02', __( 'Secondary Image', 'vi_theme' ), [self::class, 'callback'], 'post', 'side' );
	}

	/**
	 * Outputs the content of the meta box
	 *
	 * @link https://themefoundation.com/wordpress-meta-boxes-guide/
	 * @link https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/
	 * @version 9.0.2006
	 * @since 9.0.2003
	 */
	function callback( $post )
	{
	    wp_nonce_field( basename( __FILE__ ), 'vi_theme_nonce' );
	    $vi_theme_stored_meta = get_post_meta( $post->ID );

	    $image_id = "";
	    if( isset ( $vi_theme_stored_meta['vi-secondary-image-id'] ) )
	    {
	    	$image_id = $vi_theme_stored_meta['vi-secondary-image-id'][0];
	    }

	    $image_button_add_text = 'Add Image';
	    if( !empty($image_id)  )
	    {
	    	$image_button_add_text = 'Replace Image';
	    }

	    //$image_url = vi_var_dump_return( wp_get_attachment_image_src($image_id, 'crop-landscape') );

	    $image_url = wp_get_attachment_image_src($image_id, 'crop-landscape')[0];
	    ?>

	    <p class="vi-secondary-image-container">
		    <img id="vi-secondary-image" class=" <?php if( empty($image_id)){ echo( ' hidden '); } ?>" src="<?php echo( $image_url ); ?>" alt="Secondary Image" />
		    <br>

		    <input type="text" readonly="" name="vi-secondary-image-id" id="vi-secondary-image-id" class=" <?php if( empty($image_id)){ echo( ' hidden '); } ?> " value="<?php echo( $image_id ) ?>" />
		    <br>

		    <input type="button" id="vi-secondary-image-button" class="button" value="<?php echo( $image_button_add_text ) ?>" />
		    <br>

		    <input type="button" id="vi-secondary-image-button-remove" class="button  <?php if( empty($image_id)){ echo( ' hidden '); } ?>" value="Remove Image" />

		</p>

	    <?php
	}
	/**
	 * Saves the custom meta input
	 *
	 * @link https://themefoundation.com/wordpress-meta-boxes-guide/
	 * @link https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/
	 * @version 9.0.2006
	 * @since 9.0.2003
	 */
	function save( $post_id ) {

	    // Checks save status
	    $is_autosave = wp_is_post_autosave( $post_id );
	    $is_revision = wp_is_post_revision( $post_id );
	    //$is_valid_nonce = check_admin_referer( basename( __FILE__ ), 'vi_theme_nonce');
	    $is_valid_nonce = ( isset( $_POST[ 'vi_theme_nonce' ] ) && wp_verify_nonce( $_POST[ 'vi_theme_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

	    // Exits script depending on save status
	    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
	        return $post_id;
	    }
	    // check permissions
		if ( !current_user_can( 'edit_page', $post_id ) )
		{
			return $post_id;
		}
		elseif ( !current_user_can( 'edit_post', $post_id ) )
		{
			return $post_id;
		}

	    // Checks for input and saves if needed
		//if( isset( $_POST[ 'vi-secondary-image' ] ) ) {
		    //update_post_meta( $post_id, 'vi-secondary-image', $_POST[ 'vi-secondary-image' ] );
		//}
	    // Checks for input and saves if needed
		if( isset( $_POST[ 'vi-secondary-image-id' ] ) ) {
		    update_post_meta( $post_id, 'vi-secondary-image-id', $_POST[ 'vi-secondary-image-id' ] );
		}

	}

	/**
	 * Loads the image management javascript
	 *
	 * @link https://themefoundation.com/wordpress-meta-boxes-guide/
	 * @link https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/
	 * @version 9.0.2006
	 * @since 9.0.2003
	 */
	function enqueue() {
	    global $typenow;
	    if( $typenow == 'page' ||  $typenow == 'post' ) {
	        wp_enqueue_media();

	        // Registers and enqueues the required javascript.
	        wp_register_script( 'secondary-image', get_template_directory_uri() . '/js/meta_box.js', array( 'jquery' ) );
	        wp_localize_script( 'secondary-image', 'featured_image_02',
	            array(
	                'title' => __( 'Choose or Upload an Image', 'vi_theme' ),
	                'button' => __( 'Use this image', 'vi_theme' ),
	            )
	        );
	        wp_enqueue_script( 'secondary-image' );
	    }
	}
}
add_action( 'add_meta_boxes', ['VI_theme_featured_image_02', 'add'] );
add_action( 'save_post', ['VI_theme_featured_image_02', 'save'] );
add_action( 'admin_enqueue_scripts', ['VI_theme_featured_image_02', 'enqueue'] );


/*--------------------------------------------------------------
# Alternate Title
--------------------------------------------------------------*/
abstract class VI_theme_alternate_title
{
	/**
	 * Adds a meta box to the post editing screen
	 *
	 * @link https://themefoundation.com/wordpress-meta-boxes-guide/
	 * @link https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/
	 * @version 9.0.2006
	 * @since 9.0.2006
	 */
	function add()
	{
	    add_meta_box( 'vi_theme_alternate_title', __( 'Alternate Title', 'vi_theme' ), [self::class, 'callback'], 'page', 'side' );
	    add_meta_box( 'vi_theme_alternate_title', __( 'Alternate Title', 'vi_theme' ), [self::class, 'callback'], 'post', 'side' );
	}

	/**
	 * Outputs the content of the meta box
	 *
	 * @link https://themefoundation.com/wordpress-meta-boxes-guide/
	 * @link https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/
	 * @version 9.0.2006
	 * @since 9.0.2006
	 */
	function callback( $post )
	{
        //$post_meta = get_post_meta($post->ID);
	    wp_nonce_field( basename( __FILE__ ), 'vi_theme_nonce' );

        $alt_title = get_post_meta($post->ID, 'alternate_title', true);
        $enabled = get_post_meta($post->ID, 'alternate_title_enabled', true);

        ?>
	    <p class="vi-secondary-image-container">
            <label for="alternate_title"> Alternate Title </label>
            <input id="alternate_title"
                           name="alternate_title"
                           type="text"
                           value="<?php echo( esc_attr($alt_title) ); ?>"
                    />
            <br>
            <label for="alternate_title_enabled"> Use the Alternate Title? </label>
            <input id="alternate_title_enabled"
                           name="alternate_title_enabled"
                           type="checkbox"
                           value="yes"
                           <?php if( isset( $enabled ) ){checked( $enabled, 'yes' );} ?>"
                    />
            <br>
        </p>
            <br>
        <?php

	}
	/**
	 * Saves the custom meta input
	 *
	 * @link https://themefoundation.com/wordpress-meta-boxes-guide/
	 * @link https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/
	 * @version 9.0.2006
	 * @since 9.0.2006
	 */
	function save( $post_id ) {

	    // Checks save status
	    $is_autosave = wp_is_post_autosave( $post_id );
	    $is_revision = wp_is_post_revision( $post_id );
	    //$is_valid_nonce = check_admin_referer( basename( __FILE__ ), 'vi_theme_nonce');
	    $is_valid_nonce = ( isset( $_POST[ 'vi_theme_nonce' ] ) && wp_verify_nonce( $_POST[ 'vi_theme_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

	    // Exits script depending on save status
	    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
	        return $post_id;
	    }
	    // check permissions
		if ( !current_user_can( 'edit_page', $post_id ) )
		{
			return $post_id;
		}
		elseif ( !current_user_can( 'edit_post', $post_id ) )
		{
			return $post_id;
		}

	    // Checks for input and saves if needed
		if( isset( $_POST[ 'alternate_title' ] ) ) {
		    update_post_meta( $post_id, 'alternate_title', $_POST[ 'alternate_title' ] );
		}
		else
		{
		    update_post_meta( $post_id, 'alternate_title', '' );
		}
	    // Checks for input and saves if needed
		if( isset( $_POST[ 'alternate_title_enabled' ] ) ) {
		    update_post_meta( $post_id, 'alternate_title_enabled', 'yes' );
		}
		else
		{
		    update_post_meta( $post_id, 'alternate_title_enabled', '' );
		}

	}
}
add_action( 'add_meta_boxes', ['VI_theme_alternate_title', 'add'] );
add_action( 'save_post', ['VI_theme_alternate_title', 'save'] );