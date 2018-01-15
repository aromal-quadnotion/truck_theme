<?php
/*
* - Comment All Functions with some descriptions
* - Use truckindia prefix for all functions and custom variables
*   For example truckindia_myfunction(){ ... }
* - Use CMB2 for meta options and Theme Options if necessary
* - Tag developer name for your additions
*
*/
?>

<?php

  if (!is_admin())
  {
      add_action( 'wp_enqueue_scripts', 'truckindia_styles' );
      add_action( 'wp_enqueue_scripts', 'truckindia_scripts' );
  }

  function truckindia_styles()
  {
    wp_enqueue_style("bootstrap", get_template_directory_uri(). "/stylesheets/bootstrap.min.css");
    wp_enqueue_style("main-css", get_template_directory_uri(). "/stylesheets/main.css");
    wp_enqueue_style("truckindia-style", get_template_directory_uri(). "/style.css");
  }

  function truckindia_scripts()
  {
    wp_enqueue_script("main", get_template_directory_uri(). "/javascripts/libs/bootstrap.min.js",array(),false,true);

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


  function truckindia_fonts_url() {

  wp_enqueue_style( 'truckindia-fonts', 'https://fonts.googleapis.com/css?family=Hind:300,400,500,700|Montserrat:300,400,500,700|Open+Sans:300,400,700|Roboto+Condensed:300,400,700', false );

  }
  add_action( 'wp_enqueue_scripts', 'truckindia_fonts_url' );
