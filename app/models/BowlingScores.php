<?php
class BowlingScores {
    private $db;

    public function __construct() {
      $this->db = new Database();
      //echo("modal Bowling conected<hr>");
    }
    
    
    public function getScores($PermID, $userID) {
        //Employee call for all Scores
        if($PermID == 2){
            $this->db->query("SELECT spareSoftwareSystem.UserID, spareSoftwareSystem.ReservationID, SpareSoftwareSystem.ID, SpareSoftwareSystem.Score, SpareSoftwareSystem.Score_Name, SpareSoftwareSystem.DATE, Reservation.Alley
            FROM SpareSoftwareSystem
            right JOIN Reservation ON SpareSoftwareSystem.ReservationID=Reservation.ID;");
      
            $result = $this->db->resultSet();
        } //Client calls for their Scores
        else if ($PermID == 1) {
        $this->db->query("SELECT spareSoftwareSystem.UserID, spareSoftwareSystem.ReservationID, SpareSoftwareSystem.ID, SpareSoftwareSystem.Score, SpareSoftwareSystem.Score_Name, SpareSoftwareSystem.DATE, Reservation.Alley
        FROM SpareSoftwareSystem
        right JOIN Reservation ON SpareSoftwareSystem.ReservationID=Reservation.ID WHERE SpareSoftwareSystem.UserID = $userID;");

        $result = $this->db->resultSet();
    } else {
            echo("<h1>something went wrong<h1>");
            
        }
      try{
        return $result;
      } catch(Exception $e){
        echo("couldnt find result");
      }
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

?>