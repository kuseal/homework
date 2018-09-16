<?php
session_start();

if (isset($_SESSION['user_id'])) {
  header('Location:index.php');
}

include 'DB.php';

$db = new DB();
$errors = $success = '';

if (!empty($_POST)) {
  if (!empty($_POST['user']) and !empty(($_POST['pass']))) {
    if (isset($_POST['login'])) {
      if ($db->login($_POST['user'], $_POST['pass'])) {
        $_SESSION['user_id'] = $db->login($_POST['user'], $_POST['pass']);
        header('Location:index.php');
        die();
      } else {
        $errors = 'Неверный логин или пароль';
      }
    } else if (isset($_POST['checkin'])) {
      if ($db->checkLogin($_POST['user'])) {
        if ($db->checkIn($_POST['user'], $_POST['pass'])) {
          $success = 'Регистрация прошла успешно. Войдите как зарегистрированный пользователь';
        } else {
          $errors = 'Ошибка регтстрации';
        }
      } else {
        $errors = 'Логин уже занят';
      }
    }
  } else {
    $errors = 'Не все поля заполнены';
  }
}

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Вход / Регистрация</h1>

<?php if ($errors): ?>
<p class="error"><?php echo $errors; ?>
  <?php endif; ?>
  <?php if ($success): ?>
<p class="success"><?php echo $success; ?>
  <?php endif; ?>
<form method="post">
    <input type="text" name="user" placeholder="Логин">
    <input type="password" name="pass" placeholder="Пароль">
    <input type="submit" name="login" value="Вход">
    <input type="submit" name="checkin" value="Регистрация">
</form>
</body>
</html>
