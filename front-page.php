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
            <!-- Logo Image-->
            <?php 
                $custom_logo_id = get_theme_mod('custom_logo');
                $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                if (has_custom_logo()) {
                    echo '<img class="masthead-avatar mb-5" src="'. esc_url($logo[0]) .'" alt="'. get_bloginfo('name') .'">';
                } 
                ?>
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
    

    <!-- Media Section-->
    <section class="page-section portfolio">
        <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-10 col-xl-10">
                <?php the_content(); ?>
            </div>
        </div>
        </div>
    </section>

<?php
    }
}
?>

    <!-- About Section-->
    <section class="page-section bg-primary text-white mb-0" id="about">
        <div class="container">
            <!-- About Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-white">Our Team</h2>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-code"></i></div>
                <div class="divider-custom-line"></div>
            </div>

            <!-- About Section Content-->
            <div class="row">
                <?php
                $staff_query = new WP_Query(array('post_type' => 'staff', 'orderby' => 'staff_rank', 'order' => 'ASC'));

                if ($staff_query->have_posts()) :
                    while ($staff_query->have_posts()) : $staff_query->the_post();
                ?>

                <div class="col-lg-4 col-md-6">
                    <div class="container p-5 text-center">
                        <img src="<?php the_field('staff_profile'); // Display staff member's profile picture ?>" class="rounded img-fluid" alt="...">
                        <h2 class="mt-4"><?php the_field('staff_name'); // Display staff member's name ?></h2>
                        <p class="lead"><?php the_field('staff_title'); // Display staff member's title ?></p>
                    </div>
                </div>

                <?php endwhile;
                wp_reset_postdata();
                else :
                    echo 'No staff members found.';
                endif;
                ?>
            </div>
        </div>
    </section>

<!-- Contact Section-->
<section class="page-section" id="contact">
    <div class="container">
        <!-- Contact Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Contact Us</h2>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-code"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Contact Section Form-->
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <?php 
                $contact_form_id = get_theme_mod('corporafun_contact_form_id', '');
                $contact_form_title = get_theme_mod('corporafun_contact_form_title', '');
                
                if($contact_form_id && $contact_form_title) {
                    echo do_shortcode('[contact-form-7 id="' . esc_attr($contact_form_id) . '" title="' . esc_attr($contact_form_title) . '"]');
                }
                ?>
            </div>
        </div>
    </div>
</section>
<?php
get_footer();
?>