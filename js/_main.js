/*!
 * BootClean v9.0.0 (http://rgdesign.org)
 * Copyright 1999-2018 Roberto Garcia.
 * Licensed under the MIT license
 */  

// Extra/Plugins

// @koala-append "C:/xampp/htdocs/_www/_BC_builder_v4/_source/bootclean/js/extra/modernizr.js"
// @koala-append "C:/xampp/htdocs/_www/_BC_builder_v4/_source/bootclean/js/extra/slick.js"
// @koala-append "C:/xampp/htdocs/_www/_BC_builder_v4/_source/bootclean/js/extra/jquery.easing.1.3.js"
// @koala-append "C:/xampp/htdocs/_www/_BC_builder_v4/_source/bootclean/js/extra/bootstrap-select.js"

// BC Required 
// @koala-append "C:/xampp/htdocs/_www/_BC_builder_v4/_source/bootclean/js/globals/get_window_sizes.js" 
// @koala-append "C:/xampp/htdocs/_www/_BC_builder_v4/_source/bootclean/js/globals/BC_scrolling_classes.js" 
// @koala-append "C:/xampp/htdocs/_www/_BC_builder_v4/_source/bootclean/js/globals/BC_scroll_to.js"
// @koala-append "C:/xampp/htdocs/_www/_BC_builder_v4/_source/bootclean/js/globals.js" 
	

// BC Addons

// @koala-append "C:/xampp/htdocs/_www/_BC_builder_v4/_source/bootclean/js/addons/bootstrap-range-slider.js"

// @koala-append "C:/xampp/htdocs/_www/_BC_builder_v4/_source/bootclean/js/addons/data-animated.js"
// @koala-append "C:/xampp/htdocs/_www/_BC_builder_v4/_source/bootclean/js/addons/bootstrap-dropdown-hover.js" 
// @koala-append "C:/xampp/htdocs/_www/_BC_builder_v4/_source/bootclean/js/addons/bootstrap-scroll-affix.js"  
// @koala-append "C:/xampp/htdocs/_www/_BC_builder_v4/_source/bootclean/js/addons/bootstrap-nav-affix.js"  
// @koala-append "C:/xampp/htdocs/_www/_BC_builder_v4/_source/bootclean/js/addons/bootstrap-better-nav.js" 

// BC Core scripts 

// @koala-append "C:/xampp/htdocs/_www/_BC_builder_v4/_source/bootclean/js/core/parallax.js" 
// @koala-append "C:/xampp/htdocs/_www/_BC_builder_v4/_source/bootclean/js/core/inview.js" 
// @koala-append "C:/xampp/htdocs/_www/_BC_builder_v4/_source/bootclean/js/core/slick.js" 
// @koala-append "C:/xampp/htdocs/_www/_BC_builder_v4/_source/bootclean/js/core/modal.js" 

/*! modernizr 3.4.0 (Custom Build) | MIT *
 * https://modernizr.com/download/?-audio-backgroundsize-bgsizecover-borderradius-boxshadow-canvas-canvastext-cssanimations-cssgradients-csstransforms-csstransforms3d-csstransitions-fontface-inlinesvg-input-mediaqueries-opacity-postmessage-rgba-svg-textshadow-touchevents-video-domprefixes-hasevent-mq-prefixes-setclasses-shiv-testallprops-testprop-teststyles !*/
!function(e,t,n){function r(e,t){return typeof e===t}function a(){var e,t,n,a,o,i,s;for(var c in T)if(T.hasOwnProperty(c)){if(e=[],t=T[c],t.name&&(e.push(t.name.toLowerCase()),t.options&&t.options.aliases&&t.options.aliases.length))for(n=0;n<t.options.aliases.length;n++)e.push(t.options.aliases[n].toLowerCase());for(a=r(t.fn,"function")?t.fn():t.fn,o=0;o<e.length;o++)i=e[o],s=i.split("."),1===s.length?Modernizr[s[0]]=a:(!Modernizr[s[0]]||Modernizr[s[0]]instanceof Boolean||(Modernizr[s[0]]=new Boolean(Modernizr[s[0]])),Modernizr[s[0]][s[1]]=a),b.push((a?"":"no-")+s.join("-"))}}function o(e){var t=S.className,n=Modernizr._config.classPrefix||"";if(C&&(t=t.baseVal),Modernizr._config.enableJSClass){var r=new RegExp("(^|\\s)"+n+"no-js(\\s|$)");t=t.replace(r,"$1"+n+"js$2")}Modernizr._config.enableClasses&&(t+=" "+n+e.join(" "+n),C?S.className.baseVal=t:S.className=t)}function i(){return"function"!=typeof t.createElement?t.createElement(arguments[0]):C?t.createElementNS.call(t,"http://www.w3.org/2000/svg",arguments[0]):t.createElement.apply(t,arguments)}function s(){var e=t.body;return e||(e=i(C?"svg":"body"),e.fake=!0),e}function c(e,n,r,a){var o,c,l,u,d="modernizr",f=i("div"),p=s();if(parseInt(r,10))for(;r--;)l=i("div"),l.id=a?a[r]:d+(r+1),f.appendChild(l);return o=i("style"),o.type="text/css",o.id="s"+d,(p.fake?p:f).appendChild(o),p.appendChild(f),o.styleSheet?o.styleSheet.cssText=e:o.appendChild(t.createTextNode(e)),f.id=d,p.fake&&(p.style.background="",p.style.overflow="hidden",u=S.style.overflow,S.style.overflow="hidden",S.appendChild(p)),c=n(f,e),p.fake?(p.parentNode.removeChild(p),S.style.overflow=u,S.offsetHeight):f.parentNode.removeChild(f),!!c}function l(e,t){return!!~(""+e).indexOf(t)}function u(e){return e.replace(/([a-z])-([a-z])/g,function(e,t,n){return t+n.toUpperCase()}).replace(/^-/,"")}function d(e,t){return function(){return e.apply(t,arguments)}}function f(e,t,n){var a;for(var o in e)if(e[o]in t)return n===!1?e[o]:(a=t[e[o]],r(a,"function")?d(a,n||t):a);return!1}function p(e){return e.replace(/([A-Z])/g,function(e,t){return"-"+t.toLowerCase()}).replace(/^ms-/,"-ms-")}function m(t,n,r){var a;if("getComputedStyle"in e){a=getComputedStyle.call(e,t,n);var o=e.console;if(null!==a)r&&(a=a.getPropertyValue(r));else if(o){var i=o.error?"error":"log";o[i].call(o,"getComputedStyle returning null, its possible modernizr test results are inaccurate")}}else a=!n&&t.currentStyle&&t.currentStyle[r];return a}function g(t,r){var a=t.length;if("CSS"in e&&"supports"in e.CSS){for(;a--;)if(e.CSS.supports(p(t[a]),r))return!0;return!1}if("CSSSupportsRule"in e){for(var o=[];a--;)o.push("("+p(t[a])+":"+r+")");return o=o.join(" or "),c("@supports ("+o+") { #modernizr { position: absolute; } }",function(e){return"absolute"==m(e,null,"position")})}return n}function v(e,t,a,o){function s(){d&&(delete D.style,delete D.modElem)}if(o=r(o,"undefined")?!1:o,!r(a,"undefined")){var c=g(e,a);if(!r(c,"undefined"))return c}for(var d,f,p,m,v,h=["modernizr","tspan","samp"];!D.style&&h.length;)d=!0,D.modElem=i(h.shift()),D.style=D.modElem.style;for(p=e.length,f=0;p>f;f++)if(m=e[f],v=D.style[m],l(m,"-")&&(m=u(m)),D.style[m]!==n){if(o||r(a,"undefined"))return s(),"pfx"==t?m:!0;try{D.style[m]=a}catch(y){}if(D.style[m]!=v)return s(),"pfx"==t?m:!0}return s(),!1}function h(e,t,n,a,o){var i=e.charAt(0).toUpperCase()+e.slice(1),s=(e+" "+R.join(i+" ")+i).split(" ");return r(t,"string")||r(t,"undefined")?v(s,t,a,o):(s=(e+" "+P.join(i+" ")+i).split(" "),f(s,t,n))}function y(e,t,r){return h(e,n,n,t,r)}var b=[],T=[],x={_version:"3.4.0",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,t){var n=this;setTimeout(function(){t(n[e])},0)},addTest:function(e,t,n){T.push({name:e,fn:t,options:n})},addAsyncTest:function(e){T.push({name:null,fn:e})}},Modernizr=function(){};Modernizr.prototype=x,Modernizr=new Modernizr,Modernizr.addTest("postmessage","postMessage"in e),Modernizr.addTest("svg",!!t.createElementNS&&!!t.createElementNS("http://www.w3.org/2000/svg","svg").createSVGRect);var w=x._config.usePrefixes?" -webkit- -moz- -o- -ms- ".split(" "):["",""];x._prefixes=w;var S=t.documentElement,C="svg"===S.nodeName.toLowerCase();C||!function(e,t){function n(e,t){var n=e.createElement("p"),r=e.getElementsByTagName("head")[0]||e.documentElement;return n.innerHTML="x<style>"+t+"</style>",r.insertBefore(n.lastChild,r.firstChild)}function r(){var e=b.elements;return"string"==typeof e?e.split(" "):e}function a(e,t){var n=b.elements;"string"!=typeof n&&(n=n.join(" ")),"string"!=typeof e&&(e=e.join(" ")),b.elements=n+" "+e,l(t)}function o(e){var t=y[e[v]];return t||(t={},h++,e[v]=h,y[h]=t),t}function i(e,n,r){if(n||(n=t),d)return n.createElement(e);r||(r=o(n));var a;return a=r.cache[e]?r.cache[e].cloneNode():g.test(e)?(r.cache[e]=r.createElem(e)).cloneNode():r.createElem(e),!a.canHaveChildren||m.test(e)||a.tagUrn?a:r.frag.appendChild(a)}function s(e,n){if(e||(e=t),d)return e.createDocumentFragment();n=n||o(e);for(var a=n.frag.cloneNode(),i=0,s=r(),c=s.length;c>i;i++)a.createElement(s[i]);return a}function c(e,t){t.cache||(t.cache={},t.createElem=e.createElement,t.createFrag=e.createDocumentFragment,t.frag=t.createFrag()),e.createElement=function(n){return b.shivMethods?i(n,e,t):t.createElem(n)},e.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+r().join().replace(/[\w\-:]+/g,function(e){return t.createElem(e),t.frag.createElement(e),'c("'+e+'")'})+");return n}")(b,t.frag)}function l(e){e||(e=t);var r=o(e);return!b.shivCSS||u||r.hasCSS||(r.hasCSS=!!n(e,"article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}")),d||c(e,r),e}var u,d,f="3.7.3",p=e.html5||{},m=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,g=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,v="_html5shiv",h=0,y={};!function(){try{var e=t.createElement("a");e.innerHTML="<xyz></xyz>",u="hidden"in e,d=1==e.childNodes.length||function(){t.createElement("a");var e=t.createDocumentFragment();return"undefined"==typeof e.cloneNode||"undefined"==typeof e.createDocumentFragment||"undefined"==typeof e.createElement}()}catch(n){u=!0,d=!0}}();var b={elements:p.elements||"abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output picture progress section summary template time video",version:f,shivCSS:p.shivCSS!==!1,supportsUnknownElements:d,shivMethods:p.shivMethods!==!1,type:"default",shivDocument:l,createElement:i,createDocumentFragment:s,addElements:a};e.html5=b,l(t),"object"==typeof module&&module.exports&&(module.exports=b)}("undefined"!=typeof e?e:this,t);var E="Moz O ms Webkit",P=x._config.usePrefixes?E.toLowerCase().split(" "):[];x._domPrefixes=P;var z=function(){function e(e,t){var a;return e?(t&&"string"!=typeof t||(t=i(t||"div")),e="on"+e,a=e in t,!a&&r&&(t.setAttribute||(t=i("div")),t.setAttribute(e,""),a="function"==typeof t[e],t[e]!==n&&(t[e]=n),t.removeAttribute(e)),a):!1}var r=!("onblur"in t.documentElement);return e}();x.hasEvent=z,Modernizr.addTest("audio",function(){var e=i("audio"),t=!1;try{t=!!e.canPlayType,t&&(t=new Boolean(t),t.ogg=e.canPlayType('audio/ogg; codecs="vorbis"').replace(/^no$/,""),t.mp3=e.canPlayType('audio/mpeg; codecs="mp3"').replace(/^no$/,""),t.opus=e.canPlayType('audio/ogg; codecs="opus"')||e.canPlayType('audio/webm; codecs="opus"').replace(/^no$/,""),t.wav=e.canPlayType('audio/wav; codecs="1"').replace(/^no$/,""),t.m4a=(e.canPlayType("audio/x-m4a;")||e.canPlayType("audio/aac;")).replace(/^no$/,""))}catch(n){}return t}),Modernizr.addTest("canvas",function(){var e=i("canvas");return!(!e.getContext||!e.getContext("2d"))}),Modernizr.addTest("canvastext",function(){return Modernizr.canvas===!1?!1:"function"==typeof i("canvas").getContext("2d").fillText}),Modernizr.addTest("video",function(){var e=i("video"),t=!1;try{t=!!e.canPlayType,t&&(t=new Boolean(t),t.ogg=e.canPlayType('video/ogg; codecs="theora"').replace(/^no$/,""),t.h264=e.canPlayType('video/mp4; codecs="avc1.42E01E"').replace(/^no$/,""),t.webm=e.canPlayType('video/webm; codecs="vp8, vorbis"').replace(/^no$/,""),t.vp9=e.canPlayType('video/webm; codecs="vp9"').replace(/^no$/,""),t.hls=e.canPlayType('application/x-mpegURL; codecs="avc1.42E01E"').replace(/^no$/,""))}catch(n){}return t}),Modernizr.addTest("cssgradients",function(){for(var e,t="background-image:",n="gradient(linear,left top,right bottom,from(#9f9),to(white));",r="",a=0,o=w.length-1;o>a;a++)e=0===a?"to ":"",r+=t+w[a]+"linear-gradient("+e+"left top, #9f9, white);";Modernizr._config.usePrefixes&&(r+=t+"-webkit-"+n);var s=i("a"),c=s.style;return c.cssText=r,(""+c.backgroundImage).indexOf("gradient")>-1}),Modernizr.addTest("opacity",function(){var e=i("a").style;return e.cssText=w.join("opacity:.55;"),/^0.55$/.test(e.opacity)}),Modernizr.addTest("rgba",function(){var e=i("a").style;return e.cssText="background-color:rgba(150,255,150,.5)",(""+e.backgroundColor).indexOf("rgba")>-1}),Modernizr.addTest("inlinesvg",function(){var e=i("div");return e.innerHTML="<svg/>","http://www.w3.org/2000/svg"==("undefined"!=typeof SVGRect&&e.firstChild&&e.firstChild.namespaceURI)});var _=i("input"),k="autocomplete autofocus list placeholder max min multiple pattern required step".split(" "),N={};Modernizr.input=function(t){for(var n=0,r=t.length;r>n;n++)N[t[n]]=!!(t[n]in _);return N.list&&(N.list=!(!i("datalist")||!e.HTMLDataListElement)),N}(k);var $="CSS"in e&&"supports"in e.CSS,j="supportsCSS"in e;Modernizr.addTest("supports",$||j);var M=function(){var t=e.matchMedia||e.msMatchMedia;return t?function(e){var n=t(e);return n&&n.matches||!1}:function(t){var n=!1;return c("@media "+t+" { #modernizr { position: absolute; } }",function(t){n="absolute"==(e.getComputedStyle?e.getComputedStyle(t,null):t.currentStyle).position}),n}}();x.mq=M,Modernizr.addTest("mediaqueries",M("only all"));var A=x.testStyles=c;Modernizr.addTest("touchevents",function(){var n;if("ontouchstart"in e||e.DocumentTouch&&t instanceof DocumentTouch)n=!0;else{var r=["@media (",w.join("touch-enabled),("),"heartz",")","{#modernizr{top:9px;position:absolute}}"].join("");A(r,function(e){n=9===e.offsetTop})}return n});var F=function(){var e=navigator.userAgent,t=e.match(/w(eb)?osbrowser/gi),n=e.match(/windows phone/gi)&&e.match(/iemobile\/([0-9])+/gi)&&parseFloat(RegExp.$1)>=9;return t||n}();F?Modernizr.addTest("fontface",!1):A('@font-face {font-family:"font";src:url("https://")}',function(e,n){var r=t.getElementById("smodernizr"),a=r.sheet||r.styleSheet,o=a?a.cssRules&&a.cssRules[0]?a.cssRules[0].cssText:a.cssText||"":"",i=/src/i.test(o)&&0===o.indexOf(n.split(" ")[0]);Modernizr.addTest("fontface",i)});var R=x._config.usePrefixes?E.split(" "):[];x._cssomPrefixes=R;var L={elem:i("modernizr")};Modernizr._q.push(function(){delete L.elem});var D={style:L.elem.style};Modernizr._q.unshift(function(){delete D.style});var q=x.testProp=function(e,t,r){return v([e],n,t,r)};Modernizr.addTest("textshadow",q("textShadow","1px 1px")),x.testAllProps=h,x.testAllProps=y,Modernizr.addTest("cssanimations",y("animationName","a",!0)),Modernizr.addTest("backgroundsize",y("backgroundSize","100%",!0)),Modernizr.addTest("borderradius",y("borderRadius","0px",!0)),Modernizr.addTest("boxshadow",y("boxShadow","1px 1px",!0)),Modernizr.addTest("csstransforms",function(){return-1===navigator.userAgent.indexOf("Android 2.")&&y("transform","scale(1)",!0)}),Modernizr.addTest("csstransforms3d",function(){var e=!!y("perspective","1px",!0),t=Modernizr._config.usePrefixes;if(e&&(!t||"webkitPerspective"in S.style)){var n,r="#modernizr{width:0;height:0}";Modernizr.supports?n="@supports (perspective: 1px)":(n="@media (transform-3d)",t&&(n+=",(-webkit-transform-3d)")),n+="{#modernizr{width:7px;height:18px;margin:0;padding:0;border:0}}",A(r+n,function(t){e=7===t.offsetWidth&&18===t.offsetHeight})}return e}),Modernizr.addTest("csstransitions",y("transition","all",!0)),Modernizr.addTest("bgsizecover",y("backgroundSize","cover")),a(),o(b),delete x.addTest,delete x.addAsyncTest;for(var O=0;O<Modernizr._q.length;O++)Modernizr._q[O]();e.Modernizr=Modernizr}(window,document);

/*
     _ _      _       _
 ___| (_) ___| | __  (_)___
/ __| | |/ __| |/ /  | / __|
\__ \ | | (__|   < _ | \__ \
|___/_|_|\___|_|\_(_)/ |___/
                   |__/

 Version: 1.9.0
  Author: Ken Wheeler
 Website: http://kenwheeler.github.io
    Docs: http://kenwheeler.github.io/slick
    Repo: http://github.com/kenwheeler/slick
  Issues: http://github.com/kenwheeler/slick/issues

 */
/* global window, document, define, jQuery, setInterval, clearInterval */
;(function(factory) {
    'use strict';
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof exports !== 'undefined') {
        module.exports = factory(require('jquery'));
    } else {
        factory(jQuery);
    }

}(function($) {
    'use strict';
    var Slick = window.Slick || {};

    Slick = (function() {

        var instanceUid = 0;

        function Slick(element, settings) {

            var _ = this, dataSettings;

            _.defaults = {
                accessibility: true,
                adaptiveHeight: false,
                appendArrows: $(element),
                appendDots: $(element),
                arrows: true,
                asNavFor: null,
                prevArrow: '<button class="slick-prev" aria-label="Previous" type="button">Previous</button>',
                nextArrow: '<button class="slick-next" aria-label="Next" type="button">Next</button>',
                autoplay: false,
                autoplaySpeed: 3000,
                centerMode: false,
                centerPadding: '50px',
                cssEase: 'ease',
                customPaging: function(slider, i) {
                    return $('<button type="button" />').text(i + 1);
                },
                dots: false,
                dotsClass: 'slick-dots',
                draggable: true,
                easing: 'linear',
                edgeFriction: 0.35,
                fade: false,
                focusOnSelect: false,
                focusOnChange: false,
                infinite: true,
                initialSlide: 0,
                lazyLoad: 'ondemand',
                mobileFirst: false,
                pauseOnHover: true,
                pauseOnFocus: true,
                pauseOnDotsHover: false,
                respondTo: 'window',
                responsive: null,
                rows: 1,
                rtl: false,
                slide: '',
                slidesPerRow: 1,
                slidesToShow: 1,
                slidesToScroll: 1,
                speed: 500,
                swipe: true,
                swipeToSlide: false,
                touchMove: true,
                touchThreshold: 5,
                useCSS: true,
                useTransform: true,
                variableWidth: false,
                vertical: false,
                verticalSwiping: false,
                waitForAnimate: true,
                zIndex: 1000
            };

            _.initials = {
                animating: false,
                dragging: false,
                autoPlayTimer: null,
                currentDirection: 0,
                currentLeft: null,
                currentSlide: 0,
                direction: 1,
                $dots: null,
                listWidth: null,
                listHeight: null,
                loadIndex: 0,
                $nextArrow: null,
                $prevArrow: null,
                scrolling: false,
                slideCount: null,
                slideWidth: null,
                $slideTrack: null,
                $slides: null,
                sliding: false,
                slideOffset: 0,
                swipeLeft: null,
                swiping: false,
                $list: null,
                touchObject: {},
                transformsEnabled: false,
                unslicked: false
            };

            $.extend(_, _.initials);

            _.activeBreakpoint = null;
            _.animType = null;
            _.animProp = null;
            _.breakpoints = [];
            _.breakpointSettings = [];
            _.cssTransitions = false;
            _.focussed = false;
            _.interrupted = false;
            _.hidden = 'hidden';
            _.paused = true;
            _.positionProp = null;
            _.respondTo = null;
            _.rowCount = 1;
            _.shouldClick = true;
            _.$slider = $(element);
            _.$slidesCache = null;
            _.transformType = null;
            _.transitionType = null;
            _.visibilityChange = 'visibilitychange';
            _.windowWidth = 0;
            _.windowTimer = null;

            dataSettings = $(element).data('slick') || {};

            _.options = $.extend({}, _.defaults, settings, dataSettings);

            _.currentSlide = _.options.initialSlide;

            _.originalSettings = _.options;

            if (typeof document.mozHidden !== 'undefined') {
                _.hidden = 'mozHidden';
                _.visibilityChange = 'mozvisibilitychange';
            } else if (typeof document.webkitHidden !== 'undefined') {
                _.hidden = 'webkitHidden';
                _.visibilityChange = 'webkitvisibilitychange';
            }

            _.autoPlay = $.proxy(_.autoPlay, _);
            _.autoPlayClear = $.proxy(_.autoPlayClear, _);
            _.autoPlayIterator = $.proxy(_.autoPlayIterator, _);
            _.changeSlide = $.proxy(_.changeSlide, _);
            _.clickHandler = $.proxy(_.clickHandler, _);
            _.selectHandler = $.proxy(_.selectHandler, _);
            _.setPosition = $.proxy(_.setPosition, _);
            _.swipeHandler = $.proxy(_.swipeHandler, _);
            _.dragHandler = $.proxy(_.dragHandler, _);
            _.keyHandler = $.proxy(_.keyHandler, _);

            _.instanceUid = instanceUid++;

            // A simple way to check for HTML strings
            // Strict HTML recognition (must start with <)
            // Extracted from jQuery v1.11 source
            _.htmlExpr = /^(?:\s*(<[\w\W]+>)[^>]*)$/;


            _.registerBreakpoints();
            _.init(true);

        }

        return Slick;

    }());

    Slick.prototype.activateADA = function() {
        var _ = this;

        _.$slideTrack.find('.slick-active').attr({
            'aria-hidden': 'false'
        }).find('a, input, button, select').attr({
            'tabindex': '0'
        });

    };

    Slick.prototype.addSlide = Slick.prototype.slickAdd = function(markup, index, addBefore) {

        var _ = this;

        if (typeof(index) === 'boolean') {
            addBefore = index;
            index = null;
        } else if (index < 0 || (index >= _.slideCount)) {
            return false;
        }

        _.unload();

        if (typeof(index) === 'number') {
            if (index === 0 && _.$slides.length === 0) {
                $(markup).appendTo(_.$slideTrack);
            } else if (addBefore) {
                $(markup).insertBefore(_.$slides.eq(index));
            } else {
                $(markup).insertAfter(_.$slides.eq(index));
            }
        } else {
            if (addBefore === true) {
                $(markup).prependTo(_.$slideTrack);
            } else {
                $(markup).appendTo(_.$slideTrack);
            }
        }

        _.$slides = _.$slideTrack.children(this.options.slide);

        _.$slideTrack.children(this.options.slide).detach();

        _.$slideTrack.append(_.$slides);

        _.$slides.each(function(index, element) {
            $(element).attr('data-slick-index', index);
        });

        _.$slidesCache = _.$slides;

        _.reinit();

    };

    Slick.prototype.animateHeight = function() {
        var _ = this;
        if (_.options.slidesToShow === 1 && _.options.adaptiveHeight === true && _.options.vertical === false) {
            var targetHeight = _.$slides.eq(_.currentSlide).outerHeight(true);
            _.$list.animate({
                height: targetHeight
            }, _.options.speed);
        }
    };

    Slick.prototype.animateSlide = function(targetLeft, callback) {

        var animProps = {},
            _ = this;

        _.animateHeight();

        if (_.options.rtl === true && _.options.vertical === false) {
            targetLeft = -targetLeft;
        }
        if (_.transformsEnabled === false) {
            if (_.options.vertical === false) {
                _.$slideTrack.animate({
                    left: targetLeft
                }, _.options.speed, _.options.easing, callback);
            } else {
                _.$slideTrack.animate({
                    top: targetLeft
                }, _.options.speed, _.options.easing, callback);
            }

        } else {

            if (_.cssTransitions === false) {
                if (_.options.rtl === true) {
                    _.currentLeft = -(_.currentLeft);
                }
                $({
                    animStart: _.currentLeft
                }).animate({
                    animStart: targetLeft
                }, {
                    duration: _.options.speed,
                    easing: _.options.easing,
                    step: function(now) {
                        now = Math.ceil(now);
                        if (_.options.vertical === false) {
                            animProps[_.animType] = 'translate(' +
                                now + 'px, 0px)';
                            _.$slideTrack.css(animProps);
                        } else {
                            animProps[_.animType] = 'translate(0px,' +
                                now + 'px)';
                            _.$slideTrack.css(animProps);
                        }
                    },
                    complete: function() {
                        if (callback) {
                            callback.call();
                        }
                    }
                });

            } else {

                _.applyTransition();
                targetLeft = Math.ceil(targetLeft);

                if (_.options.vertical === false) {
                    animProps[_.animType] = 'translate3d(' + targetLeft + 'px, 0px, 0px)';
                } else {
                    animProps[_.animType] = 'translate3d(0px,' + targetLeft + 'px, 0px)';
                }
                _.$slideTrack.css(animProps);

                if (callback) {
                    setTimeout(function() {

                        _.disableTransition();

                        callback.call();
                    }, _.options.speed);
                }

            }

        }

    };

    Slick.prototype.getNavTarget = function() {

        var _ = this,
            asNavFor = _.options.asNavFor;

        if ( asNavFor && asNavFor !== null ) {
            asNavFor = $(asNavFor).not(_.$slider);
        }

        return asNavFor;

    };

    Slick.prototype.asNavFor = function(index) {

        var _ = this,
            asNavFor = _.getNavTarget();

        if ( asNavFor !== null && typeof asNavFor === 'object' ) {
            asNavFor.each(function() {
                var target = $(this).slick('getSlick');
                if(!target.unslicked) {
                    target.slideHandler(index, true);
                }
            });
        }

    };

    Slick.prototype.applyTransition = function(slide) {

        var _ = this,
            transition = {};

        if (_.options.fade === false) {
            transition[_.transitionType] = _.transformType + ' ' + _.options.speed + 'ms ' + _.options.cssEase;
        } else {
            transition[_.transitionType] = 'opacity ' + _.options.speed + 'ms ' + _.options.cssEase;
        }

        if (_.options.fade === false) {
            _.$slideTrack.css(transition);
        } else {
            _.$slides.eq(slide).css(transition);
        }

    };

    Slick.prototype.autoPlay = function() {

        var _ = this;

        _.autoPlayClear();

        if ( _.slideCount > _.options.slidesToShow ) {
            _.autoPlayTimer = setInterval( _.autoPlayIterator, _.options.autoplaySpeed );
        }

    };

    Slick.prototype.autoPlayClear = function() {

        var _ = this;

        if (_.autoPlayTimer) {
            clearInterval(_.autoPlayTimer);
        }

    };

    Slick.prototype.autoPlayIterator = function() {

        var _ = this,
            slideTo = _.currentSlide + _.options.slidesToScroll;

        if ( !_.paused && !_.interrupted && !_.focussed ) {

            if ( _.options.infinite === false ) {

                if ( _.direction === 1 && ( _.currentSlide + 1 ) === ( _.slideCount - 1 )) {
                    _.direction = 0;
                }

                else if ( _.direction === 0 ) {

                    slideTo = _.currentSlide - _.options.slidesToScroll;

                    if ( _.currentSlide - 1 === 0 ) {
                        _.direction = 1;
                    }

                }

            }

            _.slideHandler( slideTo );

        }

    };

    Slick.prototype.buildArrows = function() {

        var _ = this;

        if (_.options.arrows === true ) {

            _.$prevArrow = $(_.options.prevArrow).addClass('slick-arrow');
            _.$nextArrow = $(_.options.nextArrow).addClass('slick-arrow');

            if( _.slideCount > _.options.slidesToShow ) {

                _.$prevArrow.removeClass('slick-hidden').removeAttr('aria-hidden tabindex');
                _.$nextArrow.removeClass('slick-hidden').removeAttr('aria-hidden tabindex');

                if (_.htmlExpr.test(_.options.prevArrow)) {
                    _.$prevArrow.prependTo(_.options.appendArrows);
                }

                if (_.htmlExpr.test(_.options.nextArrow)) {
                    _.$nextArrow.appendTo(_.options.appendArrows);
                }

                if (_.options.infinite !== true) {
                    _.$prevArrow
                        .addClass('slick-disabled')
                        .attr('aria-disabled', 'true');
                }

            } else {

                _.$prevArrow.add( _.$nextArrow )

                    .addClass('slick-hidden')
                    .attr({
                        'aria-disabled': 'true',
                        'tabindex': '-1'
                    });

            }

        }

    };

    Slick.prototype.buildDots = function() {

        var _ = this,
            i, dot;

        if (_.options.dots === true && _.slideCount > _.options.slidesToShow) {

            _.$slider.addClass('slick-dotted');

            dot = $('<ul />').addClass(_.options.dotsClass);

            for (i = 0; i <= _.getDotCount(); i += 1) {
                dot.append($('<li />').append(_.options.customPaging.call(this, _, i)));
            }

            _.$dots = dot.appendTo(_.options.appendDots);

            _.$dots.find('li').first().addClass('slick-active');

        }

    };

    Slick.prototype.buildOut = function() {

        var _ = this;

        _.$slides =
            _.$slider
                .children( _.options.slide + ':not(.slick-cloned)')
                .addClass('slick-slide');

        _.slideCount = _.$slides.length;

        _.$slides.each(function(index, element) {
            $(element)
                .attr('data-slick-index', index)
                .data('originalStyling', $(element).attr('style') || '');
        });

        _.$slider.addClass('slick-slider');

        _.$slideTrack = (_.slideCount === 0) ?
            $('<div class="slick-track"/>').appendTo(_.$slider) :
            _.$slides.wrapAll('<div class="slick-track"/>').parent();

        _.$list = _.$slideTrack.wrap(
            '<div class="slick-list"/>').parent();
        _.$slideTrack.css('opacity', 0);

        if (_.options.centerMode === true || _.options.swipeToSlide === true) {
            _.options.slidesToScroll = 1;
        }

        $('img[data-lazy]', _.$slider).not('[src]').addClass('slick-loading');

        _.setupInfinite();

        _.buildArrows();

        _.buildDots();

        _.updateDots();


        _.setSlideClasses(typeof _.currentSlide === 'number' ? _.currentSlide : 0);

        if (_.options.draggable === true) {
            _.$list.addClass('draggable');
        }

    };

    Slick.prototype.buildRows = function() {

        var _ = this, a, b, c, newSlides, numOfSlides, originalSlides,slidesPerSection;

        newSlides = document.createDocumentFragment();
        originalSlides = _.$slider.children();

        if(_.options.rows > 0) {

            slidesPerSection = _.options.slidesPerRow * _.options.rows;
            numOfSlides = Math.ceil(
                originalSlides.length / slidesPerSection
            );

            for(a = 0; a < numOfSlides; a++){
                var slide = document.createElement('div');
                for(b = 0; b < _.options.rows; b++) {
                    var row = document.createElement('div');
                    for(c = 0; c < _.options.slidesPerRow; c++) {
                        var target = (a * slidesPerSection + ((b * _.options.slidesPerRow) + c));
                        if (originalSlides.get(target)) {
                            row.appendChild(originalSlides.get(target));
                        }
                    }
                    slide.appendChild(row);
                }
                newSlides.appendChild(slide);
            }

            _.$slider.empty().append(newSlides);
            _.$slider.children().children().children()
                .css({
                    'width':(100 / _.options.slidesPerRow) + '%',
                    'display': 'inline-block'
                });

        }

    };

    Slick.prototype.checkResponsive = function(initial, forceUpdate) {

        var _ = this,
            breakpoint, targetBreakpoint, respondToWidth, triggerBreakpoint = false;
        var sliderWidth = _.$slider.width();
        var windowWidth = window.innerWidth || $(window).width();

        if (_.respondTo === 'window') {
            respondToWidth = windowWidth;
        } else if (_.respondTo === 'slider') {
            respondToWidth = sliderWidth;
        } else if (_.respondTo === 'min') {
            respondToWidth = Math.min(windowWidth, sliderWidth);
        }

        if ( _.options.responsive &&
            _.options.responsive.length &&
            _.options.responsive !== null) {

            targetBreakpoint = null;

            for (breakpoint in _.breakpoints) {
                if (_.breakpoints.hasOwnProperty(breakpoint)) {
                    if (_.originalSettings.mobileFirst === false) {
                        if (respondToWidth < _.breakpoints[breakpoint]) {
                            targetBreakpoint = _.breakpoints[breakpoint];
                        }
                    } else {
                        if (respondToWidth > _.breakpoints[breakpoint]) {
                            targetBreakpoint = _.breakpoints[breakpoint];
                        }
                    }
                }
            }

            if (targetBreakpoint !== null) {
                if (_.activeBreakpoint !== null) {
                    if (targetBreakpoint !== _.activeBreakpoint || forceUpdate) {
                        _.activeBreakpoint =
                            targetBreakpoint;
                        if (_.breakpointSettings[targetBreakpoint] === 'unslick') {
                            _.unslick(targetBreakpoint);
                        } else {
                            _.options = $.extend({}, _.originalSettings,
                                _.breakpointSettings[
                                    targetBreakpoint]);
                            if (initial === true) {
                                _.currentSlide = _.options.initialSlide;
                            }
                            _.refresh(initial);
                        }
                        triggerBreakpoint = targetBreakpoint;
                    }
                } else {
                    _.activeBreakpoint = targetBreakpoint;
                    if (_.breakpointSettings[targetBreakpoint] === 'unslick') {
                        _.unslick(targetBreakpoint);
                    } else {
                        _.options = $.extend({}, _.originalSettings,
                            _.breakpointSettings[
                                targetBreakpoint]);
                        if (initial === true) {
                            _.currentSlide = _.options.initialSlide;
                        }
                        _.refresh(initial);
                    }
                    triggerBreakpoint = targetBreakpoint;
                }
            } else {
                if (_.activeBreakpoint !== null) {
                    _.activeBreakpoint = null;
                    _.options = _.originalSettings;
                    if (initial === true) {
                        _.currentSlide = _.options.initialSlide;
                    }
                    _.refresh(initial);
                    triggerBreakpoint = targetBreakpoint;
                }
            }

            // only trigger breakpoints during an actual break. not on initialize.
            if( !initial && triggerBreakpoint !== false ) {
                _.$slider.trigger('breakpoint', [_, triggerBreakpoint]);
            }
        }

    };

    Slick.prototype.changeSlide = function(event, dontAnimate) {

        var _ = this,
            $target = $(event.currentTarget),
            indexOffset, slideOffset, unevenOffset;

        // If target is a link, prevent default action.
        if($target.is('a')) {
            event.preventDefault();
        }

        // If target is not the <li> element (ie: a child), find the <li>.
        if(!$target.is('li')) {
            $target = $target.closest('li');
        }

        unevenOffset = (_.slideCount % _.options.slidesToScroll !== 0);
        indexOffset = unevenOffset ? 0 : (_.slideCount - _.currentSlide) % _.options.slidesToScroll;

        switch (event.data.message) {

            case 'previous':
                slideOffset = indexOffset === 0 ? _.options.slidesToScroll : _.options.slidesToShow - indexOffset;
                if (_.slideCount > _.options.slidesToShow) {
                    _.slideHandler(_.currentSlide - slideOffset, false, dontAnimate);
                }
                break;

            case 'next':
                slideOffset = indexOffset === 0 ? _.options.slidesToScroll : indexOffset;
                if (_.slideCount > _.options.slidesToShow) {
                    _.slideHandler(_.currentSlide + slideOffset, false, dontAnimate);
                }
                break;

            case 'index':
                var index = event.data.index === 0 ? 0 :
                    event.data.index || $target.index() * _.options.slidesToScroll;

                _.slideHandler(_.checkNavigable(index), false, dontAnimate);
                $target.children().trigger('focus');
                break;

            default:
                return;
        }

    };

    Slick.prototype.checkNavigable = function(index) {

        var _ = this,
            navigables, prevNavigable;

        navigables = _.getNavigableIndexes();
        prevNavigable = 0;
        if (index > navigables[navigables.length - 1]) {
            index = navigables[navigables.length - 1];
        } else {
            for (var n in navigables) {
                if (index < navigables[n]) {
                    index = prevNavigable;
                    break;
                }
                prevNavigable = navigables[n];
            }
        }

        return index;
    };

    Slick.prototype.cleanUpEvents = function() {

        var _ = this;

        if (_.options.dots && _.$dots !== null) {

            $('li', _.$dots)
                .off('click.slick', _.changeSlide)
                .off('mouseenter.slick', $.proxy(_.interrupt, _, true))
                .off('mouseleave.slick', $.proxy(_.interrupt, _, false));

            if (_.options.accessibility === true) {
                _.$dots.off('keydown.slick', _.keyHandler);
            }
        }

        _.$slider.off('focus.slick blur.slick');

        if (_.options.arrows === true && _.slideCount > _.options.slidesToShow) {
            _.$prevArrow && _.$prevArrow.off('click.slick', _.changeSlide);
            _.$nextArrow && _.$nextArrow.off('click.slick', _.changeSlide);

            if (_.options.accessibility === true) {
                _.$prevArrow && _.$prevArrow.off('keydown.slick', _.keyHandler);
                _.$nextArrow && _.$nextArrow.off('keydown.slick', _.keyHandler);
            }
        }

        _.$list.off('touchstart.slick mousedown.slick', _.swipeHandler);
        _.$list.off('touchmove.slick mousemove.slick', _.swipeHandler);
        _.$list.off('touchend.slick mouseup.slick', _.swipeHandler);
        _.$list.off('touchcancel.slick mouseleave.slick', _.swipeHandler);

        _.$list.off('click.slick', _.clickHandler);

        $(document).off(_.visibilityChange, _.visibility);

        _.cleanUpSlideEvents();

        if (_.options.accessibility === true) {
            _.$list.off('keydown.slick', _.keyHandler);
        }

        if (_.options.focusOnSelect === true) {
            $(_.$slideTrack).children().off('click.slick', _.selectHandler);
        }

        $(window).off('orientationchange.slick.slick-' + _.instanceUid, _.orientationChange);

        $(window).off('resize.slick.slick-' + _.instanceUid, _.resize);

        $('[draggable!=true]', _.$slideTrack).off('dragstart', _.preventDefault);

        $(window).off('load.slick.slick-' + _.instanceUid, _.setPosition);

    };

    Slick.prototype.cleanUpSlideEvents = function() {

        var _ = this;

        _.$list.off('mouseenter.slick', $.proxy(_.interrupt, _, true));
        _.$list.off('mouseleave.slick', $.proxy(_.interrupt, _, false));

    };

    Slick.prototype.cleanUpRows = function() {

        var _ = this, originalSlides;

        if(_.options.rows > 0) {
            originalSlides = _.$slides.children().children();
            originalSlides.removeAttr('style');
            _.$slider.empty().append(originalSlides);
        }

    };

    Slick.prototype.clickHandler = function(event) {

        var _ = this;

        if (_.shouldClick === false) {
            event.stopImmediatePropagation();
            event.stopPropagation();
            event.preventDefault();
        }

    };

    Slick.prototype.destroy = function(refresh) {

        var _ = this;

        _.autoPlayClear();

        _.touchObject = {};

        _.cleanUpEvents();

        $('.slick-cloned', _.$slider).detach();

        if (_.$dots) {
            _.$dots.remove();
        }

        if ( _.$prevArrow && _.$prevArrow.length ) {

            _.$prevArrow
                .removeClass('slick-disabled slick-arrow slick-hidden')
                .removeAttr('aria-hidden aria-disabled tabindex')
                .css('display','');

            if ( _.htmlExpr.test( _.options.prevArrow )) {
                _.$prevArrow.remove();
            }
        }

        if ( _.$nextArrow && _.$nextArrow.length ) {

            _.$nextArrow
                .removeClass('slick-disabled slick-arrow slick-hidden')
                .removeAttr('aria-hidden aria-disabled tabindex')
                .css('display','');

            if ( _.htmlExpr.test( _.options.nextArrow )) {
                _.$nextArrow.remove();
            }
        }


        if (_.$slides) {

            _.$slides
                .removeClass('slick-slide slick-active slick-center slick-visible slick-current')
                .removeAttr('aria-hidden')
                .removeAttr('data-slick-index')
                .each(function(){
                    $(this).attr('style', $(this).data('originalStyling'));
                });

            _.$slideTrack.children(this.options.slide).detach();

            _.$slideTrack.detach();

            _.$list.detach();

            _.$slider.append(_.$slides);
        }

        _.cleanUpRows();

        _.$slider.removeClass('slick-slider');
        _.$slider.removeClass('slick-initialized');
        _.$slider.removeClass('slick-dotted');

        _.unslicked = true;

        if(!refresh) {
            _.$slider.trigger('destroy', [_]);
        }

    };

    Slick.prototype.disableTransition = function(slide) {

        var _ = this,
            transition = {};

        transition[_.transitionType] = '';

        if (_.options.fade === false) {
            _.$slideTrack.css(transition);
        } else {
            _.$slides.eq(slide).css(transition);
        }

    };

    Slick.prototype.fadeSlide = function(slideIndex, callback) {

        var _ = this;

        if (_.cssTransitions === false) {

            _.$slides.eq(slideIndex).css({
                zIndex: _.options.zIndex
            });

            _.$slides.eq(slideIndex).animate({
                opacity: 1
            }, _.options.speed, _.options.easing, callback);

        } else {

            _.applyTransition(slideIndex);

            _.$slides.eq(slideIndex).css({
                opacity: 1,
                zIndex: _.options.zIndex
            });

            if (callback) {
                setTimeout(function() {

                    _.disableTransition(slideIndex);

                    callback.call();
                }, _.options.speed);
            }

        }

    };

    Slick.prototype.fadeSlideOut = function(slideIndex) {

        var _ = this;

        if (_.cssTransitions === false) {

            _.$slides.eq(slideIndex).animate({
                opacity: 0,
                zIndex: _.options.zIndex - 2
            }, _.options.speed, _.options.easing);

        } else {

            _.applyTransition(slideIndex);

            _.$slides.eq(slideIndex).css({
                opacity: 0,
                zIndex: _.options.zIndex - 2
            });

        }

    };

    Slick.prototype.filterSlides = Slick.prototype.slickFilter = function(filter) {

        var _ = this;

        if (filter !== null) {

            _.$slidesCache = _.$slides;

            _.unload();

            _.$slideTrack.children(this.options.slide).detach();

            _.$slidesCache.filter(filter).appendTo(_.$slideTrack);

            _.reinit();

        }

    };

    Slick.prototype.focusHandler = function() {

        var _ = this;

        // If any child element receives focus within the slider we need to pause the autoplay
        _.$slider
            .off('focus.slick blur.slick')
            .on(
                'focus.slick',
                '*',
                function(event) {
                    var $sf = $(this);

                    setTimeout(function() {
                        if( _.options.pauseOnFocus ) {
                            if ($sf.is(':focus')) {
                                _.focussed = true;
                                _.autoPlay();
                            }
                        }
                    }, 0);
                }
            ).on(
                'blur.slick',
                '*',
                function(event) {
                    var $sf = $(this);

                    // When a blur occurs on any elements within the slider we become unfocused
                    if( _.options.pauseOnFocus ) {
                        _.focussed = false;
                        _.autoPlay();
                    }
                }
            );
    };

    Slick.prototype.getCurrent = Slick.prototype.slickCurrentSlide = function() {

        var _ = this;
        return _.currentSlide;

    };

    Slick.prototype.getDotCount = function() {

        var _ = this;

        var breakPoint = 0;
        var counter = 0;
        var pagerQty = 0;

        if (_.options.infinite === true) {
            if (_.slideCount <= _.options.slidesToShow) {
                 ++pagerQty;
            } else {
                while (breakPoint < _.slideCount) {
                    ++pagerQty;
                    breakPoint = counter + _.options.slidesToScroll;
                    counter += _.options.slidesToScroll <= _.options.slidesToShow ? _.options.slidesToScroll : _.options.slidesToShow;
                }
            }
        } else if (_.options.centerMode === true) {
            pagerQty = _.slideCount;
        } else if(!_.options.asNavFor) {
            pagerQty = 1 + Math.ceil((_.slideCount - _.options.slidesToShow) / _.options.slidesToScroll);
        }else {
            while (breakPoint < _.slideCount) {
                ++pagerQty;
                breakPoint = counter + _.options.slidesToScroll;
                counter += _.options.slidesToScroll <= _.options.slidesToShow ? _.options.slidesToScroll : _.options.slidesToShow;
            }
        }

        return pagerQty - 1;

    };

    Slick.prototype.getLeft = function(slideIndex) {

        var _ = this,
            targetLeft,
            verticalHeight,
            verticalOffset = 0,
            targetSlide,
            coef;

        _.slideOffset = 0;
        verticalHeight = _.$slides.first().outerHeight(true);

        if (_.options.infinite === true) {
            if (_.slideCount > _.options.slidesToShow) {
                _.slideOffset = (_.slideWidth * _.options.slidesToShow) * -1;
                coef = -1

                if (_.options.vertical === true && _.options.centerMode === true) {
                    if (_.options.slidesToShow === 2) {
                        coef = -1.5;
                    } else if (_.options.slidesToShow === 1) {
                        coef = -2
                    }
                }
                verticalOffset = (verticalHeight * _.options.slidesToShow) * coef;
            }
            if (_.slideCount % _.options.slidesToScroll !== 0) {
                if (slideIndex + _.options.slidesToScroll > _.slideCount && _.slideCount > _.options.slidesToShow) {
                    if (slideIndex > _.slideCount) {
                        _.slideOffset = ((_.options.slidesToShow - (slideIndex - _.slideCount)) * _.slideWidth) * -1;
                        verticalOffset = ((_.options.slidesToShow - (slideIndex - _.slideCount)) * verticalHeight) * -1;
                    } else {
                        _.slideOffset = ((_.slideCount % _.options.slidesToScroll) * _.slideWidth) * -1;
                        verticalOffset = ((_.slideCount % _.options.slidesToScroll) * verticalHeight) * -1;
                    }
                }
            }
        } else {
            if (slideIndex + _.options.slidesToShow > _.slideCount) {
                _.slideOffset = ((slideIndex + _.options.slidesToShow) - _.slideCount) * _.slideWidth;
                verticalOffset = ((slideIndex + _.options.slidesToShow) - _.slideCount) * verticalHeight;
            }
        }

        if (_.slideCount <= _.options.slidesToShow) {
            _.slideOffset = 0;
            verticalOffset = 0;
        }

        if (_.options.centerMode === true && _.slideCount <= _.options.slidesToShow) {
            _.slideOffset = ((_.slideWidth * Math.floor(_.options.slidesToShow)) / 2) - ((_.slideWidth * _.slideCount) / 2);
        } else if (_.options.centerMode === true && _.options.infinite === true) {
            _.slideOffset += _.slideWidth * Math.floor(_.options.slidesToShow / 2) - _.slideWidth;
        } else if (_.options.centerMode === true) {
            _.slideOffset = 0;
            _.slideOffset += _.slideWidth * Math.floor(_.options.slidesToShow / 2);
        }

        if (_.options.vertical === false) {
            targetLeft = ((slideIndex * _.slideWidth) * -1) + _.slideOffset;
        } else {
            targetLeft = ((slideIndex * verticalHeight) * -1) + verticalOffset;
        }

        if (_.options.variableWidth === true) {

            if (_.slideCount <= _.options.slidesToShow || _.options.infinite === false) {
                targetSlide = _.$slideTrack.children('.slick-slide').eq(slideIndex);
            } else {
                targetSlide = _.$slideTrack.children('.slick-slide').eq(slideIndex + _.options.slidesToShow);
            }

            if (_.options.rtl === true) {
                if (targetSlide[0]) {
                    targetLeft = (_.$slideTrack.width() - targetSlide[0].offsetLeft - targetSlide.width()) * -1;
                } else {
                    targetLeft =  0;
                }
            } else {
                targetLeft = targetSlide[0] ? targetSlide[0].offsetLeft * -1 : 0;
            }

            if (_.options.centerMode === true) {
                if (_.slideCount <= _.options.slidesToShow || _.options.infinite === false) {
                    targetSlide = _.$slideTrack.children('.slick-slide').eq(slideIndex);
                } else {
                    targetSlide = _.$slideTrack.children('.slick-slide').eq(slideIndex + _.options.slidesToShow + 1);
                }

                if (_.options.rtl === true) {
                    if (targetSlide[0]) {
                        targetLeft = (_.$slideTrack.width() - targetSlide[0].offsetLeft - targetSlide.width()) * -1;
                    } else {
                        targetLeft =  0;
                    }
                } else {
                    targetLeft = targetSlide[0] ? targetSlide[0].offsetLeft * -1 : 0;
                }

                targetLeft += (_.$list.width() - targetSlide.outerWidth()) / 2;
            }
        }

        return targetLeft;

    };

    Slick.prototype.getOption = Slick.prototype.slickGetOption = function(option) {

        var _ = this;

        return _.options[option];

    };

    Slick.prototype.getNavigableIndexes = function() {

        var _ = this,
            breakPoint = 0,
            counter = 0,
            indexes = [],
            max;

        if (_.options.infinite === false) {
            max = _.slideCount;
        } else {
            breakPoint = _.options.slidesToScroll * -1;
            counter = _.options.slidesToScroll * -1;
            max = _.slideCount * 2;
        }

        while (breakPoint < max) {
            indexes.push(breakPoint);
            breakPoint = counter + _.options.slidesToScroll;
            counter += _.options.slidesToScroll <= _.options.slidesToShow ? _.options.slidesToScroll : _.options.slidesToShow;
        }

        return indexes;

    };

    Slick.prototype.getSlick = function() {

        return this;

    };

    Slick.prototype.getSlideCount = function() {

        var _ = this,
            slidesTraversed, swipedSlide, swipeTarget, centerOffset;

        centerOffset = _.options.centerMode === true ? Math.floor(_.$list.width() / 2) : 0;
        swipeTarget = (_.swipeLeft * -1) + centerOffset;

        if (_.options.swipeToSlide === true) {

            _.$slideTrack.find('.slick-slide').each(function(index, slide) {

                var slideOuterWidth, slideOffset, slideRightBoundary;
                slideOuterWidth = $(slide).outerWidth();
                slideOffset = slide.offsetLeft;
                if (_.options.centerMode !== true) {
                    slideOffset += (slideOuterWidth / 2);
                }

                slideRightBoundary = slideOffset + (slideOuterWidth);

                if (swipeTarget < slideRightBoundary) {
                    swipedSlide = slide;
                    return false;
                }
            });

            slidesTraversed = Math.abs($(swipedSlide).attr('data-slick-index') - _.currentSlide) || 1;

            return slidesTraversed;

        } else {
            return _.options.slidesToScroll;
        }

    };

    Slick.prototype.goTo = Slick.prototype.slickGoTo = function(slide, dontAnimate) {

        var _ = this;

        _.changeSlide({
            data: {
                message: 'index',
                index: parseInt(slide)
            }
        }, dontAnimate);

    };

    Slick.prototype.init = function(creation) {

        var _ = this;

        if (!$(_.$slider).hasClass('slick-initialized')) {

            $(_.$slider).addClass('slick-initialized');

            _.buildRows();
            _.buildOut();
            _.setProps();
            _.startLoad();
            _.loadSlider();
            _.initializeEvents();
            _.updateArrows();
            _.updateDots();
            _.checkResponsive(true);
            _.focusHandler();

        }

        if (creation) {
            _.$slider.trigger('init', [_]);
        }

        if (_.options.accessibility === true) {
            _.initADA();
        }

        if ( _.options.autoplay ) {

            _.paused = false;
            _.autoPlay();

        }

    };

    Slick.prototype.initADA = function() {
        var _ = this,
                numDotGroups = Math.ceil(_.slideCount / _.options.slidesToShow),
                tabControlIndexes = _.getNavigableIndexes().filter(function(val) {
                    return (val >= 0) && (val < _.slideCount);
                });

        _.$slides.add(_.$slideTrack.find('.slick-cloned')).attr({
            'aria-hidden': 'true',
            'tabindex': '-1'
        }).find('a, input, button, select').attr({
            'tabindex': '-1'
        });

        if (_.$dots !== null) {
            _.$slides.not(_.$slideTrack.find('.slick-cloned')).each(function(i) {
                var slideControlIndex = tabControlIndexes.indexOf(i);

                $(this).attr({
                    'role': 'tabpanel',
                    'id': 'slick-slide' + _.instanceUid + i,
                    'tabindex': -1
                });

                if (slideControlIndex !== -1) {
                   var ariaButtonControl = 'slick-slide-control' + _.instanceUid + slideControlIndex
                   if ($('#' + ariaButtonControl).length) {
                     $(this).attr({
                         'aria-describedby': ariaButtonControl
                     });
                   }
                }
            });

            _.$dots.attr('role', 'tablist').find('li').each(function(i) {
                var mappedSlideIndex = tabControlIndexes[i];

                $(this).attr({
                    'role': 'presentation'
                });

                $(this).find('button').first().attr({
                    'role': 'tab',
                    'id': 'slick-slide-control' + _.instanceUid + i,
                    'aria-controls': 'slick-slide' + _.instanceUid + mappedSlideIndex,
                    'aria-label': (i + 1) + ' of ' + numDotGroups,
                    'aria-selected': null,
                    'tabindex': '-1'
                });

            }).eq(_.currentSlide).find('button').attr({
                'aria-selected': 'true',
                'tabindex': '0'
            }).end();
        }

        for (var i=_.currentSlide, max=i+_.options.slidesToShow; i < max; i++) {
          if (_.options.focusOnChange) {
            _.$slides.eq(i).attr({'tabindex': '0'});
          } else {
            _.$slides.eq(i).removeAttr('tabindex');
          }
        }

        _.activateADA();

    };

    Slick.prototype.initArrowEvents = function() {

        var _ = this;

        if (_.options.arrows === true && _.slideCount > _.options.slidesToShow) {
            _.$prevArrow
               .off('click.slick')
               .on('click.slick', {
                    message: 'previous'
               }, _.changeSlide);
            _.$nextArrow
               .off('click.slick')
               .on('click.slick', {
                    message: 'next'
               }, _.changeSlide);

            if (_.options.accessibility === true) {
                _.$prevArrow.on('keydown.slick', _.keyHandler);
                _.$nextArrow.on('keydown.slick', _.keyHandler);
            }
        }

    };

    Slick.prototype.initDotEvents = function() {

        var _ = this;

        if (_.options.dots === true && _.slideCount > _.options.slidesToShow) {
            $('li', _.$dots).on('click.slick', {
                message: 'index'
            }, _.changeSlide);

            if (_.options.accessibility === true) {
                _.$dots.on('keydown.slick', _.keyHandler);
            }
        }

        if (_.options.dots === true && _.options.pauseOnDotsHover === true && _.slideCount > _.options.slidesToShow) {

            $('li', _.$dots)
                .on('mouseenter.slick', $.proxy(_.interrupt, _, true))
                .on('mouseleave.slick', $.proxy(_.interrupt, _, false));

        }

    };

    Slick.prototype.initSlideEvents = function() {

        var _ = this;

        if ( _.options.pauseOnHover ) {

            _.$list.on('mouseenter.slick', $.proxy(_.interrupt, _, true));
            _.$list.on('mouseleave.slick', $.proxy(_.interrupt, _, false));

        }

    };

    Slick.prototype.initializeEvents = function() {

        var _ = this;

        _.initArrowEvents();

        _.initDotEvents();
        _.initSlideEvents();

        _.$list.on('touchstart.slick mousedown.slick', {
            action: 'start'
        }, _.swipeHandler);
        _.$list.on('touchmove.slick mousemove.slick', {
            action: 'move'
        }, _.swipeHandler);
        _.$list.on('touchend.slick mouseup.slick', {
            action: 'end'
        }, _.swipeHandler);
        _.$list.on('touchcancel.slick mouseleave.slick', {
            action: 'end'
        }, _.swipeHandler);

        _.$list.on('click.slick', _.clickHandler);

        $(document).on(_.visibilityChange, $.proxy(_.visibility, _));

        if (_.options.accessibility === true) {
            _.$list.on('keydown.slick', _.keyHandler);
        }

        if (_.options.focusOnSelect === true) {
            $(_.$slideTrack).children().on('click.slick', _.selectHandler);
        }

        $(window).on('orientationchange.slick.slick-' + _.instanceUid, $.proxy(_.orientationChange, _));

        $(window).on('resize.slick.slick-' + _.instanceUid, $.proxy(_.resize, _));

        $('[draggable!=true]', _.$slideTrack).on('dragstart', _.preventDefault);

        $(window).on('load.slick.slick-' + _.instanceUid, _.setPosition);
        $(_.setPosition);

    };

    Slick.prototype.initUI = function() {

        var _ = this;

        if (_.options.arrows === true && _.slideCount > _.options.slidesToShow) {

            _.$prevArrow.show();
            _.$nextArrow.show();

        }

        if (_.options.dots === true && _.slideCount > _.options.slidesToShow) {

            _.$dots.show();

        }

    };

    Slick.prototype.keyHandler = function(event) {

        var _ = this;
         //Dont slide if the cursor is inside the form fields and arrow keys are pressed
        if(!event.target.tagName.match('TEXTAREA|INPUT|SELECT')) {
            if (event.keyCode === 37 && _.options.accessibility === true) {
                _.changeSlide({
                    data: {
                        message: _.options.rtl === true ? 'next' :  'previous'
                    }
                });
            } else if (event.keyCode === 39 && _.options.accessibility === true) {
                _.changeSlide({
                    data: {
                        message: _.options.rtl === true ? 'previous' : 'next'
                    }
                });
            }
        }

    };

    Slick.prototype.lazyLoad = function() {

        var _ = this,
            loadRange, cloneRange, rangeStart, rangeEnd;

        function loadImages(imagesScope) {

            $('img[data-lazy]', imagesScope).each(function() {

                var image = $(this),
                    imageSource = $(this).attr('data-lazy'),
                    imageSrcSet = $(this).attr('data-srcset'),
                    imageSizes  = $(this).attr('data-sizes') || _.$slider.attr('data-sizes'),
                    imageToLoad = document.createElement('img');

                imageToLoad.onload = function() {

                    image
                        .animate({ opacity: 0 }, 100, function() {

                            if (imageSrcSet) {
                                image
                                    .attr('srcset', imageSrcSet );

                                if (imageSizes) {
                                    image
                                        .attr('sizes', imageSizes );
                                }
                            }

                            image
                                .attr('src', imageSource)
                                .animate({ opacity: 1 }, 200, function() {
                                    image
                                        .removeAttr('data-lazy data-srcset data-sizes')
                                        .removeClass('slick-loading');
                                });
                            _.$slider.trigger('lazyLoaded', [_, image, imageSource]);
                        });

                };

                imageToLoad.onerror = function() {

                    image
                        .removeAttr( 'data-lazy' )
                        .removeClass( 'slick-loading' )
                        .addClass( 'slick-lazyload-error' );

                    _.$slider.trigger('lazyLoadError', [ _, image, imageSource ]);

                };

                imageToLoad.src = imageSource;

            });

        }

        if (_.options.centerMode === true) {
            if (_.options.infinite === true) {
                rangeStart = _.currentSlide + (_.options.slidesToShow / 2 + 1);
                rangeEnd = rangeStart + _.options.slidesToShow + 2;
            } else {
                rangeStart = Math.max(0, _.currentSlide - (_.options.slidesToShow / 2 + 1));
                rangeEnd = 2 + (_.options.slidesToShow / 2 + 1) + _.currentSlide;
            }
        } else {
            rangeStart = _.options.infinite ? _.options.slidesToShow + _.currentSlide : _.currentSlide;
            rangeEnd = Math.ceil(rangeStart + _.options.slidesToShow);
            if (_.options.fade === true) {
                if (rangeStart > 0) rangeStart--;
                if (rangeEnd <= _.slideCount) rangeEnd++;
            }
        }

        loadRange = _.$slider.find('.slick-slide').slice(rangeStart, rangeEnd);

        if (_.options.lazyLoad === 'anticipated') {
            var prevSlide = rangeStart - 1,
                nextSlide = rangeEnd,
                $slides = _.$slider.find('.slick-slide');

            for (var i = 0; i < _.options.slidesToScroll; i++) {
                if (prevSlide < 0) prevSlide = _.slideCount - 1;
                loadRange = loadRange.add($slides.eq(prevSlide));
                loadRange = loadRange.add($slides.eq(nextSlide));
                prevSlide--;
                nextSlide++;
            }
        }

        loadImages(loadRange);

        if (_.slideCount <= _.options.slidesToShow) {
            cloneRange = _.$slider.find('.slick-slide');
            loadImages(cloneRange);
        } else
        if (_.currentSlide >= _.slideCount - _.options.slidesToShow) {
            cloneRange = _.$slider.find('.slick-cloned').slice(0, _.options.slidesToShow);
            loadImages(cloneRange);
        } else if (_.currentSlide === 0) {
            cloneRange = _.$slider.find('.slick-cloned').slice(_.options.slidesToShow * -1);
            loadImages(cloneRange);
        }

    };

    Slick.prototype.loadSlider = function() {

        var _ = this;

        _.setPosition();

        _.$slideTrack.css({
            opacity: 1
        });

        _.$slider.removeClass('slick-loading');

        _.initUI();

        if (_.options.lazyLoad === 'progressive') {
            _.progressiveLazyLoad();
        }

    };

    Slick.prototype.next = Slick.prototype.slickNext = function() {

        var _ = this;

        _.changeSlide({
            data: {
                message: 'next'
            }
        });

    };

    Slick.prototype.orientationChange = function() {

        var _ = this;

        _.checkResponsive();
        _.setPosition();

    };

    Slick.prototype.pause = Slick.prototype.slickPause = function() {

        var _ = this;

        _.autoPlayClear();
        _.paused = true;

    };

    Slick.prototype.play = Slick.prototype.slickPlay = function() {

        var _ = this;

        _.autoPlay();
        _.options.autoplay = true;
        _.paused = false;
        _.focussed = false;
        _.interrupted = false;

    };

    Slick.prototype.postSlide = function(index) {

        var _ = this;

        if( !_.unslicked ) {

            _.$slider.trigger('afterChange', [_, index]);

            _.animating = false;

            if (_.slideCount > _.options.slidesToShow) {
                _.setPosition();
            }

            _.swipeLeft = null;

            if ( _.options.autoplay ) {
                _.autoPlay();
            }

            if (_.options.accessibility === true) {
                _.initADA();

                if (_.options.focusOnChange) {
                    var $currentSlide = $(_.$slides.get(_.currentSlide));
                    $currentSlide.attr('tabindex', 0).focus();
                }
            }

        }

    };

    Slick.prototype.prev = Slick.prototype.slickPrev = function() {

        var _ = this;

        _.changeSlide({
            data: {
                message: 'previous'
            }
        });

    };

    Slick.prototype.preventDefault = function(event) {

        event.preventDefault();

    };

    Slick.prototype.progressiveLazyLoad = function( tryCount ) {

        tryCount = tryCount || 1;

        var _ = this,
            $imgsToLoad = $( 'img[data-lazy]', _.$slider ),
            image,
            imageSource,
            imageSrcSet,
            imageSizes,
            imageToLoad;

        if ( $imgsToLoad.length ) {

            image = $imgsToLoad.first();
            imageSource = image.attr('data-lazy');
            imageSrcSet = image.attr('data-srcset');
            imageSizes  = image.attr('data-sizes') || _.$slider.attr('data-sizes');
            imageToLoad = document.createElement('img');

            imageToLoad.onload = function() {

                if (imageSrcSet) {
                    image
                        .attr('srcset', imageSrcSet );

                    if (imageSizes) {
                        image
                            .attr('sizes', imageSizes );
                    }
                }

                image
                    .attr( 'src', imageSource )
                    .removeAttr('data-lazy data-srcset data-sizes')
                    .removeClass('slick-loading');

                if ( _.options.adaptiveHeight === true ) {
                    _.setPosition();
                }

                _.$slider.trigger('lazyLoaded', [ _, image, imageSource ]);
                _.progressiveLazyLoad();

            };

            imageToLoad.onerror = function() {

                if ( tryCount < 3 ) {

                    /**
                     * try to load the image 3 times,
                     * leave a slight delay so we don't get
                     * servers blocking the request.
                     */
                    setTimeout( function() {
                        _.progressiveLazyLoad( tryCount + 1 );
                    }, 500 );

                } else {

                    image
                        .removeAttr( 'data-lazy' )
                        .removeClass( 'slick-loading' )
                        .addClass( 'slick-lazyload-error' );

                    _.$slider.trigger('lazyLoadError', [ _, image, imageSource ]);

                    _.progressiveLazyLoad();

                }

            };

            imageToLoad.src = imageSource;

        } else {

            _.$slider.trigger('allImagesLoaded', [ _ ]);

        }

    };

    Slick.prototype.refresh = function( initializing ) {

        var _ = this, currentSlide, lastVisibleIndex;

        lastVisibleIndex = _.slideCount - _.options.slidesToShow;

        // in non-infinite sliders, we don't want to go past the
        // last visible index.
        if( !_.options.infinite && ( _.currentSlide > lastVisibleIndex )) {
            _.currentSlide = lastVisibleIndex;
        }

        // if less slides than to show, go to start.
        if ( _.slideCount <= _.options.slidesToShow ) {
            _.currentSlide = 0;

        }

        currentSlide = _.currentSlide;

        _.destroy(true);

        $.extend(_, _.initials, { currentSlide: currentSlide });

        _.init();

        if( !initializing ) {

            _.changeSlide({
                data: {
                    message: 'index',
                    index: currentSlide
                }
            }, false);

        }

    };

    Slick.prototype.registerBreakpoints = function() {

        var _ = this, breakpoint, currentBreakpoint, l,
            responsiveSettings = _.options.responsive || null;

        if ( $.type(responsiveSettings) === 'array' && responsiveSettings.length ) {

            _.respondTo = _.options.respondTo || 'window';

            for ( breakpoint in responsiveSettings ) {

                l = _.breakpoints.length-1;

                if (responsiveSettings.hasOwnProperty(breakpoint)) {
                    currentBreakpoint = responsiveSettings[breakpoint].breakpoint;

                    // loop through the breakpoints and cut out any existing
                    // ones with the same breakpoint number, we don't want dupes.
                    while( l >= 0 ) {
                        if( _.breakpoints[l] && _.breakpoints[l] === currentBreakpoint ) {
                            _.breakpoints.splice(l,1);
                        }
                        l--;
                    }

                    _.breakpoints.push(currentBreakpoint);
                    _.breakpointSettings[currentBreakpoint] = responsiveSettings[breakpoint].settings;

                }

            }

            _.breakpoints.sort(function(a, b) {
                return ( _.options.mobileFirst ) ? a-b : b-a;
            });

        }

    };

    Slick.prototype.reinit = function() {

        var _ = this;

        _.$slides =
            _.$slideTrack
                .children(_.options.slide)
                .addClass('slick-slide');

        _.slideCount = _.$slides.length;

        if (_.currentSlide >= _.slideCount && _.currentSlide !== 0) {
            _.currentSlide = _.currentSlide - _.options.slidesToScroll;
        }

        if (_.slideCount <= _.options.slidesToShow) {
            _.currentSlide = 0;
        }

        _.registerBreakpoints();

        _.setProps();
        _.setupInfinite();
        _.buildArrows();
        _.updateArrows();
        _.initArrowEvents();
        _.buildDots();
        _.updateDots();
        _.initDotEvents();
        _.cleanUpSlideEvents();
        _.initSlideEvents();

        _.checkResponsive(false, true);

        if (_.options.focusOnSelect === true) {
            $(_.$slideTrack).children().on('click.slick', _.selectHandler);
        }

        _.setSlideClasses(typeof _.currentSlide === 'number' ? _.currentSlide : 0);

        _.setPosition();
        _.focusHandler();

        _.paused = !_.options.autoplay;
        _.autoPlay();

        _.$slider.trigger('reInit', [_]);

    };

    Slick.prototype.resize = function() {

        var _ = this;

        if ($(window).width() !== _.windowWidth) {
            clearTimeout(_.windowDelay);
            _.windowDelay = window.setTimeout(function() {
                _.windowWidth = $(window).width();
                _.checkResponsive();
                if( !_.unslicked ) { _.setPosition(); }
            }, 50);
        }
    };

    Slick.prototype.removeSlide = Slick.prototype.slickRemove = function(index, removeBefore, removeAll) {

        var _ = this;

        if (typeof(index) === 'boolean') {
            removeBefore = index;
            index = removeBefore === true ? 0 : _.slideCount - 1;
        } else {
            index = removeBefore === true ? --index : index;
        }

        if (_.slideCount < 1 || index < 0 || index > _.slideCount - 1) {
            return false;
        }

        _.unload();

        if (removeAll === true) {
            _.$slideTrack.children().remove();
        } else {
            _.$slideTrack.children(this.options.slide).eq(index).remove();
        }

        _.$slides = _.$slideTrack.children(this.options.slide);

        _.$slideTrack.children(this.options.slide).detach();

        _.$slideTrack.append(_.$slides);

        _.$slidesCache = _.$slides;

        _.reinit();

    };

    Slick.prototype.setCSS = function(position) {

        var _ = this,
            positionProps = {},
            x, y;

        if (_.options.rtl === true) {
            position = -position;
        }
        x = _.positionProp == 'left' ? Math.ceil(position) + 'px' : '0px';
        y = _.positionProp == 'top' ? Math.ceil(position) + 'px' : '0px';

        positionProps[_.positionProp] = position;

        if (_.transformsEnabled === false) {
            _.$slideTrack.css(positionProps);
        } else {
            positionProps = {};
            if (_.cssTransitions === false) {
                positionProps[_.animType] = 'translate(' + x + ', ' + y + ')';
                _.$slideTrack.css(positionProps);
            } else {
                positionProps[_.animType] = 'translate3d(' + x + ', ' + y + ', 0px)';
                _.$slideTrack.css(positionProps);
            }
        }

    };

    Slick.prototype.setDimensions = function() {

        var _ = this;

        if (_.options.vertical === false) {
            if (_.options.centerMode === true) {
                _.$list.css({
                    padding: ('0px ' + _.options.centerPadding)
                });
            }
        } else {
            _.$list.height(_.$slides.first().outerHeight(true) * _.options.slidesToShow);
            if (_.options.centerMode === true) {
                _.$list.css({
                    padding: (_.options.centerPadding + ' 0px')
                });
            }
        }

        _.listWidth = _.$list.width();
        _.listHeight = _.$list.height();


        if (_.options.vertical === false && _.options.variableWidth === false) {
            _.slideWidth = Math.ceil(_.listWidth / _.options.slidesToShow);
            _.$slideTrack.width(Math.ceil((_.slideWidth * _.$slideTrack.children('.slick-slide').length)));

        } else if (_.options.variableWidth === true) {
            _.$slideTrack.width(5000 * _.slideCount);
        } else {
            _.slideWidth = Math.ceil(_.listWidth);
            _.$slideTrack.height(Math.ceil((_.$slides.first().outerHeight(true) * _.$slideTrack.children('.slick-slide').length)));
        }

        var offset = _.$slides.first().outerWidth(true) - _.$slides.first().width();
        if (_.options.variableWidth === false) _.$slideTrack.children('.slick-slide').width(_.slideWidth - offset);

    };

    Slick.prototype.setFade = function() {

        var _ = this,
            targetLeft;

        _.$slides.each(function(index, element) {
            targetLeft = (_.slideWidth * index) * -1;
            if (_.options.rtl === true) {
                $(element).css({
                    position: 'relative',
                    right: targetLeft,
                    top: 0,
                    zIndex: _.options.zIndex - 2,
                    opacity: 0
                });
            } else {
                $(element).css({
                    position: 'relative',
                    left: targetLeft,
                    top: 0,
                    zIndex: _.options.zIndex - 2,
                    opacity: 0
                });
            }
        });

        _.$slides.eq(_.currentSlide).css({
            zIndex: _.options.zIndex - 1,
            opacity: 1
        });

    };

    Slick.prototype.setHeight = function() {

        var _ = this;

        if (_.options.slidesToShow === 1 && _.options.adaptiveHeight === true && _.options.vertical === false) {
            var targetHeight = _.$slides.eq(_.currentSlide).outerHeight(true);
            _.$list.css('height', targetHeight);
        }

    };

    Slick.prototype.setOption =
    Slick.prototype.slickSetOption = function() {

        /**
         * accepts arguments in format of:
         *
         *  - for changing a single option's value:
         *     .slick("setOption", option, value, refresh )
         *
         *  - for changing a set of responsive options:
         *     .slick("setOption", 'responsive', [{}, ...], refresh )
         *
         *  - for updating multiple values at once (not responsive)
         *     .slick("setOption", { 'option': value, ... }, refresh )
         */

        var _ = this, l, item, option, value, refresh = false, type;

        if( $.type( arguments[0] ) === 'object' ) {

            option =  arguments[0];
            refresh = arguments[1];
            type = 'multiple';

        } else if ( $.type( arguments[0] ) === 'string' ) {

            option =  arguments[0];
            value = arguments[1];
            refresh = arguments[2];

            if ( arguments[0] === 'responsive' && $.type( arguments[1] ) === 'array' ) {

                type = 'responsive';

            } else if ( typeof arguments[1] !== 'undefined' ) {

                type = 'single';

            }

        }

        if ( type === 'single' ) {

            _.options[option] = value;


        } else if ( type === 'multiple' ) {

            $.each( option , function( opt, val ) {

                _.options[opt] = val;

            });


        } else if ( type === 'responsive' ) {

            for ( item in value ) {

                if( $.type( _.options.responsive ) !== 'array' ) {

                    _.options.responsive = [ value[item] ];

                } else {

                    l = _.options.responsive.length-1;

                    // loop through the responsive object and splice out duplicates.
                    while( l >= 0 ) {

                        if( _.options.responsive[l].breakpoint === value[item].breakpoint ) {

                            _.options.responsive.splice(l,1);

                        }

                        l--;

                    }

                    _.options.responsive.push( value[item] );

                }

            }

        }

        if ( refresh ) {

            _.unload();
            _.reinit();

        }

    };

    Slick.prototype.setPosition = function() {

        var _ = this;

        _.setDimensions();

        _.setHeight();

        if (_.options.fade === false) {
            _.setCSS(_.getLeft(_.currentSlide));
        } else {
            _.setFade();
        }

        _.$slider.trigger('setPosition', [_]);

    };

    Slick.prototype.setProps = function() {

        var _ = this,
            bodyStyle = document.body.style;

        _.positionProp = _.options.vertical === true ? 'top' : 'left';

        if (_.positionProp === 'top') {
            _.$slider.addClass('slick-vertical');
        } else {
            _.$slider.removeClass('slick-vertical');
        }

        if (bodyStyle.WebkitTransition !== undefined ||
            bodyStyle.MozTransition !== undefined ||
            bodyStyle.msTransition !== undefined) {
            if (_.options.useCSS === true) {
                _.cssTransitions = true;
            }
        }

        if ( _.options.fade ) {
            if ( typeof _.options.zIndex === 'number' ) {
                if( _.options.zIndex < 3 ) {
                    _.options.zIndex = 3;
                }
            } else {
                _.options.zIndex = _.defaults.zIndex;
            }
        }

        if (bodyStyle.OTransform !== undefined) {
            _.animType = 'OTransform';
            _.transformType = '-o-transform';
            _.transitionType = 'OTransition';
            if (bodyStyle.perspectiveProperty === undefined && bodyStyle.webkitPerspective === undefined) _.animType = false;
        }
        if (bodyStyle.MozTransform !== undefined) {
            _.animType = 'MozTransform';
            _.transformType = '-moz-transform';
            _.transitionType = 'MozTransition';
            if (bodyStyle.perspectiveProperty === undefined && bodyStyle.MozPerspective === undefined) _.animType = false;
        }
        if (bodyStyle.webkitTransform !== undefined) {
            _.animType = 'webkitTransform';
            _.transformType = '-webkit-transform';
            _.transitionType = 'webkitTransition';
            if (bodyStyle.perspectiveProperty === undefined && bodyStyle.webkitPerspective === undefined) _.animType = false;
        }
        if (bodyStyle.msTransform !== undefined) {
            _.animType = 'msTransform';
            _.transformType = '-ms-transform';
            _.transitionType = 'msTransition';
            if (bodyStyle.msTransform === undefined) _.animType = false;
        }
        if (bodyStyle.transform !== undefined && _.animType !== false) {
            _.animType = 'transform';
            _.transformType = 'transform';
            _.transitionType = 'transition';
        }
        _.transformsEnabled = _.options.useTransform && (_.animType !== null && _.animType !== false);
    };


    Slick.prototype.setSlideClasses = function(index) {

        var _ = this,
            centerOffset, allSlides, indexOffset, remainder;

        allSlides = _.$slider
            .find('.slick-slide')
            .removeClass('slick-active slick-center slick-current')
            .attr('aria-hidden', 'true');

        _.$slides
            .eq(index)
            .addClass('slick-current');

        if (_.options.centerMode === true) {

            var evenCoef = _.options.slidesToShow % 2 === 0 ? 1 : 0;

            centerOffset = Math.floor(_.options.slidesToShow / 2);

            if (_.options.infinite === true) {

                if (index >= centerOffset && index <= (_.slideCount - 1) - centerOffset) {
                    _.$slides
                        .slice(index - centerOffset + evenCoef, index + centerOffset + 1)
                        .addClass('slick-active')
                        .attr('aria-hidden', 'false');

                } else {

                    indexOffset = _.options.slidesToShow + index;
                    allSlides
                        .slice(indexOffset - centerOffset + 1 + evenCoef, indexOffset + centerOffset + 2)
                        .addClass('slick-active')
                        .attr('aria-hidden', 'false');

                }

                if (index === 0) {

                    allSlides
                        .eq(allSlides.length - 1 - _.options.slidesToShow)
                        .addClass('slick-center');

                } else if (index === _.slideCount - 1) {

                    allSlides
                        .eq(_.options.slidesToShow)
                        .addClass('slick-center');

                }

            }

            _.$slides
                .eq(index)
                .addClass('slick-center');

        } else {

            if (index >= 0 && index <= (_.slideCount - _.options.slidesToShow)) {

                _.$slides
                    .slice(index, index + _.options.slidesToShow)
                    .addClass('slick-active')
                    .attr('aria-hidden', 'false');

            } else if (allSlides.length <= _.options.slidesToShow) {

                allSlides
                    .addClass('slick-active')
                    .attr('aria-hidden', 'false');

            } else {

                remainder = _.slideCount % _.options.slidesToShow;
                indexOffset = _.options.infinite === true ? _.options.slidesToShow + index : index;

                if (_.options.slidesToShow == _.options.slidesToScroll && (_.slideCount - index) < _.options.slidesToShow) {

                    allSlides
                        .slice(indexOffset - (_.options.slidesToShow - remainder), indexOffset + remainder)
                        .addClass('slick-active')
                        .attr('aria-hidden', 'false');

                } else {

                    allSlides
                        .slice(indexOffset, indexOffset + _.options.slidesToShow)
                        .addClass('slick-active')
                        .attr('aria-hidden', 'false');

                }

            }

        }

        if (_.options.lazyLoad === 'ondemand' || _.options.lazyLoad === 'anticipated') {
            _.lazyLoad();
        }
    };

    Slick.prototype.setupInfinite = function() {

        var _ = this,
            i, slideIndex, infiniteCount;

        if (_.options.fade === true) {
            _.options.centerMode = false;
        }

        if (_.options.infinite === true && _.options.fade === false) {

            slideIndex = null;

            if (_.slideCount > _.options.slidesToShow) {

                if (_.options.centerMode === true) {
                    infiniteCount = _.options.slidesToShow + 1;
                } else {
                    infiniteCount = _.options.slidesToShow;
                }

                for (i = _.slideCount; i > (_.slideCount -
                        infiniteCount); i -= 1) {
                    slideIndex = i - 1;
                    $(_.$slides[slideIndex]).clone(true).attr('id', '')
                        .attr('data-slick-index', slideIndex - _.slideCount)
                        .prependTo(_.$slideTrack).addClass('slick-cloned');
                }
                for (i = 0; i < infiniteCount  + _.slideCount; i += 1) {
                    slideIndex = i;
                    $(_.$slides[slideIndex]).clone(true).attr('id', '')
                        .attr('data-slick-index', slideIndex + _.slideCount)
                        .appendTo(_.$slideTrack).addClass('slick-cloned');
                }
                _.$slideTrack.find('.slick-cloned').find('[id]').each(function() {
                    $(this).attr('id', '');
                });

            }

        }

    };

    Slick.prototype.interrupt = function( toggle ) {

        var _ = this;

        if( !toggle ) {
            _.autoPlay();
        }
        _.interrupted = toggle;

    };

    Slick.prototype.selectHandler = function(event) {

        var _ = this;

        var targetElement =
            $(event.target).is('.slick-slide') ?
                $(event.target) :
                $(event.target).parents('.slick-slide');

        var index = parseInt(targetElement.attr('data-slick-index'));

        if (!index) index = 0;

        if (_.slideCount <= _.options.slidesToShow) {

            _.slideHandler(index, false, true);
            return;

        }

        _.slideHandler(index);

    };

    Slick.prototype.slideHandler = function(index, sync, dontAnimate) {

        var targetSlide, animSlide, oldSlide, slideLeft, targetLeft = null,
            _ = this, navTarget;

        sync = sync || false;

        if (_.animating === true && _.options.waitForAnimate === true) {
            return;
        }

        if (_.options.fade === true && _.currentSlide === index) {
            return;
        }

        if (sync === false) {
            _.asNavFor(index);
        }

        targetSlide = index;
        targetLeft = _.getLeft(targetSlide);
        slideLeft = _.getLeft(_.currentSlide);

        _.currentLeft = _.swipeLeft === null ? slideLeft : _.swipeLeft;

        if (_.options.infinite === false && _.options.centerMode === false && (index < 0 || index > _.getDotCount() * _.options.slidesToScroll)) {
            if (_.options.fade === false) {
                targetSlide = _.currentSlide;
                if (dontAnimate !== true && _.slideCount > _.options.slidesToShow) {
                    _.animateSlide(slideLeft, function() {
                        _.postSlide(targetSlide);
                    });
                } else {
                    _.postSlide(targetSlide);
                }
            }
            return;
        } else if (_.options.infinite === false && _.options.centerMode === true && (index < 0 || index > (_.slideCount - _.options.slidesToScroll))) {
            if (_.options.fade === false) {
                targetSlide = _.currentSlide;
                if (dontAnimate !== true && _.slideCount > _.options.slidesToShow) {
                    _.animateSlide(slideLeft, function() {
                        _.postSlide(targetSlide);
                    });
                } else {
                    _.postSlide(targetSlide);
                }
            }
            return;
        }

        if ( _.options.autoplay ) {
            clearInterval(_.autoPlayTimer);
        }

        if (targetSlide < 0) {
            if (_.slideCount % _.options.slidesToScroll !== 0) {
                animSlide = _.slideCount - (_.slideCount % _.options.slidesToScroll);
            } else {
                animSlide = _.slideCount + targetSlide;
            }
        } else if (targetSlide >= _.slideCount) {
            if (_.slideCount % _.options.slidesToScroll !== 0) {
                animSlide = 0;
            } else {
                animSlide = targetSlide - _.slideCount;
            }
        } else {
            animSlide = targetSlide;
        }

        _.animating = true;

        _.$slider.trigger('beforeChange', [_, _.currentSlide, animSlide]);

        oldSlide = _.currentSlide;
        _.currentSlide = animSlide;

        _.setSlideClasses(_.currentSlide);

        if ( _.options.asNavFor ) {

            navTarget = _.getNavTarget();
            navTarget = navTarget.slick('getSlick');

            if ( navTarget.slideCount <= navTarget.options.slidesToShow ) {
                navTarget.setSlideClasses(_.currentSlide);
            }

        }

        _.updateDots();
        _.updateArrows();

        if (_.options.fade === true) {
            if (dontAnimate !== true) {

                _.fadeSlideOut(oldSlide);

                _.fadeSlide(animSlide, function() {
                    _.postSlide(animSlide);
                });

            } else {
                _.postSlide(animSlide);
            }
            _.animateHeight();
            return;
        }

        if (dontAnimate !== true && _.slideCount > _.options.slidesToShow) {
            _.animateSlide(targetLeft, function() {
                _.postSlide(animSlide);
            });
        } else {
            _.postSlide(animSlide);
        }

    };

    Slick.prototype.startLoad = function() {

        var _ = this;

        if (_.options.arrows === true && _.slideCount > _.options.slidesToShow) {

            _.$prevArrow.hide();
            _.$nextArrow.hide();

        }

        if (_.options.dots === true && _.slideCount > _.options.slidesToShow) {

            _.$dots.hide();

        }

        _.$slider.addClass('slick-loading');

    };

    Slick.prototype.swipeDirection = function() {

        var xDist, yDist, r, swipeAngle, _ = this;

        xDist = _.touchObject.startX - _.touchObject.curX;
        yDist = _.touchObject.startY - _.touchObject.curY;
        r = Math.atan2(yDist, xDist);

        swipeAngle = Math.round(r * 180 / Math.PI);
        if (swipeAngle < 0) {
            swipeAngle = 360 - Math.abs(swipeAngle);
        }

        if ((swipeAngle <= 45) && (swipeAngle >= 0)) {
            return (_.options.rtl === false ? 'left' : 'right');
        }
        if ((swipeAngle <= 360) && (swipeAngle >= 315)) {
            return (_.options.rtl === false ? 'left' : 'right');
        }
        if ((swipeAngle >= 135) && (swipeAngle <= 225)) {
            return (_.options.rtl === false ? 'right' : 'left');
        }
        if (_.options.verticalSwiping === true) {
            if ((swipeAngle >= 35) && (swipeAngle <= 135)) {
                return 'down';
            } else {
                return 'up';
            }
        }

        return 'vertical';

    };

    Slick.prototype.swipeEnd = function(event) {

        var _ = this,
            slideCount,
            direction;

        _.dragging = false;
        _.swiping = false;

        if (_.scrolling) {
            _.scrolling = false;
            return false;
        }

        _.interrupted = false;
        _.shouldClick = ( _.touchObject.swipeLength > 10 ) ? false : true;

        if ( _.touchObject.curX === undefined ) {
            return false;
        }

        if ( _.touchObject.edgeHit === true ) {
            _.$slider.trigger('edge', [_, _.swipeDirection() ]);
        }

        if ( _.touchObject.swipeLength >= _.touchObject.minSwipe ) {

            direction = _.swipeDirection();

            switch ( direction ) {

                case 'left':
                case 'down':

                    slideCount =
                        _.options.swipeToSlide ?
                            _.checkNavigable( _.currentSlide + _.getSlideCount() ) :
                            _.currentSlide + _.getSlideCount();

                    _.currentDirection = 0;

                    break;

                case 'right':
                case 'up':

                    slideCount =
                        _.options.swipeToSlide ?
                            _.checkNavigable( _.currentSlide - _.getSlideCount() ) :
                            _.currentSlide - _.getSlideCount();

                    _.currentDirection = 1;

                    break;

                default:


            }

            if( direction != 'vertical' ) {

                _.slideHandler( slideCount );
                _.touchObject = {};
                _.$slider.trigger('swipe', [_, direction ]);

            }

        } else {

            if ( _.touchObject.startX !== _.touchObject.curX ) {

                _.slideHandler( _.currentSlide );
                _.touchObject = {};

            }

        }

    };

    Slick.prototype.swipeHandler = function(event) {

        var _ = this;

        if ((_.options.swipe === false) || ('ontouchend' in document && _.options.swipe === false)) {
            return;
        } else if (_.options.draggable === false && event.type.indexOf('mouse') !== -1) {
            return;
        }

        _.touchObject.fingerCount = event.originalEvent && event.originalEvent.touches !== undefined ?
            event.originalEvent.touches.length : 1;

        _.touchObject.minSwipe = _.listWidth / _.options
            .touchThreshold;

        if (_.options.verticalSwiping === true) {
            _.touchObject.minSwipe = _.listHeight / _.options
                .touchThreshold;
        }

        switch (event.data.action) {

            case 'start':
                _.swipeStart(event);
                break;

            case 'move':
                _.swipeMove(event);
                break;

            case 'end':
                _.swipeEnd(event);
                break;

        }

    };

    Slick.prototype.swipeMove = function(event) {

        var _ = this,
            edgeWasHit = false,
            curLeft, swipeDirection, swipeLength, positionOffset, touches, verticalSwipeLength;

        touches = event.originalEvent !== undefined ? event.originalEvent.touches : null;

        if (!_.dragging || _.scrolling || touches && touches.length !== 1) {
            return false;
        }

        curLeft = _.getLeft(_.currentSlide);

        _.touchObject.curX = touches !== undefined ? touches[0].pageX : event.clientX;
        _.touchObject.curY = touches !== undefined ? touches[0].pageY : event.clientY;

        _.touchObject.swipeLength = Math.round(Math.sqrt(
            Math.pow(_.touchObject.curX - _.touchObject.startX, 2)));

        verticalSwipeLength = Math.round(Math.sqrt(
            Math.pow(_.touchObject.curY - _.touchObject.startY, 2)));

        if (!_.options.verticalSwiping && !_.swiping && verticalSwipeLength > 4) {
            _.scrolling = true;
            return false;
        }

        if (_.options.verticalSwiping === true) {
            _.touchObject.swipeLength = verticalSwipeLength;
        }

        swipeDirection = _.swipeDirection();

        if (event.originalEvent !== undefined && _.touchObject.swipeLength > 4) {
            _.swiping = true;
            event.preventDefault();
        }

        positionOffset = (_.options.rtl === false ? 1 : -1) * (_.touchObject.curX > _.touchObject.startX ? 1 : -1);
        if (_.options.verticalSwiping === true) {
            positionOffset = _.touchObject.curY > _.touchObject.startY ? 1 : -1;
        }


        swipeLength = _.touchObject.swipeLength;

        _.touchObject.edgeHit = false;

        if (_.options.infinite === false) {
            if ((_.currentSlide === 0 && swipeDirection === 'right') || (_.currentSlide >= _.getDotCount() && swipeDirection === 'left')) {
                swipeLength = _.touchObject.swipeLength * _.options.edgeFriction;
                _.touchObject.edgeHit = true;
            }
        }

        if (_.options.vertical === false) {
            _.swipeLeft = curLeft + swipeLength * positionOffset;
        } else {
            _.swipeLeft = curLeft + (swipeLength * (_.$list.height() / _.listWidth)) * positionOffset;
        }
        if (_.options.verticalSwiping === true) {
            _.swipeLeft = curLeft + swipeLength * positionOffset;
        }

        if (_.options.fade === true || _.options.touchMove === false) {
            return false;
        }

        if (_.animating === true) {
            _.swipeLeft = null;
            return false;
        }

        _.setCSS(_.swipeLeft);

    };

    Slick.prototype.swipeStart = function(event) {

        var _ = this,
            touches;

        _.interrupted = true;

        if (_.touchObject.fingerCount !== 1 || _.slideCount <= _.options.slidesToShow) {
            _.touchObject = {};
            return false;
        }

        if (event.originalEvent !== undefined && event.originalEvent.touches !== undefined) {
            touches = event.originalEvent.touches[0];
        }

        _.touchObject.startX = _.touchObject.curX = touches !== undefined ? touches.pageX : event.clientX;
        _.touchObject.startY = _.touchObject.curY = touches !== undefined ? touches.pageY : event.clientY;

        _.dragging = true;

    };

    Slick.prototype.unfilterSlides = Slick.prototype.slickUnfilter = function() {

        var _ = this;

        if (_.$slidesCache !== null) {

            _.unload();

            _.$slideTrack.children(this.options.slide).detach();

            _.$slidesCache.appendTo(_.$slideTrack);

            _.reinit();

        }

    };

    Slick.prototype.unload = function() {

        var _ = this;

        $('.slick-cloned', _.$slider).remove();

        if (_.$dots) {
            _.$dots.remove();
        }

        if (_.$prevArrow && _.htmlExpr.test(_.options.prevArrow)) {
            _.$prevArrow.remove();
        }

        if (_.$nextArrow && _.htmlExpr.test(_.options.nextArrow)) {
            _.$nextArrow.remove();
        }

        _.$slides
            .removeClass('slick-slide slick-active slick-visible slick-current')
            .attr('aria-hidden', 'true')
            .css('width', '');

    };

    Slick.prototype.unslick = function(fromBreakpoint) {

        var _ = this;
        _.$slider.trigger('unslick', [_, fromBreakpoint]);
        _.destroy();

    };

    Slick.prototype.updateArrows = function() {

        var _ = this,
            centerOffset;

        centerOffset = Math.floor(_.options.slidesToShow / 2);

        if ( _.options.arrows === true &&
            _.slideCount > _.options.slidesToShow &&
            !_.options.infinite ) {

            _.$prevArrow.removeClass('slick-disabled').attr('aria-disabled', 'false');
            _.$nextArrow.removeClass('slick-disabled').attr('aria-disabled', 'false');

            if (_.currentSlide === 0) {

                _.$prevArrow.addClass('slick-disabled').attr('aria-disabled', 'true');
                _.$nextArrow.removeClass('slick-disabled').attr('aria-disabled', 'false');

            } else if (_.currentSlide >= _.slideCount - _.options.slidesToShow && _.options.centerMode === false) {

                _.$nextArrow.addClass('slick-disabled').attr('aria-disabled', 'true');
                _.$prevArrow.removeClass('slick-disabled').attr('aria-disabled', 'false');

            } else if (_.currentSlide >= _.slideCount - 1 && _.options.centerMode === true) {

                _.$nextArrow.addClass('slick-disabled').attr('aria-disabled', 'true');
                _.$prevArrow.removeClass('slick-disabled').attr('aria-disabled', 'false');

            }

        }

    };

    Slick.prototype.updateDots = function() {

        var _ = this;

        if (_.$dots !== null) {

            _.$dots
                .find('li')
                    .removeClass('slick-active')
                    .end();

            _.$dots
                .find('li')
                .eq(Math.floor(_.currentSlide / _.options.slidesToScroll))
                .addClass('slick-active');

        }

    };

    Slick.prototype.visibility = function() {

        var _ = this;

        if ( _.options.autoplay ) {

            if ( document[_.hidden] ) {

                _.interrupted = true;

            } else {

                _.interrupted = false;

            }

        }

    };

    $.fn.slick = function() {
        var _ = this,
            opt = arguments[0],
            args = Array.prototype.slice.call(arguments, 1),
            l = _.length,
            i,
            ret;
        for (i = 0; i < l; i++) {
            if (typeof opt == 'object' || typeof opt == 'undefined')
                _[i].slick = new Slick(_[i], opt);
            else
                ret = _[i].slick[opt].apply(_[i].slick, args);
            if (typeof ret != 'undefined') return ret;
        }
        return _;
    };

}));


/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright © 2008 George McGinley Smith
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
*/

// t: current time, b: begInnIng value, c: change In value, d: duration
jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
	def: 'easeOutQuad',
	swing: function (x, t, b, c, d) {
		//alert(jQuery.easing.default);
		return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
	},
	easeInQuad: function (x, t, b, c, d) {
		return c*(t/=d)*t + b;
	},
	easeOutQuad: function (x, t, b, c, d) {
		return -c *(t/=d)*(t-2) + b;
	},
	easeInOutQuad: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t + b;
		return -c/2 * ((--t)*(t-2) - 1) + b;
	},
	easeInCubic: function (x, t, b, c, d) {
		return c*(t/=d)*t*t + b;
	},
	easeOutCubic: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t + 1) + b;
	},
	easeInOutCubic: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	},
	easeInQuart: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t + b;
	},
	easeOutQuart: function (x, t, b, c, d) {
		return -c * ((t=t/d-1)*t*t*t - 1) + b;
	},
	easeInOutQuart: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
		return -c/2 * ((t-=2)*t*t*t - 2) + b;
	},
	easeInQuint: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t*t + b;
	},
	easeOutQuint: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t*t*t + 1) + b;
	},
	easeInOutQuint: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
		return c/2*((t-=2)*t*t*t*t + 2) + b;
	},
	easeInSine: function (x, t, b, c, d) {
		return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
	},
	easeOutSine: function (x, t, b, c, d) {
		return c * Math.sin(t/d * (Math.PI/2)) + b;
	},
	easeInOutSine: function (x, t, b, c, d) {
		return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
	},
	easeInExpo: function (x, t, b, c, d) {
		return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
	},
	easeOutExpo: function (x, t, b, c, d) {
		return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
	},
	easeInOutExpo: function (x, t, b, c, d) {
		if (t==0) return b;
		if (t==d) return b+c;
		if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
		return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
	},
	easeInCirc: function (x, t, b, c, d) {
		return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
	},
	easeOutCirc: function (x, t, b, c, d) {
		return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
	},
	easeInOutCirc: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
		return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
	},
	easeInElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
	},
	easeOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	},
	easeInOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
	},
	easeInBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*(t/=d)*t*((s+1)*t - s) + b;
	},
	easeOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
	},
	easeInOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158; 
		if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
		return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
	},
	easeInBounce: function (x, t, b, c, d) {
		return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
	},
	easeOutBounce: function (x, t, b, c, d) {
		if ((t/=d) < (1/2.75)) {
			return c*(7.5625*t*t) + b;
		} else if (t < (2/2.75)) {
			return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
		} else if (t < (2.5/2.75)) {
			return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
		} else {
			return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
		}
	},
	easeInOutBounce: function (x, t, b, c, d) {
		if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
		return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
	}
});

/*
 *
 * TERMS OF USE - EASING EQUATIONS
 * 
 * Open source under the BSD License. 
 * 
 * Copyright © 2001 Robert Penner
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
 */

/*!
 * Bootstrap-select v1.13.2 (https://developer.snapappointments.com/bootstrap-select)
 *
 * Copyright 2012-2018 SnapAppointments, LLC
 * Licensed under MIT (https://github.com/snapappointments/bootstrap-select/blob/master/LICENSE)
 */

(function (root, factory) {
  if (root === undefined && window !== undefined) root = window;
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module unless amdModuleId is set
    define(["jquery"], function (a0) {
      return (factory(a0));
    });
  } else if (typeof module === 'object' && module.exports) {
    // Node. Does not work with strict CommonJS, but
    // only CommonJS-like environments that support module.exports,
    // like Node.
    module.exports = factory(require("jquery"));
  } else {
    factory(root["jQuery"]);
  }
}(this, function (jQuery) {

(function ($) {
  'use strict';

  var testElement = document.createElement('_');

  testElement.classList.toggle('c3', false);

  // Polyfill for IE 10 and Firefox <24, where classList.toggle does not
  // support the second argument.
  if (testElement.classList.contains('c3')) {
    var _toggle = DOMTokenList.prototype.toggle;

    DOMTokenList.prototype.toggle = function(token, force) {
      if (1 in arguments && !this.contains(token) === !force) {
        return force;
      } else {
        return _toggle.call(this, token);
      }
    };
  }

  // shallow array comparison
  function isEqual (array1, array2) {
    return array1.length === array2.length && array1.every(function(element, index) {
      return element === array2[index]; 
    });
  };

  //<editor-fold desc="Shims">
  if (!String.prototype.startsWith) {
    (function () {
      'use strict'; // needed to support `apply`/`call` with `undefined`/`null`
      var defineProperty = (function () {
        // IE 8 only supports `Object.defineProperty` on DOM elements
        try {
          var object = {};
          var $defineProperty = Object.defineProperty;
          var result = $defineProperty(object, object, object) && $defineProperty;
        } catch (error) {
        }
        return result;
      }());
      var toString = {}.toString;
      var startsWith = function (search) {
        if (this == null) {
          throw new TypeError();
        }
        var string = String(this);
        if (search && toString.call(search) == '[object RegExp]') {
          throw new TypeError();
        }
        var stringLength = string.length;
        var searchString = String(search);
        var searchLength = searchString.length;
        var position = arguments.length > 1 ? arguments[1] : undefined;
        // `ToInteger`
        var pos = position ? Number(position) : 0;
        if (pos != pos) { // better `isNaN`
          pos = 0;
        }
        var start = Math.min(Math.max(pos, 0), stringLength);
        // Avoid the `indexOf` call if no match is possible
        if (searchLength + start > stringLength) {
          return false;
        }
        var index = -1;
        while (++index < searchLength) {
          if (string.charCodeAt(start + index) != searchString.charCodeAt(index)) {
            return false;
          }
        }
        return true;
      };
      if (defineProperty) {
        defineProperty(String.prototype, 'startsWith', {
          'value': startsWith,
          'configurable': true,
          'writable': true
        });
      } else {
        String.prototype.startsWith = startsWith;
      }
    }());
  }

  if (!Object.keys) {
    Object.keys = function (
      o, // object
      k, // key
      r  // result array
      ){
      // initialize object and result
      r=[];
      // iterate over object keys
      for (k in o)
          // fill result array with non-prototypical keys
        r.hasOwnProperty.call(o, k) && r.push(k);
      // return result
      return r;
    };
  }

  // much faster than $.val()
  function getSelectValues(select) {
    var result = [];
    var options = select && select.options;
    var opt;

    if (select.multiple) {
      for (var i = 0, len = options.length; i < len; i++) {
        opt = options[i];

        if (opt.selected) {
          result.push(opt.value || opt.text);
        }
      }
    } else {
      result = select.value;
    }

    return result;
  }

  // set data-selected on select element if the value has been programmatically selected
  // prior to initialization of bootstrap-select
  // * consider removing or replacing an alternative method *
  var valHooks = {
    useDefault: false,
    _set: $.valHooks.select.set
  };

  $.valHooks.select.set = function (elem, value) {
    if (value && !valHooks.useDefault) $(elem).data('selected', true);

    return valHooks._set.apply(this, arguments);
  };

  var changed_arguments = null;

  var EventIsSupported = (function () {
    try {
      new Event('change');
      return true;
    } catch (e) {
      return false;
    }
  })();

  $.fn.triggerNative = function (eventName) {
    var el = this[0],
        event;

    if (el.dispatchEvent) { // for modern browsers & IE9+
      if (EventIsSupported) {
        // For modern browsers
        event = new Event(eventName, {
          bubbles: true
        });
      } else {
        // For IE since it doesn't support Event constructor
        event = document.createEvent('Event');
        event.initEvent(eventName, true, false);
      }

      el.dispatchEvent(event);
    } else if (el.fireEvent) { // for IE8
      event = document.createEventObject();
      event.eventType = eventName;
      el.fireEvent('on' + eventName, event);
    } else {
      // fall back to jQuery.trigger
      this.trigger(eventName);
    }
  };
  //</editor-fold>

  function stringSearch(li, searchString, method, normalize) {
    var stringTypes = [
        'content',
        'subtext',
        'tokens'
      ],
      searchSuccess = false;

    for (var i = 0; i < stringTypes.length; i++) {
      var stringType = stringTypes[i],
          string = li[stringType];

      if (string) {
        string = string.toString();

        // Strip HTML tags. This isn't perfect, but it's much faster than any other method
        if (stringType === 'content') {
          string = string.replace(/<[^>]+>/g, '');
        }

        if (normalize) string = normalizeToBase(string);
        string = string.toUpperCase();

        if (method === 'contains') {
          searchSuccess = string.indexOf(searchString) >= 0;
        } else {
          searchSuccess = string.startsWith(searchString);
        }

        if (searchSuccess) break;
      }
    }

    return searchSuccess;
  }

  function toInteger(value) {
    return parseInt(value, 10) || 0;
  }

  /**
   * Remove all diatrics from the given text.
   * @access private
   * @param {String} text
   * @returns {String}
   */
  function normalizeToBase(text) {
    var rExps = [
      {re: /[\xC0-\xC6]/g, ch: "A"},
      {re: /[\xE0-\xE6]/g, ch: "a"},
      {re: /[\xC8-\xCB]/g, ch: "E"},
      {re: /[\xE8-\xEB]/g, ch: "e"},
      {re: /[\xCC-\xCF]/g, ch: "I"},
      {re: /[\xEC-\xEF]/g, ch: "i"},
      {re: /[\xD2-\xD6]/g, ch: "O"},
      {re: /[\xF2-\xF6]/g, ch: "o"},
      {re: /[\xD9-\xDC]/g, ch: "U"},
      {re: /[\xF9-\xFC]/g, ch: "u"},
      {re: /[\xC7-\xE7]/g, ch: "c"},
      {re: /[\xD1]/g, ch: "N"},
      {re: /[\xF1]/g, ch: "n"}
    ];
    $.each(rExps, function () {
      text = text ? text.replace(this.re, this.ch) : '';
    });
    return text;
  }


  // List of HTML entities for escaping.
  var escapeMap = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#x27;',
    '`': '&#x60;'
  };
  
  var unescapeMap = {
    '&amp;': '&',
    '&lt;': '<',
    '&gt;': '>',
    '&quot;': '"',
    '&#x27;': "'",
    '&#x60;': '`'
  };

  // Functions for escaping and unescaping strings to/from HTML interpolation.
  var createEscaper = function (map) {
    var escaper = function (match) {
      return map[match];
    };
    // Regexes for identifying a key that needs to be escaped.
    var source = '(?:' + Object.keys(map).join('|') + ')';
    var testRegexp = RegExp(source);
    var replaceRegexp = RegExp(source, 'g');
    return function (string) {
      string = string == null ? '' : '' + string;
      return testRegexp.test(string) ? string.replace(replaceRegexp, escaper) : string;
    };
  };

  var htmlEscape = createEscaper(escapeMap);
  var htmlUnescape = createEscaper(unescapeMap);

  /**
   * ------------------------------------------------------------------------
   * Constants
   * ------------------------------------------------------------------------
   */

  var keyCodeMap = {
    32: ' ',
    48: '0',
    49: '1',
    50: '2',
    51: '3',
    52: '4',
    53: '5',
    54: '6',
    55: '7',
    56: '8',
    57: '9',
    59: ';',
    65: 'A',
    66: 'B',
    67: 'C',
    68: 'D',
    69: 'E',
    70: 'F',
    71: 'G',
    72: 'H',
    73: 'I',
    74: 'J',
    75: 'K',
    76: 'L',
    77: 'M',
    78: 'N',
    79: 'O',
    80: 'P',
    81: 'Q',
    82: 'R',
    83: 'S',
    84: 'T',
    85: 'U',
    86: 'V',
    87: 'W',
    88: 'X',
    89: 'Y',
    90: 'Z',
    96: '0',
    97: '1',
    98: '2',
    99: '3',
    100: '4',
    101: '5',
    102: '6',
    103: '7',
    104: '8',
    105: '9'
  };

  var keyCodes = {
    ESCAPE: 27, // KeyboardEvent.which value for Escape (Esc) key
    ENTER: 13, // KeyboardEvent.which value for Enter key
    SPACE: 32, // KeyboardEvent.which value for space key
    TAB: 9, // KeyboardEvent.which value for tab key
    ARROW_UP: 38, // KeyboardEvent.which value for up arrow key
    ARROW_DOWN: 40 // KeyboardEvent.which value for down arrow key
  }

  var version = {
    success: false,
    major: '3'
  };

  try {
    version.full = ($.fn.dropdown.Constructor.VERSION || '').split(' ')[0].split('.');
    version.major = version.full[0];
    version.success = true;
  }
  catch(err) {
    console.warn(
      'There was an issue retrieving Bootstrap\'s version. ' +
      'Ensure Bootstrap is being loaded before bootstrap-select and there is no namespace collision. ' +
      'If loading Bootstrap asynchronously, the version may need to be manually specified via $.fn.selectpicker.Constructor.BootstrapVersion.'
    , err);
  }

  var classNames = {
    DISABLED: 'disabled',
    DIVIDER: 'divider',
    SHOW: 'open',
    DROPUP: 'dropup',
    MENU: 'dropdown-menu',
    MENURIGHT: 'dropdown-menu-right',
    MENULEFT: 'dropdown-menu-left',
    // to-do: replace with more advanced template/customization options
    BUTTONCLASS: 'btn-default',
    POPOVERHEADER: 'popover-title'
  }

  var Selector = {
    MENU: '.' + classNames.MENU
  }

  if (version.major === '4') {
    classNames.DIVIDER = 'dropdown-divider';
    classNames.SHOW = 'show';
    classNames.BUTTONCLASS = 'btn-light';
    classNames.POPOVERHEADER = 'popover-header';
  }

  var REGEXP_ARROW = new RegExp(keyCodes.ARROW_UP + '|' + keyCodes.ARROW_DOWN);
  var REGEXP_TAB_OR_ESCAPE = new RegExp('^' + keyCodes.TAB + '$|' + keyCodes.ESCAPE);
  var REGEXP_ENTER_OR_SPACE = new RegExp(keyCodes.ENTER + '|' + keyCodes.SPACE);

  var Selectpicker = function (element, options) {
    var that = this;

    // bootstrap-select has been initialized - revert valHooks.select.set back to its original function
    if (!valHooks.useDefault) {
      $.valHooks.select.set = valHooks._set;
      valHooks.useDefault = true;
    }

    this.$element = $(element);
    this.$newElement = null;
    this.$button = null;
    this.$menu = null;
    this.options = options;
    this.selectpicker = {
      main: {
        // store originalIndex (key) and newIndex (value) in this.selectpicker.main.map.newIndex for fast accessibility
        // allows us to do this.main.elements[this.selectpicker.main.map.newIndex[index]] to select an element based on the originalIndex
        map: {
          newIndex: {},
          originalIndex: {}
        }
      },
      current: {
        map: {}
      }, // current changes if a search is in progress
      search: {
        map: {}
      },
      view: {},
      keydown: {
        keyHistory: '',
        resetKeyHistory: {
          start: function () {
            return setTimeout(function () {
              that.selectpicker.keydown.keyHistory = '';
            }, 800);
          }
        }
      }
    };
    // If we have no title yet, try to pull it from the html title attribute (jQuery doesnt' pick it up as it's not a
    // data-attribute)
    if (this.options.title === null) {
      this.options.title = this.$element.attr('title');
    }

    // Format window padding
    var winPad = this.options.windowPadding;
    if (typeof winPad === 'number') {
      this.options.windowPadding = [winPad, winPad, winPad, winPad];
    }

    //Expose public methods
    this.val = Selectpicker.prototype.val;
    this.render = Selectpicker.prototype.render;
    this.refresh = Selectpicker.prototype.refresh;
    this.setStyle = Selectpicker.prototype.setStyle;
    this.selectAll = Selectpicker.prototype.selectAll;
    this.deselectAll = Selectpicker.prototype.deselectAll;
    this.destroy = Selectpicker.prototype.destroy;
    this.remove = Selectpicker.prototype.remove;
    this.show = Selectpicker.prototype.show;
    this.hide = Selectpicker.prototype.hide;

    this.init();
  };

  Selectpicker.VERSION = '1.13.2';

  Selectpicker.BootstrapVersion = version.major;

  // part of this is duplicated in i18n/defaults-en_US.js. Make sure to update both.
  Selectpicker.DEFAULTS = {
    noneSelectedText: 'Nothing selected',
    noneResultsText: 'No results matched {0}',
    countSelectedText: function (numSelected, numTotal) {
      return (numSelected == 1) ? "{0} item selected" : "{0} items selected";
    },
    maxOptionsText: function (numAll, numGroup) {
      return [
        (numAll == 1) ? 'Limit reached ({n} item max)' : 'Limit reached ({n} items max)',
        (numGroup == 1) ? 'Group limit reached ({n} item max)' : 'Group limit reached ({n} items max)'
      ];
    },
    selectAllText: 'Select All',
    deselectAllText: 'Deselect All',
    doneButton: false,
    doneButtonText: 'Close',
    multipleSeparator: ', ',
    styleBase: 'btn',
    style: classNames.BUTTONCLASS,
    size: 'auto',
    title: null,
    selectedTextFormat: 'values',
    width: false,
    container: false,
    hideDisabled: false,
    showSubtext: false,
    showIcon: true,
    showContent: true,
    dropupAuto: true,
    header: false,
    liveSearch: false,
    liveSearchPlaceholder: null,
    liveSearchNormalize: false,
    liveSearchStyle: 'contains',
    actionsBox: false,
    iconBase: 'glyphicon',
    tickIcon: 'glyphicon-ok',
    showTick: false,
    template: {
      caret: '<span class="caret"></span>'
    },
    maxOptions: false,
    mobile: false,
    selectOnTab: false,
    dropdownAlignRight: false,
    windowPadding: 0,
    virtualScroll: 600,
    display: false
  };

  if (version.major === '4') {
    Selectpicker.DEFAULTS.style = 'btn-light';
    Selectpicker.DEFAULTS.iconBase = '';
    Selectpicker.DEFAULTS.tickIcon = 'bs-ok-default';
  }

  Selectpicker.prototype = {

    constructor: Selectpicker,

    init: function () {
      var that = this,
          id = this.$element.attr('id');

      this.$element.addClass('bs-select-hidden');

      this.multiple = this.$element.prop('multiple');
      this.autofocus = this.$element.prop('autofocus');
      this.$newElement = this.createDropdown();
      this.createLi();
      this.$element
        .after(this.$newElement)
        .prependTo(this.$newElement);
      this.$button = this.$newElement.children('button');
      this.$menu = this.$newElement.children(Selector.MENU);
      this.$menuInner = this.$menu.children('.inner');
      this.$searchbox = this.$menu.find('input');

      this.$element.removeClass('bs-select-hidden');

      if (this.options.dropdownAlignRight === true) this.$menu.addClass(classNames.MENURIGHT);

      if (typeof id !== 'undefined') {
        this.$button.attr('data-id', id);
      }

      this.checkDisabled();
      this.clickListener();
      if (this.options.liveSearch) this.liveSearchListener();
      this.render();
      this.setStyle();
      this.setWidth();
      if (this.options.container) {
        this.selectPosition();
      } else {
        this.$element.on('hide.bs.select', function () {
          if (that.isVirtual()) {
            // empty menu on close
            var menuInner = that.$menuInner[0],
                emptyMenu = menuInner.firstChild.cloneNode(false);

            // replace the existing UL with an empty one - this is faster than $.empty() or innerHTML = ''
            menuInner.replaceChild(emptyMenu, menuInner.firstChild);
            menuInner.scrollTop = 0;
          }
        });
      }
      this.$menu.data('this', this);
      this.$newElement.data('this', this);
      if (this.options.mobile) this.mobile();

      this.$newElement.on({
        'hide.bs.dropdown': function (e) {
          that.$menuInner.attr('aria-expanded', false);
          that.$element.trigger('hide.bs.select', e);
        },
        'hidden.bs.dropdown': function (e) {
          that.$element.trigger('hidden.bs.select', e);
        },
        'show.bs.dropdown': function (e) {
          that.$menuInner.attr('aria-expanded', true);
          that.$element.trigger('show.bs.select', e);
        },
        'shown.bs.dropdown': function (e) {
          that.$element.trigger('shown.bs.select', e);
        }
      });

      if (that.$element[0].hasAttribute('required')) {
        this.$element.on('invalid', function () {
          that.$button.addClass('bs-invalid');

          that.$element.on({
            'shown.bs.select': function () {
              that.$element
                .val(that.$element.val()) // set the value to hide the validation message in Chrome when menu is opened
                .off('shown.bs.select');
            },
            'rendered.bs.select': function () {
              // if select is no longer invalid, remove the bs-invalid class
              if (this.validity.valid) that.$button.removeClass('bs-invalid');
              that.$element.off('rendered.bs.select');
            }
          });

          that.$button.on('blur.bs.select', function () {
            that.$element.focus().blur();
            that.$button.off('blur.bs.select');
          });
        });
      }

      setTimeout(function () {
        that.$element.trigger('loaded.bs.select');
      });
    },

    createDropdown: function () {
      // Options
      // If we are multiple or showTick option is set, then add the show-tick class
      var showTick = (this.multiple || this.options.showTick) ? ' show-tick' : '',
          autofocus = this.autofocus ? ' autofocus' : '';
      // Elements
      var header = this.options.header ? '<div class="' + classNames.POPOVERHEADER + '"><button type="button" class="close" aria-hidden="true">&times;</button>' + this.options.header + '</div>' : '';
      var searchbox = this.options.liveSearch ?
      '<div class="bs-searchbox">' +
      '<input type="text" class="form-control" autocomplete="off"' +
      (null === this.options.liveSearchPlaceholder ? '' : ' placeholder="' + htmlEscape(this.options.liveSearchPlaceholder) + '"') + ' role="textbox" aria-label="Search">' +
      '</div>'
          : '';
      var actionsbox = this.multiple && this.options.actionsBox ?
      '<div class="bs-actionsbox">' +
      '<div class="btn-group btn-group-sm btn-block">' +
      '<button type="button" class="actions-btn bs-select-all btn ' + classNames.BUTTONCLASS + '">' +
      this.options.selectAllText +
      '</button>' +
      '<button type="button" class="actions-btn bs-deselect-all btn ' + classNames.BUTTONCLASS + '">' +
      this.options.deselectAllText +
      '</button>' +
      '</div>' +
      '</div>'
          : '';
      var donebutton = this.multiple && this.options.doneButton ?
      '<div class="bs-donebutton">' +
      '<div class="btn-group btn-block">' +
      '<button type="button" class="btn btn-sm ' + classNames.BUTTONCLASS + '">' +
      this.options.doneButtonText +
      '</button>' +
      '</div>' +
      '</div>'
          : '';
      var drop =
          '<div class="dropdown bootstrap-select' + showTick + '">' +
          '<button type="button" class="' + this.options.styleBase + ' dropdown-toggle" ' + (this.options.display === 'static' ? 'data-display="static"' : '') + 'data-toggle="dropdown"' + autofocus + ' role="button">' +
          '<div class="filter-option">' +
            '<div class="filter-option-inner">' +
              '<div class="filter-option-inner-inner"></div>' +
            '</div> ' +
          '</div>' +
          (version.major === '4' ?
            '' :
          '<span class="bs-caret">' +
          this.options.template.caret +
          '</span>'
          ) +
          '</button>' +
          '<div class="' + classNames.MENU + ' ' + (version.major === '4' ? '' : classNames.SHOW) + '" role="combobox">' +
          header +
          searchbox +
          actionsbox +
          '<div class="inner ' + classNames.SHOW + '" role="listbox" aria-expanded="false" tabindex="-1">' +
              '<ul class="' + classNames.MENU + ' inner ' + (version.major === '4' ? classNames.SHOW : '') + '">' +
              '</ul>' +
          '</div>' +
          donebutton +
          '</div>' +
          '</div>';

      return $(drop);
    },

    setPositionData: function () {
      this.selectpicker.view.canHighlight = [];

      for (var i = 0; i < this.selectpicker.current.data.length; i++) {
        var li = this.selectpicker.current.data[i],
            canHighlight = true;

        if (li.type === 'divider') {
          canHighlight = false;
          li.height = this.sizeInfo.dividerHeight;
        } else if (li.type === 'optgroup-label') {
          canHighlight = false;
          li.height = this.sizeInfo.dropdownHeaderHeight;
        } else {
          li.height = this.sizeInfo.liHeight;
        }

        if (li.disabled) canHighlight = false;

        this.selectpicker.view.canHighlight.push(canHighlight);

        li.position = (i === 0 ? 0 : this.selectpicker.current.data[i - 1].position) + li.height;
      }
    },

    isVirtual: function () {
      return (this.options.virtualScroll !== false) && this.selectpicker.main.elements.length >= this.options.virtualScroll || this.options.virtualScroll === true;
    },

    createView: function (isSearching, scrollTop) {
      scrollTop = scrollTop || 0;

      var that = this;

      this.selectpicker.current = isSearching ? this.selectpicker.search : this.selectpicker.main;

      var $lis;
      var active = [];
      var selected;
      var prevActive;
      var activeIndex;
      var prevActiveIndex;

      this.setPositionData();

      scroll(scrollTop, true);

      this.$menuInner.off('scroll.createView').on('scroll.createView', function (e, updateValue) {
        if (!that.noScroll) scroll(this.scrollTop, updateValue);
        that.noScroll = false;
      });

      function scroll(scrollTop, init) {
        var size = that.selectpicker.current.elements.length,
            chunks = [],
            chunkSize,
            chunkCount,
            firstChunk,
            lastChunk,
            currentChunk = undefined,
            prevPositions,
            positionIsDifferent,
            previousElements,
            menuIsDifferent = true,
            isVirtual = that.isVirtual();

        that.selectpicker.view.scrollTop = scrollTop;

        if (isVirtual === true) {
          // if an option that is encountered that is wider than the current menu width, update the menu width accordingly
          if (that.sizeInfo.hasScrollBar && that.$menu[0].offsetWidth > that.sizeInfo.totalMenuWidth) {
            that.sizeInfo.menuWidth = that.$menu[0].offsetWidth;
            that.sizeInfo.totalMenuWidth = that.sizeInfo.menuWidth + that.sizeInfo.scrollBarWidth;
            that.$menu.css('min-width', that.sizeInfo.menuWidth);
          }
        }

        chunkSize = Math.ceil(that.sizeInfo.menuInnerHeight / that.sizeInfo.liHeight * 1.5); // number of options in a chunk
        chunkCount = Math.round(size / chunkSize) || 1; // number of chunks

        for (var i = 0; i < chunkCount; i++) {
          var end_of_chunk = (i + 1) * chunkSize;

          if (i === chunkCount - 1) {
            end_of_chunk = size;
          }

          chunks[i] = [
            (i) * chunkSize + (!i ? 0 : 1),
            end_of_chunk
          ];

          if (!size) break;

          if (currentChunk === undefined && scrollTop <= that.selectpicker.current.data[end_of_chunk - 1].position - that.sizeInfo.menuInnerHeight) {
            currentChunk = i;
          }
        }

        if (currentChunk === undefined) currentChunk = 0;

        prevPositions = [that.selectpicker.view.position0, that.selectpicker.view.position1];

        // always display previous, current, and next chunks
        firstChunk = Math.max(0, currentChunk - 1);
        lastChunk = Math.min(chunkCount - 1, currentChunk + 1);

        that.selectpicker.view.position0 = Math.max(0, chunks[firstChunk][0]) || 0;
        that.selectpicker.view.position1 = Math.min(size, chunks[lastChunk][1]) || 0;

        positionIsDifferent = prevPositions[0] !== that.selectpicker.view.position0 || prevPositions[1] !== that.selectpicker.view.position1;

        if (that.activeIndex !== undefined) {
          prevActive = that.selectpicker.current.elements[that.selectpicker.current.map.newIndex[that.prevActiveIndex]];
          active = that.selectpicker.current.elements[that.selectpicker.current.map.newIndex[that.activeIndex]];
          selected = that.selectpicker.current.elements[that.selectpicker.current.map.newIndex[that.selectedIndex]];

          if (init) {
            if (that.activeIndex !== that.selectedIndex) {
              active.classList.remove('active');
              if (active.firstChild) active.firstChild.classList.remove('active');
            }
            that.activeIndex = undefined;
          }

          if (that.activeIndex && that.activeIndex !== that.selectedIndex && selected && selected.length) {
            selected.classList.remove('active');
            if (selected.firstChild) selected.firstChild.classList.remove('active');
          }
        }

        if (that.prevActiveIndex !== undefined && that.prevActiveIndex !== that.activeIndex && that.prevActiveIndex !== that.selectedIndex && prevActive && prevActive.length) {
          prevActive.classList.remove('active');
          if (prevActive.firstChild) prevActive.firstChild.classList.remove('active');
        }

        if (init || positionIsDifferent) {
          previousElements = that.selectpicker.view.visibleElements ? that.selectpicker.view.visibleElements.slice() : [];

          that.selectpicker.view.visibleElements = that.selectpicker.current.elements.slice(that.selectpicker.view.position0, that.selectpicker.view.position1);

          that.setOptionStatus();

          // if searching, check to make sure the list has actually been updated before updating DOM
          // this prevents unnecessary repaints
          if ( isSearching || (isVirtual === false && init) ) menuIsDifferent = !isEqual(previousElements, that.selectpicker.view.visibleElements);

          // if virtual scroll is disabled and not searching,
          // menu should never need to be updated more than once
          if ( (init || isVirtual === true) && menuIsDifferent ) {
            var menuInner = that.$menuInner[0],
                menuFragment = document.createDocumentFragment(),
                emptyMenu = menuInner.firstChild.cloneNode(false),
                marginTop,
                marginBottom,
                elements = isVirtual === true ? that.selectpicker.view.visibleElements : that.selectpicker.current.elements;

            // replace the existing UL with an empty one - this is faster than $.empty()
            menuInner.replaceChild(emptyMenu, menuInner.firstChild);

            for (var i = 0, visibleElementsLen = elements.length; i < visibleElementsLen; i++) {
              menuFragment.appendChild(elements[i]);
            }

            if (isVirtual === true) {
              marginTop = (that.selectpicker.view.position0 === 0 ? 0 : that.selectpicker.current.data[that.selectpicker.view.position0 - 1].position),
              marginBottom = (that.selectpicker.view.position1 > size - 1 ? 0 : that.selectpicker.current.data[size - 1].position - that.selectpicker.current.data[that.selectpicker.view.position1 - 1].position);

              menuInner.firstChild.style.marginTop = marginTop + 'px';
              menuInner.firstChild.style.marginBottom = marginBottom + 'px';
            }

            menuInner.firstChild.appendChild(menuFragment);
          }
        }

        that.prevActiveIndex = that.activeIndex;

        if (!that.options.liveSearch) {
          that.$menuInner.focus();
        } else if (isSearching && init) {
          var index = 0,
              newActive;

          if (!that.selectpicker.view.canHighlight[index]) {
            index = 1 + that.selectpicker.view.canHighlight.slice(1).indexOf(true);
          }

          newActive = that.selectpicker.view.visibleElements[index];

          if (that.selectpicker.view.currentActive) {
            that.selectpicker.view.currentActive.classList.remove('active');
            if (that.selectpicker.view.currentActive.firstChild) that.selectpicker.view.currentActive.firstChild.classList.remove('active');
          }

          if (newActive) {
            newActive.classList.add('active');
            if (newActive.firstChild) newActive.firstChild.classList.add('active');
          }

          that.activeIndex = that.selectpicker.current.map.originalIndex[index];
        }
      }

      $(window).off('resize.createView').on('resize.createView', function () {
        scroll(that.$menuInner[0].scrollTop);
      });
    },

    createLi: function () {
      var that = this,
          mainElements = [],
          widestOption,
          availableOptionsCount = 0,
          widestOptionLength = 0,
          mainData = [],
          optID = 0,
          headerIndex = 0,
          liIndex = -1; // increment liIndex whenever a new <li> element is created to ensure newIndex is correct

      if (!this.selectpicker.view.titleOption) this.selectpicker.view.titleOption = document.createElement('option');

      var elementTemplates = {
          span: document.createElement('span'),
          subtext: document.createElement('small'),
          a: document.createElement('a'),
          li: document.createElement('li'),
          whitespace: document.createTextNode("\u00A0")
        },
        checkMark = elementTemplates.span.cloneNode(false),
        fragment = document.createDocumentFragment();

      checkMark.className = that.options.iconBase + ' ' + that.options.tickIcon + ' check-mark';
      elementTemplates.a.appendChild(checkMark);
      elementTemplates.a.setAttribute('role', 'option');

      elementTemplates.subtext.className = 'text-muted';

      elementTemplates.text = elementTemplates.span.cloneNode(false);
      elementTemplates.text.className = 'text';

      // Helper functions
      /**
       * @param content
       * @param [index]
       * @param [classes]
       * @param [optgroup]
       * @returns {HTMLElement}
       */
      var generateLI = function (content, index, classes, optgroup) {
        var li = elementTemplates.li.cloneNode(false);

        if (content) {
          if (content.nodeType === 1 || content.nodeType === 11) {
            li.appendChild(content);
          } else {
            li.innerHTML = content;
          }
        }

        if (typeof classes !== 'undefined' && '' !== classes) li.className = classes;
        if (typeof optgroup !== 'undefined' && null !== optgroup) li.classList.add('optgroup-' + optgroup);

        return li;
      };

      /**
       * @param text
       * @param [classes]
       * @param [inline]
       * @returns {string}
       */
      var generateA = function (text, classes, inline) {
        var a = elementTemplates.a.cloneNode(true);

        if (text) {
          if (text.nodeType === 11) {
            a.appendChild(text);
          } else {
            a.insertAdjacentHTML('beforeend', text);
          }
        }

        if (typeof classes !== 'undefined' & '' !== classes) a.className = classes;
        if (version.major === '4') a.classList.add('dropdown-item');
        if (inline) a.setAttribute('style', inline);

        return a;
      };

      var generateText = function (options) {
        var textElement = elementTemplates.text.cloneNode(false),
            optionSubtextElement,
            optionIconElement;

        if (options.optionContent) {
          textElement.innerHTML = options.optionContent;
        } else {
          textElement.textContent = options.text;

          if (options.optionIcon) {
            var whitespace = elementTemplates.whitespace.cloneNode(false);

            optionIconElement = elementTemplates.span.cloneNode(false);
            optionIconElement.className = that.options.iconBase + ' ' + options.optionIcon;

            fragment.appendChild(optionIconElement);
            fragment.appendChild(whitespace);
          }

          if (options.optionSubtext) {
            optionSubtextElement = elementTemplates.subtext.cloneNode(false);
            optionSubtextElement.innerHTML = options.optionSubtext;
            textElement.appendChild(optionSubtextElement);
          }
        }

        fragment.appendChild(textElement);

        return fragment;
      };

      var generateLabel = function (options) {
        var labelTextElement = elementTemplates.text.cloneNode(false),
            labelSubtextElement,
            labelIconElement;

        labelTextElement.innerHTML = options.labelEscaped;

        if (options.labelIcon) {
          var whitespace = elementTemplates.whitespace.cloneNode(false);

          labelIconElement = elementTemplates.span.cloneNode(false);
          labelIconElement.className = that.options.iconBase + ' ' + options.labelIcon;

          fragment.appendChild(labelIconElement);
          fragment.appendChild(whitespace);
        }

        if (options.labelSubtext) {
          labelSubtextElement = elementTemplates.subtext.cloneNode(false);
          labelSubtextElement.textContent = options.labelSubtext;
          labelTextElement.appendChild(labelSubtextElement);
        }

        fragment.appendChild(labelTextElement);

        return fragment;
      }

      if (this.options.title && !this.multiple) {
        // this option doesn't create a new <li> element, but does add a new option, so liIndex is decreased
        // since newIndex is recalculated on every refresh, liIndex needs to be decreased even if the titleOption is already appended
        liIndex--;

        var element = this.$element[0],
            isSelected = false,
            titleNotAppended = !this.selectpicker.view.titleOption.parentNode;

        if (titleNotAppended) {
          // Use native JS to prepend option (faster)
          this.selectpicker.view.titleOption.className = 'bs-title-option';
          this.selectpicker.view.titleOption.value = '';

          // Check if selected or data-selected attribute is already set on an option. If not, select the titleOption option.
          // the selected item may have been changed by user or programmatically before the bootstrap select plugin runs,
          // if so, the select will have the data-selected attribute
          var $opt = $(element.options[element.selectedIndex]);
          isSelected = $opt.attr('selected') === undefined && this.$element.data('selected') === undefined;
        }

        if (titleNotAppended || this.selectpicker.view.titleOption.index !== 0) {
          element.insertBefore(this.selectpicker.view.titleOption, element.firstChild);
        }

        // Set selected *after* appending to select,
        // otherwise the option doesn't get selected in IE
        // set using selectedIndex, as setting the selected attr to true here doesn't work in IE11
        if (isSelected) element.selectedIndex = 0;
      }

      var $selectOptions = this.$element.find('option');

      $selectOptions.each(function (index) {
        var $this = $(this);

        liIndex++;

        if ($this.hasClass('bs-title-option')) return;

        var thisData = $this.data();

        // Get the class and text for the option
        var optionClass = this.className || '',
            inline = htmlEscape(this.style.cssText),
            optionContent = thisData.content,
            text = this.textContent,
            tokens = thisData.tokens,
            subtext = thisData.subtext,
            icon = thisData.icon,
            $parent = $this.parent(),
            parent = $parent[0],
            isOptgroup = parent.tagName === 'OPTGROUP',
            isOptgroupDisabled = isOptgroup && parent.disabled,
            isDisabled = this.disabled || isOptgroupDisabled,
            prevHiddenIndex,
            showDivider = this.previousElementSibling && this.previousElementSibling.tagName === 'OPTGROUP',
            textElement;

        var parentData = $parent.data();

        if (thisData.hidden === true || that.options.hideDisabled && (isDisabled && !isOptgroup || isOptgroupDisabled)) {
          // set prevHiddenIndex - the index of the first hidden option in a group of hidden options
          // used to determine whether or not a divider should be placed after an optgroup if there are
          // hidden options between the optgroup and the first visible option
          prevHiddenIndex = thisData.prevHiddenIndex;
          $this.next().data('prevHiddenIndex', (prevHiddenIndex !== undefined ? prevHiddenIndex : index));

          liIndex--;

          // if previous element is not an optgroup
          if (!showDivider) {
            if (prevHiddenIndex !== undefined) {
              // select the element **before** the first hidden element in the group
              var prevHidden = $selectOptions[prevHiddenIndex].previousElementSibling;
              
              if (prevHidden && prevHidden.tagName === 'OPTGROUP' && !prevHidden.disabled) {
                showDivider = true;
              }
            }
          }

          if (showDivider && mainData[mainData.length - 1].type !== 'divider') {
            liIndex++;
            mainElements.push(
              generateLI(
                false,
                null,
                classNames.DIVIDER,
                optID + 'div'
              )
            );
            mainData.push({
              type: 'divider',
              optID: optID
            });
          }

          return;
        }

        if (isOptgroup && thisData.divider !== true) {
          if (that.options.hideDisabled && isDisabled) {
            if (parentData.allOptionsDisabled === undefined) {
              var $options = $parent.children();
              $parent.data('allOptionsDisabled', $options.filter(':disabled').length === $options.length);
            }

            if ($parent.data('allOptionsDisabled')) {
              liIndex--;
              return;
            }
          }

          var optGroupClass = ' ' + parent.className || '';

          if (!this.previousElementSibling) { // Is it the first option of the optgroup?
            optID += 1;

            // Get the opt group label
            var label = parent.label,
                labelEscaped = htmlEscape(label),
                labelSubtext = parentData.subtext,
                labelIcon = parentData.icon;

            if (index !== 0 && mainElements.length > 0) { // Is it NOT the first option of the select && are there elements in the dropdown?
              liIndex++;
              mainElements.push(
                generateLI(
                  false,
                  null,
                  classNames.DIVIDER,
                  optID + 'div'
                )
              );
              mainData.push({
                type: 'divider',
                optID: optID
              });
            }
            liIndex++;

            var labelElement = generateLabel({
                  labelEscaped: labelEscaped,
                  labelSubtext: labelSubtext,
                  labelIcon: labelIcon
                });

            mainElements.push(generateLI(labelElement, null, 'dropdown-header' + optGroupClass, optID));
            mainData.push({
              content: labelEscaped,
              subtext: labelSubtext,
              type: 'optgroup-label',
              optID: optID
            });
            
            headerIndex = liIndex - 1;
          }

          if (that.options.hideDisabled && isDisabled || thisData.hidden === true) {
            liIndex--;
            return;
          }

          textElement = generateText({
            text: text,
            optionContent: optionContent,
            optionSubtext: subtext,
            optionIcon: icon
          });

          mainElements.push(generateLI(generateA(textElement, 'opt ' + optionClass + optGroupClass, inline), index, '', optID));
          mainData.push({
            content: optionContent || text,
            subtext: subtext,
            tokens: tokens,
            type: 'option',
            optID: optID,
            headerIndex: headerIndex,
            lastIndex: headerIndex + parent.childElementCount,
            originalIndex: index,
            data: thisData
          });

          availableOptionsCount++;
        } else if (thisData.divider === true) {
          mainElements.push(generateLI(false, index, classNames.DIVIDER));
          mainData.push({
            type: 'divider',
            originalIndex: index,
            data: thisData
          });
        } else {
          // if previous element is not an optgroup and hideDisabled is true
          if (!showDivider && that.options.hideDisabled) {
            prevHiddenIndex = thisData.prevHiddenIndex;

            if (prevHiddenIndex !== undefined) {
              // select the element **before** the first hidden element in the group
              var prevHidden = $selectOptions[prevHiddenIndex].previousElementSibling;
              
              if (prevHidden && prevHidden.tagName === 'OPTGROUP' && !prevHidden.disabled) {
                showDivider = true;
              }
            }
          }

          if (showDivider && mainData[mainData.length - 1].type !== 'divider') {
            liIndex++;
            mainElements.push(
              generateLI(
                false,
                null,
                classNames.DIVIDER,
                optID + 'div'
              )
            );
            mainData.push({
              type: 'divider',
              optID: optID
            });
          }

          textElement = generateText({
            text: text,
            optionContent: optionContent,
            optionSubtext: subtext,
            optionIcon: icon
          });

          mainElements.push(generateLI(generateA(textElement, optionClass, inline), index));
          mainData.push({
            content: optionContent || text,
            subtext: subtext,
            tokens: tokens,
            type: 'option',
            originalIndex: index,
            data: thisData
          });

          availableOptionsCount++;
        }

        that.selectpicker.main.map.newIndex[index] = liIndex;
        that.selectpicker.main.map.originalIndex[liIndex] = index;

        // get the most recent option info added to mainData
        var _mainDataLast = mainData[mainData.length - 1];

        _mainDataLast.disabled = isDisabled;

        var combinedLength = 0;

        // count the number of characters in the option - not perfect, but should work in most cases
        if (_mainDataLast.content) combinedLength += _mainDataLast.content.length;
        if (_mainDataLast.subtext) combinedLength += _mainDataLast.subtext.length;
        // if there is an icon, ensure this option's width is checked
        if (icon) combinedLength += 1;

        if (combinedLength > widestOptionLength) {
          widestOptionLength = combinedLength;

          // guess which option is the widest
          // use this when calculating menu width
          // not perfect, but it's fast, and the width will be updating accordingly when scrolling
          widestOption = mainElements[mainElements.length - 1];
        }
      });

      this.selectpicker.main.elements = mainElements;
      this.selectpicker.main.data = mainData;

      this.selectpicker.current = this.selectpicker.main;

      this.selectpicker.view.widestOption = widestOption;
      this.selectpicker.view.availableOptionsCount = availableOptionsCount; // faster way to get # of available options without filter
    },

    findLis: function () {
      return this.$menuInner.find('.inner > li');
    },

    render: function () {
      var that = this,
          $selectOptions = this.$element.find('option'),
          selectedItems = [],
          selectedItemsInTitle = [];

      this.togglePlaceholder();

      this.tabIndex();

      for (var i = 0, len = this.selectpicker.main.elements.length; i < len; i++) {
        var index = this.selectpicker.main.map.originalIndex[i],
            option = $selectOptions[index];

        if (option && option.selected) {
          selectedItems.push(option);

          if (selectedItemsInTitle.length < 100 && that.options.selectedTextFormat !== 'count' || selectedItems.length === 1) {
            if (that.options.hideDisabled && (option.disabled || option.parentNode.tagName === 'OPTGROUP' && option.parentNode.disabled)) return;

            var thisData = this.selectpicker.main.data[i].data,
                icon = thisData.icon && that.options.showIcon ? '<i class="' + that.options.iconBase + ' ' + thisData.icon + '"></i> ' : '',
                subtext,
                titleItem;

            if (that.options.showSubtext && thisData.subtext && !that.multiple) {
              subtext = ' <small class="text-muted">' + thisData.subtext + '</small>';
            } else {
              subtext = '';
            }

            if (option.title) {
              titleItem = option.title;
            } else if (thisData.content && that.options.showContent) {
              titleItem = thisData.content.toString();
            } else {
              titleItem = icon + option.innerHTML.trim() + subtext;
            }

            selectedItemsInTitle.push(titleItem);
          }
        }
      }

      //Fixes issue in IE10 occurring when no default option is selected and at least one option is disabled
      //Convert all the values into a comma delimited string
      var title = !this.multiple ? selectedItemsInTitle[0] : selectedItemsInTitle.join(this.options.multipleSeparator);

      // add ellipsis
      if (selectedItems.length > 50) title += '...';

      // If this is a multiselect, and selectedTextFormat is count, then show 1 of 2 selected etc..
      if (this.multiple && this.options.selectedTextFormat.indexOf('count') !== -1) {
        var max = this.options.selectedTextFormat.split('>');

        if ((max.length > 1 && selectedItems.length > max[1]) || (max.length === 1 && selectedItems.length >= 2)) {
          var totalCount = this.selectpicker.view.availableOptionsCount,
              tr8nText = (typeof this.options.countSelectedText === 'function') ? this.options.countSelectedText(selectedItems.length, totalCount) : this.options.countSelectedText;

          title = tr8nText.replace('{0}', selectedItems.length.toString()).replace('{1}', totalCount.toString());
        }
      }

      if (this.options.title == undefined) {
        // use .attr to ensure undefined is returned if title attribute is not set
        this.options.title = this.$element.attr('title');
      }

      if (this.options.selectedTextFormat == 'static') {
        title = this.options.title;
      }

      //If we dont have a title, then use the default, or if nothing is set at all, use the not selected text
      if (!title) {
        title = typeof this.options.title !== 'undefined' ? this.options.title : this.options.noneSelectedText;
      }

      //strip all HTML tags and trim the result, then unescape any escaped tags
      this.$button[0].title = htmlUnescape(title.replace(/<[^>]*>?/g, '').trim());
      this.$button.find('.filter-option-inner-inner')[0].innerHTML = title;

      this.$element.trigger('rendered.bs.select');
    },

    /**
     * @param [style]
     * @param [status]
     */
    setStyle: function (style, status) {
      if (this.$element.attr('class')) {
        this.$newElement.addClass(this.$element.attr('class').replace(/selectpicker|mobile-device|bs-select-hidden|validate\[.*\]/gi, ''));
      }

      var buttonClass = style ? style : this.options.style;

      if (status == 'add') {
        this.$button.addClass(buttonClass);
      } else if (status == 'remove') {
        this.$button.removeClass(buttonClass);
      } else {
        this.$button.removeClass(this.options.style);
        this.$button.addClass(buttonClass);
      }
    },

    liHeight: function (refresh) {
      if (!refresh && (this.options.size === false || this.sizeInfo)) return;

      if (!this.sizeInfo) this.sizeInfo = {};

      var newElement = document.createElement('div'),
          menu = document.createElement('div'),
          menuInner = document.createElement('div'),
          menuInnerInner = document.createElement('ul'),
          divider = document.createElement('li'),
          dropdownHeader = document.createElement('li'),
          li = document.createElement('li'),
          a = document.createElement('a'),
          text = document.createElement('span'),
          header = this.options.header && this.$menu.find('.' + classNames.POPOVERHEADER).length > 0 ? this.$menu.find('.' + classNames.POPOVERHEADER)[0].cloneNode(true) : null,
          search = this.options.liveSearch ? document.createElement('div') : null,
          actions = this.options.actionsBox && this.multiple && this.$menu.find('.bs-actionsbox').length > 0 ? this.$menu.find('.bs-actionsbox')[0].cloneNode(true) : null,
          doneButton = this.options.doneButton && this.multiple && this.$menu.find('.bs-donebutton').length > 0 ? this.$menu.find('.bs-donebutton')[0].cloneNode(true) : null;

      this.sizeInfo.selectWidth = this.$newElement[0].offsetWidth;

      text.className = 'text';
      a.className = 'dropdown-item ' + this.$element.find('option')[0].className;
      newElement.className = this.$menu[0].parentNode.className + ' ' + classNames.SHOW;
      newElement.style.width = this.sizeInfo.selectWidth + 'px';
      if (this.options.width === 'auto') menu.style.minWidth = 0;
      menu.className = classNames.MENU + ' ' + classNames.SHOW;
      menuInner.className = 'inner ' + classNames.SHOW;
      menuInnerInner.className = classNames.MENU + ' inner ' + (version.major === '4' ? classNames.SHOW : '');
      divider.className = classNames.DIVIDER;
      dropdownHeader.className = 'dropdown-header';

      text.appendChild(document.createTextNode('Inner text'));
      a.appendChild(text);
      li.appendChild(a);
      dropdownHeader.appendChild(text.cloneNode(true));

      if (this.selectpicker.view.widestOption) {
        menuInnerInner.appendChild(this.selectpicker.view.widestOption.cloneNode(true));
      }

      menuInnerInner.appendChild(li);
      menuInnerInner.appendChild(divider);
      menuInnerInner.appendChild(dropdownHeader);
      if (header) menu.appendChild(header);
      if (search) {
        var input = document.createElement('input');
        search.className = 'bs-searchbox';
        input.className = 'form-control';
        search.appendChild(input);
        menu.appendChild(search);
      }
      if (actions) menu.appendChild(actions);
      menuInner.appendChild(menuInnerInner);
      menu.appendChild(menuInner);
      if (doneButton) menu.appendChild(doneButton);
      newElement.appendChild(menu);

      document.body.appendChild(newElement);

      var liHeight = a.offsetHeight,
          dropdownHeaderHeight = dropdownHeader ? dropdownHeader.offsetHeight : 0,
          headerHeight = header ? header.offsetHeight : 0,
          searchHeight = search ? search.offsetHeight : 0,
          actionsHeight = actions ? actions.offsetHeight : 0,
          doneButtonHeight = doneButton ? doneButton.offsetHeight : 0,
          dividerHeight = $(divider).outerHeight(true),
          // fall back to jQuery if getComputedStyle is not supported
          menuStyle = window.getComputedStyle ? window.getComputedStyle(menu) : false,
          menuWidth = menu.offsetWidth,
          $menu = menuStyle ? null : $(menu),
          menuPadding = {
            vert: toInteger(menuStyle ? menuStyle.paddingTop : $menu.css('paddingTop')) +
                  toInteger(menuStyle ? menuStyle.paddingBottom : $menu.css('paddingBottom')) +
                  toInteger(menuStyle ? menuStyle.borderTopWidth : $menu.css('borderTopWidth')) +
                  toInteger(menuStyle ? menuStyle.borderBottomWidth : $menu.css('borderBottomWidth')),
            horiz: toInteger(menuStyle ? menuStyle.paddingLeft : $menu.css('paddingLeft')) +
                  toInteger(menuStyle ? menuStyle.paddingRight : $menu.css('paddingRight')) +
                  toInteger(menuStyle ? menuStyle.borderLeftWidth : $menu.css('borderLeftWidth')) +
                  toInteger(menuStyle ? menuStyle.borderRightWidth : $menu.css('borderRightWidth'))
          },
          menuExtras =  {
            vert: menuPadding.vert +
                  toInteger(menuStyle ? menuStyle.marginTop : $menu.css('marginTop')) +
                  toInteger(menuStyle ? menuStyle.marginBottom : $menu.css('marginBottom')) + 2,
            horiz: menuPadding.horiz +
                  toInteger(menuStyle ? menuStyle.marginLeft : $menu.css('marginLeft')) +
                  toInteger(menuStyle ? menuStyle.marginRight : $menu.css('marginRight')) + 2
          },
          scrollBarWidth;

      menuInner.style.overflowY = 'scroll';

      scrollBarWidth = menu.offsetWidth - menuWidth;

      document.body.removeChild(newElement);

      this.sizeInfo.liHeight = liHeight;
      this.sizeInfo.dropdownHeaderHeight = dropdownHeaderHeight;
      this.sizeInfo.headerHeight = headerHeight;
      this.sizeInfo.searchHeight = searchHeight;
      this.sizeInfo.actionsHeight = actionsHeight;
      this.sizeInfo.doneButtonHeight = doneButtonHeight;
      this.sizeInfo.dividerHeight = dividerHeight;
      this.sizeInfo.menuPadding = menuPadding;
      this.sizeInfo.menuExtras = menuExtras;
      this.sizeInfo.menuWidth = menuWidth;
      this.sizeInfo.totalMenuWidth = this.sizeInfo.menuWidth;
      this.sizeInfo.scrollBarWidth = scrollBarWidth;
      this.sizeInfo.selectHeight = this.$newElement[0].offsetHeight;

      this.setPositionData();
    },

    getSelectPosition: function () {
      var that = this,
          $window = $(window),
          pos = that.$newElement.offset(),
          $container = $(that.options.container),
          containerPos;

      if (that.options.container && !$container.is('body')) {
        containerPos = $container.offset();
        containerPos.top += parseInt($container.css('borderTopWidth'));
        containerPos.left += parseInt($container.css('borderLeftWidth'));
      } else {
        containerPos = { top: 0, left: 0 };
      }

      var winPad = that.options.windowPadding;

      this.sizeInfo.selectOffsetTop = pos.top - containerPos.top - $window.scrollTop();
      this.sizeInfo.selectOffsetBot = $window.height() - this.sizeInfo.selectOffsetTop - this.sizeInfo['selectHeight'] - containerPos.top - winPad[2];
      this.sizeInfo.selectOffsetLeft = pos.left - containerPos.left - $window.scrollLeft();
      this.sizeInfo.selectOffsetRight = $window.width() - this.sizeInfo.selectOffsetLeft - this.sizeInfo['selectWidth'] - containerPos.left - winPad[1];
      this.sizeInfo.selectOffsetTop -= winPad[0];
      this.sizeInfo.selectOffsetLeft -= winPad[3];
    },

    setMenuSize: function (isAuto) {
      this.getSelectPosition();

      var selectWidth = this.sizeInfo['selectWidth'],
          liHeight = this.sizeInfo['liHeight'],
          headerHeight = this.sizeInfo['headerHeight'],
          searchHeight = this.sizeInfo['searchHeight'],
          actionsHeight = this.sizeInfo['actionsHeight'],
          doneButtonHeight = this.sizeInfo['doneButtonHeight'],
          divHeight = this.sizeInfo['dividerHeight'],
          menuPadding = this.sizeInfo['menuPadding'],
          menuInnerHeight,
          menuHeight,
          divLength = 0,
          minHeight,
          _minHeight,
          maxHeight,
          menuInnerMinHeight,
          estimate;

      if (this.options.dropupAuto) {
        // Get the estimated height of the menu without scrollbars.
        // This is useful for smaller menus, where there might be plenty of room
        // below the button without setting dropup, but we can't know
        // the exact height of the menu until createView is called later
        estimate = liHeight * this.selectpicker.current.elements.length + menuPadding.vert;
        this.$newElement.toggleClass(classNames.DROPUP, this.sizeInfo.selectOffsetTop - this.sizeInfo.selectOffsetBot > this.sizeInfo.menuExtras.vert && estimate + this.sizeInfo.menuExtras.vert + 50 > this.sizeInfo.selectOffsetBot);
      }

      if (this.options.size === 'auto') {
        _minHeight = this.selectpicker.current.elements.length > 3 ? this.sizeInfo.liHeight * 3 + this.sizeInfo.menuExtras.vert - 2 : 0;
        menuHeight = this.sizeInfo.selectOffsetBot - this.sizeInfo.menuExtras.vert;
        minHeight = _minHeight + headerHeight + searchHeight + actionsHeight + doneButtonHeight;
        menuInnerMinHeight = Math.max(_minHeight - menuPadding.vert, 0);

        if (this.$newElement.hasClass(classNames.DROPUP)) {
          menuHeight = this.sizeInfo.selectOffsetTop - this.sizeInfo.menuExtras.vert;
        }

        maxHeight = menuHeight;
        menuInnerHeight = menuHeight - headerHeight - searchHeight - actionsHeight - doneButtonHeight - menuPadding.vert;
      } else if (this.options.size && this.options.size != 'auto' && this.selectpicker.current.elements.length > this.options.size) {
        for (var i = 0; i < this.options.size; i++) {
          if (this.selectpicker.current.data[i].type === 'divider') divLength++;
        }

        menuHeight = liHeight * this.options.size + divLength * divHeight + menuPadding.vert;
        menuInnerHeight = menuHeight - menuPadding.vert;
        maxHeight = menuHeight + headerHeight + searchHeight + actionsHeight + doneButtonHeight;
        minHeight = menuInnerMinHeight = '';
      }

      if (this.options.dropdownAlignRight === 'auto') {
        this.$menu.toggleClass(classNames.MENURIGHT, this.sizeInfo.selectOffsetLeft > this.sizeInfo.selectOffsetRight && this.sizeInfo.selectOffsetRight < (this.$menu[0].offsetWidth - selectWidth));
      }

      this.$menu.css({
        'max-height': maxHeight + 'px',
        'overflow': 'hidden',
        'min-height': minHeight + 'px'
      });

      this.$menuInner.css({
        'max-height': menuInnerHeight + 'px',
        'overflow-y': 'auto',
        'min-height': menuInnerMinHeight + 'px'
      });

      this.sizeInfo['menuInnerHeight'] = menuInnerHeight;

      if (this.selectpicker.current.data.length && this.selectpicker.current.data[this.selectpicker.current.data.length - 1].position > this.sizeInfo.menuInnerHeight) {
        this.sizeInfo.hasScrollBar = true;
        this.sizeInfo.totalMenuWidth = this.sizeInfo.menuWidth + this.sizeInfo.scrollBarWidth;

        this.$menu.css('min-width', this.sizeInfo.totalMenuWidth);
      }

      if (this.dropdown && this.dropdown._popper) this.dropdown._popper.update();
    },

    setSize: function (refresh) {
      this.liHeight(refresh);

      if (this.options.header) this.$menu.css('padding-top', 0);
      if (this.options.size === false) return;

      var that = this,
          $window = $(window),
          selectedIndex,
          offset = 0;

      this.setMenuSize();

      if (this.options.size === 'auto') {
        this.$searchbox.off('input.setMenuSize propertychange.setMenuSize').on('input.setMenuSize propertychange.setMenuSize', function() {
          return that.setMenuSize();
        });
        $window.off('resize.setMenuSize scroll.setMenuSize').on('resize.setMenuSize scroll.setMenuSize', function() {
          return that.setMenuSize();
        });
      } else if (this.options.size && this.options.size != 'auto' && this.selectpicker.current.elements.length > this.options.size) {
        this.$searchbox.off('input.setMenuSize propertychange.setMenuSize');
        $window.off('resize.setMenuSize scroll.setMenuSize');
      }

      if (refresh) {
        offset = this.$menuInner[0].scrollTop;
      } else if (!that.multiple) {
        selectedIndex = that.selectpicker.main.map.newIndex[that.$element[0].selectedIndex];

        if (typeof selectedIndex === 'number' && that.options.size !== false) {
          offset = that.sizeInfo.liHeight * selectedIndex;
          offset = offset - (that.sizeInfo.menuInnerHeight / 2) + (that.sizeInfo.liHeight / 2);
        }
      }

      that.createView(false, offset);
    },

    setWidth: function () {
      var that = this;

      if (this.options.width === 'auto') {
        requestAnimationFrame(function() {
          that.$menu.css('min-width', '0');
          that.liHeight();
          that.setMenuSize();

          // Get correct width if element is hidden
          var $selectClone = that.$newElement.clone().appendTo('body'),
              btnWidth = $selectClone.css('width', 'auto').children('button').outerWidth();

          $selectClone.remove();

          // Set width to whatever's larger, button title or longest option
          that.sizeInfo.selectWidth = Math.max(that.sizeInfo.totalMenuWidth, btnWidth);
          that.$newElement.css('width', that.sizeInfo.selectWidth + 'px');
        });
      } else if (this.options.width === 'fit') {
        // Remove inline min-width so width can be changed from 'auto'
        this.$menu.css('min-width', '');
        this.$newElement.css('width', '').addClass('fit-width');
      } else if (this.options.width) {
        // Remove inline min-width so width can be changed from 'auto'
        this.$menu.css('min-width', '');
        this.$newElement.css('width', this.options.width);
      } else {
        // Remove inline min-width/width so width can be changed
        this.$menu.css('min-width', '');
        this.$newElement.css('width', '');
      }
      // Remove fit-width class if width is changed programmatically
      if (this.$newElement.hasClass('fit-width') && this.options.width !== 'fit') {
        this.$newElement.removeClass('fit-width');
      }
    },

    selectPosition: function () {
      this.$bsContainer = $('<div class="bs-container" />');

      var that = this,
          $container = $(this.options.container),
          pos,
          containerPos,
          actualHeight,
          getPlacement = function ($element) {
            var containerPosition = {},
                // fall back to dropdown's default display setting if display is not manually set
                display = that.options.display || $.fn.dropdown.Constructor.Default.display;

            that.$bsContainer.addClass($element.attr('class').replace(/form-control|fit-width/gi, '')).toggleClass(classNames.DROPUP, $element.hasClass(classNames.DROPUP));
            pos = $element.offset();

            if (!$container.is('body')) {
              containerPos = $container.offset();
              containerPos.top += parseInt($container.css('borderTopWidth')) - $container.scrollTop();
              containerPos.left += parseInt($container.css('borderLeftWidth')) - $container.scrollLeft();
            } else {
              containerPos = { top: 0, left: 0 };
            }

            actualHeight = $element.hasClass(classNames.DROPUP) ? 0 : $element[0].offsetHeight;

            // Bootstrap 4+ uses Popper for menu positioning
            if (version.major < 4 || display === 'static') {
              containerPosition['top'] = pos.top - containerPos.top + actualHeight;
              containerPosition['left'] = pos.left - containerPos.left;
            }

            containerPosition['width'] = $element[0].offsetWidth;

            that.$bsContainer.css(containerPosition);
          };

      this.$button.on('click.bs.dropdown.data-api', function () {
        if (that.isDisabled()) {
          return;
        }

        getPlacement(that.$newElement);

        that.$bsContainer
          .appendTo(that.options.container)
          .toggleClass(classNames.SHOW, !that.$button.hasClass(classNames.SHOW))
          .append(that.$menu);
      });

      $(window).on('resize scroll', function () {
        getPlacement(that.$newElement);
      });

      this.$element.on('hide.bs.select', function () {
        that.$menu.data('height', that.$menu.height());
        that.$bsContainer.detach();
      });
    },

    setOptionStatus: function () {
      var that = this,
          $selectOptions = this.$element.find('option');

      that.noScroll = false;

      if (that.selectpicker.view.visibleElements && that.selectpicker.view.visibleElements.length) {
        for (var i = 0; i < that.selectpicker.view.visibleElements.length; i++) {
          var index = that.selectpicker.current.map.originalIndex[i + that.selectpicker.view.position0], // faster than $(li).data('originalIndex')
              option = $selectOptions[index];

          if (option) {
            var liIndex = this.selectpicker.main.map.newIndex[index],
                li = this.selectpicker.main.elements[liIndex];

            that.setDisabled(
              index,
              option.disabled || option.parentNode.tagName === 'OPTGROUP' && option.parentNode.disabled,
              liIndex,
              li
            );

            that.setSelected(
              index,
              option.selected,
              liIndex,
              li
            );
          }
        }
      }
    },

    /**
     * @param {number} index - the index of the option that is being changed
     * @param {boolean} selected - true if the option is being selected, false if being deselected
     */
    setSelected: function (index, selected, liIndex, li) {
      var activeIndexIsSet = this.activeIndex !== undefined,
          thisIsActive = this.activeIndex === index,
          prevActiveIndex,
          prevActive,
          a,
          // if current option is already active
          // OR
          // if the current option is being selected, it's NOT multiple, and
          // activeIndex is undefined:
          //  - when the menu is first being opened, OR
          //  - after a search has been performed, OR
          //  - when retainActive is false when selecting a new option (i.e. index of the newly selected option is not the same as the current activeIndex)
          keepActive = thisIsActive || selected && !this.multiple && !activeIndexIsSet;

      if (!liIndex) liIndex = this.selectpicker.main.map.newIndex[index];
      if (!li) li = this.selectpicker.main.elements[liIndex];

      a = li.firstChild;

      if (selected) {
        this.selectedIndex = index;
      }

      li.classList.toggle('selected', selected);
      li.classList.toggle('active', keepActive);

      if (keepActive) {
        this.selectpicker.view.currentActive = li;
        this.activeIndex = index;
      }

      if (a) {
        a.classList.toggle('selected', selected);
        a.classList.toggle('active', keepActive);
        a.setAttribute('aria-selected', selected);
      }

      if (!keepActive) {
        if (!activeIndexIsSet && selected && this.prevActiveIndex !== undefined) {
          prevActiveIndex = this.selectpicker.main.map.newIndex[this.prevActiveIndex];
          prevActive = this.selectpicker.main.elements[prevActiveIndex];

          prevActive.classList.toggle('selected', selected);
          prevActive.classList.remove('active');
          if (prevActive.firstChild) {
            prevActive.firstChild.classList.toggle('selected', selected);
            prevActive.firstChild.classList.remove('active');
          }
        }
      }
    },

    /**
     * @param {number} index - the index of the option that is being disabled
     * @param {boolean} disabled - true if the option is being disabled, false if being enabled
     */
    setDisabled: function (index, disabled, liIndex, li) {
      var a;

      if (!liIndex) liIndex = this.selectpicker.main.map.newIndex[index];
      if (!li) li = this.selectpicker.main.elements[liIndex];

      a = li.firstChild;

      li.classList.toggle(classNames.DISABLED, disabled);

      if (a) {
        if (version.major === '4') a.classList.toggle(classNames.DISABLED, disabled);

        a.setAttribute('aria-disabled', disabled);

        if (disabled) {
          a.setAttribute('tabindex', -1);
        } else {
          a.setAttribute('tabindex', 0);
        }
      }
    },

    isDisabled: function () {
      return this.$element[0].disabled;
    },

    checkDisabled: function () {
      var that = this;

      if (this.isDisabled()) {
        this.$newElement.addClass(classNames.DISABLED);
        this.$button.addClass(classNames.DISABLED).attr('tabindex', -1).attr('aria-disabled', true);
      } else {
        if (this.$button.hasClass(classNames.DISABLED)) {
          this.$newElement.removeClass(classNames.DISABLED);
          this.$button.removeClass(classNames.DISABLED).attr('aria-disabled', false);
        }

        if (this.$button.attr('tabindex') == -1 && !this.$element.data('tabindex')) {
          this.$button.removeAttr('tabindex');
        }
      }

      this.$button.click(function () {
        return !that.isDisabled();
      });
    },

    togglePlaceholder: function () {
      // much faster than calling $.val()
      var element = this.$element[0],
          selectedIndex = element.selectedIndex,
          nothingSelected = selectedIndex === -1;

      if (!nothingSelected && !element.options[selectedIndex].value) nothingSelected = true;

      this.$button.toggleClass('bs-placeholder', nothingSelected);
    },

    tabIndex: function () {
      if (this.$element.data('tabindex') !== this.$element.attr('tabindex') && 
        (this.$element.attr('tabindex') !== -98 && this.$element.attr('tabindex') !== '-98')) {
        this.$element.data('tabindex', this.$element.attr('tabindex'));
        this.$button.attr('tabindex', this.$element.data('tabindex'));
      }

      this.$element.attr('tabindex', -98);
    },

    clickListener: function () {
      var that = this,
          $document = $(document);

      $document.data('spaceSelect', false);

      this.$button.on('keyup', function (e) {
        if (/(32)/.test(e.keyCode.toString(10)) && $document.data('spaceSelect')) {
            e.preventDefault();
            $document.data('spaceSelect', false);
        }
      });

      this.$newElement.on('show.bs.dropdown', function() {
        if (version.major > 3 && !that.dropdown) {
          that.dropdown = that.$button.data('bs.dropdown');
          that.dropdown._menu = that.$menu[0];
        }
      });

      this.$button.on('click.bs.dropdown.data-api', function () {
        if (!that.$newElement.hasClass(classNames.SHOW)) {
          that.setSize();
        }
      });

      function setFocus () {
        if (that.options.liveSearch) {
          that.$searchbox.focus();
        } else {
          that.$menuInner.focus();
        }
      }

      function checkPopperExists () {
        if (that.dropdown && that.dropdown._popper && that.dropdown._popper.state.isCreated) {
          setFocus();
        } else {
          requestAnimationFrame(checkPopperExists);
        }
      }

      this.$element.on('shown.bs.select', function () {
        if (that.$menuInner[0].scrollTop !== that.selectpicker.view.scrollTop) {
          that.$menuInner[0].scrollTop = that.selectpicker.view.scrollTop;
        }

        if (version.major > 3) {
          requestAnimationFrame(checkPopperExists);
        } else {
          setFocus();
        }        
      });

      this.$menuInner.on('click', 'li a', function (e, retainActive) {
        var $this = $(this),
            position0 = that.isVirtual() ? that.selectpicker.view.position0 : 0,
            clickedIndex = that.selectpicker.current.map.originalIndex[$this.parent().index() + position0],
            prevValue = getSelectValues(that.$element[0]),
            prevIndex = that.$element.prop('selectedIndex'),
            triggerChange = true;

        // Don't close on multi choice menu
        if (that.multiple && that.options.maxOptions !== 1) {
          e.stopPropagation();
        }

        e.preventDefault();

        //Don't run if we have been disabled
        if (!that.isDisabled() && !$this.parent().hasClass(classNames.DISABLED)) {
          var $options = that.$element.find('option'),
              $option = $options.eq(clickedIndex),
              state = $option.prop('selected'),
              $optgroup = $option.parent('optgroup'),
              $optgroupOptions = $optgroup.find('option'),
              maxOptions = that.options.maxOptions,
              maxOptionsGrp = $optgroup.data('maxOptions') || false;
              
          if (clickedIndex === that.activeIndex) retainActive = true;

          if (!retainActive) {
            that.prevActiveIndex = that.activeIndex;
            that.activeIndex = undefined;
          }

          if (!that.multiple) { // Deselect all others if not multi select box
            $options.prop('selected', false);
            $option.prop('selected', true);
            that.setSelected(clickedIndex, true);
          } else { // Toggle the one we have chosen if we are multi select.
            $option.prop('selected', !state);

            that.setSelected(clickedIndex, !state);
            $this.blur();

            if (maxOptions !== false || maxOptionsGrp !== false) {
              var maxReached = maxOptions < $options.filter(':selected').length,
                  maxReachedGrp = maxOptionsGrp < $optgroup.find('option:selected').length;

              if ((maxOptions && maxReached) || (maxOptionsGrp && maxReachedGrp)) {
                if (maxOptions && maxOptions == 1) {
                  $options.prop('selected', false);
                  $option.prop('selected', true);

                  for (var i = 0; i < $options.length; i++) {
                    that.setSelected(i, false);
                  }

                  that.setSelected(clickedIndex, true);
                } else if (maxOptionsGrp && maxOptionsGrp == 1) {
                  $optgroup.find('option:selected').prop('selected', false);
                  $option.prop('selected', true);

                  for (var i = 0; i < $optgroupOptions.length; i++) {
                    var option = $optgroupOptions[i];
                    that.setSelected($options.index(option), false);
                  }

                  that.setSelected(clickedIndex, true);
                } else {
                  var maxOptionsText = typeof that.options.maxOptionsText === 'string' ? [that.options.maxOptionsText, that.options.maxOptionsText] : that.options.maxOptionsText,
                      maxOptionsArr = typeof maxOptionsText === 'function' ? maxOptionsText(maxOptions, maxOptionsGrp) : maxOptionsText,
                      maxTxt = maxOptionsArr[0].replace('{n}', maxOptions),
                      maxTxtGrp = maxOptionsArr[1].replace('{n}', maxOptionsGrp),
                      $notify = $('<div class="notify"></div>');
                  // If {var} is set in array, replace it
                  /** @deprecated */
                  if (maxOptionsArr[2]) {
                    maxTxt = maxTxt.replace('{var}', maxOptionsArr[2][maxOptions > 1 ? 0 : 1]);
                    maxTxtGrp = maxTxtGrp.replace('{var}', maxOptionsArr[2][maxOptionsGrp > 1 ? 0 : 1]);
                  }

                  $option.prop('selected', false);

                  that.$menu.append($notify);

                  if (maxOptions && maxReached) {
                    $notify.append($('<div>' + maxTxt + '</div>'));
                    triggerChange = false;
                    that.$element.trigger('maxReached.bs.select');
                  }

                  if (maxOptionsGrp && maxReachedGrp) {
                    $notify.append($('<div>' + maxTxtGrp + '</div>'));
                    triggerChange = false;
                    that.$element.trigger('maxReachedGrp.bs.select');
                  }

                  setTimeout(function () {
                    that.setSelected(clickedIndex, false);
                  }, 10);

                  $notify.delay(750).fadeOut(300, function () {
                    $(this).remove();
                  });
                }
              }
            }
          }

          if (!that.multiple || (that.multiple && that.options.maxOptions === 1)) {
            that.$button.focus();
          } else if (that.options.liveSearch) {
            that.$searchbox.focus();
          }

          // Trigger select 'change'
          if (triggerChange) {
            if ((prevValue != getSelectValues(that.$element[0]) && that.multiple) || (prevIndex != that.$element.prop('selectedIndex') && !that.multiple)) {
              // $option.prop('selected') is current option state (selected/unselected). prevValue is the value of the select prior to being changed.
              changed_arguments = [clickedIndex, $option.prop('selected'), prevValue];
              that.$element
                .triggerNative('change');
            }
          }
        }
      });

      this.$menu.on('click', 'li.' + classNames.DISABLED + ' a, .' + classNames.POPOVERHEADER + ', .' + classNames.POPOVERHEADER + ' :not(.close)', function (e) {
        if (e.currentTarget == this) {
          e.preventDefault();
          e.stopPropagation();
          if (that.options.liveSearch && !$(e.target).hasClass('close')) {
            that.$searchbox.focus();
          } else {
            that.$button.focus();
          }
        }
      });

      this.$menuInner.on('click', '.divider, .dropdown-header', function (e) {
        e.preventDefault();
        e.stopPropagation();
        if (that.options.liveSearch) {
          that.$searchbox.focus();
        } else {
          that.$button.focus();
        }
      });

      this.$menu.on('click', '.' + classNames.POPOVERHEADER + ' .close', function () {
        that.$button.click();
      });

      this.$searchbox.on('click', function (e) {
        e.stopPropagation();
      });

      this.$menu.on('click', '.actions-btn', function (e) {
        if (that.options.liveSearch) {
          that.$searchbox.focus();
        } else {
          that.$button.focus();
        }

        e.preventDefault();
        e.stopPropagation();

        if ($(this).hasClass('bs-select-all')) {
          that.selectAll();
        } else {
          that.deselectAll();
        }
      });

      this.$element.on({
        'change': function () {
          that.render();
          that.$element.trigger('changed.bs.select', changed_arguments);
          changed_arguments = null;
        },
        'focus': function () {
          that.$button.focus();
        }
      });
    },

    liveSearchListener: function () {
      var that = this,
          no_results = document.createElement('li');

      this.$button.on('click.bs.dropdown.data-api', function () {
        if (!!that.$searchbox.val()) {
          that.$searchbox.val('');
        }
      });

      this.$searchbox.on('click.bs.dropdown.data-api focus.bs.dropdown.data-api touchend.bs.dropdown.data-api', function (e) {
        e.stopPropagation();
      });

      this.$searchbox.on('input propertychange', function () {
        var searchValue = that.$searchbox.val();
        
        that.selectpicker.search.map.newIndex = {};
        that.selectpicker.search.map.originalIndex = {};
        that.selectpicker.search.elements = [];
        that.selectpicker.search.data = [];

        if (searchValue) {
          var i,
              searchMatch = [],
              q = searchValue.toUpperCase(),
              cache = {},
              cacheArr = [],
              searchStyle = that._searchStyle(),
              normalizeSearch = that.options.liveSearchNormalize;

          that._$lisSelected = that.$menuInner.find('.selected');

          for (var i = 0; i < that.selectpicker.main.data.length; i++) {
            var li = that.selectpicker.main.data[i];

            if (!cache[i]) {
              cache[i] = stringSearch(li, q, searchStyle, normalizeSearch);
            }

            if (cache[i] && li.headerIndex !== undefined && cacheArr.indexOf(li.headerIndex) === -1) {
              if (li.headerIndex > 0) {
                cache[li.headerIndex - 1] = true;
                cacheArr.push(li.headerIndex - 1);
              }

              cache[li.headerIndex] = true;
              cacheArr.push(li.headerIndex);
              
              cache[li.lastIndex + 1] = true;
            }

            if (cache[i] && li.type !== 'optgroup-label') cacheArr.push(i);
          }

          for (var i = 0, cacheLen = cacheArr.length; i < cacheLen; i++) {
            var index = cacheArr[i],
                prevIndex = cacheArr[i - 1],
                li = that.selectpicker.main.data[index],
                liPrev = that.selectpicker.main.data[prevIndex];
                
            if ( li.type !== 'divider' || ( li.type === 'divider' && liPrev && liPrev.type !== 'divider' && cacheLen - 1 !== i ) ) {
              that.selectpicker.search.data.push(li);
              searchMatch.push(that.selectpicker.main.elements[index]);

              if (li.hasOwnProperty('originalIndex')) {
                that.selectpicker.search.map.newIndex[li.originalIndex] = searchMatch.length - 1;
                that.selectpicker.search.map.originalIndex[searchMatch.length - 1] = li.originalIndex;
              }
            }
          }

          that.activeIndex = undefined;
          that.noScroll = true;
          that.$menuInner.scrollTop(0);
          that.selectpicker.search.elements = searchMatch;
          that.createView(true);

          if (!searchMatch.length) {
            no_results.className = 'no-results';
            no_results.innerHTML = that.options.noneResultsText.replace('{0}', '"' + htmlEscape(searchValue) + '"');
            that.$menuInner[0].firstChild.appendChild(no_results);
          }
        } else {
          that.$menuInner.scrollTop(0);
          that.createView(false);
        }
      });
    },

    _searchStyle: function () {
      return this.options.liveSearchStyle || 'contains';
    },

    val: function (value) {
      if (typeof value !== 'undefined') {
        this.$element
          .val(value)
          .triggerNative('change');

        return this.$element;
      } else {
        return this.$element.val();
      }
    },

    changeAll: function (status) {
      if (!this.multiple) return;
      if (typeof status === 'undefined') status = true;

      var $selectOptions = this.$element.find('option'),
          previousSelected = 0,
          currentSelected = 0,
          prevValue = getSelectValues(this.$element[0]);

      this.$element.addClass('bs-select-hidden');

      for (var i = 0; i < this.selectpicker.current.elements.length; i++) {
        var liData = this.selectpicker.current.data[i],
            index = this.selectpicker.current.map.originalIndex[i], // faster than $(li).data('originalIndex')
            option = $selectOptions[index];

        if (option && !option.disabled && liData.type !== 'divider') {
          if (option.selected) previousSelected++;
          option.selected = status;
          if (option.selected) currentSelected++;
        }
      }

      this.$element.removeClass('bs-select-hidden');

      if (previousSelected === currentSelected) return;

      this.setOptionStatus();

      this.togglePlaceholder();

      changed_arguments = [null, null, prevValue];

      this.$element
        .triggerNative('change');
    },

    selectAll: function () {
      return this.changeAll(true);
    },

    deselectAll: function () {
      return this.changeAll(false);
    },

    toggle: function (e) {
      e = e || window.event;

      if (e) e.stopPropagation();

      this.$button.trigger('click.bs.dropdown.data-api');
    },

    keydown: function (e) {
      var $this = $(this),
          isToggle = $this.hasClass('dropdown-toggle'),
          $parent = isToggle ? $this.closest('.dropdown') : $this.closest(Selector.MENU),
          that = $parent.data('this'),
          $items = that.findLis(),
          index,
          isActive,
          liActive,
          activeLi,
          offset,
          updateScroll = false,
          downOnTab = e.which === keyCodes.TAB && !isToggle && !that.options.selectOnTab,
          isArrowKey = REGEXP_ARROW.test(e.which) || downOnTab,
          scrollTop = that.$menuInner[0].scrollTop,
          isVirtual = that.isVirtual(),
          position0 = isVirtual === true ? that.selectpicker.view.position0 : 0;

      isActive = that.$newElement.hasClass(classNames.SHOW);

      if (
        !isActive &&
        (
          isArrowKey ||
          e.which >= 48 && e.which <= 57 ||
          e.which >= 96 && e.which <= 105 ||
          e.which >= 65 && e.which <= 90
        )
      ) {
        that.$button.trigger('click.bs.dropdown.data-api');
      }

      if (e.which === keyCodes.ESCAPE && isActive) {
        e.preventDefault();
        that.$button.trigger('click.bs.dropdown.data-api').focus();
      }

      if (isArrowKey) { // if up or down
        if (!$items.length) return;

        // $items.index/.filter is too slow with a large list and no virtual scroll
        index = isVirtual === true ? $items.index($items.filter('.active')) : that.selectpicker.current.map.newIndex[that.activeIndex];

        if (index === undefined) index = -1;

        if (index !== -1) {
          liActive = that.selectpicker.current.elements[index + position0];
          liActive.classList.remove('active');
          if (liActive.firstChild) liActive.firstChild.classList.remove('active');
        }

        if (e.which === keyCodes.ARROW_UP) { // up
          if (index !== -1) index--;
          if (index + position0 < 0) index += $items.length;

          if (!that.selectpicker.view.canHighlight[index + position0]) {
            index = that.selectpicker.view.canHighlight.slice(0, index + position0).lastIndexOf(true) - position0;
            if (index === -1) index = $items.length - 1;
          }
        } else if (e.which === keyCodes.ARROW_DOWN || downOnTab) { // down
          index++;
          if (index + position0 >= that.selectpicker.view.canHighlight.length) index = 0;

          if (!that.selectpicker.view.canHighlight[index + position0]) {
            index = index + 1 + that.selectpicker.view.canHighlight.slice(index + position0 + 1).indexOf(true);
          }
        }

        e.preventDefault();

        var liActiveIndex = position0 + index;

        if (e.which === keyCodes.ARROW_UP) { // up
          // scroll to bottom and highlight last option
          if (position0 === 0 && index === $items.length - 1) {
            that.$menuInner[0].scrollTop = that.$menuInner[0].scrollHeight;

            liActiveIndex = that.selectpicker.current.elements.length - 1;
          } else {
            activeLi = that.selectpicker.current.data[liActiveIndex];
            offset = activeLi.position - activeLi.height;

            updateScroll = offset < scrollTop;
          }
        } else if (e.which === keyCodes.ARROW_DOWN || downOnTab) { // down
          // scroll to top and highlight first option
          if (index === 0) {
            that.$menuInner[0].scrollTop = 0;

            liActiveIndex = 0;
          } else {
            activeLi = that.selectpicker.current.data[liActiveIndex];
            offset = activeLi.position - that.sizeInfo.menuInnerHeight;

            updateScroll = offset > scrollTop;
          }
        }

        liActive = that.selectpicker.current.elements[liActiveIndex];

        if (liActive) {
          liActive.classList.add('active');
          if (liActive.firstChild) liActive.firstChild.classList.add('active');
        }
        
        that.activeIndex = that.selectpicker.current.map.originalIndex[liActiveIndex];

        that.selectpicker.view.currentActive = liActive;

        if (updateScroll) that.$menuInner[0].scrollTop = offset;

        if (that.options.liveSearch) {
          that.$searchbox.focus();
        } else {
          $this.focus();
        }
      } else if (
        !$this.is('input') &&
        !REGEXP_TAB_OR_ESCAPE.test(e.which) ||
        (e.which === keyCodes.SPACE && that.selectpicker.keydown.keyHistory)
      ) {
        var searchMatch,
            matches = [],
            keyHistory;

        e.preventDefault();

        that.selectpicker.keydown.keyHistory += keyCodeMap[e.which];

        if (that.selectpicker.keydown.resetKeyHistory.cancel) clearTimeout(that.selectpicker.keydown.resetKeyHistory.cancel);
        that.selectpicker.keydown.resetKeyHistory.cancel = that.selectpicker.keydown.resetKeyHistory.start();

        keyHistory = that.selectpicker.keydown.keyHistory;

        // if all letters are the same, set keyHistory to just the first character when searching
        if (/^(.)\1+$/.test(keyHistory)) {
          keyHistory = keyHistory.charAt(0);
        }

        // find matches
        for (var i = 0; i < that.selectpicker.current.data.length; i++) {
          var li = that.selectpicker.current.data[i],
              hasMatch;

          hasMatch = stringSearch(li, keyHistory, 'startsWith', true);

          if (hasMatch && that.selectpicker.view.canHighlight[i]) {
            li.index = i;
            matches.push(li.originalIndex);
          }
        }

        if (matches.length) {
          var matchIndex = 0;

          $items.removeClass('active').find('a').removeClass('active');

          // either only one key has been pressed or they are all the same key
          if (keyHistory.length === 1) {
            matchIndex = matches.indexOf(that.activeIndex);

            if (matchIndex === -1 || matchIndex === matches.length - 1) {
              matchIndex = 0;
            } else {
              matchIndex++;
            }
          }

          searchMatch = that.selectpicker.current.map.newIndex[matches[matchIndex]];

          activeLi = that.selectpicker.current.data[searchMatch];

          if (scrollTop - activeLi.position > 0) {
            offset = activeLi.position - activeLi.height;
            updateScroll = true;
          } else {
            offset = activeLi.position - that.sizeInfo.menuInnerHeight;
            // if the option is already visible at the current scroll position, just keep it the same
            updateScroll = activeLi.position > scrollTop + that.sizeInfo.menuInnerHeight;         
          }

          liActive = that.selectpicker.current.elements[searchMatch];
          liActive.classList.add('active');
          if (liActive.firstChild) liActive.firstChild.classList.add('active');
          that.activeIndex = matches[matchIndex];

          liActive.firstChild.focus();

          if (updateScroll) that.$menuInner[0].scrollTop = offset;

          $this.focus();
        }
      }

      // Select focused option if "Enter", "Spacebar" or "Tab" (when selectOnTab is true) are pressed inside the menu.
      if (
        isActive &&
        (
          (e.which === keyCodes.SPACE && !that.selectpicker.keydown.keyHistory) ||
          e.which === keyCodes.ENTER ||
          (e.which === keyCodes.TAB && that.options.selectOnTab)
        )
      ) {
        if (e.which !== keyCodes.SPACE) e.preventDefault();

        if (!that.options.liveSearch || e.which !== keyCodes.SPACE) {
          that.$menuInner.find('.active a').trigger('click', true); // retain active class
          $this.focus();

          if (!that.options.liveSearch) {
            // Prevent screen from scrolling if the user hits the spacebar
            e.preventDefault();
            // Fixes spacebar selection of dropdown items in FF & IE
            $(document).data('spaceSelect', true);
          }
        }
      }
    },

    mobile: function () {
      this.$element.addClass('mobile-device');
    },

    refresh: function () {
      // update options if data attributes have been changed
      var config = $.extend({}, this.options, this.$element.data());
      this.options = config;

      this.selectpicker.main.map.newIndex = {};
      this.selectpicker.main.map.originalIndex = {};
      this.createLi();
      this.checkDisabled();
      this.render();
      this.setStyle();
      this.setWidth();

      this.setSize(true);

      this.$element.trigger('refreshed.bs.select');
    },

    hide: function () {
      this.$newElement.hide();
    },

    show: function () {
      this.$newElement.show();
    },

    remove: function () {
      this.$newElement.remove();
      this.$element.remove();
    },

    destroy: function () {
      this.$newElement.before(this.$element).remove();

      if (this.$bsContainer) {
        this.$bsContainer.remove();
      } else {
        this.$menu.remove();
      }

      this.$element
        .off('.bs.select')
        .removeData('selectpicker')
        .removeClass('bs-select-hidden selectpicker');
    }
  };

  // SELECTPICKER PLUGIN DEFINITION
  // ==============================
  function Plugin(option) {
    // get the args of the outer function..
    var args = arguments;
    // The arguments of the function are explicitly re-defined from the argument list, because the shift causes them
    // to get lost/corrupted in android 2.3 and IE9 #715 #775
    var _option = option;

    [].shift.apply(args);

    // if the version was not set successfully
    if (!version.success) {
      // try to retreive it again
      try {
        version.full = ($.fn.dropdown.Constructor.VERSION || '').split(' ')[0].split('.');
      }
      // fall back to use BootstrapVersion
      catch(err) {
        version.full = Selectpicker.BootstrapVersion.split(' ')[0].split('.');
      }

      version.major = version.full[0];
      version.success = true;

      if (version.major === '4') {
        classNames.DIVIDER = 'dropdown-divider';
        classNames.SHOW = 'show';
        classNames.BUTTONCLASS = 'btn-light';
        Selectpicker.DEFAULTS.style = classNames.BUTTONCLASS = 'btn-light';
        classNames.POPOVERHEADER = 'popover-header';
      }
    }

    var value;
    var chain = this.each(function () {
      var $this = $(this);
      if ($this.is('select')) {
        var data = $this.data('selectpicker'),
            options = typeof _option == 'object' && _option;

        if (!data) {
          var config = $.extend({}, Selectpicker.DEFAULTS, $.fn.selectpicker.defaults || {}, $this.data(), options);
          config.template = $.extend({}, Selectpicker.DEFAULTS.template, ($.fn.selectpicker.defaults ? $.fn.selectpicker.defaults.template : {}), $this.data().template, options.template);
          $this.data('selectpicker', (data = new Selectpicker(this, config)));
        } else if (options) {
          for (var i in options) {
            if (options.hasOwnProperty(i)) {
              data.options[i] = options[i];
            }
          }
        }

        if (typeof _option == 'string') {
          if (data[_option] instanceof Function) {
            value = data[_option].apply(data, args);
          } else {
            value = data.options[_option];
          }
        }
      }
    });

    if (typeof value !== 'undefined') {
      //noinspection JSUnusedAssignment
      return value;
    } else {
      return chain;
    }
  }

  var old = $.fn.selectpicker;
  $.fn.selectpicker = Plugin;
  $.fn.selectpicker.Constructor = Selectpicker;

  // SELECTPICKER NO CONFLICT
  // ========================
  $.fn.selectpicker.noConflict = function () {
    $.fn.selectpicker = old;
    return this;
  };

  $(document)
      .off('keydown.bs.dropdown.data-api')
      .on('keydown.bs.select', '.bootstrap-select [data-toggle="dropdown"], .bootstrap-select [role="listbox"], .bs-searchbox input', Selectpicker.prototype.keydown)
      .on('focusin.modal', '.bootstrap-select [data-toggle="dropdown"], .bootstrap-select [role="listbox"], .bs-searchbox input', function (e) {
        e.stopPropagation();
      });

  // SELECTPICKER DATA-API
  // =====================
  $(window).on('load.bs.select.data-api', function () {
    $('.selectpicker').each(function () {
      var $selectpicker = $(this);
      Plugin.call($selectpicker, $selectpicker.data());
    })
  });
})(jQuery);


}));


// ------------------------------------------- //
// get_window_sizes
function get_window_sizes(q){

	var w = window,
	d = document,
	e = d.documentElement,
	g = d.getElementsByTagName('body')[0],
	x = w.innerWidth || e.clientWidth || g.clientWidth,
	y = w.innerHeight|| e.clientHeight|| g.clientHeight;
	
	if(!q || q == 'w') return x;
	if(q == 'h') return y; 

}
// ------------------------------------------- //

function BC_scrolling_classes(ele){ 
	var lastScrollTop = 0;
	$(window).on('scroll resize', {
		previousTop: 0
		},
		function() {
			var currentTop = $(window).scrollTop(); 
			if( $("body").hasClass('scrolling') ){
				ele.addClass('scrolling');
				if (currentTop > lastScrollTop) { 
					ele.addClass('scrolling-down');
					ele.removeClass('scrolling-up');
				}else{
					ele.addClass('scrolling-up');
					ele.removeClass('scrolling-down');
				} 
			}else{
				ele.removeClass('scrolling-up');
				ele.removeClass('scrolling-down');
				ele.removeClass('scrolling');
			}
			lastScrollTop = currentTop; 
	});
	
}

/*!
 * BootClean v4.0.0 (http://rgdesign.org)
 * Copyright 1999-2016 Roberto Garcia.
 * Licensed under the MIT license
 */
 
/*!
 * BootClean Scroll To v 1.1
 * 
 * 2016/05 - scroll header offest fix when resize navbar height.
 */


 
var WPBC_scroll_to_args = {
		scroll_to_time_1: 300,
		scroll_to_time_2: 100,
		scroll_to_ease_1: 'easeOutCubic',
		scroll_to_ease_2: 'easeOutCubic'
	}; 

function bs_scroll_to_before_scroll(){
	var mainNavbar = $(bc_config.layout.main_navbar);
	var mainHeader = $(bc_config.layout.main_header); 

	if( !mainNavbar.find('.navbar-toggle').hasClass('collapsed')){
		mainNavbar.find('.navbar-toggle').trigger('click');
	} 
	if( $('body').hasClass('use-navbar-better') && $('body').hasClass('side-menu-visible') ){
		$('#side-menu').find('.navbar-toggler').trigger('click');
	}
}

function bs_scroll_to_offset(offset, elem){
	elem = elem || false;

	var extraH = 0;
	
	var mainNavbar = $(bc_config.layout.main_navbar);
	var mainHeader = $(bc_config.layout.main_header); 
	
	if( mainNavbar.attr('data-affix-position')=='top'){
		var extraH = mainNavbar.height();
	}
	
	if($('body').attr('data-offset')){
		extraH = extraH + Number($('body').attr('data-offset'));
	}
	
	if(offset!=0) offset = offset - extraH;

	bs_scroll_to_before_scroll();
	
	$('.scroll-to-current').removeClass('scroll-to-current'); 
	$('html, body').animate({
			scrollTop: offset
		}, WPBC_scroll_to_args.scroll_to_time_1, WPBC_scroll_to_args.scroll_to_ease_1, function(){
			// console.log('>animate: extraH:'+extraH); 
			if( mainNavbar.height()<extraH && offset!=0){
				var dif_end = offset + (extraH - mainNavbar.height()); 
				$('html, body').animate({ scrollTop: dif_end }, WPBC_scroll_to_args.scroll_to_time_2, WPBC_scroll_to_args.scroll_to_ease_2, function(){
					
				});  
			}
			if(elem){
				elem.addClass('scroll-to-current');
			} 
			//console.log('animation ended extraH:'+extraH+' actual head h: '+$('#top-nav').height());
			
		});
}

function bs_scroll_to(scrollto, offset, elem){
	 
	var mainSlider = $('.page-header-container .main-slider');
	var mainNavbar = $(bc_config.layout.main_navbar);
	var mainHeader = $(bc_config.layout.main_header); 
	
	if($(scrollto).length>0){ 
	 
		var scrollto_offset = $(scrollto).offset().top;

		if(!elem){
			elem = $('.scroll-to[data-scrollify-target][href="'+scrollto+'"]');
		} 
		if(elem.attr('data-scrollify-target')){
			mainNavbar = $(elem.data('scrollify-target'));
		}

		var extraH = 0;
		var nav_affix = false; 
		if( mainNavbar.attr('data-affix-position')=='top' || mainNavbar.attr('data-affix-scrollify')=='true'){
			var extraH = mainNavbar.height();
			nav_affix = true;
		}
		if( mainHeader.length>0 ){
			var dif = mainHeader.offset().top + mainHeader.height(); 
			if(dif>=scrollto_offset){ 
			}
		}  
		if(scrollto_offset!=0) scrollto_offset = scrollto_offset - extraH;
		
		if(offset) scrollto_offset = scrollto_offset + offset;
	
		bs_scroll_to_before_scroll();

		
		$('.scroll-to-current').removeClass('scroll-to-current'); 
		$('.scrolled-item-current').removeClass('scrolled-item-current'); 
		$('html, body').animate({
			scrollTop: scrollto_offset
		}, WPBC_scroll_to_args.scroll_to_time_1, WPBC_scroll_to_args.scroll_to_ease_1, function(){
			
				var dif_fix = 0;
				if(elem && elem.attr('data-scoll-offset') ){ 
					dif_fix = elem.attr('data-scoll-offset'); 
				} 

				if( ( extraH != mainNavbar.height() && scrollto_offset != 0 ) || ( $(scrollto).offset().top - scrollto_offset > extraH) ){  
					
					if(nav_affix){
						var dif_end = scrollto_offset + (extraH - mainNavbar.height());
					}else{
						var dif_end = scrollto_offset;
					}
					if($(scrollto).offset().top - scrollto_offset > extraH){
						dif_end = scrollto_offset + (($(scrollto).offset().top - scrollto_offset) - extraH);
					} 
					$('html, body').animate({ scrollTop: Math.round(dif_end) }, WPBC_scroll_to_args.scroll_to_time_2, WPBC_scroll_to_args.scroll_to_ease_2, function(){
						  
					}); 
					
				}
				$(scrollto).addClass('scrolled-item-current'); 
				if(elem){
					elem.addClass('scroll-to-current');
				} else{ 
					$('[href="'+scrollto+'"]').addClass('scroll-to-current'); 
				} 
				
		});
		
	}
	
} 

function bs_do_scroll_to(me){

	var scrollto = me.attr('href');

	if( !scrollto || scrollto == '#' || scrollto == '##' || scrollto == '#main-content' || scrollto == '#main-content'  || scrollto == '#inicio' ){
		var get_hash = '#';
	}else{
		var get_hash = scrollto.substring(scrollto.indexOf('#')+1); 
	}
	
	if( get_hash == '#' ){ 
		window.location.hash = '';
		history.pushState('', document.title, window.location.pathname);			
		bs_scroll_to_offset(0); 
		return false;
	}
	if( ( get_hash && $('#'+get_hash+'').length>0 ) ){  
		if( me.parent().hasClass('scroll-to-hash') || me.hasClass('scroll-to-hash') ){ 
			window.location.hash = get_hash; 
		} 
		bs_scroll_to('#'+get_hash+'', 0, me); 
		return false;
	}
}

+function ($) {
	//'use strict'; 
	
	$(".scroll-to:not(.menu-item), .scroll-to-nav a, .scroll-to.menu-item a").on('click',function (e){
		bs_do_scroll_to($(this));
	});
	$("#go-up a, .scrollspy-top").click(function (e){ 
		bs_scroll_to_offset(0); 
		return false;
	});
	$(window).on('load',function(){ 
		if( window.location.hash && $(window.location.hash).length>0 ){  
			var offset = $('body').data('scroll-to-offset') ? $('body').data('scroll-to-offset') : 0; 
			if( $('.scroll-to[href="'+window.location.hash+'"]').data('scrollify-target') ){
				target = $('.scroll-to[href="'+window.location.hash+'"]').data('scrollify-target');  
			} 
			bs_scroll_to( window.location.hash, offset );  
		}else{ 
			if( $('.scroll-to-first.menu-item a').length>0 ){  
				$('.scroll-to-first.menu-item a').addClass('scroll-to-current'); 
			}
			if( $('a.scroll-to-first').length>0 ){  
				$('a.scroll-to-first').addClass('scroll-to-current'); 
			} 
		}
	});
	$(window).on('scroll', {
		previousTop: 0
		},
		function() {
			var currentTop = $(window).scrollTop();
			var dif = get_window_sizes('h');
			if (currentTop > dif) { // make go-up visible if scroll down more than window height
				$("#go-up").addClass('visible'); 
			} else { 
				$("#go-up").removeClass('visible'); 
			}  
	});

}(jQuery);



/* ##################################################### */  

/* ##################################################### */ 
	
	
var BC_BrowserDetect = {
	init: function () {
		this.browser = this.searchString(this.dataBrowser) || "Other";
		this.version = this.searchVersion(navigator.userAgent) || this.searchVersion(navigator.appVersion) || "Unknown";
	},
	searchString: function (data) {
		for (var i = 0; i < data.length; i++) {
			var dataString = data[i].string;
			this.versionSearchString = data[i].subString;

			if (dataString.indexOf(data[i].subString) !== -1) {
				return data[i].identity;
			}
		}
	},
	searchVersion: function (dataString) {
		var index = dataString.indexOf(this.versionSearchString);
		if (index === -1) {
			return;
		}

		var rv = dataString.indexOf("rv:");
		if (this.versionSearchString === "Trident" && rv !== -1) {
			return parseFloat(dataString.substring(rv + 3));
		} else {
			return parseFloat(dataString.substring(index + this.versionSearchString.length + 1));
		}
	},

	dataBrowser: [
		{string: navigator.userAgent, subString: "Edge", identity: "MS Edge"},
		{string: navigator.userAgent, subString: "MSIE", identity: "Explorer"},
		{string: navigator.userAgent, subString: "Trident", identity: "Explorer"},
		{string: navigator.userAgent, subString: "Firefox", identity: "Firefox"},
		{string: navigator.userAgent, subString: "Opera", identity: "Opera"},  
		{string: navigator.userAgent, subString: "OPR", identity: "Opera"},
		{string: navigator.userAgent, subString: "Chrome", identity: "Chrome"}, 
		{string: navigator.userAgent, subString: "Safari", identity: "Safari"}       
	]
};
BC_BrowserDetect.init();


/* ##################################################### */



// ------------------------------------------- //
// getDocHeight get document height
function getDocHeight() {
    var D = document;
    return Math.max(
        D.body.scrollHeight, D.documentElement.scrollHeight,
        D.body.offsetHeight, D.documentElement.offsetHeight,
        D.body.clientHeight, D.documentElement.clientHeight
    );
}
// ------------------------------------------- //

// ------------------------------------------- //
// get urlParam
function urlParam(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
       return null;
    }
    else{
       return results[1] || 0;
    }
}
// ------------------------------------------- //

/* ##################################################### */ 
 

+function ($) {
    //'use strict';
	
	
	
	var body = $('body');
	var mainNavbar = $(bc_config.layout.main_navbar);
	var mainHeader = $(bc_config.layout.main_header);
	var mainContent = $(bc_config.layout.main_content);
	var mainFooter = $(bc_config.layout.main_footer);
	
	if( $('body').hasClass('logged-in') ) {
		$('body').bind("keydown", function(event) {
		  
		  if('69'==event.which){ 
		  	$('body').toggleClass('show-wpbc-edit-link');
		  }
		});
	}
	
	/*
	
		AJA
	
	*/
	$(window).on('load scroll resize', function(){
		var wpbc_container_reference = $('#wpbc_container_reference'); 
		var windowWidth = get_window_sizes('w');
		if( windowWidth >= wpbc_container_reference.width() ){
			var dif = windowWidth - wpbc_container_reference.outerWidth();
			$('body').attr('data-width-diference', dif);
			$('body').attr('data-width-half-diference', dif/2);
			$('[data-get="width-diference"]').attr('data-width-half-diference', dif/2);
			$('[data-get="width-diference"]').css('width', dif/2);
		}else{
			$('body').attr('data-width-diference', '');
			$('body').attr('data-width-half-diference', '');
			$('[data-get="width-diference"]').attr('data-width-half-diference', '');
			$('[data-get="width-diference"]').css('width', '');
		}
	});

	if($('body').hasClass('detect-scroll')){
		
		var lastScrollTop = 0;
		$(window).on('load scroll resize', {
			previousTop: 0
			},
			function() {
				var currentTop = $(window).scrollTop();
				
				var windowHeight = get_window_sizes('h');
				var bodyHeight = getDocHeight(); 
				var mainNavbar_offset = false;
				var mainHeader_offset = false;
				if( mainNavbar.length>0 ){
					mainNavbar_offset = mainNavbar.outerHeight();
				}
				if( mainHeader.length>0 ){
					mainHeader_offset = mainHeader.offset().top + mainHeader.outerHeight();
					if( $(bc_config.layout.main_navbar).data('affix-position')!='top' ){
						mainHeader_offset = mainHeader_offset - (mainNavbar.height());
					}
				}  
				
				if(mainNavbar_offset){
					if (currentTop >= mainNavbar_offset) { // start once mainNavbar is not visible on screen
						$("body").addClass('scrolling-mainNavbar');
					}else{
						$("body").removeClass('scrolling-mainNavbar');
					} 
				}
				if(mainHeader_offset){
					if (currentTop >= mainHeader_offset) { // start once mainHeader is not visible on screen
						$("body").addClass('scrolling-mainHeader');
					}else{
						$("body").removeClass('scrolling-mainHeader');
					} 
				}
				
				
				if (currentTop >= 1) { // start once mainNavbar is not visible on screen
					$("body").addClass('scrolling');
				}else{
					$("body").removeClass('scrolling');
				}  
				
				
				if( (currentTop + windowHeight) >= bodyHeight){ 
					$('body').addClass('reach-bottom'); 
				} else {  
					$('body').removeClass('reach-bottom');
				} 

				/*
				
					TODO, some bug when resizing, not geting the correct value from content height
				
				*/
				//console.log('##');
				//console.log( mainContent.height() + mainFooter.height() ); 
				if( ( mainContent.outerHeight() + mainFooter.height() ) < bodyHeight ){
					$('body').addClass('body-exceeds-content');  
				}else{
					$('body').removeClass('body-exceeds-content');  
				}
				
		});
		$(window).on('scroll', {
			previousTop: 0
			},
			function() {
				var currentTop = $(window).scrollTop();
				
				if( $("body").hasClass('scrolling') ){
					if (currentTop > lastScrollTop) { 
						$("body").addClass('scrolling-down');
						$("body").removeClass('scrolling-up');
					}else{
						$("body").addClass('scrolling-up');
						$("body").removeClass('scrolling-down');
					} 
				}else{
					$("body").removeClass('scrolling-up');
					$("body").removeClass('scrolling-down');
				}
				lastScrollTop = currentTop;
		});	
		
	} // if body.detect-scroll !=
	
	
	
	
	var bc_init = function(){ 
		
		$(window).resize();
	}
	
	$(window).on('load',function(){
		var body_loader = $('#body-loader');
		if(body_loader.hasClass('animated-loader')){
			body_loader.addClass('loaded');
			body_loader.on('transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd', 
				function() { 
					body_loader.delay(200).fadeOut(600, function(){ 
						$(this).removeClass('loaded');
						$('body').removeClass('loading'); 
						$('body').addClass('inited'); 
						bc_init();
					})
				});
		}else{
			body_loader.addClass('loaded');
			body_loader.delay(200).fadeOut(600, function(){
				$(this).removeClass('loaded');
				$('body').removeClass('loading'); 
				$('body').addClass('inited'); 
				bc_init();
			})
		}
		 
		/*
		$('#body-loader').fadeOut(300,function(){ 
			$('body').removeClass('loading'); 
			$('body').addClass('inited'); 
			bc_init();
		})
		*/
	
	});
	  
}(jQuery);



jQuery(function($) {
	 
	// make dropdown example clicked or always show.
	// $('.dropdown-menu-always-show').show().css('position', 'static');

	// make checkbox indeterminate
	// $('.checkbox-indeterminate').prop('indeterminate', true);
	if($('.selectpicker').length>0){
		$('.selectpicker').selectpicker(
			{
				liveSearch : true,
				showTick : true,
			}
		);
	}
	

	// activate popover.
	$('[data-toggle="popover"]').popover();

	// activate tooltip.
	$('[data-toggle="tooltip"]').tooltip();  
	
	$('[data-toggle="dropdown-close"]').on('click',function(){ 
		var target = $(this).attr('data-target');
		$(this).closest('.dropdown.show [aria-expanded]').attr('aria-expanded','false'); 
		$(this).closest('.dropdown.show, .dropdown.show > .show').removeClass('show'); 
		return false;
	}); 
	
	if($('[data-inview]').length>0){
		$('[data-inview]').inview();
	}
	if($('[data-parallax]').length>0){
		$('[data-parallax]').parallax();
	} 
	
	// Clone any element into other using data-clone attr
	// Ej: <div data-clone="#to-clone">original text</div> <div id="to-clone"></div>
	$('[data-clone]').each(function(){ 
		var me = $(this);
		var elem = $(me.data('clone'));
		elem.html(me.html()); 
	})
	
	// simple antispam on urls, must write email(at)something(dot)com
	$('a.antispam[href^="mailto:"]').each(function() { 
		var me = $(this); 
		var href = me.attr('href'); 
		href = href.replace('(at)', '@').replace(/\(dot\)/g, '.');
		me.attr('href', href); 
		if(!me.hasClass('preserve-content')){
			me.html(href.replace('mailto:', ''));
		} 
	});
	
	
	$('.trigger-to, [data-trigger="click"]').on('click',function(){ 
		var this_rel = $(this).attr('href');
		$(this_rel).trigger('click');
		return false;
	}); 
	
}); 

/* ##################################################### */ 


/* ##################################################### */
/* ##################################################### */
+function ($) {
    //'use strict';
	function WPBC_make_responsive_heights(me){
		var data_height = me.data('responsive-heights');  
		var min_height = 'inherit';
		var max_height = 'inherit';
		var height = 'auto'; 
	}
	$(window).on('load resize orientationchange',function(){ 
		$('[data-responsive-heights]').each(function(){ 
			WPBC_make_responsive_heights($(this));
		}); 
	});
	
}(jQuery);
/* ##################################################### */
/* ##################################################### */

/* ##################################################### */
/* ##################################################### */

/* ##################################################### */
/* ##################################################### */

/*

	Bootstrap Range Slider
	
	Ej:
	
	"data-input-min" and "data-input-max" defined, are optional, and these ones are just to output the values into those elements, 
	so you should also include some extra elements like these type="hidden" inputs that will store the min and max values from the range slider.
	
	HTML
	
	<input id="range-min" type="hidden" value=""/>
	<input id="range-max" type="hidden" value=""/>
	
	<div class="form-slider-range" data-input-min="#range-min" data-input-max="#range-max" data-money-format='{ "decimals": 0, "thousand": ".", "prefix": "$" }' data-range-args='{ "start": [0, 500000], "step": 100000, "range": { "min":[0], "max":[500000] }, "rangeLabels": { "min": "Min:", "max": "Max:" }  }'> 
		<div class="slider-range"></div> 
	</div>
	
	JS
	
	$(document).ready(function() {
  
  $('.noUi-handle').on('click', function() {
    $(this).width(50);
  });
 
  var rangeSlider_group = $('.form-slider-range'); 

  rangeSlider_group.each(function(){ 

  	var range = $(this);
  	var rangeSliderJQ = range.find('.slider-range');
  	var rangeSlider = rangeSliderJQ.get(0);


  	var deffaults_moneyFormat = {
	    decimals: 0,
	    thousand: '.',
	    prefix: 'USD'
	  };
  	var data_money_format = range.data('money-format') ? range.data('money-format') : deffaults_moneyFormat; 
  	
  	var moneyFormat = wNumb(data_money_format);

  	var deffaults_sliderArgs = {
		    start: [500000, 1000000],
		    step: 1000,
		    range: {
		      'min': [100000],
		      'max': [1000000]
		    },
		    rangeLabels: {
		    	'min': 'Min:',
		    	'max': 'Max:'
		    },
			hideRangeLabels: false,
		    format: moneyFormat,
		    connect: true
		  }; 

	var data_range_args = range.data('range-args'); 
	if(data_range_args){
		var sliderArgs = $.extend(deffaults_sliderArgs, data_range_args);
	}else{
		var sliderArgs = deffaults_sliderArgs;
	} 

 
	if( sliderArgs.rangeLabels  && !sliderArgs.hideRangeLabels ){
		var labels = range.append('<div class="range-labels"/>');
		$.each(sliderArgs.range, function(e){ 
			label = '<label><b>'+sliderArgs.rangeLabels[e]+' <span class="slider-range-'+ e +'"></span></b></label>'; 
			range.find('.range-labels').append( label );
	  	});
  	} 
  	var arr_range = Object.values(sliderArgs.range);
  	var arr_rageLabels = Object.values(sliderArgs.rangeLabels);  

  	noUiSlider.create(rangeSlider, sliderArgs); 
	 
	rangeSlider.noUiSlider.on('update', function(values, handle) { 

  		$.each(values, function(e,v){   
	  		$.each(sliderArgs.range, function(index, obj){  
	  			var ii = arr_range.indexOf(obj); 
				if(ii == e){
					output_values = '.slider-range-'+ index;
					range.find(output_values).html(v); 
					output_inputs = range.data('input-'+index);
					$(output_inputs).val( moneyFormat.from(v) ); 
				}
		  	});
	  	}); 
	  
	  });

  });
 
});

*/  


// https://refreshless.com/nouislider/
/*! nouislider - 8.3.0 - 2016-02-14 17:37:19 */
(function(factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define([], factory);
  } else if (typeof exports === 'object') {
    // Node/CommonJS
    module.exports = factory();
  } else {
    // Browser globals
    window.noUiSlider = factory();
  }
}(function() {
  'use strict';
  // Removes duplicates from an array.
  function unique(array) {
      return array.filter(function(a) {
        return !this[a] ? this[a] = true : false;
      }, {});
    }
    // Round a value to the closest 'to'.

  function closest(value, to) {
      return Math.round(value / to) * to;
    }
    // Current position of an element relative to the document.

  function offset(elem) {
      var rect = elem.getBoundingClientRect(),
        doc = elem.ownerDocument,
        docElem = doc.documentElement,
        pageOffset = getPageOffset();
      // getBoundingClientRect contains left scroll in Chrome on Android.
      // I haven't found a feature detection that proves this. Worst case
      // scenario on mis-match: the 'tap' feature on horizontal sliders breaks.
      if (/webkit.*Chrome.*Mobile/i.test(navigator.userAgent)) {
        pageOffset.x = 0;
      }
      return {
        top: rect.top + pageOffset.y - docElem.clientTop,
        left: rect.left + pageOffset.x - docElem.clientLeft
      };
    }
    // Checks whether a value is numerical.

  function isNumeric(a) {
      return typeof a === 'number' && !isNaN(a) && isFinite(a);
    }
    // Rounds a number to 7 supported decimals.

  function accurateNumber(number) {
      var p = Math.pow(10, 7);
      return Number((Math.round(number * p) / p).toFixed(7));
    }
    // Sets a class and removes it after [duration] ms.

  function addClassFor(element, className, duration) {
      addClass(element, className);
      setTimeout(function() {
        removeClass(element, className);
      }, duration);
    }
    // Limits a value to 0 - 100

  function limit(a) {
      return Math.max(Math.min(a, 100), 0);
    }
    // Wraps a variable as an array, if it isn't one yet.

  function asArray(a) {
      return Array.isArray(a) ? a : [a];
    }
    // Counts decimals

  function countDecimals(numStr) {
      var pieces = numStr.split(".");
      return pieces.length > 1 ? pieces[1].length : 0;
    }
    // http://youmightnotneedjquery.com/#add_class

  function addClass(el, className) {
      if (el.classList) {
        el.classList.add(className);
      } else {
        el.className += ' ' + className;
      }
    }
    // http://youmightnotneedjquery.com/#remove_class

  function removeClass(el, className) {
      if (el.classList) {
        el.classList.remove(className);
      } else {
        el.className = el.className.replace(new RegExp('(^|\\b)' +
          className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
      }
    }
    // https://plainjs.com/javascript/attributes/adding-removing-and-testing-for-classes-9/

  function hasClass(el, className) {
      return el.classList ? el.classList.contains(className) : new RegExp(
        '\\b' + className + '\\b').test(el.className);
    }
    // https://developer.mozilla.org/en-US/docs/Web/API/Window/scrollY#Notes

  function getPageOffset() {
      var supportPageOffset = window.pageXOffset !== undefined,
        isCSS1Compat = ((document.compatMode || "") === "CSS1Compat"),
        x = supportPageOffset ? window.pageXOffset : isCSS1Compat ?
        document.documentElement.scrollLeft : document.body.scrollLeft,
        y = supportPageOffset ? window.pageYOffset : isCSS1Compat ?
        document.documentElement.scrollTop : document.body.scrollTop;
      return {
        x: x,
        y: y
      };
    }
    // Shorthand for stopPropagation so we don't have to create a dynamic method

  function stopPropagation(e) {
      e.stopPropagation();
    }
    // todo

  function addCssPrefix(cssPrefix) {
    return function(className) {
      return cssPrefix + className;
    };
  }
  var
  // Determine the events to bind. IE11 implements pointerEvents without
  // a prefix, which breaks compatibility with the IE10 implementation.
  /** @const */
    actions = window.navigator.pointerEnabled ? {
      start: 'pointerdown',
      move: 'pointermove',
      end: 'pointerup'
    } : window.navigator.msPointerEnabled ? {
      start: 'MSPointerDown',
      move: 'MSPointerMove',
      end: 'MSPointerUp'
    } : {
      start: 'mousedown touchstart',
      move: 'mousemove touchmove',
      end: 'mouseup touchend'
    },
    defaultCssPrefix = 'noUi-';
  // Value calculation
  // Determine the size of a sub-range in relation to a full range.
  function subRangeRatio(pa, pb) {
      return (100 / (pb - pa));
    }
    // (percentage) How many percent is this value of this range?

  function fromPercentage(range, value) {
      return (value * 100) / (range[1] - range[0]);
    }
    // (percentage) Where is this value on this range?

  function toPercentage(range, value) {
      return fromPercentage(range, range[0] < 0 ? value + Math.abs(range[0]) :
        value - range[0]);
    }
    // (value) How much is this percentage on this range?

  function isPercentage(range, value) {
      return ((value * (range[1] - range[0])) / 100) + range[0];
    }
    // Range conversion

  function getJ(value, arr) {
      var j = 1;
      while (value >= arr[j]) {
        j += 1;
      }
      return j;
    }
    // (percentage) Input a value, find where, on a scale of 0-100, it applies.

  function toStepping(xVal, xPct, value) {
      if (value >= xVal.slice(-1)[0]) {
        return 100;
      }
      var j = getJ(value, xVal),
        va, vb, pa, pb;
      va = xVal[j - 1];
      vb = xVal[j];
      pa = xPct[j - 1];
      pb = xPct[j];
      return pa + (toPercentage([va, vb], value) / subRangeRatio(pa, pb));
    }
    // (value) Input a percentage, find where it is on the specified range.

  function fromStepping(xVal, xPct, value) {
      // There is no range group that fits 100
      if (value >= 100) {
        return xVal.slice(-1)[0];
      }
      var j = getJ(value, xPct),
        va, vb, pa, pb;
      va = xVal[j - 1];
      vb = xVal[j];
      pa = xPct[j - 1];
      pb = xPct[j];
      return isPercentage([va, vb], (value - pa) * subRangeRatio(pa, pb));
    }
    // (percentage) Get the step that applies at a certain value.

  function getStep(xPct, xSteps, snap, value) {
      if (value === 100) {
        return value;
      }
      var j = getJ(value, xPct),
        a, b;
      // If 'snap' is set, steps are used as fixed points on the slider.
      if (snap) {
        a = xPct[j - 1];
        b = xPct[j];
        // Find the closest position, a or b.
        if ((value - a) > ((b - a) / 2)) {
          return b;
        }
        return a;
      }
      if (!xSteps[j - 1]) {
        return value;
      }
      return xPct[j - 1] + closest(value - xPct[j - 1], xSteps[j - 1]);
    }
    // Entry parsing

  function handleEntryPoint(index, value, that) {
    var percentage;
    // Wrap numerical input in an array.
    if (typeof value === "number") {
      value = [value];
    }
    // Reject any invalid input, by testing whether value is an array.
    if (Object.prototype.toString.call(value) !== '[object Array]') {
      throw new Error("noUiSlider: 'range' contains invalid value.");
    }
    // Covert min/max syntax to 0 and 100.
    if (index === 'min') {
      percentage = 0;
    } else if (index === 'max') {
      percentage = 100;
    } else {
      percentage = parseFloat(index);
    }
    // Check for correct input.
    if (!isNumeric(percentage) || !isNumeric(value[0])) {
      throw new Error("noUiSlider: 'range' value isn't numeric.");
    }
    // Store values.
    that.xPct.push(percentage);
    that.xVal.push(value[0]);
    // NaN will evaluate to false too, but to keep
    // logging clear, set step explicitly. Make sure
    // not to override the 'step' setting with false.
    if (!percentage) {
      if (!isNaN(value[1])) {
        that.xSteps[0] = value[1];
      }
    } else {
      that.xSteps.push(isNaN(value[1]) ? false : value[1]);
    }
  }

  function handleStepPoint(i, n, that) {
      // Ignore 'false' stepping.
      if (!n) {
        return true;
      }
      // Factor to range ratio
      that.xSteps[i] = fromPercentage([
        that.xVal[i], that.xVal[i + 1]
      ], n) / subRangeRatio(that.xPct[i], that.xPct[i + 1]);
    }
    // Interface
    // The interface to Spectrum handles all direction-based
    // conversions, so the above values are unaware.

  function Spectrum(entry, snap, direction, singleStep) {
    this.xPct = [];
    this.xVal = [];
    this.xSteps = [singleStep || false];
    this.xNumSteps = [false];
    this.snap = snap;
    this.direction = direction;
    var index, ordered = [ /* [0, 'min'], [1, '50%'], [2, 'max'] */ ];
    // Map the object keys to an array.
    for (index in entry) {
      if (entry.hasOwnProperty(index)) {
        ordered.push([entry[index], index]);
      }
    }
    // Sort all entries by value (numeric sort).
    if (ordered.length && typeof ordered[0][0] === "object") {
      ordered.sort(function(a, b) {
        return a[0][0] - b[0][0];
      });
    } else {
      ordered.sort(function(a, b) {
        return a[0] - b[0];
      });
    }
    // Convert all entries to subranges.
    for (index = 0; index < ordered.length; index++) {
      handleEntryPoint(ordered[index][1], ordered[index][0], this);
    }
    // Store the actual step values.
    // xSteps is sorted in the same order as xPct and xVal.
    this.xNumSteps = this.xSteps.slice(0);
    // Convert all numeric steps to the percentage of the subrange they represent.
    for (index = 0; index < this.xNumSteps.length; index++) {
      handleStepPoint(index, this.xNumSteps[index], this);
    }
  }
  Spectrum.prototype.getMargin = function(value) {
    return this.xPct.length === 2 ? fromPercentage(this.xVal, value) :
      false;
  };
  Spectrum.prototype.toStepping = function(value) {
    value = toStepping(this.xVal, this.xPct, value);
    // Invert the value if this is a right-to-left slider.
    if (this.direction) {
      value = 100 - value;
    }
    return value;
  };
  Spectrum.prototype.fromStepping = function(value) {
    // Invert the value if this is a right-to-left slider.
    if (this.direction) {
      value = 100 - value;
    }
    return accurateNumber(fromStepping(this.xVal, this.xPct, value));
  };
  Spectrum.prototype.getStep = function(value) {
    // Find the proper step for rtl sliders by search in inverse direction.
    // Fixes issue #262.
    if (this.direction) {
      value = 100 - value;
    }
    value = getStep(this.xPct, this.xSteps, this.snap, value);
    if (this.direction) {
      value = 100 - value;
    }
    return value;
  };
  Spectrum.prototype.getApplicableStep = function(value) {
    // If the value is 100%, return the negative step twice.
    var j = getJ(value, this.xPct),
      offset = value === 100 ? 2 : 1;
    return [this.xNumSteps[j - 2], this.xVal[j - offset], this.xNumSteps[
      j - offset]];
  };
  // Outside testing
  Spectrum.prototype.convert = function(value) {
    return this.getStep(this.toStepping(value));
  };
  /*	Every input option is tested and parsed. This'll prevent
	endless validation in internal methods. These tests are
	structured with an item for every option available. An
	option can be marked as required by setting the 'r' flag.
	The testing function is provided with three arguments:
		- The provided value for the option;
		- A reference to the options object;
		- The name for the option;

	The testing function returns false when an error is detected,
	or true when everything is OK. It can also modify the option
	object, to make sure all values can be correctly looped elsewhere. */
  var defaultFormatter = {
    'to': function(value) {
      return value !== undefined && value.toFixed(2);
    },
    'from': Number
  };

  function testStep(parsed, entry) {
    if (!isNumeric(entry)) {
      throw new Error("noUiSlider: 'step' is not numeric.");
    }
    // The step option can still be used to set stepping
    // for linear sliders. Overwritten if set in 'range'.
    parsed.singleStep = entry;
  }

  function testRange(parsed, entry) {
    // Filter incorrect input.
    if (typeof entry !== 'object' || Array.isArray(entry)) {
      throw new Error("noUiSlider: 'range' is not an object.");
    }
    // Catch missing start or end.
    if (entry.min === undefined || entry.max === undefined) {
      throw new Error("noUiSlider: Missing 'min' or 'max' in 'range'.");
    }
    // Catch equal start or end.
    if (entry.min === entry.max) {
      throw new Error(
        "noUiSlider: 'range' 'min' and 'max' cannot be equal.");
    }
    parsed.spectrum = new Spectrum(entry, parsed.snap, parsed.dir, parsed
      .singleStep);
  }

  function testStart(parsed, entry) {
    entry = asArray(entry);
    // Validate input. Values aren't tested, as the public .val method
    // will always provide a valid location.
    if (!Array.isArray(entry) || !entry.length || entry.length > 2) {
      throw new Error("noUiSlider: 'start' option is incorrect.");
    }
    // Store the number of handles.
    parsed.handles = entry.length;
    // When the slider is initialized, the .val method will
    // be called with the start options.
    parsed.start = entry;
  }

  function testSnap(parsed, entry) {
    // Enforce 100% stepping within subranges.
    parsed.snap = entry;
    if (typeof entry !== 'boolean') {
      throw new Error("noUiSlider: 'snap' option must be a boolean.");
    }
  }

  function testAnimate(parsed, entry) {
    // Enforce 100% stepping within subranges.
    parsed.animate = entry;
    if (typeof entry !== 'boolean') {
      throw new Error("noUiSlider: 'animate' option must be a boolean.");
    }
  }

  function testConnect(parsed, entry) {
    if (entry === 'lower' && parsed.handles === 1) {
      parsed.connect = 1;
    } else if (entry === 'upper' && parsed.handles === 1) {
      parsed.connect = 2;
    } else if (entry === true && parsed.handles === 2) {
      parsed.connect = 3;
    } else if (entry === false) {
      parsed.connect = 0;
    } else {
      throw new Error(
        "noUiSlider: 'connect' option doesn't match handle count.");
    }
  }

  function testOrientation(parsed, entry) {
    // Set orientation to an a numerical value for easy
    // array selection.
    switch (entry) {
      case 'horizontal':
        parsed.ort = 0;
        break;
      case 'vertical':
        parsed.ort = 1;
        break;
      default:
        throw new Error("noUiSlider: 'orientation' option is invalid.");
    }
  }

  function testMargin(parsed, entry) {
    if (!isNumeric(entry)) {
      throw new Error("noUiSlider: 'margin' option must be numeric.");
    }
    // Issue #582
    if (entry === 0) {
      return;
    }
    parsed.margin = parsed.spectrum.getMargin(entry);
    if (!parsed.margin) {
      throw new Error(
        "noUiSlider: 'margin' option is only supported on linear sliders."
      );
    }
  }

  function testLimit(parsed, entry) {
    if (!isNumeric(entry)) {
      throw new Error("noUiSlider: 'limit' option must be numeric.");
    }
    parsed.limit = parsed.spectrum.getMargin(entry);
    if (!parsed.limit) {
      throw new Error(
        "noUiSlider: 'limit' option is only supported on linear sliders."
      );
    }
  }

  function testDirection(parsed, entry) {
    // Set direction as a numerical value for easy parsing.
    // Invert connection for RTL sliders, so that the proper
    // handles get the connect/background classes.
    switch (entry) {
      case 'ltr':
        parsed.dir = 0;
        break;
      case 'rtl':
        parsed.dir = 1;
        parsed.connect = [0, 2, 1, 3][parsed.connect];
        break;
      default:
        throw new Error(
          "noUiSlider: 'direction' option was not recognized.");
    }
  }

  function testBehaviour(parsed, entry) {
    // Make sure the input is a string.
    if (typeof entry !== 'string') {
      throw new Error(
        "noUiSlider: 'behaviour' must be a string containing options.");
    }
    // Check if the string contains any keywords.
    // None are required.
    var tap = entry.indexOf('tap') >= 0,
      drag = entry.indexOf('drag') >= 0,
      fixed = entry.indexOf('fixed') >= 0,
      snap = entry.indexOf('snap') >= 0,
      hover = entry.indexOf('hover') >= 0;
    // Fix #472
    if (drag && !parsed.connect) {
      throw new Error(
        "noUiSlider: 'drag' behaviour must be used with 'connect': true."
      );
    }
    parsed.events = {
      tap: tap || snap,
      drag: drag,
      fixed: fixed,
      snap: snap,
      hover: hover
    };
  }

  function testTooltips(parsed, entry) {
    var i;
    if (entry === false) {
      return;
    } else if (entry === true) {
      parsed.tooltips = [];
      for (i = 0; i < parsed.handles; i++) {
        parsed.tooltips.push(true);
      }
    } else {
      parsed.tooltips = asArray(entry);
      if (parsed.tooltips.length !== parsed.handles) {
        throw new Error(
          "noUiSlider: must pass a formatter for all handles.");
      }
      parsed.tooltips.forEach(function(formatter) {
        if (typeof formatter !== 'boolean' && (typeof formatter !==
          'object' || typeof formatter.to !== 'function')) {
          throw new Error(
            "noUiSlider: 'tooltips' must be passed a formatter or 'false'."
          );
        }
      });
    }
  }

  function testFormat(parsed, entry) {
    parsed.format = entry;
    // Any object with a to and from method is supported.
    if (typeof entry.to === 'function' && typeof entry.from ===
      'function') {
      return true;
    }
    throw new Error(
      "noUiSlider: 'format' requires 'to' and 'from' methods.");
  }

  function testCssPrefix(parsed, entry) {
      if (entry !== undefined && typeof entry !== 'string') {
        throw new Error("noUiSlider: 'cssPrefix' must be a string.");
      }
      parsed.cssPrefix = entry;
    }
    // Test all developer settings and parse to assumption-safe values.

  function testOptions(options) {
    // To prove a fix for #537, freeze options here.
    // If the object is modified, an error will be thrown.
    // Object.freeze(options);
    var parsed = {
        margin: 0,
        limit: 0,
        animate: true,
        format: defaultFormatter
      },
      tests;
    // Tests are executed in the order they are presented here.
    tests = {
      'step': {
        r: false,
        t: testStep
      },
      'start': {
        r: true,
        t: testStart
      },
      'connect': {
        r: true,
        t: testConnect
      },
      'direction': {
        r: true,
        t: testDirection
      },
      'snap': {
        r: false,
        t: testSnap
      },
      'animate': {
        r: false,
        t: testAnimate
      },
      'range': {
        r: true,
        t: testRange
      },
      'orientation': {
        r: false,
        t: testOrientation
      },
      'margin': {
        r: false,
        t: testMargin
      },
      'limit': {
        r: false,
        t: testLimit
      },
      'behaviour': {
        r: true,
        t: testBehaviour
      },
      'format': {
        r: false,
        t: testFormat
      },
      'tooltips': {
        r: false,
        t: testTooltips
      },
      'cssPrefix': {
        r: false,
        t: testCssPrefix
      }
    };
    var defaults = {
      'connect': false,
      'direction': 'ltr',
      'behaviour': 'tap',
      'orientation': 'horizontal'
    };
    // Run all options through a testing mechanism to ensure correct
    // input. It should be noted that options might get modified to
    // be handled properly. E.g. wrapping integers in arrays.
    Object.keys(tests).forEach(function(name) {
      // If the option isn't set, but it is required, throw an error.
      if (options[name] === undefined && defaults[name] === undefined) {
        if (tests[name].r) {
          throw new Error("noUiSlider: '" + name + "' is required.");
        }
        return true;
      }
      tests[name].t(parsed, options[name] === undefined ? defaults[
        name] : options[name]);
    });
    // Forward pips options
    parsed.pips = options.pips;
    // Pre-define the styles.
    parsed.style = parsed.ort ? 'top' : 'left';
    return parsed;
  }

  function closure(target, options) {
      // All variables local to 'closure' are prefixed with 'scope_'
      var scope_Target = target,
        scope_Locations = [-1, -1],
        scope_Base,
        scope_Handles,
        scope_Spectrum = options.spectrum,
        scope_Values = [],
        scope_Events = {},
        scope_Self;
      var cssClasses = [
        /*  0 */
        'target'
        /*  1 */
        , 'base'
        /*  2 */
        , 'origin'
        /*  3 */
        , 'handle'
        /*  4 */
        , 'horizontal'
        /*  5 */
        , 'vertical'
        /*  6 */
        , 'background'
        /*  7 */
        , 'connect'
        /*  8 */
        , 'ltr'
        /*  9 */
        , 'rtl'
        /* 10 */
        , 'draggable'
        /* 11 */
        , ''
        /* 12 */
        , 'state-drag'
        /* 13 */
        , ''
        /* 14 */
        , 'state-tap'
        /* 15 */
        , 'active'
        /* 16 */
        , ''
        /* 17 */
        , 'stacking'
        /* 18 */
        , 'tooltip'
        /* 19 */
        , ''
        /* 20 */
        , 'pips'
        /* 21 */
        , 'marker'
        /* 22 */
        , 'value'
      ].map(addCssPrefix(options.cssPrefix || defaultCssPrefix));
      // Delimit proposed values for handle positions.
      function getPositions(a, b, delimit) {
          // Add movement to current position.
          var c = a + b[0],
            d = a + b[1];
          // Only alter the other position on drag,
          // not on standard sliding.
          if (delimit) {
            if (c < 0) {
              d += Math.abs(c);
            }
            if (d > 100) {
              c -= (d - 100);
            }
            // Limit values to 0 and 100.
            return [limit(c), limit(d)];
          }
          return [c, d];
        }
        // Provide a clean event with standardized offset values.

      function fixEvent(e, pageOffset) {
          // Prevent scrolling and panning on touch events, while
          // attempting to slide. The tap event also depends on this.
          e.preventDefault();
          // Filter the event to register the type, which can be
          // touch, mouse or pointer. Offset changes need to be
          // made on an event specific basis.
          var touch = e.type.indexOf('touch') === 0,
            mouse = e.type.indexOf('mouse') === 0,
            pointer = e.type.indexOf('pointer') === 0,
            x, y, event = e;
          // IE10 implemented pointer events with a prefix;
          if (e.type.indexOf('MSPointer') === 0) {
            pointer = true;
          }
          if (touch) {
            // noUiSlider supports one movement at a time,
            // so we can select the first 'changedTouch'.
            x = e.changedTouches[0].pageX;
            y = e.changedTouches[0].pageY;
          }
          pageOffset = pageOffset || getPageOffset();
          if (mouse || pointer) {
            x = e.clientX + pageOffset.x;
            y = e.clientY + pageOffset.y;
          }
          event.pageOffset = pageOffset;
          event.points = [x, y];
          event.cursor = mouse || pointer; // Fix #435
          return event;
        }
        // Append a handle to the base.

      function addHandle(direction, index) {
          var origin = document.createElement('div'),
            handle = document.createElement('div'),
            additions = ['-lower', '-upper'];
          if (direction) {
            additions.reverse();
          }
          addClass(handle, cssClasses[3]);
          addClass(handle, cssClasses[3] + additions[index]);
          addClass(origin, cssClasses[2]);
          origin.appendChild(handle);
          return origin;
        }
        // Add the proper connection classes.

      function addConnection(connect, target, handles) {
          // Apply the required connection classes to the elements
          // that need them. Some classes are made up for several
          // segments listed in the class list, to allow easy
          // renaming and provide a minor compression benefit.
          switch (connect) {
            case 1:
              addClass(target, cssClasses[7]);
              addClass(handles[0], cssClasses[6]);
              break;
            case 3:
              addClass(handles[1], cssClasses[6]);
              /* falls through */
            case 2:
              addClass(handles[0], cssClasses[7]);
              /* falls through */
            case 0:
              addClass(target, cssClasses[6]);
              break;
          }
        }
        // Add handles to the slider base.

      function addHandles(nrHandles, direction, base) {
          var index, handles = [];
          // Append handles.
          for (index = 0; index < nrHandles; index += 1) {
            // Keep a list of all added handles.
            handles.push(base.appendChild(addHandle(direction, index)));
          }
          return handles;
        }
        // Initialize a single slider.

      function addSlider(direction, orientation, target) {
        // Apply classes and data to the target.
        addClass(target, cssClasses[0]);
        addClass(target, cssClasses[8 + direction]);
        addClass(target, cssClasses[4 + orientation]);
        var div = document.createElement('div');
        addClass(div, cssClasses[1]);
        target.appendChild(div);
        return div;
      }

      function addTooltip(handle, index) {
          if (!options.tooltips[index]) {
            return false;
          }
          var element = document.createElement('div');
          element.className = cssClasses[18];
          return handle.firstChild.appendChild(element);
        }
        // The tooltips option is a shorthand for using the 'update' event.

      function tooltips() {
        if (options.dir) {
          options.tooltips.reverse();
        }
        // Tooltips are added with options.tooltips in original order.
        var tips = scope_Handles.map(addTooltip);
        if (options.dir) {
          tips.reverse();
          options.tooltips.reverse();
        }
        bindEvent('update', function(f, o, r) {
          if (tips[o]) {
            tips[o].innerHTML = options.tooltips[o] === true ? f[o] :
              options.tooltips[o].to(r[o]);
          }
        });
      }

      function getGroup(mode, values, stepped) {
        // Use the range.
        if (mode === 'range' || mode === 'steps') {
          return scope_Spectrum.xVal;
        }
        if (mode === 'count') {
          // Divide 0 - 100 in 'count' parts.
          var spread = (100 / (values - 1)),
            v, i = 0;
          values = [];
          // List these parts and have them handled as 'positions'.
          while ((v = i++ * spread) <= 100) {
            values.push(v);
          }
          mode = 'positions';
        }
        if (mode === 'positions') {
          // Map all percentages to on-range values.
          return values.map(function(value) {
            return scope_Spectrum.fromStepping(stepped ?
              scope_Spectrum.getStep(value) : value);
          });
        }
        if (mode === 'values') {
          // If the value must be stepped, it needs to be converted to a percentage first.
          if (stepped) {
            return values.map(function(value) {
              // Convert to percentage, apply step, return to value.
              return scope_Spectrum.fromStepping(scope_Spectrum.getStep(
                scope_Spectrum.toStepping(value)));
            });
          }
          // Otherwise, we can simply use the values.
          return values;
        }
      }

      function generateSpread(density, mode, group) {
        function safeIncrement(value, increment) {
          // Avoid floating point variance by dropping the smallest decimal places.
          return (value + increment).toFixed(7) / 1;
        }
        var originalSpectrumDirection = scope_Spectrum.direction,
          indexes = {},
          firstInRange = scope_Spectrum.xVal[0],
          lastInRange = scope_Spectrum.xVal[scope_Spectrum.xVal.length -
            1],
          ignoreFirst = false,
          ignoreLast = false,
          prevPct = 0;
        // This function loops the spectrum in an ltr linear fashion,
        // while the toStepping method is direction aware. Trick it into
        // believing it is ltr.
        scope_Spectrum.direction = 0;
        // Create a copy of the group, sort it and filter away all duplicates.
        group = unique(group.slice().sort(function(a, b) {
          return a - b;
        }));
        // Make sure the range starts with the first element.
        if (group[0] !== firstInRange) {
          group.unshift(firstInRange);
          ignoreFirst = true;
        }
        // Likewise for the last one.
        if (group[group.length - 1] !== lastInRange) {
          group.push(lastInRange);
          ignoreLast = true;
        }
        group.forEach(function(current, index) {
          // Get the current step and the lower + upper positions.
          var step, i, q,
            low = current,
            high = group[index + 1],
            newPct, pctDifference, pctPos, type,
            steps, realSteps, stepsize;
          // When using 'steps' mode, use the provided steps.
          // Otherwise, we'll step on to the next subrange.
          if (mode === 'steps') {
            step = scope_Spectrum.xNumSteps[index];
          }
          // Default to a 'full' step.
          if (!step) {
            step = high - low;
          }
          // Low can be 0, so test for false. If high is undefined,
          // we are at the last subrange. Index 0 is already handled.
          if (low === false || high === undefined) {
            return;
          }
          // Find all steps in the subrange.
          for (i = low; i <= high; i = safeIncrement(i, step)) {
            // Get the percentage value for the current step,
            // calculate the size for the subrange.
            newPct = scope_Spectrum.toStepping(i);
            pctDifference = newPct - prevPct;
            steps = pctDifference / density;
            realSteps = Math.round(steps);
            // This ratio represents the ammount of percentage-space a point indicates.
            // For a density 1 the points/percentage = 1. For density 2, that percentage needs to be re-devided.
            // Round the percentage offset to an even number, then divide by two
            // to spread the offset on both sides of the range.
            stepsize = pctDifference / realSteps;
            // Divide all points evenly, adding the correct number to this subrange.
            // Run up to <= so that 100% gets a point, event if ignoreLast is set.
            for (q = 1; q <= realSteps; q += 1) {
              // The ratio between the rounded value and the actual size might be ~1% off.
              // Correct the percentage offset by the number of points
              // per subrange. density = 1 will result in 100 points on the
              // full range, 2 for 50, 4 for 25, etc.
              pctPos = prevPct + (q * stepsize);
              indexes[pctPos.toFixed(5)] = ['x', 0];
            }
            // Determine the point type.
            type = (group.indexOf(i) > -1) ? 1 : (mode === 'steps' ?
              2 : 0);
            // Enforce the 'ignoreFirst' option by overwriting the type for 0.
            if (!index && ignoreFirst) {
              type = 0;
            }
            if (!(i === high && ignoreLast)) {
              // Mark the 'type' of this point. 0 = plain, 1 = real value, 2 = step value.
              indexes[newPct.toFixed(5)] = [i, type];
            }
            // Update the percentage count.
            prevPct = newPct;
          }
        });
        // Reset the spectrum.
        scope_Spectrum.direction = originalSpectrumDirection;
        return indexes;
      }

      function addMarking(spread, filterFunc, formatter) {
        var style = ['horizontal', 'vertical'][options.ort],
          element = document.createElement('div'),
          out = '';
        addClass(element, cssClasses[20]);
        addClass(element, cssClasses[20] + '-' + style);

        function getSize(type) {
          return ['-normal', '-large', '-sub'][type];
        }

        function getTags(offset, source, values) {
          return 'class="' + source + ' ' + source + '-' + style + ' ' +
            source + getSize(values[1]) + '" style="' + options.style +
            ': ' + offset + '%"';
        }

        function addSpread(offset, values) {
            if (scope_Spectrum.direction) {
              offset = 100 - offset;
            }
            // Apply the filter function, if it is set.
            values[1] = (values[1] && filterFunc) ? filterFunc(values[0],
              values[1]) : values[1];
            // Add a marker for every point
            out += '<div ' + getTags(offset, cssClasses[21], values) +
              '></div>';
            // Values are only appended for points marked '1' or '2'.
            if (values[1]) {
              out += '<div ' + getTags(offset, cssClasses[22], values) +
                '>' + formatter.to(values[0]) + '</div>';
            }
          }
          // Append all points.
        Object.keys(spread).forEach(function(a) {
          addSpread(a, spread[a]);
        });
        element.innerHTML = out;
        return element;
      }

      function pips(grid) {
          var mode = grid.mode,
            density = grid.density || 1,
            filter = grid.filter || false,
            values = grid.values || false,
            stepped = grid.stepped || false,
            group = getGroup(mode, values, stepped),
            spread = generateSpread(density, mode, group),
            format = grid.format || {
              to: Math.round
            };
          return scope_Target.appendChild(addMarking(spread, filter, format));
        }
        // Shorthand for base dimensions.

      function baseSize() {
          var rect = scope_Base.getBoundingClientRect(),
            alt = 'offset' + ['Width', 'Height'][options.ort];
          return options.ort === 0 ? (rect.width || scope_Base[alt]) : (
            rect.height || scope_Base[alt]);
        }
        // External event handling

      function fireEvent(event, handleNumber, tap) {
          if (handleNumber !== undefined && options.handles !== 1) {
            handleNumber = Math.abs(handleNumber - options.dir);
          }
          Object.keys(scope_Events).forEach(function(targetEvent) {
            var eventType = targetEvent.split('.')[0];
            if (event === eventType) {
              scope_Events[targetEvent].forEach(function(callback) {
                callback.call(
                  // Use the slider public API as the scope ('this')
                  scope_Self,
                  // Return values as array, so arg_1[arg_2] is always valid.
                  asArray(valueGet()),
                  // Handle index, 0 or 1
                  handleNumber,
                  // Unformatted slider values
                  asArray(inSliderOrder(Array.prototype.slice.call(
                    scope_Values))),
                  // Event is fired by tap, true or false
                  tap || false,
                  // Left offset of the handle, in relation to the slider
                  scope_Locations);
              });
            }
          });
        }
        // Returns the input array, respecting the slider direction configuration.

      function inSliderOrder(values) {
          // If only one handle is used, return a single value.
          if (values.length === 1) {
            return values[0];
          }
          if (options.dir) {
            return values.reverse();
          }
          return values;
        }
        // Handler for attaching events trough a proxy.

      function attach(events, element, callback, data) {
          // This function can be used to 'filter' events to the slider.
          // element is a node, not a nodeList
          var method = function(e) {
              if (scope_Target.hasAttribute('disabled')) {
                return false;
              }
              // Stop if an active 'tap' transition is taking place.
              if (hasClass(scope_Target, cssClasses[14])) {
                return false;
              }
              e = fixEvent(e, data.pageOffset);
              // Ignore right or middle clicks on start #454
              if (events === actions.start && e.buttons !== undefined && e.buttons >
                1) {
                return false;
              }
              // Ignore right or middle clicks on start #454
              if (data.hover && e.buttons) {
                return false;
              }
              e.calcPoint = e.points[options.ort];
              // Call the event handler with the event [ and additional data ].
              callback(e, data);
            },
            methods = [];
          // Bind a closure on the target for every event type.
          events.split(' ').forEach(function(eventName) {
            element.addEventListener(eventName, method, false);
            methods.push([eventName, method]);
          });
          return methods;
        }
        // Handle movement on document for handle and range drag.

      function move(event, data) {
          // Fix #498
          // Check value of .buttons in 'start' to work around a bug in IE10 mobile (data.buttonsProperty).
          // https://connect.microsoft.com/IE/feedback/details/927005/mobile-ie10-windows-phone-buttons-property-of-pointermove-event-always-zero
          // IE9 has .buttons and .which zero on mousemove.
          // Firefox breaks the spec MDN defines.
          if (navigator.appVersion.indexOf("MSIE 9") === -1 && event.buttons ===
            0 && data.buttonsProperty !== 0) {
            return end(event, data);
          }
          var handles = data.handles || scope_Handles,
            positions, state = false,
            proposal = ((event.calcPoint - data.start) * 100) / data.baseSize,
            handleNumber = handles[0] === scope_Handles[0] ? 0 : 1,
            i;
          // Calculate relative positions for the handles.
          positions = getPositions(proposal, data.positions, handles.length >
            1);
          state = setHandle(handles[0], positions[handleNumber], handles.length ===
            1);
          if (handles.length > 1) {
            state = setHandle(handles[1], positions[handleNumber ? 0 : 1],
              false) || state;
            if (state) {
              // fire for both handles
              for (i = 0; i < data.handles.length; i++) {
                fireEvent('slide', i);
              }
            }
          } else if (state) {
            // Fire for a single handle
            fireEvent('slide', handleNumber);
          }
        }
        // Unbind move events on document, call callbacks.

      function end(event, data) {
          // The handle is no longer active, so remove the class.
          var active = scope_Base.querySelector('.' + cssClasses[15]),
            handleNumber = data.handles[0] === scope_Handles[0] ? 0 : 1;
          if (active !== null) {
            removeClass(active, cssClasses[15]);
          }
          // Remove cursor styles and text-selection events bound to the body.
          if (event.cursor) {
            document.body.style.cursor = '';
            document.body.removeEventListener('selectstart', document.body.noUiListener);
          }
          var d = document.documentElement;
          // Unbind the move and end events, which are added on 'start'.
          d.noUiListeners.forEach(function(c) {
            d.removeEventListener(c[0], c[1]);
          });
          // Remove dragging class.
          removeClass(scope_Target, cssClasses[12]);
          // Fire the change and set events.
          fireEvent('set', handleNumber);
          fireEvent('change', handleNumber);
          // If this is a standard handle movement, fire the end event.
          if (data.handleNumber !== undefined) {
            fireEvent('end', data.handleNumber);
          }
        }
        // Fire 'end' when a mouse or pen leaves the document.

      function documentLeave(event, data) {
          if (event.type === "mouseout" && event.target.nodeName === "HTML" &&
            event.relatedTarget === null) {
            end(event, data);
          }
        }
        // Bind move events on document.

      function start(event, data) {
          var d = document.documentElement;
          // Mark the handle as 'active' so it can be styled.
          if (data.handles.length === 1) {
            addClass(data.handles[0].children[0], cssClasses[15]);
            // Support 'disabled' handles
            if (data.handles[0].hasAttribute('disabled')) {
              return false;
            }
          }
          // Fix #551, where a handle gets selected instead of dragged.
          event.preventDefault();
          // A drag should never propagate up to the 'tap' event.
          event.stopPropagation();
          // Attach the move and end events.
          var moveEvent = attach(actions.move, d, move, {
              start: event.calcPoint,
              baseSize: baseSize(),
              pageOffset: event.pageOffset,
              handles: data.handles,
              handleNumber: data.handleNumber,
              buttonsProperty: event.buttons,
              positions: [
                scope_Locations[0],
                scope_Locations[scope_Handles.length - 1]
              ]
            }),
            endEvent = attach(actions.end, d, end, {
              handles: data.handles,
              handleNumber: data.handleNumber
            });
          var outEvent = attach("mouseout", d, documentLeave, {
            handles: data.handles,
            handleNumber: data.handleNumber
          });
          d.noUiListeners = moveEvent.concat(endEvent, outEvent);
          // Text selection isn't an issue on touch devices,
          // so adding cursor styles can be skipped.
          if (event.cursor) {
            // Prevent the 'I' cursor and extend the range-drag cursor.
            document.body.style.cursor = getComputedStyle(event.target).cursor;
            // Mark the target with a dragging state.
            if (scope_Handles.length > 1) {
              addClass(scope_Target, cssClasses[12]);
            }
            var f = function() {
              return false;
            };
            document.body.noUiListener = f;
            // Prevent text selection when dragging the handles.
            document.body.addEventListener('selectstart', f, false);
          }
          if (data.handleNumber !== undefined) {
            fireEvent('start', data.handleNumber);
          }
        }
        // Move closest handle to tapped location.

      function tap(event) {
          var location = event.calcPoint,
            total = 0,
            handleNumber, to;
          // The tap event shouldn't propagate up and cause 'edge' to run.
          event.stopPropagation();
          // Add up the handle offsets.
          scope_Handles.forEach(function(a) {
            total += offset(a)[options.style];
          });
          // Find the handle closest to the tapped position.
          handleNumber = (location < total / 2 || scope_Handles.length ===
            1) ? 0 : 1;
          // Check if handler is not disablet if yes set number to the next handler
          if (scope_Handles[handleNumber].hasAttribute('disabled')) {
            handleNumber = handleNumber ? 0 : 1;
          }
          location -= offset(scope_Base)[options.style];
          // Calculate the new position.
          to = (location * 100) / baseSize();
          if (!options.events.snap) {
            // Flag the slider as it is now in a transitional state.
            // Transition takes 300 ms, so re-enable the slider afterwards.
            addClassFor(scope_Target, cssClasses[14], 300);
          }
          // Support 'disabled' handles
          if (scope_Handles[handleNumber].hasAttribute('disabled')) {
            return false;
          }
          // Find the closest handle and calculate the tapped point.
          // The set handle to the new position.
          setHandle(scope_Handles[handleNumber], to);
          fireEvent('slide', handleNumber, true);
          fireEvent('set', handleNumber, true);
          fireEvent('change', handleNumber, true);
          if (options.events.snap) {
            start(event, {
              handles: [scope_Handles[handleNumber]]
            });
          }
        }
        // Fires a 'hover' event for a hovered mouse/pen position.

      function hover(event) {
          var location = event.calcPoint - offset(scope_Base)[options.style],
            to = scope_Spectrum.getStep((location * 100) / baseSize()),
            value = scope_Spectrum.fromStepping(to);
          Object.keys(scope_Events).forEach(function(targetEvent) {
            if ('hover' === targetEvent.split('.')[0]) {
              scope_Events[targetEvent].forEach(function(callback) {
                callback.call(scope_Self, value);
              });
            }
          });
        }
        // Attach events to several slider parts.

      function events(behaviour) {
          var i, drag;
          // Attach the standard drag event to the handles.
          if (!behaviour.fixed) {
            for (i = 0; i < scope_Handles.length; i += 1) {
              // These events are only bound to the visual handle
              // element, not the 'real' origin element.
              attach(actions.start, scope_Handles[i].children[0], start, {
                handles: [scope_Handles[i]],
                handleNumber: i
              });
            }
          }
          // Attach the tap event to the slider base.
          if (behaviour.tap) {
            attach(actions.start, scope_Base, tap, {
              handles: scope_Handles
            });
          }
          // Fire hover events
          if (behaviour.hover) {
            attach(actions.move, scope_Base, hover, {
              hover: true
            });
            for (i = 0; i < scope_Handles.length; i += 1) {
              ['mousemove MSPointerMove pointermove'].forEach(function(
                eventName) {
                scope_Handles[i].children[0].addEventListener(eventName,
                  stopPropagation, false);
              });
            }
          }
          // Make the range draggable.
          if (behaviour.drag) {
            drag = [scope_Base.querySelector('.' + cssClasses[7])];
            addClass(drag[0], cssClasses[10]);
            // When the range is fixed, the entire range can
            // be dragged by the handles. The handle in the first
            // origin will propagate the start event upward,
            // but it needs to be bound manually on the other.
            if (behaviour.fixed) {
              drag.push(scope_Handles[(drag[0] === scope_Handles[0] ? 1 : 0)]
                .children[0]);
            }
            drag.forEach(function(element) {
              attach(actions.start, element, start, {
                handles: scope_Handles
              });
            });
          }
        }
        // Test suggested values and apply margin, step.

      function setHandle(handle, to, noLimitOption) {
          var trigger = handle !== scope_Handles[0] ? 1 : 0,
            lowerMargin = scope_Locations[0] + options.margin,
            upperMargin = scope_Locations[1] - options.margin,
            lowerLimit = scope_Locations[0] + options.limit,
            upperLimit = scope_Locations[1] - options.limit;
          // For sliders with multiple handles,
          // limit movement to the other handle.
          // Apply the margin option by adding it to the handle positions.
          if (scope_Handles.length > 1) {
            to = trigger ? Math.max(to, lowerMargin) : Math.min(to,
              upperMargin);
          }
          // The limit option has the opposite effect, limiting handles to a
          // maximum distance from another. Limit must be > 0, as otherwise
          // handles would be unmoveable. 'noLimitOption' is set to 'false'
          // for the .val() method, except for pass 4/4.
          if (noLimitOption !== false && options.limit && scope_Handles.length >
            1) {
            to = trigger ? Math.min(to, lowerLimit) : Math.max(to,
              upperLimit);
          }
          // Handle the step option.
          to = scope_Spectrum.getStep(to);
          // Limit to 0/100 for .val input, trim anything beyond 7 digits, as
          // JavaScript has some issues in its floating point implementation.
          to = limit(parseFloat(to.toFixed(7)));
          // Return false if handle can't move
          if (to === scope_Locations[trigger]) {
            return false;
          }
          // Set the handle to the new position.
          // Use requestAnimationFrame for efficient painting.
          // No significant effect in Chrome, Edge sees dramatic
          // performace improvements.
          if (window.requestAnimationFrame) {
            window.requestAnimationFrame(function() {
              handle.style[options.style] = to + '%';
            });
          } else {
            handle.style[options.style] = to + '%';
          }
          // Force proper handle stacking
          if (!handle.previousSibling) {
            removeClass(handle, cssClasses[17]);
            if (to > 50) {
              addClass(handle, cssClasses[17]);
            }
          }
          // Update locations.
          scope_Locations[trigger] = to;
          // Convert the value to the slider stepping/range.
          scope_Values[trigger] = scope_Spectrum.fromStepping(to);
          fireEvent('update', trigger);
          return true;
        }
        // Loop values from value method and apply them.

      function setValues(count, values) {
          var i, trigger, to;
          // With the limit option, we'll need another limiting pass.
          if (options.limit) {
            count += 1;
          }
          // If there are multiple handles to be set run the setting
          // mechanism twice for the first handle, to make sure it
          // can be bounced of the second one properly.
          for (i = 0; i < count; i += 1) {
            trigger = i % 2;
            // Get the current argument from the array.
            to = values[trigger];
            // Setting with null indicates an 'ignore'.
            // Inputting 'false' is invalid.
            if (to !== null && to !== false) {
              // If a formatted number was passed, attemt to decode it.
              if (typeof to === 'number') {
                to = String(to);
              }
              to = options.format.from(to);
              // Request an update for all links if the value was invalid.
              // Do so too if setting the handle fails.
              if (to === false || isNaN(to) || setHandle(scope_Handles[
                trigger], scope_Spectrum.toStepping(to), i === (3 -
                options.dir)) === false) {
                fireEvent('update', trigger);
              }
            }
          }
        }
        // Set the slider value.

      function valueSet(input) {
          var count, values = asArray(input),
            i;
          // The RTL settings is implemented by reversing the front-end,
          // internal mechanisms are the same.
          if (options.dir && options.handles > 1) {
            values.reverse();
          }
          // Animation is optional.
          // Make sure the initial values where set before using animated placement.
          if (options.animate && scope_Locations[0] !== -1) {
            addClassFor(scope_Target, cssClasses[14], 300);
          }
          // Determine how often to set the handles.
          count = scope_Handles.length > 1 ? 3 : 1;
          if (values.length === 1) {
            count = 1;
          }
          setValues(count, values);
          // Fire the 'set' event for both handles.
          for (i = 0; i < scope_Handles.length; i++) {
            // Fire the event only for handles that received a new value, as per #579
            if (values[i] !== null) {
              fireEvent('set', i);
            }
          }
        }
        // Get the slider value.

      function valueGet() {
          var i, retour = [];
          // Get the value from all handles.
          for (i = 0; i < options.handles; i += 1) {
            retour[i] = options.format.to(scope_Values[i]);
          }
          return inSliderOrder(retour);
        }
        // Removes classes from the root and empties it.

      function destroy() {
          cssClasses.forEach(function(cls) {
            if (!cls) {
              return;
            } // Ignore empty classes
            removeClass(scope_Target, cls);
          });
          while (scope_Target.firstChild) {
            scope_Target.removeChild(scope_Target.firstChild);
          }
          delete scope_Target.noUiSlider;
        }
        // Get the current step size for the slider.

      function getCurrentStep() {
          // Check all locations, map them to their stepping point.
          // Get the step point, then find it in the input list.
          var retour = scope_Locations.map(function(location, index) {
            var step = scope_Spectrum.getApplicableStep(location),
              // As per #391, the comparison for the decrement step can have some rounding issues.
              // Round the value to the precision used in the step.
              stepDecimals = countDecimals(String(step[2])),
              // Get the current numeric value
              value = scope_Values[index],
              // To move the slider 'one step up', the current step value needs to be added.
              // Use null if we are at the maximum slider value.
              increment = location === 100 ? null : step[2],
              // Going 'one step down' might put the slider in a different sub-range, so we
              // need to switch between the current or the previous step.
              prev = Number((value - step[2]).toFixed(stepDecimals)),
              // If the value fits the step, return the current step value. Otherwise, use the
              // previous step. Return null if the slider is at its minimum value.
              decrement = location === 0 ? null : (prev >= step[1]) ?
              step[2] : (step[0] || false);
            return [decrement, increment];
          });
          // Return values in the proper order.
          return inSliderOrder(retour);
        }
        // Attach an event to this slider, possibly including a namespace

      function bindEvent(namespacedEvent, callback) {
          scope_Events[namespacedEvent] = scope_Events[namespacedEvent] || [];
          scope_Events[namespacedEvent].push(callback);
          // If the event bound is 'update,' fire it immediately for all handles.
          if (namespacedEvent.split('.')[0] === 'update') {
            scope_Handles.forEach(function(a, index) {
              fireEvent('update', index);
            });
          }
        }
        // Undo attachment of event

      function removeEvent(namespacedEvent) {
          var event = namespacedEvent.split('.')[0],
            namespace = namespacedEvent.substring(event.length);
          Object.keys(scope_Events).forEach(function(bind) {
            var tEvent = bind.split('.')[0],
              tNamespace = bind.substring(tEvent.length);
            if ((!event || event === tEvent) && (!namespace ||
              namespace === tNamespace)) {
              delete scope_Events[bind];
            }
          });
        }
        // Updateable: margin, limit, step, range, animate, snap

      function updateOptions(optionsToUpdate) {
          var v = valueGet(),
            i, newOptions = testOptions({
              start: [0, 0],
              margin: optionsToUpdate.margin,
              limit: optionsToUpdate.limit,
              step: optionsToUpdate.step,
              range: optionsToUpdate.range,
              animate: optionsToUpdate.animate,
              snap: optionsToUpdate.snap === undefined ? options.snap : optionsToUpdate
                .snap
            });
          ['margin', 'limit', 'step', 'range', 'animate'].forEach(function(
            name) {
            if (optionsToUpdate[name] !== undefined) {
              options[name] = optionsToUpdate[name];
            }
          });
          // Save current spectrum direction as testOptions in testRange call
          // doesn't rely on current direction
          newOptions.spectrum.direction = scope_Spectrum.direction;
          scope_Spectrum = newOptions.spectrum;
          // Invalidate the current positioning so valueSet forces an update.
          scope_Locations = [-1, -1];
          valueSet(v);
          for (i = 0; i < scope_Handles.length; i++) {
            fireEvent('update', i);
          }
        }
        // Throw an error if the slider was already initialized.
      if (scope_Target.noUiSlider) {
        throw new Error('Slider was already initialized.');
      }
      // Create the base element, initialise HTML and set classes.
      // Add handles and links.
      scope_Base = addSlider(options.dir, options.ort, scope_Target);
      scope_Handles = addHandles(options.handles, options.dir, scope_Base);
      // Set the connect classes.
      addConnection(options.connect, scope_Target, scope_Handles);
      if (options.pips) {
        pips(options.pips);
      }
      if (options.tooltips) {
        tooltips();
      }
      scope_Self = {
        destroy: destroy,
        steps: getCurrentStep,
        on: bindEvent,
        off: removeEvent,
        get: valueGet,
        set: valueSet,
        updateOptions: updateOptions,
        options: options, // Issue #600
        target: scope_Target, // Issue #597
        pips: pips // Issue #594
      };
      // Attach user events.
      events(options.events);
      return scope_Self;
    }
    // Run the standard initializer

  function initialize(target, originalOptions) {
      if (!target.nodeName) {
        throw new Error('noUiSlider.create requires a single element.');
      }
      // Test the options and create the slider environment;
      var options = testOptions(originalOptions, target),
        slider = closure(target, options);
      // Use the public value method to set the start values.
      slider.set(options.start);
      target.noUiSlider = slider;
      return slider;
    }
    // Use an object instead of a function for future expansibility;
  return {
    create: initialize
  };
}));
// wNumb number formatter: https://refreshless.com/wnumb/
(function() {
  //'use strict';
  var
  /** @const */
    FormatOptions = ['decimals', 'thousand', 'mark', 'prefix', 'postfix',
    'encoder', 'decoder', 'negativeBefore', 'negative', 'edit', 'undo'
  ];
  // General
  // Reverse a string
  function strReverse(a) {
      return a.split('').reverse().join('');
    }
    // Check if a string starts with a specified prefix.

  function strStartsWith(input, match) {
      return input.substring(0, match.length) === match;
    }
    // Check is a string ends in a specified postfix.

  function strEndsWith(input, match) {
      return input.slice(-1 * match.length) === match;
    }
    // Throw an error if formatting options are incompatible.

  function throwEqualError(F, a, b) {
      if ((F[a] || F[b]) && (F[a] === F[b])) {
        throw new Error(a);
      }
    }
    // Check if a number is finite and not NaN

  function isValidNumber(input) {
      return typeof input === 'number' && isFinite(input);
    }
    // Provide rounding-accurate toFixed method.

  function toFixed(value, decimals) {
      var scale = Math.pow(10, decimals);
      return (Math.round(value * scale) / scale).toFixed(decimals);
    }
    // Formatting
    // Accept a number as input, output formatted string.

  function formatTo(decimals, thousand, mark, prefix, postfix, encoder,
      decoder, negativeBefore, negative, edit, undo, input) {
      var originalInput = input,
        inputIsNegative, inputPieces, inputBase, inputDecimals = '',
        output = '';
      // Apply user encoder to the input.
      // Expected outcome: number.
      if (encoder) {
        input = encoder(input);
      }
      // Stop if no valid number was provided, the number is infinite or NaN.
      if (!isValidNumber(input)) {
        return false;
      }
      // Rounding away decimals might cause a value of -0
      // when using very small ranges. Remove those cases.
      if (decimals !== false && parseFloat(input.toFixed(decimals)) === 0) {
        input = 0;
      }
      // Formatting is done on absolute numbers,
      // decorated by an optional negative symbol.
      if (input < 0) {
        inputIsNegative = true;
        input = Math.abs(input);
      }
      // Reduce the number of decimals to the specified option.
      if (decimals !== false) {
        input = toFixed(input, decimals);
      }
      // Transform the number into a string, so it can be split.
      input = input.toString();
      // Break the number on the decimal separator.
      if (input.indexOf('.') !== -1) {
        inputPieces = input.split('.');
        inputBase = inputPieces[0];
        if (mark) {
          inputDecimals = mark + inputPieces[1];
        }
      } else {
        // If it isn't split, the entire number will do.
        inputBase = input;
      }
      // Group numbers in sets of three.
      if (thousand) {
        inputBase = strReverse(inputBase).match(/.{1,3}/g);
        inputBase = strReverse(inputBase.join(strReverse(thousand)));
      }
      // If the number is negative, prefix with negation symbol.
      if (inputIsNegative && negativeBefore) {
        output += negativeBefore;
      }
      // Prefix the number
      if (prefix) {
        output += prefix;
      }
      // Normal negative option comes after the prefix. Defaults to '-'.
      if (inputIsNegative && negative) {
        output += negative;
      }
      // Append the actual number.
      output += inputBase;
      output += inputDecimals;
      // Apply the postfix.
      if (postfix) {
        output += postfix;
      }
      // Run the output through a user-specified post-formatter.
      if (edit) {
        output = edit(output, originalInput);
      }
      // All done.
      return output;
    }
    // Accept a sting as input, output decoded number.

  function formatFrom(decimals, thousand, mark, prefix, postfix, encoder,
      decoder, negativeBefore, negative, edit, undo, input) {
      var originalInput = input,
        inputIsNegative, output = '';
      // User defined pre-decoder. Result must be a non empty string.
      if (undo) {
        input = undo(input);
      }
      // Test the input. Can't be empty.
      if (!input || typeof input !== 'string') {
        return false;
      }
      // If the string starts with the negativeBefore value: remove it.
      // Remember is was there, the number is negative.
      if (negativeBefore && strStartsWith(input, negativeBefore)) {
        input = input.replace(negativeBefore, '');
        inputIsNegative = true;
      }
      // Repeat the same procedure for the prefix.
      if (prefix && strStartsWith(input, prefix)) {
        input = input.replace(prefix, '');
      }
      // And again for negative.
      if (negative && strStartsWith(input, negative)) {
        input = input.replace(negative, '');
        inputIsNegative = true;
      }
      // Remove the postfix.
      // https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/slice
      if (postfix && strEndsWith(input, postfix)) {
        input = input.slice(0, -1 * postfix.length);
      }
      // Remove the thousand grouping.
      if (thousand) {
        input = input.split(thousand).join('');
      }
      // Set the decimal separator back to period.
      if (mark) {
        input = input.replace(mark, '.');
      }
      // Prepend the negative symbol.
      if (inputIsNegative) {
        output += '-';
      }
      // Add the number
      output += input;
      // Trim all non-numeric characters (allow '.' and '-');
      output = output.replace(/[^0-9\.\-.]/g, '');
      // The value contains no parse-able number.
      if (output === '') {
        return false;
      }
      // Covert to number.
      output = Number(output);
      // Run the user-specified post-decoder.
      if (decoder) {
        output = decoder(output);
      }
      // Check is the output is valid, otherwise: return false.
      if (!isValidNumber(output)) {
        return false;
      }
      return output;
    }
    // Framework
    // Validate formatting options

  function validate(inputOptions) {
      var i, optionName, optionValue,
        filteredOptions = {};
      for (i = 0; i < FormatOptions.length; i += 1) {
        optionName = FormatOptions[i];
        optionValue = inputOptions[optionName];
        if (optionValue === undefined) {
          // Only default if negativeBefore isn't set.
          if (optionName === 'negative' && !filteredOptions.negativeBefore) {
            filteredOptions[optionName] = '-';
            // Don't set a default for mark when 'thousand' is set.
          } else if (optionName === 'mark' && filteredOptions.thousand !==
            '.') {
            filteredOptions[optionName] = '.';
          } else {
            filteredOptions[optionName] = false;
          }
          // Floating points in JS are stable up to 7 decimals.
        } else if (optionName === 'decimals') {
          if (optionValue >= 0 && optionValue < 8) {
            filteredOptions[optionName] = optionValue;
          } else {
            throw new Error(optionName);
          }
          // These options, when provided, must be functions.
        } else if (optionName === 'encoder' || optionName === 'decoder' ||
          optionName === 'edit' || optionName === 'undo') {
          if (typeof optionValue === 'function') {
            filteredOptions[optionName] = optionValue;
          } else {
            throw new Error(optionName);
          }
          // Other options are strings.
        } else {
          if (typeof optionValue === 'string') {
            filteredOptions[optionName] = optionValue;
          } else {
            throw new Error(optionName);
          }
        }
      }
      // Some values can't be extracted from a
      // string if certain combinations are present.
      throwEqualError(filteredOptions, 'mark', 'thousand');
      throwEqualError(filteredOptions, 'prefix', 'negative');
      throwEqualError(filteredOptions, 'prefix', 'negativeBefore');
      return filteredOptions;
    }
    // Pass all options as function arguments

  function passAll(options, method, input) {
      var i, args = [];
      // Add all options in order of FormatOptions
      for (i = 0; i < FormatOptions.length; i += 1) {
        args.push(options[FormatOptions[i]]);
      }
      // Append the input, then call the method, presenting all
      // options as arguments.
      args.push(input);
      return method.apply('', args);
    }
    /** @constructor */

  function wNumb(options) {
      if (!(this instanceof wNumb)) {
        return new wNumb(options);
      }
      if (typeof options !== "object") {
        return;
      }
      options = validate(options);
      // Call 'formatTo' with proper arguments.
      this.to = function(input) {
        return passAll(options, formatTo, input);
      };
      // Call 'formatFrom' with proper arguments.
      this.from = function(input) {
        return passAll(options, formatFrom, input);
      };
    }
    /** @export */
  window.wNumb = wNumb;
}());

/* [data-animated="init"] */

function animated_css_compatible(el){
	/*
	 
	
	animation-timing-function :
		ease, ease-out, ease-in, ease-in-out, linear, cubic-bezier(x1, y1, x2, y2) (e.g. cubic-bezier(0.5, 0.2, 0.3, 1.0)) ...
	animation-duration : Xs or Xms
	animation-delay : Xs or Xms
	animation-iteration-count : X
	animation-fill-mode : forwards, backwards, both, none
	animation-direction : normal, alternate
	animation-play-state : paused, running, running
	*/
	
	if(el.length>0){
		//if( el.attr('data-animated') || el.attr('data-inview') ){ 
			el.each(function(){
				var el = $(this);
				el.css({
					'animation-timing-function': el.attr('data-animation-timing-function') ? el.attr('data-animation-timing-function') : '',
					'animation-duration': el.attr('data-animation-duration') ? el.attr('data-animation-duration') : '',
					'animation-delay': el.attr('data-animation-delay') ? el.attr('data-animation-delay') : '',
					'animation-iteration-count': el.attr('data-animation-iteration-count') ? el.attr('data-animation-iteration-count') : '',
					'animation-fill-mode': el.attr('data-animation-fill-mode') ? el.attr('data-animation-fill-mode') : '',
					'animation-direction': el.attr('data-animation-direction') ? el.attr('data-animation-direction') : '',
					'animation-play-state': el.attr('data-animation-play-state') ? el.attr('data-animation-play-state') : ''
				}); 
			});
			
				
		//}
	}	
};
function animated_css_reset(el){
	el.css({
		'animation-duration': '',
		'animation-delay': ''
	});
}
function animated_css_none(el){
	el.css({
		'animation-duration': '0s',
		'animation-delay': '0s'
	});
}
function animated_css_reverse(el){
	el.css({
		'animation-direction': 'reverse'
	});
}
function animated_css_reverse_reset(el){
	el.css({
		'animation-direction': ''
	});
}

function animated_on_off(ele, change){ 
	if(change=='on'){
		ele.find('[data-animated-on]').removeClass('off');
		ele.find('[data-animated-on]').each(function(){
			$(this).addClass( $(this).attr('data-animated-on') ); 
			animated_css_compatible($(this));
		});
		ele.find('[data-animated-off]').each(function(){
			$(this).removeClass( $(this).attr('data-animated-off') );
		});
	}
	if(change=='off'){
		ele.find('[data-animated-on]').addClass('off');
		// animated_css_reset(ele.find('[data-animated-on]')); 
		ele.find('[data-animated-on]').each(function(){
			$(this).removeClass( $(this).attr('data-animated-on') );
		});
		ele.find('[data-animated-off]').each(function(){
			$(this).addClass( $(this).attr('data-animated-off') );
		});
	}
}

+function ($) {
    //'use strict'; 
	
	animated_css_compatible( $('[data-animation="megamenu"]') );
	
	$('[data-inview="animated"]').on("webkitTransitionStart otransitionstart oTransitionStart msTransitionStart transitionstart", function(e){ 
		 $(this).addClass('started'); 
	});
	$('[data-inview="animated"]').on("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend", function(e){ 
		 $(this).removeClass('started'); 
	});
	$('[data-inview="animated"]').on("webkitAnimationStart oanimationstart msAnimationStart animationstart", function(e){ 
		$(this).addClass('started'); 
	});
	$('[data-inview="animated"]').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(e){ 
		$(this).removeClass('started'); 
	});

}(jQuery);

/*!
 * Dropdownhover v1.0.0 (http://bs-dropdownhover.kybarg.com)
 */
+function ($) {
    'use strict';
	function enableDropDownHover(me){ 
		me.parent().addClass('dropdown-hover');
		
		me.on('mouseenter mouseleave', function (e) {
			var dropdown = $(e.target).closest('.dropdown');
			var menu = $('.dropdown-menu', dropdown);
			
			// Reset if any opened
			$('.dropdown.show [aria-expanded]').attr('aria-expanded','false'); 
			$('.dropdown.show, .dropdown > .show').removeClass('show'); 
			
			dropdown.addClass('show');
			menu.addClass('show'); 
			me.attr('aria-expanded','true');
			
			
			
			menu.on('mouseleave',function(){
				dropdown[dropdown.is(':hover') ? 'addClass' : 'removeClass']('show');
				menu[dropdown.is(':hover') ? 'addClass' : 'removeClass']('show');
				if(dropdown.is(':hover')){
					me.attr('aria-expanded','true');
				}else{
					me.attr('aria-expanded','false');
				}
			});

			setTimeout(function () {
				dropdown[dropdown.is(':hover') ? 'addClass' : 'removeClass']('show');
				menu[dropdown.is(':hover') ? 'addClass' : 'removeClass']('show');
				if(dropdown.is(':hover')){
					me.attr('aria-expanded','true');
				}else{
					me.attr('aria-expanded','false');
				}
			}, 300);

		});
		
	}
	function disableDropDownHover(me){
		
		var dropdown = me.closest('.dropdown');
		var menu = $('.dropdown-menu', dropdown);
		menu.off('mouseleave');
		me.off('mouseenter mouseleave'); 
		me.parent().removeClass('dropdown-hover');
		
	}
	
	function disableNavbarShow(){
		if( $('.navbar').hasClass('navbar-expand-xs') && get_window_sizes() > bc_config.breakpoints.xs ){
			$('.navbar-expand-xs .collapse.show').collapse('toggle');
		}
		if( $('.navbar').hasClass('navbar-expand-sm') && get_window_sizes() > bc_config.breakpoints.sm ){
			$('.navbar-expand-sm .collapse.show').collapse('toggle');
		}
		if( $('.navbar').hasClass('navbar-expand-md') && get_window_sizes() > bc_config.breakpoints.md ){
			$('.navbar-expand-md .collapse.show').collapse('toggle');
		}
		if( $('.navbar').hasClass('navbar-expand-lg') && get_window_sizes() > bc_config.breakpoints.lg ){
			$('.navbar-expand-lg .collapse.show').collapse('toggle');
		}
		if( $('.navbar').hasClass('navbar-expand-xl') && get_window_sizes() > bc_config.breakpoints.xl ){
			$('.navbar-expand-xl .collapse.show').collapse('toggle');
		}
	}
	
	function makeDropDownHover(){ 
		
		$('[data-hover="dropdown"]').each(function(){ 
			$(this).closest('.navbar').addClass('using-dropdown-hover');
			var collapse = $(this).closest('.navbar-collapse');
			var me = $(this); 
			
			// data-hover-respond
			var respond = $(this).data('hover-respond') ? $(this).data('hover-respond') : 'md';
			var respond_min = bc_config.breakpoints.md;
			if(respond=='xs'){
				respond_min = bc_config.breakpoints.xs;
			}
			if(respond=='sm'){
				respond_min = bc_config.breakpoints.sm;
			}
			if(respond=='md'){
				respond_min = bc_config.breakpoints.md;
			}
			if(respond=='lg'){
				respond_min = bc_config.breakpoints.lg;
			}
			if(respond=='xl'){
				respond_min = bc_config.breakpoints.xl;
			} 
			
			if( $(window).width() < respond_min || $('body').hasClass('side-menu-visible') ) {
				disableDropDownHover($(this)); 
			}else{
				enableDropDownHover($(this));
			}
		});
		
	}
	
	$(document).ready(function () { 
		makeDropDownHover();  
		
		// Make dropdown-toggle to be click active if no touchevents screen
		$('html.no-touchevents [data-hover="dropdown"]').on('click', function(ele){
			if( $(this).attr('href') != "#" || $(this).attr('href') != '' ){
				ele.stopPropagation();
			} 
		});
	});
	$(window).on('resize', function () {
		makeDropDownHover(); 
		disableNavbarShow();
	});
	

}(jQuery);


/*
 

*/
 
+function ($) {
	// NEW, better, simpler, see css for beackpoints, todo that part width data-*
	$('[data-toggle="scroll-affixme"]').each(function() {

    	var ele = $(this);  
		var top = 0;
		var target = ele.data('affix-target');
		target = $(target);
		var offset_target = ele.data('affix-offset-target');
		offset_target = $(offset_target);

		$(window).on('load scroll resize', function() {
			var dif = 0;
			var currentTop = $(window).scrollTop(); 
 			
			var ele_height = ele.outerHeight();
 			var ele_top = ele.offset().top;
			var target_height = target.outerHeight();
			var target_top = target.offset().top;

			var offset_target_height = offset_target.outerHeight(); 

			currentTop = currentTop - offset_target_height;

			if( ( ele_height + offset_target_height  ) < target_height ){
				if( currentTop > target_top ){

					if( currentTop < (target_top + target_height - (ele_height) - offset_target_height ) ){
						ele.addClass('fixme');
						ele.removeClass('fixme-bottom');
					}else{
						ele.addClass('fixme-bottom');
					}
	 
				}else{
					ele.removeClass('fixme-bottom');
					ele.removeClass('fixme');
				}
			}else{
				ele.removeClass('fixme-bottom');
				ele.removeClass('fixme');
			}

			 
			if(ele.hasClass('fixme')){
				///ele.css('padding-top', offset_target_height);
			}else{
				///ele.css('padding-top','');
			}

		});

    });
	
}(jQuery);


+function ($) {
	
	var toggleScrollAffix = function(affixElement, scrollElement) {
  
		if( affixElement.data('affix-breakpoint') ){ 
			disabletoggleNavAffix(affixElement);
		}else{
			affixElement.removeClass('scrollifing'); 
		}
		
		affixElement.on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(e){ 
			$(this).off(e); 
		});

	};
	
	var disabletoggleNavAffix = function (affixElement){
		affixElement.addClass('scrollifing'); 
		if( affixElement.data('affix-breakpoint') == 'xs' && get_window_sizes('w') <= bc_config.breakpoints.xs ){
			affixElement.removeClass('scrollifing'); 
		}
		if( affixElement.data('affix-breakpoint') == 'sm' && get_window_sizes('w') <= bc_config.breakpoints.sm ){
			affixElement.removeClass('scrollifing'); 
		}
		if( affixElement.data('affix-breakpoint') == 'md' && get_window_sizes('w') <= bc_config.breakpoints.md ){
			affixElement.removeClass('scrollifing'); 
		}
		if( affixElement.data('affix-breakpoint') == 'lg' && get_window_sizes('w') <= bc_config.breakpoints.lg ){
			affixElement.removeClass('scrollifing'); 
		}
		if( affixElement.data('affix-breakpoint') == 'xl' && get_window_sizes('w') <= bc_config.breakpoints.xl ){
			affixElement.removeClass('scrollifing'); 
		}
	}
 
	$('[data-toggle="scroll-affix"]').each(function() {
		var ele = $(this);  
		var top = 0;
		$(window).on('load scroll resize', function() {
			var dif = 0;
			var currentTop = $(window).scrollTop(); 
			
			if( $(bc_config.layout.main_navbar).length>0 ){
				var n = $(bc_config.layout.main_navbar);
				if( n.data('affix-position') == 'top' || n.hasClass('fixed-top') ){
					if( n.data('affix-simulate')){
						dif = n.outerHeight(); 
					}
					top = n.outerHeight();
				}
			}
			
			if( $(bc_config.layout.main_header).length>0 ){
				if( $(bc_config.layout.main_navbar).data('toggle-affix') ){
					 
				}
				dif += $(bc_config.layout.main_header).outerHeight();
				//top = 0;
			}  
			
			toggleScrollAffix(ele, $(this));
			
			if(ele.hasClass('scrollifing')){
				 
			}
			
			if( currentTop >= dif && ele.hasClass('scrollifing')){ 
				ele.css('padding-top', top);
			}else{ 
				ele.css('padding-top', '');
			}
			
			if( ele.data('affix-offset-top') && ele.hasClass('scrollifing') ){ 
				if (currentTop < dif) { 
					ele.addClass('no-offset');
				}else{
					ele.removeClass('no-offset');
				} 
			}
			
			if( ele.data('affix-offset-target') ){
				
				 
				
			}
			
		});  

		// init
		toggleScrollAffix(ele, $(window));
		
		//BC_scrolling_classes(ele);
	});
	
}(jQuery);

/*
	 
	
	NavAffix effect
	
	Add [data-toggle="nav-affix"] to a navbar,
	this will add a div element, same height as navbar
	in order to simulate the same height for the fixed/absolute element if used
	see css (easy to customize) for rest of visible effect. 
	Js in fact just do nothing that can be visible.

*/


+function ($) {
	
	var toggleNavAffix = function(affixElement, scrollElement, wrapper) {

		var height = affixElement.outerHeight(),
			ele_top = affixElement.offset().top,
			ele_initial_top = affixElement.data('initial-offset-top'),
			top = wrapper.offset().top;
			
		var target_ele = affixElement.data('affix-target') ? affixElement.data('affix-target') : '';
		var offset_top_dif = 0;
		if(target_ele){
			offset_top_dif = $(target_ele).offset().top + $(target_ele).outerHeight();
		}
		
		var affixTop = height;
		wrapper.height(height);
		if (scrollElement.scrollTop() >= affixTop){ 
			affixElement.addClass("affix");
			
		} else {
			affixElement.removeClass("affix");  
		}
		
		if( affixElement.data('affix-breakpoint') ){ 
			disabletoggleNavAffix(affixElement, wrapper);
		}else{
			affixElement.removeClass('scrollifing');
			wrapper.removeClass('hide');
		}
		
		if( ( !affixElement.hasClass("this-affix-overflow") ) && scrollElement.scrollTop() >= ( ele_initial_top ) ){
			affixElement.addClass("this-affix");
			$(target_ele).addClass("affix-inside");
		}else{
			affixElement.removeClass("this-affix"); 
			$(target_ele).removeClass("affix-inside");			
		}
		// console.log(target_ele);
		
		if( offset_top_dif && ( scrollElement.scrollTop() >= ( offset_top_dif - ( height) ) ) ){
			affixElement.addClass("this-affix-overflow");
			affixElement.removeClass("this-affix");
			$(target_ele).removeClass("affix-inside");
		}else{
			affixElement.removeClass("this-affix-overflow");  
		}
		
		var do_null = false;
		
		if( affixElement.hasClass("affix") || affixElement.hasClass("this-affix") ){
			
			if( affixElement.hasClass("affix") ){
				if( affixElement.data('affix-addclass') ){ 
					if( affixElement.hasClass('scrollifing') ){ 
						affixElement.addClass(affixElement.data('affix-addclass')); 
					}  
				} 
				if( affixElement.data('affix-removeclass') ){
					if( affixElement.hasClass('scrollifing') ){
						affixElement.removeClass(affixElement.data('affix-removeclass')); 
					} 
				}
				
			}

			if( affixElement.hasClass("this-affix") ){
				if( affixElement.data('this-affix-addclass') ){ 
					if( affixElement.hasClass('scrollifing') ){ 
						affixElement.addClass(affixElement.data('this-affix-addclass')); 
					}  
				} 
				if( affixElement.data('this-affix-removeclass') ){
					if( affixElement.hasClass('scrollifing') ){
						affixElement.removeClass(affixElement.data('this-affix-removeclass')); 
					} 
				}
			} 
			
		}else{
			do_null = true;
			//affixElement.removeClass("this-affix");  
			 
			
		}
		
		if(do_null){
			$(target_ele).removeClass("affix-inside");
			affixElement.removeClass("this-affix-overflow"); 
			
			if( affixElement.data('affix-addclass') ){ 
				affixElement.removeClass(affixElement.data('affix-addclass')); 
			} 
			if( affixElement.data('affix-removeclass') ){
				affixElement.addClass(affixElement.data('affix-removeclass')); 
			}
			
			if( affixElement.data('this-affix-addclass') ){ 
				affixElement.removeClass(affixElement.data('this-affix-addclass')); 
			} 
			if( affixElement.data('this-affix-removeclass') ){
				affixElement.addClass(affixElement.data('this-affix-removeclass')); 
			}
		}
		
		affixElement.on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(e){ 
			$(this).off(e);
			wrapper.height(affixElement.outerHeight()); 
		});

	};
	
	var disabletoggleNavAffix = function (affixElement, wrapper){
		affixElement.addClass('scrollifing');
		wrapper.removeClass('hide');
		if( affixElement.data('affix-breakpoint') == 'xs' && get_window_sizes() <= bc_config.breakpoints.xs ){
			affixElement.removeClass('scrollifing');
			wrapper.addClass('hide');
		}
		if( affixElement.data('affix-breakpoint') == 'sm' && get_window_sizes() <= bc_config.breakpoints.sm ){
			affixElement.removeClass('scrollifing');
			wrapper.addClass('hide');
		}
		if( affixElement.data('affix-breakpoint') == 'md' && get_window_sizes() <= bc_config.breakpoints.md ){
			affixElement.removeClass('scrollifing');
			wrapper.addClass('hide');
		}
		if( affixElement.data('affix-breakpoint') == 'lg' && get_window_sizes() <= bc_config.breakpoints.lg ){
			affixElement.removeClass('scrollifing');
			wrapper.addClass('hide');
		}
		if( affixElement.data('affix-breakpoint') == 'xl' && get_window_sizes() <= bc_config.breakpoints.xl ){
			affixElement.removeClass('scrollifing');
			wrapper.addClass('hide');
		} 
		
		
	}


	$('[data-toggle="nav-affix"]').each(function() {
		var ele = $(this); 
		//var wrapper = $('<div id="affix-#'+ele.attr('id')+'" class="affixElement"></div>');
		var wrapper = $('<div id="affix-'+ele.attr('id')+'" class="affixElement"></div>');
		var height = ele.outerHeight();
		var top = ele.offset().top;
		ele.attr('data-initial-height', height);
		ele.attr('data-initial-offset-top', top);
		wrapper.height(height);
		if( ele.data('affix-simulate') ){		
			if( ele.data('affix-position') == 'top' ){ 
				ele.before(wrapper); 
			}
			if( ele.data('affix-position') == 'bottom' ){ 
				$('body').append(wrapper); 
			} 
			if( ele.data('affix-target') && !ele.data('affix-position') ){ 
				ele.before(wrapper); 
			}
		}
		if( ele.data('affix-scrollify') && ele.data('affix-target') ){

			$('body').scrollspy({ target: ele.find('.nav'), offset: height+10 })

		}
		$(window).on('scroll resize', function() {
			toggleNavAffix(ele, $(this), wrapper);
		});
		
		
		// init
		toggleNavAffix(ele, $(window), wrapper);
		//BC_scrolling_classes(ele); 
	});

}(jQuery);

+function ($) {
    //'use strict';
	
	// $('nav.navbar-expand-aside').expandAside();
	
	// Todo, let be able using data-* attributes, for example, passing the defaults > html strings, animation type, speed, so on...
	
	$.fn.expandAside = function(options) {
		
		var self = $(this); 
		
		var defaults = {  
			html: {
				overlay: '<div class="side-menu-overlay"></div>',
				sideMenu: '<div id="side-menu"></div>',
				closeButton: '<button class="close navbar-toggler default" type="button"><span class="custom-toggler"><span class="navbar-toggler-icon"></span></span></button>'
			}
		};
        var settings = $.extend(defaults, options); 
		 
		return self.each(function(){
			
			var me = $(this);
			var $side = ''; 
			
			var body = $('body').addClass('use-navbar-better');
			
			if( me.hasClass('navbar-expand-content') ){  
				$side = 'collapse-right';
				if( me.hasClass('collapse-left') ){
					$side = 'collapse-left';
				} 
				body.addClass('expand-content-on-overlay');
				body.addClass($side); 
			}
			var navbarCollapse = me.find('.navbar-collapse');
			var navbarButton = me.find('.navbar-toggler');
			// Add the needed HTML elements for the plugin to work. 
			// All the elements are styled in navbar-sidemnu.css.
			
			body.append( settings.html.overlay );
			var overlay = $('.side-menu-overlay');

			body.append( settings.html.sideMenu );
			var sideMenu = $('#side-menu');
			
			var n = navbarButton.clone();
			n.appendTo( sideMenu );
			var sideMenuCloseBtn = sideMenu.find('.navbar-toggler').addClass('close');
			sideMenuCloseBtn.attr('data-toggle','');
			//sideMenu.append( settings.html.closeButton );
			//var sideMenuCloseBtn = sideMenu.find('.close');

			sideMenu.append('<div class="contents"></div>');
			var sideMenuContents = sideMenu.find('.contents'); 

			// This event is trigerred when the user clicks the navbar toggle button.

			navbarCollapse.on('show.bs.collapse', function (e) {
				// Stop the default navbar behaviour (don't open the collapse navigation).
				e.preventDefault();

				// Instead we copy the navbar contents and add them to our side menu.
				var menuContent = $(this).html();
				var nav = $(this).closest('.navbar');
				var theClass = ''; 
				
				if(nav.hasClass('collapse-left')){
					body.addClass('collapse-left');
					body.removeClass('collapse-right');
				}
				if(nav.hasClass('collapse-right')){
					body.removeClass('collapse-left');
					body.addClass('collapse-right');
				}
				
				if(nav.hasClass('navbar-expand-xs')){
					theClass = 'navbar-expand-xs';
				}
				if(nav.hasClass('navbar-expand-sm')){
					theClass = 'navbar-expand-sm';
				}
				if(nav.hasClass('navbar-expand-md')){
					theClass = 'navbar-expand-md';
				}
				if(nav.hasClass('navbar-expand-lg')){
					theClass = 'navbar-expand-lg';
				}
				if(nav.hasClass('navbar-expand-xl')){
					theClass = 'navbar-expand-xl';
				}
				sideMenuContents.addClass(theClass);
				sideMenuContents.html(menuContent);
				
				// scroll_to call.
				sideMenuContents.find(".scroll-to:not(.menu-item), .scroll-to-nav a, .scroll-to.menu-item a").on('click',function (e){
					bs_do_scroll_to($(this));
				});
				// Animate the side menu into frame.
				slideIn();
			});


			// Hide the menu when the "x" button is clicked.
			
			sideMenuCloseBtn.on('click', function(e) {
				e.preventDefault();
				slideOut();
			});

			// Hide the menu when the overlay element is clicked.
			
			overlay.on('click', function(e) {
				slideOut();
			}); 

			// Listen for changes in the viewport size.
			// If the original navbar collapse is visible then the nav is expanded.
			// Hide/Show the menu accordingly.
			
			$(window).resize(function(){
				if(!navbarCollapse.is(":visible") && body.hasClass('side-menu-visible')) {
					sideMenu.show();
					overlay.show();
				}
				else {
					body.removeClass('side-menu-visible');
					body.removeClass('overflow-hidden');
					sideMenu.hide();
					overlay.hide();
				}
			});
			
			function slideIn() {
				//body.addClass('overflow-hidden');
				sideMenu.show();
				setTimeout(function() {    
					body.addClass('side-menu-visible');
					overlay.fadeIn();
					$(window).resize();
				}, 50);
			}
			
			function slideOut() {
				body.removeClass('side-menu-visible');
				overlay.fadeOut();
				setTimeout(function() {
					sideMenu.hide();
					body.removeClass('overflow-hidden');
					$(window).resize();
				}, 400);
			}
			
		}); // --<<< self.each
	};
	
	$('nav.navbar-expand-aside').expandAside();
		
}(jQuery);

/*

	[data-parallax]

*/


+function ($) {
	//'use strict';
 
    $.fn.parallax = function(options) {
		 
        // Establish default settings  
		 
        var breakpoints = $(bc_config.breakpoints);

		var defaults = { 
			type: 'background-position',
			speed: 0.15,
			reverse: false,
			efect_collapse: (breakpoints.md?breakpoints.md:768)
		};
        var settings = $.extend(defaults, options); 
        // Iterate over each object in collection
        return this.each( function() {
			 
        	// Save a reference to the element
        	var $this = $(this);
			
			var datatype = $this.attr('data-parallax');
			 
			var dataspeed = $this.attr('data-parallax-speed');
			var datareverse = $this.attr('data-parallax-reverse');
			var efect_collapse  = $this.attr('data-parallax-responsive');
			var dataoffset = $this.attr('data-parallax-offset');
			
			var p_type = (datatype) ? datatype : settings.type;
			var p_speed = (dataspeed) ? dataspeed : settings.speed;
			var p_reverse = (datareverse) ? datareverse : settings.reverse; 
			var p_efect_collapse = (efect_collapse) ? efect_collapse : settings.efect_collapse;
			var p_offset = (dataoffset) ? dataoffset : ''; 
        	// Set up Scroll Handler
        	//$(document).scroll(function(){
			 
			$(window).on("load resize scroll",function(e){
				
				var headheight = $('#main-navbar').outerHeight();
				
				var w = window,
					d = document,
					e = d.documentElement,
					g = d.getElementsByTagName('body')[0],
					x = w.innerWidth || e.clientWidth || g.clientWidth,
					y = w.innerHeight|| e.clientHeight|| g.clientHeight;
					
					
				var windowHeight = y;
				var windowWidth = x; 
				
				if( windowWidth > p_efect_collapse ){
					 
					var scrollTop = $(window).scrollTop();
					var offset = $this.offset().top;
						//offset = offset + p_offset;

					var height = $this.outerHeight(); 
					 
					if( p_type == 'margin-top' ){ 
						if (offset + height <= scrollTop || offset >= scrollTop + windowHeight) {
							return;
						} 
						var yBgPosition = Math.round((offset - scrollTop - headheight) * p_speed); 
						if(p_reverse){
							$this.css('margin-top', '-' + yBgPosition + 'px');
						}else{
							$this.css('margin-top', '' + yBgPosition + 'px');
						} 
					}
					if( p_type == 'margin-bottom' ){ 
						if (offset + height <= scrollTop || offset >= scrollTop + windowHeight) {
							return;
						} 
						var yBgPosition = Math.round((offset - scrollTop) * p_speed);  
						if(p_reverse){
							$this.css('margin-bottom', '-' + yBgPosition + 'px');
						}else{
							$this.css('margin-bottom', '' + yBgPosition + 'px');
						}
					}

					if( p_type == 'translate-top' ){ 
						if (offset + height <= scrollTop || offset >= scrollTop + windowHeight) {
							return;
						} 
						var yBgPosition = Math.round((offset - scrollTop) * p_speed); 
						if(p_reverse){
							$this.css({'transform' : 'translate(0, -' + yBgPosition + 'px)'});
						}else{
							$this.css({'transform' : 'translate(0, ' + yBgPosition + 'px)'});
						}

						
					}
					
					if( p_type == 'background-position' ){ 
						// Check if above or below viewport
						if (offset + height <= scrollTop || offset - height >= scrollTop + windowHeight) {
							return;
						} 
						var starty = height/2;
						var yBgPosition = ( Math.round((offset - scrollTop) * p_speed) ); 
						 // Apply the Y Background Position to Set the Parallax Effect
						
						if(p_reverse){
							$this.css('background-position', 'center -' + yBgPosition + 'px');
						}else{
							$this.css('background-position', 'center ' + yBgPosition + 'px');
						} 
						
					} 
				
				} else {
					
					if( p_type == 'margin-top' ){ 
						$this.css('margin-top', '0px'); 
					}
					if( p_type == 'margin-bottom' ){ 
						$this.css('margin-bottom', '0px'); 
					}
					if( p_type == 'background-position' ){ 
						$this.css('background-position', 'center center'); 
					}
					
				}
			
			});
			
			
			
        });
    }
}(jQuery);

// Inveiw for Bootclean - V 1.0
// rgdesign.org
// DEC 2017 

+function ($) {
	//'use strict'; 
	$.fn.isInViewport = function(offset) {
		var elementTop = $(this).offset().top + offset;
		var elementBottom = elementTop + $(this).outerHeight() - (offset*2);
		var viewportTop = $(window).scrollTop();
		var viewportBottom = viewportTop + $(window).height();
		return elementBottom > viewportTop && elementTop < viewportBottom;
	};
    $.fn.inview = function(options) {
		 
        // Establish default settings  
		
		var defaults = {  
			offset: $('body').data('inview-offset') ? $('body').data('inview-offset') : 50,
			breakpoint: $('body').data('inview-breakpoint') ? $('body').data('inview-breakpoint') : 0,
			delay: $('body').data('inview-delay') ? $('body').data('inview-delay') : 0
		};
        var settings = $.extend(defaults, options); 
		
		var windowSize = function(s){
			var s = s ? s : 'x';
			var w = window,
			d = document,
			e = d.documentElement,
			g = d.getElementsByTagName('body')[0],
			x = w.innerWidth || e.clientWidth || g.clientWidth,
			y = w.innerHeight|| e.clientHeight|| g.clientHeight;
			if(s=='x') return x;
			if(s=='y') return y;
		}
		
		var if_viewport = function(el, offset){
			var offset = offset ? offset : 0;
			var elementTop = el.offset().top + offset;
			var elementBottom = elementTop + el.outerHeight() - (offset*2);
			var viewportTop = $(window).scrollTop();
			var viewportBottom = viewportTop + $(window).height();
			return elementBottom > viewportTop && elementTop < viewportBottom;
		}
		var if_breakpoint = function(breakpoint){
			var windowHeight = windowSize('y');
			var windowWidth = windowSize('x');
			return windowWidth > breakpoint;
		}
		
		var inview_click = function(target){
			
			if(!target.hasClass('inview-first')){
				target.addClass('inview-first'); 
				target.trigger('click');
			}
			
		}
		
		var inview_load = function(target){
			
			if(!target.hasClass('inview-first')){
				target.addClass('inview-first');
				
				var ajax_target = target.data('ajax-target');
				var ajax_holder = $('<div class="ajax-holder"></div>');
				var ajax_loader = $('<div class="ajax-loader"></div>');
				
				target.append(ajax_holder);
				var min_height = target.data('min-height') ? target.data('min-height') : '';
				if(min_height=='100%'){
					min_height = windowSize('y');
				}
				target.find('.ajax-holder').css('min-height',min_height).append(ajax_loader);
				
				var ajax_load = $('<div class="ajax-load"></div>');
				target.find('.ajax-holder').addClass('loading').append(ajax_load);
				
				target.find('.ajax-load').load(ajax_target, function(responseTxt, statusTxt, xhr) {
					if(responseTxt=='success'){
						
					}
					target.find('.ajax-holder [data-inview]').inview();
					target.find('.ajax-holder').css('min-height','').removeClass('loading'); 
					$(window).trigger('resize');
				});
			}
			
		}
		
		var inview_lazyload = function(target){
			
			if(!target.hasClass('inview-first')){
				target.addClass('inview-first');
				target.parent().addClass('loading');
				if(target.parent().find('.lazyload-loading').length<=0){
					target.parent().prepend('<span class="lazyload-loading"/>');
				}
				//target.parent().find('.loading').addClass('on');
				
				var ajax_src = target.data('inview-src'); 
				if(ajax_src){
					var temp = $("<img>");
					temp.load(ajax_src, function(){
						var new_src = $(this).attr('src');
						var loading = target.parent().find('.lazyload-loading'); 
						loading.delay(300).fadeOut(600, function(){ 
							target.attr('src',new_src);
							loading.remove(); 
							target.parent().removeClass('loading');
						});
					});
					temp.attr('src', ajax_src);
				}

				/*
				TODO, test this
				*/

				var ajax_background_src = target.data('inview-background-image');
				if(ajax_background_src){
					//console.log(ajax_background_src);
					if(!target.hasClass('loaded') ){  

						var temp = $("<img>");
						temp.load(ajax_background_src, function(){
							var new_src = $(this).attr('src');
							var loading = target.parent().find('.lazyload-loading'); 
							loading.delay(300).fadeOut(600, function(){ 
								target.css('background-image','url('+new_src+')');
								target.addClass('loaded')
								loading.remove(); 
								target.parent().removeClass('loading');
							});
						});
						temp.attr('src', ajax_background_src);

					}
				}
			}
			
		}
        // Iterate over each object in collection
        return this.each( function() {
			 
        	// Save a reference to the element
        	var $this = $(this); 
			var target = $this.data('inview-target') ? $($this.data('inview-target')) : $this;
			var data_style = $this.data('inview'); 
			var inview_offset = $this.data('inview-offset') ? $this.data('inview-offset') : settings.offset;  
			var breakpoint  = $this.data('inview-breakpoint') ? $this.data('inview-breakpoint') : settings.breakpoint; 
			 
			
			$this.addClass('inview'); // reference for inited by js 
			
			if($this.data('inview-target')){
				target.attr('data-animated-on', $this.data('animated-on'));
				target.attr('data-animated-off', $this.data('animated-off'));
			}
			if( $this.find('[data-animated-on]').length>0 ){
				target = $this.find('[data-animated-on]'); 
				$this.addClass('inview-inside');
			}  
			
			
			if( $this.data('inview') == 'animated' ){
				target.addClass('animated');
			}
			if( target.data('animated-once') || $this.data('animated-once') ){
				target.addClass('animated-once'); 
			}
			
			if( $this.data('lazyload') ){
				if($this.parent().find('.loading').length<=0){
					$this.parent().append('<span class="loading"/>');
				}
			}
			
			target.each(function(){
				var delay = $(this).data('inview-delay') ? $(this).data('inview-delay') : settings.delay; 
				if(delay){ 
					$(this).css({
						"transition-delay": delay, 
						"-webkit-transition-delay": delay,
						"-moz-transition-delay": delay,
						"-o-transition-delay": delay,
						"transition-delay": delay,
					}); 
				}  
				
			});
			
			
			/*
				target.data('animated-on-up')
				target.data('animated-on-down')
				target.data('animated-off-up')
				target.data('animated-off-down')
			*/
			 
			//animated_css_compatible(target); // make transitions css crossbrowser 
			// console.log(target);
			if( target.length > 0 ){
				
				if(if_breakpoint(breakpoint)){
					
					target.addClass( target.attr('data-animated-off') );
					animated_css_none( target );
					
					$this.find('[data-animated-off]').each(function(){ 
						$(this).addClass( $(this).attr('data-animated-off') );
						animated_css_none($(this));
					});
					
				}else{
					target.removeClass('animated');
					$this.find('[data-animated-off]').removeClass('animated');
				}
				
				$(window).on("load resize scroll", function(e){  
					
					if( if_breakpoint(breakpoint) ){
						
						if(if_viewport( $this, inview_offset ) ){
							
							if( target.data('animated-once') ){
								target.addClass('inview-first'); 
							}
							target.addClass('inview-me'); 
							
							animated_css_compatible(target);  
							target.addClass(target.data('animated-on'));
							
							if( target.data('animated-off') ){ 
								target.removeClass(target.data('animated-off')); 
							} 
							
							if( $this.data('inview') == 'load' ){ 
								inview_load(target);
							}
							if( $this.data('inview') == 'lazyload' ){ 
								inview_lazyload(target);
							}
							if( $this.data('inview') == 'click' ){ 
								inview_click(target);
							}
							
						}else{ 
						
							target.removeClass('inview-me'); 
							
							if( target.data('animated-off') && !target.hasClass('inview-first')  ){ 
								target.addClass(target.data('animated-off')); 
							} 
							if( target.data('animated-once') ){
								 
							}else{ 
								target.removeClass(target.data('animated-on'));  
							}
							 
						}  
					}else{ 
						target.removeClass('inview-me'); 
						target.removeClass(target.data('animated-on'));
						target.removeClass(target.data('animated-off'));
					}
				});
			
			}
			
        });
    } 
	
}(jQuery);

/* ##################################################### */
/* ##################################################### */


+function ($) {
    //'use strict';
	
	/* Default data-slick usage, data attributes like { "key":"value", "key-2":"value } */
	$(document).ready(function () {
		
		$('[data-dots-thumbs="true"]').each(function(){
			var slider = $(this); 
			
			var template = $('<template><a href="" class="dots-thumbs" data-toggle="slick-goto"><img class="dots-thumbs-img" src=""/></a></template>');
			
			if( $(this).parent().find('template.thumbs').length>0 ){
				var template = $(this).parent().find('template.thumbs'); 
			}
			
			if($(this).data('dots-thumbs-target')){
				var slick_thumbs = $( $(this).data('dots-thumbs-target') );
				slick_thumbs.addClass('slick-dots-thumbs');
			}else{
				$(this).parent().append('<div class="slick-dots-thumbs"></div>');
				var slick_thumbs = $(this).parent().find('.slick-dots-thumbs');
			}
			
			var slick_items = $(this).find('.slick-slide:not(.slick-cloned) img[data-thumb]'); 
			var template_out = ''; 
			slick_items.each(function(e){
				var me = $(this); 
				var thumb = me.data('thumb');
				var index = e;
				var new_template = $( template.html() ); 
				new_template.attr('href',index);
				new_template.attr('data-index',index);
				new_template.find('img').attr('src',thumb); 
				slick_thumbs.append(new_template); 
			});
			
			var current_slide = slider.find('.slick-current').data('slick-index');
			//console.log(current_slide);
			slick_thumbs.find('[data-toggle="slick-goto"]').eq(current_slide).addClass('current');
			slick_thumbs.find('[data-toggle="slick-goto"]').on('click',function(){ 
				var slide = $(this).data('index');
				if(slider.hasClass('slick-initialized')){
					slick_thumbs.find('.current').removeClass('current');
					$(this).addClass('current');
					slider.slick('slickGoTo', slide);
				}
				return false;
			});
			
			
		});
		
		$('[data-toggle="slick-prev"]').on('click',function(){ 
			var slider = $( $(this).attr('href') );
			if(slider.hasClass('slick-initialized')){
				slider.slick('slickPrev'); 
			}
			return false;
		});
		$('[data-toggle="slick-next"]').on('click',function(){ 
			var slider = $( $(this).attr('href') );
			if(slider.hasClass('slick-initialized')){
				slider.slick('slickNext');
			} 
			return false;
		});
		
		var bc_slick_responsive_default = [
			{
			  breakpoint: bc_config.breakpoints.xl,
			  settings: { 
				slidesToShow: 3,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: bc_config.breakpoints.lg,
			  settings: {
				slidesToShow: 3,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: bc_config.breakpoints.md,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: bc_config.breakpoints.sm,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			} 
		];
		
		
		
		/*
			afterChange : slick, currentSlide
			beforeChange : slick, currentSlide, nextSlide
			breakpoint : event, slick, breakpoint
			destroy : event, slick
			edge : slick, direction
			init : slick
			reInit : slick
			setPosition : slick
			swipe: slick, direction
			lazyLoaded : event, slick, image, imageSource
			lazyLoadError : event, slick, image, imageSource
		*/ 
		$('[data-slick]').on('setPosition', function(slick){
			slick_callback($(this), 'setPosition'); 
			$(this).addClass('setPosition'); 
			$(window).trigger('resize');
		});
		$('[data-slick]').on('afterChange', function(e, slick, currentSlide){ 
			slick_callback($(this), 'afterChange');   
			$(this).removeClass('beforeChange'); 
			$(this).addClass('afterChange'); 

			slick_lazyload_background($(this)); 
			animated_on_off($(this).find('.slick-current'), 'on'); 
		}); 
		$('[data-slick]').on('beforeChange', function(slick, currentSlide, nextSlide){
			slick_callback($(this), 'beforeChange'); 
			$(this).removeClass('init-first-time'); 
			$(this).removeClass('setPosition');
			$(this).removeClass('afterChange');
			$(this).addClass('beforeChange');  

			animated_on_off($(this).find('.slick-slide').not('.slick-current'), 'off');  
		});
		$('[data-slick]').on('breakpoint', function(event, slick, breakpoint){
			slick_callback($(this), 'breakpoint');  
		});
		$('[data-slick]').on('destroy', function(event, slick){
			slick_callback($(this), 'destroy'); 
			$(this).removeClass('init-first-time'); 
			$(this).removeClass('init'); 
			$(this).removeClass('setPosition');
			$(this).removeClass('beforeChange');
			$(this).removeClass('afterChange'); 
		});
		$('[data-slick]').on('edge', function(slick, direction){
			slick_callback($(this), 'edge'); 
		});  
		
		$('[data-slick]').on('reInit', function(slick){
			slick_callback($(this), 'reInit'); 
			$(this).removeClass('init-first-time'); 
			$(this).removeClass('init'); 
			$(this).removeClass('setPosition');
			$(this).removeClass('beforeChange');
			$(this).removeClass('afterChange');
		});
		
		$('[data-slick]').on('swipe', function(slick, direction){
			slick_callback($(this), 'swipe'); 
		});
		$('[data-slick]').on('lazyLoaded', function(event, slick, image, imageSource){
			slick_callback($(this), 'lazyLoaded'); 
		});
		$('[data-slick]').on('lazyLoadError', function(event, slick, image, imageSource){
			slick_callback($(this), 'lazyLoadError'); 
		});
		
		
		$('[data-slick]').find('[data-slick-nav="next"]').on('click',function(){ 
			var slider = $(this).closest('[data-slick]'); 
			slider.slick('slickNext');
			return false;				
		});
		$('[data-slick]').find('[data-slick-nav="prev"]').on('click',function(){ 
			var slider = $(this).closest('[data-slick]'); 
			slider.slick('slickPrev');
			return false;				
		});
		
	});

	$('[data-slick]').on('init', function(slick){
		
		slick_callback($(this), 'init');
		$(this).addClass('init'); 
		$(this).addClass('init-first-time'); 
		animated_on_off($(this), 'on');  
		var me = $(this); 
		animated_on_off(me.find('.slick-slide'), 'on'); 
		slick_lazyload_background(me); 
	});

	function slick_callback(el, $callback, $params){
		var $params = $params ? $params : '';  
		var callback = el.attr("data-callback-"+$callback+""); 
		var x = eval(callback);
		if (typeof x == 'function') {
			x(el);
		}  
	} 

	function slick_lazyload_background(el){
		/*

		TODO, insert lazyload-loading and so on if not present,
			
			class "loading" into parent item
			item <span class="lazyload-loading"></span> before item

		like:

		<div class="item loading">
				<span class="lazyload-loading"></span>
				<div class="item-container image-cover" data-lazyload-src="<?php echo MAIN_THEME_URI;?>/images/theme/slider-01.jpg" style="background-image: url(<?php echo MAIN_THEME_URI;?>/images/theme/slider-01-low.jpg); min-height: 480px; max-height: 715px; height: 458px;">
				</div>
			</div>

		*/
		if( el.find('.slick-current [data-lazyload-src]').data('lazyload-src') ){
			var target = el.find('.slick-current [data-lazyload-src]'); 
			var background_src = target.data('lazyload-src');
			var temp = $("<img>");
			temp.load(background_src, function(){
				var new_src = $(this).attr('src');
				var loading = target.parent().find('.lazyload-loading'); 
				loading.delay(300).fadeOut(600, function(){ 
					target.css('background-image','url('+new_src+')');
					loading.remove(); 
					target.parent().removeClass('loading');
				});
			});
			temp.attr('src', background_src);
		}
		
		el.find('.slick-cloned [data-lazyload-src]').each(function(){

			var target = $(this);
			var background_src = target.data('lazyload-src');
			$(this).parent().find('.lazyload-loading').remove(); 
			$(this).parent().removeClass('loading');
			$(this).css('background-image','url('+background_src+')');
		});

	}
	
	function get_percentage_window(){
		return get_window_sizes('h');
	}

	function test_slick_sizes(me){ 
		if(me.data('embed-responsive')){
			me.find('.embed-responsive-item').css('height','');
			var orig_h = me.find('.embed-responsive-item').height();
			var offset_el = $(me.data('embed-responsive'));
			var offset = offset_el.height();

			var max = me.data('embed-responsive-max-height');

			if( orig_h > max ){
				offset = 0;
			}
			
			var height = orig_h - offset; 
			max = max - offset; 
			//me.find('.embed-responsive').css('height', height);
			//me.find('.embed-responsive').css('max-height', (max?max:'inherit'));
		}
	}
	
	function make_slick_sizes(me){
		
		var data_height = me.data('breakpoint-height');  
		var min_height = 'inherit';
		var max_height = 'inherit';
		var height = 'auto'; 
		
		if(data_height.defaults){
			min_height = data_height.defaults.min;
			max_height = data_height.defaults.max;
			height = data_height.defaults.default;
		}else{
			if(data_height.xs){
				min_height = data_height.xs.min;
				max_height = data_height.xs.max;
				height = data_height.xs.default;
			}
		}
		
		if(data_height.sm){
			if( get_window_sizes('w') > bc_config.breakpoints.sm && data_height.sm.default){ 
				height = data_height.sm.default;
				min_height = data_height.sm.min;
				max_height = data_height.sm.max;
			}
		}
		if(data_height.md){
			if(get_window_sizes('w') > bc_config.breakpoints.md && data_height.md.default){
				height = data_height.md.default;
				min_height = data_height.md.min;
				max_height = data_height.md.max;
			}
		}
		if(data_height.lg){
			if(get_window_sizes('w') > bc_config.breakpoints.lg && data_height.lg.default){
				height = data_height.lg.default;
				min_height = data_height.lg.min;
				max_height = data_height.lg.max;
			}
		}
		if(data_height.xl){
			if(get_window_sizes('w') > bc_config.breakpoints.xl && data_height.xl.default){
				height = data_height.xl.default;
				min_height = data_height.xl.min;
				max_height = data_height.xl.max;
			}
		}
		if (/^\d+(\.\d+)?%$/.test(height)) {
			// is %
			height = get_percentage_window();
		} else {
			// fail
		}
		
		var height_test = me.find('.item-image').height();

		if(height_test){
			if(height>height_test){
				height = height_test; 
				max_height = height_test;
			}
			if(min_height>height_test){
				min_height = height_test;
			} 
		}


		var offset = 0;
		if( $('#affix-main-navbar').length>0 ){
			offset = $('#affix-main-navbar').height(); 
		}

		var elem_offset = me.data('breakpoint-height-offset');
		if( $(elem_offset).length>0 ){
			offset = offset + $(elem_offset).height(); 
		}
		
		min_height = parseFloat(min_height) - offset;
		max_height = parseFloat(max_height) - offset;
		height = parseFloat(height) - offset;
		//console.log(max_height);
		me.find('.item-container').css('min-height', min_height+'px');
		me.find('.item-container').css('max-height', max_height+'px'); 
		me.find('.item-container').css('height', height+'px');
		
		me.find('.embed-responsive').css('max-height', max_height+'px');
	} 
	
	$(window).on('load resize orientationchange',function(){  
	
		$('[data-slick]').each(function(){
			var me = $(this);
			var enable_at = me.data('enable-at');
			var enable_slider = true;
				var enable_1 = false;
				var enable_2 = false;
				var enable_3 = false;
			// console.log(enable_at);
			var obj = enable_at;
			//console.log(enable_at.xs);
			/**/
			
			var out = '';
			var so = true;
			if(enable_at){
				$.each(obj, function(i, val) {
					out += " | "+(i + " : " + val);
					if( get_window_sizes('w') > bc_config.breakpoints[i] ){
						out += ( " #bk: "+bc_config.breakpoints[i]);
						//console.log(bc_config.breakpoints[i]);
						if(val === 1){
							out += ( " TRUE ");
							enable_1 = true;
							enable_2 = false;
							//enable_slider = false;
						}else{
							out += ( " FALSE ");
							enable_2 = true;
							enable_1 = false;
							//console.log("breakpoints enable");
							//enable_slider = true;
						}
						enable_3 = false;
					}else{
						out += ( " TRUE ");
						enable_3 = true;
						//console.log("enable");
						//enable_slider = true;
					} 
				})
				
				if(enable_3){
					if(enable_1){
						so = true;
					}else{
						so = false;
					}
				}else{
					if(enable_1){
						so = true;
					}else{
						so = false;
					}
				}
				
				enable_slider = so;
			} 
			//console.log(so+" | 1: "+enable_1+" 2: "+enable_2+" 3: "+enable_3+" | ");
			
			if(enable_slider){
				if(me.hasClass('slick-initialized')){
					return
				}else{
					me.slick();
				} 
			}else{
				if( me.hasClass('slick-initialized') ){ 
					me.slick('unslick');
					//make_slick_sizes(me);
				} 
			}
			
			// Check against custom data passend inside slick data
			var this_data = me.data('slick');
			
			/*
			
				new arg: "equalHeightSlides": true / false (default)
			
			*/
			if( this_data.equalHeightSlides && me.hasClass('slick-initialized') ){ 
				// me.slick('resize');
				// EqualHeightSlides(me); 
				me.addClass('slick-equal-height-slides');
				//console.log( me.attr('class')+" equalHeightSlides: "+this_data.equalHeightSlides);				
			} else{
				me.removeClass('slick-equal-height-slides');
				//console.log( 'no equal heights' );
			}
			
		});
		
		$('[data-breakpoint-height]').each(function(){ 
			make_slick_sizes($(this));
		});
		$('[data-embed-responsive]').each(function(){ 
			test_slick_sizes($(this));
		});
	});
	
	
	var EqualHeightSlides = function (me) {
        var slickTrackHeight = me.find('.slick-track').height();
        me.find('.slick-slide').css('height', slickTrackHeight  + 'px' );
    };
	
	/*
	
		Custom [data-bc-slick]
		quite similar to data-slick, but not... see behind :)
	
		Example:
		
			<div class="your-slide" data-slick='{
					"dots":false,
					"slide":".slide-item",
					"slidesToShow":4,
					"slidesToScroll": 1,
					"adaptiveHeight": true,
					"focusOnSelect": false,
					"accessibility": false,
					"responsive": [
							{
							  "breakpoint": 1200,
							  "settings": { 
								"slidesToShow": 3,
								"slidesToScroll": 1
							  }
							},
							{
							  "breakpoint": 992,
							  "settings": { 
								"slidesToShow": 3,
								"slidesToScroll": 1
							  }
							},
							{
							  "breakpoint": 768,
							  "settings": { 
								"slidesToShow": 2,
								"slidesToScroll": 1
							  }
							},
							{
							  "breakpoint": 480,
							  "settings": { 
								"slidesToShow": 1,
								"slidesToScroll": 1
							  }
							}
						]
					}'>
	
	*/ 

	function test_slick(me, s_data){
		me.removeClass('slick-no-slide');
		var items_w = 0;
		var item = s_data.slide ? s_data.slide : '.item';
		me.find(item).each(function(){ 
			items_w += $(this).width(); 
		}) 
		if(items_w<me.width()){
			me.addClass('slick-no-slide');
		}else{
			me.removeClass('slick-no-slide');
		}
	}
	var data_slick = $('[data-bc-slick]');
	if(data_slick.length>0){
		data_slick.each(function(){ 
			var s = $(this);
			var s_data = $(this).data('bc-slick'); 
			var s_data_responsive = $(this).data('slick-responsive'); 
			if(s_data_responsive){ 
				//console.log("######## parseJSON s_data_responsive");
				//console.log(eval(s_data_responsive));
				s_data.responsive = eval(s_data_responsive); // Here i pass responsive array from json format taken from field row options... :)
				
			} 
			s.on('init', function(event, slick){ 
				test_slick($(this), s_data); 
				//console.log('init');
			});
			
			s.on('breakpoint', function(event, slick, breakpoint){
				test_slick($(this), s_data);
				//console.log('breakpoint');
			});
			s.on('afterChange', function(slick, currentSlide){ 
				//console.log('afterChange');
			});
			
			s.slick(s_data); 
			
			s.on('setPosition', function(event, slick, currentSlide, nextSlide){
				$(window).trigger('resize');
				$(window).trigger('scroll');
			});
		});
	}
	
	
}(jQuery);
/* ##################################################### */
/* ##################################################### */

/*

	https://getbootstrap.com/docs/4.1/components/modal/#via-javascript

*/
+function ($) {
    //'use strict'; 
	
	$('.modal').on('show.bs.modal', function (e) {  
		if($(e.target).attr('data-relatedTarget')){
			var relatedTarget = $('#'+$(e.target).attr('data-relatedTarget'));
			var href = relatedTarget.data('external-target') ? relatedTarget.data('external-target') : relatedTarget.attr('href');
			$(e.target).find('.modal-dialog').append('<span class="loader"></span>');			
			var jqxhr = $.ajax( { url:href, context: $(e.target) } )
			  .done(function(result) { 
				var modal = $( this );  
				if( modal.attr('data-target-size') ){ 
					modal.find('.modal-dialog').addClass( modal.attr('data-target-size') ); 
					if( modal.attr('data-target-size') == 'modal-dialog-full' ){
						modal.addClass('modal-full');
					}
				}
				if( modal.attr('data-target-class') ){
					modal.addClass(modal.attr('data-target-class'));
				}
				modal.find('.loader').delay(300).fadeOut(300,function(){
					modal.removeClass( "loading" );
					modal.addClass( "loaded" );					
					modal.find('.modal-content').html(result);
				}); 		
			  })
			  .fail(function() { 
			  })
			  .always(function() { 
			  });
		}  
	});
	$('.modal').on('shown.bs.modal', function (e) {
	  //console.log('shown.bs.modal');
	  //console.log(e);
	});
	$('.modal').on('hide.bs.modal', function (e) {
	  //console.log('hide.bs.modal');
	});
	$('.modal').on('hidden.bs.modal', function (e) { 
	  if( $(e.target).attr('data-relatedTarget') ){
		  $(e.target).find('.loader').remove();
		  $(e.target).find('.modal-content').html('');
		  
		  $(e.target).find('.modal-dialog').removeClass( $(e.target).attr('data-target-size') ); 
		  $(e.target).removeClass($(e.target).attr('data-target-class'));
		  
		  $(e.target).removeClass('modal-full');
		  $(e.target).removeClass('loading');
		  $(e.target).removeClass('loaded');
		  
		  $(e.target).removeAttr('data-relatedTarget');
		  $(e.target).removeAttr('data-target-size');
		  $(e.target).removeAttr('data-target-class'); 
	  }
	});
	
	// external-modal 
	$('[data-toggle="external-modal"]').each( function(i){ 
		if( !$(this).attr('id') ) $(this).attr('id','external-modal-'+i); 
		$(this).on('click',function(e){ 
			var me = $(this);
			var target = me.data('target');
			var href = me.data('external-target') ? me.data('external-target') : me.attr('href');
			if(href){
				$(target).attr('data-relatedTarget', $(this).attr('id'));
				
				if( $(this).attr('data-target-size') ){
					$(target).attr('data-target-size', $(this).attr('data-target-size'));
				}
				if( $(this).attr('data-target-class') ){
					$(target).attr('data-target-class', $(this).attr('data-target-class'));
				} 
				
				$(target).addClass('loading');
				$(target).removeClass( "loaded" );		
				$(target).modal(); 
			}
			return false;
		});
	} );
	
}(jQuery);