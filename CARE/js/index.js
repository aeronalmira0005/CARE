$(document).ready(function(){

  setTimeout(function(){
    $(".index-body-img-1").css({'animation-name': 'example', 'animation-duration': '2s', 'width': '40%', 'height': '45%'});
    setTimeout(function(){
      $(".index-body-img-2").css({'animation-name': 'example', 'animation-duration': '2s', 'width': '40%', 'height': '45%'});
      setTimeout(function(){
        $(".index-body-img-3").css({'animation-name': 'example', 'animation-duration': '2s', 'width': '40%', 'height': '45%'});
      },1500);
    },1500);
  },0);

});
