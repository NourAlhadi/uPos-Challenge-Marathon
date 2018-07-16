<?php

/**
 * Class Auth_token_model used to control the tokens related to remember me
 */
class Auth_token_model extends CI_Model {

    /**
     * Add a token when user login and ask the app to remember him!!
     *
     * @param $data the token data to be added.
     */
    public function add_token($data){
        // Delete previous user token if any
        $this->db->where('userid',$data['userid'])->delete('auth_token');
        // Add new token to database
        $this->db->insert('auth_token',$data);
    }

    /**
     * Remove a token by id
     *
     * @param $id, remove a token by it's id
     */
    public function remove_token_using_id($id){
        $this->db->where('id',$id)->delete('auth_token');
    }


    /**
     * Remove a token by selector
     *
     * @param $selector, remove a token by it's selector
     */
    public function remove_token_using_selector($selector){
        $this->db->where('selector',$selector)->delete('auth_token');
    }

    /**
     * Get a token from user and verify it with the one in the database.
     *
     * @param $selector, the selector of token
     * @param $validator, validator of user without hash
     */
    public function get_token($selector,$validator){
        // Get token by selector
        $query = $this->db->where('selector',$selector)->get('auth_token');

        // If no such token return
        if ($query->num_rows() != 1) return;

        // Compare validator from user with one stored in the database
        if (!$this->bcrypt->check_password($validator,$query->row()->hashedValidator)){
            $this->remove_token_using_id($query->row()->id);
            return;
        }

        // If everything is correct submit the active user
        $_SESSION['user_id']=$query->row()->userid;
    }

}