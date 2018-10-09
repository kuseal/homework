<?php
  // Вывод ошибок
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  ini_set('error_reporting', E_ALL);

  // База данных
  define('DB_DRIVER', 'mysql');
  define('DB_HOST', 'localhost');
  define('DB_NAME', 'cf32186_faq');
  define('DB_CHARSET', 'utf8');
  define('DB_USER', 'cf32186_faq');
  define('DB_PASS', 'kng1262');

  // Шаблонизатор Twig папка с HTML шаблонами
  define('TD', 'views');

  define( 'ROOT', dirname( __DIR__ ) );
