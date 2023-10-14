<?php
/* Template Name: Service Sidebar */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

?>
<main id="main">
    <?php
    the_post();

$content = get_the_content();
$blocks = parse_blocks($content);
foreach ($blocks as $block) {
    if($block['blockName'] == 'acf/lc-hero') {
        echo render_block($block);
        break;
    }
}
?>
    <div class="container-xl">
        <div class="row g-4">
            <div class="col-lg-8 order-2 pt-5">
                <?php
            foreach ($blocks as $block) {
                if($block['blockName'] == 'acf/lc-hero') {
                    continue;
                }
                echo render_block($block);
            }
?>
            </div>
            <div class="col-lg-4 order-1 pt-5">
                <div class="sidebar">
                    <h3 class="has-primary-400-color">Our Courier Services</h3>
                    <ul>
                        <?php
                    $thispage = get_the_permalink(get_the_ID());
while (have_rows('services', 'options')) {
    the_row();
    $page = get_sub_field('service_page');
    $marker = $page == $thispage ? 'active' : '';
    echo '<li class="' . $marker . '"><a href="' . $page . '">' . get_sub_field('service_name') . '</a></li>';
}
?>
                    </ul>
                    <div class="sidebar_cta text-center">
                        <p class="text-white">If you have any questions about our services, please call us on
                            <?=do_shortcode(('[contact_phone]'))?>
                            or email
                            <?=do_shortcode('[contact_email]')?>.
                        </p>
                        <a href="/get-quote/" class="btn btn-secondary">Get a Quote</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();
?>