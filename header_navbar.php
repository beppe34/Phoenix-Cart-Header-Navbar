<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

class hook_shop_siteWide_header_navbar {
    
    
  function listen_injectAfterFooter() {
      
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
    </script>
code;
    return $display;
  }

}
