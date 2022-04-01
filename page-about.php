<?php
/**
 * The template for displaying the About Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Riding_Rapids
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php

		if (function_exists ( 'get_field' ) ) :

			while ( have_posts() ) :
				the_post();

				?>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->

				<?php
				
				riding_rapids_post_thumbnail();

				?>
				<section class="about-wrapper">

					<section class="about-section">

						<div class="company-photo">

							<?php

								if ( get_field( 'about_company_photo') ) :

									$image = get_field('about_company_photo');
									$size = 'company-photo'; // (thumbnail, medium, large, full or custom size)

									if( $image ) :
										echo wp_get_attachment_image( $image, $size );
									endif;

								endif;

							?>

						</div>

						<div class="company-story"><?php

							if ( get_field( 'about_company_title') ) :

								?>
								<h2 class="about-company-title"> <?php the_field('about_company_title') ?></h2>
								<?php

							endif;

							if ( get_field( 'about_company_info') ) :

								?>
								<p class="about-company-info">
									<?php the_field( 'about_company_info' ); ?>
								</p>

								<?php

							endif;
							?>

						</div>

					</section>

					<?php

						$args = array(
							'post_type' => 'rrc-team',
							'posts_per_page' => -1, // -1 will return all the Tour Members
						);

					?>

					<section class="staff-wrapper">

						<h2> Meet Our Tour Guides </h2>

						<?php
												
							if ( get_field( 'tour_guides_intro' ) ) :
								?><p class="guides-intro"> <?php the_field( 'tour_guides_intro' ) ?> </p><?php
							endif;

						?>

						<div class="tour-guide-wrapper">

							<?php

								$query = new WP_Query( $args );
								if ( $query -> have_posts() ) :
									while ( $query -> have_posts() ) :
										$query -> the_post();
												
										?><article id="post-<?php the_ID(); ?>" <?php post_class('tour-guides'); ?>> <?php

											the_post_thumbnail('large');

											?>
											<div class="team-member-info">
												<?php

													if ( get_field( 'team_member_role') ) :

														?>

														<h3 class="tour-guide-title"> <?php the_title() ?></h3>
														<p class="tour-guide-role">
															<b>Role:</b> <?php the_field( 'team_member_role' ); ?>
														</p>

														<?php

													endif;

													if ( get_field( 'team_member_description') ) :

														?>

														<p class="tour-guide-description">
															<?php the_field( 'team_member_description' ); ?>
														</p>

														<?php

													endif;

													?>
											</div>

										</article> <?php

									endwhile;
									wp_reset_postdata();
								endif;

							?>

						</div>

					</section>

					<section class="river-land-section">

						<section class="river-section">

							<?php

								if ( get_field( 'river_image') ) :

									$image = get_field('river_image');
									$size = 'large'; // (thumbnail, medium, large, full or custom size)

									if( $image ) :
										echo wp_get_attachment_image( $image, $size );
									endif;

								endif;

								if ( get_field( 'river_title') ) :

									?>
									<h3 class="river-title"> <?php the_field( 'river_title' ); ?></h3>
									<?php

								endif;

								if ( get_field( 'river_info') ) :

									?>

									<p class="river-info">
										<?php the_field( 'river_info' ); ?>
									</p>

									<?php

								endif;

							?>

						</section>

						<section class="land-section"><?php

							if ( get_field( 'territory_image') ) :

								$image = get_field('territory_image');
								$size = 'large'; // (thumbnail, medium, large, full or custom size)

								if( $image ) :
									echo wp_get_attachment_image( $image, $size );
								endif;

							endif;

							if ( get_field( 'territory_title') ) :

								?>

								<h3 class="land-ack-title"> <?php the_field( 'territory_title' ); ?></h3>

								<?php

							endif;

							if ( get_field( 'territory_info') ) :

								?>

								<p class="land-ack-info">
									<?php the_field( 'territory_info' ); ?>
								</p>

								<?php

							endif;

							?>

						</section>

					</section>

				</section>

				<section class="book-now-cta-container">

					<?php
						get_template_part( 'template-parts/content', 'book-now-cta' );
					?>

				</section>

				<?php

			endwhile; // End of the loop.

		endif;
	?>

</main><!-- #main -->

<?php
get_footer();