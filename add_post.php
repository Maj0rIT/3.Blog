<?php

session_start(); // Rozpoczęcie sesji

//łączenie z bazą danych
require_once "connect.php";

// Sprawdzamy, czy formularz został wysłany (metodą POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pobieramy dane z formularza
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Sprawdzamy, czy użytkownik jest zalogowany (czy istnieje sesja z ID użytkownika)
    if (!isset($_SESSION['zalogowany'])) {
        echo "Użytkownik nie jest zalogowany.";
    } else {
        // Pobieramy ID użytkownika z sesji
        $iduser = $_SESSION['zalogowany'];

        // Tworzymy zapytanie SQL do wstawienia danych do tabeli "post"
        $sql = "INSERT INTO post (title, content) VALUES ('$title', '$content')";

        // Wykonujemy zapytanie
        if (mysqli_query($connection, $sql)) {
            echo "Post został dodany pomyślnie.";
            echo '<br/>';
            echo '<a href="indexlogged.php">Przjedź do strony głównej</a>';
        } else {
            echo "Wystąpił błąd";
        }

        // Zamykamy połączenie
        mysqli_close($connection);
    }
}

?>