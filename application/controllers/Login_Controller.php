<?php
class LoginController extends Controller
{
  public function index()
  {
    $LB_login = $this->loader->getLibrary("login");
    if ($LB_login->checkLogin()) {
      $url = $this->loader->getLibrary('url');
      $url->redirect($this->config->common['base_url']);
    } else {
      $this->view->display("pages/login", ["title" => "Login in"]);
    }
  }

  public function login()
  {
    echo ("<h>Login epta metod<h>");
  }
}
?>