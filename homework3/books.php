<?php
if($argv[1]){
  $query = urlencode($argv[1]);
  $data = file_get_contents('https://www.googleapis.com/books/v1/volumes?q=' . $query);
  $result = json_decode($data, true);

  foreach ($result["items"] as $item) {
    $arr[] = $item;
    foreach ($arr as $item) {
      $arr2[] = $item["volumeInfo"];
    }
    foreach ($arr2 as $item) {
      if ($item["authors"]) {
        $arr3[] = [$item["title"], $item["authors"][0]];
      }

    }
  }
  $fp = fopen(__DIR__ . "/books.csv", 'a+');
  foreach ($arr3 as $value) {
    fputcsv($fp, $value, ';');
  }
  fclose($fp);
}else{
  echo "Ошибка! Нет названия книги";
}
