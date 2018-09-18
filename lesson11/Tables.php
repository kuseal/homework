<?php

  include 'DB.php';

  class Tables extends DB
  {
    public function createTable($tableName)
    {
      $sql = "CREATE TABLE IF NOT EXISTS $tableName(
       `id` int(11) NOT NULL auto_increment,   
  `recid` int(11) NOT NULL default '0',       
  `cvfilename` varchar(250)  NOT NULL default '',     
  `cvpagenumber`  int(11) NULL,     
  `cilineno` int(11)  NULL,    
  `batchname`  varchar(100) NOT NULL default '',
  `type` varchar(20) NOT NULL default '',    
  `data` varchar(100) NOT NULL default '',
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

    public function deleteCol($tableName, $colName)
    {
      $sql = "ALTER TABLE $tableName DROP COLUMN $colName";
      $sth = $this->pdo->prepare($sql);
      return $sth->execute() ? true : false;
    }
    public function modifyCol($tableName, $colName){
      $sql='';
    }
  }