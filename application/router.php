<?php
echo "<BR> mars pidor";
  //загрузка роутера
  $router = Router::getInstance();
  //список роутов
  $router->route('', 'base');
  $router->route('user', 'user');
  $router->route('Login', 'Login')
?>