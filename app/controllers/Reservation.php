<?php
class Reservation extends Controller {

  public function __construct() {
    $this->ReservationOrganizer = $this->model('ReservationOrganizer');
    /**echo(var_dump($_POST));*/

  }

public function index() {
  $data = [
    'title' => "Reservations"
  ];

  $PermID = $_SESSION['PermisionID'];
  $userID = $_SESSION['ID'];

  $Reservations = $this->ReservationOrganizer->getReservations($PermID, $userID);

  

  // 
  //   The Call up data for customer
  // 
  if(isset($Reservations[0])){
    if ($_SESSION['PermisionID'] == 1){
   
  
      $rows = '';

      foreach ($Reservations as $value){

        $hek = $value->Heefthek;

        if ($hek == 0){
          $hek = "Nee";
        } else{
          $hek= "Ja";
        }
   
      $rows .= "<tr>
                  <td>$value->ID</td>
                  <td>" . htmlentities($value->OpeningstijdId, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td>" . htmlentities($value->TariefID, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td>" . number_format($value->PakketOptieId, 0, ',', '.') . "</td>
                  <td>" . htmlentities($value->Datum, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td>" . htmlentities($value->BeginTijd, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td>" . htmlentities($value->EindTijd, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td>" . htmlentities($value->AantalVolwassen, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td>" . htmlentities($value->AantalKinderen, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td>" . htmlentities($value->nummer, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td>" . htmlentities($hek, ENT_QUOTES, 'ISO-8859-1') . "</td>

                  <td><a href='". URLROOT . "/Reservation/update/$value->Reserveringsnummer'>Update</a></td>
                  <td><a href='". URLROOT . "/Reservation/score/$value->ID'>Score</a></td>

                </tr>";
    }
  
  
  
    $data = [
      'title' => '<h1>Reservations</h1>',
      'Reservations' => $rows
    ];
  


  //
  //  The Call up data for employey
  // 
  if ($_SESSION['PermisionID'] == 2){
   
  
    $rows = '';
    foreach ($Reservations as $value){   
        $rows .=  "<tr>
        <td>$value->ID</td>
        <td>" . htmlentities($value->OpeningstijdId, ENT_QUOTES, 'ISO-8859-1') . "</td>
        <td>" . htmlentities($value->TariefID, ENT_QUOTES, 'ISO-8859-1') . "</td>
        <td>" . number_format($value->PakketOptieId, 0, ',', '.') . "</td>
        <td>" . htmlentities($value->Datum, ENT_QUOTES, 'ISO-8859-1') . "</td>
        <td>" . htmlentities($value->BeginTijd, ENT_QUOTES, 'ISO-8859-1') . "</td>
        <td>" . htmlentities($value->EindTijd, ENT_QUOTES, 'ISO-8859-1') . "</td>
        <td>" . htmlentities($value->AantalVolwassen, ENT_QUOTES, 'ISO-8859-1') . "</td>
        <td>" . htmlentities($value->AantalKinderen, ENT_QUOTES, 'ISO-8859-1') . "</td>
        <td>" . htmlentities($value->nummer, ENT_QUOTES, 'ISO-8859-1') . "</td>
        <td>" . htmlentities($value->Heefthek, ENT_QUOTES, 'ISO-8859-1') . "</td>

        <td><a href='". URLROOT . "/Reservation/update/$value->Reserveringsnummer'>Update</a></td>
        <td><a href='". URLROOT . "/Reservation/score/$value->ID'>Score</a></td>

    </tr>";
    }
  
  
  
    $data = [
      'title' => '<h1>Reseveringen</h1>',
      'Reservations' => $rows
      ];
  }
}
} else{
  $data = [
    'title' => '<h1>Reseveringen</h1>',
    'Reservations' => '<h1>Geen Reserveringen gevonden<h1>'
    ];

}

 //needs to be last otherwise data doesnt work
  $this->view('Reservation/index', $data);

}



  //
  //  Delete record function
  //
  public function delete($id){
    $this ->ReservationOrganizer->deleteScore($id);

    $data =[
      'deleteStatus' => "Het record met id  = $id is verwijderd<br>"
    ];

    $this-> view("Bowling/delete", $data);
    header("Refresh:3 url=" .URLROOT. "/Reservation/index");
  }

  //
  // Update record function
  // 
  public function update($id = null){    
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
      $this->ReservationOrganizer->updateReservation($_POST);
      $_SESSION["msg"] = 1;
      $continue = $_SESSION['continue'];
    //
    if ($continue == 1){
       header("Location: ". URLROOT."/Reservation/index ");
    }
    }else{
      $row = $this->ReservationOrganizer->getSingleReservation($id);
      $data = [
      'title' => '<h1>update Reservation</h1>',
      'row' => $row,
    ];
    $message = "<script type='text/javascript'>Wakka;</script>";
    $this->view("Reservation/update", $data, $message); 
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
    $data = ["title" => "voeg nieuwe reservering in"];
    $this-> view("Bowling/create", $data);
   
    }
  }

  public function Score($id = null){    

    $_POST['ID'] = $id;
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
    $_SESSION['Reservation'] = $id;

     header("Location: ". URLROOT."/score/index ");

  }




}

