<?php

	session_start();
	
	if (isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'] == true)
	{
		header('Location: indexlogged.php');
		exit();
	}

?>
<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/login.css">
</head>

<body>
  <div class="container">
    <form action="zaloguj.php" method="post">
      <h1>Zaloguj się</h1>
      <input type="text" name="nick" placeholder="Nick:">
      <br><br>
      <input type="password" name="password" placeholder="Password:">
      <br><br>
      <input type="submit" value="Zaloguj" name="login">
    </form>
    <?php
	    if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
    ?>
    <p>Nie masz jeszcze konta? <a href="rejestracja.php">Zarejestruj się</a></p>
  </div>
</body>

</html>
