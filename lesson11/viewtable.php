<?php
  include 'Tables.php';
  $db = new Tables();
  if (isset($_GET['table'])) {
    $tableData = $db->viewTable($_GET['table']);
  } else {
    header('Location:index.php');
    die();
  }
  if (isset($_GET['delete']) and isset($_GET['table'])) {
    $db->deleteCol($_GET['table'], $_GET['delete']);
  }

  $jsonData = file_get_contents(__DIR__ . '/data.json');
  $resultJson = json_decode($jsonData, true);
  $typeCol = $resultJson[0]['type'][0];

?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Таблица <?php echo $_GET['table'] ? $_GET['table'] : '' ?> </title>
  <style>
    th, td {
      padding: 10px;
      border: 1px solid #000000;
    }
  </style>
</head>
<body>
<h1>Таблица <?php echo isset($_GET['table']) ? $_GET['table'] : '' ?></h1>

<table>
  <tr>
    <th>Имя</th>
    <th>Тип</th>
    <th>Null</th>
    <th>По умолчанию</th>
    <th>Дополнительно</th>
    <th>Действия</th>
    <th></th>
  </tr>
  <?php foreach ($tableData as $datum): ?>
    <form method="post">
      <tr>
        <td><input type="text" name="nameCol" value="<?php echo $datum['COLUMN_NAME'] ?>"></td>
        <td>
          <select name="nameCol">
            <option value="<?php echo $datum['DATA_TYPE'] ?>"><?php echo $datum['DATA_TYPE'] ?></option>
            <?php foreach ($typeCol as $key => $types): ?>
              <optgroup label="<?php echo $key ?>">
                <?php foreach ($types as $type): ?>
                  <option value="<?php echo $type ?>"><?php echo $type ?></option>
                <?php endforeach; ?>
              </optgroup>

            <?php endforeach; ?>
          </select>

        </td>
        <td><?php echo $datum['IS_NULLABLE'] ?></td>

        <td><a href="uploadrow.php?">
            <button>Редактировать</button>
          </a></td>
        <td><a href="viewtable.php?delete=<?php echo $datum['COLUMN_NAME'] ?>&table=<?php echo $datum['TABLE_NAME'] ?>">
            <button>Удалить</button>
          </a></td>
      </tr>
    </form>
  <?php endforeach; ?>

</table>
</body>
</html>
