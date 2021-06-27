<div class="<?= $content_width ?> cm-header-navbar mb-1">
<nav id="header_navbar" class="navbar navbar-expand-md <?= $navstyle ?>">
  <div class="<?= BOOTSTRAP_CONTAINER ?>">
    <div class="navbar-header">
	<button type="button" class="navbar-toggler nb-hamburger-button collapsed" data-toggle="collapse" data-target="#bp_nav" aria-controls="bp_nav" aria-expanded="false" aria-label="Toggla Menyrad på och av">
	  <span class="navbar-toggler-icon"></span>
	</button>
    </div>
    <div class="collapse navbar-collapse" id="bp_navbar">
        <ul class="navbar-nav mr-auto">
        <?php
        foreach($navcontent as $navc){
            switch($navc){
                case cm_header_navbar::MODULE_CONTENT_HEADER_NAVBAR_CATEGORIES:
                    get_header_navbar_categories();
                    break;
                case cm_header_navbar::MODULE_CONTENT_HEADER_NAVBAR_SPECIALS:
                    get_header_navbar_specials();
                    break; 
                default;
                    // to be implemented
                    echo $navc . " is not yet implemented!";
            }
        }
        ?>
        </ul>
    </div>
  </div>
</nav>

</div>

<?php
    function get_header_navbar_categories(){
        $category_tree = &Guarantor::ensure_global('category_tree');
        echo buildcategorymenu($category_tree, $category_tree->get_root_id());
        
    }
    function get_header_navbar_specials(){
        $specials_link = tep_href_link('specials.php');
        $display =<<<code
            <li name="headnavbar_SPECIALOFFERS" class="nav-item nb-special-offers">
            <a class="nav-link" href="$specials_link">Specials</a>
            </li>
code;
        echo $display;
    }
    
    function buildcategorymenu(&$category_tree,$level_id){
        $display = '';
        // loop level
        foreach ($category_tree->get_children($level_id) as $c_id) {
            $category = $category_tree->get($c_id);
            $category['children'] = $category_tree->get_children($c_id);
            
            // if has children
            if ($category['children']) {
                if((int)$level_id==0){
                    $display .= '<li class="nav-item dropdown dropdown-hover">';
                    $display .= '  <a class="nav-link dropdown-toggle" href="#" id="ddcat' . $category['id'] . '" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $category['name'] . '</a>';
                    $display .= '  <div class="dropdown-menu" aria-labelledby="ddcat' . $category['id'] . '">';
                    $display .= buildcategorymenu($category_tree,$c_id);
                    $display .= '  </div>';
                    $display .= '</li>';
                }else{
                    $display .= '<div class="dropdown dropright">';
                    $display .= '  <a class="dropdown-item dropdown-toggle" href="#" id="dropdown-layouts" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $category['name'] . '</a>';
                    $display .= '  <div class="dropdown-menu" aria-labelledby="dropdown-layouts">';
                    $display .= buildcategorymenu($category_tree,$c_id);
                    $display .= '  </div>';
                    $display .= '</div>';                    
                }
            }else if((int)$level_id==0 ) {
                $cpath = buildBreadcrumb($category['id'],null,$category_tree);
                $display .= '<li class="nav-item">';
                $display .= '  <a class="nav-link" href="' . tep_href_link('index.php', 'cPath=' . $cpath) . '">' . $category['name'] . ' (' . $cpath . ')</a>';
                $display .= '</li>';
            }else{
                $cpath = buildBreadcrumb($category['id'],null,$category_tree);
                $display .= '  <a class="dropdown-item" href="' . tep_href_link('index.php', 'cPath=' . $cpath) . '">' . $category['name'] . ' (' . $cpath . ')</a>';
            }
        }
        return $display;
    }
    
    function buildBreadcrumb($id, $level = null,$tree) {
      $ancestors = array_reverse($tree->get_ancestors($id));
      $ancestors[] = $id;
      
      return implode('_', $ancestors);
    }

?>
