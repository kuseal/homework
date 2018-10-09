<?php


  namespace controllers;


  use lib\Controller;
  use lib\View;
  use models\AdminModel;

  class LoginController extends Controller {

    public function __construct() {
      parent::__construct();
      View::setTemplate(TD.'/backend');
    }


    public function index() {
      if (isset($_SESSION['role'])) {
        header('Location: /admin');
      }
      if (!empty($_POST)) {
        if (AdminModel::checkLogin($_POST['login'])) {
          if ($data['admin'] = AdminModel::checkLoginPass($_POST['login'], $_POST['pass'])) {
            if (!isset($_SESSION)) {
              session_start();
            }
            $_SESSION['role'] = $data['admin']['role_id'];
            header('Location: /admin');
            //var_dump($data['admin']);
          } else {
            $data['error'] = 'Неверный логин или пароль';
          }
        } else {
          $data['error'] = 'Неверный логин или пароль';
        }
      }

      $data['title'] = 'Вход';
      parent::setTemplate('/login/login_page');
      View::render(parent::$template, $data);
    }


    public function logout(){
      session_destroy();
      header('Location: /login');
    }
  }
  