<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>
<header class="woocommerce-products-header">
    <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
    <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
    <?php endif; ?>

    <?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header><?php 

    
    ?>
<div class='post-thumbnail'><?php
    echo get_the_post_thumbnail(14, 'full');
    ?><img class='wave-img' src="<?php echo get_template_directory_uri() ?>/images/waves.png" alt="This a white wave">

</div>
<?php
    


if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );

    
    // Navigation
    ?>
<section class="tour-section">
    <section class="tour-selection">
        <h2 class="view-tours">View Tours:</h2>
        <nav class="nav-tour">
            <ul>
                <?php

                $taxonomy = 'product_cat';
                $terms = get_terms(
                    array(
                        'taxonomy' => 'product_cat',
                        )
                    );
                if ( $terms && ! is_wp_error($terms)){
                    foreach ($terms as $term) {
                        $args = array(
                            'post_type'      => 'product',
                            'posts_per_page' => -1,
                            'tax_query'		 => array(
                                array(
                                    'taxonomy' 	=> $taxonomy,
                                    'field'		=> 'slug',
                                    'terms'		=> $term->slug,
                                )
                            )
                        );
                        
                        $query = new WP_Query( $args );

                        if ( $query -> have_posts() ){
                
                            ?>

                <li>
                    <a href="#<?php echo $term->slug ?>">
                        <?php echo $term->name ?>
                    </a>
                </li>

                <?php
                        }
                    }
                }
            ?>
        </nav>
    </section>
    <?php

        // Products

        $taxonomy = 'product_cat';
        $terms = get_terms(
            array(
                'taxonomy' => 'product_cat',
                )
            );
        if ( $terms && ! is_wp_error($terms)){
            foreach ($terms as $term) {
                $args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => -1,
                    'order'          => 'ASC',
                    'orderby'        => 'id',
                    'tax_query'		 => array(
                        array(
                            'taxonomy' 	=> $taxonomy,
                            'field'		=> 'slug',
                            'terms'		=> $term->slug,
                        )
                    )
                );
                
                $query = new WP_Query( $args );

                if ( $query -> have_posts() ){

                ?> <section class="tour-package-season">

        <h2 id='<?php echo $term->slug ?>'>
            <?php 
                        if ($term->slug === 'summer') {
                            ?> Rafting Tours <?php
                        } else if ($term->slug === 'winter') {
                            ?> Snowshoeing Tours <?php
                        }
                ?>

        </h2>

        <?php

                    woocommerce_product_loop_start();

                    while ( $query -> have_posts() ) {
                        $query -> the_post();

                        do_action ('woocommerce_shop_loop');
                        wc_get_template_part( 'content', 'product' );

                    }
                    wp_reset_postdata();

                    woocommerce_product_loop_end();

                    echo '</section>';
                }

            }
        }

        /**
         * Hook: woocommerce_after_shop_loop.
         *
         * @hooked woocommerce_pagination - 10
         */
        do_action( 'woocommerce_after_shop_loop' );
        } else {
        /**
         * Hook: woocommerce_no_products_found.
         *
         * @hooked wc_no_products_found - 10
         */
        do_action( 'woocommerce_no_products_found' );
        }

    ?>
    </section>
    <?php

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );