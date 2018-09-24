<?php


  //include $_SERVER['DOCUMENT_ROOT'].'/config.php';

  class DB
  {

    public function __construct()
    {
      $dns = DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
      $this->pdo = new PDO($dns, DB_USER, DB_PASS);
    }

    // Вывод всех таблиц
    public function listTable()
    {
      $sql = "SHOW TABLES IN tables";
      $sth = $this->pdo->prepare($sql);
      $sth->execute();
      $result = $sth->fetchAll(PDO::FETCH_ASSOC);
      return $result ? $result : false;
    }

    public function createTable($tableName)
    {
      $sql = " CREATE TABLE IF NOT EXISTS `$tableName` (
  id INT(11) NOT NULL auto_increment primary key
)";
      $sth = $this->pdo->prepare($sql);
      return $sth->execute() ? true : false;
    }

    // Вывод полей таблицы
    public function viewTable($tableName)
    {
      $sql = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_NAME = ?";
      $sth = $this->pdo->prepare($sql);
      $sth->bindParam(1, $tableName, PDO::PARAM_STR);
      $sth->execute();
      $result = $sth->fetchAll(PDO::FETCH_ASSOC);
      return $result ? $result : false;
    }

    // Обновление типа поля
    public function modifyCol($tableName, $colName, $params)
    {
      $sql = "ALTER TABLE $tableName MODIFY $colName $params";
      $sth = $this->pdo->prepare($sql);
      return $sth->execute() ? true : false;
    }
    // Обновление поля
    public function changeCol($tableName, $oldColName, $colName, $params)
    {
      $sql = "ALTER TABLE $tableName CHANGE  $oldColName $colName $params";
      $sth = $this->pdo->prepare($sql);
      return $sth->execute() ? true : false;
    }
    // Добавление поля
    public function addCol($tableName, $colName, $params)
    {
      $sql = "ALTER TABLE $tableName ADD $colName $params";
      $sth = $this->pdo->prepare($sql);
      return $sth->execute() ? true : false;
    }

    // Удаление поля
    public function deleteCol($tableName, $colName)
    {
      $sql = "ALTER TABLE $tableName DROP COLUMN $colName";
      $sth = $this->pdo->prepare($sql);
      return $sth->execute() ? true : false;
    }
  }