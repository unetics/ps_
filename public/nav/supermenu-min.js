jQuery(document).ready(function($){function e(){a.toggleClass("expand"),r.toggleClass("ssclose")}function s(e){var s=$(".desktop_logo img");e?(o.addClass("scroll-change"),s.fadeOut(40,function(){s.attr("src",supermenu_vars.desktop_logo_scroll),s.fadeIn(400)})):(o.removeClass("scroll-change"),s.fadeOut(40,function(){s.attr("src",supermenu_vars.desktop_logo),s.fadeIn(400)}))}var n=$("body"),o=$(".supermenu"),a=$("#supermenu-sm-navbar-collapse-mob"),r=$(".visible-mobile .sm-navbar-toggle"),t="sm-navbar-fixed-top";if(n.addClass(supermenu_vars.body_class),r.on("click",function(){e()}),$("li.smdropdown > a > .smdropdown-togglenb").on("click",function(e){e.preventDefault(),$(this).closest(".smdropdown").toggleClass("open")}),$("li.smdropdown-submenu .smdropdown-togglenb").on("click",function(e){e.preventDefault(),$(this).closest(".smdropdown-submenu").toggleClass("open")}),$(function(){$('a[href="#smsearch"]').on("click",function(e){$("#smsearch").toggleClass("open"),$('.sm-searchform input[type="search"]').focus(),e.preventDefault(),e.stopPropagation(),$(document).one("click",function(e){$("#smsearch").toggleClass("open")})})}),supermenu_vars.sm_fixed_menu)if("fixed_basic"===supermenu_vars.sm_after_fixed_menu)$(function(){o.addClass(t)});else if("visible_up"===supermenu_vars.sm_after_fixed_menu){$(function(){o.addClass(t)});var i=document.querySelector(".supermenu"),u=new Headroom(i);u.init()}else"hide_then_show"===supermenu_vars.sm_after_fixed_menu&&(n.animate({paddingTop:0}),$(window).scroll(function(){var e=$(window).scrollTop();e>=supermenu_vars.sm_effect_triggerpoint?(supermenu_vars.sm_hide_then_show_fade?o.addClass("sm-navbar-fixed-top animated fadeInDown"):o.addClass("sm-navbar-fixed-top"),n.css({paddingTop:100}),n.addClass("notransition"),setTimeout(function(){n.removeClass("notransition")},50)):(o.removeClass("sm-navbar-fixed-top fadeInDown"),n.css({paddingTop:0}),n.addClass("notransition"),setTimeout(function(){n.removeClass("notransition")},50))}));var d=$(window).scrollTop()>supermenu_vars.sm_effect_triggerpoint?1:2;s(1===d?!0:!1),$(window).scroll(function(){var e=$(window).scrollTop();e>supermenu_vars.sm_effect_triggerpoint&&1!==d?(s(!0),d=1):e<=supermenu_vars.sm_effect_triggerpoint&&2!==d&&(s(!1),d=2)})});