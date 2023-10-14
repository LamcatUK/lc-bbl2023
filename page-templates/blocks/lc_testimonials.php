<?php
// $bubbles = get_field('bubbles');
$bubbles = true;
$background = $block['backgroundColor'] ?? 'white';

if ($bubbles) {
    $background = 'bubble-top bubble-top--' . $background;
}

$q = new WP_Query(array(
    'post_type' => 'testimonials',
    'posts_per_page' => -1,
    'orderby'        => 'rand',
));
if ($q->have_posts()) {
    ?>
<section class="testimonials <?=$background?>" data-aos="fade-up">
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
<?php

add_action('wp_footer', function () {
    ?>
<script>
    (function($) {
        $('.testimonials__grid').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 4000,
            arrows: false,
            dots: false,
        });
    })(jQuery);
</script>

<?php
}, 9999);

}
?>