<?php
/*
  Copyright (c) 2020, G Burton

  This work is licensed under a
  Creative Commons Attribution-NonCommercial-NoDerivatives 4.0 International License.

  You should have received a copy of the license along with this work.
  If not, see <http://creativecommons.org/licenses/by-nc-nd/4.0/>.
*/

  class cm_header_navbar extends abstract_executable_module {

    const CONFIG_KEY_BASE = 'MODULE_CONTENT_HEADER_NAVBAR_';
    
    public const MODULE_CONTENT_HEADER_NAVBAR_CATEGORIES='Categories';
    public const MODULE_CONTENT_HEADER_NAVBAR_SPECIALS ='Specials';
    public const MODULE_CONTENT_HEADER_NAVBAR_RECENTVIEW = 'Recently Viewed';
    public const MODULE_CONTENT_HEADER_NAVBAR_FAVOURITES = 'Favourites';
    
    public function __construct() {
      parent::__construct(__FILE__);
    }

    function execute() {
      global $oscTemplate;
      $category_tree = &Guarantor::ensure_global('category_tree');

      $content_width = MODULE_CONTENT_HEADER_NAVBAR_CONTENT_WIDTH;

      $navstyle_array[] = MODULE_CONTENT_HEADER_NAVBAR_STYLE_BG;
      $navstyle_array[] = MODULE_CONTENT_HEADER_NAVBAR_STYLE_FG;
      $navstyle_array[] = MODULE_CONTENT_HEADER_NAVBAR_COLLAPSE;
      $navstyle = implode(' ', $navstyle_array);
      
      $navcontent = explode(';', MODULE_CONTENT_HEADER_NAVBAR_CONTENT);
      
      $tpl_data = ['group' => $this->group, 'file' => __FILE__];
      include 'includes/modules/content/cm_template.php';
    }

    protected function get_parameters() {
      return [
        'MODULE_CONTENT_HEADER_NAVBAR_STATUS' => [
          'title' => 'Enable Navbar in header Module',
          'value' => 'True',
          'desc' => 'Do you want to enable this module?',
          'set_func' => "tep_cfg_select_option(['True', 'False'], ",
        ],
        'MODULE_CONTENT_HEADER_NAVBAR_CONTENT_WIDTH' => [
          'title' => 'Content Width',
          'value' => 'col-sm-12',
          'desc' => 'What width container should the content be shown in? (12 = full width, 6 = half width).',
        ],
        'MODULE_CONTENT_HEADER_NAVBAR_STYLE_BG' => [
          'title' => 'Background Colour Scheme',
          'value' => 'bg-light',
          'desc' => 'What background colour should this Navigation Bar have?  See https://getbootstrap.com/docs/4.4/utilities/colors/#background-color',
          'set_func' => "tep_cfg_select_option(['bg-primary', 'bg-secondary', 'bg-success', 'bg-danger', 'bg-warning', 'bg-info', 'bg-light', 'bg-dark', 'bg-white'], ",
        ],
        'MODULE_CONTENT_HEADER_NAVBAR_STYLE_FG' => [
          'title' => 'Link Colour Scheme',
          'value' => 'navbar-light',
          'desc' => 'What foreground colour should this Navigation Bar have?  See https://getbootstrap.com/docs/4.4/components/navbar/#color-schemes',
          'set_func' => "tep_cfg_select_option(['navbar-dark', 'navbar-light'], ",
        ],
        'MODULE_CONTENT_HEADER_NAVBAR_COLLAPSE' => [
          'title' => 'Collapse Breakpoint',
          'value' => 'navbar-expand',
          'desc' => 'When should this Navigation Bar Show? See https://getbootstrap.com/docs/4.4/components/navbar/#how-it-works',
          'set_func' => "tep_cfg_select_option(['navbar-expand', 'navbar-expand-sm', 'navbar-expand-md', 'navbar-expand-lg', 'navbar-expand-xl'], ",
        ],
        'MODULE_CONTENT_HEADER_NAVBAR_CONTENT' => [
          'title' => 'Navbar content',
          'value' => cm_header_navbar::MODULE_CONTENT_HEADER_NAVBAR_CATEGORIES,
          'desc' => 'Choose what content will be shown in the navbar',
          'set_func' => "tep_cfg_multiple_select_option(['" . cm_header_navbar::MODULE_CONTENT_HEADER_NAVBAR_CATEGORIES . "', '" . cm_header_navbar::MODULE_CONTENT_HEADER_NAVBAR_SPECIALS . "', '" . cm_header_navbar::MODULE_CONTENT_HEADER_NAVBAR_RECENTVIEW . "', '" . cm_header_navbar::MODULE_CONTENT_HEADER_NAVBAR_FAVOURITES . "'], ",
        ],          
        'MODULE_CONTENT_HEADER_NAVBAR_SORT_ORDER' => [
          'title' => 'Sort Order',
          'value' => '900',
          'desc' => 'Sort order of display. Lowest is displayed first.',
        ],
      ];
    }

  }
  