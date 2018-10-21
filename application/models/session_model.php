<?php
class SessionModel extends Model
{
    public function login($login, $password) : string
    {
        $token = '';
        $user_model = $this->loader->getModel('user');
        $id = $user_model->login($login, $password);
        if ($id > 0) {
            $token = md5($id . '_' . $login . '_' . time());
            while ($this->checkToken($token)) {
                $token = md5($id . '_' . $login . '_' . time());
            }
            $res = $this->db->query('INSERT INTO sessions (token, id_user) VALUES (?, ?)', [$token, $id]);
            if (!$res) {
                $token = '';
            }
        }
        return $token;
    }

    public function logout($token) : bool
    {
        if ($this->checkToken($token)) {
            $this->db->query('DELETE FROM sessions WHERE token = ?', [$token]);
        }
        return true;
    }

    public function authentication($token) : int
    {
        $res = $this->db->query('SELECT id_user FROM sessions WHERE token = ?', [$token]);
        if (!empty($res)) {
            return $res[0]['id_user'];
        }
        return -1;
    }

    private function checkToken(string $token) : bool
    {
        $res = $this->db->query('SELECT id_session FROM sessions WHERE token = ?', [$token]);
        return !empty($res);
    }

}
?>