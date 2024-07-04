<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

// require_once LC_THEME_DIR . '/inc/lc-noblog.php';
require_once LC_THEME_DIR . '/inc/lc-utility.php';
require_once LC_THEME_DIR . '/inc/lc-posttypes.php';
require_once LC_THEME_DIR . '/inc/lc-form.php';
require_once LC_THEME_DIR . '/inc/lc-blocks.php';

// Remove unwanted SVG filter injection WP
remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');



// Remove comment-reply.min.js from footer
function remove_comment_reply_header_hook()
{
    wp_deregister_script('comment-reply');
}
add_action('init', 'remove_comment_reply_header_hook');

add_action('admin_menu', 'remove_comments_menu');
function remove_comments_menu()
{
    remove_menu_page('edit-comments.php');
}

add_filter('theme_page_templates', 'child_theme_remove_page_template');
function child_theme_remove_page_template($page_templates)
{
    // unset($page_templates['page-templates/blank.php'],$page_templates['page-templates/empty.php'], $page_templates['page-templates/fullwidthpage.php'], $page_templates['page-templates/left-sidebarpage.php'], $page_templates['page-templates/right-sidebarpage.php'], $page_templates['page-templates/both-sidebarspage.php']);
    unset($page_templates['page-templates/blank.php'],$page_templates['page-templates/empty.php'], $page_templates['page-templates/left-sidebarpage.php'], $page_templates['page-templates/right-sidebarpage.php'], $page_templates['page-templates/both-sidebarspage.php']);
    return $page_templates;
}
add_action('after_setup_theme', 'remove_understrap_post_formats', 11);
function remove_understrap_post_formats()
{
    remove_theme_support('post-formats', array( 'aside', 'image', 'video' , 'quote' , 'link' ));
}

if (function_exists('acf_add_options_page')) {
    acf_add_options_page(
        array(
            'page_title' 	=> 'Site-Wide Settings',
            'menu_title'	=> 'Site-Wide Settings',
            'menu_slug' 	=> 'theme-general-settings',
            'capability'	=> 'edit_posts',
        )
    );
}

function widgets_init()
{
    // register_sidebar(
    //     array(
    //         'name'          => __('Footer Col 1', 'lc-bbl2023'),
    //         'id'            => 'footer-1',
    //         'description'   => __('Footer Col 1', 'lc-bbl2023'),
    //         'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
    //         'after_widget'  => '</div>',
    //     )
    // );

    register_nav_menus(array(
        'primary_nav' => __('Primary Nav', 'lc-bbl2023'),
        'footer_menu1' => __('Footer Menu 1', 'lc-bbl2023'),
        'footer_menu2' => __('Footer Menu 2', 'lc-bbl2023'),
    ));


    unregister_sidebar('hero');
    unregister_sidebar('herocanvas');
    unregister_sidebar('statichero');
    unregister_sidebar('left-sidebar');
    unregister_sidebar('right-sidebar');
    unregister_sidebar('footerfull');
    unregister_nav_menu('primary');

    add_theme_support('disable-custom-colors');
    add_theme_support(
        'editor-color-palette',
        array(
            array(
                'name'  => 'Pink 900',
                'slug'  => 'pink-900',
                'color' => '#991651',
            ),
            array(
                'name'  => 'Pink 400',
                'slug'  => 'pink-400',
                'color' => '#e61873',
            ),
            array(
                'name'  => 'Pink 200',
                'slug'  => 'pink-200',
                'color' => '#eb609e',
            ),
            array(
                'name'  => 'Aqua 400',
                'slug'  => 'aqua-400',
                'color' => '#65c3ce',
            ),
            array(
                'name'  => 'Aqua 200',
                'slug'  => 'aqua-200',
                'color' => '#f4fbfc',
            ),
            array(
                'name'  => 'Yellow 400',
                'slug'  => 'yellow-400',
                'color' => '#f9b51f',
            ),
            array(
                'name'  => 'Blue 400',
                'slug'  => 'blue-400',
                'color' => '#009ee2',
            ),
        )
    );
}
add_action('widgets_init', 'widgets_init', 11);


remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');

//Custom Dashboard Widget
add_action('wp_dashboard_setup', 'register_lc_dashboard_widget');
function register_lc_dashboard_widget()
{
    wp_add_dashboard_widget(
        'lc_dashboard_widget',
        'Lamcat',
        'lc_dashboard_widget_display'
    );
}

function lc_dashboard_widget_display()
{
    ?>
<div style="display: flex; align-items: center; justify-content: space-around;">
    <img style="width: 50%;"
        src="<?= get_stylesheet_directory_uri().'/img/lc-full.jpg'; ?>">
    <a class="button button-primary" target="_blank" rel="noopener nofollow noreferrer"
        href="mailto:hello@lamcat.co.uk">Contact</a>
</div>
<div>
    <p><strong>Thanks for choosing Lamcat!</strong></p>
    <hr>
    <p>Got a problem with your site, or want to make some changes & need us to take a look for you?</p>
    <p>Use the link above to get in touch and we'll get back to you ASAP.</p>
</div>
<?php
}


// add_filter('wpseo_breadcrumb_links', function( $links ) {
//     global $post;
//     if ( is_singular( 'post' ) ) {
//         $t = get_the_category($post->ID);
//         $breadcrumb[] = array(
//             'url' => '/guides/',
//             'text' => 'Guides',
//         );

//         array_splice( $links, 1, -2, $breadcrumb );
//     }
//     return $links;
// }
// );

// remove discussion metabox
function cc_gutenberg_register_files()
{
    // script file
    wp_register_script(
        'cc-block-script',
        get_stylesheet_directory_uri() .'/js/block-script.js', // adjust the path to the JS file
        array( 'wp-blocks', 'wp-edit-post' )
    );
    // register block editor script
    register_block_type('cc/ma-block-files', array(
        'editor_script' => 'cc-block-script'
    ));
}
add_action('init', 'cc_gutenberg_register_files');

function understrap_all_excerpts_get_more_link($post_excerpt)
{
    if (is_admin() || ! get_the_ID()) {
        return $post_excerpt;
    }
    return $post_excerpt;
}

//* Remove Yoast SEO breadcrumbs from Revelanssi's search results
add_filter('the_content', 'wpdocs_remove_shortcode_from_index');
function wpdocs_remove_shortcode_from_index($content)
{
    if (is_search()) {
        $content = strip_shortcodes($content);
    }
    return $content;
}

// disable product hover zoom as it has conflicts with the webp/cdn stuff
remove_theme_support( 'wc-product-gallery-zoom' );


// GF really is pants.
/**
 * Change submit from input to button
 *
 * Do not use example provided by Gravity Forms as it strips out the button attributes including onClick
 */
function wd_gf_update_submit_button($button_input, $form)
{
    //save attribute string to $button_match[1]
    preg_match("/<input([^\/>]*)(\s\/)*>/", $button_input, $button_match);

    //remove value attribute (since we aren't using an input)
    $button_atts = str_replace("value='" . $form['button']['text'] . "' ", "", $button_match[1]);

    // create the button element with the button text inside the button element instead of set as the value
    return '<button ' . $button_atts . '><span>' . $form['button']['text'] . '</span></button>';
}
add_filter('gform_submit_button', 'wd_gf_update_submit_button', 10, 2);


function lc_theme_enqueue()
{
    $the_theme = wp_get_theme();
    
    // wp_enqueue_style('lightbox-stylesheet', get_stylesheet_directory_uri() . '/css/lightbox.min.css', array(), $the_theme->get('Version'));
    wp_enqueue_style('slick-stylesheet', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css', array(), $the_theme->get('Version'));
    wp_enqueue_style('slick-stylesheet', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css', array(), $the_theme->get('Version'));
    // wp_enqueue_script('lightbox-scripts', get_stylesheet_directory_uri() . '/js/lightbox-plus-jquery.min.js', array(), $the_theme->get('Version'), true);
    // wp_enqueue_script('lightbox-scripts', get_stylesheet_directory_uri() . '/js/lightbox.min.js', array(), $the_theme->get('Version'), true);
    // wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js', array(), null, true);
    wp_enqueue_script('slick-scripts', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), '1.8.1', true);
    wp_enqueue_style('aos-style', "https://unpkg.com/aos@2.3.1/dist/aos.css", array());
    wp_enqueue_script('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array(), null, true);
    wp_enqueue_script('parallax', get_stylesheet_directory_uri() . '/js/parallax.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'lc_theme_enqueue');

/* shop stuff */

/* wrap product image to allow hover zoom */
add_action('woocommerce_before_shop_loop_item_title', function () {
    echo '<div class="imagewrapper">';
}, 9);
add_action('woocommerce_before_shop_loop_item_title', function () {
    echo '</div>';
}, 11);

/* wrap related items to allow container */


add_action('woocommerce_before_single_product_summary', function () {
    echo '<div class="container-xl">';
}, 9);
add_action('woocommerce_after_single_product_summary', function () {
    echo '</div>';
}, 11);

/* remove add to cart button from product archive */
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

/* increase products per page */
add_filter('loop_shop_per_page', function ($cols) {
    // $cols contains the current number of products per page based on the value stored on Options –> Reading
    // Return the number of products you wanna show per page.
    $cols = 30;
    return $cols;
}, 20);

/* change backorder text */
/* sinlge product */
add_filter('woocommerce_get_availability_text', 'filter_product_availability_text', 10, 2);
function filter_product_availability_text($availability_text, $product)
{
    // Check if product status is on backorder
    if ($product->get_stock_status() === 'onbackorder') {
        $availability_text = __('Made to order', 'lc-bbl2023');
    }
    if($product->backorders_require_notification()) {
        $availability_text = str_replace('(can be backordered)', '', $availability_text);
    }
    return $availability_text;
}
/* cart */
// function backorder_text($availability)
// {
//     $altmessage = '<p class="backorder_notification backorder_notification_custom">Please allow 14 days for delivery of this item</p>';
//     foreach($availability as $i) {
//         $availability = str_replace('Available on backorder', $altmessage, $availability);
//     }
//     return $availability;
// }
// add_filter('woocommerce_get_availability', 'backorder_text');

// function woocommerce_custom_cart_item_name($_product_title, $cart_item, $cart_item_key)
// {
//     $altmessage = '<p class="backorder_notification backorder_notification_custom">Please allow 14 days for delivery of this item</p>';
//     if ($cart_item['data']->backorders_require_notification() && $cart_item['data']->is_on_backorder($cart_item['quantity'])) {
//         $_product_title .=  __(' - '. $altmessage, 'woocommerce') ;
//     }
//     return $_product_title;
// }
// add_filter('woocommerce_cart_item_name', 'woocommerce_custom_cart_item_name', 10, 3);

function custom_cart_item_backorder_notification($html, $product_id)
{
    $html = '<p class="backorder_notification">' . esc_html__('Made to order. Please allow 7-10 days for delivery.', 'lc-bbl2023') . '</p>';
    return $html;
}
add_filter('woocommerce_cart_item_backorder_notification', 'custom_cart_item_backorder_notification', 10, 2);



/* deyankify basket */
add_filter('gettext', 'change_cart_totals_text', 20, 3);
function change_cart_totals_text($translated, $text, $domain)
{
    if(is_cart() && $translated == 'Cart totals') {
        $translated = __('Basket Total', 'woocommerce');
    }
    return $translated;
}

// black thumbnails - fix alpha channel
/**
 * Patch to prevent black PDF backgrounds.
 *
 * https://core.trac.wordpress.org/ticket/45982
 */
// require_once ABSPATH . 'wp-includes/class-wp-image-editor.php';
// require_once ABSPATH . 'wp-includes/class-wp-image-editor-imagick.php';

// // phpcs:ignore PSR1.Classes.ClassDeclaration.MissingNamespace
// final class ExtendedWpImageEditorImagick extends WP_Image_Editor_Imagick
// {
//     /**
//      * Add properties to the image produced by Ghostscript to prevent black PDF backgrounds.
//      *
//      * @return true|WP_error
//      */
//     // phpcs:ignore PSR1.Methods.CamelCapsMethodName.NotCamelCaps
//     protected function pdf_load_source()
//     {
//         $loaded = parent::pdf_load_source();

//         try {
//             $this->image->setImageAlphaChannel(Imagick::ALPHACHANNEL_REMOVE);
//             $this->image->setBackgroundColor('#ffffff');
//         } catch (Exception $exception) {
//             error_log($exception->getMessage());
//         }

//         return $loaded;
//     }
// }

// /**
//  * Filters the list of image editing library classes to prevent black PDF backgrounds.
//  *
//  * @param array $editors
//  * @return array
//  */
// add_filter('wp_image_editors', function (array $editors): array {
//     array_unshift($editors, ExtendedWpImageEditorImagick::class);

//     return $editors;
// });?>