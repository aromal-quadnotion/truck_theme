jQuery(document).ready(function($){

    $(window).on('load', function(){
      $('.slideshow').owlCarousel({
        items:1,
        loop:true,
        margin:0,
        dots: false,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause: false,
        animateOut: 'fadeOut',
        stagePadding:0,
        responsive:{
            0:{
                items:1
            },
            361:{
                items:1
            },
            768:{
                items:1
            },
            1025:{
                items:1
            }
          }

      });
    });

    //Brand Sliding
    // $('.brand-name-display li:first').addClass('active');
    // $('.brand-name-display li').on('click', function(){
    //   $('.brand-name-display li').removeClass('active');
    //   $(this).addClass('active');
    // });
var templateUrl = theme_url_path.template_directory_uri;
    $('.brand-image-display').owlCarousel({
      loop:true,
      margin:10,
      dots: false,
      nav:true,
      navText : ['<img src="'+templateUrl+'/images/owl/left-arrow.png">','<img src="'+templateUrl+'/images/owl/right-arrow.png">'],
      autoplay:true,
      autoplayTimeout:2000,
      responsive:{
          0:{
              items:1
          },
          600:{
              items:3
          },
          1000:{
              items:5
          }
        }

    });
    $(".brand-slider-list li a").click(function(){
      $("li.brand-slider-list-item").hide("slow");
      $(this).closest('li').show("slow");
    });

    $(window).on('load', function(){
        $(".brand-slider-list li:first-child a").trigger('click');
    });
    //Brand Sliding Ends

    $('.brand-slider-list .brand-slider-list-item').each(function(){
      var brandName = $(this).find('a').text();
      var brandTriggerId = $(this).find('a').attr('id');

      var triggerListItem = '<li><a href="#'+ brandTriggerId +'">'+ brandName +'</a></li>';
      $('.brand-name-trigger-list').append(triggerListItem);
    });

    $('.brand-name-trigger-list li:first-child a').addClass('active');

    $('.brand-name-trigger-list li a').on('click', function(){
      $('.brand-name-trigger-list li a').removeClass('active');
      $(this).addClass('active');

      var brandId = $(this).attr('href');
      $('a'+ brandId).trigger('click');
      return false;
    });
});
