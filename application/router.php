<?php
  //загрузка роутера
  $router = Router::getInstance();
  //список роутов
  $router->route('', 'Base');
  $router->route('Login', 'Login');

  $router->route('Api', 'ApiGet', 'get');
  $router->route('Api', 'ApiPost', 'post');
?>