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

  <table class="table">
    <thead>
      <tr>
        <th>nom</th>
        <th>prenom</th>
        <th>quartier</th>
        <th>solde</th>
        <th>numéro</th>
        <td>action</td>
      </tr>
    </thead>
    <tbody>
      <?php
            $db = Database::connect();
            $statement = $db->prepare('SELECT habitants.id, habitants.nom,habitants.prenom,habitants.solde,habitants.numero, quartiers.nom AS quartier FROM habitants INNER JOIN quartiers ON habitants.id_quartier = quartiers.id JOIN communes ON quartiers.id_commune = communes.id JOIN villes ON communes.id_ville = villes.id JOIN pays ON villes.id_pays = pays.id JOIN continents ON pays.id_continent = continents.id  WHERE continents.id = ?');

            
            $statement->execute(array($id));
            
            Database::disconnect();

            while ($item = $statement->fetch()) 
            {
              echo'<tr>';
                echo '<td>' . $item['nom'] . '</td>';
                echo '<td>' . $item['prenom'] . '</td>';
                echo '<td>' . $item['quartier'] . '</td>';
                echo '<td>' . $item['solde'] . '</td>';
                echo '<td>' . $item['numero'] . '</td>';
                echo '<td><a href="delete.php?id=' .$item['id'].'"> <button class="btn btn-danger">Supprimer</button></a></td>';
               
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

