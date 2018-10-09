<?php

  namespace controllers;

  use lib\Controller;
  use models\ThemesModel;
  use models\QuestionsModel;
  use lib\View;

  class FaqController extends Controller {

    public function __construct() {
      parent::__construct();
      View::setTemplate(TD.'/frontend');
    }

    public function index() {

      $data['info'] = $data['error'] = '';

      if (!empty($_POST)) {
        if (QuestionsModel::addQuetion($_POST['name'], $_POST['email'], $_POST['theme'], $_POST['message'])) {
          header('Location: faq/success');
        } else {
          $data['error'] = 'Запрос не отправлен. Поробуйте еще.';
        }
      }

      $data['title'] = 'FAQ';
      $data['themes'] = ThemesModel::frontendThemes();
      $data['all_themes'] = ThemesModel::getAllThemes();
      $data['question'] = QuestionsModel::viewVisibleQuestions();

      $this->setTemplate('frontend_page');
      View::render(parent::$template, $data);
    }

    public function success() {
      $data['title'] = 'Ваш вопрос';

      $this->setTemplate('success_page');
      View::render(parent::$template, $data);
    }

  }
  