<section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="d-inline title-text"><?php echo $title?></h3>
                <?php if(isset($category)):?>
                <a
                        href="<?php echo esc_url( add_query_arg( 'category', $category->slug, get_permalink( 367 ) ) ) ?>"
                        class="btn btn-sm btn-primary d-inline btn-title">Make a Customize Request</a>
                <?php endif;?>
            </div>
        </div>
    </div>
</section>