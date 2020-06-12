<?php
include("Database.php");

if(isset($_POST['Import'])) {
    $filename=$_FILES["file"]["tmp_name"];
     if ($_FILES["file"]["size"] > 0) {
        $file = fopen($filename, 'r');
        $tab = array();
        $num_ligne =0;
        $pdo = new Database();        
        $sql = $pdo->prepare("INSERT into appels (compte_facture,num_facture,num_abonne,date_time, duree, volume_reelle, volume_facturee, type_data)values (?,?,?,?,?,?,?,?)");
        while (($row = fgetcsv($file, 1000, ",") )) {
            $num = count($row);
            if( $num_ligne > 2){
                for($c=0; $c<$num; $c++) {
                    $data = explode(";", $row[$c]);
                    // On remplace les slash par des tirets afin de s'accorder au format anglais de mysql
                    $date_replace_slash = str_replace("/", "-", $data[3] );
                    $str = strtotime($date_replace_slash.' '.$data[4]);
                    // On transforme la date et l'heure en Datetime 
                    $date = date('Y-m-d H:i:s', $str);
                    $duree_appel = 0;
                    // On vérifie si  la data contient un format heure 
                    if(strpos($data[5], ':')){
                        // Transforme en timestamp unix afin de facilité l'enregistrement en base de donnée
                        $duree_appel = strtotime(".$data[5].");
                        echo $duree_appel;
                    }
                     
                    $sql->execute([$data[0], $data[1], $data[2], $date, $duree_appel, $data[5], $data[6], $data[7]]);
                    header("Location: index.php");
                }
            }
            $num_ligne++;
        }
    }
}
?>