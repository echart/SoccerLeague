		/*!
 * classie v1.0.0
 * class helper functions
 * from bonzo https://github.com/ded/bonzo
 * MIT license
 *
 * classie.has( elem, 'my-class' ) -> true/false
 * classie.add( elem, 'my-new-class' )
 * classie.remove( elem, 'my-unwanted-class' )
 * classie.toggle( elem, 'my-class' )
 */

/*jshint browser: true, strict: true, undef: true, unused: true */
/*global define: false */

( function( window ) {

'use strict';

// class helper functions from bonzo https://github.com/ded/bonzo

function classReg( className ) {
  return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
}

// classList support for class management
// altho to be fair, the api sucks because it won't accept multiple classes at once
var hasClass, addClass, removeClass;

if ( 'classList' in document.documentElement ) {
  hasClass = function( elem, c ) {
    return elem.classList.contains( c );
  };
  addClass = function( elem, c ) {
    elem.classList.add( c );
  };
  removeClass = function( elem, c ) {
    elem.classList.remove( c );
  };
}
else {
  hasClass = function( elem, c ) {
    return classReg( c ).test( elem.className );
  };
  addClass = function( elem, c ) {
    if ( !hasClass( elem, c ) ) {
      elem.className = elem.className + ' ' + c;
    }
  };
  removeClass = function( elem, c ) {
    elem.className = elem.className.replace( classReg( c ), ' ' );
  };
}

function toggleClass( elem, c ) {
  var fn = hasClass( elem, c ) ? removeClass : addClass;
  fn( elem, c );
}

var classie = {
  // full names
  hasClass: hasClass,
  addClass: addClass,
  removeClass: removeClass,
  toggleClass: toggleClass,
  // short names
  has: hasClass,
  add: addClass,
  remove: removeClass,
  toggle: toggleClass
};

// transport
if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( classie );
} else {
  // browser global
  window.classie = classie;
}

})( window );

function menuscroll() {
    window.addEventListener('scroll', function(e){
        var distanceY = window.pageYOffset || document.documentElement.scrollTop,
            shrinkOn = 300,
            header = document.querySelector("header");
        if (distanceY > shrinkOn) {
            classie.add(header,"scroll");
        } else {
            if (classie.has(header,"scroll")) {
                classie.remove(header,"scroll");
            }
        }
    });
}
window.onload = menuscroll();



$(function() {
    $('a[href*="#"]:not([href="#"])').click(function() {
      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {

        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
        console.log(target.selector);
      }
    });
  });

$(document).ready(function(){
        // $("#loader").fakeLoader({
        //     timeToHide:1200,
        //     bgColor:"#B44230",
        //     spinner:"spinner7",
        // });
        var video = document.querySelector("video");
        video.addEventListener("ended", function(){
    video.play();
  });
    if(document.body.clientWidth >= 900) {
          $('video').attr('autoplay', true);
          $('video').attr('preload', 'auto');

      }
    });

function expandLogin(){
  $('div.viewsign').removeClass('expanded');
  $('div.viewlogin').toggleClass('expanded');
}
function expandSignin(){
  $('div.viewlogin').removeClass('expanded');
  $('div.viewsign').toggleClass('expanded');
}
function login(){
  $.ajax({
      url: 'controllers/_login.php',
      method: 'POST',
      dataType: 'JSON',
      data: {login: $("input[name='userlogin']").val(), password:$("input[name='userpass']").val()},
      beforeSend: function(){
        $('.viewlogin .return').html('');
        $('.viewlogin button').html('Carregando');
      },
      success: function(data){
        $('.viewlogin button').html('Realizar login');
        if(data.return=='denied'){
        $('.viewlogin .return').html('<br>Parece que os dados apresentados não conferem, você não pode entrar no seu clube');
        }else{
          $('.viewlogin .return').html('Sucesso, redirecionando...');
          setTimeout(function(){
            location.reload();
          },1000);
        }
      },
      error: function(data){
        console.log(data.responseText);
        $('.viewlogin button').html('Realizar login');
        $('.viewlogin .return').html('');
      }
  });
}
function register(){
  $.ajax({
      url: 'controllers/_register.php',
      method: 'POST',
      dataType: 'json',
      data: {refeer: $("input[name='refeer']").val(),login: $("input[name='userlogin1']").val(), password:$("input[name='userpass1']").val(), rpassword:$("input[name='reuserpass1']").val(), clubname:$("input[name='clubname']").val(), country: $('#country').data('ddslick').selectedData.value},
      beforeSend: function(data){
        $('.viewsign .return').html('');
        $('.viewsign button').html('Carregando');
      },
      success: function(data){
        response=data;
        console.log(data);
        $('.viewsign button').html('Criar clube');
        $('.viewsign .return').html(response);
      },
      error: function(data){
        console.log(data);
        $('.viewsign button').html('Criar clube');
        $('.viewsign .return').html('Há algum problema com os papeis, não podemos dar andamento na criação do clube');
      }
  });
}

$('#country').ddslick({
    data: countriesData,
    width: 285,
    imagePosition: "left",
    selectText: "Selecione um país para seu clube",
    onSelected: function (data) {
        console.log(data);
    }
});
