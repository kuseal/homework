<?php


  namespace controllers;


  use lib\Controller;
  use lib\View;
  use models\QuestionsModel;
  use models\ThemesModel;

  class QuestionsController extends Controller {

    public function __construct() {
      if (!isset($_SESSION['role'])) {
        header('Location: /login');
      }
      parent::__construct();
      View::setTemplate(TD.'/backend');
    }

    public function index() {
      $data['title'] = 'Вопросы';
      $data['themes'] = ThemesModel::getAllThemes();
      $data['qiestions'] = QuestionsModel::viewAllQuestions();

      $this->setTemplate('questions/questions_page');
      View::render(parent::$template, $data);
    }

    public function empty_questions() {
      $data['title'] = 'Вопросы без ответа';
      $data['themes'] = ThemesModel::getAllThemes();
      $data['qiestions'] = QuestionsModel::viewEmptyQuestions();

      $this->setTemplate('questions/empty_questions_page');
      View::render(parent::$template, $data);
    }

    public function update($id) {
      if (QuestionsModel::viewQuestion($id)) {
        if (!empty($_POST)) {
          QuestionsModel::updateQuestion($_POST['user'], $_POST['email'], $_POST['theme'], $_POST['question'], $_POST['answer'], $_POST['status'], $_POST['id']);
          //updateQuestion($user, $email, $theme, $quest, $answer, $status, $id)
          header('Location: /questions/view_question/' . $_POST['id']);
        }
        $data['title'] = 'Редактировать вопрос';
        $data['themes'] = ThemesModel::getAllThemes();
        $data['question'] = QuestionsModel::viewQuestion($id)[0];
        $data['status'] = QuestionsModel::status();

        $this->setTemplate('questions/update_question_page');
        View::render(parent::$template, $data);
      } else {
        header($_SERVER['SERVER_PROTOCOL'] . 'HTTP/1.0 404 Not found');
        die('<h2>Ошибка 404</h2> <p>Нет страницы</p>');
      }
    }

    public function view_question($id) {
      if (QuestionsModel::viewQuestion($id)) {
        $data['title'] = 'Вопрос';
        $data['themes'] = ThemesModel::getAllThemes();
        $data['question'] = QuestionsModel::viewQuestion($id)[0];

        $this->setTemplate('questions/view_question_page');
        View::render(parent::$template, $data);
      } else {
        header($_SERVER['SERVER_PROTOCOL'] . 'HTTP/1.0 404 Not found');
        die('<h2>Ошибка 404</h2> <p>Нет страницы</p>');
      }
    }
  }
  