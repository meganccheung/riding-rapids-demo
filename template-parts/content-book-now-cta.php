<?php
/**
 * Template part for displaying Book Now CTA
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Riding_Rapids
 */

?>


<div class="book-now-cta">
	<?php

		if ( function_exists ( 'get_field' ) ) :

			if ( get_field( 'title_field', 'options') ) :

				?>
					<h2 class="book-now-title"> <?php the_field('title_field', 'options') ?></h2>
				<?php

			endif;

			if ( get_field( 'textarea_field', 'options') ) :
				
				?>
					<p class="book-now-text"> <?php the_field('textarea_field', 'options') ?></p>
				<?php

			endif;

			if ( get_field( 'booknow_button', 'options') ) :

				$link = get_field( 'booknow_button', 'options');
				
				if( $link ): ?>
					<a class="book-now-btn faux-btn" href="<?php echo esc_url( $link['url'] ); ?>">Book Now</a>
				<?php endif;

			endif;

		endif;

	?>
</div>