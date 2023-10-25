<?php
class Custom_Tabs_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        // No need to implement this function since we're not dealing with submenus
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $output .= '<div class="col-md-6 col-lg-4 mb-5">';
        $output .= '<a class="portfolio-item mx-auto bg-primary" href="' . $item->url . '">';
        $output .= '<div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">';
        $output .= '<div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-arrow-up-right-from-square fa-3x"></i></div>';
        $output .= '</div>';
        // Assuming the featured image URL is saved as a custom field with the name 'menu_item_image'
        $image_url = get_the_post_thumbnail_url($item->object_id, 'full');
        $output .= '<img class="img-fluid" src="' . esc_url($image_url) . '" alt="' . esc_attr($item->title) . '" />';
        $output .= '<h1 class="text-center pt-3 pb-3 text-white">' . esc_html($item->title) . '</h1>';
        $output .= '</a>';
        $output .= '</div>';
    }

    function end_el(&$output, $item, $depth = 0, $args = null) {
        // Closing tags are already handled in start_el
    }

    function end_lvl(&$output, $depth = 0, $args = null) {
        // No need to implement this function since we're not dealing with submenus
    }
}
?>