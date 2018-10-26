<footer class="footer-1 bg-white">

    <div class="container">
    
        <div class="row">
        	<?php
        		if( is_active_sidebar('footer1') && !( is_active_sidebar('footer2') ) && !( is_active_sidebar('footer3') ) && !( is_active_sidebar('footer4') ) ){
        			echo '<div class="col-sm-12">';
        				dynamic_sidebar('footer1');
        			echo '</div>';
        		}
        			
        		if( is_active_sidebar('footer2') && !( is_active_sidebar('footer3') ) && !( is_active_sidebar('footer4') ) ){
        			echo '<div class="col-sm-6">';
        				dynamic_sidebar('footer1');
        			echo '</div><div class="col-sm-6">';
        				dynamic_sidebar('footer2');
        			echo '</div><div class="clear"></div>';
        		}
        			
        		if( is_active_sidebar('footer3') && !( is_active_sidebar('footer4') ) ){
        			echo '<div class="col-md-4 col-sm-6">';
        				dynamic_sidebar('footer1');
        			echo '</div><div class="col-md-4 col-sm-6">';
        				dynamic_sidebar('footer2');
        			echo '</div><div class="col-md-4 col-sm-6">';
        				dynamic_sidebar('footer3');
        			echo '</div><div class="clear"></div>';
        		}

            if ( ( is_active_sidebar( 'footer4' ) ) ) {
                echo '<div class="col-md-3 col-sm-6">'; //dynamic_sidebar('footer1');?>
                <div id="text-1" class="widget widget_text"><h6
                            class="title">Contact</h6>
                    <hr>
                    <div class="textwidget">
                        <div>
                            <strong>Email: </strong><?php echo bpfwp_setting( 'contact-email' );?>
                        </div>
                        <div>
                            <strong>Phone: </strong><?php echo bpfwp_setting( 'phone' );?>
                        </div>
                        <div>
                            <strong>URL: </strong><?php echo get_bloginfo( 'url' )?>
                        </div>
                        <div>
                            <strong>Address: </strong><?php echo bpfwp_setting( 'address' )['text'];?>
                        </div>
                    </div>
                </div>
                <?php echo '</div><div class="col-md-3 col-sm-6">';
                dynamic_sidebar( 'footer2' );
                echo '</div><div class="col-md-3 col-sm-6">';
                dynamic_sidebar( 'footer3' );
                echo '</div><div class="col-md-3 col-sm-6">';
                dynamic_sidebar( 'footer4' );
                echo '</div><div class="clear"></div>';
            }
        	?>
        </div>

        <div class="row">
        
            <div class="col-sm-6">
                <span class="sub">
                	<?php echo wp_kses_post(htmlspecialchars_decode(get_option('foundry_footer_copyright', '<a href="http://www.tommusrhodus.com">Foundry Premium WordPress Theme by TommusRhodus</a>')), ebor_allowed_tags()); ?>
                </span>
            </div>
            
            <div class="col-sm-6 text-right">
                <ul class="list-inline social-list">
                    <?php get_template_part('inc/content','footer-social-icons'); ?>
                </ul>
            </div>
            
        </div>
        
    </div>

    <a class="btn btn-sm btn-filled back-to-top inner-link" href="#top"><?php _e('Top','foundry'); ?></a>
    
</footer>