<?php
require get_template_directory() . '/custom_menu_walker.php';


function corporafun_theme_support() {
    // Dynamic title tag
    add_theme_support('title-tag');
    add_theme_support( 'post-thumbnails' );
    $defaults = array(
        'height'      => 100,
        'width'       => 100,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action('after_setup_theme', 'corporafun_theme_support');

function corporafun_menus() {
    $locations = array(
        'primary' => "Primary Navbar Items",
        'footer' => "Footer Menu Items",
    );

    register_nav_menus($locations);
}
add_action('init', 'corporafun_menus');

// Adding meta boxes
function corporafun_add_custom_meta_boxes() {
    // Subtitle meta box
    add_meta_box(
        'subtitle_meta_box',      // Unique ID
        'Subtitle',               // Title
        'corporafun_show_subtitle_meta_box', // Callback function
        'page',    // Post types
        'side',                 // Context (changed to 'side')
        'high'                    // Priority
    );
    
    // Post category input meta box
    add_meta_box(
        'post_category_input',
        'Post Category Input',
        'corporafun_display_post_category_input',
        'page',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'corporafun_add_custom_meta_boxes');

// Displaying meta box for subtitle
function corporafun_show_subtitle_meta_box($post) {
    $subtitle = get_post_meta($post->ID, '_subtitle', true);
    echo '<label for="subtitle">Subtitle:</label>';
    echo '<input type="text" name="subtitle" value="' . esc_attr($subtitle) . '" style="width:100%;">';
}

// Displaying meta box for post category input
function corporafun_display_post_category_input($post) {
    $input_category = get_post_meta($post->ID, '_post_category_to_display', true);
    echo '<label for="post_category_to_display">Category Slug:</label>';
    echo '<input type="text" name="post_category_to_display" id="post_category_to_display" value="' . esc_attr($input_category) . '">';
    echo '<p><small>Type the slug of the category you want to display. For example, "events" or "community".</small></p>';
}

// Saving the meta box data
function corporafun_save_meta_box_data($post_id) {
    // Saving subtitle
    if (isset($_POST['subtitle'])) {
        update_post_meta($post_id, '_subtitle', sanitize_text_field($_POST['subtitle']));
    }

    // Saving post category input
    if (array_key_exists('post_category_to_display', $_POST)) {
        update_post_meta(
            $post_id,
            '_post_category_to_display',
            sanitize_text_field($_POST['post_category_to_display'])
        );
    }
}
add_action('save_post', 'corporafun_save_meta_box_data');



function corporafun_customize_register( $wp_customize ) {
    // Add About Us section
    $wp_customize->add_setting( 'corporafun_about_us', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );

    $wp_customize->add_control( 'corporafun_about_us', array(
        'label'    => __( 'About Us', 'corporafun' ),
        'section'  => 'title_tagline',
        'type'     => 'textarea',
        'priority' => 30,
    ) );

    // Add Location section
    $wp_customize->add_setting( 'corporafun_location', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );

    $wp_customize->add_control( 'corporafun_location', array(
        'label'    => __( 'Location', 'corporafun' ),
        'section'  => 'title_tagline',
        'type'     => 'textarea',
        'priority' => 40,
    ) );
    

    // Contact Form 7 Customizer Settings
    $wp_customize->add_section('corporafun_contact_form_7', array(
        'title'       => __('Contact Form 7', 'corporafun'),
        'priority'    => 50,
    ));

    $wp_customize->add_setting('corporafun_contact_form_id', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('corporafun_contact_form_id', array(
        'label'    => __('Form ID', 'corporafun'),
        'section'  => 'corporafun_contact_form_7',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('corporafun_contact_form_title', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('corporafun_contact_form_title', array(
        'label'    => __('Form Title', 'corporafun'),
        'section'  => 'corporafun_contact_form_7',
        'type'     => 'text',
    ));
}
add_action( 'customize_register', 'corporafun_customize_register' );


function corporafun_staff_post_type() {
    register_post_type('staff',
        array(
            'labels' => array(
                'name' => __('Staff'),
                'singular_name' => __('Staff Member'),
            ),
            'public' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
        )
    );
}
add_action('init', 'corporafun_staff_post_type');

function add_staff_custom_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_staff_custom_fields',
            'title' => 'Staff Custom Fields',
            'fields' => array(
                array(
                    'key' => 'field_staff_rank',
                    'label' => 'Staff Rank',
                    'name' => 'staff_rank',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_staff_name',
                    'label' => 'Staff Name',
                    'name' => 'staff_name',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_staff_title',
                    'label' => 'Staff Title',
                    'name' => 'staff_title',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_staff_profile',
                    'label' => 'Staff Profile',
                    'name' => 'staff_profile',
                    'type' => 'text',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'staff',
                    ),
                ),
            ),
        ));
    }
}
add_action('acf/init', 'add_staff_custom_fields');

function corporafun_register_styles() {
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('corporafun-style', get_template_directory_uri() . "/style.css", array(), $version, 'all');
}
add_action('wp_enqueue_scripts', 'corporafun_register_styles');

function corporafun_register_scripts() {
    //$version = wp_get_theme()->get('Version'); 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js'
    wp_enqueue_script('corporafun-script', get_template_directory_uri() . "/assets/js/scripts.js", array(), '1.0', true);
    wp_enqueue_script('corporafun-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', array(), '5.2.3', true);
}
add_action('wp_enqueue_scripts', 'corporafun_register_scripts');

?>