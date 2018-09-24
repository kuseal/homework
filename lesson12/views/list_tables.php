<h1><?php echo $data['title'] ?></h1>
<ul>
  <?php foreach ($data['list'] as $datum): ?>
    <li><a href="/?c=table&a=view_table&name=<?php echo $datum['Tables_in_tables'] ?>"><?php echo $datum['Tables_in_tables'] ?></a> </li>
  <?php endforeach; ?>
</ul>
<h2>Создать таблицу</h2>
<form method="post" action="/?c=table&a=create_table"">
  <input type="text" name="tableName">
  <input type="hidden" name="ctrateTable">
  <input type="submit" value="Создать">
</form>