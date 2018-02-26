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

// single truck page *---*

    var big = $('.single-truck-full-carousel');
    var small = $('.single-truck-thumb-carousel');
    var flag = false;
    var duration = 800;

    big
    .owlCarousel({
      items: 1,
      smartSpeed: 800,
      dots: false,
      nav: false,
      margin: 0,
      autoplay: false,
      loop: false,
      responsiveRefreshRate: 1000

    })
    .on('changed.owl.carousel', function (e) {
        $('.single-truck-full-carousel .owl-item').removeClass('current');
        $('.single-truck-full-carousel .owl-item').eq(e.item.index).addClass('current');
        if (!flag) {
            flag = true;
            small.trigger('to.owl.carousel', [e.item.index, duration, true]);
            flag = false;
        }
    });
    small
    .owlCarousel({
      items: 5,
      smartSpeed: 800,
      dots: false,
      margin: 22,
      autoplay: false,
      loop: false,
      responsiveRefreshRate: 1000,
      responsive: {
          0: {
              items: 2
          },
          500: {
              items: 4
          },
          768: {
              items: 5
          },
          1000: {
              items: 5
          }
        }

    })
    .on('click', '.owl-item', function (event) {
        big.trigger('to.owl.carousel', [$(this).index(), 400, true]);
    })
    .on('changed.owl.carousel', function (e) {
        if (!flag) {
            flag = true;
            big.trigger('to.owl.carousel', [e.item.index, duration, true]);
            flag = false;
        }
    });

var templateUrl = theme_url_path.template_directory_uri;
    // Related Post *---*
    $('.related-truck-wrap').owlCarousel({
      items: 4,
      smartSpeed: 800,
      dots: true,
      margin: 22,
      autoplay: false,
      loop: true,
      nav: true,
      navText: ['<img src="'+templateUrl+'/images/owl/left.png">','<img src="'+templateUrl+'/images/owl/right.png">'],
      responsiveRefreshRate: 1000,
      responsive: {
          0: {
              items: 2
          },
          500: {
              items: 3
          },
          768: {
              items: 3
          },
          1000: {
              items: 4
          }
        }

    });


// single truck page ends *---*

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
