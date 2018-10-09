<?php



  namespace lib;

  
  class Controller {
        public static $template;

    public function __construct() {
    }

    public static function getTemplate() {
      return self::$template;
    }

    public static function setTemplate($template) {
      self::$template = $template;
    }
  }
  