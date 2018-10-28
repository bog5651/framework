<?php
class PizzaModel extends Model
{

    public function getPizzaById(int $id)
    {
        $row = $this->db->query('
        Select name, cost 
        From izdeliya 
        Where id_izdelie = ?;', [$id]);
        if (!empty($row)) {
            return $row[0];
        }
        return false;
    }

    public function getAllPizza()
    {
        $row = $this->db->query('
        Select name, cost 
        From izdeliya;', []);
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

    public function add(string $name, int $cost)
    {

    }

    public function delete(int $id)
    {

    }
}
?>