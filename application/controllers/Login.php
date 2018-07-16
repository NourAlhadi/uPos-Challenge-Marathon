<?php

/**
 * Class Login, control the login / registration process
 */
class Login extends CI_Controller {


    /**
     * Check the submitted form, and set the correct action
     */
    public function index(){

        // Get the active form
        $sign_in = $this->input->post('signin');
        $sign_up = $this->input->post('signup');

        // Sign In process
        if ( isset($sign_in) ){

            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $remember = $this->input->post('remember');

            $data = array(
                'username'=>$username,
                'password'=>$password,
                'remember'=>$remember
            );

            $message = $this->user_model->login($data);

            if (strpos($message,'Error') === false){
                redirect('/','refresh');
            }

            $_SESSION['register_message'] = $message;
            $this->session->mark_as_flash('register_message');

        // Register process
        }else if (isset($sign_up)){
            $message = $this->user_model->register();
            $_SESSION['register_message'] = $message;
            $this->session->mark_as_flash('register_message');
        }


        $this->load->view('login');
    }


}