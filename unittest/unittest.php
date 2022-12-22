<?php

  use TDD\libraries\Database;

  class unittest {
    public function getScores($PermID, $userID) {
      //Employee call for all Scores
      if($PermID == 1){
          $this->db->query("SELECT spareSoftwareSystem.UserID, spareSoftwareSystem.ReservationID, SpareSoftwareSystem.ID, SpareSoftwareSystem.Score, SpareSoftwareSystem.Score_Name, SpareSoftwareSystem.DATE, Reservation.Alley
          FROM SpareSoftwareSystem
          right JOIN Reservation ON SpareSoftwareSystem.ReservationID=Reservation.ID;");
    
          $result = $this->db->resultSet();

      } //Client calls for their Scores
      else if ($PermID == 0) {
          var_dump($PermID);
      $this->db->query("SELECT spareSoftwareSystem.UserID, spareSoftwareSystem.ReservationID, SpareSoftwareSystem.ID, SpareSoftwareSystem.Score, SpareSoftwareSystem.Score_Name, SpareSoftwareSystem.DATE, Reservation.Alley
      FROM SpareSoftwareSystem
      right JOIN Reservation ON SpareSoftwareSystem.ReservationID=Reservation.ID WHERE SpareSoftwareSystem.UserID = $userID;");

      $result = $this->db->resultSet();
          var_dump($result);
  } else {
          echo("<h1>something went wrong<h1>");
      }
      return $result;
    }

    public function deleteScore($id) {
      $this->db->query("DELETE FROM SpareSoftwareSystem WHERE id = :id");
      $this->db->bind("id", $id, PDO::PARAM_INT);
      return $this->db->execute();
  }
  


  public function getSingleScore($id){
      $this->db->query("SELECT * from SpareSoftwareSystem where id = :id");
      $this->db->bind(':id', $id, PDO::PARAM_INT);
      //returnes the array of countries to update in countries.php
      return $this->db->single();
    }
  


  
  public function updateScore($post){
      $this->db->query("UPDATE SpareSoftwareSystem 
                            set Score_Name = :Score_Name, 
                            Score = :Score,
                            DATE = :DATE,
                            UserID = :UserID 
                            where id = :id");
                           
                           //the values from the post are binded to :variables from the post
                           $this->db->bind(':id', $post["id"], PDO::PARAM_INT);
                           $this->db->bind(':Score_Name', $post["Score_Name"], PDO::PARAM_STR);
                           $this->db->bind(':DATE', $post["DATE"], PDO::PARAM_STR);
                           $this->db->bind(':Score', $post["Score"], PDO::PARAM_INT);
                           $this->db->bind(':UserID', $post["UserID"], PDO::PARAM_INT);

      $oi = $this->db;

            var_dump($oi);

                           return $this->db->execute();
  }
  //
  //Function Create score
  //                                                                          Function make reservation id 1 when lower than 0 it wil not show up in the view
  public function createScore($post){
      //Here is every value listed that needs to be inserted
      $this->db->query("INSERT INTO SpareSoftwareSystem(id, Score_Name, DATE, Score, UserID, ReservationID) VALUES(:id, :Score_Name, :DATE, :Score, :UserID, :ReservationID)");
    
        //the values from the post are binded to :variables from the post
        $this->db->bind(':id', NULL, PDO::PARAM_INT);
        $this->db->bind(':Score_Name', $post["Score_Name"], PDO::PARAM_STR);
        $this->db->bind(':DATE', $post["DATE"], PDO::PARAM_STR);
        $this->db->bind(':Score', $post["Score"], PDO::PARAM_INT);
        $this->db->bind(':UserID', $post["UserID"], PDO::PARAM_INT);
        $this->db->bind(':ReservationID', 1, PDO::PARAM_INT);
        $oi=$this->db;
  
        var_dump($oi);
  
        return $this->db->execute();
       
    }
}
  // 
  //   The Call up data for customer
  // 
  if ($_SESSION['PermisionID'] == 0){
   
  
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
      'title' => '<h1>Landenoverzicht</h1>',
      'scores' => $rows
    ];
  }


  //
  //  The Call up data for employey
  // 
  if ($_SESSION['PermisionID'] == 1){
   
  
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




?>