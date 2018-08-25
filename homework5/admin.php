<?php
  if (isset($_GET['test'])) {
    $test = htmlspecialchars($_GET['test']);

    $str = file_get_contents(__DIR__ . '/tests.json');
    $result = json_decode($str, true);
    $params = [];
    foreach ($result as $value) {
      if ($value['num'] == $test) {
        foreach ($value as $key=>$item) {
          $params[$key] = $item;
        }

      }
    }
  }
//  var_dump($params)
  ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $params['label']?></title>
</head>
<body>
<form method="POST" action="test.php" name="form">
  <legend><?php echo $params['label']?></legend>
  <label><input type="radio" name="q<?php echo $params['num']?>" value="<?php echo $params['params'][0]?>"> <?php echo $params['params'][0]?></label>
  <label><input type="radio" name="q<?php echo $params['num']?>" value="<?php echo $params['params'][1]?>"> <?php echo $params['params'][1]?></label>
  <label><input type="radio" name="q<?php echo $params['num']?>" value="<?php echo $params['params'][2]?>"> <?php echo $params['params'][2]?></label>
  <label><input type="radio" name="q<?php echo $params['num']?>" value="<?php echo $params['params'][3]?>"> <?php echo $params['params'][3]?></label>
  <input type="hidden" name="num" value="<?php echo $params['num']?>">
<div><input type="submit" value="Ответ"></div>
</form>
</body>
</html>



