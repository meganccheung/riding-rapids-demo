<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Riding_Rapids
 */

?>
<?php

$args = array(
	'post_type'      => 'rrc-testimonials',
	'posts_per_page' => 1,
	'orderby' => 'rand'
);

$query = new WP_Query( $args );

if ( $query -> have_posts() ){ ?>
	<!-- <h2>Random Testimonial</h2> -->
	<?php while ( $query -> have_posts() ) {
		$query -> the_post();
		the_content();
	}
	wp_reset_postdata();
} 


?>