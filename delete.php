<?php
    require 'database.php';
 
    if(!empty($_GET['id'])) 
    {
        $id = checkInput($_GET['id']);
    }

    if(!empty($_POST)) 
    {
        $id = checkInput($_POST['id']);
        $db = Database::connect();
        $statement = $db->prepare("DELETE FROM habitants WHERE id = ?");
        $statement->execute(array($id));
        Database::disconnect();
        header("Location:continents.php");
        
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
<html>
<head>
	<title></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	
</head>
<body>
	
	<div class="container admin">
		<div class="row">
			
			<h1><strong>Supprimer un habitant</strong></h1><br>
			<form class="form" action="delete.php" method="post" role="form" style = "font-family: 'montserrat'; ">
			<input type="hidden" name="id" value="<?php echo $id;?>"/>
			<p class="alert alert-warning"> Etes vous sur de vouloir supprimer?</p>
			<div class="form-actions">
				<button type="submit" class="btn btn-warning"> Oui</button>
				<a href="index.php" class="btn btn-default">Non</a>
			</div>
			</form>
			
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>
