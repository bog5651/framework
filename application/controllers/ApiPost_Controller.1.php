<?php
class ApiController extends Controller {
    public function login()
    {
        $postRaw = $this-> apiPostRaw();
        echo $postRaw[];
        $db = db::getInstance();
        $db->query("");
    }

    public function logout()
    {

    }
}
?>