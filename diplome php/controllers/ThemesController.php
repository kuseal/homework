<?php

  namespace controllers;

  use lib\Controller;
  use \lib\View;
  use models\ThemesModel;
  use models\QuestionsModel;

  class ThemesController extends Controller {

    public function __construct() {
      parent::__construct();
      if (!isset($_SESSION['role'])) {
        header('Location: /login');
      }
      View::setTemplate('views/backend');
    }

    public function index() {
      $data['title'] = 'Темы';
      $data['themes'] = ThemesModel::getAllThemes();

      parent::setTemplate('themes/themes_page');
      View::render(parent::$template, $data);
    }

    public function theme($id) {
      if (ThemesModel::getTheme($id)) {
        $data['themes'] = ThemesModel::getAllThemes();
        $data['theme'] = ThemesModel::getTheme($id)[0];
        $data['questions'] = QuestionsModel::questionsInTheme($id);
        $data['title'] = 'Тема ' . $data['theme']['title'];

        parent::setTemplate('themes/theme_page');
        View::render(parent::$template, $data);
      } else {
        header($_SERVER['SERVER_PROTOCOL'] . 'HTTP/1.0 404 Not found');
        die('<h2>Ошибка 404</h2> <p>Нет страницы</p>');
      }
    }

    // CREATE THEME
    public function create() {
      var_dump($_POST);
      if (!empty($_POST)) {
        if (!ThemesModel::createTheme($_POST['title'])) {
          $data['error'] = 'Тема не создана.';
        } else {
          header("Location: /themes");
        }
      }
      $data['themes'] = ThemesModel::getAllThemes();
      $data['title'] = 'Создать тему ';

      parent::setTemplate('themes/create_theme');
      View::render(parent::$template, $data);
    }


    // DELETE THEME
    public function delete($id) {
      if (ThemesModel::deleteThemeAndQuestions($id)) {
        header('Location: /themes');
      } else {
        header($_SERVER['SERVER_PROTOCOL'] . 'HTTP/1.0 404 Not found');
        die('<h2>Ошибка 404</h2> <p>Нет страницы</p>');
      }

    }
  }
  