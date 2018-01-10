/*
* - Comment All Functions with some descriptions
* - Use truckindia prefix for all functions and custom variables
*   For example truckindia_myfunction(){ ... }
* - Use CMB2 for meta options and Theme Options if necessary
* - Tag developer name for your additions
*
*/


<?php

  if (!is_admin())
 {
      add_action( 'wp_enqueue_scripts', 'truckindia_styles' );
      add_action( 'wp_enqueue_scripts', 'truckindia_scripts' );
  }

  function truckindia_styles()
  {
    wp_enqueue_style("bootstrap", get_template_directory_uri(). "/css/bootstrap.css");
    wp_enqueue_style("animate", get_template_directory_uri(). "/css/animate.css");
    wp_enqueue_style("flexslider", get_template_directory_uri(). "/css/flexslider.css");
    wp_enqueue_style("main-style", get_template_directory_uri(). "/css/style.css");
    wp_enqueue_style("icomoon", get_template_directory_uri(). "/css/icomoon.css");
    wp_enqueue_style("magnific-popup", get_template_directory_uri(). "/css/magnific-popup.css");
    wp_enqueue_style("owl-carousel-min", get_template_directory_uri(). "/css/owl.carousel.min.css");
    wp_enqueue_style("owl-theme-default-min", get_template_directory_uri(). "/css/owl.theme.default.min.css");
    wp_enqueue_style("themify-icons", get_template_directory_uri(). "/css/themify-icons.css");
    wp_enqueue_style("truckindia-style", get_template_directory_uri(). "/style.css");
}

function truckindia_scripts()
{
    wp_enqueue_script("bootstrap-min-js", get_template_directory_uri(). "/js/bootstrap.min.js",array('jquery'),false,true);
    //wp_enqueue_script("google-map", get_template_directory_uri(). "/js/google_map.js",array(),false,true);
    wp_enqueue_script("jquery-countTo", get_template_directory_uri(). "/js/jquery.countTo.js",array(),false,true);
    wp_enqueue_script("jquery-easing", get_template_directory_uri(). "/js/jquery.easing.1.3.js",array(),false,true);
    wp_enqueue_script("jquery-easypiechart", get_template_directory_uri(). "/js/jquery.easypiechart.min.js",array(),false,true);
    wp_enqueue_script("jquery-magnific-popup", get_template_directory_uri(). "/js/jquery.magnific-popup.min.js",array(),false,true);
    //wp_enqueue_script("jquery-min", get_template_directory_uri(). "/js/jquery.min.js",array(),false,true);
    wp_enqueue_script("jquery-stellar", get_template_directory_uri(). "/js/jquery.stellar.min.js",array(),false,true);
    wp_enqueue_script("jquery-waypoints", get_template_directory_uri(). "/js/jquery.waypoints.min.js",array(),false,true);
    wp_enqueue_script("magnific-popup-options", get_template_directory_uri(). "/js/magnific-popup-options.js",array(),false,true);

    wp_enqueue_script("modernizr", get_template_directory_uri(). "/js/modernizr-2.6.2.min.js",array(),false,true);
    wp_enqueue_script("owl-carousel", get_template_directory_uri(). "/js/owl.carousel.min.js",array(),false,true);
    wp_enqueue_script("respond", get_template_directory_uri(). "/js/respond.min.js",array(),false,true);
    wp_enqueue_script("main", get_template_directory_uri(). "/js/main.js",array(),false,true);
    wp_enqueue_script("wp-addition", get_template_directory_uri(). "/js/wp-addition.js",array(),false,true);

}


function truckindia_setup()
{
  register_nav_menu('header', esc_html__( 'Header Navigation', 'truckindia'));
  register_nav_menu('footer', esc_html__( 'Footer Navigation', 'truckindia'));

  add_theme_support('post-thumbnails' );

  add_theme_support( "title-tag" );

  add_theme_support( 'custom-header' );

  add_theme_support( "custom-background");


  //Feed links
  add_theme_support( 'automatic-feed-links' );

  //Content width
  if ( ! isset( $content_width ) ) $content_width = 900;


  //Load the text domain
  load_theme_textdomain('truckindia', get_template_directory() . '/languages');
  }

  add_action( 'after_setup_theme', 'truckindia_setup' );
