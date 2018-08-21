<?php
  // !.
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
  $i = 0;
  foreach ($flora as $key => $item) {

    foreach ($item as $value) {
      $arr = explode(' ', $value);
      if ($arr[1]) {

        $arr1[] = $arr[0];
        $arr2[] = $arr[1];
        $arrKey[] = $key;
      }
    }

  }

// 3.
  shuffle($arr2);

  foreach ($flora as $k => $item) {
    echo "<h2>$k</h2>";
    foreach ($arrKey as $key => $value) {
      if ($k == $value) {
        echo "$arr1[$key] $arr2[$key], ";

      }

    }

  }