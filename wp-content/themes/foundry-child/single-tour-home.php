<?php

if ( has_post_thumbnail() ) {
    $thumbnail = wp_get_attachment_image( get_post_thumbnail_id(), 'full', 0, array( 'class' => 'background-image' ) );
}

if ( function_exists( 'types_render_field' ) ) {
    $price_sedan = types_render_field( 'precio-por-sedan' );
    $price_conv = types_render_field( 'precio-por-convertible' );
}
global $post;
?>
<div class="col-md-4" style="text-align: left">
    <div class="row">
        <div class="col-sm-12">
            <?php get_template_part( 'inc/content-format', get_post_format() ); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="post-content">
                <?php get_template_part( 'inc/content', 'post-title' ); ?>
                <?php get_template_part( 'inc/content', 'post-sharing' ); ?>
                <?php if ( !empty( $price_sedan || $price_conv ) ): ?>
                    <h5>From: <?php echo getPriceCuc( $price_sedan > $price_conv ? $price_conv : $price_sedan ) ?></h5>
                <?php endif; ?>
                <div class="mt-1">
                    <p>
                        <?php echo wp_trim_words( $post->post_content, 50, true ); ?>
                    </p>
                </div>
            </div>
            <!--            <a-->
            <!--                    href="-->
            <?php //echo esc_url( add_query_arg( 'id', $post->ID, get_permalink( getFormPageId( $post->ID ) ) ) ) ?><!--"-->
            <!--                    class="btn btn-sm btn-primary pull-right">Reserve</a>-->
        </div>
    </div>
</div>
