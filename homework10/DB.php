<?php

  include 'config.php';

  class DB
  {
    public function __construct()
    {
      $dns = DB_DRIVER . ':host=' . DB_HOST . '; dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
      $this->pdo = new PDO($dns, DB_USER, BD_PASS);
    }

    // Проверка логина
    public function checkLogin($login)
    {
      $sql = 'SELECT `login` FROM `user` WHERE `login`= ? LIMIT 1';
      $sth = $this->pdo->prepare($sql);
      $sth->bindParam(1, $login, PDO::PARAM_STR);
      $sth->execute();
      $result = $sth->fetch();
      return $result ? false : true;
    }

    // Регистрации
    public function checkIn($login, $pass)
    {
      $sql = 'INSERT INTO `user`(`login`, `password`) VALUES (?,?)';
      $sth = $this->pdo->prepare($sql);
      $sth->bindParam(1, $login, PDO::PARAM_STR);
      $sth->bindParam(2, $pass, PDO::PARAM_STR);
      return $sth->execute() ? true : false;
    }

    // Авторизации
    public function login($login, $pass)
    {
      $sql = 'SELECT `id` FROM `user` WHERE `login`= ? AND `password` = ? LIMIT 1';
      $sth = $this->pdo->prepare($sql);
      $sth->bindParam(1, $login, PDO::PARAM_STR);
      $sth->bindParam(2, $pass, PDO::PARAM_STR);
      $sth->execute();
      $result = $sth->fetch(PDO::FETCH_ASSOC);
      return $result ? $result['id'] : false;
    }

    // Добавление нового вашего дела (описание, дата)
    public function newTask($userId, $description)
    {
      $sql = 'INSERT INTO `task` (`user_id`, `description`, `date_added`) VALUES (?, ?, CURRENT_TIMESTAMP)';
      $sth = $this->pdo->prepare($sql);
      $sth->bindParam(1, $userId, PDO::PARAM_INT);
      $sth->bindParam(2, $description, PDO::PARAM_STR);
      return $sth->execute() ? true : false;
    }

    // Вывод списка ваших дел (отсортированных по дате)
    public function sortingTasksByDate($user_id)
    {
      $sql = 'SELECT * FROM task WHERE user_id = ? ORDER BY date_added DESC';
      $sth = $this->pdo->prepare($sql);
      $sth->bindParam(1, $user_id, PDO::PARAM_INT);
      $sth->execute();
      $result = $sth->fetchAll(PDO::FETCH_ASSOC);
      return $result ? $result : false;
    }

    // Все дела с моим участием
    public function myTask($user_id)
    {
      $sql = 'SELECT task.*, `user`.`id` id_login, `user`.login FROM `task`
 LEFT JOIN `user` ON `user`.`id` = `task`.`assigned_user_id` WHERE `task`.`user_id` = ? ORDER BY `date_added` DESC';
      $sth = $this->pdo->prepare($sql);
      $sth->bindParam(1, $user_id, PDO::PARAM_INT);
      $sth->execute();
      $result = $sth->fetchAll(PDO::FETCH_ASSOC);
      return $result ? $result : false;
    }

    // Удаление дела
    public function deleteTask($id, $user_id)
    {
      $sql = 'DELETE FROM task WHERE `id`=? AND `user_id`=?';
      $sth = $this->pdo->prepare($sql);
      $sth->bindParam(1, $id, PDO::PARAM_INT);
      $sth->bindParam(2, $user_id, PDO::PARAM_INT);
      if ($sth->execute()) {
        return true;
      }
      return false;
    }

    // Отмечать дела как выполненные/невыполненные
    public function isDone($taskId, $done, $user_id)
    {
      $sql = 'UPDATE task SET `is_done` = ? WHERE `id`= ? AND `user_id`=?';
      $sth = $this->pdo->prepare($sql);
      $sth->bindParam(1, $done, PDO::PARAM_INT);
      $sth->bindParam(2, $taskId, PDO::PARAM_INT);
      $sth->bindParam(3, $user_id, PDO::PARAM_INT);
      if ($sth->execute()) {
        return true;
      }
      return false;
    }

    // Все пользователи
    public function users()
    {
      $sql = 'SELECT `id`, `login` FROM user';
      $sth = $this->pdo->prepare($sql);
      $sth->execute();
      $result = $sth->fetchAll(PDO::FETCH_ASSOC);
      return $result ? $result : false;
    }

    // Делегировать (передавать дела)
    public function assignedTask($task_id, $user_id, $assigned_user_id)
    {
      $sql = 'UPDATE `task` SET `assigned_user_id`=? WHERE `id`=? AND `user_id`=?';
      $sth = $this->pdo->prepare($sql);
      $sth->bindParam(1, $assigned_user_id, PDO::PARAM_INT);
      $sth->bindParam(2, $task_id, PDO::PARAM_INT);
      $sth->bindParam(3, $user_id, PDO::PARAM_INT);
      if ($sth->execute()) {
        return true;
      }
      return false;
    }

    //Показать делегированные дела с именем автора
    public function allMyTask($user_id)
    {
      $sql = 'SELECT * FROM task t LEFT JOIN `user` u ON u.id = t.assigned_user_id WHERE t.user_id = ? OR t.assigned_user_id = ?';
      $sth = $this->pdo->prepare($sql);
      $sth->execute([$user_id, $user_id]);
      return $sth->fetchAll(PDO::FETCH_ASSOC);
    }


    // Вывести количество дел
    public function countAllMyTask($user_id)
    {
      $sql = 'SELECT COUNT(`id`) FROM task WHERE user_id=? OR assigned_user_id=?';
      $sth = $this->pdo->prepare($sql);
      $sth->execute([(int)$user_id, (int)$user_id]);
      $result = $sth->fetch(PDO::FETCH_NUM);
      return $result ? $result[0] : false;
    }
  }
