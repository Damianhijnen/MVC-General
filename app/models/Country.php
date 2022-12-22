<?php
  class Country {
    private $db;

    public function __construct() {
      $this->db = new Database();
    }

    public function getCountries() {
      $this->db->query("SELECT * FROM `country`;");

      $result = $this->db->resultSet();

      return $result;
    }
  

    public function getSingleCountry($id){
      $this->db->query("SELECT * from country where id = :id");
      $this->db->bind(':id', $id, PDO::PARAM_INT);
      //returnes the array of countries to update in countries.php
      return $this->db->single();
    }

    public function updateCountry($post){
      $this->db->query("UPDATE country 
                            set name = :name, 
                            capitalCity = :capitalCity,
                            continent = :continent,
                            population = :population 
                            where id = :id");
                           
                           $this->db->bind(':id', $post["id"], PDO::PARAM_INT);
                           $this->db->bind(':name', $post["name"], PDO::PARAM_STR);
                           $this->db->bind(':capitalCity', $post["capitalCity"], PDO::PARAM_STR);
                           $this->db->bind(':continent', $post["continent"], PDO::PARAM_STR);
                           $this->db->bind(':population', $post["population"], PDO::PARAM_INT);

      $oi = $this->db;

            var_dump($oi);

                           return $this->db->execute();
    
    }


  public function deleteCountry($id) {
      $this->db->query("DELETE FROM country WHERE id = :id");
      $this->db->bind("id", $id, PDO::PARAM_INT);
      return $this->db->execute();
  }

  public function createCountry($post){
    //Here is every value listed that needs to be inserted
    $this->db->query("INSERT INTO country(id, name, capitalCity, continent, population) VALUES(:id, :name, :capitalCity, :continent, :population)");
  
      //the values from the post are binded to :variables from the post
      $this->db->bind(':id', NULL, PDO::PARAM_INT);
      $this->db->bind(':name', $post["name"], PDO::PARAM_STR);
      $this->db->bind(':capitalCity', $post["capitalCity"], PDO::PARAM_STR);
      $this->db->bind(':continent', $post["continent"], PDO::PARAM_STR);
      $this->db->bind(':population', $post["population"], PDO::PARAM_INT);

      $oi=$this->db;

      var_dump($oi);

      return $this->db->execute();
     
  }
}

?>
