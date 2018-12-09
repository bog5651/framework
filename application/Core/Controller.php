<?php
abstract class Controller
{
  protected $loader = null;
  protected $config = null;
  protected $view = null;

  public function __construct()
  {
    $this->loader = new Loader();
    $this->config = Configuration::getConfiguration();
    $this->view = View::getInstanse();
  }

  public abstract function index();

  public function apiPostRaw($data_flag = true, $token_flag = false)
  {
    $data = null;
    //парсинг JSON
    try {
      $data = json_decode(IO::postRaw());
    } catch (Exception $e) {
      echo json_encode([
        'success' => 0,
        'error' => [
          'code' => 101,
          'message' => 'Wrong JSON'
        ]
      ]);
      die();
    }
    //проверка наличия токена
    if ($token_flag) {
      if ($data != null) {
        if (!property_exists($data, 'token')) {
          echo json_encode([
            'success' => 0,
            'error' => [
              'code' => 102,
              'message' => 'Token section not exists'
            ]
          ]);
          die();
        }
      } else {
        echo json_encode([
          'success' => 0,
          'error' => [
            'code' => 101,
            'message' => 'Wrong JSON'
          ]
        ]);
        die();
      }
    }
    return $data;
  }
}
?>