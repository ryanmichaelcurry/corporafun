<?php

function corporafun_register_styles() {
    wp_enqueue_style('corporafun-bootstrap', get_template_directory_uri() . "/style.css", array(), '1.0', 'all');
}

add_action('wp_enqueue_scripts', 'corporafun_register_styles');

?>