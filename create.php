<?php
include 'dbconnect.php';//dbconnection
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$date = $_POST['date'];
$invoice_no = $_POST['invoice'];
$code = $_POST['code'];
$description = $_POST['description'];
$qty = $_POST['qty'];
$price = $_POST['price'];
$create_time=time();
}



$sql = "INSERT INTO purchase (invoice_no,date_time,code,description,qty,price,create_time) VALUES (:a,
			:b,:c,:d,:e,:f,:g)";

	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':a',$invoice_no);
	$stmt->bindParam(':b',$date);
    $stmt->bindParam(':c',$code);
	$stmt->bindParam(':d',$description);
    $stmt->bindParam(':e',$qty);
	$stmt->bindParam(':f',$price);
    $stmt->bindParam(':g',$create_time);
	
	$stmt->execute();
	
	if($stmt->rowCount()){
		echo("Add Successfully!");
	}else{
		echo ("Error");
	}



?>