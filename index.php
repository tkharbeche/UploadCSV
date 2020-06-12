<?php
include('Database.php');
$pdo = new Database();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Test Import CSV</title>
</head>
<body>
    <div id="wrap">
        <div class="container">
            <div class="row">
                <form class="form-horizontal" action="upload.php" method="post" name="upload_excel" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Select File</label>
                            <div class="col-md-4">
                                <input type="file" name="file" id="file" class="input-large">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md- control-label">Import data</label>
                            <div class="col-md-4">
                                <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <?php
            ?>
        </div>
        <div class="container">
            <div class="row">
                <h3>Durée total des appels</h3>
            </div>    
            <div class="row">    
                <?php
                    $data = $pdo->getDureeTotalAppel();
                    if($data) {
                        echo "Durée totale réelle des appels téléphonique après le 15/02/2012 : ".date('H:m:i',$data['totalDuree']);
                    } else {
                        echo "Aucun appel n'a été effectué après le 15/02/2012";
                    }
                ?>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <h3>Top 10 des data facturé</h3>
            </div>
            <div class="row">    
                <?php
                    $data = $pdo->getTopTenDataFacturee();
                    if($data) {
                        echo "<div class='table-responsive'><table class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>N° abonné</th>
                                <th>volume facturé</th>
                            <tr>
                        <thead>
                        <tbody>";

                        foreach($data as $row){
                            echo "<tr>
                                    <td>".$row['num_abonne']."</td>
                                    <td>".$row['volume_facturee']."</td>";

                        }
                        echo "</tbody></table></div>";

                    } else {
                        echo "Aucune données";
                    }
                    

                    
                ?>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <h3>Total de SMS envoyé par les abonnés</h3>
            </div>
            <div class="row">
                <?php
                    $data = $pdo->getTotalSmsEnvoye();
                    if($data) {
                        echo "Total de SMS envoyé par les abonnés est de ".$data['total'];

                    } else {
                        echo "Aucune SMS envoyé";
                    }
                    

                    
                ?>
            </div>
                       
        </div>
    </div>
</body>

</html>