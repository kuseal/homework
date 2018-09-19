<?php

  include 'DB.php';

  class Tables extends DB
  {
    // Создание таблицы
    public function createTable($tableName)
    {
      $sql = "CREATE TABLE IF NOT EXISTS $tableName(
       `id` int(11) NOT NULL auto_increment,   
  `first_name` varchar (20) NOT NULL default '',       
  `last_name` varchar(20)  NOT NULL default '',     
  `email`  varchar (50) NULL,    
  `reg_date` timestamp NOT NULL,
   PRIMARY KEY  (`id`))";
      $sth = $this->pdo->prepare($sql);
      return $sth->execute() ? true : false;
    }

// Вывод всех таблиц
    public function showTable()
    {
      $sql = "SHOW TABLES IN skulakov";
      $sth = $this->pdo->prepare($sql);
      $sth->execute();
      $result = $sth->fetchAll(PDO::FETCH_ASSOC);
      return $result ? $result : false;
    }

    // Провека на таблицу
    public function checkTable($tableName)
    {
      $sql = "SHOW TABLES FROM skulakov LIKE '?'";
      $sth = $this->pdo->prepare($sql);
      $sth->bindParam(1, $tableName, PDO::PARAM_STR);
      $result = $sth->execute();
      return $result ? true : false;
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

    // Удаление поля
    public function deleteCol($tableName, $colName)
    {
      $sql = "ALTER TABLE $tableName DROP COLUMN $colName";
      $sth = $this->pdo->prepare($sql);
      return $sth->execute() ? true : false;
    }

    // Обновление поля
    public function modifyCol($tableName, $colName, $params)
    {
      $sql = "ALTER TABLE $tableName MODIFY $colName $params";
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
  }