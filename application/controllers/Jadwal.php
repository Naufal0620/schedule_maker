<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index() {
        $id_kelas = $this->session->userdata('id_kelas');
        
        // Query ambil SEMUA jadwal kelas ini
        $this->db->select('j.*, m.nama as nama_matkul, m.warna, d.kode as kode_dosen, r.kode as kode_ruang, w.jam_mulai, w.jam_selesai');
        $this->db->from('jadwal j');
        $this->db->join('mata_kuliah m', 'j.id_matkul = m.id');
        $this->db->join('dosen d', 'j.id_dosen = d.id');
        $this->db->join('ruangan r', 'j.id_ruangan = r.id');
        $this->db->join('waktu w', 'j.id_waktu = w.id');
        $this->db->where('j.id_kelas', $id_kelas);
        
        // PENTING: Order by Hari (Custom Order) lalu Jam
        // Kita paksa urutan Senin -> Sabtu
        $this->db->order_by("FIELD(j.hari, 'SENIN', 'SELASA', 'RABU', 'KAMIS', 'JUMAT', 'SABTU', 'MINGGU')");
        $this->db->order_by('w.jam_ke', 'ASC');
        
        $raw_jadwal = $this->db->get()->result();

        // Grouping Data per Hari agar mudah di-loop di View
        $grouped_jadwal = [];
        foreach($raw_jadwal as $row) {
            $grouped_jadwal[$row->hari][] = $row;
        }

        $data['hari_ini'] = 'JADWAL'; // Judul Header
        $data['content'] = 'jadwal_view'; // Memanggil view konten baru
        $data['grouped_jadwal'] = $grouped_jadwal;
        
        $this->load->view('layout_view', $data);
    }
}