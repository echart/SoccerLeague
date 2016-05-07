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
        $("#loader").fakeLoader({
            timeToHide:1200,
            bgColor:"#B44230",
            spinner:"spinner7",
        });
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
      url: 'includes/ajax/login.php',
      method: 'POST',
      dataType: JSON,
      data: {login: $("input[name='userlogin']").val(), password:$("input[name='userpass']").val()},
      beforeSend: function(){
        $('.viewlogin .return').html('');
        $('.viewlogin button').html('Carregando');
      },
      success: function(data){
        $('.viewlogin .return').html('Sucesso, redirecionando...');
      },
      error: function(data){
        console.log(data);
        $('.viewlogin button').html('Realizar login');
        $('.viewlogin .return').html('Parece que você esqueceu o seu crachá com sua autenticação, você precisa dela pra entrar no seu clube');
      }
  });
}
function register(){
  $.ajax({
      url: 'includes/ajax/register.php',
      method: 'POST',
      dataType: 'json',
      data: {login: $("input[name='userlogin1']").val(), password:$("input[name='userpass1']").val(), rpassword:$("input[name='reuserpass1']").val(), clubname:$("input[name='clubname']").val(), country: $('select[name="country"]').val()},
      beforeSend: function(data){
        $('.viewsign .return').html('');
        $('.viewsign button').html('Carregando');
      },
      success: function(data){
        console.log(data);
        if(data.return=='empty'){
          response='Email e senha devem ser preenchidos';
        }else if(data.return=='pass'){
          response='Senha precisa ter mais de 8 caracteres';
        }else if(data.return=='email'){
          response='Email já cadastrado, utilize um outro email.';
        }else if(data.return=='club'){
          response='Oh que pena, já temos um clube com esse nome. Escolha um novo nome e começe a sua história!';
        }else if(data.return=='diferentpass'){
          response='As senhas digitadas não conferem';
        }else if(data.return=='empty2'){
          response='Clube e país devem ser preenchidos';
        }else if(data.return=='success'){
          response='Clube criado com sucesso! Faça login para começar a administra-lo! <br><img src="img/icons/contract.png">';
        }
        console.log(data.responseText);
        $('.viewsign button').html('Criar clube');
        $('.viewsign .return').html(response);
      },
      error: function(data){
        console.log(data.responseText);
        $('.viewsign button').html('Criar clube');
        $('.viewsign .return').html('Há algum problema com os papeis, não podemos dar andamento na criação do clube');
      }
  });
}

