<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Riding_Rapids
 */

?>

<footer id="colophon" class="site-footer">
    <div class="footer-content-container">
        <section class="logo-container">
            <a href="<?php echo get_home_URL() ?>">
                <img src="<?php echo get_template_directory_uri() ?>/images/rr-white-logo.png" alt="Riding Rapids Logo">
            </a>
            <p class='screen-reader-text'>
                <?php echo get_bloginfo('name');?>
            </p>
        </section>

        <section class="contact-container">
            <h2>Talk To Us</h2>
            <ul class="contact-list">
                <?php if ( function_exists ( 'get_field' ) ) {
						?> <?php
						if ( get_field( 'phone_number', 42 ) ) {
							echo '<li>Phone: ' .get_field('phone_number', 42). '</li>';
						}

						if ( get_field( 'email', 42 ) ) {
							echo '<li>' .get_field('email', 42). '</li>';
						}

						if ( get_field( 'address', 42 ) ) {
							echo '<li>' .get_field('address', 42). '</li>';
						}
					}
					?>
            </ul>
        </section>

        <nav class="socials-container">
            <h2>Follow</h2>
            <ul class="socials-list">
                <li><a href='https://www.instagram.com' target="_blank" rel="noopener">Instagram</a></li>
                <li><a href='https://www.facebook.com' target="_blank" rel="noopener">Facebook</a></li>
                <li><a href='https://www.twitter.com' target="_blank" rel="noopener">Twitter</a></li>
            </ul>
        </nav>

        <nav class="legal-container">
            <h2>Legal</h2>
            <ul class="legal-list">
                <li><a href="<?php the_permalink(3);?>" target="_blank" rel="noopener">Privacy Policy</a></li>
                <li><a href="<?php the_permalink(18);?>" target="_blank" rel="noopener">Refund Policy</a></li>

            </ul>
        </nav>

        <section class="rr-container">
            <p>Riding Rapids Company</p>

        </section>
        <section class="developers">
            <p>
                © 2022
                <span><a href="https://codencreate.ca" target="_blank" rel="noopener">Paul Agupitan</a></span>
                <span><a href="https://megancheung.com" target="_blank" rel="noopener">Megan Cheung</a></span>
                <span><a href="https://judygong.ca" target="_blank" rel="noopener">Judy Gong</a></span>
                <span><a href="https://chriszsolyomy.com" target="_blank" rel="noopener">Chris Zsolyomy</a></span>
            </p>
        </section>

    </div> <!-- .footer-content-container -->

</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>