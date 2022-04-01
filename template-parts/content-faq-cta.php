<?php
/**
 * Template part for displaying FAQ CTA
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Riding_Rapids
 */

?>

<div class="faq-cta">

	<?php

		if ( function_exists ( 'get_field' ) ) :

			if ( get_field( 'faq_title', 'options') ) :

				?>
					<h2 class="faq-title"> <?php the_field('faq_title', 'options') ?></h2>
				<?php

			endif;

			if ( get_field( 'faq_textarea', 'options') ) :
				
				?>
					<p class="faq-text"> <?php the_field('faq_textarea', 'options') ?></p>
				<?php

			endif;

			if ( get_field( 'faq_button', 'options') ) :

				$link = get_field( 'faq_button', 'options');
				if( $link ): ?>
					<a class="faq-btn faux-btn" href="<?php echo esc_url( $link['url'] ); ?>">FAQ</a>
				<?php endif;

			endif;

		endif;

	?>

	</div>