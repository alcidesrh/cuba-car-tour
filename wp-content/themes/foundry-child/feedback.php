<?php
/**
 * Template Name: Feedback
 */

get_header();
$post = get_post();
the_post();
$title = $post->post_title;
require 'title.php';

?>
    <div id="app"></div>
<?php

do_shortcode( '[roofleess_feedback]' );
get_footer();