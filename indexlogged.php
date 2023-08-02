<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	
?>
<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/index.css">
  <title>Blog Informatyczny</title>
</head>

<body>
  <header>
    <h1>Blog Informatyczny</h1>
    <nav>
      <ul>
        <li><a href="indexlogged.php" class="menu-link">Strona główna</a></li>
        <li><a href="aboutme.html" class="menu-link">O mnie</a></li>
        <li><a href="kategoria.php" class="menu-link">Kategorie</a></li>
        <li><a href="kontakt.html" class="menu-link">Kontakt</a></li>
        <li><a href="logout.php" class="menu-link">Wyloguj się</a></li>
        <li><a href="add.php" class="menu-link">Dodaj Post</a></li>
      </ul>
    </nav>
  </header>
  <?php

  // 1.Połączenie z bazą danych MySQL
  require_once "connect.php";


  // 2. Pobranie wszystkich postów z tabeli "post"
    $sql = "SELECT * FROM post";

    $result = mysqli_query($connection, $sql);

    // 3. Wyświetlenie postów
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<h2>" . $row['title'] . "</h2>";
        echo "<p>" . $row['content'] . "</p>";
        echo "<hr>";
    }

    // Zamykamy połączenie
    mysqli_close($connection);
    ?>
  <footer>
    <p>&copy; 2023 Blog podróżniczy. Wszelkie prawa zastrzeżone.</p>
  </footer>

  <script src="script.js"></script>
</body>

</html>
