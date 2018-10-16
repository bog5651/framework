<?php
  class LoginController extends Controller
{
  public function index()
  {
    echo '<h1>BASE login INDEX</h1>';
  } 
  
  public function login(string $str  = null)
  {
    if($str==null){
      echo'<h1>login without param</h1>';
      echo "<br>hello, ".IO::get("name");
    } else {
      echo'<h1>login with param</h1>';
      echo "<br>hello, ".$str.IO::get("name");
    }
  }
}
?>