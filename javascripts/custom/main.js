jQuery(document).ready(function($) {

  // For Blog Section
  // var blogHeightRight = $(".blog-right-content-wrap").innerHeight();
  // $( ".blog-right-image" ).height( blogHeightRight );
  // var blogLeftHeight = ( blogHeightRight * 2 ) + 20 ;
  // $( ".blog-left-wrap" ).height( blogLeftHeight + 5 );
  // $( ".blog-left-image" ).height( blogLeftHeight + 5 );


  var blogLeftContentH =  $('.blog-left-content-wrap').outerHeight();
  var blogRightContentH = $('.blog-right-content-wrap').outerHeight()+14;

  if((blogRightContentH*2)+20 > blogLeftContentH){
    $('.blog-left-image').height((blogRightContentH*2)+7);
  }
  else{
    $('.blog-right-image').height((blogLeftContentH/2)-16);
  }

  // $( ".blog-left-image" ).height(blogLeftContentH);

  // $( ".blog-right-image" ).height( blogLeftContentH/2 -20 );

      $(window).on('resize',function () {
      // For Blog Section
      // var blocgLeftContentH =  $('.blog-left-content-wrap').outerHeight();
      // $( ".blog-left-image" ).height(blogLeftContentH);

      // var blogHeightRight = $(".blog-right-content-wrap").innerHeight();
      // $( ".blog-right-image" ).height( blogHeightRight );
      // var blogLeftHeight = ( blogHeightRight * 2 ) + 20 ;
      // $( ".blog-left-wrap" ).height( blogLeftHeight + 5 );
      // $( ".blog-left-image" ).height( blogLeftHeight + 5 );
      var blogLeftContentH =  $('.blog-left-content-wrap').outerHeight();
      var blogRightContentH = $('.blog-right-content-wrap').outerHeight()+14;

      if((blogRightContentH*2)+20 > blogLeftContentH){
        $('.blog-left-image').height((blogRightContentH*2)+6);
      }
      else{
        $('.blog-right-image').height((blogLeftContentH/2)-16);
      }
    });
});
