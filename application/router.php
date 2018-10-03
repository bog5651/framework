<?php
  //загрузка роутера
  $router = Router::getInstance();
  //список роутов
  $router->route('', 'Base');
  $router->route('User', 'User');
  $router->route('Login', 'Login')
?>