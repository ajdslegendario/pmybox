<?php
require_once('wp_bootstrap_navwalker.php');
if ( ! isset( $content_width ) ) $content_width = 1170;

// load textdomain
add_action('after_setup_theme', 'lm_theme_setup');
function lm_theme_setup(){
	load_theme_textdomain('lightning-monkey', get_template_directory() . '/languages');
}

add_theme_support( 'custom-background' );

// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
    global $post;
	return '<a class="read-more" href="'. get_permalink($post->ID) . '">' . __('Read More', 'lightning-monkey') . '</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function lm_themeslug_customize_register( $wp_customize ) {

	// Colors

	$colors = array(
		array('name' =>'1', 'color' => '#A1DD84'),
		array('name' =>'2', 'color' => '#F49A0F'),
		array('name' =>'3', 'color' => '#6598AB'),
		array('name' =>'4', 'color' => '#AE5E0A'),
	);

	$wp_customize->add_section( 'lm_colors_section' , array(
	    'title'       => __( 'Theme Colors', 'lightning-monkey' ),
	    'priority'    => 30,
	    'description' => __('Customize theme colors.', 'lightning-monkey'),
	) );

	foreach($colors as $color){
		$wp_customize->add_setting( 'lm-color-' . $color['name'], array('sanitize_callback' => 'sanitize_text_field', 'default' => $color['color']) );

		$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
			$wp_customize, 
			'lm_color_' . $color['name'], 
			array(
				'label'      => __( 'Color ', 'lightning-monkey' ) . $color['name'],
				'section'    => 'lm_colors_section',
				'settings'   => 'lm-color-' . $color['name'],
			) ) 
		);
	}

	// CSS

	$wp_customize->add_section( 'lm_css' , array(
	    'title'       => __( 'Custom CSS', 'lightning-monkey' ),
	    'priority'    => 30,
	    'description' => __('Add your custom CSS here.', 'lightning-monkey'),
	) );

	$wp_customize->add_setting( 'lm-css', array('sanitize_callback' => 'esc_textarea' ) );

	$wp_customize->add_control( 'lm-css', array(
	    'label'      => __( 'Custom CSS', 'lightning-monkey' ),
	    'section'    => 'lm_css',
	    'settings'   => 'lm-css',
	    'type'       => 'textarea',
	) );

	// Logo

	$wp_customize->add_section( 'lm_logo_section' , array(
	    'title'       => __( 'Logo', 'lightning-monkey' ),
	    'priority'    => 30,
	    'description' => __('Upload a logo to replace the default site name and description in the header', 'lightning-monkey'),
	) );

	$wp_customize->add_setting( 'lm-logo', array('sanitize_callback' => 'esc_url_raw') );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'lm-logo', array(
	    'label'    => __( 'Logo', 'lightning-monkey' ),
	    'section'  => 'lm_logo_section',
	    'settings' => 'lm-logo',
	) ) );

	// Home Page

	$wp_customize->add_section( 'lm_home_section' , array(
	    'title'       => __( 'Home Page', 'lightning-monkey' ),
	    'priority'    => 30,
	    'description' => __('Customize the home page content.', 'lightning-monkey'),
	) );

	$wp_customize->add_setting( 'lm-home-img', array('sanitize_callback' => 'esc_url_raw') );
	$wp_customize->add_setting( 'lm-home-video', array('sanitize_callback' => 'esc_url_raw') );
	$wp_customize->add_setting( 'lm-home-cta-url', array('sanitize_callback' => 'esc_url_raw') );
	$wp_customize->add_setting( 'lm-home-cta-text', array('sanitize_callback' => 'sanitize_text_field','default' => __('Click Here', 'lightning-monkey') ) );
	$wp_customize->add_setting( 'lm-home-header-text', array('sanitize_callback' => 'sanitize_text_field', 'default' => __('This is Lightning Monkey', 'lightning-monkey') ) );
	$wp_customize->add_setting( 'lm-home-subheader-text', array('sanitize_callback' => 'sanitize_text_field', 'default' => __('Fast, Responsive and Awesome!', 'lightning-monkey') ) );
	$wp_customize->add_setting( 'lm-home-content-text', array('sanitize_callback' => 'sanitize_text_field','default' => __('If you need a fast, lightweight theme that looks great, Lightning Monkey is for you. It also has the power of lightning and monkeys. How can you lose?', 'lightning-monkey') ) );

	$wp_customize->add_setting( 'lm-home-left-header', array('sanitize_callback' => 'sanitize_text_field', 'default' => __('Left Header', 'lightning-monkey') ) );
	$wp_customize->add_setting( 'lm-home-center-header', array('sanitize_callback' => 'sanitize_text_field', 'default' => __('Center Header', 'lightning-monkey') ) );
	$wp_customize->add_setting( 'lm-home-right-header', array('sanitize_callback' => 'sanitize_text_field', 'default' => __('Right Header', 'lightning-monkey') ) );

	$wp_customize->add_setting( 'lm-home-left-text', array('sanitize_callback' => 'sanitize_text_field', 'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque lorem odio, convallis non tincidunt in, elementum at urna. Fusce porta ultricies lacus, non tristique neque varius vel.') );
	$wp_customize->add_setting( 'lm-home-center-text', array('sanitize_callback' => 'sanitize_text_field', 'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque lorem odio, convallis non tincidunt in, elementum at urna. Fusce porta ultricies lacus, non tristique neque varius vel.') );
	$wp_customize->add_setting( 'lm-home-right-text', array('sanitize_callback' => 'sanitize_text_field', 'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque lorem odio, convallis non tincidunt in, elementum at urna. Fusce porta ultricies lacus, non tristique neque varius vel.') );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'lm-home-img', array(
	    'label'    => __( 'Home Image', 'lightning-monkey' ),
	    'section'  => 'lm_home_section',
	    'settings' => 'lm-home-img',
	) ) );

	$wp_customize->add_control( 'lm-home-video', array(
	    'label'      => __( 'Home Video (Leave Empty if You Are Using an Image).  Should look like: https://youtu.be/GaYK5cRsL-k or https://vimeo.com/45255964', 'lightning-monkey' ),
	    'section'    => 'lm_home_section',
	    'settings'   => 'lm-home-video',
	    'type'       => 'text',
	) );

	$wp_customize->add_control( 'lm-home-cta-url', array(
	    'label'      => __( 'Call To Action URL', 'lightning-monkey' ),
	    'section'    => 'lm_home_section',
	    'settings'   => 'lm-home-cta-url',
	    'type'       => 'text',
	) );

	$wp_customize->add_control( 'lm-home-cta-text', array(
	    'label'      => __( 'Call To Action Text', 'lightning-monkey' ),
	    'section'    => 'lm_home_section',
	    'settings'   => 'lm-home-cta-text',
	    'type'       => 'text',
	) );

	$wp_customize->add_control( 'lm-home-header-text', array(
	    'label'      => __( 'Header Text', 'lightning-monkey' ),
	    'section'    => 'lm_home_section',
	    'settings'   => 'lm-home-header-text',
	    'type'       => 'text',
	) );

	$wp_customize->add_control( 'lm-subhome-header-text', array(
	    'label'      => __( 'Subheader Text', 'lightning-monkey' ),
	    'section'    => 'lm_home_section',
	    'settings'   => 'lm-home-subheader-text',
	    'type'       => 'text',
	) );

	$wp_customize->add_control( 'lm-home-content-text', array(
	    'label'      => __( 'Content Text', 'lightning-monkey' ),
	    'section'    => 'lm_home_section',
	    'settings'   => 'lm-home-content-text',
	    'type'       => 'textarea',
	) );

	$wp_customize->add_control( 'lm-home-left-header', array(
	    'label'      => __( 'Left Header Text', 'lightning-monkey' ),
	    'section'    => 'lm_home_section',
	    'settings'   => 'lm-home-left-header',
	    'type'       => 'text',
	) );

	$wp_customize->add_control( 'lm-home-left-text', array(
	    'label'      => __( 'Left Section Text', 'lightning-monkey' ),
	    'section'    => 'lm_home_section',
	    'settings'   => 'lm-home-left-text',
	    'type'       => 'textarea',
	) );

	$wp_customize->add_control( 'lm-home-center-header', array(
	    'label'      => __( 'Center Header Text', 'lightning-monkey' ),
	    'section'    => 'lm_home_section',
	    'settings'   => 'lm-home-center-header',
	    'type'       => 'text',
	) );

	$wp_customize->add_control( 'lm-home-center-text', array(
	    'label'      => __( 'Left Section Text', 'lightning-monkey' ),
	    'section'    => 'lm_home_section',
	    'settings'   => 'lm-home-center-text',
	    'type'       => 'textarea',
	) );

	$wp_customize->add_control( 'lm-home-right-header', array(
	    'label'      => __( 'Right Header Text', 'lightning-monkey' ),
	    'section'    => 'lm_home_section',
	    'settings'   => 'lm-home-right-header',
	    'type'       => 'text',
	) );

	$wp_customize->add_control( 'lm-home-right-text', array(
	    'label'      => __( 'Right Section Text', 'lightning-monkey' ),
	    'section'    => 'lm_home_section',
	    'settings'   => 'lm-home-right-text',
	    'type'       => 'textarea',
	) );

	// Social Icons

	$wp_customize->add_section( 'lm_social_icons', array(
	    'title'          	=> __( 'Social Icons', 'lightning-monkey' ),
	    'priority'       	=> 35,
	    'description'		=> __('Add social links in the header by entering the URL for applicable social links.', 'lightning-monkey'),
	) );

	$social_icon_settings = array(
		array(
			'setting'	=> 'lm-facebook-url', 
			'name'		=> __('Facebook URL', 'lightning-monkey'),
		),
		array(
			'setting'	=> 'lm-twitter-url', 
			'name'		=> __('Twitter URL', 'lightning-monkey'),
		),
		array(
			'setting'	=> 'lm-youtube-url', 
			'name'		=> __('YouTube URL', 'lightning-monkey'),
		),
		array(
			'setting'	=> 'lm-google-plus-url', 
			'name'		=> __('Google Plus URL', 'lightning-monkey'),
		),
		array(
			'setting'	=> 'lm-tumblr-url', 
			'name'		=> __('Tumblr URL', 'lightning-monkey'),
		),
		array(
			'setting'	=> 'lm-pinterest-url', 
			'name'		=> __('Pinterest URL', 'lightning-monkey'),
		),
		array(
			'setting'	=> 'lm-linkedin-url', 
			'name'		=> __('LinkedIn URL', 'lightning-monkey'),
		),
		array(
			'setting'	=> 'lm-instagram-url', 
			'name'		=> __('Instagram URL', 'lightning-monkey'),
		),
		array(
			'setting'	=> 'lm-flickr-url', 
			'name'		=> __('Flickr URL', 'lightning-monkey'),
		),
		array(
			'setting'	=> 'lm-vine-url', 
			'name'		=> __('Vine URL', 'lightning-monkey'),
		),
	);

	foreach($social_icon_settings as $setting){
		$wp_customize->add_setting( $setting['setting'], array(
		    'default'        => '',
		    'type'           => 'theme_mod',
		    'sanitize_callback' => 'esc_url_raw',
		) );
	}

	foreach($social_icon_settings as $setting){
		$wp_customize->add_control( $setting['setting'], array(
		    'label'      => $setting['name'], 'lightning-monkey',
		    'section'    => 'lm_social_icons',
		    'settings'   => $setting['setting'],
		    'type'       => 'text',
		) );
	}
}
add_action( 'customize_register', 'lm_themeslug_customize_register' );

function lm_themeslug_filter_front_page_template( $template ) {
    return is_home() ? '' : $template;
}
add_filter( 'frontpage_template', 'lm_themeslug_filter_front_page_template' );

function lm_enqueue_scripts() {
	wp_enqueue_script('jquery');
	wp_enqueue_style( 'lm_google_fonts', '//fonts.googleapis.com/css?family=Open+Sans+Condensed:300' );
	wp_enqueue_style( 'lm_bootstrap_css', get_template_directory_uri() . '/css/bootstrap.css'); 
	wp_enqueue_style( 'lm_fontawesome_css', get_template_directory_uri() . '/css/font-awesome.min.css'); 
	wp_enqueue_script( 'lm_bootstrap_script', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery', false);
	wp_enqueue_style( 'lm_lightning_monkey_style', get_stylesheet_uri(), array() );

}
add_action('wp_enqueue_scripts', 'lm_enqueue_scripts' );

//Register area for custom menu
function lm_register_menus() {
	register_nav_menu( 'primary-menu', __( 'Primary Menu', 'lightning-monkey' ) );
    register_nav_menu( 'footer-menu', __( 'Footer Menu', 'lightning-monkey' ) );
}
add_action( 'init', 'lm_register_menus' );

// Adds theme support for post thumbnails
add_theme_support('post-thumbnails');

set_post_thumbnail_size(520, 250, true);

//Enable post and comments RSS feed links to head
add_theme_support( 'automatic-feed-links' );

// Title tag support
add_theme_support( "title-tag" );

// Register Sidebar
function lm_main_sidebar() {
	$args = array(
		'id'            => 'right-sidebar',
		'name'          => __( 'Right Sidebar', 'lightning-monkey' ),
		'description'   => __( 'Appears on the right side of a page.', 'lightning-monkey' ),
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
	);
	register_sidebar( $args );
}
add_action( 'widgets_init', 'lm_main_sidebar' );
?>