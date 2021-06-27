<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

class hook_shop_siteWide_header_navbar {
    
    
  function listen_injectSiteEnd() {
      
      $display =<<<code
    <script>
      document.addEventListener("DOMContentLoaded", function(){
        window.addEventListener('scroll', function() {
          if (window.scrollY > 50) {
            document.getElementById('header_navbar').classList.add('fixed-top');
            // add padding top to show content behind navbar
            navbar_height = document.querySelector('.navbar').offsetHeight;
            document.body.style.paddingTop = navbar_height + 'px';
          } else {
            document.getElementById('header_navbar').classList.remove('fixed-top');
             // remove padding top from body
            document.body.style.paddingTop = '0';
          } 
        });
      });
          
$.fn.dropdown = (function() {
    var bsDropdown = $.fn.dropdown;
    return function(config) {
        if (typeof config === 'string' && config === 'toggle') { // dropdown toggle trigged
            $('.has-child-dropdown-show').removeClass('has-child-dropdown-show');
            $(this).closest('.dropdown').parents('.dropdown').addClass('has-child-dropdown-show');
        }
        var ret = bsDropdown.call($(this), config);
        $(this).off('click.bs.dropdown'); // Turn off dropdown.js click event, it will call 'this.toggle()' internal
        return ret;
    }
})();

$(function() {
    $('.dropdown [data-toggle="dropdown"]').on('click', function(e) {
        $(this).dropdown('toggle');
        e.stopPropagation(); // do not fire dropdown.js click event, it will call 'this.toggle()' internal
    });
    $('.dropdown').on('hide.bs.dropdown', function(e) {
        if ($(this).is('.has-child-dropdown-show')) {
        	$(this).removeClass('has-child-dropdown-show');
            e.preventDefault();
        }
        e.stopPropagation();    // do not need pop in multi level mode
    });
});

// for hover
$('.dropdown-hover').on('mouseenter',function() {
  if(!$(this).hasClass('show')){
    $('>[data-toggle="dropdown"]', this).dropdown('toggle');
  }
});
$('.dropdown-hover').on('mouseleave',function() {
  if($(this).hasClass('show')){
    $('>[data-toggle="dropdown"]', this).dropdown('toggle');
  }
});
$('.dropdown-hover-all').on('mouseenter', '.dropdown', function() {
  if(!$(this).hasClass('show')){
    $('>[data-toggle="dropdown"]', this).dropdown('toggle');
  }
});
$('.dropdown-hover-all').on('mouseleave', '.dropdown', function() {
  if($(this).hasClass('show')){
    $('>[data-toggle="dropdown"]', this).dropdown('toggle');
  }
});              
    </script>
code;
    return $display;
  }

}
