<?php
class Countries extends Controller {
  
  public function __construct() {
    $this->countryModel = $this->model('');
    /**echo(var_dump($_POST));*/
  }

  public function index() {



    $data = [
      'title' => '<h1>Roosters</h1>',
      
    ];
    $this->view('rooster/index', $data);
  }




}
?>