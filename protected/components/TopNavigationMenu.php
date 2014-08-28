<?php
/** TopNavigationMenu is used to Render Header menus
 * Such as notification, message icon, search box at the page Header
 * is Called at view files
*/
class TopNavigationMenu extends CWidget {
 
    public $navigationmenu = array(); //to Pass values to the view file  
 
    public function run() {
        $this->render('topNavigationMenu');
    }
 
}
?>