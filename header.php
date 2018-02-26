<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?php bloginfo('name'); ?> <?php wp_title("|",true); ?>">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>

<?php
    wp_head();
$options = get_option( 'truckindia_wp' );
?>
</head>
<body <?php body_class('preloader-running'); ?>>

  <div id="preloader">
    <div id="status"></div>
  </div>

  <section class="white-2-bg social-block">
    <div class="container">
      <div class="row pre-header-padding-bottom">
        <div class="col-md-6"></div>
        <div class="col-md-6">
          <div class="row justify-content-md-end">
            <div class="col-7 col-md-auto">
              <span class="font-size-1 gray-b font-h font-weight-700">ASK EXPERT</span> <div class="font-size-1 bray-l display-inline font-h font-weight-500"><a class="ease" href="tel:<?php echo esc_attr($options['ti-ph-no']); ?>"><?php echo esc_html($options['ti-ph-no']); ?></a>  |  <a class="ease" href="mailto:<?php echo esc_attr($options['ti-mail-url']); ?>"><?php echo esc_html($options['ti-mail-url']); ?></a></div>
            </div>
            <div class="col-2 col-md-auto">
              <div class="social-block-icon">
                <ul>
                  <li>
                    <a class="ease" href="<?php echo esc_attr($options['ti-instagram-url']); ?>" target="_blank"><i class="ion-social-instagram"></i></a>
                  </li>
                  <li>
                    <a class="ease" href="<?php echo esc_attr($options['ti-facebook-url']); ?>" target="_blank"><i class="ion-social-facebook"></i></a>
                  </li>
                  <li>
                    <a class="ease" href="<?php echo esc_attr($options['ti-twitter-url']); ?>" target="_blank"><i class="ion-social-twitter"></i></a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-3 col-md-auto">
              <div class="social-block-lang">
                <?php
                  $nav_args = array(
                    'theme_location'  => 'pre-header',
                    'container'       => false,
                    'menu_class'      => 'font-size-1 gray-l font-h font-weight-500 uppercase',
                    'echo'            => true,
                    'fallback_cb'     => ''
                  );
                  wp_nav_menu( $nav_args );
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <header class="nav">
    <div class="container">
      <div class="row mar-top-min mar-bot-min">
        <div class="col-md-2">
          <a href="<?php echo esc_url(home_url( '/' )); ?>">
            <?php if(isset($options['truckindia-logo']) && $options['truckindia-logo']['url'] != '' ){ ?>
              <img class="logo" src="<?php echo esc_url($options['truckindia-logo']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" />
            <?php } else{
              echo '<h3 class="black uppercase text-center">'.get_bloginfo('name').'</h3>';
            } ?>
          </a>
        </div>
        <div class="col-md-7">
          <div class="mar-top-min mar-bot-min">
            <?php
              $nav_args = array(
                'theme_location'  => 'header',
                'container'       => true,
                'menu_class'      => 'uppercase',
                'echo'            => true,
                'fallback_cb'     => 'wp_page_menu'
              );
              wp_nav_menu( $nav_args );
            ?>
          </div>
        </div>
        <div class="col-md-3">
          <div class="row no-gutters mar-top-min mar-bot-min compare-block">
              <div class="col">
                <a class="font-r font-size-2 font-weight-700" href="#">COMPARE</a>
              </div>
              <div class="col">
                <div class="truck-compare-icon">
                  <img class="compare-icon-img" src="<?php echo get_template_directory_uri(); ?>/images/truck.svg" alt="Compare Icon" width="45px" height="45px">
                </div>
              </div>
              <div class="col">
                <a class="font-r font-size-2 font-weight-700" href="#">BUY NOW</a>
              </div>
          </div>
        </div>
      </div>
    </div>
  </header>



<div class="clearfix"></div>
