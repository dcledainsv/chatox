<?php
	function connectBdd()
	{
		$dbn = 'mysql:dbname=chatox;host=127.0.0.1;charset=utf8';
		$user = 'Chatox';
		$pass = '4RZkr6UdK43na5L4';

		try
		{
			$bdd = new PDO($dbn, $user, $pass);
			// echo "Tu es connecté";
		}
		catch (PDOException $e)
		{
			echo "Connexion à la base de donnée échouée : " . $e->getMessage();
		}
		return $bdd;
	}
?>