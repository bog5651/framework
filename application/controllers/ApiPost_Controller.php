<?php
class ApiPostController extends Controller {
    public function Index(){
    }
  
    public function login()
    {
        $postRaw = $this->apiPostRaw();
        echo $postRaw->login;
        $db = db::getInstance();
        //$db->query("");
    }

    public function logout()
    {

    }
}
?>