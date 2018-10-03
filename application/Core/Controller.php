<?php
abstract class Controller
{
  protected $loader = null;
  protected $config = null;

  public function __construct()
  {
    $this->loader = new Loader();
    $config = Configuration::getConfiguration();
  }

  public abstract function index();
}
?>