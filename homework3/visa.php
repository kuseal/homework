<?php
  $file = file('countries.csv') or exit('Невозможно открыть файл');
  if($argv[1]){
    $csv = array_map('str_getcsv', $file);

    $country = $argv[1];
    $shortest = -1;
    foreach($csv as $value){
      $lev = levenshtein($country, $value[1]);
      if($lev == 0){
        $closest = $value[1];
        $shortest = 0;
        break;
      }
      if($lev <= $shortest || $shortest < 0){
        $closest = $value[1];
        $shortest = $lev;
      }
    }

    $country = $closest;

    foreach ($csv as $item){
      if($item[1] == $country)
        echo "$item[1]: $item[4]";
    }
  }


