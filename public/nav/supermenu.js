jQuery(document).ready(function($) {

	//Caching Variables for performance
	var $body						= $('body');
	var $bodyHeight 				= $body.height();
	var $supermenu					= $('.supermenu');
	var $navHeight 					= $supermenu.height();
	var $topmenuCollapseMobile		= $('#supermenu-sm-navbar-collapse-mob');
	var $topmenuToggleMobile		= $('.visible-mobile .sm-navbar-toggle');
	var $navbar_collapse			= $('.sm-navbar-collapse');
	var $navbar_collapse_height		= $navbar_collapse.height();
	var $navbar_fixed_top			= 'sm-navbar-fixed-top';
	var $superside					= $('.superside');
	var $superside_toggler			= $('.superside-toggler');
	
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
		$(this).closest('.smdropdown').toggleClass('open')
	});
	$('li.smdropdown-submenu .smdropdown-togglenb').on('click', function(e) {
		e.preventDefault();
		$(this).closest('.smdropdown-submenu').toggleClass('open')
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
   
  //Topmenu Height Change
   if (supermenu_vars.sm_menu_change_size == true) {
    $(window).scroll(function() {
      var scroll = $(window).scrollTop();
      if (scroll >= supermenu_vars.sm_effect_triggerpoint) {
        $supermenu.addClass('scroll-change');
      } else {
        $supermenu.removeClass('scroll-change');
      }
    });
  }
  
  // Topmenu Width Change
  if (supermenu_vars.sm_change_menu_width == true && supermenu_vars.sm_new_menu_width === 'full_width_then_container') {
    $(window).scroll(function() {
      var scroll = $(window).scrollTop();
      if (scroll >= supermenu_vars.sm_effect_triggerpoint) {
        $(".no-container").addClass('sm-container');
      } else {
        $(".no-container").removeClass('sm-container');
      }
    });
  }
  else if (supermenu_vars.sm_change_menu_width == true && supermenu_vars.sm_new_menu_width === 'container_then_full_width') {
    $(window).scroll(function() {
      var scroll = $(window).scrollTop();
      if (scroll >= supermenu_vars.sm_effect_triggerpoint) {
        $(".supermenu > div").addClass('no-container');
      } else {
        $(".supermenu > div").removeClass('no-container');
      }
    });
  }
  
  //Topmenu Padding
  if (supermenu_vars.sm_fixed_menu == true && supermenu_vars.sm_menu_configura_padding === 'automatic' && supermenu_vars.sm_after_fixed_menu === 'fixed_basic' && supermenu_vars.sm_visible_load == false) {
    $body.animate({ paddingTop: 0 });
  }
 

	/* Add is-social-icon class to menu item if it has icon */
  $(".menu-item-name:has(._mi)").parent().parent().addClass('is-social-icon');
});