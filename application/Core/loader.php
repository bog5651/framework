<?php 
class Loader
{
  //загрузка модели
  public function getModel(string $model)
  {
    if (empty($model)) {
      return null;
    }
    $model = str_replace('_model', '', $model);
    //проверка наличия файла модели
    $model_path = APP_PATH . 'application/models/' . $model . '_model.php';
    if (!file_exists($model_path)) {
      return null;
    }
    //загрузка модели
    require_once($model_path);
    //проверка наличия класса модели
    $model_class = ucfirst($model) . 'Model';
    if (!class_exists($model_class)) {
      return null;
    }
    return new $model_class();
  }
}