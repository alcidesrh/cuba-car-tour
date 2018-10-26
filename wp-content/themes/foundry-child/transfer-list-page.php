<?php

foreach ( $posts as $value ):
    $post = $value;
    the_post();
    $posttitle = get_the_title( $post->ID );
    if ( has_post_thumbnail() ) {
        $thumbnail = wp_get_attachment_image( get_post_thumbnail_id(), 'full', 0, array( 'class' => 'background-image' ) );
    }
    $price_sedan = types_render_field( 'precio-por-sedan' );
    $price_convertible = types_render_field( 'precio-por-convertible' );
    ?>
    <div class="container">
        <article class="post post-medium">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-2">
                    <div class="post-content">
                        <?php get_template_part( 'inc/content', 'post-title' ); ?>
                        <?php if ( !empty( $price_sedan ) ): ?>
                            <h5>Sedan price: <?php echo getPriceCuc( $price_sedan ) ?></h5>
                        <?php endif; ?>
                        <?php if ( !empty( $price_convertible ) ): ?>
                            <h5>Convertible price: <?php echo getPriceCuc( $price_convertible ) ?></h5>
                        <?php endif; ?>
                        <?php the_content(); ?>

                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="row mt-1">
                        <div class="col-xs-12 col-md-6 center">
                            <a href="<?php echo esc_url( add_query_arg( 'id', $post->ID, get_permalink( getFormPageId( $post->ID ) ) ) ) ?>"
                                    class="btn btn-sm btn-primary">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </article>
        <hr class="my-5">
    </div>

<?php
endforeach;
get_footer();