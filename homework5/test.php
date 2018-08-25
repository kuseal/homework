<?php

if (!empty($_POST['num'])){
  $params = $_POST['num'];
  $params = (int)$params;
  switch ($params){
    case 1:
      $options = [
          'options'=>[
              'min_range'=> 1000,
              'max_range'=> 1000,
          ]
      ];
      $validate = filter_input(INPUT_POST, 'q1', FILTER_VALIDATE_INT, $options);
      if($validate){
        echo 'Ответ верный<br><a href="list.php">Тэсты</a> ';
      }else{
        echo 'Ответ неверный<br><a href="admin.php?test='.$params.'">Продолжить</a> ';
      }
      break;
    case 2:
      $options = [
          'options'=>[
              'min_range'=> 1000,
              'max_range'=> 1000,
          ]
      ];
      $validate = filter_input(INPUT_POST, 'q2', FILTER_VALIDATE_INT, $options);
      if($validate){
        echo 'Ответ верный<br><a href="list.php">Тэсты</a> ';
      }else{
        echo 'Ответ неверный<br><a href="admin.php?test='.$params.'">Продолжить</a> ';
      }
      break;

    case 3:
      $options = [
          'options'=>[
              'min_range'=> 60,
              'max_range'=> 60,
          ]
      ];
      $validate = filter_input(INPUT_POST, 'q3', FILTER_VALIDATE_INT, $options);
      if($validate){
        echo 'Ответ верный<br><a href="list.php">Тэсты</a> ';
      }else{
        echo 'Ответ неверный<br><a href="admin.php?test='.$params.'">Продолжить</a> ';
      }
      break;

    default:
  }
}