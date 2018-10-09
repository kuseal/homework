<?php

  namespace lib;


  class TwigView {

    protected static $template;

    public function render($template, $data = []) {
      $loader = new \Twig_Loader_Filesystem(self::getTemplate());
      $twig = new \Twig_Environment($loader);
      $twig->addGlobal("session", $_SESSION);
      return $twig->render($template, $data);
    }

    public static function getTemplate() {
      return self::$template;
    }

    public static function setTemplate($template) {
      self::$template = $template;
    }
  }