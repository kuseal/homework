<?php
  include 'Tables.php';

  $db = new Tables();

  $tables = $db->showTable();

  if (isset($_GET['table'])) {
    $tableData = $db->viewTable(
            htmlspecialchars($_GET['table']));
  }

  // Удаление поле
  if (isset($_GET['delete'])) {
    $db->deleteCol(
            htmlspecialchars($_GET['table']),
            htmlspecialchars($_GET['delete']));
    header('Location:viewtable.php?table=' . $_GET['table']);
    die();
  }

  // Тип поля
  $jsonData = file_get_contents(__DIR__ . '/data.json');
  $resultJson = json_decode($jsonData, true);
  $typeCol = $resultJson[0]['type'][0];
  $type = ["TINYINT", "INT", "FLOAT", "VARCHAR"];

  $error = '';

  if (!empty($_POST)) {
    $params = in_array($_POST['colType'], $type) ? $_POST['colType'] . '(' . str_replace('.', ',', $_POST['colWidth']) . ')' : $_POST['colType'];
    if (isset($_POST['modify'])) {
      if ($db->modifyCol(
          htmlspecialchars($_POST['tableName']),
          htmlspecialchars($_POST['colName']),
          htmlspecialchars($params))) {
        header('Location:viewtable.php?table=' . $_POST['tableName']);
        die();
      } else {
        $error = 'Ощибка модификации';
      }
    } else if (isset($_POST['add'])) {
      if ($db->addCol(htmlspecialchars($_POST['tableName']),
          htmlspecialchars($_POST['colName']),
          htmlspecialchars($params))) {
        header('Location:viewtable.php?table=' . $_POST['tableName']);
      } else {
        $error = 'Ощибка добавления';
      }
    }
  }

?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Таблица <?php echo $_GET['table'] ? $_GET['table'] : '' ?> </title>
  <style>
    body{
      width: 900px;
      margin: 0 auto;
    }
    hr{
      margin: 20px 0;
    }
    th, td {
      padding: 10px;
      border: 1px solid #000000;
    }

    .error {
      color: red;
    }
  </style>
</head>
<body>
<h1>AdminMysql</h1>
<?php if ($tables): ?>
  <h3>Таблицы</h3>
  <ul>
    <?php foreach ($tables as $table): ?>
      <li>
        <a href="index.php?table=<?php echo $table['Tables_in_skulakov'] ?>"> <?php echo $table['Tables_in_skulakov'] ?></a>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>
<h2>Создать таблицу</h2>
<form method="post">
  <input type="text" name="tableName">
  <input type="hidden" name="ctrateTable">
  <input type="submit" value="Создать">
</form>

<?php if (isset($tableData)): ?>
  <hr>
  <h2>Таблица <?php echo isset($_GET['table']) ? $_GET['table'] : '' ?></h2>
  <p class="error"><?php echo $error; ?></p>
  <h3>Редактировать поле</h3>
  <table>
    <tr>
      <th>Имя</th>
      <th>Тип</th>
      <th>Длина</th>
    </tr>
    <?php foreach ($tableData as $datum): ?>
      <tr>
        <form method="post">

          <td><input type="text" name="colName" value="<?php echo $datum['COLUMN_NAME'] ?>"></td>
          <td>
            <select name="colType">
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
          <td><input type="text" name="colWidth"
                     value="<?php echo preg_replace('/[^0-9]/', '', $datum['COLUMN_TYPE']) ?>"></td>

          <td>
            <input type="submit" value="Редактировать">
            <input type="hidden" name="tableName" value="<?php echo $datum['TABLE_NAME'] ?>">
            <input type="hidden" name="modify">
          </td>
        </form>
        <td><a href="viewtable.php?delete=<?php echo $datum['COLUMN_NAME'] ?>&table=<?php echo $datum['TABLE_NAME'] ?>">
            <button>Удалить</button>
          </a></td>
      </tr>

    <?php endforeach; ?>
  </table>
  <hr>
  <h2>Добавить поле</h2>
  <form method="post">
    <table>
      <tr>
        <th>Имя</th>
        <th>Тип</th>
        <th>Длина</th>
      </tr>
      <tr>
        <td><input type="text" name="colName" required></td>
        <td>
          <select name="colType">
            <?php foreach ($typeCol as $key => $types): ?>
              <optgroup label="<?php echo $key ?>">
                <?php foreach ($types as $type): ?>
                  <option value="<?php echo $type ?>"><?php echo $type ?></option>
                <?php endforeach; ?>
              </optgroup>
            <?php endforeach; ?>
          </select>
        </td>
        <td><input type="text" name="colWidth" value="11"></td>
        <td><input type="submit" value="Добавить"></td>
      </tr>
    </table>
    <input type="hidden" name="add">
    <input type="hidden" name="tableName" value="<?php echo $_GET['table'] ?>">
  </form>
<?php endif; ?>
<hr>
<p>Footer</p>
</body>
</html>
