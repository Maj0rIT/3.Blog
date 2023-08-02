<?php

session_start();

if (!isset($_POST['nick']) || !isset($_POST['password'])) {
    header('Location: login.php');
    exit();
}

require_once "connect.php";

$login = $_POST['nick'];
$haslo = $_POST['password'];

$login = htmlentities($login, ENT_QUOTES, "UTF-8");
$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");

$query = "SELECT * FROM user WHERE user='" . mysqli_real_escape_string($connection, $login) . "'";
$result = $connection->query($query);

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($haslo, $row['pass'])) {

            $_SESSION['zalogowany'] = true;
            $_SESSION['iduser'] = $row['iduser'];
            $_SESSION['user'] = $row['user'];
            $_SESSION['email'] = $row['email'];

            unset($_SESSION['blad']);
            $result->free_result();
            header('Location: indexlogged.php');
            exit();
        }
    }
}

$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
header('Location: login.php');
exit();

$connection->close();

?>
