$(document).ready(function () {
    
  $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('toggled');
  });
  
  

});

$(window).on("load", function(){
  $("#userinfo").html("UserName");
});