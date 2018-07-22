<?php

class Product_model extends CI_Model{

    public function get_all(){
        $query = $this->db->get('product')->result();
        return $query;
    }

    public function get_one($product_id){
        $query = $this->db->where('id',$product_id)->get('product')->row();
        return $query;
    }

    public function add_product($product){
        $this->db->insert('product',$product);
    }

    public function remove_product($product_id){

        $product = $this->get_one($product_id);
        $image = $product->image;
        unlink("./uploads/products/" . $image);

        $this->db->where('id',$product_id)->delete('product');
    }

    public function edit_product($product){
        $old = $this->get_one($product['id']);
        if (!isset($product['image'])) $product['image'] = $old->image;
        else{
            unlink("./uploads/products/" . $old->image);
        }
        $this->db->where('id',$product['id'])->update('product',$product);
    }

}