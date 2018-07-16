<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct(){
        parent::__construct();

        $cookie = get_cookie('remember');
        if ($this->user_model->get_active_user() == -1) {
            if ($cookie != null) {
                $data = json_decode($cookie);
                $this->auth_token_model->get_token($data->selector,$data->validator);
            }
        }
    }

    public function index(){

        if ($this->user_model->get_active_user() == -1) {
            redirect('login', 'refresh');
        }

        $user = $this->user_model->get_active_user();
        $user = $this->user_model->get_user_by_id($user)->row();
        $data['user'] = $user;
        $this->load->view('base',$data);
    }

    public function logout(){
        if ($this->user_model->get_active_user() == -1){
            redirect('login','refresh');
        }

        $this->user_model->logout();
        redirect('login','refresh');
    }


}
