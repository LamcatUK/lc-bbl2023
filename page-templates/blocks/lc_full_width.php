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
        <?=get_field('content')?>
    </div>
</section>