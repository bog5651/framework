<?php
class UserModel extends Model
{

    public function getUserById($id)
    {
        $ret = null;
        $res = $this->db->query('SELECT 
        u.id_user,
        firstname,
        secondname,
        login,
        r.name
    FROM users u
    INNER JOIN permissons p ON p.id_user = u.id_user
    INNER JOIN roles r ON p.id_role = r.id_role
    WHERE u.id_user = ?', [$id]);
        if (!empty($res)) {
            return $res[0];
        }
        return -1;
    }

    public function getUsers() : array
    {
        $res = $this->db->query('SELECT 
            u.id_user,
            firstname,
            secondname,
            login,
            r.name
        FROM users u
        INNER JOIN permissons p ON p.id_user = u.id_user
        INNER JOIN roles r ON p.id_role = r.id_role');
        if (!empty($res)) {
            return $res;
        } else {
            echo $this->db->getError();
        }
    }

    public function addUser(string $login, string $password, string $fisrtname, string $secondname, int $role_id) : int
    {
        $res = $this->db->query('INSERT INTO users (login, password, firstname, secondname) VALUES (?, ?, ?, ?);', [
            $login,
            md5($password),
            $fisrtname,
            $secondname
        ]);
        if ($res) {
            $user_id = $this->db->getlastId();
            $res = $this->db->query('INSERT INTO permissons (id_user, id_role) VALUES (?,?);', [
                $user_id,
                $role_id
            ]);
            return $user_id;
        }
        return -1;
    }

    public function deleteUser(string $userId) : bool
    {
        $res = $this->db->query('DELETE FROM users WHERE id_user = ?', [$userId]);
        if ($res) {
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

    public function getPermission(int $id)
    {
        $row = $this->db->query('
        SELECT name, weight FROM permissons p
        INNER JOIN users u ON
            u.id_user = p.id_user
        INNER JOIN roles r ON
            p.id_role = r.id_role
        WHERE u.id_user = ?
        ', [$id]);
        if (!empty($row)) {
            return $row[0];
        }
        return false;
    }
}