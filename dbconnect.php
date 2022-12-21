<?php 

	$servername = "localhost";
	$dbname = "pos_list";
	$dbuser = "root"; //default value
	$dbpassword = "";

	$dsn = "mysql:host=$servername;dbname=$dbname";
	$pdo = new PDO($dsn,$dbuser,$dbpassword);
	try{

		$conn = $pdo;
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		// echo "Connected Successful";

	}catch(PDOException $e)
	{
		echo "Connection Fail:".$e->getMessage();
	}



?>