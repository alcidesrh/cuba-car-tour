<?php
/**
 * Created by PhpStorm.
 * User: alcides
 * Date: 10/3/2018
 * Time: 9:35 a.m.
 */
add_action( 'wp_ajax_tour_list', 'tour_list' );
add_action( 'wp_ajax_nopriv_tour_list', 'tour_list' );
function tour_list()
{
    $result = [];
    global $post;
    if ( $posts = get_posts( [ 'post_type' => 'havana-tour-type', 'numberposts' => -1 ] ) )
        foreach ( $posts as $value ) {
            $post = $value;
            $post->img = get_the_post_thumbnail_url( $post->ID );
            $post->price_per_person = types_render_field( 'precio-por-pasajero' );
            $post->price_per_sedan = types_render_field( 'precio-por-sedan' );
            $post->price_per_convertible = types_render_field( 'precio-por-convertible' );
            $result[] = $post;
        }
    echo json_encode( $result );
    wp_die();
}

add_action( 'wp_ajax_day_tour_list', 'day_tour_list' );
add_action( 'wp_ajax_nopriv_day_tour_list', 'day_tour_list' );
function day_tour_list()
{
    $result = [];
    global $post;
    if ( $posts = get_posts( [ 'post_type' => 'day-tour-type', 'numberposts' => -1 ] ) )
        foreach ( $posts as $value ) {
            $post = $value;
            $post->img = get_the_post_thumbnail_url( $post->ID );
            $post->price_per_sedan = types_render_field( 'precio-por-sedan' );
            $post->price_per_convertible = types_render_field( 'precio-por-convertible' );
            $result[] = $post;
        }
    echo json_encode( $result );
    wp_die();
}

add_action( 'wp_ajax_transfer_list', 'transfer_list' );
add_action( 'wp_ajax_nopriv_transfer_list', 'transfer_list' );
function transfer_list()
{
    $result = [];
    global $post;
    if ( $posts = get_posts( [ 'post_type' => 'transfer-type', 'numberposts' => -1 ] ) )
        foreach ( $posts as $value ) {
            $post = $value;
            $post->price_per_sedan = types_render_field( 'precio-por-sedan' );
            $post->price_per_convertible = types_render_field( 'precio-por-convertible' );
            $post->transfer_personalizado = types_render_field( 'transfer-personalizado' );
            $result[] = $post;
        }
    echo json_encode( $result );
    wp_die();
}

add_action( 'wp_ajax_rent_car', 'rent_car' );
add_action( 'wp_ajax_nopriv_rent_car', 'rent_car' );
function rent_car()
{
    $result = [];
    global $post;
    if ( $posts = get_posts( [ 'post_type' => 'rent-car-type', 'numberposts' => -1 ] ) )
        foreach ( $posts as $value ) {
            $post = $value;
            $post->price_per_sedan_12 = types_render_field( 'sedan-12-horas' );
            $post->price_per_convertible_12 = types_render_field( 'convertible-12-horas' );
            $post->price_per_sedan = types_render_field( 'sedan-por-dia' );
            $post->price_per_convertible = types_render_field( 'convertible-por-dia' );
            $result[] = $post;
        }
    echo json_encode( $result );
    wp_die();
}

add_action( 'wp_ajax_extra_tour', 'extra_tour' );
add_action( 'wp_ajax_nopriv_extra_tour', 'extra_tour' );
function extra_tour()
{
    $result = [];
    global $post;
    if ( $posts = cptr_populate( $_GET[ 'tour' ] ) )
        foreach ( $posts as $value ) {
            $post = $value;
            $post->img = get_the_post_thumbnail_url( $post->ID );
            $post->price = types_render_field( 'precio' );
            $result[] = $post;
        }
    echo json_encode( $result );
    wp_die();
}

add_action( 'wp_ajax_reserve_tour', 'reserve_tour' );
add_action( 'wp_ajax_nopriv_reserve_tour', 'reserve_tour' );
function reserve_tour()
{
    $reserve = json_decode( stripslashes( $_POST[ 'reserve' ] ), true );
    global $post;
    $post = get_post( $reserve[ 'tour' ] );
    if ( $reserve[ 'car' ] == 2 ) {
        $car_type = 'Convertible';
        $car_price = types_render_field( 'precio-por-convertible' );
    } else {
        $car_type = 'Sedan';
        $car_price = types_render_field( 'precio-por-sedan' );
    }
    $tour_title = $post->post_title;
    if ( !empty( $reserve[ 'extras' ] ) ) {
        $extras = [];
        foreach ( $reserve[ 'extras' ] as $id ) {
            $post = get_post( $id );;
            $post->price = types_render_field( 'precio' );
            $extras[] = $post;

        }
    }
    $message = "";
    require __DIR__ . '/mails/reserve-tour.php';

    $headers = array( 'Content-Type: text/html; charset=UTF-8' );

    if ( wp_mail( get_bloginfo( 'admin_email' ), 'Reserva de Habana Tour', $message, $headers ) )
        echo 'success'; else echo 'error';
    wp_die();
}

add_action( 'wp_ajax_reserve_day_tour', 'reserve_day_tour' );
add_action( 'wp_ajax_nopriv_reserve_day_tour', 'reserve_day_tour' );
function reserve_day_tour()
{
    $reserve = json_decode( stripslashes( $_POST[ 'reserve' ] ), true );
    echo 'success';
    wp_die();
}

add_action( 'wp_ajax_reserve_transfer', 'reserve_transfer' );
add_action( 'wp_ajax_nopriv_reserve_transfer', 'reserve_transfer' );
function reserve_transfer()
{
    $reserve = json_decode( stripslashes( $_POST[ 'reserve' ] ), true );
    echo 'success';
    wp_die();
}

add_action( 'wp_ajax_reserve_car', 'reserve_car' );
add_action( 'wp_ajax_nopriv_reserve_car', 'reserve_car' );
function reserve_car()
{
    $reserve = json_decode( stripslashes( $_POST[ 'reserve' ] ), true );
    echo 'success';
    wp_die();
}

add_action( 'wp_ajax_contact', 'contact' );
add_action( 'wp_ajax_nopriv_contact', 'contact' );
function contact()
{
    $reserve = json_decode( stripslashes( $_POST[ 'contact' ] ), true );
    echo 'success';
    wp_die();
}

add_action( 'wp_ajax_feedback', 'feedback' );
add_action( 'wp_ajax_nopriv_feedback', 'feedback' );
function feedback()
{
    $reserve = json_decode( stripslashes( $_POST[ 'feedback' ] ), true );
    $pathinfo = pathinfo( $reserve[ 'img' ][ 'name' ] );
    $photo[ 'filename' ] = strtolower( preg_replace( '/[^A-Za-z0-9]+/', "", $pathinfo[ 'filename' ] ) );
    $photo[ 'name' ] = $photo[ 'filename' ] . '.' . $pathinfo[ 'extension' ];
    $base64img = $reserve[ 'img' ][ 'src' ];
    if ( $pathinfo[ 'extension' ] == 'png' || $pathinfo[ 'extension' ] == 'gif' )
        $img = str_replace( 'data:image/png;base64,', '', $base64img ); else
        $img = str_replace( 'data:image/jpeg;base64,', '', $base64img );
    $data = base64_decode( str_replace( ' ', '+', $img ) );
    $IMGFilePath = __DIR__ . '/testimonio-img/' . $photo[ 'name' ];
//    $categories = ['tour_list' => 'havana-tours', 'day_tour_list' => 'day-tours', 'transfer_list' => 'transfers', 'rent_car' => 'rent-car'];
    if ( $success = file_put_contents( $IMGFilePath, $data ) ) {
        $attr = [ 'post_title' => $reserve[ 'name' ], 'post_content' => $reserve[ 'note' ], //            'post_status' => 'publish',
            'meta_input' => [ 'rating' => 5, 'post_type' => $reserve[ 'type' ], 'post_id' => $reserve[ 'tour' ] ], //            'post_category' => [25],
            'post_type' => 'testimonial'

        ];
        if ( $postId = wp_insert_post( $attr ) ) {
            //prepare upload image to WordPress Media Library
            $upload = wp_upload_bits( $photo[ 'name' ], null, file_get_contents( $IMGFilePath, FILE_USE_INCLUDE_PATH ) );

            // check and return file type
            $imageFile = $upload[ 'file' ];
            $wpFileType = wp_check_filetype( $imageFile, null );

            // Attachment attributes for file
            $attachment = array( 'post_mime_type' => $wpFileType[ 'type' ],  // file type
                'post_title' => sanitize_file_name( $imageFile ),  // sanitize and use image name as file name
                'post_content' => '',  // could use the image description here as the content
                'post_status' => 'inherit' );

            // insert and return attachment id
            $attachmentId = wp_insert_attachment( $attachment, $imageFile, $postId );

            // insert and return attachment metadata
            $attachmentData = wp_generate_attachment_metadata( $attachmentId, $imageFile );

            // update and return attachment metadata
            wp_update_attachment_metadata( $attachmentId, $attachmentData );

            // finally, associate attachment id to post id
            if ( set_post_thumbnail( $postId, $attachmentId ) )
                echo 'success';
        }
    }
    wp_die();
}