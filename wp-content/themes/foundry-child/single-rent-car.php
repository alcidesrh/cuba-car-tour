<?php

get_header();
$post = get_post();
the_post();
$title = $post->post_title;
$category = new stdClass();
$category->slug = 'rent-car';
require 'title.php';

?>
    <div class="container">
        <article class="post post-medium">
            <div class="row">
                <div class="col-sm-12 col-md-offset-2 col-md-8" >
                    <div class="post-content">
                        <?php get_template_part( 'inc/content', 'post-sharing' ); ?>
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </article>
    </div>
 <div id="app"></div>
<?php
    do_shortcode( '[roofleess_rent_car]' );
get_footer();