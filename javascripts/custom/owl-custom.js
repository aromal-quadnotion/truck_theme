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

    $('.brand-image-display').owlCarousel({
      loop:true,
      margin:10,
      dots: false,
      nav:true,
      navText : ['<i class="fa fa-long-arrow-left" aria-hidden="true"></i>','<i class="fa fa-long-arrow-right" aria-hidden="true"></i>'],
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
    $(".justify-content-end li").click(function(){
      $("li").not(this).children("ul").hide("slow");
      $(this).children("ul").show("slow");
    });

    $(window).on('load', function(){
        $(".justify-content-end li:first").click();
    });
    //Brand Sliding Ends
});
