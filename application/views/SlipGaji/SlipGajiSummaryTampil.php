<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css">
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<div>
    <?php //$Bagian2 = $Bagian1;
    $Bagian1 = $this->karyawan_model->ReplacewithSpace($Bagian1, '-'); ?>
    <!--<h1>Slip Gaji <?php //echo $Bagian1; 
                        ?></h1>-->

    <!-- <nav class="nav-fixed">
    <button onclick="closeWindow();">(X) Tutup</button>
    <button onclick="printarea('printarea');">Print</button>
    </nav> -->

    <?php
    echo '<a href="' . base_url() . 'index.php/dashboard/ShowSlipGajiSummaryPDF/' . $tipe . '/' . $Type . '/' . $Mulai . '/' . $Akhir . '/' . $Bagian . '/' . $Divisi . '/' . $Cabang . '/' . $Pembuat . '/' . $Pembayar . '/' . $Penyetuju . '">';
    echo '<i class="fa fa-th"></i> <span>Print as PDF</span>';
    echo ' <span class="pull-right-container"></span>';
    echo '</a><br>';
    $count = 0;


    //Ambil Tgl Join
    echo '<table id="BodyTable" class="Table Table-bordered" style ="width:80%;margin-left: auto;margin-right: auto;" >';
    echo '<thead>';
    echo '<tr style="font-family:Courier New, Courier, monospace;">';

    echo '<th style = "border:1px solid black;width:3%;text-align:center;">No</th>';
    echo '<th style = "border:1px solid black;width:10%;text-align:center;">Kode ID</th>';
    echo '<th style = "border:1px solid black;width:10%;text-align:center;">Nama</th>';
    echo '<th style = "border:1px solid black;width:10%;text-align:center;">Biaya Lain</th>';
    echo '<th style = "border:1px solid black;width:10%;text-align:center;">Gaji</th>';
    //echo '<th style = "border:1px solid black;width:10%;text-align:center;">Gaji**</th>';
    echo '<th style = "border:1px solid black;width:10%;text-align:center;">BPJS</th>';
    echo '<th style = "border:1px solid black;width:10%;text-align:center;">Total Gaji</th>';
    echo '<th style = "border:1px solid black;width:7%;text-align:center;">TTD</th>';


    echo '</tr>';

    echo '</thead>';

    echo '<tbody>';
    $Count = 0;
    $TotalSlip = 0;
    $RealTotalSlip = 0;

    // $takedayOnly3 = new DateTime($tglJoin);
    // $takeyearonly3 = $takedayOnly3->format('Y'); 
    // $takemonthonly3 = $takedayOnly3->format('m'); 
    // $takedayOnly3 = $takedayOnly3->format('d');
    //Hitung Date Range akhir dan mulai
    $takedayOnly1 = new DateTime($Akhir);
    $takeyearonly1 = $takedayOnly1->format('Y');
    $takemonthonly1 = $takedayOnly1->format('m');
    $takedayOnly1 = $takedayOnly1->format('d');
    $takedayOnly2 = new DateTime($Mulai);
    $takeyearonly2 = $takedayOnly2->format('Y');
    $takemonthonly2 = $takedayOnly2->format('m');
    $takedayOnly2 = $takedayOnly2->format('d');

    $DateRange = $this->DateDiff->dateDiffInDays($Mulai, $Akhir);
    //////////////////////////////////////////////
    foreach ($Data as $row1) {
        //Panggil Data
        $id = $row1["ID_Krj"];
        //$Nama = $row1["Nama"];
        ////
        //Get Name
        $Nama = $row1["NamaLengkap"];
        //

        // Biaya lain
        // Tambahan lain-lain
        // Cek apakah data ada / tidak
        //'id_pk_karyawan' => $row1["id_pk_karyawan"],'ID_Krj' => $row1["ID_Krj"],  -> copotan dr data_lain
        /*$data_lain2 = $this->db->get_where(
            'hrd_absensi',
            array('NamaLengkap' => $Nama, 'periode1 >=' => $Mulai, 'periode2 <=' => $Akhir)
        )->result();*/
        $this->db->select_sum('BiayaLain');
        $this->db->where('NamaLengkap', $Nama);
        $this->db->where('periode1 >=', $Mulai);
        $this->db->where('periode2 <=', $Akhir);
        $data_lain = $this->db->get('hrd_absensi')->row_array();
        $potbpjs = $this->db->get_where('hrd_gajikarywan', array('ID_Krj' => $id))->row_array();
        $bpjs = $potbpjs['PotBPJS'];
        //Hitung Gaji
        $totalGaji = "SELECT SUM(`Tot_Gaji`) as `total`
                    FROM `hrd_detail_absensi`
                    WHERE `ID_Krj` = '$id' AND `Tanggal_Masuk` BETWEEN '$Mulai' AND '$Akhir'";
        $query2 = $this->db->query($totalGaji);
        $result = $query2->row_array(); //manggil hasil
        $num_rows = $query2->num_rows(); //manggil hasil
        if ($num_rows > 0) {
            ///////////////
            //ambil bpjs berdasarkan tahun
            //$bpjs = $this->RumusGaji->HitungPotonganBPJS($id, $Akhir);
            //////////////////////
            if (count($data_lain) > 0) {
                if ($data_lain['BiayaLain'] < 0) {
                    $RealTotal = ($result["total"] + $data_lain['BiayaLain']);
                    $RealTotal = $RealTotal - $bpjs;
                } else {
                    $RealTotal = ($result["total"] + $data_lain['BiayaLain']);
                    $RealTotal = $RealTotal - $bpjs;
                }
            } else {
                $RealTotal = ($result["total"]) - $bpjs;
            }

            echo '<tr>';
            $Count++;
            //$data_lain['Keterangan'];
            echo '<td style = "border:1px solid black;text-align:center;">' . $Count . '</td>';
            echo '<td style = "border:1px solid black;text-align:center;">' . $id . '</td>';
            echo '<td style = "border:1px solid black;text-align:left;">' . $Nama . '</td>';
            //echo '<td style = "border:1px solid black;text-align:center;">';
            /*if ($data_lain2 == NULL) {
            } else {
                foreach ($data_lain2 as $dt2) {
                    echo $dt2->Keterangan . " ,";
                }
            }
            echo '</td>';*/
            echo '<td style = "border:1px solid black;text-align:right;">Rp.' . number_format($data_lain['BiayaLain'], 0, ".", ".") . '</td>';
            // if (count($data_lain) > 0) {
            //     if ($data_lain['BiayaLain'] < 0) {
            //         echo '<td style = "border:1px solid black;text-align:right;">Rp.' . number_format($result["total"] + $data_lain['BiayaLain'], 0, ".", ".") . '</td>';
            //     } else {
            //         echo '<td style = "border:1px solid black;text-align:right;">Rp.' . number_format($result["total"] + $data_lain['BiayaLain'], 0, ".", ".") . '</td>';
            //     }
            // } else {
            //     echo '<td style = "border:1px solid black;text-align:right;">Rp.' . number_format($result["total"], 0, ".", ".") . '</td>';
            // }
            echo '<td style = "border:1px solid black;text-align:right;">Rp.' . number_format($result["total"], 0, ".", ".") . '</td>';
            echo '<td style = "border:1px solid black;text-align:right;">Rp.' . number_format($bpjs, 0, ".", ".") . '</td>';
            echo '<td style = "border:1px solid black;text-align:right;">Rp.' . number_format($RealTotal, 0, ".", ".") . '</td>';
            echo '<td style = "border:1px solid black;text-align:right;">' . '</td>';
            echo '</tr>';
            $RealTotalSlip += $RealTotal; //Hitung Total Pengeluaran
        }
    }
    echo '<tr>';
    $Count++;
    echo '<td ></td>';
    echo '<td ></td>';
    echo '<td ></td>';
    echo '<td colspan="2"></td>';
    echo '<td style = "border:1px solid black;text-align:center;">Total</td>';
    echo '<td style = "border:1px solid black;text-align:right;">Rp.' . number_format($RealTotalSlip, 0, ".", ".") . '</td>';
    echo '</tr>';
    echo '</tbody>';
    echo '</table>';
    echo '<table id="BotTable" class="Table Table-bordered" style ="width100%;" >';

    echo '<tr style="font-family:Courier New, Courier, monospace;padding:5px">';

    echo '<th style = "width:10%;"></th>';
    echo '<th style = "width:10%;"></th>';
    echo '<th style = "width:10%;"></th>';
    echo '<th style = "width:10%;"></th>';
    echo '<th style = "width:10%;"></th>';
    echo '<th style = "width:10%;"></th>';
    echo '<th style = "width:10%;"></th>';
    echo '<th style = "width:10%;"></th>';
    echo '<th style = "width:10%;"></th>';
    echo '<th style = "width:10%;"></th>';
    echo '<th style = "width:10%;"></th>';
    echo '</tr>';

    echo '<tr>';
    echo '<td style ="text-align:center;"colspan="3">Pembuat</td>';
    echo '<td style ="text-align:center;"colspan="3">Pengecek</td>';
    echo '<td style ="text-align:center;"colspan="3">Penyetuju</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td><br><br><br><br></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td style ="text-align:center;"colspan="3">' . $this->karyawan_model->ReplacewithSpace($Pembuat, '%20') . '</td>';
    echo '<td style ="text-align:center;"colspan="3">' . $this->karyawan_model->ReplacewithSpace($Pembayar, '%20') . '</td>';
    echo '<td style ="text-align:center;"colspan="3">' . $this->karyawan_model->ReplacewithSpace($Penyetuju, '%20') . '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td><br><br></td>';
    echo '</tr>';
    echo '</table>';



    ?>

</div>

<script>
    // $(document).ready(function()
    // {
    //     $('#BodyTable').DataTable();

    // });

    function printarea(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        location.reload(1);
    }

    function closeWindow() {
        if (confirm("Are you sure to close ?")) {
            close();
        }
    }

    // $(document).ready(function()
    // {
    //     $('#BodyTable').DataTable();

    // });
</script>