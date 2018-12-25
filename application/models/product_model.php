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

    public function add(string $name, int $cost, string $unit)
    {
        $row = $this->db->query('INSERT INTO products (product_name, cost, unit) VALUES (?,?,?)', [
            $name,
            $cost,
            $unit
        ]);
        if (!empty($row)) {
            return $this->db->getLastId();
        }
        return false;
    }

    public function delete(int $id)
    {
        $row = $this->db->query('DELETE FROM products p WHERE p.id_product = ? ', [$id]);
        if (!empty($row)) {
            return $row;
        }
        return false;
    }
}
?>