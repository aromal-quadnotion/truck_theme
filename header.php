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
?>
</head>
<body <?php body_class(); ?>>

  <section class="white-2-bg social-block">
    <div class="container">
      <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6">
          <div class="row justify-content-md-end">
            <div class="col-7 col-md-auto">
              <span class="font-size-1 gray-b font-h font-weight-700">ASK EXPERT</span> <div class="font-size-1 bray-l disin font-h font-weight-500"><a href="tel:+919846098460">+919846098460</a> | <a href="mailto:info@truckingindia.in">info@truckingindia.in</a></div>
            </div>
            <div class="col-2 col-md-auto">
              <div class="social-block-icon">
                <ul>
                  <li>
                    <a href="#" target="_blank"><i class="ion-social-instagram"></i></a>
                  </li>
                  <li>
                    <a href="#" target="_blank"><i class="ion-social-facebook"></i></a>
                  </li>
                  <li>
                    <a href="#" target="_blank"><i class="ion-social-twitter"></i></a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-3 col-md-auto">
              <span class="font-size-1 gray-l font-h font-weight-500">ENG | HIN | TML</span>
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
            <img src="wp-content/uploads/2018/01/logo.png" width="125px;">
          </a>
        </div>
        <div class="col-md-7">
          <div class="mar-top-min mar-bot-min">
            <?php
              $nav_args = array(
                'theme_location'  => 'header',
                'container'       => true,
                'menu_class'      => '',
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
                  <img class="compare-icon-img" src="wp-content/themes/truck_theme/img/truck.svg" alt="" width="45px" height="45px">
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
