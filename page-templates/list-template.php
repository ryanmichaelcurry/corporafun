<?php
/*
Template Name: List Page
*/
?>

<?php get_header(); ?>

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

<!-- Section-->
<section class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
            <?php
            the_content();
                }
            }
            ?>
                <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $category_to_display = get_post_meta(get_the_ID(), '_post_category_to_display', true);

                // WP_Query arguments
                $args = array(
                    'category_name' => $category_to_display,
                    'posts_per_page' => 10, // you can adjust this value
                    'paged' => $paged
                );

                // Custom query
                $news_query = new WP_Query($args);

                if ($news_query->have_posts()):

                    while ($news_query->have_posts()): $news_query->the_post();
                ?>

                <!-- Home Post List -->
                <article class="post-preview pt-3">
                    <a class="post-heading" href="<?php the_permalink(); ?>">
                        <h1 class="post-title"><?php the_title(); ?></h1>
                        <h4 class="post-subtitle"><?php the_excerpt(); ?></h4>
                    </a>
                    <p class="post-meta">
                        Posted by <?php the_author(); ?> on <?php the_date(); ?> · 
                    </p>
                </article>
                <hr>

                <?php
                    endwhile;
                    // Reset the main query data
                    wp_reset_postdata();

                else:

                    echo 'No posts found in the categories: '. $category_to_display;

                endif;
                ?>

                <!-- Pager -->
                <div class="clearfix">
                    <div class="pagination">
                        <?php
                        echo paginate_links(array(
                            'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                            'total' => $news_query->max_num_pages,
                            'current' => max(1, get_query_var('paged')),
                            'format' => '?paged=%#%',
                            'show_all' => false,
                            'type' => 'plain',
                            'end_size' => 2,
                            'mid_size' => 1,
                            'prev_next' => true,
                            'prev_text' => sprintf('<i></i> %1$s', __('← Previous', 'text-domain')),
                            'next_text' => sprintf('%1$s <i></i>', __('Next →', 'text-domain')),
                            'add_args' => false,
                            'add_fragment' => '',
                        ));
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
