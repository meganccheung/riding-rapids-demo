<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Riding_Rapids
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function riding_rapids_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 500,
			'single_image_width'    => 1920,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 2,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	// add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'riding_rapids_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function riding_rapids_woocommerce_scripts() {
	wp_enqueue_style( 'riding-rapids-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'riding-rapids-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'riding_rapids_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function riding_rapids_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'riding_rapids_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function riding_rapids_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'riding_rapids_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'riding_rapids_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function riding_rapids_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'riding_rapids_woocommerce_wrapper_before' );

if ( ! function_exists( 'riding_rapids_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function riding_rapids_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'riding_rapids_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'riding_rapids_woocommerce_header_cart' ) ) {
			riding_rapids_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'riding_rapids_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function riding_rapids_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		riding_rapids_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'riding_rapids_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'riding_rapids_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function riding_rapids_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'riding-rapids' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'riding-rapids' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'riding_rapids_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function riding_rapids_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php riding_rapids_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}

function riding_rapids_init() {
	// Single Product
	add_action(
		'woocommerce_before_single_product_summary',
		'riding_rapids_show_post_thumbnail',
		15
	);
	remove_action(
		'woocommerce_single_product_summary',
		'woocommerce_template_single_meta',
		40
	);
	remove_action(
		'woocommerce_single_product_summary',
		'woocommerce_template_single_price',
		10
	);
	add_action(
		'woocommerce_single_product_summary',
		'riding_rapids_lunch_desc',
		21
	);
	add_action(
		'woocommerce_single_product_summary',
		'riding_rapids_product_acf',
		25
	);
	add_action( 
		'woocommerce_single_product_summary', 
		'woocommerce_show_product_images', 
		27 
	);
	add_action( 
		'woocommerce_single_product_summary', 
		'riding_rapids_booking_heading', 
		28 
	);
	remove_action( 
		'woocommerce_before_single_product_summary', 
		'woocommerce_show_product_images', 
		20 
	);
	remove_all_actions(
		'woocommerce_after_single_product_summary'
	);
	remove_action(
		'woocommerce_sidebar',
		'woocommerce_get_sidebar',
		10
	);

	// Archive Product
	remove_action(
		'woocommerce_before_main_content',
		'woocommerce_breadcrumb',
		20
	);
	remove_action(
		'woocommerce_before_shop_loop',
		'woocommerce_result_count',
		20
	);
	remove_action(
		'woocommerce_before_shop_loop',
		'woocommerce_catalog_ordering',
		30
	);
	remove_action(
		'woocommerce_before_shop_loop_item',
		'woocommerce_template_loop_product_link_open',
		10
	);
	remove_action(
		'woocommerce_after_shop_loop_item',
		'woocommerce_template_loop_product_link_close',
		5
	);
	add_action(
		'woocommerce_after_shop_loop_item_title',
		'woocommerce_template_single_excerpt',
		15
	);
	remove_action(
		'woocommerce_after_shop_loop_item_title',
		'woocommerce_template_loop_price',
		10
	);
	add_action(
		'woocommerce_after_shop_loop_item_title',
		'riding_rapids_product_acf',
		15
	);
	add_filter(
		'woocommerce_product_add_to_cart_text',
		function($text) {return 'Learn More';}
	);
	remove_action(
		'woocommerce_shop_loop_item_title',
		'woocommerce_template_loop_product_title',
		10
	);
	add_action(
		'woocommerce_shop_loop_item_title',
		'riding_rapids_template_loop_product_title',
		15
	);
	add_action(
		'woocommerce_after_main_content',
		'riding_rapids_faq_cta',
		9
	);
}
add_action( 'init', 'riding_rapids_init' );

// Get ACF content

function riding_rapids_product_acf() {
	if ( function_exists( 'get_field') ) {
		// Tour Information General

		if (!is_shop()):

			?>
			<div class="tour-info-map-container">

				<h2 class="tour-info-heading">Tour Information</h2>

				<div class="tour-info-map">

					<section class="tour-info"> <?php

					if (get_field('tour_length')) {
						?>
						<section class="tour-length">
							<h3>Tour Length</h3>
							<p><?php the_field('tour_length'); 
							if (get_field('tour_length') <= 1) {
								echo ' hour';	
							} else {
								echo ' hours';
							}
							?></p>
						</section>
						<?php
					}

					if( have_rows('departure_times') ):
						while( have_rows('departure_times') ) : the_row();
						?>
						<section class="departure-times">
							<h3>Departure Times</h3>
							<?php if (get_sub_field('available_months')) {
								echo '<p>Months: '.get_sub_field('available_months').'</p>';
							}
							if (get_sub_field('available_days')) {
								echo '<p>Days: '.get_sub_field('available_days').'</p>';
							}
							?><p>Times: <?php
								// Loop over sub repeater rows.
								if( have_rows('available_times') ):

									$availableTimeArr = array();

									while( have_rows('available_times') ) : the_row();
						
										// Get sub value.
										$availableTimePicker = get_sub_field('available_time_picker');

										$availableTimeArr[] = $availableTimePicker;
										
									endwhile;
									
									$availableTimeList = join(", ",$availableTimeArr);
									echo $availableTimeList;

								endif;
								?> </p> <?php
							?> </section> <?php
						endwhile;
					endif;
		
				// Tour Information Summer + Tour Information Winter

					if (get_field('minimum_age')) {
						?>
						<section class="minimum-age">
							<h3>Minimum Age</h3>
							<p><?php the_field('minimum_age') ?> years and up</p>
						</section>
						<?php
					}

					if (get_field('minimum_age_winter')) {
						?>
						<section class="minimum-age">
							<h3>Minimum Age</h3>
							<p><?php the_field('minimum_age_winter') ?> years and up</p>
						</section>
						<?php
					}

					if (get_field('minimum_weight')) {
						?>
						<section class="minimum-weight">
							<h3>Minimum Weight</h3>
							<p><?php the_field('minimum_weight') ?> lbs and up</p>
						</section>
						<?php
					}

		endif;
	
				echo "<div class='archive-price-classification-container'>";

					if( have_rows('display_price') ):
						while( have_rows('display_price') ) : the_row();
						?>
						<section class="price">
						<?php if (!is_shop()) { ?>
							<h3>Price</h3> <?php
							} else {
							?> <h4>
								<svg class="tour-icons" aria-label="price-tag" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M48 32H197.5C214.5 32 230.7 38.74 242.7 50.75L418.7 226.7C443.7 251.7 443.7 292.3 418.7 317.3L285.3 450.7C260.3 475.7 219.7 475.7 194.7 450.7L18.75 274.7C6.743 262.7 0 246.5 0 229.5V80C0 53.49 21.49 32 48 32L48 32zM112 176C129.7 176 144 161.7 144 144C144 126.3 129.7 112 112 112C94.33 112 80 126.3 80 144C80 161.7 94.33 176 112 176z"/></svg>
								Price</h4> <?php
						}
						if (get_sub_field('adult_price')) :
							echo '<p>Adult (12+): $'.get_sub_field('adult_price').'</p>';
						endif;
						if (get_sub_field('child_price')) :
							echo '<p>Child: $'.get_sub_field('child_price').'</p>';
						endif;
						?> </section> <?php
						endwhile;
					endif;

					if (get_field('rapid_classification_value')) {
						?>
						<section class="rapid-classification">
						<?php
							if (!is_shop()) {
								?> <h3>Rapid Classification</h3> <?php
							}
							else {
								?> <h4>
									<svg class="tour-icons" aria-label="waves" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M549.8 237.5c-31.23-5.719-46.84-20.06-47.13-20.31C490.4 205 470.3 205.1 457.7 216.8c-1 .9375-25.14 23-73.73 23s-72.73-22.06-73.38-22.62C298.4 204.9 278.3 205.1 265.7 216.8c-1 .9375-25.14 23-73.73 23S119.3 217.8 118.6 217.2C106.4 204.9 86.35 205 73.74 216.9C73.09 217.4 57.48 231.8 26.24 237.5c-17.38 3.188-28.89 19.84-25.72 37.22c3.188 17.38 19.78 29.09 37.25 25.72C63.1 295.8 82.49 287.1 95.96 279.2c19.5 11.53 51.47 24.68 96.04 24.68c44.55 0 76.49-13.12 96-24.65c19.52 11.53 51.45 24.59 96 24.59c44.58 0 76.55-13.09 96.05-24.62c13.47 7.938 32.86 16.62 58.19 21.25c17.56 3.375 34.06-8.344 37.25-25.72C578.7 257.4 567.2 240.7 549.8 237.5zM549.8 381.7c-31.23-5.719-46.84-20.06-47.13-20.31c-12.22-12.19-32.31-12.12-44.91-.375C456.7 361.9 432.6 384 384 384s-72.73-22.06-73.38-22.62c-12.22-12.25-32.3-12.12-44.89-.375C264.7 361.9 240.6 384 192 384s-72.73-22.06-73.38-22.62c-12.22-12.25-32.28-12.16-44.89-.3438c-.6562 .5938-16.27 14.94-47.5 20.66c-17.38 3.188-28.89 19.84-25.72 37.22C3.713 436.3 20.31 448 37.78 444.6C63.1 440 82.49 431.3 95.96 423.4c19.5 11.53 51.51 24.62 96.08 24.62c44.55 0 76.45-13.06 95.96-24.59C307.5 434.9 339.5 448 384.1 448c44.58 0 76.5-13.09 95.1-24.62c13.47 7.938 32.86 16.62 58.19 21.25C555.8 448 572.3 436.3 575.5 418.9C578.7 401.5 567.2 384.9 549.8 381.7zM37.78 156.4c25.33-4.625 44.72-13.31 58.19-21.25c19.5 11.53 51.47 24.68 96.04 24.68c44.55 0 76.49-13.12 96-24.65c19.52 11.53 51.45 24.59 96 24.59c44.58 0 76.55-13.09 96.05-24.62c13.47 7.938 32.86 16.62 58.19 21.25c17.56 3.375 34.06-8.344 37.25-25.72c3.172-17.38-8.344-34.03-25.72-37.22c-31.23-5.719-46.84-20.06-47.13-20.31c-12.22-12.19-32.31-12.12-44.91-.375c-1 .9375-25.14 23-73.73 23s-72.73-22.06-73.38-22.62c-12.22-12.25-32.3-12.12-44.89-.375c-1 .9375-25.14 23-73.73 23S119.3 73.76 118.6 73.2C106.4 60.95 86.35 61.04 73.74 72.85C73.09 73.45 57.48 87.79 26.24 93.51c-17.38 3.188-28.89 19.84-25.72 37.22C3.713 148.1 20.31 159.8 37.78 156.4z"/></svg>
									Rapid Classification</h4> <?php
							}
						
								if (get_field('rapid_classification_value') === 'Class 1') {
									echo "<p>Class 1 - Low</p>";
								} elseif (get_field('rapid_classification_value') === 'Class 2') {
									echo "<p>Class 2 - Medium</p>";
								} elseif (get_field('rapid_classification_value') === 'Class 3') {
									echo "<p>Class 3 - Medium</p>";
								} elseif (get_field('rapid_classification_value') === 'Class 4') {
									echo "<p>Class 4 - High</p>";
								}
							?>
						</section>
						<?php
					}

					if (get_field('trail_difficulty')) {
						?>
						<section class="trail-difficulty">
						<?php
							if (!is_shop()) {
								?> <h3>Trail Difficulty</h3> <?php
							}
							else {
								?> 
								<h4>
								<svg class="tour-icons" aria-label="snowflake" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M475.6 384.1C469.7 394.3 458.9 400 447.9 400c-5.488 0-11.04-1.406-16.13-4.375l-25.09-14.64l5.379 20.29c3.393 12.81-4.256 25.97-17.08 29.34c-2.064 .5625-4.129 .8125-6.164 .8125c-10.63 0-20.36-7.094-23.21-17.84l-17.74-66.92L288 311.7l.0002 70.5l48.38 48.88c9.338 9.438 9.244 24.62-.1875 33.94C331.5 469.7 325.4 472 319.3 472c-6.193 0-12.39-2.375-17.08-7.125l-14.22-14.37L288 480c0 17.69-14.34 32-32.03 32s-32.03-14.31-32.03-32l-.0002-29.5l-14.22 14.37c-9.322 9.438-24.53 9.5-33.97 .1875c-9.432-9.312-9.525-24.5-.1875-33.94l48.38-48.88L223.1 311.7l-59.87 34.93l-17.74 66.92c-2.848 10.75-12.58 17.84-23.21 17.84c-2.035 0-4.1-.25-6.164-.8125c-12.82-3.375-20.47-16.53-17.08-29.34l5.379-20.29l-25.09 14.64C75.11 398.6 69.56 400 64.07 400c-11.01 0-21.74-5.688-27.69-15.88c-8.932-15.25-3.785-34.84 11.5-43.75l25.96-15.15l-20.33-5.508C40.7 316.3 33.15 303.1 36.62 290.3S53.23 270 66.09 273.4L132 291.3L192.5 256L132 220.7L66.09 238.6c-2.111 .5625-4.225 .8438-6.305 .8438c-10.57 0-20.27-7.031-23.16-17.72C33.15 208.9 40.7 195.8 53.51 192.3l20.33-5.508L47.88 171.6c-15.28-8.906-20.43-28.5-11.5-43.75c8.885-15.28 28.5-20.44 43.81-11.5l25.09 14.64L99.9 110.7C96.51 97.91 104.2 84.75 116.1 81.38C129.9 77.91 142.1 85.63 146.4 98.41l17.74 66.92L223.1 200.3l-.0002-70.5L175.6 80.88C166.3 71.44 166.3 56.25 175.8 46.94C185.2 37.59 200.4 37.72 209.8 47.13l14.22 14.37L223.1 32c0-17.69 14.34-32 32.03-32s32.03 14.31 32.03 32l.0002 29.5l14.22-14.37c9.307-9.406 24.51-9.531 33.97-.1875c9.432 9.312 9.525 24.5 .1875 33.94l-48.38 48.88L288 200.3l59.87-34.93l17.74-66.92c3.395-12.78 16.56-20.5 29.38-17.03c12.82 3.375 20.47 16.53 17.08 29.34l-5.379 20.29l25.09-14.64c15.28-8.906 34.91-3.75 43.81 11.5c8.932 15.25 3.785 34.84-11.5 43.75l-25.96 15.15l20.33 5.508c12.81 3.469 20.37 16.66 16.89 29.44c-2.895 10.69-12.59 17.72-23.16 17.72c-2.08 0-4.193-.2813-6.305-.8438L379.1 220.7L319.5 256l60.46 35.28l65.95-17.87C458.8 270 471.9 277.5 475.4 290.3c3.473 12.78-4.082 25.97-16.89 29.44l-20.33 5.508l25.96 15.15C479.4 349.3 484.5 368.9 475.6 384.1z"/></svg>
								Trail Difficulty</h4> <?php
							} ?>
							<p><?php the_field('trail_difficulty') ?></p>
						</section>
						<?php
					}

				echo "</div>";

		// Tour Information General

		if (!is_shop()):

				if (get_field('inclusions')) {
					?>

					<section class="inclusions">
						<h3>Tour Includes:</h3>
						<ul>
						<?php
							if( have_rows('inclusions') ):
								while( have_rows('inclusions') ) : the_row(); ?>
								<li><?php the_sub_field('inclusion_item') ?></li>
								<?php endwhile;
							endif;
						?>
						</ul>
					</section>
						<?php
				}

				echo '</section>';

				echo '<section class="tour-map">';

				if (get_field('meeting_place_address')) {
					?>
					<section class="meeting-place-address">
						<h3>Meeting Place Address</h3>
						<p><?php the_field('meeting_place_address') ?></p>
					</section>
					<?php
				}

				$locationTour = get_field('meeting_place_map');
				if( $locationTour ): ?>
					<section class="acf-map" data-zoom="16">
						<div class="marker" data-lat="<?php echo esc_attr($locationTour['lat']); ?>"
						data-lng="<?php echo esc_attr($locationTour['lng']); ?>"></div>
					</section>
				<?php endif;

				?> 
				
				</section>

			</div>

		</div>

				<?php

		endif;
	}
}

// CTA

function riding_rapids_faq_cta() {
	echo '<section class="faq-cta-container">';
	echo get_template_part( 'template-parts/content', 'faq-cta' );
	echo '</section>';
}

// Heading

function riding_rapids_template_loop_product_title() {
	echo '<h3 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</h3>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

}

function riding_rapids_booking_heading() {
	echo '<h2 class="booking-heading">Book your adventure today!</h2>';
}

// Post Thumbnail

function riding_rapids_show_post_thumbnail() {
	if (has_post_thumbnail()) {
        riding_rapids_post_thumbnail();
    }
}

// Lunch Description

function riding_rapids_lunch_desc() {
	if (get_field('lunch_description')) {
		?>
		<section class="lunch-description">
			<?php the_field('lunch_description') ?>
		</section>
		<?php
	}
}

// Remove the featured image from the product gallery
// @link https://wordpress.org/support/topic/remove-featured-image-from-product-page-gallery/

add_filter('woocommerce_single_product_image_thumbnail_html', 'remove_featured_image', 10, 2);
function remove_featured_image($html, $attachment_id ) {
    global $post, $product;

    $featured_image = get_post_thumbnail_id( $post->ID );

    if ( $attachment_id == $featured_image )
        $html = '';

    return $html;
}