<?php

foreach ( $posts as $value ):
    $post = $value;
    the_post();
    $posttitle = get_the_title( $post->ID );
    if ( has_post_thumbnail() ) {
        $thumbnail = wp_get_attachment_image( get_post_thumbnail_id(), 'full', 0, array( 'class' => 'background-image' ) );
    }
    $duration = types_render_field( 'duracion' );
    $price_sedan = types_render_field( 'precio-por-sedan' );
    $price_conv = types_render_field( 'precio-por-convertible' );
    ?>
    <div class="container">
        <article class="post post-medium">
            <div class="row">
                <div class="col-lg-3">
                    <?php get_template_part( 'inc/content-format', get_post_format() ); ?>
                </div>
                <div class="col-lg-6">
                    <div class="post-content">
                        <?php get_template_part( 'inc/content', 'post-title' ); ?>
                        <p> <?php echo types_render_field( 'descripcion-corta' ); ?></p>

                    </div>
                </div>
                <div class="col-lg-3">
                    <?php if ( !empty( $duration ) ): ?>
                        <h5>Duration: <?php echo $duration ?> hours</h5>
                    <?php endif; ?>
                    <?php if ( !empty( $price_sedan || $price_conv ) ): ?>
                        <h5>From: <?php echo getPriceCuc( $price_sedan > $price_conv ? $price_conv : $price_sedan  ) ?></h5>
                    <?php endif; ?>

                    <div class="row mt-1">
                        <div class="col-xs-6 center"><a href="<?php echo esc_url( get_permalink() ) ?>"
                                                 class="btn btn-sm btn-primary">Detail</a></div>
                        <div class="col-xs-6 center"><a
                                    href="<?php echo esc_url( add_query_arg( 'id', $post->ID, get_permalink( getFormPageId($post->ID)) ) )?>"
                                    class="btn btn-sm btn-primary">Book Now</a></div>
                    </div>
                </div>

            </div>
        </article>
        <hr class="my-5">
    </div>

<?php
endforeach;
get_footer();