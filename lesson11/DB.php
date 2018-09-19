<?php

  include 'config.php';

  class DB
  {
    public function __construct()
    {
      $dns = DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
      $this->pdo = new PDO($dns, DB_USER, DB_PASS);
    }
  }