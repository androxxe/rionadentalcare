<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mlogin');
    }
    public function index()
    {
        if ($this->session->userdata('authenticated'))
            redirect('m');
        $this->load->view('login');
    }
    public function login()
    {
        $username     = $this->input->post('username');
        $level         = $this->input->post('level');
        $password     = $this->input->post('password');
        $user         = $this->Mlogin->get($username, $level);

        if (empty($user)) {
            $this->session->set_flashdata('message', 'Username tidak ditemukan');
            redirect('auth');
        } else {
            if (password_verify($password, $user->password)) {
                $session = array(
                    'authenticated'     => true,
                    'username'             => $user->username,
                    'nama'                => $user->nama,
                    'level'             => $level
                );
                $this->session->set_userdata($session);

                redirect('m');
            } else {
                $this->session->set_flashdata('message', '<b>Username</b> dan <b>Password</b> tidak cocok');
                redirect('auth');
            }
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
