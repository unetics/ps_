jQuery(document).ready(function($) {

	//Caching Variables for performance
	var $body						= $('body');
	var $supermenu					= $('.supermenu');
	var $topmenuCollapseMobile		= $('#supermenu-sm-navbar-collapse-mob');
	var $topmenuToggleMobile		= $('.visible-mobile .sm-navbar-toggle');
	var $navbar_fixed_top			= 'sm-navbar-fixed-top';
	
    // Add Classes to <body> 
	$body.addClass(supermenu_vars.body_class);
	
	

	//Toggle Topmenu
	function smToggleTopmenu() {
		$topmenuCollapseMobile.toggleClass('expand');
		$topmenuToggleMobile.toggleClass('ssclose');
	}
	$topmenuToggleMobile.on('click', function() {
		smToggleTopmenu();
	});
	
	// Topmenu Dropdowns Mobile
	$('li.smdropdown > a > .smdropdown-togglenb').on('click', function(e) {
		e.preventDefault();
		$(this).closest('.smdropdown').toggleClass('open');
	});
	$('li.smdropdown-submenu .smdropdown-togglenb').on('click', function(e) {
		e.preventDefault();
		$(this).closest('.smdropdown-submenu').toggleClass('open');
	});

	// Toggle Search
  $(function () {
    $('a[href="#smsearch"]').on('click', function(event) {
      $('#smsearch').toggleClass('open');
      $('.sm-searchform input[type="search"]').focus();   
      event.preventDefault();
      event.stopPropagation();
    	$(document).one('click', function (e) {
		    $('#smsearch').toggleClass('open');
		});
      
    });
  });

	//Fixed Topmenu
  if (supermenu_vars.sm_fixed_menu) { // Fixed Basic
    if (supermenu_vars.sm_after_fixed_menu === 'fixed_basic') {
      $(function() {
        $supermenu.addClass($navbar_fixed_top);
      });
    }
    else if (supermenu_vars.sm_after_fixed_menu === 'visible_up') { //Visible on Scroll up
      $(function() {
        $supermenu.addClass($navbar_fixed_top);
      });
      var myElement = document.querySelector(".supermenu");
      var headroom  = new Headroom(myElement);
      headroom.init();
    }
    else if (supermenu_vars.sm_after_fixed_menu === 'hide_then_show') { // Hide then Show
      $body.animate({ paddingTop: 0 });
        $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if (scroll >= supermenu_vars.sm_effect_triggerpoint) {
          if ( supermenu_vars.sm_hide_then_show_fade ) {
            $supermenu.addClass('sm-navbar-fixed-top animated fadeInDown');
          } else {
            $supermenu.addClass('sm-navbar-fixed-top');
          }
          $body.css({ paddingTop: 100 });
          $body.addClass('notransition');
           setTimeout(function() {
               $body.removeClass('notransition');
           }, 50);
        } else {
          $supermenu.removeClass('sm-navbar-fixed-top fadeInDown');
          $body.css({ paddingTop: 0 });
          $body.addClass('notransition'); //Todo, don't like the hack
           setTimeout(function() {
               $body.removeClass('notransition');
           }, 50);
        }
      });
    }
  }
   
function scrollTrigger(active){
	var Logo = $('.desktop_logo img');
	if(active){
		$supermenu.addClass('scroll-change');
		Logo.fadeOut(40,function(){
			Logo.attr("src",supermenu_vars.desktop_logo_scroll);
        	Logo.fadeIn(400);
    	}); 
// 		console.log('scrollTrigger on');
	}else{
		$supermenu.removeClass('scroll-change');
		Logo.fadeOut(40,function(){
			Logo.attr("src",supermenu_vars.desktop_logo);
        	Logo.fadeIn(400);
    	});
// 		console.log('scrollTrigger off');
	}
	
}

/* Detcet scroll trigger */
    var flag = $(window).scrollTop() > supermenu_vars.sm_effect_triggerpoint ? 1 : 2;
    if(flag === 1){ scrollTrigger(true); }else{ scrollTrigger(false); }
    $(window).scroll(function () {
        var scrollTop = $(window).scrollTop();
        if (scrollTop > supermenu_vars.sm_effect_triggerpoint && flag !== 1) {
            scrollTrigger(true);
            flag = 1;
        } else if (scrollTop <= supermenu_vars.sm_effect_triggerpoint && flag !== 2) {
            scrollTrigger(false);
            flag = 2;
        }
    });
});
