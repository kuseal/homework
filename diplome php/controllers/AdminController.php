<?php

  namespace controllers;

  use lib\Controller;
  use lib\View;
  use models\AdminModel;
  use models\QuestionsModel;
  use models\ThemesModel;

  class AdminController extends Controller {

    public function __construct() {
      if (!isset($_SESSION['role'])) {
        header('Location: /login');
      }
      parent::__construct();
      View::setTemplate(TD . '/backend');
    }

    public function index() {
      $data['title'] = 'Главная';
      $data['themes'] = ThemesModel::getAllThemes();
      $data['admins'] = AdminModel::viewAllAdmins();
      $data['questions'] = QuestionsModel::viewAllQuestions();

      parent::setTemplate('/admin/admin_page');
      View::render(parent::$template, $data);
    }

    public function all_admins() {
      $data['title'] = 'Администраторы';
      $data['themes'] = ThemesModel::getAllThemes();
      $data['admins'] = AdminModel::viewAllAdmins();
      $data['title'] = 'Администраторы';

      parent::setTemplate('/admin/all_admin_page');
      View::render(parent::$template, $data);
    }

    public function view_admin($id) {
      if (AdminModel::viewAdmin((int)$id)) {
        $data['admin'] = AdminModel::viewAdmin((int)$id)[0];
        $data['title'] = 'Администратор ' . $data['admin']['login'];
        $data['themes'] = ThemesModel::getAllThemes();

        parent::setTemplate('/admin/view_admin_page');
        View::render(parent::$template, $data);
      } else {
        header($_SERVER['SERVER_PROTOCOL'] . 'HTTP/1.0 404 Not found');
        die('<h2>Ошибка 404</h2> <p>Нет страницы</p>');
      }
    }

    public function add_admin() {
      if (!empty($_POST)) {
        if (!empty($_POST['login']) && !empty($_POST['pass'])) {
          if (!AdminModel::checkLogin($_POST['login'])) {
            if (AdminModel::createAdmin($_POST['login'], $_POST['pass'])) {
              header('Location: /admin/all_admins');
            } else {
              $data['error'] = 'Ошибка. Попробуйте еще раз.';
            }
          } else {
            $data['error'] = 'Логин занят';
          }

        } else {
          $data['error'] = 'Не все поля заполнены';
        }
      }
      $data['title'] = 'Добавить администратора';
      $data['themes'] = ThemesModel::getAllThemes();

      parent::setTemplate('/admin/create_admin_page');
      View::render(parent::$template, $data);
    }

    // Изменение пароля
    public function update_pass($id) {

      if (!empty($_POST)) {
        if (!empty($_POST['pass']) && !empty($_POST['repeatPass']) && $_POST['pass'] == $_POST['repeatPass']) {
          if (AdminModel::updatePassAdmin($_POST['pass'], $_POST['id'])) {
            header('Location: /admin/all_admins');
          } else {
            $data['error'] = 'Ошибка. Попробуйте еще раз.';
          }
        } else {
          $data['error'] = 'Пароли не совпадают.';
        }
      }
      $data['admin'] = AdminModel::viewAdmin($id);
      $data['title'] = 'Изменить пароль ' . $data['admin']['login'];
      $data['themes'] = ThemesModel::getAllThemes();

      parent::setTemplate('/admin/update_pass_page');
      View::render(parent::$template, $data);
    }

    public function delete_admin($id) {
      if ($_SESSION['role'] == 2) {
        AdminModel::deleteAdmin($id);
        header('Location: /admin/all_admins');
      } else {
        header('Refresh: 2; /admin/all_admins');
        die('<h2>Ошибка 403</h2> <p>Нет прав</p>');
      }
    }
  }
  