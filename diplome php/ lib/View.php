<?php

  namespace lib;


  class View {

    protected static $template;

    public static function render($tmpl, $data) {
      $loader = new \Twig_Loader_Filesystem(self::getTemplate());
      $twig = new \Twig_Environment($loader , ['cache'=>'cache'] );
      $twig->addGlobal("session", $_SESSION);
      $template = $twig->loadTemplate($tmpl . '.html');
      //echo $twig->render($template, $data);
      $template->display($data);
    }

    public static function getTemplate() {
      return self::$template;
    }

    public static function setTemplate($template) {
      self::$template = $template;
    }

  }
  