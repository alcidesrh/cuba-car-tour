<?php

get_header();
$post = get_post();
the_post();
$title = $post->post_title;
require 'title.php';

if ( has_post_thumbnail() ) {
    $thumbnail = wp_get_attachment_image( get_post_thumbnail_id(), 'full', 0, array( 'class' => 'background-image' ) );
}
$gallery = types_render_field( 'galeria' );
$includes = cptr_populate( $post->ID );
$price = types_render_field( 'precio' );

?>
<div class="container">
    <article class="post post-medium">
        <div class="row">
            <div class="col-sm-12">
                <div class="post-content tours">
                    <div class="img-thumbnail d-block">
                        <img src="<?php echo get_the_post_thumbnail_url()?>" class="max-height-400">
                    </div>
                    <div class="mt-3">
                        <?php get_template_part( 'inc/content', 'post-title' ); ?>
                        <?php get_template_part( 'inc/content', 'post-sharing' ); ?>
                        <?php if ( !empty( $price ) ): ?>
                            <h5>
                                From: <?php echo getPriceCuc( $price_sedan > $price_conv ? $price_conv : $price_sedan ) ?></h5>
                        <?php endif; ?>
                        <p> <?php echo types_render_field( 'descripcion-larga' ); ?></p>
                        <a
                                href="<?php echo esc_url( add_query_arg( 'id', $post->ID, get_permalink( getFormPageId( $post->ID ) ) ) ) ?>"
                                class="btn btn-sm btn-primary pull-right">Book Now</a>
                    </div>
                </div>
            </div>

        </div>
        <?php if ( isset( $route ) && $route ): ?>
            <div class="row mt-3">
                <div class="col-sm-12">
                    <h4 class="mb-25">Route:</h4>
                </div>
                <div class="col-sm-12"">
                    <div class="img-thumbnail d-block route-map">
                    <?php echo $route; ?>
                    </div>
                </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="row mt-3">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <?php if ( !empty( $includes ) ): ?>
                        <li role="presentation" class="active"><a href="#includes">Extra Acitvities</a></li>
                    <?php endif; ?>
                    <?php if ( !empty( $gallery ) ): ?>
                        <li role="presentation" <?php if ( empty( $includes ) ): ?>class="active"<?php endif;?>><a href="#gallery">Images Gallery</a></li>
                    <?php endif; ?>
                </ul>
                <div class="tab-content">
                    <?php if ( !empty( $includes ) ): ?>
                        <div id="includes" class="tab-pane fade in active pt-25">
                            <?php foreach ( $includes as $include ):
                                $post = $include;
                                setup_postdata( $post );
                                $price = types_render_field( 'precio' );
                                if ( has_post_thumbnail() ) {
                                    $thumbnail = wp_get_attachment_image( get_post_thumbnail_id(), 'thumbnail', 0, array( 'class' => 'background-image, pull-right' ) );
                                }
                                ?>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <?php get_template_part( 'inc/content-format', get_post_format() ); ?>
                                    </div>
                                    <div class="col-lg-8">
                                        <?php get_template_part( 'inc/content', 'post-title' ); ?>
                                        <?php if ( !empty( $price ) ): ?>
                                            <h5>Price: <?php echo getPriceCuc( $price ) ?></h5>
                                        <?php endif; ?>
                                        <?php the_content(); ?>
                                    </div>

                                </div>
                                <hr class="my-5">
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( !empty( $gallery ) ): ?>
                        <div id="gallery" class="tab-pane fade <?php if ( empty( $includes ) ): ?>active<?php endif;?> in pt-25">
                            <?php
                            echo do_shortcode( "[foogallery id='$gallery']" );
                            ?>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </article>
</div>
<script>
    jQuery('.nav-tabs a').click(function (e) {
        e.preventDefault()
        jQuery(this).tab('show')
    })
</script>
<?php
get_footer(); ?>
