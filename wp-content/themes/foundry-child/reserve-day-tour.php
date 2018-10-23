<?php
/**
 * Template Name: Reserve Day Tour
 */

get_header();
$post = get_post();
the_post();
$title = $post->post_title;
require 'title.php';

?>
    <div id="app"></div>
<?php
if ( isset( $_GET[ 'id' ] ) )
    do_shortcode( '[roofleess_reserve_form_day_tour id="'.$_GET['id'].'"]' );
else
    do_shortcode( '[roofleess_reserve_form_day_tour]' );
get_footer();