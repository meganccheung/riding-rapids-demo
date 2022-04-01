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

    <?php
	while ( have_posts() ) :
	the_post();
	?>
    <section class="greeting-container">

        <?php
        echo '<h1 class="screen-reader-text">'. get_the_title() .'</h1>';
        $image = get_field('home_hero_media');
        $size = 'full';
        ?>
        <div class='post-thumbnail'>
            <?php
            if ( $image ) {
                echo wp_get_attachment_image($image, $size);
            }
            ?>
            <img class='wave-img' src="<?php echo get_template_directory_uri() ?>/images/waves.png" alt="This a white wave">
        </div>
        
        <?php
        if ( get_field( 'hero_intro_field' ) ) {
        echo '<p>' . get_field('hero_intro_field') . '</p>';
        }

        if ( function_exists( 'get_field' ) ) {
        if ( get_field( 'booknow_button', 'options') ) :
        ?>

            <?php 
            $link = get_field( 'booknow_button', 'options');
            if( $link ): ?>
            <a class="book-now-btn home-btn" href="<?php echo esc_url( $link['url'] ); ?>">Book Now</a>
            <?php endif;
            ?>

        <?php
		endif;
		}
        ?>
    </section>

    <section class="home-page-wrapper">
        <section class="home-about-section">
            <?php
				if ( get_field( 'about_title' ) ) {
					echo '<h2>' . get_field('about_title') . '</h2>';
				}

				if ( get_field( 'about_description' ) ) {
					echo '<p>' . get_field('about_description') . '</p>';
				}
				?>
            <div class="about-cta-container">
                <a href="<?php the_field('about_link'); ?>">Learn More About Us</a>
            </div>
        </section>
        
        <section id="post-<?php the_ID(); ?>" <?php post_class('featured-products-container'); ?>>
            <?php
				$featured_posts = get_field('featured_tours');
				if( $featured_posts ): ?>
            <ul>
                <?php foreach( $featured_posts as $post ): 
						setup_postdata($post); ?>
                <li>
                    <div id="post-<?php the_ID(); ?>" <?php post_class('single-tour-product'); ?>>
                        <?php the_post_thumbnail(); ?>
                        <div id="post-<?php the_ID(); ?>" <?php post_class('product-details'); ?>>
                            <h2><?php the_title(); ?></h2>
                            <p><?php woocommerce_template_single_excerpt() ?> </p>
                            <a href="<?php the_permalink(); ?>"> Learn More</a>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php 
					wp_reset_postdata(); ?>
            <?php endif; ?>
        </section>
        <section class="testimonials-yelp-container">
            <section class="testimonials-container">
                <?php
						$args = array(
						'post_type'      => 'rrc-testimonials',
						'posts_per_page' =>  -1
						);

						$query = new WP_Query( $args );

						if ( $query->have_posts() ) :
					?>
                <h2>Testimonials</h2>
                <article class="swiper">
                    <div class="swiper-wrapper">
                        <?php
								while ( $query->have_posts() ) :
									$query->the_post();
									?>
                        <div class="swiper-slide">
                            <?php the_content(); ?>
                        </div>
                        <?php
								endwhile;
								wp_reset_postdata();
								?>
                    </div>
                    <div class="swiper-pagination"></div>
                </article>
                <?php
						endif;
						?>
            </section>

            <section class="google-yelp-container">
                    <h2>Yelp and Google Reviews</h2>
                    <div class="icons-container">
                        <div class="yelp-container">
                            <img src="<?php echo get_template_directory_uri() ?>/images/yelp.png" alt="this is a yelp logo">
                            <a href="https://www.yelp.ca" target=”_blank”> See Yelp reviews </a>
                        </div>
                        <div class="google-container">
                            <img src="<?php echo get_template_directory_uri() ?>/images/google.png" alt="this is a google logo">
                            <a href="https://www.google.com" target=”_blank”> See Google reviews </a>
                        </div>
                    </div>
            </section>
        </section>

        <section class="book-now-video">
            <?php
			$file = get_field('featured_video');
			if( $file ): 
            ?>
            <video width="100%" height="auto" loading="lazy" autoplay loop muted>
                <source src="<?php echo $file['url']; ?>" type="video/mp4">
            </video>
        </section>

        <section class="book-now-cta-container">
            <?php endif; 
				?>
            <?php
				get_template_part( 'template-parts/content', 'book-now-cta' );
				?>
        </section>

    </section>
    <?php
	endwhile;
	?>

</main><!-- #main -->

<?php
get_footer();