<?php

class User_product_model extends CI_Model{

    public function get_cart($user,$product){
        $query = $this->db->where('user_id',$user)->where('product_id',$product)->get('user_product')->row();
        return $query;
    }


    public function add_to_cart($user,$product){
        $data = array(
            'user_id' => $user,
            'product_id' => $product,
            'items' => 1
        );


        $query = $this->get_cart($user,$product);
        if ($query != null){
            $items = $query->items;
            $items++;
            $data['items'] = $items;
            $this->db->where('user_id',$user)->where('product_id',$product)->update('user_product',$data);
            return;
        }

        $this->db->insert('user_product',$data);
    }

    public function remove_from_cart($user,$product,$cnt){
        while ($cnt > 0){
            $query = $this->get_cart($user,$product);
            if ($query == null) break;
            if ($query->items <= 1){
                $this->db->where('user_id',$user)->where('product_id',$product)->delete('user_product');
                break;
            }else{
                $items = $query->items;
                $items--;
                $data = array(
                    'user_id' => $user,
                    'product_id' => $product,
                    'items' => $items
                );
                $this->db->where('user_id',$user)->where('product_id',$product)->update('user_product',$data);
            }
            $cnt--;
        }
    }


    public function get_by_user($user){
        $query = $this->db->where('user_id',$user)->get('user_product')->result();
        return $query;
    }
}