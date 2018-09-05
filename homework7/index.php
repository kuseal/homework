<?php
  session_start();

  function getUsers()
  {
    $usersData = file_get_contents(__DIR__ . '/data/login.json');
    $users = json_decode($usersData, true);
    if (empty($users)) {
      return [];
    }
    return $users;
  }

  function getUser($login)
  {
    $users = getUsers();
    foreach ($users as $user) {
      if ($login === $user['login']) {
        return $user;
      }
    }
    return null;
  }

  function login($login, $password)
  {
    $user = getUser($login);
    if ($user && $user['pass'] == $password) {
      $_SESSION['user'] = $user;
      return true;
    }
    return false;
  }

  $error = [];
  $count = '';
  if (isset($_GET['guest'])) {
    $_SESSION['user'] = 'guest';
    header('Location:list.php');
  }

if (!empty($_POST)){
  $count = isset($_COOKIE['count']) ? $_COOKIE['count'] + 1 : 1;
  setcookie('count', $count, time() + 3600);
  if(isset($_POST['captcha']) && $_POST['captcha'] !== '3'){
    $error[]= 'Неверный ответ на вопрос';
  }
  $userName = trim(htmlspecialchars($_POST['login']));
  $userPass = trim(htmlspecialchars($_POST['password']));
  $usersData = file_get_contents(__DIR__.'/data/login.json');
  $users = json_decode($usersData, true);
  if(!empty($users)){
    foreach ($users as $user){
      if($_POST['login'] === $user['login']){
        foreach ($user as $value){
          if($_POST['password'] == $user['pass'] && empty($error)){
            $_SESSION['user'] = $user;
            setcookie('count', $count, time() - 1);
            header('Location: list.php');
          }
        }
      }else{
        $error[] = 'Неверный логин или пароль';
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
    <input type="submit" value="Вход">
  </form>
<?php else: ?>
  <p>Перекур 1 час.</p>
<?php endif; ?>
</body>
</html>
