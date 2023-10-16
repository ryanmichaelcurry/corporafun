<?php

function corporafun_theme_support() {
    // Dynamic title tag
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'corporafun_theme_support');

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

function add_custom_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_staff_custom_fields',
            'title' => 'Staff Custom Fields',
            'fields' => array(
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
                    'type' => 'image',
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
add_action('acf/init', 'add_custom_fields');


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