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

        if ($this->user_model->get_active_user() == -1) {
            redirect('login', 'refresh');
        }
    }

    public function index(){
        $active = $this->user_model->get_active_user();
        $user = $this->user_model->get_user_by_id($active)->row();
        $data['user'] = $user;


        $data['products'] = $this->product_model->get_all();

        $data['body'] = $this->load->view('index',$data,true);

        $this->load->view('base',$data);
    }

    public function logout(){
        $this->user_model->logout();
        redirect('login','refresh');
    }


    public function add_product(){
        $active = $this->user_model->get_active_user();
        $user = $this->user_model->get_user_by_id($active)->row();
        $data['user'] = $user;

        if ($user->role <= 0) {
            redirect('/','refresh');
        }


        $data['body'] = $this->load->view('add_product',null,true);
        $this->load->view('base',$data);
    }

    public function confirm_add(){
        $submit = $this->input->post('submit');
        if (isset($submit)){

            $product['name'] = $this->input->post('name');
            $product['about'] = $this->input->post('about');
            $product['price'] = $this->input->post('price');

            $config['upload_path']          = './uploads/products';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|bmp';
            $config['encrypt_name']         = true;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                $product['image'] = $image['file_name'];
            }else{
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error',$error);
                redirect('/dashboard/add_product','refresh');
            }
            $this->product_model->add_product($product);
        }
        redirect('/','refresh');
    }

    public function remove_product($id){
        $active = $this->user_model->get_active_user();
        $user = $this->user_model->get_user_by_id($active)->row();
        $data['user'] = $user;

        if ($user->role <= 0) {
            redirect('/','refresh');
        }

        $this->product_model->remove_product($id);
        redirect('/','refresh');
    }

    public function edit_product($id){
        $active = $this->user_model->get_active_user();
        $user = $this->user_model->get_user_by_id($active)->row();
        $data['user'] = $user;

        if ($user->role <= 0) {
            redirect('/','refresh');
        }

        $product = $this->product_model->get_one($id);
        if ($product == null){
            redirect('/','refresh');
        }

        $data['product'] = $product;
        $data['body'] = $this->load->view('edit_product',$data,true);
        $this->load->view('base',$data);
    }



    public function confirm_edit($id){
        $submit = $this->input->post('submit');
        if (isset($submit)){

            $product['id'] = $id;
            $product['name'] = $this->input->post('name');
            $product['about'] = $this->input->post('about');
            $product['price'] = $this->input->post('price');

            $config['upload_path']          = './uploads/products';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|bmp';
            $config['encrypt_name']         = true;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                $product['image'] = $image['file_name'];
            }
            $this->product_model->edit_product($product);
        }
        redirect('/','refresh');
    }

    public function shopping_list(){
        $active = $this->user_model->get_active_user();
        $user = $this->user_model->get_user_by_id($active)->row();
        $data['user'] = $user;

        $data['tag_active'] = "Shopping List";

        $items = $this->user_product_model->get_by_user($active);
        $data['overall_price'] = 0;
        $data['rows'] = array();
        foreach ($items as $item){
            $pid = $item->product_id;
            $product = $this->product_model->get_one($pid);
            $price = $product->price;
            $data['overall_price'] += $price * $item->items;
            $row = array(
                'pid' => $pid,
                'pname' => $product->name,
                'pprice' => $price,
                'pcount' => $item->items,
                'poprice' => $price * $item->items
            );
            array_push($data['rows'],$row);
        }
        //var_dump($data['rows']);

        $data['body'] = $this->load->view('view_cart',$data,true);

        $this->load->view('base',$data);
    }

    public function add_to_cart($product_id){
        $product = $this->product_model->get_one($product_id);
        if ($product == null) redirect('/','refresh');

        $user_id = $this->user_model->get_active_user();
        $this->user_product_model->add_to_cart($user_id,$product_id);
        redirect('/','refresh');
    }

    public function remove_from_cart(){
        $submit = $this->input->post('submit');
        if (!isset($submit)) return;

        $uid = $this->user_model->get_active_user();
        $pid = $this->input->post('pid');
        $cnt = $this->input->post('cnt');

        $this->user_product_model->remove_from_cart($uid,$pid,$cnt);
        redirect('dashboard/shopping_list','refresh');
    }


    public function chat($user_id = null){
        $active = $this->user_model->get_active_user();
        $user = $this->user_model->get_user_by_id($active)->row();
        $data['user'] = $user;

        if ($user_id == null){
            $user_id = $active;
        }

        $data['thread_id'] = $user_id;
        $data['tag_active'] = "chat";
        $data['body'] = $this->load->view('chat',$data,true);

        $this->load->view('base',$data);
    }

    public function send_message(){

        $data = array(
            'date' => date('Y-m-d H:i:00'),
            'user_id' => $this->input->post('thread'),
            'by_user' => ($this->input->post('sender') == $this->input->post('thread') ? 1 : 0),
            'message' => $this->input->post('message'),
        );

        $this->messages_model->add_message($data);
    }

    public function get_messages(){
        $user_id = $this->input->post('thread');
        $last_ms = $this->input->post('last');

        $messages = $this->messages_model->get_messages($user_id,$last_ms);

        echo json_encode($messages);
    }

    public function talks(){
        $active = $this->user_model->get_active_user();
        $user = $this->user_model->get_user_by_id($active)->row();
        $data['user'] = $user;

        $data['tag_active'] = "chat";

        $threads = $this->messages_model->get_talks();
        $data['users'] = array();

        foreach ($threads as $thread){
            $user = $this->user_model->get_user_by_id($thread->user_id)->row();
            array_push($data['users'],$user);
        }

        $data['body'] = $this->load->view('view_talks',$data,true);

        $this->load->view('base',$data);
    }

    public function talk($user_id = null){
        $active = $this->user_model->get_active_user();
        $user = $this->user_model->get_user_by_id($active)->row();
        $data['user'] = $user;

        if ($user_id == null){
            $user_id = $active;
        }

        $data['thread_id'] = $user_id;
        $data['tag_active'] = "chat";
        $data['body'] = $this->load->view('chat',$data,true);

        $this->load->view('base',$data);
    }
}
