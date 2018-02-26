<?php wp_footer();
  $options = get_option( 'truckindia_wp' );    ?>

                                        <div class="clearfix"></div>

<section class="pre-footer pad-top-min pad-bot-min">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="pre-footer-text">
          <p class="font-size-7 white font-h font-weight-700">TRUCKING<span class="font-weight-300">INDIA</span></p>
        </div>
      </div>
      <div class="col-md-8 pre-footer-content">
        <div class="pre-footer-text">
          <div>
            <img class="pre-footer-image1" src="<?php echo get_template_directory_uri(); ?>/images/mail.svg" alt="" widget="35px" height="35px">
            <a class="ease font-size-5 white font-h font-weight-300 pre-footer-text-mar" href="mailto:<?php echo esc_attr($options['ti-mail-url']); ?>"><?php echo esc_html($options['ti-mail-url']); ?></a>
          </div>
          <div class="">
            <img class="pre-footer-image2" src="<?php echo get_template_directory_uri(); ?>/images/call-icon.svg" alt="" width="25px" height="25px">
            <a class="ease font-size-5 white font-h font-weight-300 pre-footer-text-mar" href="tel:<?php echo esc_attr($options['ti-ph-no']); ?>"><?php echo esc_html($options['ti-ph-no']); ?></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

                                          <div class="clearfix"></div>

<footer class="footer pad-top-half pad-bot-half">
  <div class="">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="footer-widget-1">
            <?php
                if(is_active_sidebar('footer-sidebar-1')){
                dynamic_sidebar('footer-sidebar-1');
                }
            ?>
          </div>
        </div>
        <div class="col-md-2">
          <div class="footer-widget-2">
            <?php
                if(is_active_sidebar('footer-sidebar-2')){
                dynamic_sidebar('footer-sidebar-2');
                }
            ?>
          </div>
        </div>
        <div class="col-md-2">
          <div class="footer-widget-3">
            <?php
                if(is_active_sidebar('footer-sidebar-3')){
                dynamic_sidebar('footer-sidebar-3');
                }
            ?>
          </div>
        </div>
        <div class="col-md-2">
          <div class="footer-widget-4">
            <?php
                if(is_active_sidebar('footer-sidebar-4')){
                dynamic_sidebar('footer-sidebar-4');
                }
            ?>
          </div>
        </div>
        <div class="col-md-2">
          <div class="footer-quick-link">
            <?php
                if(is_active_sidebar('footer-sidebar-5')){
                dynamic_sidebar('footer-sidebar-5');
                }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

                                                <div class="clearfix"></div>

<section class="copyright pad-top-hhalf pad-bot-hhalf">
  <div class="container">
    <div class="row">
        <div class="col-md-10">
          <span class="copyright-text gray-b font-weight-400 font-h"><?php echo esc_html($options['ti-copyright']); ?></span>
        </div>
        <div class="col-md-2">
          <div class="copyright-icon">
            <ul>
              <li>
                <a class="ease font-size-5" href="<?php echo esc_attr($options['ti-instagram-url']); ?>" target="_blank"><i class="ion-social-instagram"></i></a>
              </li>
              <li>
                <a class="ease font-size-5" href="<?php echo esc_attr($options['ti-facebook-url']); ?>" target="_blank"><i class="ion-social-facebook"></i></a>
              </li>
              <li>
                <a class="ease font-size-5" href="<?php echo esc_attr($options['ti-vk-url']); ?>" target="_blank"><i class="fa fa-vk" aria-hidden="true"></i></a>
              </li>
              <li>
                <a class="ease font-size-5" href="<?php echo esc_attr($options['ti-twitter-url']); ?>" target="_blank"><i class="ion-social-twitter"></i></a>
              </li>
            </ul>
          </div>
      </div>
    </div>
  </div>
</section>




</body>
</html>
