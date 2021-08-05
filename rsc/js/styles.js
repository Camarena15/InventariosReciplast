$(document).ready(function () {
    
  $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('toggled');
  });

  $("#profilebtn").click(function(){
    var url = $(this).attr("href");
    $("#content").load(url);
    return false;
  });

});

