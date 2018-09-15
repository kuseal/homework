<?php
  define('DB_DRIVER', 'mysql');
  define('DB_HOST', 'localhost');
  define('DB_NAME', 'books');
  define('DB_USER', 'root');
  define('DB_PASS', '');

  $pdo = new PDO(DB_DRIVER . ':host=' . DB_HOST . '; dbname=' . DB_NAME . '; charset=utf8', DB_USER, DB_PASS);

  $isbn = $title = $author = '';

  if (!empty($_POST)) {
    $isbn = trim($_POST['isbn']);
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
  }
  $smtp = $pdo->prepare('SELECT * FROM  books WHERE `author` LIKE ? AND `name` LIKE ? AND isbn LIKE ?');
  $smtp->execute(["%$author%", "%$title%", "%$isbn%"]);
  $results = $smtp->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Книги</title>
  <style>
    table {
      margin: 10px 0;
    }

    th, td {
      border: 1px solid black;
      padding: 0 5px;
    }

    th {
      background: #eceaff;
    }

    .error {
      color: red;
      font-size: 120%;
    }
  </style>
</head>
<body>
<h2>Библиотека успешного человека</h2>
<form method="POST">
  <input type="text" name="isbn" value="<?php echo $isbn; ?>" placeholder="ISBN">
  <input type="text" name="title" value="<?php echo $title; ?>" placeholder="Название книги">
  <input type="text" name="author" value="<?php echo $author; ?>" placeholder="Автор книги">
  <input type="submit" value="Поиск">
  <table>
    <tr>
      <th>Название</th>
      <th>Автор</th>
      <th>Год выпуска</th>
      <th>Жанр</th>
      <th>ISBN</th>
    </tr>
    <?php if ($results): ?>
      <?php foreach ($results as $result): ?>
        <tr>
          <td><?php echo $result['name'] ?></td>
          <td><?php echo $result['author'] ?></td>
          <td><?php echo $result['year'] ?></td>
          <td><?php echo $result['genre'] ?></td>
          <td><?php echo $result['isbn'] ?></td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </table>
</form>
</body>
</html>
