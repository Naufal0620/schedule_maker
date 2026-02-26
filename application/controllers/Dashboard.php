<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index() {
        $id_kelas = $this->session->userdata('id_kelas');
        
        // Ambil Hari Ini (Format Indonesia)
        $hari_indonesia = array(
            'Sunday' => 'MINGGU', 'Monday' => 'SENIN', 'Tuesday' => 'SELASA',
            'Wednesday' => 'RABU', 'Thursday' => 'KAMIS', 'Friday' => 'JUMAT', 'Saturday' => 'SABTU'
        );
        $hari_ini = $hari_indonesia[date('l')];
        
        // Query Jadwal Hari Ini + Join Tabel Lain
        $this->db->select('j.*, m.nama as nama_matkul, m.warna, d.kode as kode_dosen, r.kode as kode_ruang, w.jam_mulai, w.jam_selesai, w.jam_ke');
        $this->db->from('jadwal j');
        $this->db->join('mata_kuliah m', 'j.id_matkul = m.id');
        $this->db->join('dosen d', 'j.id_dosen = d.id');
        $this->db->join('ruangan r', 'j.id_ruangan = r.id');
        $this->db->join('waktu w', 'j.id_waktu = w.id');
        $this->db->where('j.id_kelas', $id_kelas); // Filter sesuai kelas user
        $this->db->where('j.hari', $hari_ini);      // Filter hari ini
        // Filter blok bisa ditambahkan jika ada selektor semester/blok
        $this->db->order_by('w.jam_ke', 'ASC');
        
        $data['content'] = 'dashboard_view';
        $data['hari_ini'] = $hari_ini;
        $data['data'] = [
            'jadwal' => $this->db->get()->result(),
        ];
        
        $this->load->view('layout_view', $data);
    }
}