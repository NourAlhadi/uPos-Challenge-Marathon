<?php

class Messages_model extends CI_Model{

    public function get_messages($user_id,$last_msg = -1){
        $query = $this->db->where('user_id',$user_id)->where('msg_id >',$last_msg)->get('messages')->result();
        return $query;
    }

    public function add_message($data){
        $this->db->insert('messages',$data);
    }


    public function get_talks(){
        $this->db->select('user_id');
        $this->db->distinct();
        $query = $this->db->get('messages')->result();
        return $query;
    }

}