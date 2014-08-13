<?php
/** SubHeader is used to Render Sub Header icons
 * Such as going viral, upload image
 * is Called at view files
*/
class SubHeader extends CWidget {
 
    public $subheader = array();   
 
    public function run() {
        $this->render('subHeader');
    }
 
}
?>