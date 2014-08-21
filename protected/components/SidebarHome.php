<?php
/** SidebarHome is used to Render sidebar contents at home page
 * Such as Follows, Hash tags
 * is Called at view files
*/
class SidebarHome extends CWidget {
 
    public $sidebar = array();   
 
    public function run() {
        $this->render('sidebarHome');
    }
 
}
?>