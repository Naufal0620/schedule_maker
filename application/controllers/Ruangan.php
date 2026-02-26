<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruangan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index() {
        // Ambil data dasar untuk Form Dropdown
        $data['list_ruangan'] = $this->db->order_by('kode', 'ASC')->get('ruangan')->result();
        $data['list_waktu'] = $this->db->order_by('jam_ke', 'ASC')->get('waktu')->result();
        
        $data['hari_ini'] = 'RUANGAN';
        $data['content']  = 'ruangan_view';

        // ==========================================
        // FITUR 1: LOGIKA PENCARIAN JADWAL RUANGAN
        // ==========================================
        $data['jadwal_ruang'] = null;
        if ($this->input->get('cari_jadwal')) {
            $id_ruangan = $this->input->get('id_ruangan');
            $data['ruangan_terpilih'] = $this->db->get_where('ruangan', ['id' => $id_ruangan])->row();

            // Ambil jadwal khusus ruangan ini
            $this->db->select('j.*, m.nama as nama_matkul, m.warna, d.kode as kode_dosen, w.jam_mulai, w.jam_selesai, k.nama_kelas');
            $this->db->from('jadwal j');
            $this->db->join('mata_kuliah m', 'j.id_matkul = m.id');
            $this->db->join('dosen d', 'j.id_dosen = d.id');
            $this->db->join('waktu w', 'j.id_waktu = w.id');
            $this->db->join('kelas k', 'j.id_kelas = k.id');
            $this->db->where('j.id_ruangan', $id_ruangan);
            
            // Urutkan berdasarkan hari (Senin-Minggu) lalu jam
            $this->db->order_by("FIELD(j.hari, 'SENIN', 'SELASA', 'RABU', 'KAMIS', 'JUMAT', 'SABTU', 'MINGGU')");
            $this->db->order_by('w.jam_ke', 'ASC');
            
            // Kelompokkan berdasarkan hari agar rapi di view
            $raw_jadwal = $this->db->get()->result();
            $grouped = [];
            foreach($raw_jadwal as $r) {
                $grouped[$r->hari][] = $r;
            }
            $data['jadwal_ruang'] = $grouped;
        }

        // ==========================================
        // FITUR 2: LOGIKA PENCARIAN RUANGAN KOSONG
        // ==========================================
        $data['ruangan_kosong'] = null;
        if ($this->input->get('cari_kosong')) {
            $hari = $this->input->get('hari');
            $jam_mulai = $this->input->get('jam_mulai');     // ID dari tabel waktu
            $jam_selesai = $this->input->get('jam_selesai'); // ID dari tabel waktu

            // Ambil urutan jam_ke untuk rentang waktu
            $w_start = $this->db->get_where('waktu', ['id' => $jam_mulai])->row()->jam_ke;
            $w_end   = $this->db->get_where('waktu', ['id' => $jam_selesai])->row()->jam_ke;

            // Subquery: Cari ruangan yang SEDANG DIPAKAI pada hari dan rentang waktu tsb
            $this->db->select('id_ruangan');
            $this->db->from('jadwal j');
            $this->db->join('waktu w', 'j.id_waktu = w.id');
            $this->db->where('j.hari', $hari);
            $this->db->where("w.jam_ke >=", $w_start);
            $this->db->where("w.jam_ke <=", $w_end);
            $ruangan_terpakai = $this->db->get_compiled_select();

            // Query Utama: Tampilkan semua ruangan KECUALI yang terpakai di atas
            if (!empty($ruangan_terpakai)) {
                $this->db->where("id NOT IN ($ruangan_terpakai)", NULL, FALSE);
            }

            $data['content'] = 'ruangan_view'; // Memanggil view konten baru
            $data['data'] = [
                'info_cari_kosong' => [
                    'hari' => $hari,
                    'mulai' => $this->db->get_where('waktu', ['id' => $jam_mulai])->row()->jam_mulai,
                    'selesai' => $this->db->get_where('waktu', ['id' => $jam_selesai])->row()->jam_selesai
                ],
                'ruangan_kosong' => $this->db->order_by('kode', 'ASC')->get('ruangan')->result(),
            ];
        }

        $this->load->view('layout_view', $data);
    }
}