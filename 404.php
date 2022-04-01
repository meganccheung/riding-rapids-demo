<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Riding_Rapids
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'riding-rapids' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try heading back to our home page to start fresh?', 'riding-rapids' ); ?></p>

				<a class="faux-btn" href="https://ridingrapids.bcitwebdeveloper.ca/"> Home Page </a>

			</div><!-- .page-content -->

		</section><!-- .error-404 -->

		
		<section class="book-now-cta-container">

			<?php
				get_template_part( 'template-parts/content', 'book-now-cta' );
			?>

		</section>

	</main><!-- #main -->

<?php
get_footer();
