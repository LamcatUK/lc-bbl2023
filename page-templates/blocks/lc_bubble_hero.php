<?php
$img = get_the_post_thumbnail_url(get_the_ID(), 'full');// ?? null;
?>
<section class="bubble-hero" style="background-image:url(<?=$img?>)">
    <div class="bubble-hero__bubbles"></div>
    <div class="bubble-hero__inner">
        <div class="container-xl d-flex justify-content-center align-items-center h-100">
            <?php
            if (get_field('title')) {
                echo '<h1 class="hero">' . get_field('title') . '</h1>';
            } else {
                ?>
            <img src="<?=get_stylesheet_directory_uri()?>/img/bubblelicious-logo.svg"
                alt="" width="223" height="213" data-aos="fade">
            <?php
            }
?>
        </div>
    </div>
    <!-- <div class="bubble-hero__mask"></div> -->
</section>
<?php
add_action('wp_footer', function () {
    ?>
<script>
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
</script>
<?php
});
?>