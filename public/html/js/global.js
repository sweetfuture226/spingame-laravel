$(window).resize(function(){
    change_background_spin_visiblity();
});

$(window).ready(function() {
    change_background_spin_visiblity();
})

function change_background_spin_visiblity(){
    var screenHeight = $(window).height();
    var screenWidth = $(window).width();
    if (screenWidth < 767 && screenWidth > screenHeight) {
        $('div.certain-container').addClass('remove-before');
        $('.home_container > .text-container').css({'position': 'relative'});
    } else {
        $('div.certain-container').removeClass('remove-before');
        $('.home_container > .text-container').css({'position': 'absolute'});
    }
}
function setCookie(cookie_name, value, days) {
  var exdate = new Date();
  exdate.setDate(exdate.getDate() + days);
  var cookie_value = escape(value) + ((days == null) ? '' : ';    expires=' + exdate.toUTCString());
  document.cookie = cookie_name + '=' + cookie_value;
}
function getCookie(cookie_name) {
  var x, y;
  var val = document.cookie.split(';');

  for (var i = 0; i < val.length; i++) {
    x = val[i].substr(0, val[i].indexOf('='));
    y = val[i].substr(val[i].indexOf('=') + 1);
    x = x.replace(/^\s+|\s+$/g, ''); // strip white space
    if (x == cookie_name) {
      return unescape(y); 
    }
  }
}
function bgm_on(logined){
    if(logined){
        if(getCookie("bgm_on")==0){
            setCookie("bgm_on",1,3);
        }else{
            setCookie("bgm_on",0,3);
        }
        $.post( "/miscajax/setbgmon",{_token:$('meta[name="csrf-token"]').attr('content'),bg_val:getCookie("bgm_on")}, function( data ) {
            if(data.result="success"){
                
            }
        });
    }else{
        if(getCookie("bgm_on")==0){
            setCookie("bgm_on",1,3);
        }else{
            setCookie("bgm_on",0,3);
        }
    }
    if(getCookie("bgm_on")==1){
        $('.sound-icon-container > a > img').attr("src","/images/sound_icon.png");
        document.getElementById("audio_bgm").play();
    }else{
        $('.sound-icon-container > a > img').attr("src","/images/music_off.png");
        document.getElementById("audio_bgm").pause();
    }
}
$(document).ready(function(){
    if(getCookie("bgm_on")==1){
        $('.sound-icon-container > a > img').attr("src","/images/sound_icon.png");
        document.getElementById("audio_bgm").play();
    }else{
        $('.sound-icon-container > a > img').attr("src","/images/music_off.png");
        document.getElementById("audio_bgm").pause();
    }
});
$(document).click(function(){
    if(getCookie("bgm_on")==1){
        $('.sound-icon-container > a > img').attr("src","/images/sound_icon.png");
        document.getElementById("audio_bgm").play();
    }else{
        $('.sound-icon-container > a > img').attr("src","/images/music_off.png");
        document.getElementById("audio_bgm").pause();
    }
});