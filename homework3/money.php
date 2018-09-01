<?php
  if (isset($argv[1])) {
    if ($argv[1] === '--today') {
      $arr = '';
      $handle = fopen("test.csv", "r");
      if ($handle !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
          if ($data[0] === date('Y-m-d')) {
            if(is_numeric($data[1])){
              $arr += $data[1];
            }else{
              $arr = 0;
            }
          }
        }
        fclose($handle);
        echo date('Y-m-d') . " расход за день $arr";
      }
    } else {
      $date = date('Y-m-d');
      $price = $argv[1];
      $prod = implode(' ', array_slice($argv, 2));

      $fp = fopen(__DIR__ . "/test.csv", 'a+');
      fputcsv($fp, [$date, $price, $prod], ';');

      fclose($fp);

      echo "Добавлена строка: $date,  $price, $prod";
    }

  } else {
    echo 'Ошибка! Аргументы не заданы. Укажите флаг --today или запустите скрипт с аргументами {цена} и {описание покупки}';
  }

