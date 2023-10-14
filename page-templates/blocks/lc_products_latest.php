<?php

$bg = 'white';

if (! empty($block['backgroundColor'])) {
    $bg = $block['backgroundColor'];
}

$products = get_field('products');

$p = new WP_Query(
    array(
        'post_type' => 'product',
        'posts_per_page' => 6,
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => array('soap')
            )
        )
    )
);

if ($p->have_posts()) {
    //bubble-top bubble-top--aqua
    ?>
<section class="bubble-top bubble-top--<?=$bg?> products-latest"
    data-aos="fade-up">
    <div class="container-xl">
        <h2 class="text-center mb-2">Latest Arrivals</h2>
        <div class="products-latest__grid mb-2" data-aos="fade">
            <?php
            $flop = 'odd';
    while ($p->have_posts()) {
        $p->the_post();
        ?>
            <div>
                <a href="<?=get_the_permalink()?>" class="
                products-latest__product <?=$flop?>">
                    <img src="<?=get_the_post_thumbnail_url(get_the_ID(), 'medium')?>"
                        alt="">
                    <h3><?=get_the_title()?></h3>
                </a>
            </div>
            <?php
        $flop = $flop == 'odd' ? 'even' : 'odd';
    }
    ?>
        </div>
        <a href="/shop/" class="bubble pop mx-auto">
            <div class="bubble--bubble"></div>
            <div class="bubble--inner">Shop Now</div>
        </a>
    </div>
</section>
<?php
}

add_action('wp_footer', function () {
    ?>
<script>
    (function($) {
        $('.products-latest__grid').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            arrows: false,
            dots: false,
            responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        autoplay: true
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        autoplay: true
                    }
                }
            ]
        });
    })(jQuery);
</script>

<?php
}, 9999);
?>