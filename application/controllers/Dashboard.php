<?php
defined('BASEPATH') or die('No direct script access allowed!');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->userdata('is_login') != true) {
            redirect('auth');
        }
        $this->load->model('karyawan_model');
        $this->load->model('gaji_model');
        $this->load->model('absensi_model');
    }
    public function Timestamp()
    {
        date_default_timezone_set('Asia/Jakarta'); //Menyesuaikan waktu dengan tempat kita tinggal
        echo $timestamp = date('H:i:s'); //Menampilkan Jam Sekarang
    }

    public function index()
    {
        /*$users = $this->crud->getDataQuery("SELECT * FROM hrd_gajikarywan JOIN hrd_joinbagian ON hrd_joinbagian.ID_Krj=hrd_gajikarywan.ID_Krj 
        WHERE hrd_joinbagian.Tanggal_Keluar = NULL OR hrd_joinbagian.Tanggal_Keluar = 0000-00-00
        GROUP BY hrd_joinbagian.ID_Krj ORDER BY hrd_gajikarywan.id, hrd_joinbagian.Jabatan,hrd_joinbagian.Devisi ")->result();
        */
        $this->db->select('*');
        $this->db->from('hrd_gajikarywan');
        $this->db->where('hrd_gajikarywan.Aktif', '1');
        $this->db->join('hrd_joinbagian', 'hrd_joinbagian.ID_Krj=hrd_gajikarywan.ID_Krj');
        $this->db->where('hrd_joinbagian.Tanggal_Keluar', NULL);
        $this->db->or_where('hrd_joinbagian.Tanggal_Keluar', '0000-00-00');
        $this->db->group_by('hrd_joinbagian.ID_Krj');
        $this->db->order_by('hrd_joinbagian.id');
        $this->db->order_by('hrd_joinbagian.Devisi');
        $this->db->order_by('hrd_joinbagian.Jabatan');
        $this->db->distinct('ID_Krj');
        $data['users'] = $this->db->get()->result();
        $data['title'] = 'List Karyawan';
        $data['breadcrumb'] = '';
        //$data['users'] = $users;

        $this->template->viewAdmin('GajiKaryawan', $data);
    }

    public function Absensi()
    {
        $id_user = $this->uri->segment(3) ? $this->uri->segment(3) : $this->session->id_user;
        $nama = $this->uri->segment(3) ? $this->uri->segment(3) : $this->session->nama;
        $tahun = $this->input->get('tahun') ? $this->input->get('tahun') : date('Y');
        $bulan = $this->input->get('bulan') ? $this->input->get('bulan') : date('m');

        $data['title'] = 'Absensi ';
        $data['all_bulan'] = bulan();
        $data['breadcrumb'] = '';
        $data['Karyawan'] = $this->crud->getDataQuery("SELECT * From karyawan,karyawanjobdesctable,detailkaryawan Where karyawan.id_Karyawan=karyawanjobdesctable.id_Karyawan AND karyawanjobdesctable.PersonUniqueID=detailkaryawan.PersonUniqueID And karyawan.id_Karyawan='" . $id_user . "'")->row();

        // $data['jam_kerja'] = (array) $this->jam->get_all();

        if (isset($bulan) && isset($tahun)) {
            $data['bulan'] = $bulan;
            $data['tahun'] = $tahun;
            $data['absen'] = $this->crud->getDataQuery("Select * from absensiharian Where id_Karyawan='" . $id_user . "' And MONTH(TglAbsensi_Karyawan)=" . $bulan . " And YEAR(TglAbsensi_Karyawan)=" . $tahun)->result();
            $data['hari'] = hari_bulan($bulan, $tahun);
            $data['libur'] = $this->crud->getDataQuery("Select * From hari_libur WHERE MONTH(Date)=" . $bulan . " And YEAR(Date)=" . $tahun)->result();
        } else {
            $data['bulan'] = date('m');
            $data['tahun'] = date('Y');
            $data['absen'] = $this->crud->getDataQuery("Select * from absensiharian Where id_Karyawan='" . $id_user . "' And MONTH(TglAbsensi_Karyawan)=" . date('m') . " And YEAR(TglAbsensi_Karyawan)=" . date('Y'))->result();
            $data['hari'] = hari_bulan(date('m'), date('Y'));
        }

        $data['crud'] = $this->crud;
        $this->template->viewAdmin('absensi/Kartu_absensi', $data);
    }

    public function Inputkar()
    {
        $type = $this->uri->segment(3);
        $this->db->select('*');
        $this->db->where('Waktu', $type);
        $data['kdgaji'] = $this->db->get('hrd_waktugajian')->result_array();
        $data['kdcabang'] = $this->db->get('hrd_cabang')->result();
        $data['kdjbtn'] = $this->db->get('hrd_jabatan')->result();
        $data['kddiv'] = $this->db->get('hrd_divisi')->result();

        $data['title'] = 'Input Karyawan Harian';
        $data['breadcrumb'] = '';
        $this->template->viewAdmin('input/InputKary', $data);
    }

    public function Karyawan()
    {
        // $users =$this->crud->selectAllOrderby('detailkaryawan','NIK_Karyawan','asc')->result();
        // $users=$this->crud->getDataQuery("SELECT * FROM karyawan LEFT OUTER JOIN daftarpecatan ON karyawan.id_Karyawan=daftarpecatan.id_Karyawan,detailkaryawan WHERE karyawan.NIK_Karyawan=detailkaryawan.NIK_Karyawan ORDER BY karyawan.Subbagian,karyawan.bagian,karyawan.NIK_Karyawan")->result();

        // $users = $this->crud->getDataQuery("SELECT * FROM hrd_biodata JOIN hrd_joinbagian on hrd_joinbagian.ID_Krj=hrd_biodata.ID_Krj GROUP BY hrd_biodata.NamaLengkap ORDER BY hrd_joinbagian.Devisi,hrd_joinbagian.Jabatan")->result();
        // $this->db->select('*');
        // $this->db->order_by('id', 'ASC');
        // $data['users'] = $this->db->get('hrd_biodata')->result();

        $this->db->select('*');
        $this->db->from('hrd_biodata');
        $this->db->join('hrd_joinbagian', 'hrd_joinbagian.ID_Krj=hrd_biodata.ID_Krj');
        // $this->db->where('hrd_joinbagian.Tanggal_Keluar', NULL);
        // $this->db->or_where('hrd_joinbagian.Tanggal_Keluar', '0000-00-00');
        $this->db->group_by('hrd_biodata.ID_Krj');
        $this->db->order_by('hrd_joinbagian.id');
        $this->db->order_by('hrd_joinbagian.Devisi');
        $this->db->order_by('hrd_joinbagian.Jabatan');
        $this->db->distinct('ID_Krj');
        $data['users'] = $this->db->get()->result();

        $data['title'] = 'Info Karyawan';
        $data['breadcrumb'] = '';
        $this->template->viewAdmin('Karyawan', $data);
    }
    public function Bagian()
    {
        $this->db->select('*');
        $this->db->from('hrd_biodata');
        $this->db->join('hrd_joinbagian', 'hrd_joinbagian.ID_Krj=hrd_biodata.ID_Krj');
        $this->db->group_by('hrd_biodata.ID_Krj');
        $this->db->order_by('hrd_joinbagian.id');
        $this->db->order_by('hrd_joinbagian.Devisi');
        $this->db->order_by('hrd_joinbagian.Jabatan');
        //$this->db->distinct('ID_Krj');
        // $data['users'] = $this->db->get()->result();
        // $users =$this->crud->selectAllOrderby('hrd_joinbagian','id','asc')->result();
        // $data['title'] = 'Daftar Bagian';
        // $data['breadcrumb'] = '';
        // $data['users'] = $users;
        $data['users'] = $this->db->get()->result();
        $data['title'] = 'Karyawan Bagian';
        $data['breadcrumb'] = '';
        $this->template->viewAdmin('Bagian', $data);
    }
    public function Divisi()
    {
        $users = $this->crud->selectAllOrderby('hrd_divisi', 'id', 'asc')->result();
        $data['title'] = 'Daftar Divisi';
        $data['breadcrumb'] = '';
        $data['users'] = $users;
        $this->template->viewAdmin('Divisi', $data);
    }
    public function Hari_Libur()
    {
        $users = $this->crud->selectAllOrderby('hrd_harilibur', 'Tanggal', 'asc')->result();
        $data['title'] = 'Daftar Hari Libur';
        $data['breadcrumb'] = '';
        $data['users'] = $users;
        $this->template->viewAdmin('Hari_Libur', $data);
    }
    public function Cabang()
    {
        $users = $this->crud->selectAllOrderby('hrd_cabang', 'id', 'asc')->result();
        $data['title'] = 'Daftar Cabang';
        $data['breadcrumb'] = '';
        $data['users'] = $users;
        $this->template->viewAdmin('Cabang', $data);
    }
    public function Jabatan()
    {
        $users = $this->crud->selectAllOrderby('hrd_jabatan', 'id', 'asc')->result();
        $data['title'] = 'Daftar Jabatan';
        $data['breadcrumb'] = '';
        $data['users'] = $users;
        $this->template->viewAdmin('Jabatan', $data);
    }
    public function KodeType()
    {
        $users = $this->crud->selectAllOrderby('hrd_shiff', 'id', 'asc')->result();
        $data['title'] = 'Daftar Shift';
        $data['breadcrumb'] = '';
        $data['users'] = $users;
        $this->template->viewAdmin('Shiff', $data);
    }
    public function KodeGaji()
    {
        $users = $this->crud->selectAllOrderby('hrd_waktugajian', 'id', 'asc')->result();
        $data['title'] = 'Daftar Kode Gaji';
        $data['breadcrumb'] = '';
        $data['users'] = $users;
        $this->template->viewAdmin('KodeGaji', $data);
    }
    public function logout()
    {
        $this->session->sess_destroy();
        session_destroy();
        redirect(base_url());
    }
    private function detail_data_absen()
    {
        return $data;
    }
    public function Editkary()
    {
        $idkrj = $this->uri->segment(3);
        /*$this->db->select('*');
        $this->db->where('id', $id);
        $data['users'] = $this->db->get('hrd_biodata')->result_array();*/
        $this->db->select('*');
        $this->db->from('hrd_biodata a');
        $this->db->join('hrd_joinbagian b', 'b.ID_Krj=a.ID_Krj', 'left');
        $this->db->where('a.ID_Krj', $idkrj);
        $data['users'] = $this->db->get()->result_array();
        $data['kdcabang'] = $this->db->get('hrd_cabang')->result();
        $data['kdjbtn'] = $this->db->get('hrd_jabatan')->result();
        $data['kddiv'] = $this->db->get('hrd_divisi')->result();
        $data['kdgaji'] = $this->db->get('hrd_waktugajian')->result();
        $this->db->where('ID_Krj', $idkrj);
        $this->db->where('Aktif', '1');
        $data['gaji'] = $this->db->get('hrd_gajikarywan')->result_array();

        $data['title'] = 'Edit Karyawan';
        $data['breadcrumb'] = '';

        //echo $data['users'];
        $this->template->viewAdmin('edit/Editkary', $data);
    }
    public function Naikgaji()
    {
        $users = $this->crud->getDataQuery("SELECT * FROM hrd_gajikarywan JOIN hrd_joinbagian ON hrd_joinbagian.ID_Krj=hrd_gajikarywan.ID_Krj ORDER BY hrd_gajikarywan.id, hrd_joinbagian.Jabatan,hrd_joinbagian.Devisi ")->result();
        $data['karyawan'] = $this->crud->getDataQuery("SELECT * FROM hrd_gajikarywan JOIN hrd_joinbagian ON hrd_joinbagian.ID_Krj=hrd_gajikarywan.ID_Krj GROUP BY hrd_joinbagian.ID_Krj ORDER BY hrd_gajikarywan.id, hrd_joinbagian.Jabatan,hrd_joinbagian.Devisi ")->result();

        $data['title'] = 'Input Naik Gaji';
        $data['breadcrumb'] = '';
        $data['users'] = $users;

        $this->template->viewAdmin('edit/Naikgaji', $data);
    }
    public function Potbpjs()
    {
        $users = $this->crud->getDataQuery("SELECT * FROM hrd_gajikarywan JOIN hrd_joinbagian ON hrd_joinbagian.ID_Krj=hrd_gajikarywan.ID_Krj GROUP BY hrd_joinbagian.ID_Krj ORDER BY hrd_gajikarywan.id, hrd_joinbagian.Jabatan,hrd_joinbagian.Devisi ")->result();

        $data['title'] = 'Input Potongan BPJS';
        $data['breadcrumb'] = '';
        $data['users'] = $users;

        $this->template->viewAdmin('edit/Potbpjs', $data);
    }
    public function Pecatkary()
    {
        // $data['title'] = 'Daftar Karyawan';
        // $data['breadcrumb'] = '';
        // $this->template->viewAdmin('edit/Pecatkary', $data);

        $this->db->select('*');
        $this->db->from('hrd_biodata');
        $this->db->join('hrd_joinbagian', 'hrd_joinbagian.ID_Krj=hrd_biodata.ID_Krj');
        $this->db->where_not_in('hrd_joinbagian.Tanggal_Keluar', NULL);
        $this->db->or_where_not_in('hrd_joinbagian.Tanggal_Keluar', '0000-00-00');
        $this->db->group_by('hrd_biodata.ID_Krj');
        $this->db->order_by('hrd_joinbagian.id');
        $data['users'] = $this->db->get()->result();

        $this->db->select('*');
        $this->db->from('hrd_biodata');
        $this->db->join('hrd_joinbagian', 'hrd_joinbagian.ID_Krj=hrd_biodata.ID_Krj');
        $this->db->where('hrd_joinbagian.Tanggal_Keluar', NULL);
        $this->db->or_where('hrd_joinbagian.Tanggal_Keluar', '0000-00-00');
        $this->db->group_by('hrd_biodata.ID_Krj');
        $this->db->order_by('hrd_joinbagian.id');
        $data['karyawan'] = $this->db->get()->result();


        $data['title'] = 'Karyawan Keluar';
        $data['breadcrumb'] = '';
        $this->template->viewAdmin('edit/Pecatkary', $data);
    }

    // public function CheckSlipGajiHarian()
    // {
    //     $data['jbtn'] = $this->db->get('hrd_jabatan')->result();
    //     $data['atasan'] = $this->db->get('hrd_joinbagian')->result();
    //     $data['title'] = 'Slip Gaji Harian';
    //     $data['breadcrumb'] = '';
    //     $this->template->viewAdmin('SlipGaji/FormCheckGajiHarian', $data);
    // }
    // public function ShowSlipGajiHarian()
    // {
    //     /////////////////////////////////////////
    //     $data['title'] = 'Slip Gaji ' . $this->input->post('jbtn');
    //     $data['breadcrumb'] = ' ';
    //     $data['type'] = $this->uri->segment(3);
    //     $Bagian1 = $this->uri->segment(3);

    //     ///////////////////////////////
    //     $datainp = $this->input->post();
    //     $TglMl = $datainp['tglml'];
    //     $TglAk = $datainp['tglak'];
    //     $Jbtn = $datainp['jbtn'];

    //     $data['jabatan'] = $Jbtn;
    //     $data['Bagian'] = $datainp['jbtn'];
    //     $data['Bagian1'] = $Bagian1;
    //     $data['Mulai'] = $TglMl;
    //     $data['Akhir'] = $TglAk;
    //     $data['Pembuat'] = $datainp['pmbt'];
    //     $data['Pembayar'] = $datainp['pmbyr'];
    //     $data['Penyetuju'] = $datainp['ttd'];

    //     $DataPegawai = "SELECT * 
    //             FROM `hrd_biodata` k
    //             JOIN `hrd_joinbagian` j ON k.`ID_Krj` = j.`ID_Krj` 
    //             WHERE k.`ID_Krj` in (SELECT DISTINCT `ID_Krj` 
    //             FROM `hrd_detail_absensi` 
    //             WHERE `Tanggal_Masuk` 
    //             BETWEEN '$TglMl' AND '$TglAk') 
    //             AND j.`Jabatan` = '$Jbtn'";
    //     $query = $this->db->query($DataPegawai);
    //     $isian = $query->result_array();

    //     $data['Data'] = $isian;

    //     if ($data['Mulai'] > $data['Akhir']) {
    //         redirect(base_url('dashboard/CheckSlipGajiHarian'), 'refresh');
    //     }

    //     if ($data['Data'] == NULL) {
    //         redirect(base_url('dashboard/CheckSlipGajiHarian'), 'refresh');
    //     } else {
    //         $this->template->viewAdmin('SlipGaji/SlipGajiHArianTampil', $data);
    //     }
    // }

    public function Pindah_Bagian()
    {
        $this->db->select('*');
        $this->db->where('Tanggal_Keluar', NULL);
        $this->db->group_by('ID_Krj');
        $this->db->order_by('id', 'ASC');
        $data['users'] = $this->db->get('hrd_joinbagian')->result();
        $data['kddiv'] = $this->db->get('hrd_divisi')->result();
        $data['kdcabang'] = $this->db->get('hrd_cabang')->result();
        $data['kdjbtn'] = $this->db->get('hrd_jabatan')->result();

        $data['title'] = 'Pindah Bagian';
        $data['breadcrumb'] = '';
        $this->template->viewAdmin('Edit/PindahBagian', $data);
    }

    public function MenuInputAbsensiMassalLayout()
    {
        if ($this->session->userdata('is_login') != 'login') {
            redirect(base_url());
        } else {

            $data['title'] = 'AbsensiMassal';
            $data['breadcrumb'] = '';
            $data['DownloadLink'] = base_url("excel/formatMassAbsen.xlsx");
            $this->template->viewAdmin('InputAbsensiMassal2', $data);
        }
    }

    public function import($GajiarPer)
    {
        // Load plugin PHPExcel nya
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

        //$Maker = $this->session->userdata('id');

        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('excel/' . $this->session->userdata('tempfilename')); // Load file yang telah diupload ke folder excel

        $sheet = json_decode($this->input->post('data')/*$_POST['data']*/, true);

        $numrow = 1;
        $totalinput = 0;
        $TotalEdit = 0;
        $DataError = 0;
        $DetailError = "";
        if ($GajiarPer == "Harian") {
            foreach ($sheet as $row) {
                // Cek $numrow apakah lebih dari 1
                // Artinya karena baris pertama adalah nama-nama kolom
                // Jadi dilewat saja, tidak usah diimport
                if ($numrow > 2) { // UNTUK NGESKIP BAGIAN JUDUL

                    $id = $row['A'];
                    //echo $id." + ".$row['B'];
                    $DataKaryawan = "SELECT DISTINCT * FROM `hrd_gajikarywan` WHERE `ID_Krj` = '$id' ";
                    $query = $this->db->query($DataKaryawan);
                    $Data = $query->row_array();
                    $checkdata = $query->num_rows();
                    $numrow2 = $numrow - 2;
                    $this->load->model('Karyawan_model');
                    if ($row['A'] != "" && $row['B'] != "" && $row['C'] != "" && $row['E'] != "" && $checkdata > 0) //hanya input data yang memiliki tanggal dan id yang jelas
                    {
                        $result = $this->Karyawan_model->InputAbsensiKaryawanHarian2(
                            $row['A'],
                            $row['C'],
                            $row['D'],
                            $row['E'],
                            $row['F'],
                            $row['G'],
                            $row['B'],
                            $row['H'],
                            false
                        );

                        //print_r($result);
                        $this->karyawan_model->InputAbsensi(
                            $row['A'],
                            $row['C'],
                            $row['H'],
                            $row['I']
                        );
                        if ($result == 1) {
                            $totalinput++;
                        } else if ($result == 2) {
                            $TotalEdit++;
                        } else {
                            $DataError++;

                            $DetailError = $DetailError . "Line Error Internal-> " . $numrow2 . "\n";
                        }
                    } else {
                        $DataError++;
                        $DetailError = $DetailError . "Line Error External-> " . $numrow2 . "\n";
                    }
                }
                $numrow++; // Tambah 1 setiap kali looping
            }

            $totalinput = "Total Input : " . $totalinput . "\n Total Edit : " . $TotalEdit . "\n Total Error : " . $DataError . "\n Detail Error : \n" . $DetailError;
            echo $totalinput;
        }
        
        function cetak_pl($id)
        {
            $getdata = $this->crud->getDataWhere('shipmentplanning', array('id_shipmentplanning' => $id))->row_array();

            $data['crud'] = $this->crud;
            $data['cus'] = $this->crud->getDataWhere('customer', array('id_customer' => $getdata['id_customer']))->row_array();
            $data['data'] = $getdata;
            //$data['list']=$this->crud->getDataWhere('d_plciinvoice',array('id_PLCIINVOICE'=>$id));
            $data['title'] = 'PACKING LIST';

            $this->load->view('stock/shipmentplanning/cetak_pl', $data);
            //CONVERT TO PDF
            $tgl = date("d-m-Y");
            $html = $this->output->get_output();
            $this->load->library('dompdf_gen');
            $this->dompdf->set_paper("A4", "landscape");
            $this->dompdf->load_html($html);
            $this->dompdf->render();
            $this->dompdf->stream("PL_" . $getdata['no_shipmentplanning'] . "_" . $tgl . ".pdf", array('Attachment' => 0));
        }
    }

    public function CheckSlipGaji()
    {
        $this->db->select('*');
        $this->db->from('hrd_biodata');
        $this->db->join('hrd_joinbagian', 'hrd_joinbagian.ID_Krj=hrd_biodata.ID_Krj');
        $this->db->where('hrd_biodata.Level', 'Admin');
        $this->db->where('hrd_joinbagian.Tanggal_Keluar', NULL);
        $this->db->or_where('hrd_joinbagian.Tanggal_Keluar', '0000-00-00');
        $this->db->group_by('hrd_biodata.ID_Krj');
        $this->db->order_by('hrd_joinbagian.id');
        $data['atasan'] = $this->db->get()->result();
        $data['jbtn'] = $this->db->get('hrd_jabatan')->result();
        //$data['atasan'] = $this->db->get('hrd_joinbagian')->result();

        $data['breadcrumb'] = '';
        $type = $this->uri->segment(3);
        if ($type == 'Harian') {
            $data['divisi'] = $this->db->get('hrd_divisi')->result();
            $data['cabang'] = $this->db->get('hrd_cabang')->result();
            $data['title'] = 'Slip Gaji Harian';
            $this->template->viewAdmin('SlipGaji/FormCheckGajiHarian', $data);
        } elseif ($type == 'Single') {
            $this->db->select('*');
            $this->db->from('hrd_biodata');
            $this->db->join('hrd_joinbagian', 'hrd_joinbagian.ID_Krj=hrd_biodata.ID_Krj');
            $this->db->where('hrd_joinbagian.Kd_Gaji', 'HR');
            $this->db->where('hrd_joinbagian.Tanggal_Keluar', NULL);
            $this->db->or_where('hrd_joinbagian.Tanggal_Keluar', '0000-00-00');
            $this->db->group_by('hrd_biodata.ID_Krj');
            $this->db->order_by('hrd_joinbagian.id');
            $data['karyawan'] = $this->db->get()->result();


            $data['title'] = 'Slip Gaji Personal';
            $this->template->viewAdmin('SlipGaji/FormCheckGajiSingle', $data);
        } elseif ($type == 'Summary') {
            $data['divisi'] = $this->db->get('hrd_divisi')->result();
            $data['cabang'] = $this->db->get('hrd_cabang')->result();
            $data['title'] = 'Slip Gaji Summary';
            $this->template->viewAdmin('SlipGaji/FormCheckGajiSummary', $data);
        }
    }
    public function TumpuanShowSlipGaji()
    {
        $type = $this->uri->segment(3);
        $datainput = $this->input->post();
        $Mulai = $datainput['tglml'];
        $Akhir = $datainput['tglak'];
        $Pembuat = $datainput['pmbt'];
        $Pembayar = $datainput['pmbyr'];
        $Penyetuju = $datainput['ttd'];

        if ($type == 'Harian') {
            $Jabatan = $datainput['jbtn'];
            $Divisi = $datainput['div'];
            $Cabang = $datainput['cbg'];
            redirect(base_url('dashboard/ShowSlipGajiHarian/' . $type . '/' . $Mulai . '/' . $Akhir . '/' . $Jabatan . '/' . $Divisi . '/' . $Cabang . '/' . $Pembuat . '/' . $Pembayar . '/' . $Penyetuju));
        } elseif ($type == 'Single') {
            $id = $this->input->post('idkrj');
            $pecah = explode(",", $id);
            $ID_Krj = $pecah[0];
            echo $ID_Krj;
            if ($ID_Krj == 'Pilih Salah Satu') {
                echo "<script type=\"text/javascript\">alert('Mohon Pilih Karyawan Yang Benar');</script>";
                redirect(base_url('dashboard/CheckSlipGaji/Single/Harian'), 'refresh');
            }
            $type2 = 'Harian';
            //$this->SingleShowSlipGaji($ID_Krj, $type, $type2, $Mulai, $Akhir, $Pembuat, $Pembayar, $Penyetuju);
            redirect(base_url('dashboard/SingleShowSlipGaji/' . $ID_Krj . '/' . $type . '/' . $type2 . '/' . $Mulai . '/' . $Akhir . '/' . $Pembuat . '/' . $Pembayar . '/' . $Penyetuju));
        } elseif ($type == 'Summary') {
            $Jabatan = $datainput['jbtn'];
            $Divisi = $datainput['div'];
            $Cabang = $datainput['cbg'];
            $type2 = 'Harian';
            //$this->ShowSlipGajiSummary($type, $type2, $Mulai, $Akhir, $Jabatan, $Divisi, $Cabang, $Pembuat, $Pembayar, $Penyetuju);
            redirect(base_url('dashboard/ShowSlipGajiSummary/' . $type . '/' . $type2 . '/' . $Mulai . '/' . $Akhir . '/' . $Jabatan . '/' . $Divisi . '/' . $Cabang . '/' . $Pembuat . '/' . $Pembayar . '/' . $Penyetuju));
        }
    }
    public function ShowSlipGajiHarian($type, $mulai, $akhir, $Jabatan, $Divisi, $Cabang, $buat, $bayar, $setuju)
    {
        /////////////////////////////////////////
        $data['title'] = 'Slip Gaji - ' . $Jabatan . ' - ' . $Divisi . ' - ' . $Cabang;
        $data['breadcrumb'] = ' ';

        ///////////////////////////////

        $data['type'] = $type;
        $data['jabatan'] = $Jabatan;
        $data['Divisi'] = $Divisi;
        $data['Cabang'] = $Cabang;
        $data['Bagian'] = $Jabatan;
        $data['Bagian1'] = $type;
        $data['Mulai'] = $mulai;
        $data['Akhir'] = $akhir;
        $data['Pembuat'] = $buat;
        $data['Pembayar'] = $bayar;
        $data['Penyetuju'] = $setuju;

        if($Divisi == "Warehouse"){
            $DataPegawai = "SELECT * 
                FROM `hrd_biodata` k
                JOIN `hrd_joinbagian` j ON k.`ID_Krj` = j.`ID_Krj` 
                WHERE k.`ID_Krj` in (SELECT DISTINCT `ID_Krj` 
                FROM `hrd_detail_absensi` 
                WHERE `Tanggal_Masuk` 
                BETWEEN '$mulai' AND '$akhir' AND `Jabatan` = '$Jabatan' AND `Cabang` = '$Cabang'
                AND `Devisi` IN ('Produksi-Pembahanan','Produksi-Finishing','Produksi-Packing' ,'Produksi-Bongkar Muat' ,'Sample' ) ) 
                GROUP BY k.`ID_Krj`";
                //OR= 'Produksi-Pembahanan'  `Devisi` = 'Produksi-Finishing' OR `Devisi` = 'Produksi-Packing' OR `Devisi` = 'Produksi-Bongkar Muat' OR `Devisi` = 'Sample'
        }else{
            $DataPegawai = "SELECT * 
                FROM `hrd_biodata` k
                JOIN `hrd_joinbagian` j ON k.`ID_Krj` = j.`ID_Krj` 
                WHERE k.`ID_Krj` in (SELECT DISTINCT `ID_Krj` 
                FROM `hrd_detail_absensi` 
                WHERE `Tanggal_Masuk` 
                BETWEEN '$mulai' AND '$akhir' AND `Jabatan` = '$Jabatan' AND `Devisi` = '$Divisi' AND `Cabang` = '$Cabang') 
                GROUP BY k.`ID_Krj`";
                //AND j.`Tanggal_Keluar` = 'NULL' OR j.`Tanggal_Keluar` = '0000-00-00'
        }
        $query = $this->db->query($DataPegawai);
        $isian = $query->result_array();
        if ($isian == null) {
            echo "<script type=\"text/javascript\">alert('Data Tidak Ditemukan');</script>";
            redirect(base_url('dashboard/CheckSlipGaji/Harian'), 'refresh');
        }

        $data['Data'] = $isian;

        if ($data['Mulai'] > $data['Akhir']) {
            redirect(base_url('dashboard/CheckSlipGajiHarian'), 'refresh');
        }

        if ($data['Data'] == NULL) {
            redirect(base_url('dashboard/CheckSlipGajiHarian'), 'refresh');
        } else {
            $this->template->viewAdmin('SlipGaji/SlipGajiHArianTampil', $data);
        }
    }
    public function ShowSlipGajiPeriodePDF($type, $mulai, $akhir, $Jabatan, $Divisi, $Cabang, $buat, $bayar, $setuju) //print slip gaji Detail PDF
    {
        $Bagian1 = $Jabatan;
        //$isian = $this->db->query('SELECT * FROM hrd_detail_absensi WHERE Jabatan = "' . $Jabatan . '" AND Tanggal_Masuk BETWEEN "' . $mulai . '" AND "' . $akhir . '"')->result_array();
        //$data['potbpjs'] = $this->db->get_where('hrd_gajikarywan', array('Aktif' => '1'))->result_array();
        if($Divisi == "Warehouse"){
            $DataPegawai = "SELECT * 
                FROM `hrd_biodata` k
                JOIN `hrd_joinbagian` j ON k.`ID_Krj` = j.`ID_Krj` 
                WHERE k.`ID_Krj` in (SELECT DISTINCT `ID_Krj` 
                FROM `hrd_detail_absensi` 
                WHERE `Tanggal_Masuk` 
                BETWEEN '$mulai' AND '$akhir' AND `Jabatan` = '$Jabatan' AND `Cabang` = '$Cabang'
                AND `Devisi` IN ('Produksi-Pembahanan','Produksi-Finishing','Produksi-Packing' ,'Produksi-Bongkar Muat' ,'Sample' ) ) 
                GROUP BY k.`ID_Krj`";
        }else{
            $DataPegawai = "SELECT * 
                FROM `hrd_biodata` k
                JOIN `hrd_joinbagian` j ON k.`ID_Krj` = j.`ID_Krj` 
                WHERE k.`ID_Krj` in (SELECT DISTINCT `ID_Krj` 
                FROM `hrd_detail_absensi` 
                WHERE `Tanggal_Masuk` 
                BETWEEN '$mulai' AND '$akhir' AND `Jabatan` = '$Jabatan' AND `Devisi` = '$Divisi' AND `Cabang` = '$Cabang') 
                GROUP BY k.`ID_Krj`";
        }
        $query = $this->db->query($DataPegawai);
        $isian = $query->result_array();
        ///////////////////////////////
        $data['Data'] = $isian;
        $data['Type'] = $type;
        $data['Bagian'] = $Jabatan;
        $data['Bagian1'] = $Bagian1;
        $data['Mulai'] = $mulai;
        $data['Akhir'] = $akhir;
        $data['Pembuat'] = $buat;
        $data['Pembayar'] = $bayar;
        $data['Penyetuju'] = $setuju;
        $data['crud'] = $this->db;
        $this->load->view('SlipGaji/ShowSlipMenuPDF', $data);
    }
    public function SingleShowSlipGaji($ID, $type, $type2, $mulai, $akhir, $Pembuat, $Pembayar, $Penyetuju)
    {
        $data['title'] = 'Slip Gaji Personal';
        $data['breadcrumb'] = ' ';
        //if ($this->session->userdata('status') != 'login') {
        //  redirect("Location: " . base_url() . "index.php/General/LoginLayout");
        //} else {
        //if ($type2 == 'Harian') {
        //Show Pegawai yang absensi di periode itu
        $DataPegawai = "SELECT * FROM `hrd_biodata` d
                JOIN `hrd_joinbagian` j ON j.`ID_Krj` = d.`ID_Krj`
                WHERE d.`ID_Krj` in (SELECT DISTINCT `ID_Krj` 
                FROM `hrd_detail_absensi` 
                WHERE `Tanggal_Masuk` 
                BETWEEN '$mulai' AND '$akhir'
                AND ID_Krj = '$ID') GROUP BY d.`ID_Krj`";

        $query = $this->db->query($DataPegawai);
        $isian = $query->result_array();
        if ($isian == null) {
            echo "<script type=\"text/javascript\">alert('Data Tidak Ditemukan');</script>";
            redirect(base_url('dashboard/CheckSlipGaji/Single/Harian'), 'refresh');
        }
        ///////////////////////////////
        $data['Data'] = $isian;

        $data['ID'] = $ID;
        $data['type'] = $type;
        $data['Mulai'] = $mulai;
        $data['Akhir'] = $akhir;
        //$data['Bagian'] = $type2;
        $data['Bagian1'] = $type2;
        $data['Pembuat'] = $Pembuat;
        $data['Pembayar'] = $Pembayar;
        $data['Penyetuju'] = $Penyetuju;
        //} else {
        //}
        $this->template->viewAdmin('SlipGaji/SlipGajiSingleTampil', $data);
        //}
    }
    public function ShowSlipGajiSinglePeriodePDF($ID, $type, $type2, $mulai, $akhir, $Pembuat, $Pembayar, $Penyetuju)
    {
        $data['title'] = 'Slip Gaji Personal';
        $data['breadcrumb'] = ' ';
        //if ($this->session->userdata('status') != 'login') {
        //  redirect("Location: " . base_url() . "index.php/General/LoginLayout");
        //} else {
        //if ($type2 == 'Harian') {
        //Show Pegawai yang absensi di periode itu
        $DataPegawai = "SELECT * FROM `hrd_biodata` d
                JOIN `hrd_joinbagian` j ON j.`ID_Krj` = d.`ID_Krj`
                WHERE d.`ID_Krj` in (SELECT DISTINCT `ID_Krj` 
                FROM `hrd_detail_absensi` 
                WHERE `Tanggal_Masuk` 
                BETWEEN '$mulai' AND '$akhir'
                AND ID_Krj = '$ID') GROUP BY d.`ID_Krj`";

        $query = $this->db->query($DataPegawai);
        $isian = $query->result_array();
        ///////////////////////////////
        $data['Data'] = $isian;

        $data['ID'] = $ID;
        $data['type'] = $type;
        $data['Mulai'] = $mulai;
        $data['Akhir'] = $akhir;
        //$data['jabatan'] = $isian[0]['Jabatan'];
        //$data['Bagian'] = $type2;
        $data['Bagian1'] = $type2;
        $data['Pembuat'] = $Pembuat;
        $data['Pembayar'] = $Pembayar;
        $data['Penyetuju'] = $Penyetuju;
        //} else {
        //}
        $this->load->view('SlipGaji/ShowSlipGajiSinglePDF', $data);
        //}
    }
    public function ShowSlipGajiSummary($type, $type2, $Mulai, $Akhir, $Jabatan, $Divisi, $Cabang, $Pembuat, $Pembayar, $Penyetuju)
    {
        $data['title'] = 'Slip Gaji Summary ' . $Jabatan . " - " . $Divisi . " - " . $Cabang;
        $data['breadcrumb'] = ' ';
        $Bagian1 = $type2;
        //Load pegawai dengan periode
        if($Divisi == "Warehouse"){
            $DataPegawai = "SELECT * 
                FROM `hrd_biodata` k
                JOIN `hrd_joinbagian` j ON k.`ID_Krj` = j.`ID_Krj` 
                WHERE k.`ID_Krj` in (SELECT DISTINCT `ID_Krj` 
                FROM `hrd_detail_absensi` 
                WHERE `Tanggal_Masuk` 
                BETWEEN '$Mulai' AND '$Akhir' AND `Jabatan` = '$Jabatan' AND `Cabang` = '$Cabang'
                AND `Devisi` IN ('Produksi-Pembahanan','Produksi-Finishing','Produksi-Packing' ,'Produksi-Bongkar Muat' ,'Sample' ) ) 
                GROUP BY k.`ID_Krj`";
        }else {
            $DataPegawai = "SELECT * 
                FROM `hrd_biodata` k
                JOIN `hrd_joinbagian` j ON k.`ID_Krj` = j.`ID_Krj` 
                WHERE k.`ID_Krj` in (SELECT DISTINCT `ID_Krj` 
                FROM `hrd_detail_absensi` 
                WHERE `Tanggal_Masuk` 
                BETWEEN '$Mulai' AND '$Akhir' AND `Jabatan` = '$Jabatan'  AND `Devisi` = '$Divisi' AND `Cabang` = '$Cabang') 
                GROUP BY k.`ID_Krj`";
        }

        $query = $this->db->query($DataPegawai);
        $isian = $query->result_array();
        if ($isian == null) {
            echo "<script type=\"text/javascript\">alert('Data Tidak Ditemukan');</script>";
            redirect(base_url('dashboard/CheckSlipGaji/Summary/Harian'), 'refresh');
        }
        //Show Pegawai yang absensi di periode itu
        // $DataPegawai = "SELECT * FROM `karyawan` WHERE `id_Karyawan` in (SELECT DISTINCT `id_Karyawan` 
        // FROM `absensiharian` 
        // WHERE `TglAbsensi_Karyawan` 
        // BETWEEN '$mulai' AND '$akhir'
        // AND SUBSTR(id_Karyawan,1,3) = '$Bagian')";

        $data['tipe'] = $type;
        $data['Data'] = $isian;
        $data['Type'] = $type2;
        $data['Bagian'] = $Jabatan;
        $data['Bagian1'] = $type2;
        $data['Divisi'] = $Divisi;
        $data['Cabang'] = $Cabang;
        $data['Mulai'] = $Mulai;
        $data['Akhir'] = $Akhir;
        $data['Pembuat'] = $Pembuat;
        $data['Pembayar'] = $Pembayar;
        $data['Penyetuju'] = $Penyetuju;
        $data['crud'] = $this->db;

        $this->template->viewAdmin('SlipGaji/SlipGajiSummaryTampil', $data);
    }
    public function ShowSlipGajiSummaryPDF($type, $type2, $Mulai, $Akhir, $Jabatan, $Divisi, $Cabang, $Pembuat, $Pembayar, $Penyetuju)
    {
        $data['title'] = 'Slip Gaji Summary ' . $Jabatan . " - " . $Divisi . " - " . $Cabang;
        $data['breadcrumb'] = ' ';
        $Bagian1 = $type2;
        //Load pegawai dengan periode
        if($Divisi == "Warehouse"){
            $DataPegawai = "SELECT * 
                FROM `hrd_biodata` k
                JOIN `hrd_joinbagian` j ON k.`ID_Krj` = j.`ID_Krj` 
                WHERE k.`ID_Krj` in (SELECT DISTINCT `ID_Krj` 
                FROM `hrd_detail_absensi` 
                WHERE `Tanggal_Masuk` 
                BETWEEN '$Mulai' AND '$Akhir' AND `Jabatan` = '$Jabatan' AND `Cabang` = '$Cabang'
                AND `Devisi` IN ('Produksi-Pembahanan','Produksi-Finishing','Produksi-Packing' ,'Produksi-Bongkar Muat' ,'Sample' ) ) 
                GROUP BY k.`ID_Krj`";
        }else {
            $DataPegawai = "SELECT * 
                FROM `hrd_biodata` k
                JOIN `hrd_joinbagian` j ON k.`ID_Krj` = j.`ID_Krj` 
                WHERE k.`ID_Krj` in (SELECT DISTINCT `ID_Krj` 
                FROM `hrd_detail_absensi` 
                WHERE `Tanggal_Masuk` 
                BETWEEN '$Mulai' AND '$Akhir' AND `Jabatan` = '$Jabatan'  AND `Devisi` = '$Divisi' AND `Cabang` = '$Cabang') 
                GROUP BY k.`ID_Krj`";
        }

        $query = $this->db->query($DataPegawai);
        $isian = $query->result_array();

        //Show Pegawai yang absensi di periode itu
        // $DataPegawai = "SELECT * FROM `karyawan` WHERE `id_Karyawan` in (SELECT DISTINCT `id_Karyawan` 
        // FROM `absensiharian` 
        // WHERE `TglAbsensi_Karyawan` 
        // BETWEEN '$mulai' AND '$akhir'
        // AND SUBSTR(id_Karyawan,1,3) = '$Bagian')";

        $data['tipe'] = $type;
        $data['Data'] = $isian;
        $data['Type'] = $type2;
        $data['Bagian'] = $Jabatan;
        $data['Bagian1'] = $type2;
        $data['Mulai'] = $Mulai;
        $data['Akhir'] = $Akhir;
        $data['Pembuat'] = $Pembuat;
        $data['Pembayar'] = $Pembayar;
        $data['Penyetuju'] = $Penyetuju;
        $data['crud'] = $this->db;

        $this->load->view('SlipGaji/SlipGajiSummaryPDF', $data);
    }

    public function Check()
    {
        /*$this->db->select('*');
        $this->db->from('hrd_biodata');
        $this->db->join('hrd_joinbagian', 'hrd_joinbagian.ID_Krj=hrd_biodata.ID_Krj');
        $this->db->group_by('hrd_biodata.ID_Krj');
        $this->db->order_by('hrd_joinbagian.id');
        $this->db->order_by('hrd_joinbagian.Devisi');
        $this->db->order_by('hrd_joinbagian.Jabatan');

        $data['users'] = $this->db->get()->result();*/
        $data['title'] = 'Check Absensi';
        $data['breadcrumb'] = '';
        $this->template->viewAdmin('AbsensiChecker/check', $data);
    }

    public function checkShow()
    {
        $bulan = $this->input->post('bln');
        $blntext = date('F', strtotime($bulan));
        $data['title'] = 'Check Absensi Bulan ' . $blntext;
        $data['breadcrumb'] = ' ';
        //$pecah = explode("-", $bulan);
        //echo $bulan . " --- " . $pecah['1'] . " --- " . date($pecah[0] . "-t-" . $pecah[1]) . " --- " . $blntext;
        $timestamp    = strtotime($bulan);
        $Mulai = date('Y-m-01', $timestamp);
        $Akhir  = date('Y-m-t', $timestamp);
        $pecah2 = explode('-', $Akhir);
        $tglmin = $this->absensi_model->gettglmin($Mulai, $Akhir);
        $tglmax = $this->absensi_model->gettglmax($Mulai, $Akhir);
        echo $tglmin . " -- " . $tglmax;
        //echo $bulan . "<br>" . $Mulai . "<br>" . $Akhir;
        //Load pegawai dengan periode
        $DataPegawai = "SELECT * 
                FROM `hrd_biodata` k
                JOIN `hrd_joinbagian` j ON k.`ID_Krj` = j.`ID_Krj` 
                WHERE j.`Kd_Gaji` = 'HR'
                AND k.`ID_Krj` in (SELECT DISTINCT `ID_Krj` 
                FROM `hrd_detail_absensi` 
                WHERE `Tanggal_Masuk` 
                BETWEEN '$Mulai' AND '$Akhir') 
                GROUP BY k.`ID_Krj`";

        $query = $this->db->query($DataPegawai);
        $isian = $query->result_array();
        $data['Data'] = $isian;
        if ($isian == null) {
            echo "<script type=\"text/javascript\">alert('Data Tidak Ditemukan');</script>";
            redirect(base_url('dashboard/check'), 'refresh');
        }

        $data['tglmin'] = $tglmin;
        $data['tglmax'] = $tglmax;
        $data['bulan'] = $bulan;
        $data['tglakhir'] = $pecah2['2'];
        $data['crud'] = $this->db;

        $this->template->viewAdmin('AbsensiChecker/checkShow', $data);
    }
}


/* End of File: d:\Ampps\www\project\absen-pegawai\application\controllers\Dashboard.php */