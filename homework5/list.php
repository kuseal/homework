<?php
  $str = file_get_contents(__DIR__.'/tests.json');
  $result = json_decode($str, true);

  foreach ($result as $link){
    echo '<a href="admin.php?test='.$link['num'].'">'.$link['label'].'</a><br>';
  }