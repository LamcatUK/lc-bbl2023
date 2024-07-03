<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();

$pp = get_option('page_for_posts');
$img = get_the_post_thumbnail_url($pp, 'full');// ?? null;

?>
<main id="main" class="pb-5">
<section class="bubble-hero" style="background-image:url(<?=$img?>)">
    <div class="bubble-hero__bubbles"></div>
    <div class="bubble-hero__inner">
        <div class="container-xl d-flex justify-content-center align-items-center h-100">
            <h1 class="hero">Bubblelicious Blog</h1>
        </div>
    </div>
    <!-- <div class="bubble-hero__mask"></div> -->
</section>
    <div class="container-xl py-5 mb-5">
        <?php
        /* Hide filters for now.
$cats = get_categories(array('exclude' => array(32)));
?>
        <div class="filters mb-4">
            <?php
echo '<button class="button button-outline-primary button--sm active me-2 mb-2" data-filter="*">All</button>';
foreach ($cats as $cat) {
    echo '<button class="button button-outline-primary button--sm me-2 mb-2" data-filter=".' . acf_slugify($cat->name) . '">' . $cat->cat_name . '</button>';
}
?>
        </div>
        <?php
        */
        ?>
        <div class="grid">
            <?php
    while (have_posts()) {
        the_post();
        $img = get_the_post_thumbnail_url(get_the_ID(), 'large');
        if (!$img) {
            $img = get_stylesheet_directory_uri() . '/img/default-blog.jpg';
        }
        $cats = get_the_category();
        $category = wp_list_pluck($cats, 'name');
        $flashcat = acf_slugify($category[0]);
        $catclass = implode(' ', array_map('acf_slugify', $category));
        $category = implode(', ', $category);

        $the_date = get_the_date('jS F, Y');

        ?>
            <a class="grid__card <?=$catclass?>"
                href="<?=get_the_permalink(get_the_ID())?>">
                <div class="card card--<?=$flashcat?>">
                    <div class="card__image_container">
                        <!-- <div
                            class="card__flash card__flash--<?=$flashcat?>">
                            <?=$category?>
                        </div> -->
                        <?=get_the_post_thumbnail(get_the_ID(), 'large', array('class' => 'card__image'))?>
                    </div>
                    <div class="card__inner">
                        <h3 class="card__title mb-0">
                            <?=get_the_title()?>
                        </h3>
                        <div class="card__date"><?=$the_date?>
                        </div>
                        <div class="card__content">
                            <div class="card__content__overlay"></div>
                            <?=wp_trim_words(get_the_content(get_the_ID()), 20)?>
                        </div>
                    </div>
                </div>
            </a>
            <?php
    }
?>
        </div>
    </div>
</main>
<?php
add_action('wp_footer', function () {
    ?>
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        var grid = document.querySelector('.grid');
        var iso = new Isotope(grid, {
            itemSelector: '.grid__card',
            percentPosition: true,
            layoutMode: 'fitRows',
            fitRows: {
                equalheight: true
            }
        });

        var filterButtons = document.querySelectorAll('.filters button');
        filterButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var filterValue = this.getAttribute('data-filter');
                iso.arrange({
                    filter: filterValue
                });
                filterButtons.forEach(function(btn) {
                    btn.classList.remove('active');
                });
                this.classList.add('active');
            });
        });

    });

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
}, 9999);

get_footer();
?>