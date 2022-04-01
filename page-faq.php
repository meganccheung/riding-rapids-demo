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
	<header class="entry-header post-thumbnail">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<?php riding_rapids_post_thumbnail(); ?>
		<section class="faq-intro-container">
			<?php
			echo '<p>'. the_content() .'</p>';
			?>
		</section>

		<section class="general-faq-container">
			<h2>General FAQS</h2>
			<?php
			if ( function_exists ( 'get_field' ) ) :
				if( have_rows('faq_general_accordion') ):
					while( have_rows('faq_general_accordion') ) : the_row();
					$question = get_sub_field('general_question');
					$answer = get_sub_field('general_answer');
					?>
					<div class="container"> 
						<ul class="acc">
							<li>
								<button class="acc_ctrl">
									<?php echo '<h3>'.$question.'</h3>'; ?>
								</button>
								<div class="acc_panel">
									<?php echo '<p>'.$answer.'</p>'; ?>
								</div>
							</li>
						</ul>
					</div>
					<?php
				endwhile;
			endif;	
			?>
		</section>

		<section class="rafting-faq-section">
			<h2>Rafting FAQS</h2>
			<?php
			if( have_rows('faq_rafting_accordion') ):
				while( have_rows('faq_rafting_accordion') ) : the_row();
					$question = get_sub_field('rafting_question');
					$answer = get_sub_field('rafting_answer');
					?>
					<div class="container"> 
						<ul class="acc">
							<li>
								<button class="acc_ctrl">
									<?php echo '<h3>'.$question.'</h3>'; ?>
								</button>
								<div class="acc_panel">
									<?php echo '<p>'.$answer.'</p>'; ?>
								</div>
							</li>
						</ul>
					</div>
				<?php
				endwhile;
			endif;
			?>
		</section>

		<section class="snowshoeing-faq-section">
			<h2>Snowshoeing FAQS</h2>
				<?php
				if( have_rows('faq_snowshoeing_accordion') ):
					while( have_rows('faq_snowshoeing_accordion') ) : the_row();	
						$question = get_sub_field('snowshoeing_question');
						$answer = get_sub_field('snowshoeing_answer');
						?>
						<div class="container"> 
							<ul class="acc">
								<li>
									<button class="acc_ctrl">
										<?php echo '<h3>'.$question.'</h3>'; ?>
									</button>
									<div class="acc_panel">
										<?php echo '<p>'.$answer.'</p>'; ?>
									</div>
								</li>
							</ul>
						</div>
					<?php
					endwhile;
				endif;
				?>
		</section>
		<section class="book-now-cta-container">
		<?php
			get_template_part( 'template-parts/content', 'book-now-cta' );
		?>
		</section>
	<?php endif; ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</main><!-- #main -->
<?php
get_footer();
