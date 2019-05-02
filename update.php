
<?php  
	require 'database.php';

	if(!empty($_GET['id'])) 
    {
        $id = checkInput($_GET['id']);
    }

	$superficieError = $superficie = "";

	if(!empty($_POST))
	{
		$superficie 	= checkInput($_POST['superficie']);
		
		
		$isSuccess 		= true;
		
		if (empty($superficie)) 
		{
			$superficieError ="Ce champ ne peut pas être vide";
			$isSuccess = false;
		}
		
		$db = Database::connect();
			$statement = $db->prepare("UPDATE villes SET superficie = ?
					WHERE id = ?");
				$statement->execute(array($superficie,$id));
			

		Database::disconnect();
			header("Location: villes.php?id=".$id);
	}

	function checkInput($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>