<style>
  main {
    margin: 0 auto;
    width: 80%;
  }

  table{
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 80%;
  }

  th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #04AA6D;
    color: white;
  }

  td, th {
    border: 1px solid #ddd;
    padding: 8px;
  }

  tr:nth-child(even){background-color: #f2f2f2;}

  tr:hover {background-color: #ddd;}


</style>



<link rel="stylesheet" href="../style/Table.css">
<link rel="stylesheet" href="./style.css">





<body>
  <h1>    <? if(isset($data['Date'])){
    echo("Scores Cards Van: " . $data['Date']);
    }
    ?>
</h1>

<?php

if (isset($_SESSION["msg"])){$message=$_SESSION["msg"];
    if ($message==1){
        echo "<script type='text/javascript'>alert('Uw resevering is correct Gewijzigd');</script>";
        unset($_SESSION["msg"]);
    }
}



//////////////////////////////////////////
////                            /////////
///     Table for score         ////////
//                              ///////
//////////////////////////////////////



   ?><table>
  <thead>
            <th>user ID</th>
            <th>Game ID</th>
            <th>Voornaam</th><!-- oi hoe gaat ie schat-->
            <th>Tussen voegsel</th>
            <th>Achternaam</th>
            <th>Score</th>


            
  </thead>
  <tbody><!-- called from controllers -->
    <?=$data['Scores']?>
  </tbody> 

    


</body>