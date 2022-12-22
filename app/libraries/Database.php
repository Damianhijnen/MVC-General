<?php
  class Database {
    
    private $dbHost = DB_HOST;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;
    private $dbName = DB_NAME;
    private $statement;
    private $dbHandler;
    private $error;

    public function __construct() {
      $conn = 'mysql:host=' . $this->dbHost . ";dbname=" . $this->dbName;
      $options = array(
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
      );

      try {
        $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
      } catch(PDOException $e) {
        $this->error = $e->getMessage();
        echo $this->error;
        echo("<h1>Error no DB connection</h1>");
      }
    }

    // Write queries
    public function query($sql) {
      try{
      $this->statement = $this->dbHandler->prepare($sql);
      }
      catch (Exception $e){
        echo("<h3>Syntax Error</h3>");
        echo("<h5>" . $e . "</h5>");
        

      }
    }

    public function bind($parameter, $value, $type=null) {
      switch (is_null($type)) {
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_bool($type):
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($type):
          $type = PDO::PARAM_NULL;
          break;
        default:
          $type = PDO::PARAM_STR;
      }
      try{
      $this->statement->bindValue($parameter, $value, $type);
      } catch (Exception $e){
        echo($e);
      }

    }

    public function execute() {
      try {
      return $this->statement->execute();
      } catch (PDOException $e){
        echo("<h1>something went wrong pdo</h1>");
      } catch (exception $e){
        echo("<h1>something went wrong in execute</h1>");
      }
    }

    // return array
    public function resultSet() {
      try {
      $this->execute();
    }catch (exception $e){
        echo(" something went wrong in execute");
      } catch ( PDOException $e){
        echo("something went wrong pdo");
      }

      return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function single() {
      $this->execute();
      return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function rowCount() {
      $this->statement->rowCount();
    }
  }
?>