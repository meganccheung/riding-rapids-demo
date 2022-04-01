<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Riding_Rapids
 */

get_header();
?>

<main id="primary" class="site-main">
    <header class="entry-header">
        <?php echo '<h1 class="entry-title"> '.get_the_title().' </h1>'; ?>
    </header><!-- .entry-header -->
    <?php
				
				riding_rapids_post_thumbnail();
               ?>

    <?php
		while ( have_posts() ) :
            the_post();
            ?> <?php ?>




    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> <?php
                    if ( get_field( 'contact_intro_title' ) ) {
						echo '<h2>' .get_field( 'contact_intro_title' ). '</h2>';
					}?>
        <div class="contact-content">
            <?php 
				if ( function_exists ( 'get_field' ) ) {
			?><section class="first-part-grid"><?php
            
                
			
					if ( get_field( 'contact_intro' ) ) {
						echo '<p>' .get_field( 'contact_intro' ) .'</p>';
					}

                    echo do_shortcode('[contact-form-7 id="11" title="Contact form 1"]');
            ?></div>
        <div class="second-part-grid"><?php
					

                    if ( get_field( 'phone_number' ) ) {
						echo '<p>Phone: ' .get_field( 'phone_number' ) .'</p>';
					}
                    
                    if ( get_field( 'address' ) ) {
						echo '<p>Address: ' .get_field( 'address' ). '</p>';
					}

                    if ( get_field( 'email' ) ) {
						echo '<p>Email: '.get_field( 'email' ).'</p>';
					}
                   
                    
                    $location = get_field('google_map');
                    if( $location ) : ?>
            <section class="acf-map" data-zoom="16">
                <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>"
                    data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
            </section>
            <?php endif;

                if( get_field('downloadable_directions') ): ?>
            <a class='download-btn' href="<?php the_field('downloadable_directions'); ?>" target='_blank'
                rel='noopener'>
                <svg class="download-icon" aria-label="download" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16 11h5l-9 10-9-10h5v-11h8v11zm1 11h-10v2h10v-2z"/></svg>
                Download Map</a>
            <?php endif;
                ?>
        </div>
        </section><?php
            }
                ?>
        </div>

    </article>


    <?php 

    endwhile; // End of the loop.

?>
</main><!-- #main -->

<?php 
get_footer();