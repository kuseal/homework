<h1><?php $data['title']?></h1>
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
