<?php
// $bubbles = get_field('bubbles');
$bubbles = true;
$background = $block['backgroundColor'] ?? 'white';

if ($bubbles) {
    $background = 'bubble-top bubble-top--' . $background;
}

$splitText = 'col-lg-6';
$splitImage = 'col-lg-6';

if (get_field('split') == '6040') {
    $splitText = 'col-lg-8';
    $splitImage = 'col-lg-4';
}
if (get_field('split') == '7030') {
    $splitText = 'col-lg-10';
    $splitImage = 'col-lg-2';
}

$orderText = 'order-2 order-lg-1';
$orderImage = 'order-1 order-lg-2 text_image__img-right';

if (get_field('order') == 'image-text') {
    $orderText = 'order-2 order-lg-2';
    $orderImage = 'order-1 order-lg-1 text_image__img-left';
}
?>
<section class="text-image <?=$background?>" data-aos="fade-up">
    <div class="container-xl">
        <?php
if (get_field('title')) {
    ?>
        <div class="d-lg-none mb-4 text-center">
            <h2><?=get_field('title')?></h2>
        </div>
        <?php
}
?>
        <div class="row align-items-center g-5">
            <div
                class="<?=$splitText?> <?=$orderText?>">
                <?php
if (get_field('title')) {
    ?>
                <h2 class="d-none d-lg-block mb-4 text-center">
                    <?=get_field('title')?>
                </h2>
                <?php
}
?>
                <?=get_field('content')?>
                <?php
                if (get_field('link')) {
                    $link = get_field('link');
                    ?>
                <a href="<?=$link['url']?>"
                    class="bubble pop mx-auto"><span class="bubble--bubble"></span><span
                        class="bubble--inner"><?=$link['title']?></span></a>
                <!-- a href="<?=$link['url']?>"
                class="btn-bbl mx-auto
                mt-5"><?=$link['title']?></a -->
                <?php
                }
?>
            </div>
            <div
                class="<?=$splitImage?> <?=$orderImage?> text-center">
                <div class="text_image__container">
                    <?=wp_get_attachment_image(get_field('image'), 'large', null, array('class' => 'text_image__image'))?>
                </div>
            </div>
        </div>
    </div>
</section>