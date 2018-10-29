<?php
class PizzaModel extends Model
{

    public function getPizzaById(int $id)
    {
        $row = $this->db->query('
        SELECT name, cost 
        FROM izdeliya 
        WHERE id_izdelie = ?', [$id]);
        if (!empty($row)) {
            return $row[0];
        }
        return false;
    }

    public function getAllPizza()
    {
        $row = $this->db->query('
        SELECT id_izdelie AS id, name, cost
        FROM izdeliya');
        if (!empty($row)) {
            return $row;
        }
        return false;
    }

    public function getStructureByPizzaId(int $PizzaId)
    {
        $row = $this->db->query('
        Select product_name, count_product, unit 
        From structureIzdeliy s 
        INNER JOIN products p ON 
            s.id_product = p.id_product
        WHERE id_izdeliya = ?', [$PizzaId]);
        if (!empty($row)) {
            return $row;
        }
        return false;
    }

    public function add(string $name, int $cost, array $struct)
    {
        $row = $this->db->query('INSERT INTO izdeliya (name, cost) VALUES (?, ?)', [$name, $cost]);
        if (!$row) {
            echo json_encode($this->db->getError());
            return $row;
        }
        $id = $this->db->getLastId();
        foreach ($struct as $product) {
            $row = $this->db->query('INSERT INTO structureIzdeliy (id_product, id_izdeliya, count_product) VALUES (?,?,?)', [$product->product_id, $id, $product->count]);
            if (!$row) {
                echo json_encode($this->db->getError());
                return $row;
            }
        }
        if ($row)
            return $id;
        else
            return -1;
    }

    public function delete(int $id)
    {

    }
}
?>