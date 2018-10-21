<?php
class UserModel extends Model
{

    public function getUserById($id)
    {
        $ret = null;
        $res = $this->db->query('SELECT 
      id_user,
      firstname,
      secondname,
      login
    FROM users WHERE id_user = ?', [$id]);
        if (!empty($res)) {
            $ret = $res[0];
        }
        return $ret;
    }

    public function getUsers() : array
    {
        $res = $this->db->query('SELECT 
            id_user,
            firstname,
            secondname,
            login
        FROM users');
        if (!empty($res)) {
            return $res;
        } else {
            echo $this->db->getError();
        }
    }

    public function addUser(string $login, string $password, string $fisrtname, string $secondname) : int
    {
        $res = $this->db->query('INSERT INTO users (login, password, firstname, secondname) VALUES (?, ?, ?, ?);', [
            $login,
            md5($password),
            $fisrtname,
            $secondname
        ]);
        if ($res) {
            return $this->db->getlastId();
        }
        return -1;
    }

    public function deleteUser(string $userId) : bool
    {
        $res = $this->db->query('DELETE FROM users WHERE id_user = ?',[$userId]);
        if($res)
        {
            return true;
        }
        return false;
    }

    public function login(string $login, string $password) : int
    {
        $res = $this->db->query('SELECT id_user FROM users WHERE login = ? AND password = ?;', [$login, md5($password)]);
        if ($res) {
            return $res[0]['id_user'];
        }
        return -1;
    }

    public function updateUser(int $id, string $firstname, string $secondname, string $login)
    {
        return $this->db->query('
        UPDATE users SET
            firstname = ?,
            secondname = ?,
            login = ?
        WHERE id_user = ?  
        ', [
            $firstname,
            $secondname,
            $login,
            $id
        ]);
    }

    public function changePassword(int $id, string $password)
    {
        return $this->db->query('
        UPDATE users SET
            password = ?
        WHERE id_user = ?  
      ', [
            md5($password),
            $id
        ]);
    }
}