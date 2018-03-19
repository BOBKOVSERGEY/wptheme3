$(function(){
  $( "#accordion" ).accordion();
  $( "#tabs" ).tabs();
});
$(window).load(function(){
  $('.flexslider').flexslider({
    animation: "slide",
    start: function(slider){
      $('body').removeClass('loading');
    }
  });
});