<?php
class Score extends Controller {

  public function __construct() {
    $this->ScoreModal = $this->model('ScoreModal');
    /**echo(var_dump($_POST));*/

  }

public function index() {
  $data = [
    'title' => "Scores"
  ];




  $reservering = $_SESSION['Reservation'];
  $PermID = $_SESSION['PermisionID'];
  $userID = $_SESSION['ID'];


  $scores = $this->ScoreModal->getScores($PermID, $reservering);

  //
  //   The Call up data for customer
  // 

  
    $rows = '';
    if(isset($scores[0])){
      foreach ($scores as $value){   
        $rows .= "<tr>
                        <td>$value->ID</td>
                        <td>" . htmlentities($value->SpelId, ENT_QUOTES, 'ISO-8859-1') . "</td>
                        <td>" . htmlentities($value->Voornaam, ENT_QUOTES, 'ISO-8859-1') . "</td>
                        <td>" . htmlentities($value->Tussenvoegsel, ENT_QUOTES, 'ISO-8859-1') . "</td>
                        <td>" . htmlentities($value->Achternaam, ENT_QUOTES, 'ISO-8859-1') . "</td>
                        <td>" . htmlentities($value->Aantalpunten, ENT_QUOTES, 'ISO-8859-1') . "</td>

    </tr>";
    
    }
    if(isset($value->ID)){ 
      $scoreID = $value->ID;
    }
    if(isset($value->Datum)){ 
      $scoreDate = $value->Datum;
 
    }

    $data = [
      'title' => '<h1>Reseveringen</h1>',
      'Scores' => $rows,
      'Date' => $scoreDate
    ];
    } else{
     // echo("<H1>Geen Scores gevonden</H1>");
      $data = [
        'title' => '<h1>Reseveringen</h1>',
        'Scores' => '<H2>Geen Scores gevonden</H2>'
      ];
    }
  
  

  

 //needs to be last otherwise data doesnt work
  $this->view('Score/index', $data);

}

  
  




}

