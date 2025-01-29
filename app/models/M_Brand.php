<?php
class M_Brand
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function insertBrand($data)
    {
        $this->db->query('INSERT INTO brand (brand_name, brand_slug_url, brand_category_name) VALUES (:brand_name, :brand_slug_url, :brand_category_name)');
        $this->db->bind(':brand_name', $data['brandName']);
        $this->db->bind(':brand_slug_url', $data['brandSlug']);
        $this->db->bind(':brand_category_name', $data['brandCategoryName']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function findBrand($name)
    {
        $this->db->query('SELECT * FROM brand WHERE LOWER(brand_name) = LOWER(:brand_name)');
        $this->db->bind(':brand_name', $name);

        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getBrandById($id)
    {
        $this->db->query('SELECT * FROM brand WHERE brand_id = :brand_id');
        $this->db->bind(':brand_id', $id);

        $row = $this->db->single();

        return $row;
    }

    public function getBrandCategoryById($id)
    {
        $this->db->query('SELECT * FROM brand WHERE brand_category_name = :brand_category_name');
        $this->db->bind(':brand_category_name', $id);

        return $this->db->resultSet();
    }

    public function deleteBrand($id)
    {
        $this->db->query('SELECT active_state FROM brand WHERE brand_id = :brand_id');
        $this->db->bind(':brand_id', $id);
        $current_state = $this->db->single()->active_state;

        $new_state = ($current_state == 1) ? 0 : 1;

        $this->db->query('UPDATE brand SET active_state = :active_state WHERE brand_id = :brand_id');
        $this->db->bind(':brand_id', $id);
        $this->db->bind(':active_state', $new_state);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateBrand($data)
    {
        $this->db->query('UPDATE brand SET brand_name = :brand_name, brand_slug_url = :brand_slug_url, brand_category_name = :brand_category_name WHERE brand_id = :brand_id');
        $this->db->bind(':brand_name', $data['brandName']);
        $this->db->bind(':brand_slug_url', $data['brandSlug']);
        $this->db->bind(':brand_category_name', $data['brandCategoryName']);
        $this->db->bind(':brand_id', $data['brandId']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getCartItems()
    {
        $this->db->query('SELECT * FROM cart');
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getProductById($id)
    {
        $this->db->query('SELECT * FROM product WHERE product_id = :product_id');
        $this->db->bind(':product_id', $id);
        $this->db->execute();
        return $this->db->single();
    }
}
?>