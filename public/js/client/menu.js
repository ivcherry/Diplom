$(document).ready(function(){
  $('a').on('click', function(e){

  });

  $('li').hover(function () {
     clearTimeout($.data(this,'timer'));
     $('> ul',this).stop(true,true).slideDown(100);
  }, function () {
    $.data(this,'timer', setTimeout($.proxy(function() {
      $('> ul',this).stop(true,true).slideUp(100);
    }, this), 100));
  });

});
