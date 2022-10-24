<?php
defined('BASEPATH') or die('No direct script access allowed!');

class Karyawan_model extends CI_Model
{
    public function get_all()
    {
        $this->db->join('divisi', 'users.divisi = divisi.id_divisi', 'LEFT');
        $this->db->where('level', 'Karyawan');
        $result = $this->db->get('users');
        return $result->result();
    }

    public function find($id)
    {
        $this->db->join('divisi', 'users.divisi = divisi.id_divisi', 'LEFT');
        $this->db->where('id_user', $id);
        $result = $this->db->get('users');
        return $result->row();
    }

    public function insert_data($data)
    {
        $result = $this->db->insert('users', $data);
        return $result;
    }

    public function update_data($id, $data)
    {
        $this->db->where('id_user', $id);
        $result = $this->db->update('users', $data);
        return $result;
    }

    public function delete_data($id)
    {
        $this->db->where('id_user', $id);
        $result = $this->db->delete('users');
        return $result;
    }
    public function getbyid($id)
    {
        $this->db->where('id', $id);
        $result = $this->db->get('hrd_biodata');
        return $result->result_array();
    }
    public function input_karyawan($idkrj, $NIK, $NKK, $NIP, $NamaLengkap, $BPJS_KIS, $BPJS_TK, $Tempat_Lahir, $Tgl_Lahir, $Kd_gaji, $wgajian, $kdCabang, $cabang, $kdJabatan, $Jabatan, $kdDivisi, $Divisi, $Tgl_Masuk, $gaji, $gjlembur)
    {
        //mulai input
        $this->input_tbiodata($idkrj, $NIK, $NKK, $NIP, $NamaLengkap, $Tempat_Lahir, $Tgl_Lahir, $BPJS_KIS, $BPJS_TK);
        $this->input_tjoinbagian($wgajian, $kdCabang, $cabang, $kdJabatan, $kdDivisi, $idkrj, $NIK, $NIP, $NamaLengkap, $Kd_gaji, $Jabatan, $Divisi, $Tgl_Masuk);
        $this->input_tgajikaryawan($idkrj, $NIK, $NIP, $NamaLengkap, $Kd_gaji, $wgajian, $gaji, $gjlembur);

        return TRUE;
    }
    function input_tbiodata($idkrj, $NIK, $NKK, $NIP, $NamaLengkap, $Tempat_Lahir, $Tgl_Lahir, $BPJS_KIS, $BPJS_TK)
    {

        $Data = array(
            'ID_Krj' => $idkrj,
            'NIK' => $NIK,
            'NKK' => $NKK,
            'NIP' => $NIP,
            'NamaLengkap' => $NamaLengkap,
            'Tempat_Lahir' => $Tempat_Lahir,
            'Tanggal_Lahir' => $Tgl_Lahir,
            'BPJS_KIS' => $BPJS_KIS,
            'BPJS_TK' => $BPJS_TK,
            'Nama_User' => $NamaLengkap,
            'Password' => $NamaLengkap . '1'
        );
        //'Nama_User' => $Nama_user,
        //'Password' => $Pass,
        return $this->db->insert('hrd_biodata', $Data);
    }
    function input_tjoinbagian($wgajian, $kdCabang, $cabang, $kdJabatan, $kdDivisi, $idkrj, $NIK, $NIP, $NamaLengkap, $Kd_gaji, $Jabatan, $Divisi, $Tgl_Masuk)
    {
        //'id' => $id,
        $data = array(
            'ID_Krj' => $idkrj,
            'NIK' => $NIK,
            'NIP' => $NIP,
            'NamaLengkap' => $NamaLengkap,
            'Tanggal_Masuk' => $Tgl_Masuk,
            'Kd_Gaji' => $Kd_gaji,
            'GajiarPer' => $wgajian,
            'Kd_Cabang' => $kdCabang,
            'Cabang' => $cabang,
            'Kd_Jabatan' => $kdJabatan,
            'Jabatan' => $Jabatan,
            'Kd_Divisi' => $kdDivisi,
            'Devisi' => $Divisi
        );
        $this->db->insert('hrd_joinbagian', $data);
    }
    function input_tgajikaryawan($idkrj, $NIK, $NIP, $NamaLengkap, $Kd_gaji, $wgajian, $gaji, $gjlembur)
    {
        if ($wgajian == "Harian") {
            $nmkol = "GajiPerHari";
        } else {
            $nmkol = "GajiPerBulan";
        }
        //'id' => $id,
        $data = array(
            'ID_Krj' => $idkrj,
            'NIK' => $NIK,
            'NIP' => $NIP,
            'NamaLengkap' => $NamaLengkap,
            'Kd_Gaji' => $Kd_gaji,
            'GajiarPer' => $wgajian,
            'GajiPerJam' => $gjlembur,
            $nmkol => $gaji,
            'Tgl_Mulai' => date('Y-m-d')
        );
        return $this->db->insert('hrd_gajikarywan', $data);
    }
    public function update_karyawan($idkrj, $NIK, $NKK, $NIP, $NamaLengkap, $BPJS_KIS, $BPJS_TK, $Tempat_Lahir, $Tgl_Lahir, $Tgl_Masuk, $Nama_user, $Pass, $gaji, $gjlembur)
    {
        //TIDAK TERPAKAI KRN ADA PERUBAHAN
        //$Kd_gaji, $wgajian, $kdCabang, $cabang, $kdJabatan, $Jabatan, $kdDivisi, $Divisi,
        //$wgajian, $kdCabang, $cabang,$kdJabatan, $kdDivisi,$Kd_gaji, $Jabatan, $Divisi,
        //$Kd_gaji, $wgajian,
        //mulai input
        $this->update_tbiodata($idkrj, $NIK, $NKK, $NIP, $NamaLengkap, $Tempat_Lahir, $Tgl_Lahir, $Nama_user, $Pass, $BPJS_KIS, $BPJS_TK);
        $this->update_tjoinbagian($idkrj,  $NIK, $NIP, $NamaLengkap, $Tgl_Masuk);
        $this->update_tgajikaryawan($idkrj, $NIK, $NIP, $NamaLengkap, $gaji, $gjlembur, $gaji, $gjlembur);

        return TRUE;
    }
    function update_tbiodata($idkrj, $NIK, $NKK, $NIP, $NamaLengkap, $Tempat_Lahir, $Tgl_Lahir, $Nama_user, $Pass, $BPJS_KIS, $BPJS_TK)
    {
        //kwkwkwkw
        $Data = array(
            'NIK' => $NIK,
            'NKK' => $NKK,
            'NIP' => $NIP,
            'NamaLengkap' => $NamaLengkap,
            'Tempat_Lahir' => $Tempat_Lahir,
            'Tanggal_Lahir' => $Tgl_Lahir,
            'Nama_User' => $Nama_user,
            'Password' => $Pass,
            'BPJS_KIS' => $BPJS_KIS,
            'BPJS_TK' => $BPJS_TK
        );
        $this->db->set($Data);
        $this->db->where('ID_Krj', $idkrj);
        $this->db->update('hrd_biodata');
    }
    function update_tjoinbagian($idkrj, $NIK, $NIP, $NamaLengkap, $Tgl_Masuk)
    {
        //$wgajian, $kdCabang, $cabang, $kdJabatan, $kdDivisi,
        //wkwkwkwkwkw
        //tidak terpakai
        /*'Kd_Gaji' => $Kd_gaji,
            'GajiarPer' => $wgajian,
            'Kd_Jabatan' => $kdJabatan,
            'Jabatan' => $Jabatan,
            'Kd_Divisi' => $kdDivisi,
            'Devisi' => $Divisi,
            'Kd_Cabang' => $kdCabang,
            'Cabang' => $cabang*/
        $data = array(
            'NIK' => $NIK,
            'NIP' => $NIP,
            'NamaLengkap' => $NamaLengkap,
            'Tanggal_Masuk' => $Tgl_Masuk,
        );
        $this->db->set($data);
        $this->db->where('ID_Krj', $idkrj);
        $this->db->update('hrd_joinbagian');
    }
    function update_tgajikaryawan($idkrj, $NIK, $NIP, $NamaLengkap, $Kd_gaji, $wgajian, $gaji, $gjlembur)
    {
        $this->db->select_max('id');
        $this->db->where('ID_Krj', $idkrj);
        $curent = $this->db->get('hrd_gajikarywan')->result_array();
        $id = $curent['0']['id'];

        $data = array(
            'NIK' => $NIK,
            'NIP' => $NIP,
            'NamaLengkap' => $NamaLengkap,
            'Kd_Gaji' => $Kd_gaji,
            'GajiarPer' => $wgajian,
            'GajiPerHari' => $gaji,
            'GajiPerJam' => $gjlembur
        );
        $this->db->set($data);
        $this->db->where('ID_Krj', $idkrj);
        $this->db->where('id', $id);
        $this->db->update('hrd_gajikarywan');
    }
    public function input_hrlbr($namahrlbr, $tgllbr)
    {
        $data = array(
            'Tanggal' => $tgllbr,
            'NamaHariLibur' => $namahrlbr
        );
        $this->db->insert('hrd_harilibur', $data);

        return TRUE;
    }
    public function update_potbpjs($idkrj, $potbpjs)
    {
        $this->db->select_max('id');
        $this->db->where('ID_Krj', $idkrj);
        $curent = $this->db->get('hrd_gajikarywan')->result_array();
        $id = $curent['0']['id'];

        $this->db->set(array('PotBPJS' => $potbpjs, 'Tanggal_BPJS' => date("Y-m-d")));
        $this->db->where('ID_Krj', $idkrj);
        $this->db->where('id', $id);
        $this->db->update('hrd_gajikarywan');

        return TRUE;
    }
    public function naik_gaji_harian($idkrj, $Kd_gaji, $gaji)
    {
        $this->db->select_max('id');
        $this->db->where('ID_Krj', $idkrj);
        $curent = $this->db->get('hrd_gajikarywan')->result_array();
        $id = $curent['0']['id'];
        //////////////
        $this->db->set(array('Tgl_Akhir' => date('Y-m-d'), 'Aktif' => '0'));
        $this->db->where('ID_Krj', $idkrj);
        $this->db->where('id', $id);
        $this->db->update('hrd_gajikarywan');
        ////////////////
        $this->db->select('*');
        $this->db->where('ID_Krj', $idkrj);
        $this->db->where('id', $id);
        $prev = $this->db->get('hrd_gajikarywan')->result_array();
        $date = date("Y-m-d h:i:s");
        ////////////////
        $data = array(
            'ID_Krj' => $idkrj,
            'NIK' => $prev['0']['NIK'],
            'NIP' => $prev['0']['NIP'],
            'NamaLengkap' => $prev['0']['NamaLengkap'],
            'Kd_Gaji' => $Kd_gaji,
            'GajiarPer' => $prev['0']['GajiarPer'],
            'GajiPerJam' => $prev['0']['GajiPerJam'],
            'GajiPerHari' => $gaji,
            'PotBPJS' => $prev['0']['PotBPJS'],
            'Tanggal_BPJS' => $prev['0']['Tanggal_BPJS'],
            'Tgl_Mulai' => date('Y-m-d'),
            'Tanggal_NaikGaji' => $date
        );
        $this->db->insert('hrd_gajikarywan', $data);

        return TRUE;
    }
    public function pecat_tkaryawan($idkrj, $tglklr, $alasan)
    {
        $this->db->select_max('id');
        $this->db->where('ID_Krj', $idkrj);
        $curent = $this->db->get('hrd_gajikarywan')->result_array();
        $id = $curent['0']['id'];

        $data = array(
            'Tanggal_Keluar' => $tglklr,
            'Alasan_Keluar' => $alasan
        );
        $this->db->set($data);
        $this->db->where('ID_Krj', $idkrj);
        $this->db->update('hrd_joinbagian');

        $this->db->set(array('Tgl_Akhir' => date('Y-m-d'), 'Aktif' => '0'));
        $this->db->where('ID_Krj', $idkrj);
        $this->db->where('id', $id);
        $this->db->update('hrd_gajikarywan');

        return TRUE;
    }
    public function pindah_tkaryawan($idkrj, $jbtn, $cbg, $jabatan, $cabang, $div, $divisi)
    {
        if ($div == NULL && $jbtn == NULL && $cbg != NULL) {
            $this->db->set(array('Kd_Cabang' => $cbg, 'Cabang' => $cabang));
            $this->db->where('ID_Krj', $idkrj);
            $this->db->update('hrd_joinbagian');
        } elseif ($div == NULL && $cbg == NULL && $jbtn != NULL) {
            $this->db->set(array('Kd_Jabatan' => $jbtn, 'Jabatan' => $jabatan));
            $this->db->where('ID_Krj', $idkrj);
            $this->db->update('hrd_joinbagian');
        } elseif ($jbtn == NULL && $cbg == NULL && $div != NULL) {
            $this->db->set(array('Kd_Divisi' => $div, 'Devisi' => $divisi));
            $this->db->where('ID_Krj', $idkrj);
            $this->db->update('hrd_joinbagian');
        } elseif ($jbtn != NULL && $cbg != NULL && $div == NULL) {
            $this->db->set(array('Kd_Jabatan' => $jbtn, 'Jabatan' => $jabatan, 'Kd_Cabang' => $cbg, 'Cabang' => $cabang));
            $this->db->where('ID_Krj', $idkrj);
            $this->db->update('hrd_joinbagian');
        } elseif ($cbg != NULL && $div != NULL && $jbtn == NULL) {
            $this->db->set(array('Kd_Divisi' => $div, 'Devisi' => $divisi, 'Kd_Cabang' => $cbg, 'Cabang' => $cabang));
            $this->db->where('ID_Krj', $idkrj);
            $this->db->update('hrd_joinbagian');
        } elseif ($jbtn != NULL && $div != NULL && $cbg == NULL) {
            $this->db->set(array('Kd_Jabatan' => $jbtn, 'Jabatan' => $jabatan, 'Kd_Divisi' => $div, 'Devisi' => $divisi));
            $this->db->where('ID_Krj', $idkrj);
            $this->db->update('hrd_joinbagian');
        } elseif ($jbtn == NULL && $cbg == NULL && $div == NULL) {
            return NULL;
        } else {
            $this->db->set(array('Kd_Jabatan' => $jbtn, 'Jabatan' => $jabatan, 'Kd_Cabang' => $cbg, 'Cabang' => $cabang, 'Kd_Divisi' => $div, 'Devisi' => $divisi));
            $this->db->where('ID_Krj', $idkrj);
            $this->db->update('hrd_joinbagian');
        }
        return TRUE;
    }
    public function rubah_idkrj($idkrj)
    {
        $abc = $this->db->get_where('hrd_joinbagian', array('ID_Krj' => $idkrj))->result_array();

        $alpabhetcode = $abc['0']['Kd_Gaji'] . $abc['0']['Kd_Jabatan'] . $abc['0']['Kd_Divisi'];
        $countcode = $this->countcode($alpabhetcode);
        $idcode = $alpabhetcode . $countcode;

        return $idcode;
    }
    public function get_id($idkrj, $table)
    {
        $data = $this->db->get_where($table, array('ID_Krj' => $idkrj))->result_array();
        $id = $data['0']['id'];

        return $id;
    }
    public function update_idkrj($idkrj, $idcode, $table)
    {
        //$id = $this->get_id($idkrj, $table);

        $this->db->set('ID_Krj', $idcode);
        $this->db->where('ID_Krj', $idkrj);
        $this->db->update($table);
    }

    public function CheckJamKerja($Shift, $tgl)
    {
        $tgl = strtotime($tgl);
        $tgl2  = date("Y-m-d", $tgl);
        //jika termasuk tanggal merah jadikan sunday
        $CheckLibur = "SELECT DISTINCT * FROM `hrd_harilibur` WHERE  `Tanggal` = '$tgl2' ";
        $querylibur = $this->db->query($CheckLibur);
        $resultjam = $querylibur->num_rows();
        if ($resultjam > 0) {
            $HariAbsen = 'Sunday'; //libur diconvert ke kode 'Sunday'
        } else {
            $HariAbsen = date("l", $tgl); //check apakah hari minggu
        }

        if (strcmp($HariAbsen, 'Sunday') == 0) {
            //$CekKeluar = $resultKar['Minggu_Out'];
            $jam = $HariAbsen;
        } else {

            $AmbilJam = "SELECT DISTINCT * FROM `hrd_shiff` WHERE  `Kd_Shiff` = '$Shift' ";
            $queryjam = $this->db->query($AmbilJam);
            $resultjam = $queryjam->row_array();
            $jam = $resultjam["WorkTime"];
        }

        return $jam;
    }

    public function GajiHarian($id, $tgl, $hours_worked, $Shift)
    {
        $s = $this->db->get_where('hrd_shiff', array('Kd_Shiff' => $Shift))->row_array();

        $this->db->select('*');
        $this->db->where('ID_Krj', $id);
        $this->db->where('Aktif', '1');
        $k = $this->db->get('hrd_gajikarywan')->row_array();
        $CheckHariLibur = $this->CheckJamKerja($Shift, $tgl);
        if ($hours_worked > 0) {
            if (strcmp($CheckHariLibur, 'Sunday') == 0) {
                // $GajiHarian = $k["GajiPerHari"];
                $GajiHarian = $k["GajiPerHari"] * 2;
                // $GajiHarian = $hours_worked *($GajiHarian / 8) *2;
                //echo $CheckLembur;
            } else {
                $GajiHarian = $k["GajiPerHari"];
            }
            return $GajiHarian;
        }


        //return $k['GajiPerHari'];

    }

    // public function PotonganTelat($id, $Shift, $arr)
    // {
    //     $t = $this->db->get_where('hrd_gajikarywan', array('ID_Krj' => $id))->row_array(); //ambil karyawan
    //     $s = $this->db->get_where('hrd_shiff', array('Kd_Shiff' => $Shift))->row_array(); //ambil kode shift
    //     //$shift = $this->db->get_where('shiftabsensi',array('ShiftCode'=>$Shift))->row_array();
    //     $CheckTelat = $this->DateDiff->dateDiffInHour($s['Jam_Masuk'], $arr['jammasuk'], $arr['jamkerja']);

    //     if ($arr['jammasuk'] < 0) {
    //         if ($CheckTelat == true) {
    //             $TotPot = $t['GajiPerHari'] / 2;
    //         } else {
    //             $TotPot = 0;
    //         }
    //         if ($arr['jamkerja'] != 0 && $arr['jamkerja'] < $s['WorkTime']) {
    //             $TotPot = $t['GajiPerHari'] / 2;
    //         }
    //     } else {
    //         $TotPot = 0;
    //     }
    //     return $TotPot;
    // }
    public function PotonganTelat($id, $Shift, $arr)
    {
        $this->db->select('*');
        $this->db->where('ID_Krj', $id);
        $this->db->where('Aktif', '1');
        $t = $this->db->get_where('hrd_gajikarywan')->row_array(); //ambil karyawan
        $s = $this->db->get_where('hrd_shiff', array('Kd_Shiff' => $Shift))->row_array(); //ambil kode shift
        //$shift = $this->db->get_where('shiftabsensi',array('ShiftCode'=>$Shift))->row_array();
        $CheckTelat = $this->DateDiff->dateDiffInHour($s['Jam_Masuk'], $arr['jammasuk'], $arr['jamkerja']);

        if ($arr['jammasuk'] < 0) {
            if ($CheckTelat == true) {
                $TotPot = $t['GajiPerHari'] / 2;
            } else {
                //
                // if ($arr['jamkerja'] != 0 && $arr['jamkerja'] < $s['WorkTime']) {
                //     $TotPot = $t['GajiPerHari'] / 2;
                // } else {
                $TotPot = 0;
                // }
            }
        } else {
            //$TotPot = 0;
            if ($arr['jamkerja'] != 0 && $arr['jamkerja'] < $s['WorkTime']) {
                $TotPot = $t['GajiPerHari'] / 2;
            } else {
                $TotPot = 0;
            }
        }
        return $TotPot;
    }

    public function HitungLembur($LamaKerja, $id, $Shift, $tgl)
    {
        $s = $this->db->get_where('hrd_shiff', array('Kd_Shiff' => $Shift))->row_array();
        $CheckHariLibur = $this->CheckJamKerja($Shift, $tgl);
        $JamLembur = $LamaKerja - $s['WorkTime'];
        if ($LamaKerja > $s['WorkTime']) {
            //$GajiPejan=5900;// ambil data gaji karyawan

            //$row=$this->Crud->query("SELECT GjLembur FROM  gjlemburkaryawan WHERE id_Karyawan='".$id."'")->row_array(); //ambil data gaji karyawan
            $this->db->select('*');
            $this->db->where('ID_Krj', $id);
            $this->db->where('Aktif', '1');
            $l = $this->db->get_where('hrd_gajikarywan')->row_array();

            $LemburKar = $l['GajiPerJam'];

            if (strcmp($CheckHariLibur, 'Sunday') == 0) {
                if($JamLembur >= 0.5){
                    $hitung = $JamLembur / 0.5;
                    if (is_float($hitung)){
                        $JamLembur = $JamLembur - fmod($JamLembur,0.5);
                    } else {
                        $JamLembur = $JamLembur;
                    }
                } else {
                    $JamLembur = 0;
                }
                $JamHit = $JamLembur * 2;
            } else {
                //RUMUS LAMA
                // if ($JamLembur >= 0.5 || $JamLembur < 1) {
                //     $JamHit = 0.75;
                // } else if ($JamLembur == 1) {
                //     $JamHit = 1.5;
                // } else if ($JamLembur > 1){
                //     $JamHit = ($JamLembur * 2) - 0.5;
                // }
                //RUMUS BARU
                if($JamLembur >= 0.5){
                    if ($JamLembur >= 0.5 && $JamLembur < 1) {
                        $JamHit = 0.75;
                    } else if ($JamLembur == 1) {
                        $JamHit = 1.5;
                    } else if ($JamLembur > 1){
                        $hitung = $JamLembur / 0.5;
                        if (is_float($hitung)){
                            $JamLembur = $JamLembur - fmod($JamLembur,0.5);
                            $JamHit = ($JamLembur * 2) - 0.5;
                        } else {
                            $JamHit = ($JamLembur * 2) - 0.5;
                        }
                    }
                }else{
                    $JamHit = 0;
                }
            }
            $JamHit = $JamHit * $LemburKar;

            return $JamHit;
        } else {
            $JamHit = 0;
            return 0;
        }
    }

    public function CheckJamMasuk($tgl, $Shift) //OKE
    {
        $HariAbsen = date("l", strtotime($tgl));

        if (strcmp($HariAbsen, 'Sunday') == 0) {
            //$CekMasuk = $resultKar['Minggu_in'];
            return $HariAbsen;
        } else {
            $CheckKar = "SELECT DISTINCT * FROM `hrd_shiff` WHERE `Kd_Shiff` = '$Shift'";
            $query2 = $this->db->query($CheckKar);
            $CekMasuk = $query2->row_array();
        }
        return $CekMasuk['Jam_Masuk'];
    }
    public function HitungMenitTelat($Shift, $tgl, $StartHour) //OKE
    {
        if (isset($Shift) && isset($tgl) && isset($StartHour)) {
            $CheckJam = $this->CheckJamMasuk($tgl, $Shift);
            if (strcmp($CheckJam, 'Sunday') == 0) {
                return $CheckJam;
            } else {
                $minute_difference_In = $this->DateDiff->dateDiffInMinute($CheckJam, $StartHour); //(new DateTime($CheckJam))->diff(new DateTime ($StartHour));//ngecheck telat
                //$minute_difference_In = $minute_difference_In->format('%r%i');
                return $minute_difference_In;
            }
        } else {
            return 0;
        }
    }

    public function HitungJamLembur($id, $Jamkerja, $Shift) //OKE
    {
        $hours_difference_Out = 0;
        if (isset($id) && isset($Jamkerja) && isset($Shift)) {
            if (SUBSTR($Shift, 0, 3) == 'AHW') {
                // ambil jam kerja
                $Checkjam = $this->CheckJamKerja($Shift, $id);
            } else if (SUBSTR($Shift, 0, 3) == 'AHU') {
                // ambil check jam kerja
                //$Checkjam = $this->CheckJamKeluar($Shift,$tgl);
                $Checkjam = $this->CheckJamKerja($Shift, $id);
            }
            //echo $Checkjam;
            if (strcmp($Checkjam, 'Sunday') == 0) {
                return $Checkjam;
            } else {
                $hours_difference_Out = $Jamkerja - $Checkjam;
            }
        }

        return $hours_difference_Out;
    }

    public function AttendanceChecker($id, $tgl)
    {
        $CekKetersediaan = "SELECT * FROM `hrd_detail_absensi` WHERE `ID_Krj` = '$id' AND `Tanggal_Masuk` = '$tgl' ";
        $queryTanggal = $this->db->query($CekKetersediaan);
        $numrowsTanggal = $queryTanggal->num_rows();
        if ($numrowsTanggal > 0) {
            return 1;
        } else {
            $CekKetersediaan = "SELECT * FROM `hrd_daftarizin` WHERE `ID_Krj` = '$id' AND `Tgl_Cuti` = '$tgl' ";
            $queryTanggal = $this->db->query($CekKetersediaan);
            $numrowsTanggal = $queryTanggal->num_rows();
            if ($numrowsTanggal > 0) {
                return 2;
            } else {
                return 0;
            }
        }
    }

    public function AddTidakMasuk($date, $alasan, $id, $Today)
    {
        //$getIjin=$this->Crud->getDatawhere('hrd_jenisizin',array('Kd_Ijin'=>$Kd_Ijin));
        $d = array(
            'Tgl_Cuti' => $date,
            'Tgl_Pengajuan' => $Today,
            'ID_Krj' => $id,
            // 'NamaLengkap'=>$Nama,
            'Alasan' => $alasan
            //'Kd_Ijin'=>$getIjin["Nm_Ijin"]  
        );
        // $queryabsensiinsert = "INSERT INTO hrd_daftarizin 
        // (`Tgl_Cuti`,`Tgl_Pengajuan`,
        // `ID_Krj`,`NamaLengkap`,`Alasan`,'Kd_Ijin')
        // VALUES ('$date','$Today',
        // '$id','$Nama','$alasan','$getIjin["Nm_Ijin"]')";
        $query = $this->db->insert('hrd_daftarizin', $d);
        if ($query['Code'] == 0) {
            return 3;
        } else {
            return "Absensi (tidak masuk) tidak berhasil diinput";
        }
    }

    public function RemoveAttendance($id, $tgl, $kode)
    {
        if ($kode == 1) {
            // $CekKetersediaan ="DELETE FROM `absensicreatorchecker` WHERE `AbsensiCode` = '$kodeabsensi'";
            // $query = $this->db->query($CekKetersediaan);
            // if($query)
            // {
            //     $CekKetersediaan ="DELETE FROM `absensishift` WHERE `AbsensiCode` = '$kodeabsensi'";
            //     $query = $this->db->query($CekKetersediaan);
            //     if($query)
            //     {
            $CekKetersediaan = "DELETE FROM `hrd_detail_absensi` WHERE `ID_Krj` = '$id' AND `Tanggal_Masuk` = '$tgl' ";
            $query = $this->db->query($CekKetersediaan);
            if ($query) {
                return 1;
            } else {
                return "query error";
            }
            //     }else{
            //         return "query error";
            //     }
            // }else{
            //     return "query error";
        } else if ($kode == 2) {
            $CekKetersediaan = "DELETE FROM `hrd_daftarizin` WHERE `ID_Krj` = '$id' AND `Tgl_Cuti` = '$tgl' ";
            $query = $this->db->query($CekKetersediaan);

            if ($query) {
                return 1;
            } else {
                return "query error";
            }
        } else {
            return "Kode error";
        }
    }

    // Absensi karyawanx
    public function InputAbsensiKaryawanHarian($id, $tgl, $Jmasuk, $TglPulang, $Jpulang, $Keterangan, $Shift, $Nama) //OK
    {
        $HariAbsen = date("l", strtotime($tgl)); //oke
        $DateAdd = $this->DateDiff->DateTodaynHour('Y', 'm', 'd');
        $CekKetersediaan = "SELECT * FROM `hrd_detail_absensi` WHERE `ID_Krj` = '$id' AND `Tanggal_Masuk` = '$tgl' ";
        $queryTanggal = $this->db->query($CekKetersediaan);
        //$numrowsTanggal = $queryTanggal->num_rows();
        $numrowsTanggal = $this->AttendanceChecker($id, $tgl);
        /////////////////////
        //echo "m";
        //ambil data karyawan
        $CheckKar = "SELECT DISTINCT*FROM`hrd_gajikarywan`WHERE`ID_Krj`='$id'";
        $query2 = $this->db->query($CheckKar);
        //$resultKar = $query2->row_array();
        $num_rowsKar = $query2->num_rows();
        //////////////

        //echo($Shift.','.$id.','.$tgl.','.$Jmasuk.','.$TglPulang.','.$Jpulang.','.$Keterangan);


        if ($id != "" && $tgl != "") {
            // Create Attendance Code
            // $TakeLastID = "SELECT DISTINCT * FROM `hrd_detail_absensi` WHERE `Tanggal_Masuk`='$tgl' AND `ID_Krj`='$id'";
            // $queryID = $this->db->query($TakeLastID);
            // $resultID = $queryID->row_array();
            // $UniqueCode = $resultID["AbsensiCode"];
            /////////////
            if ($Jmasuk == "" && $Jpulang == "") //absen tidak masuk
            { //echo "a";
                if ($numrowsTanggal == 1) {
                    $this->RemoveAttendance($id, $tgl, $numrowsTanggal);
                } else if ($numrowsTanggal == 2) {
                }
                return $this->AddTidakMasuk($tgl, $Keterangan, $id, $DateAdd);
            } else if ($Jmasuk != "" && $Jpulang != "") {

                $hours_worked = $this->DateDiff->dateDiffInHour($tgl . $Jmasuk, $TglPulang . $Jpulang); //oke 
                // $minute_difference_In = $this->RumusGaji->HitungMenitTelat($ID,$tgl,$Jmasuk); 
                $hours_difference_Out = $this->HitungJamLembur($id, $hours_worked, $Shift);

                $CekMasuk = $this->CheckJamMasuk($tgl, $Shift); //prlu di cek
                //$=$this->Crud->getDatawhere('hrd_jenisizin',array('Kd_Ijin'=>$Kd_Ijin))

                $GajiPokok = $this->GajiHarian($id, $tgl, $hours_worked, $Shift); //oke

                // $sqlLamaKerja = 'SELECT TIMESTAMPDIFF(minute,"'.$tgl.' '.$Jmasuk.'", "'.$TglPulang.' '.$Jpulang.'")/60 AS LamaKerja';
                // $qLamaKerja = $this->Crud->getQuery($sqlLamaKerja)->row_array();
                $arr = array('tanggalmasuk' => $tgl, 'jammasuk' => $Jmasuk, 'jamkerja' => $hours_worked, 'jamkeluar' => $Jpulang);

                $lembur = $this->HitungLembur($hours_worked, $id, $Shift);
                if ($Jmasuk == "") {
                    //echo "<td".$Nama_td.">0</td>";
                    $lembur = 0;
                } else {
                    //echo "<td".$Nama_td.">".$this->RumusGaji->HitungLembur($qLamaKerja['LamaKerja'],$id,$Jmasuk)."</td>";
                    $lembur = $this->HitungLembur($hours_worked, $id, $Shift);
                }
                //$lembur = $this->RumusGaji->HitungTambahanLembur($id,$tgl,$Jmasuk,$Jpulang,$hours_worked,$Shift,$qLamaKerja['LamaKerja']);//oke

                $Potongan = $this->PotonganTelat($id, $Shift, $arr);

                //echo $Potongan;
                $TotalGaji = ($GajiPokok + $lembur) - $Potongan;
                //$TotalGaji = $this->RumusGaji->HitungGajiHarianTotal($id,$tgl,$Jmasuk,$Jpulang,$hours_worked,$Shift);//oke

                // if(!$isSpecial)
                // {
                //     //Do Nothing
                // }else{
                //     $Potongan = $GajiPokok/2;
                //     $TotalGaji = $GajiPokok/2;
                // }
                //echo $GajiPokok.'|'.$lembur.'|'.$Potongan.'|'.$TotalGaji;
                if ($hours_worked >= 0 || $hours_difference_Out <= 0) {
                    if ($num_rowsKar > 0) {
                        if ($numrowsTanggal == 1) //ada tanggal dan nama yang sudah ada
                        {
                            //echo "Data Edit";
                            $w_absen = array(
                                'NIK' => $NIK,
                                'NIP' => $NIP,
                                'ID_Krj' => $id,
                                'Tanggal_Masuk' => $TglMasuk,
                                'Jam_Masuk' => $Jmasuk,
                                'Tanggal_Pulang' => $TglPulang,
                                'Jam_Pulang' => $Jpulang
                            );

                            $d_absen = array(
                                'Jam_Masuk' => $Jmasuk,
                                'Tanggal_Pulang' => $TglPulang,
                                'Jam_Pulang' => $Jpulang,
                                'GajiPerHari' => $GajiPokok,
                                'Terlambat' => $minute_difference_In,
                                'Lembur' => $hours_difference_Out,
                                'GajiLembur' => $lembur,
                                'TotGaji' => $TotalGaji,
                                'Keterangan' => $Keterangan,
                                'id_Absensi' => $ID,
                                'JamKerja' => $hours_worked,
                                'Absen_Masuk' => $CekMasuk,
                                'PotonganTerlambat' => $Potongan
                            );
                            $query = $this->Crud->updData('hrd_detail_absensi', $w_absen, $d_absen);
                        } else {
                            return "Gagal Edit Absensi ";
                        }
                    } else {

                        $this->RemoveAttendance($id, $tgl, $numrowsTanggal);
                        // $UniqueCode = $this->GenerateCode('Absensi','Harian',$this->GenerateNamaCodeBagian($id,'pegawai'),$this->GenerateNamaCodeSubBagian($id,'pegawai'),$ID);
                        //echo "Data masuk";
                        // $getshift=$this->Crud->getDatawhere('hrd_shiff',array('Kd_Ijin'=>$Kd_Ijin));

                        $r_insert = array(
                            'ID_Krj' => $id,
                            // 'id_Absensi'=>$
                            'Tanggal_Masuk' => $tgl,
                            'Jam_Masuk' => $Jmasuk,
                            'Absen_Masuk' => $CekMasuk,
                            'Terlambat' => $minute_difference_In,
                            'PotonganTerlambat' => $Potongan,
                            'Tanggal_Pulang' => $TglPulang,
                            'Jam_Pulang' => $Jpulang,
                            'Jam_Kerja' => $hours_worked,
                            'Lembur' => $hours_difference_Out,
                            'GajiLembur' => $lembur,
                            'GajiPerHari' => $GajiPokok,
                            'Tot_Gaji' => $TotalGaji,
                            'Keterangan' => $Keterangan,
                            'Hari' => $HariAbsen

                        );
                        $query = $this->db->insert('hrd_detail_absensi', $r_insert);

                        /*$queryabsensiinsert = "INSERT INTO hrd_detail_absensi` 
                            (`ID_Krj`,`Tanggal_Masuk`,`Jam_Masuk`,`Absen_Masuk`,
                            `Terlambat`,`PotonganTerlambat`,
                            `Tanggal_Pulang`,`Jam_Pulang`,`Jam_Kerja`,
                            `GajiPerJam`,`GajiLembur`,
                            `Tot_Gaji`,`Keterangan`,`Hari`,`id_Absensi`)
                            VALUES ('$id','$tgl','$Jmasuk','$CekMasuk',
                            '$minute_difference_In','$Potongan',
                            '$TglPulang','$Jpulang','$hours_worked',
                            '$hours_difference_Out','$lembur',
                            '$GajiPokok',
                            '$TotalGaji','$Keterangan','$HariAbsen','$ID')";
                            $query = $this->db->query($queryabsensiinsert);
                              */
                        if ($query) {
                            if ($this->ConnectAttendancetoShift($UniqueCode, $Shift)) {
                                $DateAdd = $this->DateDiff->DateTodaynHour('Y', 'm', 'd');
                                if ($this->ConnectAttendanceMaker($UniqueCode, $Nama, $DateAdd)) {
                                    return 1;
                                } else {
                                    return "Gagal Connect Absensi ke Maker";
                                }
                            } else {
                                return "Gagal Connect Absensi ke Shift";
                            }
                        } else {
                            return "Gagal Input Absensi ";
                        }
                    }
                } else {
                    echo "ID karyawan tidak terdaftar";
                }
            } else {
                echo "Jam masuk tidak boleh lebih malam dari jam keluar ";
            }
        } else {
            echo "ada colum yang kosong";
        }
    } //else{
    //     echo "ada colum yang kosong";
    // }

    public function InputAbsensiKaryawanHarian2($id, $tgl, $Jmasuk, $TglPulang, $Jpulang, $Keterangan, $Shift, $Insentif, $Nama) //OK
    {
        ///BUAT BARU
        $HariAbsen = date("l", strtotime($tgl)); //oke
        $this->db->select('*');
        $this->db->where('ID_Krj', $id);
        $this->db->where('Aktif', '1');
        $karyawan = $this->db->get('hrd_gajikarywan');
        $row = $karyawan->row();
        $detkar = $this->db->get_where('hrd_joinbagian', array('ID_Krj' => $id))->row();
        $shiff = $this->db->get_where('hrd_shiff', array('Kd_Shiff' => $Shift))->row();
        if($Jmasuk > $shiff->Jam_Masuk){
            $TMasuk = $Jmasuk;
          }else{
            $TMasuk = $shiff->Jam_Masuk;
          }

        //NIK - Devisi tidak berguna kecuali ID_Krj menuhin data
        if ($Jmasuk == "" && $Jpulang == "") {
            $data2 = array(
                'NIK' => $row->NIK,
                'NIP' => $row->NIP,
                'ID_Krj' => $row->ID_Krj,
                'NamaLengkap' => $row->NamaLengkap,
                'Tgl_Pengajuan' => date("Y-m-d"),
                'Tgl_Cuti' => $tgl,
                'Alasan' => $Keterangan
            );
            $this->db->insert('hrd_daftarizin', $data2);
        } elseif ($Jmasuk != "" || $Jpulang != "") {
            $hours_worked = $this->DateDiff->dateDiffInMinute($tgl . $TMasuk, $TglPulang . $Jpulang) / 60; //oke 
            $minute_difference_In = $this->HitungMenitTelat($ID, $tgl, $Jmasuk);
            $hours_difference_Out = $this->HitungJamLembur($id, $hours_worked, $Shift);

            $CekMasuk = $this->CheckJamMasuk($tgl, $Shift); //prlu di cek
            //$=$this->Crud->getDatawhere('hrd_jenisizin',array('Kd_Ijin'=>$Kd_Ijin))

            $GajiPokok = $this->GajiHarian($id, $tgl, $hours_worked, $Shift); //oke

            // $sqlLamaKerja = 'SELECT TIMESTAMPDIFF(minute,"'.$tgl.' '.$Jmasuk.'", "'.$TglPulang.' '.$Jpulang.'")/60 AS LamaKerja';
            // $qLamaKerja = $this->Crud->getQuery($sqlLamaKerja)->row_array();
            $arr = array('tanggalmasuk' => $tgl, 'jammasuk' => $TMasuk, 'jamkerja' => $hours_worked, 'jamkeluar' => $Jpulang);

            // PERLU PERBAIKAN
            $lembur = $this->HitungLembur($hours_worked, $id, $Shift, $tgl);
            if ($Jmasuk == "") {
                //echo "<td".$Nama_td.">0</td>";
                $lembur = 0;
            } else {
                //echo "<td".$Nama_td.">".$this->RumusGaji->HitungLembur($qLamaKerja['LamaKerja'],$id,$Jmasuk)."</td>";
                $lembur = $this->HitungLembur($hours_worked, $id, $Shift, $tgl);
            }
            //$lembur = $this->RumusGaji->HitungTambahanLembur($id,$tgl,$Jmasuk,$Jpulang,$hours_worked,$Shift,$qLamaKerja['LamaKerja']);//oke

            $Potongan = $this->PotonganTelat($id, $Shift, $arr);

            //echo $Potongan;
            $TotalGaji = ($GajiPokok + $lembur) - $Potongan;
            $this->db->select('*');
            $this->db->where(array('ID_Krj' => $id, 'Tanggal_Masuk' => $tgl));
            $query = $this->db->get('hrd_detail_absensi')->result_array();
            if ($query == NULL) {
                $tanggalins = date("Y-m-d");
            } else {
                $tanggalins = $query['0']['Tanggal_Insert'];
            }
            $data = array(
                'NIK' => $row->NIK,
                'NIP' => $row->NIP,
                'ID_Krj' => $id,
                'NamaLengkap' => $row->NamaLengkap,
                'Kd_Gaji' => $row->Kd_Gaji,
                'GajiarPer' => $detkar->GajiarPer,
                'Kd_Cabang' => $detkar->Kd_Cabang,
                'Cabang' => $detkar->Cabang,
                'Kd_Jabatan' => $detkar->Kd_Jabatan,
                'Jabatan' => $detkar->Jabatan,
                'Kd_Divisi' => $detkar->Kd_Divisi,
                'Devisi' => $detkar->Devisi,
                'Tanggal_Masuk' => $tgl,
                'Jam_Masuk' => $shiff->Jam_Masuk,
                'Absen_Masuk' => $Jmasuk,
                'GajiPerJam' => $row->GajiPerJam,
                'Terlambat' => $minute_difference_In,
                'PotonganTerlambat' => $Potongan,
                'Tanggal_Pulang' => $TglPulang,
                'Jam_Kerja' => $hours_worked,
                'Jam_Pulang' => $shiff->Jam_Pulang,
                'Lembur' => $hours_difference_Out,
                'Absen_Pulang' => $Jpulang,
                'GajiLembur' => $lembur,
                'GajiPerHari' => $GajiPokok,
                'Tot_Gaji' => $TotalGaji,
                'Keterangan' => $Keterangan,
                'Hari' => $HariAbsen,
                'Tanggal_Insert' => $tanggalins

            );
            // Absen Masuk & Jam masuk sumbere excel jam masuk --- jam/absen pulang jg dr excel
            //$this->db->select('*');
            //$this->db->where(array('ID_Krj' => $id, 'Tanggal_Masuk' => $tgl));
            //$query = $this->db->get('hrd_detail_absensi')->result_array();

            if ($query == 0 || $query == NULL) {
                $this->db->insert('hrd_detail_absensi', $data);
            } else {
                $this->db->set($data);
                $this->db->where('ID_Krj', $id);
                $this->db->where('Tanggal_Masuk', $tgl);
                $this->db->update('hrd_detail_absensi');
            }
        }
    }

    public function InputAbsensi($id, $tgl, $Insentif, $Ket)
    {
        //cek absensi
        $detailabs = $this->db->get_where('hrd_detail_absensi', array('ID_Krj' => $id, 'Tanggal_Masuk' => $tgl))->result_array();
        if ($detailabs == NULL) {
        } else {

            $cekabsensi = $this->db->get_where('hrd_absensi', array('NamaLengkap' => $detailabs['0']['NamaLengkap'], 'Tanggal_Insert' => $detailabs['0']['Tanggal_Insert']));
            $result = $cekabsensi->result_array();
            $num_rows = $cekabsensi->num_rows();

            if ($num_rows > 0) {
                $this->db->select('*');
                $this->db->where('ID_Krj', $id);
                $this->db->where('Aktif', '1');
                $bpjs = $this->db->get('hrd_gajikarywan')->result_array();
                $potbpjs = $bpjs['0']['PotBPJS'];

                //$mulai = $result['0']['periode1'];
                //Tanggal min
                $this->db->select_min('Tanggal_Masuk');
                $this->db->where('ID_Krj', $id);
                $this->db->where('Tanggal_Insert', $detailabs['0']['Tanggal_Insert']);
                $min = $this->db->get('hrd_detail_absensi')->result_array();
                $mulai = $min['0']['Tanggal_Masuk'];
                $totalGaji = "SELECT SUM(Tot_Gaji) as total
                    FROM hrd_detail_absensi
                    WHERE ID_Krj = '$id' AND Tanggal_Masuk BETWEEN '$mulai' AND '$tgl'";
                $query2 = $this->db->query($totalGaji);
                //Tanggal Max
                $this->db->select_max('Tanggal_Masuk');
                $this->db->where('ID_Krj', $id);
                $this->db->where('Tanggal_Insert', $detailabs['0']['Tanggal_Insert']);
                $max = $this->db->get('hrd_detail_absensi')->result_array();
                $periode2 = $max['0']['Tanggal_Masuk'];

                $result2 = $query2->row_array();

                $GradeTotal = $result2['total'] - $potbpjs;
                $data = array(
                    'periode1' => $mulai,
                    'periode2' => $periode2,
                    'Pot_BPJS' => $potbpjs,
                    'Sub_Total' => $result2['total'],
                    'Grade_Total' => $GradeTotal,
                    'BiayaLain' => $Insentif,
                    'Keterangan' => $Ket,
                );

                $this->db->set($data);
                $this->db->where('id_Absensi', $result['0']['id_Absensi']);
                $this->db->update('hrd_absensi');

                $this->db->set('id_Absensi', $result['0']['id_Absensi']);
                $this->db->where('ID_Krj', $id);
                $this->db->where('Tanggal_Masuk', $tgl);
                $this->db->update('hrd_detail_absensi');
                $wkkw = 77;
                return $wkkw;
                //tanda kalau berhasil
            } else {
                //detail karyawan
                $karyawan = $this->db->get_where('hrd_joinbagian', array('ID_Krj' => $id));
                $row = $karyawan->result_array();

                //ambil pot BPJS
                $bpjs = $this->db->get_where('hrd_gajikarywan', array('ID_Krj' => $id))->result_array();
                $potbpjs = $bpjs['0']['PotBPJS'];
                if ($potbpjs == NULL) {
                    $potbpjs = 0;
                }

                //GAJI
                $mulai = $tgl;
                $totalGaji = "SELECT SUM(Tot_Gaji) as total
                    FROM hrd_detail_absensi
                    WHERE ID_Krj = '$id' AND Tanggal_Masuk = '$mulai'";
                $query2 = $this->db->query($totalGaji);
                $result2 = $query2->row_array();

                $GradeTotal = $result2['total'] - $potbpjs;
                $data = array(
                    'NIK' => $row['0']['NIK'],
                    'NIP' => $row['0']['NIP'],
                    'NamaLengkap' => $row['0']['NamaLengkap'],
                    'periode1' => $tgl,
                    'periode2' => $tgl,
                    'Kd_Jabatan' => $row['0']['Kd_Jabatan'],
                    'Jabatan' => $row['0']['Jabatan'],
                    'Keterangan' => $Ket,
                    'Sub_Total' => $result2['total'],
                    'Pot_BPJS' => $potbpjs,
                    'BiayaLain' => $Insentif,
                    'Grade_Total' => $GradeTotal,
                    'Tanggal_Insert' => $detailabs['0']['Tanggal_Insert']
                );
                $this->db->insert('hrd_absensi', $data);

                $cekabsensi = $this->db->get_where('hrd_absensi', array('NamaLengkap' => $row['0']['NamaLengkap'], 'periode1' => $tgl))->result_array();

                $this->db->set('id_Absensi', $cekabsensi['0']['id_Absensi']);
                $this->db->where('ID_Krj', $id);
                $this->db->where('Tanggal_Masuk', $tgl);
                $this->db->update('hrd_detail_absensi');
            }
            return 1;
        }
    }

    public function ReplacewithSpace($string, $replace)
    {
        $string = str_replace($replace, ' ', $string);
        return $string;
    }
    public function upload_tfoto($idkrj, $data)
    {
        //$filename = '/excel/berkas/' . $filename;
        $this->db->set($data);
        $this->db->where('ID_Krj', $idkrj);
        $this->db->update('hrd_biodata');
    }
    public function upload_tberkas($idkrj, $data)
    {
        $this->db->set($data);
        $this->db->where('ID_Krj', $idkrj);
        $this->db->update('hrd_biodata');
        return true;
    }
    public function countcode($huruf)
    {
        /*$query = "";
        $this->db();*/
        //echo "<br>" . $this->db->count_all_results('hrd_gajikarywan') . "<br>";
        $this->db->like('ID_Krj', $huruf);
        $this->db->from('hrd_gajikarywan');
        $angka = $this->db->count_all_results();

        return $angka + 1;
    }
}



/* End of File: d:\Ampps\www\project\absen-pegawai\application\models\Karyawan_model.php */