<?php
//  https://api.openweathermap.org/data/2.5/weather?q=Narva,EE&units=metric&lang=ru&appid=932c31c85cb252fbf4f647617973dc9b

$data = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=Sillamae,EE&units=metric&lang=ru&appid=932c31c85cb252fbf4f647617973dc9b');
$result = json_decode($data, true);

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Weather in <?php echo $result['name']?></title>

</head>
<body>
<h1>Weather</h1>
<table>
  <tr>
    <td>City:</td>
    <td><?php echo $result['name']?></td>
  </tr>
  <tr>
    <td>t:</td>
    <td><?php echo $result["main"]['temp'] ?> C</td>
  </tr>
  <tr>
    <td>Weather:</td>
    <td><img src="http://openweathermap.org/img/w/<?php echo $result['weather'][0]['icon']?>.png"></td>
  </tr>

  <tr>
    <td>Wind:</td>
    <td><?php echo $result["wind"]["speed"] ?> m/s</td>
  </tr>
</table>
</body>
</html>
