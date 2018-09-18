<?php
  include "Tables.php";
  $db = new Tables();
  $tables = $db->showTable();
  if (!empty($_POST)) {
    if ($db->createTable($_POST['tableName'])) {
      header('Location:viewtable.php?table=' . $_POST['tableName']);
      die();
    } else {
      echo 'Таблица не создана';
    }
  }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <style>
    tr, td {
      padding: 0 20px;
    }
  </style>
</head>
<body>
<h1>Добавить таблицу</h1>
<table>
  <tr>
    <th>Таблицы</th>
    <th>Новая таблица</th>
  </tr>
  <tr>
    <td>
      <?php if ($tables): ?>
        <ul>
          <?php foreach ($tables as $table): ?>
            <li>
              <a href="viewtable.php?table=<?php echo $table['Tables_in_skulakov'] ?>"> <?php echo $table['Tables_in_skulakov'] ?></a>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </td>
    <td>
      <form method="post">
        <input type="text" name="tableName">
        <input type="submit" value="Создать">
      </form>
    </td>
  </tr>
</table>


</body>
</html>