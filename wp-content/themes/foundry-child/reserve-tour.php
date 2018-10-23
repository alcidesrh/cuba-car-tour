<?php
/**
 * Template Name: Reserve Havana Tour
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
    do_shortcode( '[roofleess_reserve_form id="'.$_GET['id'].'"]' );
else
    do_shortcode( '[roofleess_reserve_form]' );
get_footer();