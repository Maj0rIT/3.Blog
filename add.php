<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tworzenie Postów</title>
  <link rel="stylesheet" href="css/add.css">
</head>
<body>
  <div class="container">
    <h1>Tworzenie Postów</h1>
    <form action="add_post.php" method="post">
      <div class="form-group">
        <label for="title">Tytuł:</label>
        <input type="text" id="title" name="title" >
      </div>
      <div class="form-group">
        <label for="content">Treść:</label>
        <textarea id="content" name="content"></textarea>
      </div>
      <button type="submit">Dodaj post</button>
    </form>
  </div>
</body>
</html>
