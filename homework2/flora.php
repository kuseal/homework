<?php
// 1.
  $flora = [
      'Africa' => [
          'Panthera leo', 'Loxodonta africana', 'Okapia johnstoni', 'Giraffa camelopardalis', 'Crocodylus niloticus'
      ],
      'Asia' => [
          'Oryx leucoryx', 'Gazella', 'Hydropotes inermis', 'Axis', 'Vulpes cana'
      ],
      'America' => [
          'Leopardus pardalis', 'Narica', 'Bradypus variegatus', 'Cingulata', 'Condylura cristata '
      ]
  ];


// 2.
  $arr1 = [];
  $arr2 = [];

  foreach ($flora as $key => $item) {
    foreach ($item as $value) {
      $arr = explode(' ', $value);
      if (count($arr) === 2) {
        $arr1[] = $arr[0];
        $arr2[] = $arr[1];
      }
    }
  }
  shuffle($arr1);
  shuffle($arr2);
  $arrFlora = [];
  for ($i = 0; $i < count($arr1); $i++) {
    $arrFlora[] = "$arr1[$i] $arr2[$i]";
  }

  echo '<pre>';
  var_dump($arrFlora);