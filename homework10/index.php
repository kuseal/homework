<?php
  session_start();

  if (!isset($_SESSION['user_id'])) {
    header('Location:login.php');
    die();
  }

  include 'DB.php';

  $db = new DB();
  // Все пользователи
  $users = $db->users();
  // Мои дела и дела переданные мне
  $allTasks = $db->allMyTask($_SESSION['user_id']);
  // Только мои дела
  $myTasks = $db->myTask($_SESSION['user_id']);
  // Кол-во дел
  $countTasks = $db->countAllMyTask($_SESSION['user_id']);
  // Сортировка по дате
  $byDate = $db->sortingTasksByDate($_SESSION['user_id']);
  $error = '';
  if (!empty($_POST)) {
    if (!empty($_POST['task']) and !empty($_POST['assignedUser'])) {
      if ($db->assignedTask($_POST['task'], $_SESSION['user_id'], $_POST['assignedUser'])) {
        header('Location: index.php');
        die();
      } else {
        $error = 'Что-то пошло не так';
      }
    } else {
      $error = 'Не все поля заполнены';
    }
  }
  if (isset($_GET['is_done']) and isset($_GET['task'])) {
    if ($db->isDone($_GET['task'], $_GET['is_done'], $_SESSION['user_id'])) {
      header('Location:index.php');
      die();
    } else {
      $error = 'Что-то пошло не так';
    }
  }
  if (isset($_GET['delete'])) {
    if ($db->deleteTask($_GET['delete'], $_SESSION['user_id'])) {
      header('Location:index.php');
      die();
    }
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    header('Location:login.php');
  }

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div><a href="index.php?logout">Выход</a></div>
<hr>
<h1>Список дел</h1>

<h2>Дела</h2>
<p class="fs-120">Мои дела и дела мне делегированные: <b><?php echo $countTasks ?></b></p>
<table>
  <tr>
    <th>Задача</th>
    <th>Дата</th>
    <th>Выполнено</th>
    <th>Автор</th>
  </tr>
  <?php foreach ($allTasks as $task): ?>
    <tr>
      <td><?php echo $task['description'] ?></td>
      <td><?php echo $task['date_added'] ?></td>
      <td><?php echo $task['is_done'] ? '<span class="yes">Да</span>' : '<span class="no">Нет</span>' ?></td>
      <td><?php echo ($task['assigned_user_id'] == $_SESSION['user_id']) ? $task['login'] : '<span class="no">Я</span>' ?></td>
    </tr>
  <?php endforeach; ?>
</table>

<h2>Мои дела</h2>
<div><a href="new_task.php">
    <button>Добавить задачу</button>
  </a></div>
<?php echo $error ? "<span class='no'>$error</span>" : '' ?>
<table>
  <tr>
    <th>Задача</th>
    <th>Дата</th>
    <th>Выполнено / невыполнено</th>
    <th>Исполнитель</th>
    <th>Делегировать</th>
    <th></th>
  </tr>
  <?php if ($myTasks): ?>
    <?php foreach ($myTasks as $task): ?>
      <tr>
        <td><?php echo $task['description'] ?></td>
        <td><?php echo date('d-m-Y H:i', strtotime($task['date_added'])) ?></td>
        <td>
          <?php echo $task['is_done'] ? '<span class="yes"> Да </span> / <a href="index.php?task=' . $task['id'] . '&is_done=0">изменить</a>' : '<span class="no"> Нет </span> / <a href="index.php?task=' . $task['id'] . '&is_done=1">изменить</a>' ?></td>
        <td><?php echo $task['login'] ? $task['login'] : '<span class="no">Нет исполнителя</span>' ?>
        </td>
        <td>
          <form method="POST">
            <input type="hidden" name="task" value="<?php echo $task['id'] ?>">
            <select name="assignedUser">
              <option value="">Выбрать</option>
              <?php foreach ($users as $user): ?>
                <!--              --><?php //if ($user['id'] == 1) continue; ?>
                <option value="<?php echo $user['id'] ?>"><?php echo $user['login'] ?></option>
              <?php endforeach; ?>
            </select>
            <input type="submit" value="Go to">
          </form>
        </td>
        <td><a href="index.php?delete=<?php echo $task['id']; ?>"><span class="no">удалить</span> </a></td>
      </tr>
    <?php endforeach; ?>
  <?php endif; ?>
</table>

<h2>Сортировка дел по дате</h2>
<table>
  <tr>
    <th>Задача</th>
    <th>Дата</th>
  </tr>
  <?php if ($byDate): ?>
    <?php foreach ($byDate as $task): ?>
      <tr>
        <td><?php echo $task['description'] ?></td>
        <td><?php echo $task['date_added'] ?></td>
      </tr>
    <?php endforeach; ?>
  <?php endif; ?>
</table>

<hr>
<div><a href="index.php?logout">Выход</a></div>

</body>
</html>
