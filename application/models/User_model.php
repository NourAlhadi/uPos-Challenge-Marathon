<?php


/**
 * Class user_model, used to control user actions
 */
class user_model extends CI_Model {

    /**
     * Get all users in system
     *
     * @return user_model[], all users on system
     */
    public function get_users(){
        $query = $this->db->get('user');
        return $query;
    }

    /**
     * Get a user by his id
     *
     * @param $user_id, the id of requested user
     * @return user_model, the requested user
     */
    public function get_user_by_id($user_id){
        $query = $this->db->where('id',$user_id)->get('user');
        return $query;
    }

    /**
     * Get a user by his username
     *
     * @param $user_username, the username of requested user
     * @return user_model, the requested user
     */
    public function get_user_by_username($user_username){
        $query = $this->db->where('username',$user_username)->get('user');
        return $query;
    }


    /**
     * Get the active user on system
     *
     * @return int, the id of active user
     */
    public function get_active_user(){
        if (!isset($_SESSION['user_id'])){
            return -1;
        }else{
            return $_SESSION['user_id'];
        }
    }

    /**
     * Register a user to the system
     *
     * @return string, the action message
     */
    public function register(){


        // Get data from input
        $fullname = $this->input->post('fullname');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $pass_con = $this->input->post('confirmpassword');


        // Error if user with the same username exists
        if ($this->get_user_by_username($username)->num_rows() != 0) {
            return "Error: A User with the same user name exists";
        }

        // Error if password and confirmation doesn't match
        if ($password != $pass_con){
            return "Error: Your password and confirmation doesn't match";
        }


        // Encrypt the password
        $pass = $this->bcrypt->hash_password($password);

        // Setup data to be submitted
        $data = array(
            "username"=>$username,
            "fullname"=>$fullname,
            "email"=>$email,
            "password_hash"=>$pass
        );

        // Insert user to database
        $this->db->insert('user',$data);
        return "Success: User Registered";
    }


    /**
     * Login to system
     *
     * @param $data, the data submitted to login form
     * @return string, the action message
     */
    public function login($data){
        // Get data
        $username = $data['username'];
        $password = $data['password'];
        $remember = $data['remember'];

        // Check if data is correct
        $user = $this->get_user_by_username($username);
        if ($user->num_rows() != 1){
            return "Error: Incorrect Username";
        }else{
            $hash = $user->row()->password_hash;
            if (!$this->bcrypt->check_password($password,$hash)){
                return "Error: Incorrect Password";
            }
            $_SESSION['user_id'] = $user->row()->id;
        }

        // Check if user asked the system for him to be remembered
        // Algorithm used from: https://paragonie.com/blog/2015/04/secure-authentication-php-with-long-term-persistence#title.2.1
        // Selector / validator user long term remember algorithm
        if ($remember == "on"){

            $selector = md5(uniqid());
            $selector = substr($selector, 0, 255);
            $validator = $selector . $user->row()->fullname;
            $value = json_encode(array('selector'=>$selector,'validator'=>$validator));

            $cookie= array(
                'name'   => 'remember',
                'value'  => $value,
                'expire' => '865000',
                'domain' => '.localhost'
            );
            $this->input->set_cookie($cookie);


            $validator = $this->bcrypt->hash_password($validator);

            $auth_data = array(
                "selector"=>$selector,
                "hashedValidator"=>$validator,
                "userid"=>$user->row()->id,
                "expires"=>date('Y-m-d H:i:s')
            );

            $this->load->model('auth_token_model');
            $this->auth_token_model->add_token($auth_data);
        }


        return "Welcome back " . $user->row()->fullname . "!!";
    }

    /**
     * Logs the user out of the system
     */
    public function logout(){

        // Get the activated cookie
        $cookie = get_cookie('remember');

        // Destroy data from cookkie
        if ($cookie != null){
            $data = json_decode($cookie);
            $this->auth_token_model->remove_token_using_selector($data->selector);
            delete_cookie("remember");
        }

        // Unset the active user
        unset($_SESSION['user_id']);
    }

}