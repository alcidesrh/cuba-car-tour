<?php
/*
 * Template Name: Car Template
 * Template Post Type: post, page, product
 */

get_header();
$post = get_post();
the_post();
?>
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3><?php echo get_the_title( $post->ID )?></h3>
                </div>
            </div>
        </div>
    </section>
<?php
if ( has_post_thumbnail() ) {
    $thumbnail = wp_get_attachment_image( get_post_thumbnail_id(), 'full', 0, array( 'class' => 'background-image' ) );
}
$prices = CFS()->find_fields( array( 'group_id' => 200 ) );
$gallery = CFS()->get('galeria');
?>
    <div class="container">
        <article class="post post-medium">
            <div class="row">
                <div class="col-lg-4">
                    <?php get_template_part( 'inc/content-format', get_post_format() ); ?>
                </div>
                <div class="col-lg-5">
                    <div class="post-content">
                        <?php get_template_part( 'inc/content', 'post-title' ); ?>
                        <?php the_content(); ?>

                    </div>
                </div>
                <div class="col-lg-3">
                    <?php if(!empty($prices)):?>
                        <h4>Price</h4>
                        <?php foreach ($prices as $price):?>
                            <h5><?php echo $price['value'] ?> <span
                                    class="small"><?php echo $price[ 'label' ] ?></span></h5>
                        <?php endforeach;endif;?>

                    <div class="row mt-3">
                        <div class="col-lg-6"><a
                                href="/reserve-your-classic-car-and-tour-havana-cuba/?departure=Havana&amp;car_type=Convertible (cabriolet)&amp;tour=Havana City Tour 2 hours in convertible"
                                class="btn btn-sm btn-primary">Book Now</a></div>
                    </div>
                </div>

            </div>
            <?php if($gallery):?>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if ( function_exists( 'envira_gallery' ) ) { envira_gallery( $gallery ); }
                    ?>
                </div>
            </div>
            <?php endif;?>
        </article>
    </div>
<?php
get_footer();