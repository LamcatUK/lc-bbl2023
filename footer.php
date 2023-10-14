<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
?>
<div id="footer-top"></div>
<footer class="footer bubble-top bubble-top--pink-400">
    <div class="container-xl">
        <div class="row">
            <div class="col-sm-6 col-lg-3 mb-2 order-1">
                <a href="<?=get_home_url()?>"><img
                        src="<?=get_stylesheet_directory_uri()?>/img/bubblelicious-logo--wo.svg"
                        alt="Bubblelicious Bars" class="logo img-fluid mb-4"></a>
            </div>
            <div class="col-sm-6 col-lg-3 mb-2 order-3 order-lg-2">
                <ul class="fa-ul">
                    <li><span class="fa-li"><i class="fa-solid fa-envelope"></i></span> <a
                            href="mailto:<?=get_field('contact_email', 'options')?>"><?=get_field('contact_email', 'options')?></a>
                    </li>
                    <li><span class="fa-li"><i class="fa-brands fa-facebook"></i></span> <a
                            href="<?=get_field('social', 'options')['facebook_url']?>"
                            target="_blank">@bubbleliciousbars</a>
                    </li>
                    <li><span class="fa-li"><i class="fa-brands fa-instagram"></i></span> <a
                            href="<?=get_field('social', 'options')['instagram_url']?>"
                            target="_blank">@bubblelicioussoaps</a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-6 col-lg-3 mb-2 order-4 order-lg-3">
                <?php wp_nav_menu(array('theme_location' => 'footer_menu1')); ?>
            </div>
            <div class="col-sm-6 col-lg-3 mb-2 order-2 order-lg-4">
                <?php wp_nav_menu(array('theme_location' => 'footer_menu2')); ?>
            </div>
        </div>
    </div>
    <div class="colophon">
        <div class="container-xl">
            <div>&copy; <?=date('Y')?>
                Bubblelicious Bars</div>
            <div>Site by <a href="https://www.lamcat.co.uk/" target="_blank">Lamcat</a></div>
        </div>
    </div>
</footer>
<?php wp_footer();
if (get_field('gtm_property', 'options')) {
    ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe
        src="https://www.googletagmanager.com/ns.html?id=<?=get_field('gtm_property', 'options')?>"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php
}
?>
</body>

</html>