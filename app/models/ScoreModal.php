<?php
    class ScoreModal {
        private $db;

    public function __construct() {
      $this->db = new Database();
      //echo("modal Bowling conected<hr>");
    }
    
    
    public function getScores($PermID, $Reservering) {
 //Client calls for their Reservation
            try {
               
                $this->db->query("SELECT uitslag.ID, uitslag.SpelId, Reservering.Datum, spel.ReseveringID, Persoon.ID, Persoon.Voornaam, Persoon.Tussenvoegsel, Persoon.Achternaam, uitslag.Aantalpunten
                FROM uitslag
                right JOIN spel ON spel.ID = uitslag.ID
                right JOIN Reservering ON Reservering.ID = spel.ReseveringID
                right JOIN Persoon ON spel.PersoonId = Persoon.ID WHERE spel.ReseveringID= $Reservering order by Aantalpunten DESC;");
        
                $result = $this->db->resultSet();

  

            }
            catch (exception $e) {
                echo("<h1>something went wrong when calling for reservation<h1>");
                echo($e);
            }  // catch ($this-> db -> connect_errno) 

       
        
        
        //Ending of function

        return $result;
    
    }


    


    


    
 
}

?>