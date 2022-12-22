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
  <h1>Scores Overview</h1>

<?php


if (isset($_SESSION["msg"])){$message=$_SESSION["msg"];
    if ($message==1){
        echo "<script type='text/javascript'>alert('Hij is correct Geupdated');</script>";
        unset($_SESSION["msg"]);
    }
}


if ($_SESSION['PermisionID'] == 1) {
    echo('Welkom Klant');

   ?><table>
  <thead>
    <th>Reservation ID</th>
    <th>Naam</th>
    <th>Score</th>
    <th>Datum</th><!-- oi hoe gaat ie schat-->
    <th>Baan</th>

  </thead>
  <tbody><!-- called from controllers -->
    <?=$data['scores']?>
  </tbody> <?php

    
}












if ($_SESSION['PermisionID'] == 2) {
    echo('Welkom Werknemer');
     ?>

    <a href="<?=URLROOT?>/Bowling/create">Nieuw record</a>


    <table>
        <thead>
            <th>User ID</th>
            <th>Rervation ID</th>
            <th>Naam</th>
            <th>Score</th>
            <th>Datum</th>
            <th>Baan</th>
            <th>Update</th>
            <th>Delete</th>
        </thead>
        <tbody><!-- called from controllers -->
            <?=$data['scores']?>
        </tbody>
        </table>
            <a href="<?=URLROOT;?>/homepages/index">terug</a>
        </main>

    
    <?
    }

    

?>


</body>