jQuery(document).ready(function($) {

      var blogLeftContentH =  $('.blog-left-content-wrap').outerHeight();
      var blogRightContentH = $('.blog-right-content-wrap').outerHeight()+14;

      if((blogRightContentH*2)+20 > blogLeftContentH){
        $('.blog-left-image').height((blogRightContentH*2)+7);
      }
      else{
        $('.blog-right-image').height((blogLeftContentH/2)-16);
      }


      $(window).on('load',function () {
        $('.svg-convert').svgConvert( {
            svgCleanupAttr: ['title']
          });
        makeTruckTypeActive();
        activeListingPageButton();
        // compareButtonActivateOnListing();

        $( document ).ajaxComplete(function( event, jqxhr, settings ) {
          if(settings.url.indexOf('ajax_action=listings-result') != -1){
            activeListingPageButton();
            // compareButtonActivateOnListing();

          }

        });

         // will first fade out the loading animation
         $("#status").fadeOut();
         // will fade out the whole DIV that covers the website.
         $("#preloader").delay(1000).fadeOut(1000);

         setTimeout(function(){
             $('body').removeClass('preloader-running');
         }, 1000);


         setTimeout(function(){
             $('body').addClass('preloader-done');
         }, 1500);
         $("#mastwrap").css('visibility','visible');

         //remove border from Latest trucks from the compare page
           $('body.page-template-compare .related-truck-section').css('border','none');
      });

      $(window).on('resize',function () {

        var blogLeftContentH =  $('.blog-left-content-wrap').outerHeight();
        var blogRightContentH = $('.blog-right-content-wrap').outerHeight()+14;

        if((blogRightContentH*2)+20 > blogLeftContentH){
          $('.blog-left-image').height((blogRightContentH*2)+6);
        }
        else{
          $('.blog-right-image').height((blogLeftContentH/2)-16);
        }
    });

    //for removing a background opacity on insurance page cf7.
    $('#remove-class-for-insurance .insurance-quote-wrap .insurance-quote-bg').remove();

    //truck listing page adding active class to truck type
    function makeTruckTypeActive() {
      var url = window.location.href.replace(/\?/g, '');
      url = url.replace(/\=/g, '-');
      var baseurl = window.location.origin+window.location.pathname;
      var res = url.replace(baseurl, "");
      $('#' + res).find('a .truck-search-list-item').addClass('active');
    }

    var templateUrl = theme_url_path.template_directory_uri;
    function activeListingPageButton() {
      var button1 = '<a class="uppercase" href="#">insurance <span class="button-popup-icon"><img src="'+templateUrl+'/images/expand-box.svg" alt="Insurance Popup"></span></a>';
      var button2 = '<a class="uppercase" href="#">spares <span class="button-popup-icon"><img src="'+templateUrl+'/images/expand-box.svg" alt="Spares"></span></a>';
      var button3 = '<a class="contact-dealer uppercase" href="#">Contact Dealer <span class="button-popup-icon"><img src="'+templateUrl+'/images/expand-box.svg" alt="contact Dealer"></span></a>';
        $('#listings-result .meta-bottom .single-car-actions').find('ul').remove();
        $('#listings-result .meta-bottom .single-car-actions').append(button1, button2, button3);
        setTimeout(function(){
            $('.button-popup-icon img').svgConvert(
              {
                svgCleanupAttr: ['title']
              }
            );
        },500);

    }

    function compareButtonActivateOnListing() {
      var compareButtonListingCode = '<div class="compare-icon-wrap"><a href="#""><img src="'+templateUrl+'/images/compare-button.svg" title="Add to Compare" alt="Add to Compare"></a></div>';
      $('.archive-listing-page_content .listing-list-loop .content').prepend(compareButtonListingCode);


      $(".archive-listing-page_content .listing-list-loop .content .compare-icon-wrap a").on('click',function(){

        $(this).toggleClass('active');
        $(this).closest('.listing-list-loop').find('a.add-to-compare').trigger('click');
        var imgTitleAttr = $(this).find('img').attr("title");
        var newTitleAttr = imgTitleAttr == 'Add to Compare' ? 'Remove From Compare' : 'Add to Compare';
        $(this).find('img').attr("title", newTitleAttr);
        return false;
      });
    }


//single page Tabs**********************************

	var clickedTab = $(".tabs > .active");
	var tabWrapper = $(".tab__content");
	var activeTab = tabWrapper.find(".active");
	var activeTabHeight = activeTab.outerHeight();

	activeTab.show();// Show tab on page load

	tabWrapper.height(activeTabHeight);// Set height of wrapper on page load

	$(".tabs > li").on("click", function() {

		$(".tabs > li").removeClass("active");// Remove class from active tab

		$(this).addClass("active");// Add class active to clicked tab

		clickedTab = $(".tabs .active");// Update clickedTab variable

    		activeTab.fadeOut(250, function() {// fade out active tab

    			$(".tab__content > li").removeClass("active");// Remove active class all tabs

    			var clickedTabIndex = clickedTab.index();// Get index of clicked tab

    			$(".tab__content > li").eq(clickedTabIndex).addClass("active");// Add class active to corresponding tab

    			activeTab = $(".tab__content > .active");// update new active tab

    			activeTabHeight = activeTab.outerHeight();// Update variable

      			// Animate height of wrapper to new tab height
      			tabWrapper.stop().delay(50).animate({
      				height: activeTabHeight
      			}, 500, function() {

    				      activeTab.delay(50).fadeIn(250);// Fade in active tab

    			  });
    		});
	});
//single page Tabs ends**********************************

//single page EMI
$("#truck-finance-button").on("click", function(){

$('.finance-result-wrap').slideDown("slow").css('display','block');

 var downPayment = $("#downPaymeny").val();
 var month = $("#emiMonth").val();
 var rate = $("#InterestRate").val();
 var pramt = $("#prncipleAmount").val();
 var pamt = parseInt(pramt)-parseInt(downPayment);




  var monthlyInterestRatio = (rate/100)/12;
  var monthlyInterest = (monthlyInterestRatio*pamt);
     var top = Math.pow((1+monthlyInterestRatio),month);
         var bottom = top -1;
         var sp = top / bottom;
         var emi = ((pamt * monthlyInterestRatio) * sp);
  var result = Math.round(emi.toFixed(2));
  var totalInterest = Math.round((result*month)-pamt);
  var totalAmount = Math.round(parseInt(pamt)+parseInt(totalInterest));


  result = result.toString();
  var lastThree1 = result.substring(result.length-3);
  var otherNumbers1 = result.substring(0,result.length-3);
  if(otherNumbers1 != '')
      lastThree1 = ',' + lastThree1;
  result = otherNumbers1.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree1;

  totalInterest = totalInterest.toString();
  var lastThree2 = totalInterest.substring(totalInterest.length-3);
  var otherNumbers2 = totalInterest.substring(0,totalInterest.length-3);
  if(otherNumbers2 != '')
      lastThree2 = ',' + lastThree2;
  totalInterest = otherNumbers2.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree2;

  totalAmount = totalAmount.toString();
  var lastThree3 = totalAmount.substring(totalAmount.length-3);
  var otherNumbers3 = totalAmount.substring(0,totalAmount.length-3);
  if(otherNumbers3 != '')
      lastThree3 = ',' + lastThree3;
  totalAmount = otherNumbers3.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree3;


  $("#result").empty();
  $("#result").append("Rs. "+result);
  $("#total-interest").empty();
  $("#total-interest").append("Rs. "+totalInterest);
  $("#total-amount").empty();
  $("#total-amount").append("Rs. "+totalAmount);

});
//single page EMI Ends

$("body.page-template-compare .add-to-compare-modal").on("click", function(){
  setTimeout(function(){
    location.reload(true);
  },2000);
});
$("body.page-template-compare .add-to-compare").on("click", function(){
  setTimeout(function(){
    location.reload(true);
  },2000);

});

});
