<?php

  include '../../models/DB.php';

  class Table
  {
    public $type = ["TINYINT", "INT", "FLOAT", "VARCHAR"];

    public function __construct()
    {
      $this->db = new DB();
    }

    public function listAction()
    {
      if (!$this->db->listTable()) {
        $data['title'] = 'Создать таблицу';
        $data['html'] = 'views/create_table.php';
      } else {
        $data['list'] = $this->db->listTable();
        $data['title'] = 'Список таблиц';
        $data['html'] = 'views/list_tables.php';
      }
      return $data;
    }

    public function create_tableAction()
    {
      if (count($_POST) > 0) {
        if (!empty($_POST['tableName'])) {
          if ($this->db->createTable($_POST['tableName'])) {
            header('Location: /');
            die();
          } else {
            $data['errors'] = 'Ошибка';
          }
        } else {
          $data['errors'] = 'Пустое поле';
          $data['title'] = 'Создать таблицу';
        }
      } else {
        header('Location: /');
        die();
      }
      return $data;
    }

    public function view_tableAction()
    {
      if (isset($_GET['name']) and !empty($_GET['name'])) {
        if ($this->db->viewTable($_GET['name'])) {
          // Тип поля
          $jsonData = file_get_contents(ROOT . '/data.json');
          $resultJson = json_decode($jsonData, true);
          $data['list'] = $this->db->listTable();
          $data['tableName'] = $_GET['name'];
          $data['typeCol'] = $resultJson[0]['type'][0];
          $data['table'] = $this->db->viewTable($_GET['name']);
          $data['title'] = 'Редактировать таблицу';
          $data['html'] = 'views/view_table.php';
        }
      } else {
        header('Location: /');
        die();
      }
      return $data;
    }

    public function update_colAction()
    {
      if (count($_POST) > 0) {
        $params = in_array($_POST['colType'], $this->type) ? $_POST['colType'] . '(' . str_replace('.', ',', $_POST['colWidth']) . ')' : $_POST['colType'];
        if (isset($_POST['modify'])) {
          if ($_POST['oldColName'] == $_POST['colName']) {
            if ($this->db->modifyCol(
                htmlspecialchars($_POST['tableName']),
                htmlspecialchars($_POST['colName']),
                htmlspecialchars($params))) {
              header('Location:/?c=table&a=view_table&name=' . $_POST['tableName']);
              die();
            } else {
              header('Location:/?c=table&a=view_table&name=' . $_POST['tableName']);
              die();
            }
          } else if ($_POST['oldColName'] != $_POST['colName']) {
            if ($this->db->changeCol(
                htmlspecialchars($_POST['tableName']),
                htmlspecialchars($_POST['oldColName']),
                htmlspecialchars($_POST['colName']),
                htmlspecialchars($params)
            )) {
              header('Location:/?c=table&a=view_table&name=' . $_POST['tableName']);
              die();
            }
          }

        }
      }
    }

    public function create_colAction()
    {
      if (count($_POST) > 0) {
        // $type = ["TINYINT", "INT", "FLOAT", "VARCHAR"];
        $params = in_array($_POST['colType'], $this->type) ? $_POST['colType'] . '(' . str_replace('.', ',', $_POST['colWidth']) . ')' : $_POST['colType'];
        if ($this->db->addCol(htmlspecialchars($_POST['tableName']),
            htmlspecialchars($_POST['colName']),
            htmlspecialchars($params))) {
          header('Location:/?c=table&a=view_table&name=' . $_POST['tableName']);
          die();
        } else {
          $data['error'] = 'Ощибка добавления';
        }
      }
      return $data;
    }

    public function delete_colAction()
    {
      if ($this->db->deleteCol(
          htmlspecialchars($_GET['table']),
          htmlspecialchars($_GET['col_name'])))
      {
        header('Location:/?c=table&a=view_table&name=' . $_GET['table']);
        die();
      }
    }
  }
