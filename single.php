<?php
get_header();
?>
  <?php if (have_posts()) {
        while (have_posts()) {
            the_post();
            $content = get_the_content();
            $featured_image_url = get_the_post_thumbnail_url();
     ?>
    <!-- Masthead-->
    <header class="masthead masthead-background-image text-white text-center" style="background-image: linear-gradient(to bottom, rgba(0, 165, 156, 0.5), rgba(0, 165, 156, 1)), url('<?php the_post_thumbnail_url(); ?>');">
        <div class="container d-flex align-items-center flex-column">
            <!-- Masthead Heading-->
            <h1 class="masthead-heading text-uppercase mb-0"><?php the_title(); ?></h1>
        </div>
    </header>
    
  <!-- Post Content-->
  <article class="mb-5 mt-5">
    <div class="container px-4 px-lg-5">
      <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-10 col-xl-10">
            <?php the_content(); ?>
        </div>
      </div>
    </div>
  </article>
  <?php
        }
    }
    ?>
<?php
get_footer();
?>