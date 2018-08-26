<?php

  if (isset($argv[1])) {

    $query = urlencode($argv[1]);
    $data = file_get_contents('https://www.googleapis.com/books/v1/volumes?q=' . $query);
    $result = json_decode($data, true);

    if (json_last_error() === 0) {
      $books = [];
      $i = 1;
      foreach ($result["items"] as $item) {
        $arr[] = $item;
        foreach ($arr as $value) {
          $volumeInfo[] = $value["volumeInfo"];

          foreach ($volumeInfo as $info) {
            if (isset($info["authors"])) {
              $id = $i++;
              $books[] = [$id, $info["title"], $info["authors"][0]];

            }

          }
        }
      }

      $fp = fopen(__DIR__ . "/books.csv", 'a+');

      foreach ($books as $value) {
        fputcsv($fp, $value, ';');
      }
      fclose($fp);
    }else{
      echo 'Невалидный json';
    }

  } else {
    echo "Ошибка! Нет названия книги";
  }
