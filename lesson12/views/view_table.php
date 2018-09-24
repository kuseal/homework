<a href="index.php">Главная</a>
<?php if(isset($data['list'])):?>
<ul>
  <?php foreach ($data['list'] as $datum): ?>
    <li><a href="/?c=table&a=view_table&name=<?php echo $datum['Tables_in_tables'] ?>"><?php echo $datum['Tables_in_tables'] ?></a> </li>
  <?php endforeach; ?>
</ul>
<?php endif;?>

<h1><?php echo $data['title']?></h1>

<?php if (isset($data['table'])): ?>
  <h2>Редактировать поле</h2>
  <table>
    <tr>
      <th>Имя</th>
      <th>Тип</th>
      <th>Длина</th>
    </tr>
    <?php foreach ($data['table']as $datum): ?>
      <tr>
        <form method="post" action="/?c=table&a=update_col">

          <td><input type="text" name="colName" value="<?php echo $datum['COLUMN_NAME'] ?>"></td>
          <td>
            <select name="colType">
              <option value="<?php echo $datum['DATA_TYPE'] ?>"><?php echo $datum['DATA_TYPE'] ?></option>
              <?php foreach ($data['typeCol'] as $key => $types): ?>
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
            <input type="hidden" name="oldColName" value="<?php echo $datum['COLUMN_NAME'] ?>">
            <input type="hidden" name="modify">
          </td>
        </form>
        <td><a href="/?c=table&a=delete_col&col_name=<?php echo $datum['COLUMN_NAME'] ?>&table=<?php echo $datum['TABLE_NAME'] ?>">
            <button>Удалить</button>
          </a></td>
      </tr>

    <?php endforeach; ?>
  </table>
  <h2>Добавить поле</h2>
  <form method="post" action="/?c=table&a=create_col">
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
            <?php foreach ($data['typeCol'] as $key => $types): ?>
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
    <input type="hidden" name="tableName" value="<?php echo $data['tableName']?>">
  </form>
<?php endif; ?>
