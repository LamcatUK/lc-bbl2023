<?php
// $bubbles = get_field('bubbles');
$bubbles = true;
$background = $block['backgroundColor'] ?? 'white';

if ($bubbles) {
    $background = 'bubble-top bubble-top--' . $background;
}
?>
<section class="<?=$background?>" data-aos="fade-up">
    <div class="container-xl">
        <div class="row g-5">
            <div class="col-lg-6">
                <?=get_field('content_left')?>
            </div>
            <div class="col-lg-6">
                <?=get_field('content_right')?>
            </div>
        </div>
    </div>
</section>