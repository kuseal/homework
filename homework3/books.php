<?php
//  ini_set('error_reporting', E_ALL);
//  ini_set('display_errors', 1);
//  ini_set('display_startup_errors', 1);
  $query = urlencode('Гарри+Потер');
  $data = file_get_contents('https://www.googleapis.com/books/v1/volumes?q='.$query);
  $result = json_decode($data, true);
echo '<pre>';
//var_dump($result["items"]);
foreach($result["items"] as $item){
  $arr[] = $item;
  foreach ($arr as $item){
    $arr2[] = $item["volumeInfo"];
  }
  foreach ($arr2 as $item){
    if ($item["authors"]){
      $arr3[] = [$item["title"],$item["authors"]];
    }

  }
}
var_dump($arr3);