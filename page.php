<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

?>
<main id="main" class="page">
    <?php
    the_post();
the_content();
?>
</main>
<?php
get_footer();
?>