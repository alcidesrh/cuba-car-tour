<?php
/**
 * Template Name: Rent Car
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
    do_shortcode( '[roofleess_rent_car id="'.$_GET['id'].'"]' );
else
    do_shortcode( '[roofleess_rent_car]' );
get_footer();