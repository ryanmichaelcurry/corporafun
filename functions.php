<?php

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