<?php

class Database extends PDO {

    public function __construct() {
       try {
         parent::__construct("mysql:host=localhost;port=3306;dbname=csv", "root", "");
       } catch (PDOException $e) {
           //return $e->getMessage();
           echo '<div class="alert alert-danger" role="alert">
           Connexion à la base de donnée échoué : ' .$e->getMessage();
         '</div>';       

       }
    }

    public function getDureeTotalAppel() {
      $sql = "SELECT SUM(duree) as totalDuree FROM appels WHERE duree != 0 and date_time >= '2012-02-15'";
      $data = $this->query($sql)->fetch();
      return $data;
    } 

    public function getTopTenDataFacturee(){
      $sql = "select num_abonne,volume_facturee from appels where HOUR(date_time) NOT BETWEEN 8 and 18 group by num_abonne order by volume_reelle DESC LIMIT 10";
      $data = $this->query($sql)->fetchAll();
      return $data;
    }

    public function getTotalSmsEnvoye(){
      $sql = "select COUNT(*) as total from appels where type_data LIKE '%envoi de sms%'";
      $data = $this->query($sql)->fetch();
      return $data;
    }
}

?>