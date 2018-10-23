<?php
/**
 * Template Name: Contact
 */

get_header();
$post = get_post();
the_post();
$title = $post->post_title;
require 'title.php';

?>
    <div id="app"></div>
<?php
do_shortcode( '[roofleess_contact_form]' );

get_footer();