<?php
class Testing extends Controller {

    public function __construct() {
        $this->countryModel = $this->model('Country');
        /**echo(var_dump($_POST));*/
    }

    public function index() {
        /**
         * Haal via de method getFruits() uit de model Fruit de records op
         * uit de database
         */

    
    
        $data = [
          'title' => '<h1>Testing maat</h1>', 
        ];
        $this->view('testing/index', $data);
      }
}