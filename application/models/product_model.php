<?php
class ProductModel extends Model
{
    public function getProductById(int $id)
    {
        $row = $this->db->query('
        Select product_name, unit, cost  
        From products 
        Where id_product = ?', [$id]);
        if (!empty($row)) {
            return $row[0];
        }
        return false;
    }

    public function getAllProducts()
    {
        $row = $this->db->query('
        Select  id_product AS id, product_name, unit, cost 
        From products');
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