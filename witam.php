<?php
session_start();

if(isset($_SESSION['udanarejestracja']))
{
    header('Location: index.php');
    exit();
}
else
{
    unset($_SESSION['udanarejestracja']);
}

//usuwanie zmiennych
if(isset($_SESSION['fr_nick'])) unset($_SESSION['fr_nick']);
if(isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
if(isset($_SESSION['fr_haslo1'])) unset($_SESSION['fr_haslo1']);
if(isset($_SESSION['fr_haslo2'])) unset($_SESSION['fr_haslo2']);

//usuwanie błędów rejestracji 
if(isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
if(isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
if(isset($_SESSION['e_haslo1'])) unset($_SESSION['e_haslo1']);
if(isset($_SESSION['e_haslo2'])) unset($_SESSION['e_haslo2']);




?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="witam.css">
</head>
<body>
    <br/><br/>Diękujemy za rejestracje możesz się zalogować na swoje konto <br/><br/>
    <a href="login.php">Zaloguj się na swoje konto i dodaj posta</a>
    <br/><br/>
</body>
</html>