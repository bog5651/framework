<?php
class LoginController extends Controller
{
  public function index()
  {
  }

  public function login(string $user, string $password)
  {
    $db = db::getInstance();
  }
}
?>