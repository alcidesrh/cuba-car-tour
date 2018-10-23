<?php

foreach ( $posts as $value ):
    $post = $value;
    the_post();
    $posttitle = get_the_title( $post->ID );
    if ( has_post_thumbnail() ) {
        $thumbnail = wp_get_attachment_image( get_post_thumbnail_id(), 'full', 0, array( 'class' => 'background-image' ) );
    }
    ?>
    <div class="container">
        <article class="post post-medium">
            <div class="row">
                <div class="col-lg-5">
                    <?php get_template_part( 'inc/content-format', get_post_format() ); ?>
                </div>
                <div class="col-lg-7">
                    <div class="post-content">
                        <?php get_template_part( 'inc/content', 'post-title' ); ?>
                        <?php the_content(); ?>

                    </div>
                </div>
            </div>
        </article>
        <hr class="my-5">
    </div>

<?php
endforeach;
get_footer();