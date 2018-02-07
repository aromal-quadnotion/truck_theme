<?php
  //theme options
  require_once get_template_directory() . "/admin/theme-options.php";

  //Required js & css calling for frontend side
  if (!is_admin())
    {
      add_action( 'wp_enqueue_scripts', 'truckindia_styles' );
      add_action( 'wp_enqueue_scripts', 'truckindia_scripts' );
    }

  function truckindia_styles() {

    wp_enqueue_style("bootstrap", get_template_directory_uri(). "/stylesheets/bootstrap.min.css");
    wp_enqueue_style("ion-icons-custom", get_template_directory_uri(). "/ionicons/css/ionicons.css");
    wp_enqueue_style("main-css", get_template_directory_uri(). "/stylesheets/main.css");
    wp_enqueue_style("owl-carousel", get_template_directory_uri(). "/stylesheets/owl.carousel.min.css");
    wp_enqueue_style("owl-theme-default", get_template_directory_uri(). "/stylesheets/owl.theme.default.min.css");
    wp_enqueue_style( 'load-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
    wp_enqueue_style("smoothDivScroll-css", get_template_directory_uri(). "/stylesheets/smoothDivScroll.css");
    wp_enqueue_style("truckindia-style", get_template_directory_uri(). "/style.css");
  }

  function truckindia_scripts() {

    wp_enqueue_script("main", get_template_directory_uri(). "/javascripts/libs/bootstrap.min.js",array(),false,true);
    wp_enqueue_script("banner-tab-custom", get_template_directory_uri(). "/javascripts/custom/banner-tabs.js",array(),false,true);
    wp_enqueue_script("owl-carousel", get_template_directory_uri(). "/javascripts/libs/owl.carousel.min.js",array(),false,true);
    wp_enqueue_script("owl-custom", get_template_directory_uri(). "/javascripts/custom/owl-custom.js",array(),false,true);
    wp_enqueue_script("ui-custom", get_template_directory_uri(). "/javascripts/libs/jquery-ui-1.10.3.custom.min.js",array(),false,true);
    wp_enqueue_script("mousewheel", get_template_directory_uri(). "/javascripts/libs/jquery.mousewheel.min.js",array(),false,true);
    wp_enqueue_script("smoothdivscroll", get_template_directory_uri(). "/javascripts/libs/jquery.smoothdivscroll-1.3-min.js",array(),false,true);
    wp_enqueue_script("kinetic", get_template_directory_uri(). "/javascripts/libs/jquery.kinetic.min.js",array(),false,true);
    wp_enqueue_script("news-custom", get_template_directory_uri(). "/javascripts/custom/custom-news-scroll.js",array(),false,true);
    wp_enqueue_script("truckindia-main-script", get_template_directory_uri(). "/javascripts/custom/main.js",array(),false,true);

  }

  function truckindia_setup() {

    register_nav_menu('header', esc_html__( 'Header Navigation', 'truckindia'));
    register_nav_menu('pre-header', esc_html__( 'Language Navigation', 'truckindia'));
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

  }add_action( 'after_setup_theme', 'truckindia_setup' );

  //Footer Widget Register
  function truckindia_widgets_init() {

    register_sidebar( array(
        'name' => 'Footer Sidebar 1',
        'id' => 'footer-sidebar-1',
        'description' => 'Appears in the footer area',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<span class="font-size-2 font-r gray-b font-weight-700 footer-title-padding uppercase">',
        'after_title' => '</span>',
      ) );
      register_sidebar( array(
        'name' => 'Footer Sidebar 2',
        'id' => 'footer-sidebar-2',
        'description' => 'Appears in the footer area',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<span class="font-size-2 font-r gray-b font-weight-700 footer-title-padding uppercase">',
        'after_title' => '</span>',
      ) );
      register_sidebar( array(
        'name' => 'Footer Sidebar 3',
        'id' => 'footer-sidebar-3',
        'description' => 'Appears in the footer area',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<span class="font-size-2 font-r gray-b font-weight-700 footer-title-padding uppercase">',
        'after_title' => '</span>',
      ) );
      register_sidebar( array(
        'name' => 'Footer Sidebar 4',
        'id' => 'footer-sidebar-4',
        'description' => 'Appears in the footer area',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<span class="font-size-2 font-r gray-b font-weight-700 footer-title-padding uppercase">',
        'after_title' => '</span>',
      ) );
      register_sidebar( array(
        'name' => 'Footer Sidebar 5',
        'id' => 'footer-sidebar-5',
        'description' => 'Appears in the footer area',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<span class="font-size-2 font-r gray-b font-weight-700 footer-title-padding uppercase">',
        'after_title' => '</span>',
      ) );
      register_sidebar( array(
        'name' => 'Post Page Sidebar',
        'id' => 'post-page-sidebar',
        'description' => 'Appears in the post page right side',
        'before_widget' => '<aside id="%1$s" class="mar-bot-hhalf widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '',
        'after_title' => '',
      ) );

  } add_action( 'widgets_init', 'truckindia_widgets_init' );

  //Required Fonts
  function truckindia_fonts_url() {

      wp_enqueue_style( 'truckindia-fonts', 'https://fonts.googleapis.com/css?family=Hind:300,400,500,600,700|Montserrat:300,400,500,700|Open+Sans:300,400,700|Roboto+Condensed:300,400,700', false );

  }add_action( 'wp_enqueue_scripts', 'truckindia_fonts_url' );

  //Strip The string (used for blog post)
  function truckindia_clean($excerpt, $substr) {

      $string = strip_tags(do_shortcode($excerpt));
      if ($substr>0) {
        $string = substr($string, 0, $substr);
      }
      return $string.' ...';
  }

  //used for get the theme url / used in owl custom js
  function truckindia_theme_url() {

     $translation_array = array( 'template_directory_uri' => get_template_directory_uri());
     wp_localize_script( 'jquery', 'theme_url_path', $translation_array );

  }add_action('wp_enqueue_scripts','truckindia_theme_url');




  function get_breadcrumb() {
      echo '<a href="'.home_url().'" rel="nofollow">Home</a>';
      if (is_category() || is_single()) {
          echo "&nbsp;&nbsp;&#62;&nbsp;&nbsp;";
          the_category(' &bull; ');
              if (is_single()) {
                  echo " &nbsp;&nbsp;&#62;&nbsp;&nbsp; ";
                  the_title();
              }
      } elseif (is_page()) {
          echo "&nbsp;&nbsp;&#62;&nbsp;&nbsp;";
          echo the_title();
      } elseif (is_search()) {
          echo "&nbsp;&nbsp;&#62;&nbsp;&nbsp;Search Results for... ";
          echo '"<em>';
          echo the_search_query();
          echo '</em>"';
      }
  }
