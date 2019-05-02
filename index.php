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
  <h2>Table des continents</h2>      
  <table class="table">
    <thead>
      <tr>
        <th>nom</th>
        <th>superficie</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
       <?php
            require 'database.php';
            $db = Database::connect();

            $statement = $db->query('SELECT * 
              FROM continents');

            while ($continent = $statement->fetch()) 
            {
              echo'<tr>';
                echo '<td>' . $continent['nom'] . '</td>';
                echo '<td>' . $continent['superficie'] . '</td>';
                echo '<td width="300">';
                echo '<a href="pays.php?id=' . $continent['id'] . '" class="btn btn-primary">Voir pays</a>';
                echo ' ';
                echo '<a href="villes.php?id=' . $continent['id'] . '" class="btn btn-success"> Voir villes</a>';
                echo ' ';
                echo '<a href="habitants.php?id=' . $continent['id'] . '" class="btn btn-danger"> Voir habitants</a>';
                
                echo '</td>';
              echo '</tr>';
            
            }

            Database::disconnect();
          ?>
    </tbody>
  </table>
</div>

</body>
</html>
