<?php
	session_start();
	include('../request/pdo.php');
	$bdd = connectBdd();
	
	$reqUser = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
	$reqUser->execute(array($_SESSION['pseudo']));
	$userInfo = $reqUser->fetch();

	if(!isset($_SESSION['pseudo']))
	{
		header("Location: ../request/signout.php");
	}
	else
	{
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<title>Messagerie</title>
	</head>

	<body>
		<nav id="navig" class="container-fluid col-12">
			<div class="container-fluid col-10 col-sm-10 col-md-8 col-lg-6">
				<p><?php echo $_SESSION['pseudo']; ?></p>
				<a href="../request/signout.php">Déconnexion</a>
			</div>
		</nav>

		<div id="control-message" class="container-fluid col-10 col-sm-10 col-md-8 col-lg-6">
			<div id="chat-name">
				<h2>Chatox</h2>
			</div>

			<div id="messagerie" class="form-control">
				<!-- Nouveaux message -->
				<?php
					showMessage();
				?>
			</div>

			<div id="type-message" >
				<form method="POST" action="">
					<div class="form-group d-flex justify-content-between">
						<textarea class="" name="message" placeholder="Saisir un message..."></textarea>
						<input type="submit" id="sendMessage" class="btn btn-dark" name="subm-sendMessage" value="Envoyer">
					</div>
				</form>
					<?php sendMessage(); ?>
			</div>
		</div>

		<script type="text/javascript" src="../js/script.js"></script>
	</body>
</html>
<?php
	}

	function showMessage()
	{
		$bdd = connectBdd();

		$reqShowMessage = $bdd->query('SELECT * FROM messagerie LIMIT 50');
		$reqShowMessage->execute();

		while($data = $reqShowMessage->fetch())
		{
			echo '<div>';

			if($data['users_ID'] !== $_SESSION['id'])
			{
				echo '<div class="msgShow hisMsg"><p>' . $data['message'] . '</p>';
				echo '<span class="msgInfo">' . '===hisPseudo===' . ' ' . $data['date_message'] . '</span></div>';
			}
			else
			{
				echo '<div class="msgShow"><p>' . $data['message'] . '</p>';
				echo '<span class="msgInfo">' . $_SESSION['pseudo'] . ' ' . $data['date_message'] . '</span></div>';
			}

			echo '</div>';
		}
	}

	function sendMessage()
	{
		$bdd = connectBdd();

		if(isset($_POST['subm-sendMessage']))
		{
			if(!empty($_POST['message']))
			{
				$req = $bdd->prepare('INSERT INTO messagerie(users_ID, message, date_message) VALUES (:users_ID, :message, :date_message)');
				$req->execute(array(
					"users_ID" => $_SESSION['id'],
					"message" => htmlspecialchars($_POST['message']),
					"date_message" => strftime('%Y-%m-%d %H:%M:%S')
				));
				
				header("Location: ../php/messagerie.php");
			}
		}
	}
?>
