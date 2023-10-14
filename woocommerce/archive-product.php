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

defined('ABSPATH') || exit;

get_header('shop');
// get_header();

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
// do_action('woocommerce_before_main_content');

$shop = get_page_by_path('shop');
$img = get_the_post_thumbnail_url($shop->ID, 'full');// ?? null;
// $img = null;
?>
<main id="main" class="page">
    <section class="bubble-hero"
        style="background-image:url(<?=$img?>)">
        <div class="bubble-hero__bubbles"></div>
        <div class="bubble-hero__inner">
            <div class="container-xl d-flex justify-content-center align-items-center h-100">
                <h1 class="hero">Bubblelicious Shop</h1>
            </div>
        </div>
        <div class="bubble-hero__mask"></div>
    </section>
    <?php
$blocks = parse_blocks(get_the_content(null, false, get_option('woocommerce_shop_page_id')));
foreach ($blocks as $block) {
    echo apply_filters('the_content', render_block($block));
}
?>
    <section class="bubble-top bubble-top--pink-200">
        <div class="container-xl py-5 archive-product">
            <?php

// $q = new WP_Query(array(
//     'post_type' => 'product',
//     'posts_per_page' => -1,
//     'tax_query' => array(
//         array(
//             'taxonomy' => 'product_cat',
//             'field' => 'slug',
//             'terms' => array('soap')
//         )
//     )
// ));

// if ($q->have_posts()) {
//     // do_action('woocommerce_before_shop_loop');
//     woocommerce_product_loop_start();

//     while ($q->have_posts()) {
//         $q->the_post();
//         wc_get_template_part('content', 'product');
//     }

//     woocommerce_product_loop_end();
//     // do_action('woocommerce_after_shop_loop');
// }


// echo '<hr>';

if (woocommerce_product_loop()) {

    /**
     * Hook: woocommerce_before_shop_loop.
     *
     * @hooked woocommerce_output_all_notices - 10
     * @hooked woocommerce_result_count - 20
     * @hooked woocommerce_catalog_ordering - 30
     */
    do_action('woocommerce_before_shop_loop');

    woocommerce_product_loop_start();

    if (wc_get_loop_prop('total')) {

        while (have_posts()) {
            the_post();

            /**
             * Hook: woocommerce_shop_loop.
             */
            do_action('woocommerce_shop_loop');

            wc_get_template_part('content', 'product');
        }
    }

    woocommerce_product_loop_end();

    /**
     * Hook: woocommerce_after_shop_loop.
     *
     * @hooked woocommerce_pagination - 10
     */
    do_action('woocommerce_after_shop_loop');
} else {
    /**
     * Hook: woocommerce_no_products_found.
     *
     * @hooked wc_no_products_found - 10
     */
    do_action('woocommerce_no_products_found');
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
// do_action('woocommerce_after_main_content');

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
// do_action('woocommerce_sidebar');
?>
        </div>
    </section>
    <?php
$q = new WP_Query(array(
    'post_type' => 'testimonials',
    'posts_per_page' => -1,
));
if ($q->have_posts()) {
    ?>
    <section class="testimonials bubble-top bubble-top--white" data-aos="fade-up">
        <div class="container-xl">
            <h2 class="text-center mb-5">What Our Customers Say...</h2>
            <div class="testimonials__grid">
                <?php
            while ($q->have_posts()) {
                $q->the_post();
                ?>
                <div class="testimonials__card">
                    <div class="testimonials__inner">
                        <div class="testimonials__content">
                            <?=get_the_content()?>
                        </div>
                        <div class="text-end fw-bold">
                            <?=get_the_title()?>
                        </div>
                    </div>
                </div>
                <?php
            }
    ?>
            </div>
        </div>
    </section>
</main>
<?php
}
add_action('wp_footer', function () {
    ?>
<script>
    (function($) {
        function createBubble() {
            const section = document.querySelector('.bubble-hero__bubbles');
            const createElement = document.createElement('span');
            var size = Math.random() * 60;

            createElement.style.width = 20 + size + 'px';
            createElement.style.height = 20 + size + 'px';
            createElement.style.left = Math.random() * innerWidth + 'px';
            // createElement.style.opacity = Math.random();
            section.appendChild(createElement);

            setTimeout(() => {
                createElement.remove();
            }, 4000);
        }

        setInterval(createBubble, 50);

        $('.testimonials__grid').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            arrows: false,
            dots: false,
        });
    })(jQuery);
</script>
<?php
}, 9999);

get_footer('shop');
?>