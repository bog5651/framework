<?php
class RequestModel extends Model
{

    public function getRequestById(int $id)
    {
        $row = $this->db->query('
        Select user_address, time_reqest, time_delivery, cost 
        From reqests 
        Where id_reqest = ?', [$id]);
        if (!empty($row)) {
            return $row[0];
        }
        return false;
    }

    public function add(string $address, string $time_request, string $time_delivery, int $cost, array $requests)
    {
        $row = $this->db->query('INSERT INTO reqests (user_address, time_reqest, time_delivery, cost) VALUES (?, ?, ?, ?);', [$address, $time_request, $time_delivery, $cost]);
        if (!$row) {
            echo json_encode($this->db->getError());
            return $row;
        }
        $id = $this->db->getLastId();
        foreach ($requests as $request) {
            $row = $this->db->query('INSERT INTO structureRequsts (id_request, id_izdeliya, count_izdeliu) VALUES (?,?,?)', [$id, $request->id_pizza, $request->count]);
            if (!$row) {
                echo json_encode($this->db->getError());
                return $row;
            }
        }
        if ($row)
            return $row;
        else
            return $row;
    }

    public function delete(int $id)
    {

    }
}
?>