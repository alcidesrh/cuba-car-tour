<?php
/**
 * Template Name: Reserve Transfer
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
    do_shortcode( '[roofleess_reserve_form_transfer id="'.$_GET['id'].'"]' );
if ( isset( $_GET[ 'transfer' ] ) )
    do_shortcode( '[roofleess_reserve_form_transfer customize=true]' );
else
    do_shortcode( '[roofleess_reserve_form_transfer]' );
get_footer();