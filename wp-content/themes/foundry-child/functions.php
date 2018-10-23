<?php
require 'ajax-callbacks.php';
function getPriceCuc($price){
    echo "$price cuc";
}

function getFormPageId($post = null){
    if($post){
        if( $cat = get_the_category($post)){
            $cat = $cat[0];
            switch ($cat->slug){
                case 'havana-tours':return 224;
                case 'day-tours':return 226;
                case 'transfers':return 230;
                case 'rent-car':return 238;
            }
        }
    }
return 224;
}

function be_dps_template_part( $output, $original_atts ) {
    ob_start();
    get_template_part( 'single-tour-home' );
    $new_output = ob_get_clean();
    if( !empty( $new_output ) )
        $output = $new_output;
    return $output;
}
add_action( 'display_posts_shortcode_output', 'be_dps_template_part', 10, 2 );
