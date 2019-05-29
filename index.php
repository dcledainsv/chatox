<?php
	session_start();
	include('request/pdo.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<title>Connexion</title>
	</head>

	<body class="container col-10 col-sm-10 col-md-6 col-lg-4">
		<h2>Connexion</h2>

		<form method="POST" action="">
			<div class="form-group">
				<label for="pseudo">Pseudo :</label>
				<input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Entre ton pseudo">
			</div>
			
			<div class="form-group">
				<label for="password">Mot de passe</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Entre ton mot de passe">
			</div>

			<input type="submit" class="btn btn-primary" name= "subm-connetAccount" value="Connexion">
		</form>

		<div>
			<small>Ou <a href="php/inscription.php">créer un compte</a></small>
		</div>

		<div class="text-danger text-center" id="message-alert"><p><?php connectAccount(); ?></p></div>
	</body>
</html>

<?php
	function connectAccount()
	{
		$bdd = connectBdd();

		if(isset($_POST['subm-connetAccount']))
		{
			if(!empty($_POST['pseudo']) && !empty($_POST['password']))
			{
				$reqLogin = $bdd->prepare('SELECT * FROM users WHERE pseudo = ? AND motDePasse = ?');
				$reqLogin->execute(array(
					htmlspecialchars($_POST['pseudo']),
					sha1($_POST['password'])
				));

				$userExist = $reqLogin->rowCount();
				if($userExist == 1)
				{
					$reqInfo = $reqLogin->fetch();
					$_SESSION['id'] = $reqInfo['users_ID'];
					$_SESSION['pseudo'] = $reqInfo['pseudo'];
					$_SESSION['password'] = $reqInfo['motDePasse'];

					echo "Connecté !";
					header("Location: php/messagerie.php");
				}
				else
				{
					echo "Identifiant incorrect !";
				}
			}
			else
			{
				echo "Veuillez entrer tous les champs !";
			}
		}
	}
?>