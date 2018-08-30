<?php
  if (isset($_FILES)) {
    if (array_key_exists("userfile", $_FILES)) {
      $dirname = 'json';
      $count = count(scandir('json'))-2;
      $filename = 'test_'.($count + 1).'.json';
      $uploadfile = $dirname.'/'.$filename ;

if($_FILES['userfile']['type'] ==  "application/json" ){
  if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "Файл корректен и был успешно загружен.\n";
  } else {
    echo "Возможная атака с помощью файловой загрузки!\n";
  }
}else{
  echo "Возможная атака с помощью файловой загрузки!\n";
}
}

    var_dump($filename);
  }


?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>
    Admin
  </title>
  <style>
    div {
      margin: 10px 0;
    }
  </style>
</head>
<body>
<h2>Json file upload</h2>
<form enctype="multipart/form-data" action="admin.php" method="POST">
  <div><input type="file" name="userfile"></div>
  <div><input type="submit" value="Отправить"></div>
</form>
</body>
</html>



