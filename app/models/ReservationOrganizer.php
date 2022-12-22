<?php
class ReservationOrganizer {
    private $db;

    public function __construct() {
      $this->db = new Database();
      //echo("modal Bowling conected<hr>");
    }
    
    
    public function getReservations($PermID, $userID) {
        //Employee call for all Scores
        if($PermID == 2){
            try {
               
                $this->db->query("SELECT Reservering.ID, Reservering.persoonID, Reservering.OpeningstijdId, Reservering.TariefID, Reservering.BaanId, Reservering.PakketOptieId, Reservering.ReserveringStatusId,
                Reservering.Reserveringsnummer,  Reservering.Datum,  Reservering.AantalUren,  Reservering.BeginTijd, Reservering.EindTijd, Reservering.AantalVolwassen, Reservering.AantalKinderen,
                Baan.nummer, Baan.Heefthek
                FROM Reservering
                right JOIN Baan ON Reservering.BaanId = Baan.ID where Reservering.ID > 0;");
        
                $result = $this->db->resultSet();

            }
            catch (exception $e) {
                echo("<h1>something went wrong when calling for reservation<h1>");
                echo($e);
            } 

      } //Client calls for their Reservation
        else if ($PermID == 1) {
            try {
               
                $this->db->query("SELECT Reservering.ID, Reservering.persoonID, Reservering.OpeningstijdId, Reservering.TariefID, Reservering.BaanId, Reservering.PakketOptieId, Reservering.ReserveringStatusId,
                Reservering.Reserveringsnummer,  Reservering.Datum,  Reservering.AantalUren,  Reservering.BeginTijd, Reservering.EindTijd, Reservering.AantalVolwassen, Reservering.AantalKinderen,
                Baan.nummer, Baan.Heefthek
                FROM Reservering
                right JOIN Baan ON Reservering.BaanId = Baan.ID  WHERE Reservering.persoonId= $userID;");
        
                $result = $this->db->resultSet();

            }
            catch (exception $e) {
                echo("<h1>something went wrong when calling for reservation<h1>");
                echo($e);
            }  // catch ($this-> db -> connect_errno) 

        } 
        else {
            echo("<h1>something went wrong when finding user ID<h1>");
        }
        
        
        //Ending of function
        return $result;
    
    }

      public function deleteScore($id) {
        $this->db->query("DELETE FROM SpareSoftwareSystem WHERE id = :id");
        $this->db->bind("id", $id, PDO::PARAM_INT);
        return $this->db->execute();
    }
    //
    // Returns Single Line from update via :ID
    //
    public function getSingleReservation($id){
        $this->db->query("SELECT Reservering.ID, Reservering.persoonID, Reservering.OpeningstijdId, Reservering.TariefID, Reservering.BaanId, Reservering.PakketOptieId, Reservering.ReserveringStatusId,
        Reservering.Reserveringsnummer,  Reservering.Datum,  Reservering.AantalUren,  Reservering.BeginTijd, Reservering.EindTijd, Reservering.AantalVolwassen, Reservering.AantalKinderen,
        Baan.nummer, Baan.Heefthek
        FROM Reservering
        right JOIN Baan ON Reservering.BaanId = Baan.ID  WHERE Reservering.Reserveringsnummer= :id;");
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->single();
      }
    


    
    public function updateReservation($post){
            $kids = intval($post["AantalKinderen"]);
            $adults = intval($post["AantalVolwassen"]);
            $baan = $post["nummer"];
            $Reservering = $post["Reserveringsnummer"];
            
            if(isset($kids)){
                $total = $kids + $adults;
            }
            ///////////////////////
            // Hekje finder    ///
            /////////////////////
            $hekje = 0;
            if($baan <= 6){
                $hekje = 0;
            }else{
                $hekje = 1;
            }


            ///////////////////////////////////////////////////////////////////////////
            /////// Checkes if minium adults is met                             //////
            ////// Als checks of there are not more people than the lane allows /////
            ////////////////////////////////////////////////////////////////////////
            if($total <= 10 && $adults <= 10){ 
            if($adults >= 1){
            

            /////////////////////////////////////////////////////
            //  Checker if the max and min allowed isnt overriden   ////
            ///////////////////////////////////////////////////
            if((isset($kids))){
                if($kids <= 4 && $kids >= 0){
                    if($adults <= 8){
                        if($baan <= 8 && $baan >= 1){
            //
            //    No kids on a fence lane
            //


                        if ($baan >= 7){
                            echo("baan 7 of hoger<br>");
                
                            if($kids <= 0){
                                echo("geen kinderen, kies een baan van nummer 6 of lager<br>");
                                header("Refresh:3 url=" .URLROOT. "/reservation/update/ " .$Reservering ." ");
                                $_SESSION['continue'] = 0;


                            } else { 
                                try{
                                $this->db->query("UPDATE reservering, Baan
                                set BaanId = :BaanId, 
                                AantalVolwassen = :AantalVolwassen,
                                AantalKinderen = :AantalKinderen
                                
                                
                                where Reserveringsnummer = :Reserveringsnummer;
                                

                                ");

                   
                            //the values from the post are binded to :variables from the post
           
                            $this->db->bind(':AantalKinderen', $post["AantalKinderen"], PDO::PARAM_STR);
                            $this->db->bind(':AantalVolwassen', $post["AantalVolwassen"], PDO::PARAM_STR);
                            $this->db->bind(':BaanId', $post["nummer"], PDO::PARAM_INT);
                            $this->db->bind(':Reserveringsnummer', $post["Reserveringsnummer"], PDO::PARAM_INT);
                           // $this->db->bind(':hekje', $hekje, PDO::PARAM_INT);


                            }catch(PDOException $e){
                                echo("<h1>OI</h1>");
                                echo($e);
                            } catch(Exception $e){
                                echo("<h1>Update Reservation doesnt work</h1>");
                                echo($e);
                            } 
                    
                            $_SESSION['continue'] = 1;
                    
                            return $this->db->execute();
                            $_SESSION["msg"] = 1;

                        }
                    }
              
            

            //
            //      Kids on a no fence lane
            //

            if ($baan <= 6){
                echo("baan 6 of lager<br>");
                
                if($kids > 0){
                    echo(" kinderen, kies een baan van nummer 7 of Hoger<br>");
                    header("Refresh:3 url=" .URLROOT. "/reservation/update/ " .$Reservering ." ");
                    $_SESSION['continue'] = 0;


                } else { 
                    try{
                    $this->db->query("UPDATE reservering 
                    set BaanId = :BaanId, 
                    AantalVolwassen = :AantalVolwassen,
                    AantalKinderen = :AantalKinderen
                    where Reserveringsnummer = :Reserveringsnummer");

                   
                   //the values from the post are binded to :variables from the post
           
                   $this->db->bind(':AantalKinderen', $post["AantalKinderen"], PDO::PARAM_STR);
                   $this->db->bind(':AantalVolwassen', $post["AantalVolwassen"], PDO::PARAM_STR);
                   $this->db->bind(':BaanId', $post["nummer"], PDO::PARAM_INT);
                   $this->db->bind(':Reserveringsnummer', $post["Reserveringsnummer"], PDO::PARAM_INT);


                    } catch(Exception $e){
                        echo("<h1>Update Reservation doesnt work</h1>");
                        echo($e);
                    } catch(PDOException $e){
                        echo("<h1>OI</h1>");
                        echo($e);
                    }
                $_SESSION['continue'] = 1;
                return $this->db->execute();
            
               

                }
            }
            //////////////////////////////////////////////////////////////////////////////
            ///  if the max allowed is overriden these are the message that follow   ////
            ////////////////////////////////////////////////////////////////////////////
            }   else{
                    echo("baan bestaat niet");
                    header("Refresh:3 url=" .URLROOT. "/reservation/update/ " .$Reservering ." ");

                }
            }
                else{
                    echo("Te veel volwassenen kunnen er niet meer dan 8 zijn");
                    header("Refresh:3 url=" .URLROOT. "/reservation/update/ " .$Reservering ." ");
                }
            }
                else {
                    echo("Te veel kinderen kunnen er niet meer dan vier zijn");
                    header("Refresh:3 url=" .URLROOT. "/reservation/update/ " .$Reservering ." ");

            } 
            } 
            
            
            }else {
                echo("Geen Volwassenen");
                header("Refresh:3 url=" .URLROOT. "/reservation/update/ " .$Reservering ." ");
            }
        } else{
            echo("Te veel mensen mogen er niet meer dan 10 zijn");
            header("Refresh:3 url=" .URLROOT. "/reservation/update/ " .$Reservering ." ");  
        }
                            
        
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
    
    
          return $this->db->execute();
         
      }
}

?>