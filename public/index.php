<link rel="stylesheet" href="./css/style.css">

<?php
  session_start();
  require_once '../app/require.php';
  
  
  ///////////////////////////////////////////
  //                        ******/////////
  //    Dag 1 test data       ***/////////
  //*******************************//////
  //  Permision ID           *****//////
  //    Klant = 1           *****//////
  //    Werknemer = 2     ******//////
  //   ID / User ID       *****//////
  //      3               *****/////
  //      6               *****////
  //**************************////
  //test data    er is test data voor user 3 en 6
    
  //  $_SESSION["ID"] = 3;
  //  $_SESSION["PermisionID"] = 2;


 // Test data 1 - 5 voor Reservation
   $_SESSION["ID"] = 1;
   $_SESSION["PermisionID"] = 1;

//********************** */
// Used for development 
// var_dump($_SESSION);
//  session_destroy();

?>

