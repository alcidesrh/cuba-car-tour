<?php
/*
Plugin Name: Roofleess
Description: Formularios y otras interfaces de roofleess
Version: 0.1
Author: Alcides Rodriguez
*/

if ( ! class_exists( 'Roofleess' ) ) {
    class Roofleess {

        private $shortcode_reserve_form = 'roofleess_reserve_form';
        private $shortcode_reserve_form_day_tour = 'roofleess_reserve_form_day_tour';
        private $shortcode_reserve_form_transfer = 'roofleess_reserve_form_transfer';
        private $shortcode_rent_car = 'roofleess_rent_car';
        private $shortcode_contact_form = 'roofleess_contact_form';
        private $shortcode_feedback = 'roofleess_feedback';
        private $shortcode_home_havana_tour = 'roofleess_home_havana_tour';
        private $shortcode_customize_request = 'roofleess_customize_request';

        public function register() {
            add_shortcode( $this->shortcode_reserve_form, [$this, 'reserveForm'] );
            add_shortcode( $this->shortcode_reserve_form_day_tour, [$this, 'reserveFormDayTour'] );
            add_shortcode( $this->shortcode_reserve_form_transfer, [$this, 'reserveTransfer'] );
            add_shortcode( $this->shortcode_rent_car, [$this, 'rentCar'] );
            add_shortcode( $this->shortcode_contact_form, [$this, 'contactForm'] );
            add_shortcode( $this->shortcode_feedback, [$this, 'feedbackForm'] );
            add_shortcode( $this->shortcode_home_havana_tour, [$this, 'havanaTourHome'] );
            add_shortcode( $this->shortcode_customize_request, [$this, 'customizeRequest'] );
        }

        public function reserveForm( $atts ) {
            wp_enqueue_script( 'reserve-form', plugin_dir_url( __FILE__ ) . 'roofleess-vue/dist/reserve-tour/build.js', [], '0.1', true );
            wp_localize_script( 'reserve-form', 'params',['ajax_url'=>admin_url('admin-ajax.php'), 'tour_id' => $atts['id'] ?? null] );

            wp_enqueue_style( 'material-icon', plugin_dir_url( __FILE__ ) . 'roofleess-vue/public/iconfont/material-icons.css', [], '0.1' );
        }

        public function reserveFormDayTour( $atts ) {
            wp_enqueue_script( 'reserve-form', plugin_dir_url( __FILE__ ) . 'roofleess-vue/dist/reserve-day-tour/build.js', [], '0.1', true );
            wp_localize_script( 'reserve-form', 'params',['ajax_url'=>admin_url('admin-ajax.php'), 'tour_id' => $atts['id'] ?? null] );

            wp_enqueue_style( 'material-icon', plugin_dir_url( __FILE__ ) . 'roofleess-vue/public/iconfont/material-icons.css', [], '0.1' );
        }

        public function reserveTransfer( $atts ) {
            wp_enqueue_script( 'reserve-form', plugin_dir_url( __FILE__ ) . 'roofleess-vue/dist/reserve-transfer/build.js', [], '0.1', true );
            if(isset($atts['id']))
            wp_localize_script( 'reserve-form', 'params',['ajax_url'=>admin_url('admin-ajax.php'), 'tour_id' => $atts['id'] ?? null] );
            if(isset($atts['customize']))
                wp_localize_script( 'reserve-form', 'params',['ajax_url'=>admin_url('admin-ajax.php'), 'customize' => true] );
            wp_enqueue_style( 'material-icon', plugin_dir_url( __FILE__ ) . 'roofleess-vue/public/iconfont/material-icons.css', [], '0.1' );
        }

        public function rentCar( $atts )
        {
            wp_enqueue_script( 'reserve-form', plugin_dir_url( __FILE__ ) . 'roofleess-vue/dist/rent-car/build.js', [], '0.1', true );
            wp_localize_script( 'reserve-form', 'params', [ 'ajax_url' => admin_url( 'admin-ajax.php' ), 'tour_id' => $atts[ 'id' ] ?? null ] );

            wp_enqueue_style( 'material-icon', plugin_dir_url( __FILE__ ) . 'roofleess-vue/public/iconfont/material-icons.css', [], '0.1' );

        }

        public function contactForm( $atts )
        {
            wp_enqueue_script( 'contact-form', plugin_dir_url( __FILE__ ) . 'roofleess-vue/dist/contact/build.js', [], '0.1', true );
            wp_localize_script( 'contact-form', 'params', [ 'ajax_url' => admin_url( 'admin-ajax.php' )] );

            wp_enqueue_style( 'material-icon', plugin_dir_url( __FILE__ ) . 'roofleess-vue/public/iconfont/material-icons.css', [], '0.1' );
        }

        public function feedbackForm( $atts ) {
            wp_enqueue_script( 'feedback-form', plugin_dir_url( __FILE__ ) . 'roofleess-vue/dist/testimonial/build.js', [], '0.1', true );
            wp_localize_script( 'feedback-form', 'params',['ajax_url'=>admin_url('admin-ajax.php')] );

            wp_enqueue_style( 'material-icon', plugin_dir_url( __FILE__ ) . 'roofleess-vue/public/iconfont/material-icons.css', [], '0.1' );
        }

        public function customizeRequest( $atts ) {
            wp_enqueue_script( 'customize-request', plugin_dir_url( __FILE__ ) . 'roofleess-vue/dist/customize-request/build.js', [], '0.1', true );
            wp_localize_script( 'customize-request', 'params',['ajax_url'=>admin_url('admin-ajax.php'), 'category' => $atts[ 'category' ]] );

            wp_enqueue_style( 'material-icon', plugin_dir_url( __FILE__ ) . 'roofleess-vue/public/iconfont/material-icons.css', [], '0.1' );
        }

        public function havanaTourHome(){
            do_shortcode('[display-posts post_type="havana-tour" posts_per_page="3"]');
        }

        public function scripts() {
//            global $post;
//            // Only enqueue scripts if we're displaying a post that contains the shortcode
//            if( has_shortcode( $post->post_content, $this->shortcode_name ) ) {
//                wp_enqueue_script( 'vue', 'https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.js', [], '2.5.16' );
//                wp_enqueue_script( 'pollka-king', plugin_dir_url( __FILE__ ) . 'js/pollka-king.js', [], '0.1', true );
//                wp_enqueue_style( 'pollka-king', plugin_dir_url( __FILE__ ) . 'css/pollka-king.css', [], '0.1' );
//            }
        }

    }
    (new Roofleess())->register();
}

