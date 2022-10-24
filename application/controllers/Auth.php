<?php
defined('BASEPATH') or die('No direct script access allowed!');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_login') == true) {
            redirect('dashboard');
        }
    }

    public function index()
    {
        $this->load->view('login');
    }

    public function loginlama()
    {
        $this->load->model('User_Model', 'user');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $check = $this->user->find_by("Select NamaLengkap From hrd_biodata Where Nama_User='" . $username . "'", false);
        if ($check->num_rows() == 1) {
            $user_data = $check->row();
            $NamaLengkap = $user_data->NamaLengkap;
        } else {
            $NamaLengkap = '<---Noname---->';
        }
        //"Select *,'Admin' As level,'".$NamaLengkap."' As NamaLengkap  From hrd_biodata Where Nama_User='". $username."'", false
        $check = $this->user->find_by("Select *,'Admin' As Level, '" . $NamaLengkap . "' As NamaLengkap  From hrd_biodata Where Nama_User='" . $username . "'", false);
        if ($check->num_rows() == 1) {
            $user_data = $check->row();
            if ($password == $user_data->Password) {
                $this->set_session($user_data);
                redirect('dashboard');
            } else {
                $this->error('Login gagal! <br>Password tidak sesuai');
            }
        } else {
            $check = $this->user->find_by("Select *,'Admin' As Level,'" . $NamaLengkap . "' As NamaLengkap From hrd_biodata Where hrd_biodata.Nama_User='" . $username . "'", false);
            if ($check->num_rows() == 1) {
                $user_data = $check->row();
                if ($password == $user_data->Password) {
                    $this->set_session($user_data);
                    redirect('dashboard');
                }
            } else {
                $this->error('Login gagal! <br>User tidak ditemukan');
            }
        }

        redirect('auth');
    }

    private function set_session($user_data)
    {
        $this->load->model('Absensi_model', 'absensi');
        $this->session->set_userdata([
            'id_user' => $user_data->ID_Krj,
            'nama' => $user_data->NamaLengkap,
            'NIK' => $user_data->NIK_Karyawan,
            'User_Name' => $user_data->User_Name,
            'level' => $user_data->Level,
            'foto' => $user_data->Foto,
            'is_login' => true
        ]);

        if ($user_data->level == 'Karyawan') {
            $time = date('H:i:s');
            $absen = $this->absensi->absen_harian_user($user_data->id_user);
            $absen_hari_ini = $absen->num_rows();

            if ($absen_hari_ini < 2) {
                $keterangan = '';
                if ($absen_hari_ini == 1) {
                    $keterangan = 'pulang';
                } else if ($absen_hari_ini == 0) {
                    $keterangan = 'masuk';
                }

                $this->session->set_flashdata('absen_needed', [
                    'href' => base_url('absensi/check_absen/'),
                    'message' => 'Anda belum melakukan absensi'
                ]);
            }
        }

        $this->session->set_flashdata('response', [
            'status' => 'success',
            'message' => 'Selamat Datang ' . $user_data->User_Name
        ]);
    }

    private function error($msg)
    {
        $this->session->set_flashdata('error', $msg);
    }
    public function login()
    {
        $this->load->model('User_Model', 'user');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->db->select('*');
        $this->db->where('Nama_User', $username);
        $this->db->where('Password', $password);
        $this->db->where('Level', 'Admin');
        $user = $this->db->get('hrd_biodata');
        $user_data = $user->row();

        if ($user_data == null) {
            redirect('auth');
        } else {
            $this->set_session($user_data);
            redirect('dashboard');
        }
    }
}
