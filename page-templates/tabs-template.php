<?php
/*
Template Name: Tabs Page
*/
?>

<?php
get_header();
?>
<?php if (have_posts()) {
    while (have_posts()) {
        the_post();
        $content = get_the_content();
        $featured_image_url = get_the_post_thumbnail_url();
    ?>
<!-- Masthead -->
<header class="masthead masthead-background-image text-white text-center" style="background-image: linear-gradient(to bottom, rgba(0, 165, 156, 0.5), rgba(0, 165, 156, 1)), url('<?php the_post_thumbnail_url(); ?>');">
    <div class="container d-flex align-items-center flex-column">
        <!-- Heading-->
        <h1 class="masthead-heading text-uppercase mb-0"><?php the_title(); ?></h1>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-code"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Masthead Subheading-->
        <h3 class="masthead-subheading font-weight-light mb-0"><?php 
        $subtitle = get_post_meta(get_the_ID(), '_subtitle', true);
        if ($subtitle) {
            echo esc_html($subtitle);
        }
        ?></h3>
    </div>
</header>

<!-- Section -->
<section class="page-section">
    <div class="container">
    <?php
            the_content();
                }
            }
            ?>
        <!-- Grid Items -->
        <div class="row justify-content-center">
<?php
    // Fetch the custom field value
    $category_to_display = get_post_meta(get_the_ID(), '_post_category_to_display', true);

    $args = array(
        'posts_per_page' => -1, // fetch all posts
        'category_name'  => $category_to_display,
    );

$query = new WP_Query($args);

// Check if there are posts
if ($query->have_posts()):

    // Start output buffering
    ob_start();
    ?>

    <!-- Section-->
    <section class="page-section portfolio" id="portfolio">
        <div class="container">
            <!-- Grid Items-->
            <div class="row justify-content-center">
                
                <?php
                // Loop through posts
                while ($query->have_posts()): $query->the_post();
                    
                    $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                    ?>
                    
                    <div class="col-md-6 col-lg-4 mb-5">
                        <a class="portfolio-item mx-auto bg-primary" href="<?php the_permalink(); ?>">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-arrow-up-right-from-square fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="<?php echo esc_url($image_url); ?>" alt="<?php the_title_attribute(); ?>" />
                            <h1 class="tab-item-title text-center pt-3 pb-3 text-white"><?php the_title(); ?></h1>
                        </a>
                    </div>

                <?php endwhile; ?>

            </div>
        </div>
    </section>

    <?php
    // Get the output and clean the buffer
    $output = ob_get_clean();
    
    // Display the output
    echo $output;

    // Reset post data (important)
    wp_reset_postdata();

else:
    echo 'No posts found in the categories: '. $category_to_display;
endif;
?>
        </div>
    </div>
</section>


<?php
get_footer();
?>
