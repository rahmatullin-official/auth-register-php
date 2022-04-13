<?php 
session_start();
include "database.php";

// check user email function
function check_email($email, $pdo){
	$sql = "SELECT * FROM users";
	$sql = $pdo->prepare($sql);
	$sql->execute();
	$result = $sql->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($result as $res){
		if($res['email'] == $email){
			$_SESSION['login'] = "false";
			header("Location: /index.php");
			die();
		}
	}
}


// login function
if (isset($_POST['login'])) {
	
	$sql = "SELECT * FROM users";
	$sql = $pdo->prepare($sql);
	$sql->execute();
	$result = $sql->fetchAll(PDO::FETCH_ASSOC);

	foreach ($result as $res) {
		if (password_verify($res['password'], PASSWORD_DEFAULT) == $_POST['password'] && $res['email'] == $_POST['email']) {
			if ($_POST['remember'] == "1"){ // to-do -> add cookies

				$_SESSION['email'] = $_POST['email'];
				$_SESSION['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT); 
			
			}
			else if (isset($_SESSION['email']) ?? isset($_SESSION['password'])){
			
				unset($_SESSION['email']);
				unset($_SESSION['password']);
			
			}
			
			$_SESSION['login'] = "true";
			header("Location: /index.php");
			die();
		}
	}
	$_SESSION['login'] = "not";
	header("Location: /index.php");
}

// register function 
if (isset($_POST['register'])) {

	check_email($_POST['email'], $pdo);

	$sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
	$sql = $pdo->prepare($sql);
	$sql->execute([
		"email" => $_POST['email'],
		"password" => password_hash($_POST['password'], PASSWORD_DEFAULT),
	]);

	if ($sql) {
		$_SESSION['register'] = "true";
	 	header("Location: /index.php");
	 } 
}
 
?>