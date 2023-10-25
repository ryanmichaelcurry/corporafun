<!-- Footer-->
<footer class="footer text-center">
    <div class="container">
        <div class="row justify-content-between">
            <!-- Footer Location-->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Location</h4>
                <p class="lead mb-0">
                    <?php 
                    // Display the location content from the customizer or default if not set.
                    echo get_theme_mod( 'corporafun_location', '' ); 
                    ?>
                </p>
            </div>
            <!-- Footer About Text-->
            <div class="col-lg-4">
                <h4 class="text-uppercase mb-4">About</h4>
                <p class="lead mb-0">
                    <?php 
                    // Display the about us content from the customizer or default if not set.
                    echo get_theme_mod( 'corporafun_about_us', '' ); 
                    ?>
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- Copyright Section-->
<div class="copyright py-4 text-center text-white">
    <div class="container">
        <small>Copyright &copy; CS4MS <?php echo date('Y'); ?></small>
    </div>
</div>

<?php
wp_footer();
?>
</body>

</html>
