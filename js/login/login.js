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


function menuresponsive(){
  menu=$('.menu');
  if(menu.css('display')=='block'){
    menu.css('display','none');
    menu.removeClass('show-menu');
  }else{
    menu.css('display','block');
    menu.addClass('show-menu');
  }
};


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