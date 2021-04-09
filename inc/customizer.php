<?php
/**
 * vi_theme Theme Customizer
 *
 * @package vi_theme
 */


$vi_theme_default_value = array(
    'content_container_width' => '900px',
    'parallax_height' => '20rem',
    'modal_toggle' => 'yes',
    'content_bg_color' => '#ffffff',
    'content_bg_color_trans' => '100',
    'content_text_color' => '#000000',
    'content_link_color' => '#0000ff',
    'content_image' => '0',
    'content_image_portrait' => '0',
    'content_image_trans' => '100',
    'content_image_002' => '0',
    'content_image_002_portrait' => '0',
    'content_image_002_trans' => '100',
    'nav_001_type' => 'bs',
    'nav_001_image' => '0',
    'nav_002_type' => 'bs',
    'nav_002_image' => '0',
);

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vi_theme_customize_register( $wp_customize ) {
/*--------------------------------------------------------------
# _s
--------------------------------------------------------------*/
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	//$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'vi_theme_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'vi_theme_customize_partial_blogdescription',
		) );
	}


	global $vi_theme_default_value;

/*--------------------------------------------------------------
# custom panel & sections
--------------------------------------------------------------*/
	$wp_customize->add_panel( 'vi_theme_custom_panel', array(
		'title' => __( get_bloginfo( 'name' ) . ' Settings' ),
		'description' => __( 'Change custom Theme settings here.' ),
		'priority' => 160,
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_section( 'vi_theme_custom_section_general', array(
		'title' => __('General Settings' ),
		'description' => __( 'Global Settings.' ),
		'priority' => 160,
		'capability' => 'edit_theme_options',
		'panel' => 'vi_theme_custom_panel',
	) );

    $wp_customize->add_section( 'vi_theme_custom_section_default_image', array(
        'title' => __('Default Image Settings' ),
        'description' => __( 'Set your default iamges.' ),
        'priority' => 160,
        'capability' => 'edit_theme_options',
        'panel' => 'vi_theme_custom_panel',
    ) );

	$wp_customize->add_section( 'vi_theme_custom_section_nav_setting', array(
		'title' => __('Navigation Settings' ),
		'description' => __( 'Select your NavBar options here.' ),
		'priority' => 160,
		'capability' => 'edit_theme_options',
		'panel' => 'vi_theme_custom_panel',
	) );

	$wp_customize->add_section( 'vi_theme_custom_section_content', array(
		'title' => __('Content Area Settings' ),
		'description' => __( 'Settings for the Modal here.' ),
		'priority' => 160,
		'capability' => 'edit_theme_options',
		'panel' => 'vi_theme_custom_panel',
	) );




/*--------------------------------------------------------------
# section general
--------------------------------------------------------------*/

//header icon
$wp_customize->add_setting( 'header_image', array(
    //default
    'validate_callback' => 'vi_theme_custom_style_changed',
    'default' => get_template_directory_uri() . '/image/default-image.png',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_image_control',
   array(
      'label' => __( '' ),
      'description' => esc_html__( 'Select an icon/image to use in the header.' ),
      'section' => 'vi_theme_custom_section_general', // Required, core or custom.
      'settings' => 'header_image'
   )
) );

// content width for parallax layout
$wp_customize->add_setting('content_container_width', array(
    'capability' => 'edit_theme_options',
    'default' => $vi_theme_default_value['content_container_width'],
    'sanitize_callback' => 'sanitize_text_field',
    'validate_callback' => 'vi_theme_custom_style_changed'
) );
$wp_customize->add_control( 'vi_theme_content_container_width_control',
    array(
        'type' => 'text', // Can be either text, email, url, number, hidden, or date
        'priority' => 10, // Within the section.
        'label' => __( 'Content Width' ),
        'description' => __( 'Max width for content. (Background & Parallax Image is still full width)' ),
        'section' => 'vi_theme_custom_section_general', // Required, core or custom.
        'settings' => 'content_container_width',
        'input_attrs' => array(
             'placeholder' => __( 'Width (define your own units)' ),
        ),
    )
);
// image height for parallax layout
$wp_customize->add_setting('parallax_height', array(
    'capability' => 'edit_theme_options',
    'default' => $vi_theme_default_value['parallax_height'],
    'sanitize_callback' => 'sanitize_text_field',
    'validate_callback' => 'vi_theme_custom_style_changed'
) );
$wp_customize->add_control( 'vi_theme_parallax_height_control',
    array(
        'type' => 'text', // Can be either text, email, url, number, hidden, or date
        'priority' => 10, // Within the section.
        'label' => __( 'Simple Parallax Image Height' ),
        'description' => __( 'Height of the Simple Parallax Image (define your own units)' ),
        'section' => 'vi_theme_custom_section_general', // Required, core or custom.
        'settings' => 'parallax_height',
        'input_attrs' => array(
             'placeholder' => __( 'Height (define your own units)' ),
        ),
    )
);

//modal toggale on/off
$wp_customize->add_setting( 'modal_toggle',
    array(
        'default' => 'yes',
        'transport' => 'refresh',
        'sanitize_callback' => 'vi_theme_sanitize_radio',
        'validate_callback' => 'vi_theme_custom_style_changed'
    )
);
$wp_customize->add_control( 'modal_toggle',
   array(
      'label' => __( 'Modal Options' ),
      'description' => esc_html__( 'Toggle Modal Navigation ON or OFF' ),
      'section' => 'vi_theme_custom_section_general',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'radio',
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'choices' => array( // Optional.
         'yes' => __( 'Modal ON' ),
         'no' => __( 'Modal OFF' )
      )
   )
);

/*--------------------------------------------------------------
# section default images
--------------------------------------------------------------*/

$wp_customize->add_setting( 'content_image', array(
    //default
    'validate_callback' => 'vi_theme_custom_style_changed',
    'default' => get_template_directory_uri() . '/image/default-image.png',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'content_image_control',
   array(
      'label' => __( 'Default Featured Image - Landscape' ),
      'description' => esc_html__( 'Select an image to use as the default for pages with no featured image.' ),
      'section' => 'vi_theme_custom_section_default_image', // Required, core or custom.
      'settings' => 'content_image'
   )
) );

$wp_customize->add_setting( 'content_image_portrait', array(
    //default
    'validate_callback' => 'vi_theme_custom_style_changed',
    'default' => get_template_directory_uri() . '/image/default-image.png',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'content_image_portrait_control',
   array(
      'label' => __( 'Default Featured Image - Portrait' ),
      'description' => esc_html__( 'Select an image to use as the default for pages with no featured image. If empty, will default to landscape.' ),
      'section' => 'vi_theme_custom_section_default_image', // Required, core or custom.
      'settings' => 'content_image_portrait'
   )
) );

$wp_customize->add_setting( 'content_image_002', array(
    //default
    'validate_callback' => 'vi_theme_custom_style_changed',
    'default' => get_template_directory_uri() . '/image/default-image.png',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'content_image_002_control',
   array(
      'label' => __( 'Default Secondary Image - Landscape' ),
      'description' => esc_html__( 'Select an image to use as the default/secondary for pages with no featured image.' ),
      'section' => 'vi_theme_custom_section_default_image', // Required, core or custom.
      'settings' => 'content_image_002'
   )
) );

$wp_customize->add_setting( 'content_image_002_portrait', array(
    //default
    'validate_callback' => 'vi_theme_custom_style_changed',
    'default' => get_template_directory_uri() . '/image/default-image.png',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'content_image_002_portrait_control',
   array(
      'label' => __( 'Default Secondary Image - Protrait' ),
      'description' => esc_html__( 'Select an image to use as the default/secondary for pages with no featured image. If empty, will default to landscape.' ),
      'section' => 'vi_theme_custom_section_default_image', // Required, core or custom.
      'settings' => 'content_image_002_portrait'
   )
) );

$wp_customize->add_setting( 'background_image', array(
    //default
    'validate_callback' => 'vi_theme_custom_style_changed',
    'default' => get_template_directory_uri() . '/image/background-image.png',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'background_image_control',
   array(
      'label' => __( 'Background Image' ),
      'description' => esc_html__( 'Set this image as an element\'s background with the class .background-image.' ),
      'section' => 'vi_theme_custom_section_default_image', // Required, core or custom.
      'settings' => 'background_image'
   )
) );

/*--------------------------------------------------------------
# NavBar
--------------------------------------------------------------*/

//nav_001
$wp_customize->add_setting( 'nav_001_type',
    array(
        'default' => 'bs',
        'transport' => 'refresh',
        'sanitize_callback' => 'vi_theme_sanitize_radio',
        'validate_callback' => 'vi_theme_custom_style_changed'
    )
);
$wp_customize->add_control( 'nav_001_type',
   array(
      'label' => __( 'Nav1 Options' ),
      'description' => esc_html__( 'Choose what type of navbar Nav1 will be' ),
      'section' => 'vi_theme_custom_section_nav_setting',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'radio',
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'choices' => array( // Optional.
         'bs' => __( 'Bootstrap Style' ),
         'wp' => __( 'WordPress Style' )
      )
   )
);

$wp_customize->add_setting( 'nav_001_image', array(
    //default
    'validate_callback' => 'vi_theme_custom_style_changed',
    'default' => get_template_directory_uri() . '/image/default-image.png',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'nav_001_image_control',
   array(
      'label' => __( '' ),
      'description' => esc_html__( 'Select an icon/image to use as the Nav1 icon.' ),
      'section' => 'vi_theme_custom_section_nav_setting', // Required, core or custom.
      'settings' => 'nav_001_image'
   )
) );

//nav_002
$wp_customize->add_setting( 'nav_002_type',
    array(
        'default' => 'bs',
        'transport' => 'refresh',
        'sanitize_callback' => 'vi_theme_sanitize_radio',
        'validate_callback' => 'vi_theme_custom_style_changed'
    )
);
$wp_customize->add_control( 'nav_002_type',
   array(
      'label' => __( 'Nav2 Options' ),
      'description' => esc_html__( 'Choose what type of navbar Nav2 will be' ),
      'section' => 'vi_theme_custom_section_nav_setting',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'radio',
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'choices' => array( // Optional.
         'bs' => __( 'Bootstrap Style' ),
         'wp' => __( 'WordPress Style' )
      )
   )
);

$wp_customize->add_setting( 'nav_002_image', array(
    //default
    'validate_callback' => 'vi_theme_custom_style_changed',
    'default' => get_template_directory_uri() . '/image/default-image.png',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'nav_002_image_control',
   array(
      'label' => __( '' ),
      'description' => esc_html__( 'Select an icon/image to use as the Nav2 icon.' ),
      'section' => 'vi_theme_custom_section_nav_setting', // Required, core or custom.
      'settings' => 'nav_002_image'
   )
) );


/*--------------------------------------------------------------
# Content
--------------------------------------------------------------*/

/* background */
  $wp_customize->add_setting('content_bg_color', array(
    'capability' => 'edit_theme_options',
    'default' => $vi_theme_default_value['content_bg_color'],
    'sanitize_callback' => 'sanitize_hex_color',
        'validate_callback' => 'vi_theme_custom_style_changed'
  ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,  'content_bg_color_control',
    array(
      'priority' => 10, // Within the section.
      'label' => __( 'Background Color' ),
      'description' => __( 'Primary Background Color of the website' ),
      'section' => 'vi_theme_custom_section_content', // Required, core or custom.
      'settings' => 'content_bg_color'
    )
  ) );
$wp_customize->add_setting('content_bg_color_trans', array(
    'capability' => 'edit_theme_options',
    'default' => $vi_theme_theme_default_value['content_bg_color_trans'],
    'validate_callback' => 'vi_theme_custom_style_changed'
) );
$wp_customize->add_control( 'content_bg_color_trans_control',
    array(
        'type' => 'range',
        'priority' => 10, // Within the section.
        'label' => __( 'Backgorund Transparency' ),
        'description' => __( 'Is the background transparent?' ),
        'section' => 'vi_theme_custom_section_content', // Required, core or custom.
        'settings' => 'content_bg_color_trans',
        'input_attrs' => array(
            'min' => 0,
            'max' => 100,
            'step' => 1,)
    )
);

/* text */
  $wp_customize->add_setting('content_text_color', array(
    'capability' => 'edit_theme_options',
    'default' => $vi_theme_default_value['content_text_color'],
    'sanitize_callback' => 'sanitize_hex_color',
        'validate_callback' => 'vi_theme_custom_style_changed'
  ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,  'content_text_color_control',
    array(
      'priority' => 10, // Within the section.
      'label' => __( 'Text Color' ),
      'description' => __( 'Primary Text Color of the website' ),
      'section' => 'vi_theme_custom_section_content', // Required, core or custom.
      'settings' => 'content_text_color'
    )
  ) );

/* link */
  $wp_customize->add_setting('content_link_color', array(
    'capability' => 'edit_theme_options',
    'default' => $vi_theme_default_value['content_link_color'],
    'sanitize_callback' => 'sanitize_hex_color',
        'validate_callback' => 'vi_theme_custom_style_changed'
  ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,  'content_link_color_control',
    array(
      'priority' => 10, // Within the section.
      'label' => __( 'Link Color' ),
      'description' => __( 'Primary Link Color of the website' ),
      'section' => 'vi_theme_custom_section_content', // Required, core or custom.
      'settings' => 'content_link_color'
    )
  ) );

//content image
$wp_customize->add_setting( 'content_image_001', array(
    //default
    'validate_callback' => 'vi_theme_custom_style_changed',
    'default' => get_template_directory_uri() . '/image/default-image.png',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'content_image_001_control',
   array(
      'label' => __( 'Default Primary Image - Landscape' ),
      'description' => esc_html__( 'Select an image to use as the default/primary for pages with no featured image.' ),
      'section' => 'vi_theme_custom_section_content', // Required, core or custom.
      'settings' => 'content_image_002'
   )
) );

$wp_customize->add_setting( 'content_image_001_portrait', array(
    //default
    'validate_callback' => 'vi_theme_custom_style_changed',
    'default' => get_template_directory_uri() . '/image/default-image.png',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'content_image_001_portrait_control',
   array(
      'label' => __( 'Default Primary Image - Protrait' ),
      'description' => esc_html__( 'Select an image to use as the default/primary for pages with no featured image. If empty, will default to landscape.' ),
      'section' => 'vi_theme_custom_section_content', // Required, core or custom.
      'settings' => 'content_image_001_portrait'
   )
) );
$wp_customize->add_setting('content_image_001_trans', array(
    'capability' => 'edit_theme_options',
    'default' => $vi_theme_theme_default_value['content_image_002_trans'],
    'validate_callback' => 'vi_theme_custom_style_changed'
) );
$wp_customize->add_control( 'content_image_001_trans_control',
    array(
        'type' => 'range',
        'priority' => 10, // Within the section.
        'label' => __( 'Default Primary Image - Transparency' ),
        'description' => __( 'The Transparency of the image.' ),
        'section' => 'vi_theme_custom_section_content', // Required, core or custom.
        'settings' => 'content_image_001_trans',
        'input_attrs' => array(
            'min' => 0,
            'max' => 100,
            'step' => 1,)
    )
);


$wp_customize->add_setting( 'content_image_002', array(
    //default
    'validate_callback' => 'vi_theme_custom_style_changed',
    'default' => get_template_directory_uri() . '/image/default-image.png',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'content_image_002_control',
   array(
      'label' => __( 'Default Secondary Image - Landscape' ),
      'description' => esc_html__( 'Select an image to use as the default/secondary for pages with no featured image.' ),
      'section' => 'vi_theme_custom_section_content', // Required, core or custom.
      'settings' => 'content_image_002'
   )
) );

$wp_customize->add_setting( 'content_image_002_portrait', array(
    //default
    'validate_callback' => 'vi_theme_custom_style_changed',
    'default' => get_template_directory_uri() . '/image/default-image.png',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'content_image_002_portrait_control',
   array(
      'label' => __( 'Default Secondary Image - Protrait' ),
      'description' => esc_html__( 'Select an image to use as the default/secondary for pages with no featured image. If empty, will default to landscape.' ),
      'section' => 'vi_theme_custom_section_content', // Required, core or custom.
      'settings' => 'content_image_002_portrait'
   )
) );
$wp_customize->add_setting('content_image_002_trans', array(
    'capability' => 'edit_theme_options',
    'default' => $vi_theme_theme_default_value['content_image_002_trans'],
    'validate_callback' => 'vi_theme_custom_style_changed'
) );
$wp_customize->add_control( 'content_image_002_trans_control',
    array(
        'type' => 'range',
        'priority' => 10, // Within the section.
        'label' => __( 'Default Secondary Image - Transparency' ),
        'description' => __( 'The Transparency of the image.' ),
        'section' => 'vi_theme_custom_section_content', // Required, core or custom.
        'settings' => 'content_image_002_trans',
        'input_attrs' => array(
            'min' => 0,
            'max' => 100,
            'step' => 1,)
    )
);







/*--------------------------------------------------------------
# Custom CSS
--------------------------------------------------------------*/
	//custom css area
	$wp_customize->add_section( 'custom_css', array(
		'title' => __( 'Custom CSS' ),
		'description' => __( 'Add custom CSS here.' ),
		'panel' => '', // Not typically needed.
		'priority' => 160,
		'capability' => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
	) );
}
add_action( 'customize_register', 'vi_theme_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function vi_theme_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function vi_theme_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function vi_theme_customize_preview_js() {
	wp_enqueue_script( 'vi_theme-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'vi_theme_customize_preview_js' );


/**
 * Sanitixe radio buttons
 * set the defualt if failed
 *
 * @link https://cachingandburning.com/wordpress-theme-customizer-sanitizing-radio-buttons-and-select-lists/
 * @version 8.3.2003
 * @since 8.3.2003
 */
if ( ! function_exists( 'vi_theme_sanitize_radio' ) ) :
function vi_theme_sanitize_radio( $input, $setting ) {
    global $wp_customize;

    $control = $wp_customize->get_control( $setting->id );

    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}
endif;

/**
 * get the value stored previously
 *
 * @link
 * @version 8.3.2003
 * @since 8.3.1909
 */
if ( ! function_exists( 'vi_theme_get_customizer_value' ) ) :
function vi_theme_get_customizer_value( $input = '' )
{
	global $vi_theme_default_value;

	$input = sanitize_title($input);
	$output = get_theme_mod($input, $vi_theme_default_value[$input]);
	//force set to default value?
	//set_theme_mod($input, $output);

	switch($output)
	{
		case 'bs':
		case 'wp':
    case 'yes':
    case 'no':
			$output = vi_theme_get_customizer_value($output);
			break;
		default :
			//do nothing
	}
	return $output;
}
endif;



/**
 * update the most recent time that settings were changed
 *
 * @link
 * @version 8.3.2003
 * @since 8.3.1909
 */
if ( ! function_exists( 'vi_theme_custom_style_changed' ) ) :
function vi_theme_custom_style_changed( $validity, $value )
{
    $today = intval(date('YmdHis'));
    set_theme_mod('custom_style_changed', $today);

    return $validity;
}
endif;



/**
 * Load customizer CSS in the wp_head
 * this function should be overridden by the child theme
 *
 * @link
 * @version 8.3.2003
 * @since 8.3.1906
 */
if ( ! function_exists( 'vi_theme_customize_css' ) ) :
function vi_theme_customize_css()
{
  $today = intval(date('YmdHis'));
  $last_change = intval( get_theme_mod( 'custom_style_changed', $today ) );
  $last_update = intval( get_theme_mod( 'custom_style_updated', $today ) );

  //if the file doesn't exist, then force it to be reset
  if( !file_exists( get_stylesheet_directory() . '/style_customize_' . get_current_blog_id() . '.css' ) )
  {
    set_theme_mod('custom_style_changed', $today);
    set_theme_mod('custom_style_updated', $today - 1);
  }

  //if the last change is more recent than the last time this was updated
  if( $last_change > $last_update)
  {
    //get the default output
    $content = vi_theme_customize_css_default();
    $content .= vi_theme_customize_css_child_override();
    //write it to the file
    file_put_contents ( get_stylesheet_directory() . '/style_customize_' . get_current_blog_id() . '.css' , $content );
    //update the time
    set_theme_mod( 'custom_style_updated', $today );
  }
}
add_action( 'wp_head', 'vi_theme_customize_css');
endif;


/**
 * output the default style
 * the child theme should use vi_theme_customize_css_child_override rather than rewriting this function
 * only returns the output buffer content, does not actually output anything.
 *
 * @link
 * @version 8.3.2003
 * @since 8.3.2003
 */
if ( ! function_exists( 'vi_theme_customize_css_default' ) ) :
function vi_theme_customize_css_default()
{


    //start capturing the output
    ob_start();
    ?>
        <style type="text/css">
            body {
                color: <?php echo vi_theme_get_customizer_value('content_text_color'); ?>;

                background-color: <?php echo vi_theme_get_customizer_value('content_bg_color'); ?>;
            }

            .content-container {
                max-width: <?php echo vi_theme_get_customizer_value('content_container_width'); ?>;
            }
            body.parallax-simple .featured-image-header,
            body.parallax-simple .featured-image-footer {
                min-height: <?php echo vi_theme_get_customizer_value('parallax_height'); ?>;
            }



            #content a:not(.wp-block-button a, .wc-proceed-to-checkout a, .nav-pills a),
            #content a:not(.wp-block-button a, .wc-proceed-to-checkout a, .nav-pills a):visited {
                color: <?php echo vi_theme_get_customizer_value('content_link_color'); ?>;
            }

        </style>
    <?php
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
endif;


/**
 * output the child override style
 * can/should be used by the child theme rather than rewriting the whole customizer.php
 * only returns the output buffer content, does not actually output anything.
 *
 * @link
 * @version 8.3.2006
 * @since 8.3.2006
 */
if ( ! function_exists( 'vi_theme_customize_css_child_override' ) ) :
function vi_theme_customize_css_child_override()
{
    //create neede variables

    //start capturing the output
    ob_start();
    ?>
        <style type="text/css">
            /* Custom Child Theme */
        </style>
    <?php
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
endif;