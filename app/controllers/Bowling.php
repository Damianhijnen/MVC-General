<?php
class Bowling extends Controller {

  public function __construct() {
    $this->BowlingScores = $this->model('BowlingScores');
    /**echo(var_dump($_POST));*/
  }

public function index() {
  $data = [
    'title' => "Bowling"
  ];

  $PermID = $_SESSION['PermisionID'];
  $userID = $_SESSION['ID'];

  $scores = $this->BowlingScores->getScores($PermID, $userID);

 
  

  // 
  //   The Call up data for customer
  // 
  if ($_SESSION['PermisionID'] == 1){
   
  
    $rows = '';
    foreach ($scores as $value){
   
      $rows .= "<tr>
                  <td>$value->ReservationID</td>
                  <td>" . htmlentities($value->Score_Name, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td>" . htmlentities($value->Score, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td>" . htmlentities($value->DATE, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td>" . number_format($value->ReservationID, 0, ',', '.') . "</td>
  
                </tr>";
    }
  
  
  
    $data = [
      'title' => '<h1>Scores Dag 2</h1>',
      'scores' => $rows
    ];
  }


  //
  //  The Call up data for employey
  // 
  if ($_SESSION['PermisionID'] == 2){
   
  
    $rows = '';
    foreach ($scores as $value){   
      $rows .= "<tr>
                  <td>$value->UserID</td>
                  <td>$value->ReservationID</td>
                  <td>" . htmlentities($value->Score_Name, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td>" . htmlentities($value->Score, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td>" . htmlentities($value->DATE, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td>" . number_format($value->ReservationID, 0, ',', '.') . "</td>
                  <td><a href='". URLROOT . "/Bowling/update/$value->ID'>Update</a></td>
                  <td><a href='". URLROOT . "/Bowling/delete/$value->ID'>Delete</a></td>                  

                </tr>";
    }
  
  
  
    $data = [
      'title' => '<h1>Landenoverzicht</h1>',
      'scores' => $rows
    ];
  }

 //needs to be last otherwise data doesnt work
  $this->view('Bowling/index', $data);

}



  //
  //  Delete record function
  //
  public function delete($id){
    $this ->BowlingScores->deleteScore($id);

    $data =[
      'deleteStatus' => "Het record met id  = $id is verwijderd<br>"
    ];

    $this-> view("Bowling/delete", $data);
    header("Refresh:3 url=" .URLROOT. "/Bowling/index");
  }

  //
  // Update record function
  // 
  public function update($id = null){    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
      $this->BowlingScores->updateScore($_POST);
      $_SESSION["msg"] = 1;
      header("Location: ". URLROOT."/Bowling/index ");
    }else{
      $row = $this->BowlingScores->getSingleScore($id);
      $data = [
      'title' => '<h1>update Score</h1>',
      'row' => $row,
    ];
    $message = "<script type='text/javascript'>Wakka;</script>";
    $this->view("Bowling/update", $data, $message); 
  }
  }
  
  
  
  //
  // Create new record
  //
  public function create(){
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      try{
      //sanitizes the post array
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      //prepares and executes query
      $this ->BowlingScores->createScore($_POST);
      //send you back to main page
      header("Location: ". URLROOT."/Bowling/index ");
    } catch(PDOException $e) {
      echo("<h3>Het inserten van de record is gefaald<br></h3><h4>");
      var_dump($e);
      echo("</h4><br>");
    }
    }else{
    $data = ["title" => "Voeg nieuw score in"];
    $this-> view("Bowling/create", $data);
   
    }
  }




}




