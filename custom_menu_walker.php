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

class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
    
    // Start the level with the opening tag for the parent element (ul).
    function start_lvl(&$output, $depth = 0, $args = null) {
        if ($depth == 0) {
            $output .= '<div class="collapse navbar-collapse" id="navbarResponsive"><ul class="navbar-nav ms-auto">';
        } else {
            $output .= '<ul class="sub-menu">';
        }
    }

    // Close the ul tag.
    function end_lvl(&$output, $depth = 0, $args = null) {
        $output .= '</ul>';
        if ($depth == 0) {
            $output .= '</div>';
        }
    }

    // Output the menu item.
    function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0) {
        if ($depth == 0) {
            $output .= '<li class="nav-item mx-0 mx-lg-1">';
        } else {
            $output .= '<li>';
        }
        $output .= '<a class="nav-link py-3 px-0 px-lg-3 rounded" href="' . $data_object->url . '">' . $data_object->title . '</a>';
    }
    

    // Close the menu item.
    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= '</li>';
    }
}

?>