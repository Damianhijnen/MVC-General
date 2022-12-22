<?php
class Countries extends Controller {
  
  public function __construct() {
    $this->countryModel = $this->model('Country');
    /**echo(var_dump($_POST));*/
  }

  public function index() {
    /**
     * Haal via de method getFruits() uit de model Fruit de records op
     * uit de database
     */
    $countries = $this->countryModel->getCountries();

    /**
     * Maak de inhoud voor de tbody in de view
     */
    $rows = '';
    foreach ($countries as $value){
      $rows .= "<tr>
                  <td>$value->id</td>
                  <td>" . htmlentities($value->name, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td>" . htmlentities($value->capitalCity, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td>" . htmlentities($value->continent, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td>" . number_format($value->population, 0, ',', '.') . "</td>
                  <td><a href='". URLROOT . "/countries/update/$value->id'>Update</a></td>
                  <td><a href='". URLROOT . "/countries/delete/$value->id'>Delete</a></td>
                </tr>";
    }


    $data = [
      'title' => '<h1>Landenoverzicht</h1>',
      'countries' => $rows
    ];
    $this->view('countries/index', $data);
  }


  public function update($id = null){
    var_dump($id);    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
      //var_dump($_POST);
      $this->countryModel->updateCountry($_POST);
      header("Location: ". URLROOT."/countries/index ");
    }else{
      $row = $this->countryModel->getSingleCountry($id);
      $data = [
      'title' => '<h1>update landenoverzicht</h1>',
      'row' => $row
    ];
    $this->view("countries/update", $data); 
  }
  }

  public function delete($id){
    $this ->countryModel->deleteCountry($id);

    $data =[
      'deleteStatus' => "Het record met id  = $id is verwijderd<br>"
    ];

    $this-> view("countries/delete", $data);
    header("Refresh:3 url=" .URLROOT. "/countries/index");
  }
  
  public function create(){
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      try{
      //sanitizes the post array
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      //prepares and executes query
      $this ->countryModel->createCountry($_POST);
      //send you back to main page
      header("Location: ". URLROOT."/countries/index ");
    } catch(PDOException $e) {
      echo("<h3>Het inserten van de record is gefaald<br></h3><h4>");
      var_dump($e);
      echo("</h4><br>");
    }
    }else{
    $data = ["title" => "Voeg nieuw land in"];
    echo("ai2");
    $this-> view("countries/create", $data);
   
    }
  }
}
?>