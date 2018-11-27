<?php
class View
{
    private static $instanse = null;

    private $smarty = null;

    public static function getInstanse()
    {
        if(is_null(self::$instanse))
        {
            self::$instanse = new View();
        }
        return self::$instanse;
    }

    private function __construct()
    {
        $config = Configuration::getConfiguration();
        //load template engine
        require_once (ROOT.'system/smarty/Smarty.class.php');
        $this->smarty = new Smarty();
        //configure engine
        $this->smarty->setTemplateDir($config->smarty['templates_dir']);
        $this->smarty->setConfigDir($config->smarty['configs_dir']);
        $this->smarty->setCompileDir($config->smarty['compile_dir']);
        $this->smarty->setCacheDir($config->smarty['cache_dir']);
    }

    public function display(string $view, array $data = [])
    {
        //check templates
        $template = $this->checkTemplate($view);
        if(empty($template))
        {
            return false;
        }
        //assign data
        $this->assignData($data);
        //display template
        $this->smarty->display($template);
    }

    public function content(string $view, array $data = [])
    {
        //check templates
        $template = $this->checkTemplate($view);
        if(empty($template))
        {
            return null;
        }
        //assign data
        $this->assignData($data);
        //display template
        return $this->smarty->fetch($template);
    }

    private function checkTemplate($view) : string
    {
        //check argument
        if(empty($view))
        {
            return '';
        }
        //check template
        $existing = false;
        $template = $view.'.tpl';
        foreach ($this->smarty->getTemplateDir() as $template_dir)
        {
            if(file_exists($template_dir.'/'.$template))
            {
                $existing = true;
                break;
            }
        }
        if(!$existing)
        {
            return '';
        }
        return $template;
    }

    private function assignData(array $data)
    {
        if(!empty($data))
        {
            $keys = array_keys($data);
            foreach ($keys as $key)
            {
                $this->smarty->assign($key, $data[$key]);
            }
        }
    }
}