<?php

include 'config.php';

  if (!isset($_GET['c']) || !isset($_GET['a'])) {
    $controller = 'table';
    $action = 'list';
  } else {
    $controller = $_GET['c'];
    $action = $_GET['a'];
  }

  $controllerFile = 'controllers/' . ucfirst($controller) . '.php';

  if (is_file($controllerFile)) {
    include $controllerFile;
    $controller = ucfirst($controller);
    if (class_exists($controller)) {
      $controller = new $controller();
      $action = $action.'Action';
      if (method_exists($controller, $action)) {
        $data = $controller->$action();
      } else {
        header($_SERVER['SERVER_PROTOCOL'] . "HTTP/1.0 404 Not Found");
        die('<h2>Ошибка 404</h2> Страницы не существует no method');
      }
    } else {
      header($_SERVER['SERVER_PROTOCOL'] . "HTTP/1.0 404 Not Found");
      die('<h2>Ошибка 404</h2> Страницы не существует no class');
    }
  } else {
    header($_SERVER['SERVER_PROTOCOL'] . "HTTP/1.0 404 Not Found");
    die('<h2>Ошибка 404</h2> Страницы не существует no file');
  }

include 'views/template.php';