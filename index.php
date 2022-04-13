<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Auth</title>
</head>
<body>
	<p><?php 
		if(isset($_SESSION['login']) ?? isset($_SESSION['register'])){
			if ($_SESSION['login'] == "false"){
				echo "На эту почту уже зарегистрирован аккаунт";
				unset($_SESSION['login']);
			}
			else if($_SESSION['login'] == "true"){
				echo "Вы успешно авторизировались!";
				unset($_SESSION['login']);
			}
			else if($_SESSION['login'] == "not"){
				echo "Таких пользовтелей нет в БД";
				unset($_SESSION['login']);
			}
			else if($_SESSION['register'] == "true"){
				echo "Вы успешно зарегистрировались!";
				unset($_SESSION['register']);
			}
		}
	
	?></p>
	<h1>Login into your account!</h1><br>
	<form action="foo.php" method="POST">
		<input type="email" placeholder="email" name="email"><br>
		<input type="password" placeholder="password" name="password"><br>
		Запомни меня<input type="checkbox" name="remember" value="1"><br>
		<button name="login">submit</button><br>
	</form>
	<a href="register.php">register</a>
</body>
</html>