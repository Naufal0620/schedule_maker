<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function index() {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }

        $this->load->view('login_view');
    }

    public function process() {
        // 2. Form Validation
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kembalikan ke halaman login dengan error
            $this->load->view('login_view');
        } else {
            // Jika validasi sukses, lanjut cek database
            $this->_login();
        }
    }

    private function _login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('pengguna', ['username' => $username])->row();

        if ($user) {
            // Cek password (masih plain text sesuai database demo)
            if ($password == $user->password) { 
                $session_data = array(
                    'user_id'   => $user->id,
                    'nama'      => $user->nama_lengkap,
                    'id_kelas'  => $user->id_kelas,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($session_data);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Password salah!');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('error', 'Username tidak terdaftar!');
            redirect('auth');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}