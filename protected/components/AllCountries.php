<?php
/** Browse All Countries Modal POPUP Window
 *  Containing List of All the countries, with starting Alphabet
 * is Called from MONACO link
*/
class AllCountries extends CWidget {
 
    public $allcountries = array();   
 
    public function run() {
        $this->render('allcountries');
    }
 
}
?>