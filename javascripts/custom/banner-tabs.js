jQuery(document).ready(function($) {
  $('.banner-tabs .banner-tab-links a').on('click', function(e)  {
    var currentAttrValue = $(this).attr('href');
    // Show/Hide Tabs
    $('.banner-tabs ' + currentAttrValue).fadeIn(400).siblings().hide();
    // Change/remove current tab to active
    $(this).parent('li').addClass('active').siblings().removeClass('active');
    e.preventDefault();
  });
});
