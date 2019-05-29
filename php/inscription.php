<?php
	session_start();
	include('../request/pdo.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<title>Inscription</title>
	</head>

	<body>
		<div class="container col-10 col-sm-10 col-md-6 col-lg-4" id="form-connect">

			<h2>Inscription</h2>

			<form method="POST" action="" id="form-register">
				<div class="form-group">
					<label for="pseudo">Pseudo :</label>
					<input type="text" class="form-control" id="pseudo" name="new-pseudo" placeholder="Entre ton pseudo">
				</div>
				
				<div class="form-group">
					<label for="new-password">Mot de passe :</label>
					<input type="password" class="form-control" id="new-password-r" name="new-password" placeholder="Entre ton mot de passe">
				</div>
				
				<div class="form-group">
					<label for="new-password-r">Confirmer le mot de passe :</label>
					<input type="password" class="form-control" id="new-password-r" name="new-password-r" placeholder="Répète ton mot de passe">
				</div>

				<input type="submit" class="btn btn-primary" name="subm-addAccount" value="Créer le compte">
			</form>

			<div>
				<small>Ou <a href="../index.php">retour à la page de connexion</a></small>
			</div>

			<div class="text-danger text-center" id="message-alert"><p><?php createAccount(); ?></p></div>
		</div>
	</body>
</html>

<?php
	function createAccount()
	{
		$bdd = connectBdd();

		if(isset($_POST['subm-addAccount']))
		{
			if(!empty($_POST['new-pseudo']) && !empty($_POST['new-password']) && !empty($_POST['new-password-r']))
			{
				if($_POST['new-password'] === $_POST['new-password-r'])
				{
					$accountExist = $bdd->prepare('SELECT pseudo FROM users WHERE (pseudo = ?)');
					$accountExist->execute(array($_POST['new-pseudo']));
					$pseudoExist = $accountExist->rowCount();

					if($pseudoExist == 0)
					{
						$addAccount = $bdd->prepare('INSERT INTO users(pseudo, motDePasse) VALUES (:pseudo, :motDePasse)');
						$addAccount->execute(array(
							"pseudo" => htmlspecialchars($_POST['new-pseudo']),
							"motDePasse" => sha1($_POST['new-password'])
						));

						echo "Le compte a bien été créé !";
					}
					else
					{
						echo "Ce pseudo est déjà utilisé !";
					}
				}
				else
				{
					echo "Les mots de passent ne correspondent pas !";
				}
			}
			else
			{
				echo "Veuillez entrer tous les champs !";
			}
		}
	}
?>