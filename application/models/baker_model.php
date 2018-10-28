<?php
class BakerModel extends Model
{
    public function getBakerById(int $td)
    {
        $row = $this->db->query('
        Select baker_name, salary  
        From bakers 
        Where id_baker = ?;', [$id]);
        if (!empty($row)) {
            return $row[0];
        }
        return false;
    }

    public function getAllBakers()
    {
        $row = $this->db->query('
        Select baker_name, salary 
        From bakers;', [$id]);
        if (!empty($row)) {
            return $row;
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