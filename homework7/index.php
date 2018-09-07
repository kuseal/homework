<?php
  session_start();

  if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    header('Location: list.php');
  }

  $error = [];
  $count = '';

  if (!empty($_POST)) {

    $count = isset($_COOKIE['count']) ? $_COOKIE['count'] + 1 : 1;
    setcookie('count', $count, time() + 3600);
    if (isset($_POST['captcha']) && $_POST['captcha'] !== '3') {
      $error[] = 'Неверный ответ на вопрос';
    }

    if (isset($_POST['submitGuest']) && !empty($_POST['guest'])) {
      $user = trim(htmlspecialchars($_POST['guest']));
      //session_start();
      $_SESSION['user'] = [
          'firstName' => $user, 'status' => 0
      ];
      setcookie('count', $count, time() - 1);
      header('Location:list.php');
      die();

    }

    if (isset($_POST['submitUser']) && !empty($_POST['login'])) {

      $userName = trim(htmlspecialchars($_POST['login']));
      $userPass = trim(htmlspecialchars($_POST['password']));
      $usersData = file_get_contents(__DIR__ . '/data/login.json');
      $users = json_decode($usersData, true);

      if (!empty($users)) {
        foreach ($users as $user) {
          if ($_POST['login'] === $user['login']) {

            foreach ($user as $value) {
              if ($_POST['password'] === $user['pass']) {
                $_SESSION['user'] = $user;
                setcookie('count', $count, time() - 1);
                header('Location: list.php');
                die();
              }
            }
          } else {
            $error[] = 'Неверный логин или пароль';
          }
        }
      }
    }
  }

  if ($count > 9) {
    setcookie('count', $count, time() - 1);
    setcookie('stop', '1', time() + 3600);
    $error = [];
  }

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Тесты</title>
  <style>
    div {
      margin: 10px 0;
    }
  </style>
</head>
<body>
<h2>Вход</h2>
<div><?php echo $count; ?></div>
<ul>
  <?php foreach ($error as $item): ?>
    <li><?php echo $item; ?></li>
  <?php endforeach; ?>
</ul>
<div><a href="index.php?guest=гость">Войти как гость</a></div>
<?php if (!isset($_COOKIE['stop']) || $_COOKIE['stop'] != '1'): ?>
  <form method="post">
    <input type="text" name="guest" placeholder="Имя">
    <input type="submit" name="submitGuest" value="Зайти как гость">
  </form>
  <form method="POST">
    <div>
      <label>Войти как зарегистрированный пользователь</label><br>
      <input type="text" name="login" placeholder="Логин">
      <input type="password" name="password" placeholder="Пароль">
    </div>
    <?php if ($count >= 5): ?>
      <div>
        <label for="captcha">Вы бот?</label>
        <input type="radio" name="captcha" value="2" id="captcha">Да
        <input type="radio" name="captcha" value="3" id="captcha">Нет
      </div>
    <?php endif; ?>
    <input type="submit" value="Вход" name="submitUser">
  </form>

<?php else: ?>
  <p>Перекур 1 час.</p>
<?php endif; ?>
</body>
</html>
