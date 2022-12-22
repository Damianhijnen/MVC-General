<main>
<?php echo $data["title"]; ?>
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

<a href="<?=URLROOT?>/countries/create">Nieuw record</a>


<table>
  <thead>
    <th>id</th>
    <th>Land</th>
    <th>hoofdstad</th>
    <th>continent</th><!-- oi hoe gaat ie schat-->
    <th>aantalinwoners</th>
    <th>Update</th>
    <th>Delete</th>
  </thead>
  <tbody><!-- called from controllers -->
    <?=$data['countries']?>
  </tbody>
</table>
<a href="<?=URLROOT;?>/homepages/index">terug</a>
</main>
