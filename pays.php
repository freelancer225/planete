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
  <h2>Table des villes de l'Afrique</h2>
<form class="form-group">
    <input class="from-control" name="ville1" placeholder="Entrez un nom">
     <input class="from-control" name="ville1" placeholder="Entrez un nom">
      <input class="from-control" name="ville1" placeholder="Entrez un nom">
      <button class="btn btn-primary">Ajouter 3 villes</button>
      
  </form>
  <table class="table">
    <thead>
      <tr>
        <th>nom</th>
        <th>superficie</th>
        <th>Nombres de villes</th>
      </tr>
    </thead>
    <tbody>
       <?php
            $db = Database::connect();
            $statement = $db->prepare('SELECT COALESCE(COUNT(villes.id),0) as ville, pays.nom, pays.superficie, pays.id_continent FROM villes RIGHT JOIN pays ON villes.id_pays = pays.id JOIN continents ON pays.id_continent = continents.id WHERE continents.id = ? GROUP BY pays.id');

            
            $statement->execute(array($id));

            while ($item = $statement->fetch()) 
            {
              echo'<tr>';
                echo '<td>' . $item['nom'] . '</td>';
                echo '<td>' . $item['superficie'] . '</td>';
                echo '<td>' . $item['ville'] . '</td>';
               
              echo '</tr>';
            
            }

            Database::disconnect();
          ?>
      
      
      
    </tbody>
  </table>
</div>

</body>
</html>
