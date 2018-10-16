<?php
class Configuration
{
  private static $configuration = null;

  public static function getConfiguration()
  {
    if (is_null(self::$configuration)) {
      self::$configuration = new Configuration();
    }
    return self::$configuration;
  }

  private function __construct()
  {
  }

  public function __get($name)
  {
    if (property_exists($this, $name)) {
      return $this->$name;
    }
    return null;
  }
  
  //общие настройки
  private $common = [
    'base_url' => 'http://php-bog5668934694.codeanyapp.com'
  ];
  
  //настройки базы данных
  private $database = [
    'host' => 'localhost',
    'dbname' => 'db',
    'login' => 'root',
    'password' => '',
    'prefix' => ''
  ];
  
  //настройки почты
  private $mail = [];
}