<?php
  class LoginController extends Controller
{
  public function index()
  {
    echo '<h1>BASE INDEX</h1>';
  } 
  
  public function login(string $str )
  {
    echo'<h1>NOT BASE INDEX</h1>'.$str;
  }
}
?>