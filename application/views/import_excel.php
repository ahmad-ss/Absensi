<?php
  // if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form

  //   $numrow = 1;
  $kosong = 0;
  $GajiarPer = '';
  //   if($GajiarPer=="Harian")
  //   {
  //     if(isset($upload_error)){ // Jika proses upload gagal
  //       echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
  //       die; // stop skrip
  //     }

  // Buat sebuah tag form untuk proses import data ke database
  //echo "<form method='post' action='javascript:;'>";

  // Buat sebuah div untuk alert validasi kosong
  echo "<div style='color: red;' id=''>
      Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
      </div>";

  echo "<table border='1' cellpadding='8'>
      <tr>
        <th colspan='5'>Preview Data</th>
      </tr>
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Divisi</th>
        <th>Shift</th>
        <th>Tanggal Masuk</th>
        <th>Jam Masuk</th>
        <th>Tanggal Keluar</th>
        <th>Jam Keluar</th>
        <th>Keterangan</th>
        <th>Gaji Harian</th>
        <th>Potongan Terlambat</th>
        <th>Tambahan Lembur</th>
        <th>Keterangan Insentif</th>
        <th>Insentif</th>
        <th>Total Gaji</th>

      </tr>";


  //Counter untuk input di jadikan json.stringify
  //$c_input = 0;

  // Test show data
  // echo '<pre>';
  // print_r($sheet);
  // echo '</pre>';

  // Lakukan perulangan dari data yang ada di excel
  // $sheet adalah variabel yang dikirim dari controller
  $numrow = 1;
  foreach ($sheet as $row) {
    // Ambil data pada excel sesuai Kolom
    $id = $row['A']; // Ambil data id
    //Ambil Data Karyawan
    $DataKaryawan = "SELECT *
        FROM `hrd_gajikarywan` k
        JOIN `hrd_joinbagian` j ON k.`ID_Krj` = j.`ID_Krj`
        -- JOIN `detailkaryawan` d ON j.`PersonUniqueID` = d.`PersonUniqueID` 
        WHERE k.`ID_Krj` = '$id' AND k.`Aktif` = '1' ";
    // AND SUBSTR(k.`ID_Krj`,2,1)='H' INI BELUM BISA CANCEL DULU

    $query = $this->db->query($DataKaryawan);
    $Data = $query->row_array();
    $Nama = $Data['NamaLengkap'];
    $Divisi = $Data['Devisi'];
    $GajianPer = $Data['GajiarPer'];
    $checkdata = $query->num_rows();
    ///////////////
    $Shift = $row['B']; // Ambil data tanggal masuk
    // $ShiftKaryawawn = "SELECT DISTINCT * 
    // FROM 'hrd_shiff' s
    // WHERE s.'KD_Shiff' = '$Shift' ";
    $tglmasuk = $row['C']; // Ambil data tanggal masuk
    $Jmasuk = $row['D']; // Ambil data jam masuk
    $this->db->select('*');
    $this->db->where('Kd_Shiff', $Shift);
    $query = $this->db->get('hrd_shiff');
    $roww = $query->row();
    if(isset($roww)){
      if($row['D'] > $roww->Jam_Masuk){
        $TMasuk = $row['D'];
      }else{
        $TMasuk = $roww->Jam_Masuk;
      }
    }
    ////////////////
    $tglKeluar = $row['E']; // Ambil data tanggal keluar
    $JKeluar = $row['F']; // Ambil data jam keluar
    $Keterangan = $row['G']; // Ambil data keterangan
    //$KodeIjin = $row['H']; // Ambil data table hrd_jenisizin
    $Insentif = $row['H']; //Insentif
    $KetLain = $row['I']; //Insentif

    // Cek jika semua data tidak diisi
    if ($id == "" && $tglmasuk == "" && $checkdata > 0)
      continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

    // Cek $numrow apakah lebih dari 1
    // Artinya karena baris pertama adalah nama-nama kolom
    // Jadi dilewat saja, tidak usah diimport

    if ($numrow > 2) { //UNTUK NGESKIP BAGIAN JUDUL DAN CONTOH FORMAT
      // Validasi apakah semua data telah diisi
      $id_td = (!empty($id)) ? "" : " style='background: #E07171;'"; // Jika id kosong, beri warna merah
      $Nama_td = (!empty($Nama)) ? "" : " style='background: #E07171;'"; // Jika id kosong, beri warna merah
      $Shift_td = (!empty($Shift)) ? "" : " style='background: #E07171;'"; // Jika id kosong, beri warna merah
      $tglmasuk_td = (!empty($tglmasuk)) ? "" : " style='background: #E07171;'"; // Jika tglmasuk kosong, beri warna merah
      $Jmasuk_td = (!empty($Jmasuk)) ? "" : " style='background: #E07171;'"; // Jika Jmasuk kosong, beri warna merah
      $tglKeluar_td = (!empty($tglKeluar)) ? "" : " style='background: #E07171;'"; // Jika JKeluar kosong, beri warna merah
      $JKeluar_td = (!empty($JKeluar)) ? "" : " style='background: #E07171;'"; // Jika JKeluar kosong, beri warna merah
      $Keterangan_td = (!empty($Keterangan)) ? "" : " style='background: #E07171;'"; // Jika Keterangan kosong, beri warna merah

      // Jika salah satu data ada yang kosong
      if ($id == "" or $tglmasuk == "") {
        $kosong++; // Tambah 1 variabel $kosong
      }
      //$hours_worked = $this->DateDiff->dateDiffInHour($tglmasuk.$Jmasuk,$tglKeluar.$JKeluar);
      $hours_worked = $this->DateDiff->dateDiffInMinute($tglmasuk . $TMasuk, $tglKeluar . $JKeluar) / 60;

      echo "<tr>";
      echo "<td" . $Nama_td . ">" . $id . "</td>";
      echo "<td" . $Nama_td . ">" . $Nama . "</td>";
      echo "<td" . $Nama_td . ">" . $Divisi . "</td>";
      echo "<td" . $Shift_td . ">" . $Shift . "</td>";
      echo "<td" . $tglmasuk_td . ">" . $tglmasuk . "</td>";
      echo "<td" . $Jmasuk_td . ">" . $Jmasuk . "</td>";
      echo "<td" . $tglKeluar_td . ">" . $tglKeluar . "</td>";
      echo "<td" . $JKeluar_td . ">" . $JKeluar . "</td>";
      echo "<td" . $Keterangan_td . ">" . $Keterangan . "</td>";
      if ($Jmasuk == "") {
        echo "<td" . $Nama_td . ">0</td>";
      } else {
        echo "<td" . $Nama_td . ">" . $km->GajiHarian($id, $tglmasuk, $hours_worked, $Shift) . "</td>";
      }
      // echo "<td".$Nama_td.">".$hours_worked."</td>";
      $arr = array('tanggalmasuk' => $tglmasuk, 'jammasuk' => $TMasuk, 'jamkerja' => $hours_worked, 'jamkeluar' => $JKeluar);

      if ($Jmasuk == ""){
        $potongantelat = 0;
      } else {
        $potongantelat = $km->PotonganTelat($id, $Shift, $arr);
      }
      echo "<td" . $Nama_td . ">" . $potongantelat . "</td>";
      //$sqlLamaKerja = 'SELECT TIMESTAMPDIFF(minute,"'.$tglmasuk.' '.$Jmasuk.'", "'.$tglKeluar.' '.$JKeluar.'")/60 AS LamaKerja';
      //$qLamaKerja = $this->Crud->getQuery($sqlLamaKerja)->row_array();
      if ($Jmasuk == "") {
        echo "<td" . $Nama_td . ">0</td>";
      } else {
        echo "<td" . $Nama_td . ">" . $km->HitungLembur($hours_worked, $id, $Shift, $tglmasuk) . "</td>";
      }
      // echo "<td".$Nama_td.">".$this->RumusGaji->HitungTambahanLembur($id,$tglmasuk,$Jmasuk,$JKeluar,$hours_worked,$Shift,$qLamaKerja['LamaKerja'])."</td>";

      // INSENTIF
      echo "<td>".$KetLain."</td>";
      echo "<td>".$Insentif."</td>";

      //$totalgaji=0;
      if ($Jmasuk == "") {
        echo "<td" . $Nama_td . ">0</td>";
      } else {
        $totalgaji = ($km->GajiHarian($id, $tglmasuk, $hours_worked, $Shift) - $km->PotonganTelat($id, $Shift, $arr)) + $km->HitungLembur($hours_worked, $id, $Shift, $tglmasuk);
        echo "<td" . $Nama_td . ">" . $totalgaji . "</td>";
      }
      //echo "<td>". $Dd->dateDiffInMinute($tglmasuk . $TMasuk, $tglKeluar . $JKeluar) / 60 ."</td>";+ $Insentif 

      // echo "<td".$Nama_td.">".$this->RumusGaji->HitungGajiHarianTotal($id,$tglmasuk,$Jmasuk,$JKeluar,$hours_worked,$Shift)."</td>";
      echo "</tr>";


      //Input hidden untuk ambil data yang dibutuhkan
      //echo '<input type="hidden" id="" value="'.$id.'">';
    }
    //$row++; // Tambah 1 setiap kali looping
    $numrow++;
  }



  if ($kosong > 0) {
  ?>
   <script>
     $(document).ready(function() {
       // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
       $("#jumlah_kosong").html('<?php echo $kosong; ?>');

       $("#kosong").show(); // Munculkan alert validasi kosong
     });
   </script>
 <?php
  } else { // Jika semua data sudah diisi
  }
  echo "<hr>";
  echo "</table>";
  // Buat sebuah tombol untuk mengimport data ke database
  echo '<button type="submit" class="btn btn-primary" name="import" id="submit" ><span id="icon_save"></span> Import</button>&nbsp;';
  echo "<a href='" . base_url("dashboard/MenuInputAbsensiMassalLayout") . "'>Cancel</a>";

  echo "</form>";

  ?>

 </div>
 <script>
   $("#submit").on("click", function(event) {
     //console.log("welcome");
     var data = {
       data: JSON.stringify(<?php echo json_encode($sheet); ?>)
     };

     //console.log(data.data);

     $.ajax({
       url: '<?php echo base_url() . "dashboard/import/Harian"; ?>',
       type: 'POST',
       data: data,
       beforeSend: function() {
         $('#icon_save').html('<i class="fa fa-spinner fa-spin"></i>');
       },
       success: function(data) {
         $('#icon_save').html('<i class="fa fa-check"></i>');
         console.log(data);

         toastr["success"](data, "Info", {

           "closeButton": true,

           "debug": false,

           "newestOnTop": true,

           "progressBar": true,

           "positionClass": "toast-top-right",

           "preventDuplicates": false,

           "onclick": null,

           "showDuration": "300",

           "hideDuration": "1000",

           "timeOut": "5000",

           "extendedTimeOut": "1000",

           "showEasing": "swing",

           "hideEasing": "linear",

           "showMethod": "fadeIn",

           "hideMethod": "fadeOut"

         });

         setTimeout(function() {

           $('#icon_save').html('<i class="fa fa-save"></i>');

         }, 3000);

       },
       error: function(xhr) {
         $('#icon_save').html('<i class="fa fa-times"></i>');
         console.log(xhr.responseText);
         setTimeout(function() {
           $('#icon_save').html('<i class="fa fa-save"></i>');
         }, 3000);
       }
     });
     event.preventDefault();
   });

   // function loadHarianUmum() {
   // //code
   // $("#BPJSKaryawan").load("<?php //echo base_url('index.php/Table/TableGajiKaryawanHarian');
                                ?>");
   // }
   $(document).ready(function() {

     $('#icon_save').html('<i class="fa fa-save"></i>');

     //input();

     //loadHarianUmum();

   });
 </script>