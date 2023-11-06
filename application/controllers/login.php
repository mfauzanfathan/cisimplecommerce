<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');
class Login extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Loginmodel');
    }
    public function index($renderData=""){
        $this->load->view('pages/login');
    }
    public function submitLogin() {
        if($this->input->post('Login')) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            if($this->Loginmodel->cekLogin($username,$password)) {
                $data = $this->Loginmodel->getDataforsession($username,$password);
                $data = array('username'=>$data['user'],'nama'=>$data['nama']);
                $this->session->set_userdata($data);
                redirect(base_url('index.php/home'));
            }else{
                $this->data['error'] = "Username atau password salah";
                $this->load->view('pages/login',$this->data);
            }
        }else{
            redirect(base_url('index.php/login'));
            echo "nologin";
        }
    }   
}