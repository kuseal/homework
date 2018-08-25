<?php

  $contacts = file_get_contents(__DIR__ . '/contacts.json');
  $result = json_decode($contacts, true);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Phonebook</title>
</head>
<body>
<h1>Phonebook</h1>
<table>
  <tr>
    <th>Имя</th>
    <th>Фамилия</th>
    <th>Адрес</th>
    <th>Телефоны</th>
  </tr>

  <?php foreach ($result as $value): ?>
    <tr>

      <td><?php echo $value['firstName'] ?></td>
      <td><?php echo $value['lastName'] ?></td>
      <td><?php echo $value['address'] ?></td>
      <td>
        <?php foreach ($value['phoneNumber'] as $value) {
          echo $value . '<br>';
        } ?>
      </td>
    </tr>
  <?php endforeach; ?>

</table>
</body>
</html>
