<?php
class RequestModel extends Model
{

    public function getRequestById(int $id)
    {
        $row = $this->db->query('
        Select user_address, time_reqest, time_delivery, cost 
        From reqests 
        Where id_reqest = ?;', [$id]);
        if (!empty($row)) {
            return $row[0];
        }
        return false;
    }

    public function add(string $name, int $cost)
    {

    }

    public function delete(int $id)
    {

    }
}
?>