<?php
  define('DB_DRIVER', 'mysql');
  define('DB_HOST', 'localhost');
  define('DB_NAME', 'books');
  define('DB_USER', 'root');
  define('DB_PASS', '');

  $pdo = new PDO(DB_DRIVER . ':host=' . DB_HOST . '; dbname=' . DB_NAME . '; charset=utf8', DB_USER, DB_PASS);

  $sth = $pdo->prepare('SELECT * from  books');
  $sth->execute();
  $results = $sth->fetchAll(PDO::FETCH_ASSOC);

  //  var_dump($results);

  $isbn = $title = $author = '';

  if (!empty($_POST)) {
    $isbn = trim(htmlspecialchars($_POST['isbn']));
    $title = trim(htmlspecialchars($_POST['title']));
    $author = trim(htmlspecialchars($_POST['author']));

    $smtp = $pdo->prepare('SELECT * from  books WHERE `author`=? OR `name`=? OR isbn=? ORDER BY `year` DESC');
    $smtp->execute([$author, $title, $isbn]);
    $results = $smtp->fetchAll(PDO::FETCH_ASSOC);
  }

  // var_dump($_POST);
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
    .error{
      color:red;
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
  <?php if(empty($results)):?>
    <p class="error">Нет книг с заданными параметрами</p>
  <?php else:?>
  <table>
    <tr>
      <th>Название</th>
      <th>Автор</th>
      <th>Год выпуска</th>
      <th>Жанр</th>
      <th>ISBN</th>
    </tr>
    <?php foreach ($results as $result): ?>
      <tr>
        <td><?php echo $result['name'] ?></td>
        <td><?php echo $result['author'] ?></td>
        <td><?php echo $result['year'] ?></td>
        <td><?php echo $result['genre'] ?></td>
        <td><?php echo $result['isbn'] ?></td>
      </tr>
    <?php endforeach; ?>
    <?php endif;?>
  </table>
  <a href="books.php">Все книги</a>
</form>
</body>
</html>
