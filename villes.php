<?php
  require 'database.php';

  if (!empty($_GET['id'])) 
  {
    $id = checkInput($_GET['id']);
  }



  function checkInput($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Table des habitants de l'Afrique</h2>
<form class="form-group" method="POST" action="<?php echo 'update.php?id='.$id;?>">
    <input class="form-control" name="superficie" placeholder="Entrez une Taille en km2">
    <div class="row">
        <div class="col-md-6">
            <select class="form-control" name="id">

                
              <?php 
              $db = Database::connect();
              $statement = $db->prepare('SELECT villes.id, villes.nom, villes.superficie, pays.nom as pays, pays.id_continent FROM villes JOIN pays ON villes.id_pays = pays.id JOIN continents ON pays.id_continent = continents.id WHERE continents.id = ?'); 
            $statement->execute(array($id));

            
              while ($row = $statement->fetch())
              {
                    
                echo '<option value="'. $row['id'] .'">'. $row['nom'] . '</option>';
              }
              Database::disconnect();
            ?>
                
                
            </select>
        </div>
        <div class="col-md-6"> 
                <button type="submit" class="btn btn-primary">Modifier la superficie</button>

        </div>
      
        
    </div>
  </form>
  <table class="table">
    <thead>
      <tr>
        <th>nom</th>
        <th>superficie</th>
        <th>Pays</th>
      </tr>
    </thead>
    <tbody>
      <?php
            $db = Database::connect();
            $statement = $db->prepare('SELECT villes.id, villes.nom, villes.superficie, pays.nom as pays, pays.id_continent FROM villes JOIN pays ON villes.id_pays = pays.id JOIN continents ON pays.id_continent = continents.id WHERE continents.id = ?');

            
            $statement->execute(array($id));
            
            

            while ($item = $statement->fetch()) 
            {
              echo'<tr>';
                echo '<td>' . $item['nom'] . '</td>';
                echo '<td>' . $item['superficie'] . '</td>';
                echo '<td>' . $item['pays'] . '</td>';
               
              echo '</tr>';
            
            }

            Database::disconnect();
      ?>
      
      
      
      </tr>
    </tbody>
  </table>
</div>

</body>
</html>
