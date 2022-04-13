<?php 

try {
	$pdo = new PDO("mysql:host=localhost; dbname=auth_register", "root", "");
}
catch(PDOException $e){
	echo "Ошибка подключения к базе данных" . $e.getMessage();
}

 ?>