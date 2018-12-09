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
    $model_path = ROOT . 'application/models/' . $model . '_model.php';
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

  public function getLibrary(string $library)
  {
    if (empty($library)) {
      return null;
    }
    $library = str_replace('_library', '', $library);
    //проверка наличия файла библиотеки
    $library_path = ROOT . 'application/librares/' . $library . '_library.php';
    if (!file_exists($library_path)) {
      return null;
    }
    //загрузка библиотеки
    require_once($library_path);
    //проверка наличия класса библиотеки
    $library_class = ucfirst($library) . 'Library';
    if (!class_exists($library_class)) {
      return null;
    }
    return new $library_class();
  }
}