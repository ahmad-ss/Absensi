<style type="text/css">
    .nav-fixed {
        position: fixed;
    }
</style>
<nav class="nav-fixed">
    <!-- <button onclick="closeWindow();">(X) Tutup</button> -->
    <button onclick="printarea('printarea');">Print</button>
    <!-- <button onclick="CreatePDFfromHTML();">generate PDF</button> -->
</nav>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<!-- <link  href="http://bymartasia.myftp.org:82/b_erp/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
<!-- <link rel="stylesheet" type="text/css"  href="http://bymartasia.myftp.org:82/b_erp/assets/plugins/datatables/dataTables.bootstrap.css"> -->
<!-- <script type="text/javascript" src="http://bymartasia.myftp.org:82/b_erp/assets/plugins/jQuery/jquery.min.js"></script>
<script type="text/javascript" src="http://bymartasia.myftp.org:82/b_erp/assets/bootstrap/js/bootstrap.min.js"></script> -->
<!-- <script type="text/javascript" src="http://bymartasia.myftp.org:82/b_erp/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://bymartasia.myftp.org:82/b_erp/assets/plugins/datatables/dataTables.bootstrap.min.js"></script> -->
<div id="printarea">
    <h1>Slip Gaji <?php echo $Bagian1 ?></h1>

    <!-- <nav class="nav-fixed">
                <button onclick="closeWindow();">(X) Tutup</button>
                <button onclick="printarea('printarea');">Print</button>
                </nav> -->

    <?php

    $count = 0;
    foreach ($Data as $row1) {
        $id = $row1["ID_Krj"];
        $Nama = $row1["NamaLengkap"];
        $masuk = $this->db->get_where('hrd_joinbagian', array("ID_Krj =" => $id))->row_array();
        $TglJoin = $masuk['Tanggal_Masuk'];
        //if ($idkrj != $id || $idkrj == 0) {
        //Ambil Tgl Join
        //$CheckJoin = "SELECT `TglJoin` FROM `daftarkaryawanmasuk` WHERE `id_Karyawan` = '$id' ORDER BY `TglJoin` DESC LIMIT 1";
        //$query2 = $this->db->query($CheckJoin);
        //$joindata = $query2->row_array();
        //$tglJoin = $joindata["TglJoin"];
        ////////////////////////////////////////
        echo '<table id="TopTable" class="Table Table-bordered" style ="width100%;" >';

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
        $count++;
        echo '<tr>';
        echo '<td style="text-align:center;font-size:12px;" colspan="1">' . $count . '</td>';
        echo '<td colspan="2" style ="font-size:12px;">Nama</td>';
        echo '<td colspan="4" style ="font-size:12px;">:' . $Nama . '</td>';
        echo '</tr>';
        echo '<td style="text-align:center;font-size:12px;" colspan="1"></td>';
        echo '<td colspan="2" style ="font-size:12px;">Jabatan</td>';
        echo '<td colspan="4" style ="font-size:12px;">:' . $row1['Jabatan'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td style="text-align:center;font-size:12px;" colspan="1"></td>';
        echo '<td colspan="2" style ="font-size:12px;">Divis</td>';
        echo '<td colspan="4" style ="font-size:12px;">:' . $row1['Devisi'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td style="text-align:center;font-size:12px;" colspan="1"></td>';
        echo '<td colspan="2" style ="font-size:12px;">Cabang</td>';
        echo '<td colspan="4" style ="font-size:12px;">:' . $row1['Cabang'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td style="text-align:center;font-size:12px;" colspan="1"></td>';
        echo '<td colspan="2" style ="font-size:12px;">Tanggal Masuk</td>';

        echo '<td colspan="4" style ="font-size:12px;">:' . $TglJoin . '</td>';

        echo '</tr>';

        echo '</table>';
        echo '<table id="BodyTable" class="Table Table-bordered" style ="width:80%;" >';
        echo '<thead>';
        echo '<tr style="font-family:Courier New, Courier, monospace;">';

        echo '<th style = "border:1px solid black;width:5%;text-align:center;font-size:12px;" rowspan="2">No</th>';
        echo '<th style = "border:1px solid black;width:10%;text-align:center;font-size:12px;"rowspan="2">Hari</th>';
        echo '<th style = "border:1px solid black;width:10%;text-align:center;font-size:12px;"rowspan="2">Tanggal</th>';
        echo '<th style = "border:1px solid black;width:10%;text-align:center;font-size:12px;"colspan="2">Absen</th>';
        echo '<th style = "border:1px solid black;width:10%;text-align:center;font-size:12px;"rowspan="2">Upah</th>';
        echo '<th style = "border:1px solid black;width:10%;text-align:center;font-size:12px;"rowspan="2">Lembur</th>';
        if ($Type == 'Harian') {
            echo '<th style = "border:1px solid black;width:10%;text-align:center;font-size:12px;"rowspan="2">Potongan</th>';
        }
        echo '<th style = "border:1px solid black;width:10%;text-align:center;font-size:12px;"rowspan="2">Total</th>';
        echo '<th style = "border:1px solid black;width:10%;text-align:center;font-size:12px;"rowspan="2">Keterangan</th>';

        echo '</tr>';

        echo '<tr>';
        echo '<th style = "border:1px solid black;width:10%;text-align:center;font-size:12px;">Masuk</th>';
        echo '<th style = "border:1px solid black;width:10%;text-align:center;font-size:12px;">Keluar</th>';
        echo '</tr>';
        echo '</thead>';

        echo '<tbody>';
        $Count = 0;
        $TotalSlip = 0;
        $RealTotalSlip = 0;

        $takedayOnly3 = new DateTime($TglJoin);
        $takeyearonly3 = $takedayOnly3->format('Y');
        $takemonthonly3 = $takedayOnly3->format('m');
        $takedayOnly3 = $takedayOnly3->format('d');
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
        for ($i = 0; $i <= $DateRange; $i++) {
            //Panggil Data Pernama dan Pertanggal
            $NamaPegawai = $row1["NamaLengkap"];
            ////tanggal yang bisa bergerak

            $Tanggal = date('Y-m-d', strtotime($Mulai . ' + ' . $i . ' days'));

            ///////////////////////
            $PanggilAbsen = "SELECT * FROM `hrd_detail_absensi` WHERE `ID_Krj` = '$id' AND `Tanggal_Masuk` = '$Tanggal'";
            $query2 = $this->db->query($PanggilAbsen);
            $result = $query2->row_array(); //manggil hasil*/
            $num_rows = $query2->num_rows(); //ngecek apakah datanya atau tidak
            $Hari = date("l", strtotime($Tanggal));
            /////////////

            // colspan
            $colspan_lainlain = 0;

            if ($num_rows > 0) {
                $colspan_lainlain = 6;
                $idabs = $result["id_Absensi"];

                //ganti format tanggal
                $tanggalnewFormat = date("d-m-Y", strtotime($result["Tanggal_Masuk"]));
                /////////////////////
                echo '<tr>';
                $Count++;
                echo '<td style = "border:1px solid black;text-align:center;font-size:12px;">' . $Count . '</td>';
                echo '<td style = "border:1px solid black;text-align:center;font-size:12px;">' . date("l", strtotime($result['Tanggal_Masuk'])) . '</td>';
                echo '<td style = "border:1px solid black;text-align:center;font-size:12px;">' . $tanggalnewFormat . '</td>';
                echo '<td style = "border:1px solid black;text-align:center;font-size:12px;">' . $result["Absen_Masuk"] . '</td>';
                echo '<td style = "border:1px solid black;text-align:center;font-size:12px;">' . $result["Absen_Pulang"] . '</td>';
                echo '<td style = "border:1px solid black;text-align:right;font-size:12px;">Rp.' . number_format($result["GajiPerhari"], 0, ".", ".") . '</td>';
                echo '<td style = "border:1px solid black;text-align:right;font-size:12px;">Rp.' . number_format($result["GajiLembur"], 0, ".", ".") . '</td>';
                if ($Type == 'Harian') {
                    $colspan_lainlain = 7;
                    echo '<td style = "border:1px solid black;text-align:right;font-size:12px;">Rp.' . number_format($result["PotonganTerlambat"], 0, ".", ".") . '</td>';
                }
                echo '<td style = "border:1px solid black;text-align:right;font-size:12px;">Rp.' . number_format($result["Tot_Gaji"], 0, ".", ".") . '</td>';
                echo '<td style = "border:1px solid black;text-align:center;font-size:12px;">' . $result["Keterangan"] . '</td>';
                echo '</tr>';
                $TotalSlip = $TotalSlip + $result["Tot_Gaji"]; //itung total gaji slip
            } else {
                $colspan_lainlain = 6;

                $Keterangan = "";
                //Cek Hari Libur
                $PanggilLIbur = "SELECT `NamaHariLibur` FROM `hrd_harilibur` WHERE `Tanggal` = '$Tanggal'";
                $query2 = $this->db->query($PanggilLIbur);
                $result = $query2->row_array(); //manggil hasil
                $num_rows = $query2->num_rows(); //ngecek apakah datanya atau tidak
                if ($num_rows > 0) {
                    $Keterangan = $result["NamaHariLibur"];
                } else {
                    //Cek Alasan Alpha
                    $PanggilLIbur = "SELECT `Alasan` FROM `hrd_daftarizin` WHERE `Tgl_Cuti` = '$Tanggal' AND `ID_Krj` = '$id' ";
                    $query2 = $this->db->query($PanggilLIbur);
                    $result = $query2->row_array(); //manggil hasil
                    $num_rows = $query2->num_rows(); //ngecek apakah datanya atau tidak
                    if ($num_rows) {
                        $Keterangan = $result["Alasan"];
                    } else {

                        $Keterangan = "";
                    }
                }
                ///////////
                //ganti format tanggal
                $tanggalnewFormat = date("d-m-Y", strtotime($Tanggal));
                /////////////////////
                echo '<tr>';
                $Count++;
                echo '<td style = "border:1px solid black;text-align:center;background-color:red;font-size:12px;">' . $Count . '</td>';
                echo '<td style = "border:1px solid black;text-align:center;background-color:red;font-size:12px;">' . $Hari . '</td>';
                echo '<td style = "border:1px solid black;text-align:center;background-color:red;font-size:12px;">' . $tanggalnewFormat . '</td>';
                echo '<td style = "border:1px solid black;text-align:center;background-color:red;font-size:12px;"></td>';
                echo '<td style = "border:1px solid black;text-align:center;background-color:red;font-size:12px;"></td>';
                echo '<td style = "border:1px solid black;text-align:center;background-color:red;font-size:12px;"></td>';
                echo '<td style = "border:1px solid black;text-align:center;background-color:red;font-size:12px;"></td>';
                if ($Type == 'Harian') {
                    $colspan_lainlain = 8;
                    echo '<td style = "border:1px solid black;text-align:center;background-color:red;font-size:12px;"></td>';
                }
                echo '<td style = "border:1px solid black;text-align:center;background-color:red;font-size:12px;"></td>';
                echo '<td style = "border:1px solid black;text-align:center;background-color:red;font-size:12px;">' . $Keterangan . '</td>';
                echo '</tr>';
            }
        }

        //ambil data gaji dr detail_absensi 
        $data_lain =
            $this->db->get_where(
                'hrd_absensi',
                array('NamaLengkap' => $Nama, 'periode1 >=' => $Mulai, 'periode2 <=' => $Akhir)
            )->result();

        if (count($data_lain) > 0) {
            foreach ($data_lain as $dl) {
                echo '<tr>';
                echo '<td style="border:1px solid black;">';
                echo 'Tambahan:';
                echo '</td>';
                echo '<td colspan="' . $colspan_lainlain . '" style="border:1px solid black;">';
                echo $dl->Keterangan;
                echo '</td>';
                echo '<td style="text-align:right;border:1px solid black;">';
                echo 'Rp. ' . $dl->BiayaLain;
                echo '</td>';
                echo '<td>';
                echo '</td>';
                echo '</tr>';

                $TotalSlip = $TotalSlip + $dl->BiayaLain;
            }
        }


        // //ambil bpjs berdasarkan tahun
        //$bpjs = $this->RumusGaji->HitungPotonganBPJS($id, $Akhir);
        $potbpjs = $this->db->get_where('hrd_gajikarywan', array('ID_Krj' => $id))->result_array();
        $bpjs = $potbpjs['0']['PotBPJS'];
        //////////////////////TEKAN KENE 2

        $RealTotalSlip = $TotalSlip - $bpjs;

        if ($Bagian1 == 'Harian') {
            echo '<tr>';
            echo '<th colspan="6"></th>';
            echo '<th colspan="2"  style = "border-right:1px solid black;font-size:12px;">Total</th>';
            echo '<th style = "border:1px solid black;text-align:right;font-size:12px;">Rp.' . number_format($TotalSlip, 0, ".", ".") . '</th>';
            echo '</tr>';
            echo '<tr>';
            echo '<th colspan="6"></th>';
            echo '<th colspan="2" style = "border-right:1px solid black;font-size:12px;">Pot BPJS</th>';
            echo '<th style = "border:1px solid black;text-align:right;font-size:12px;">Rp.' . number_format($bpjs, 0, ".", ".") . '</th>';
            echo '</tr>';
            echo '<tr>';
            echo '<th colspan="6"></th>';
            echo '<th colspan="2" style = "border-right:1px solid black;font-size:12px;">Total</th>';
            echo '<th style = "border:1px solid black;text-align:right;font-size:12px;">Rp.' . number_format($RealTotalSlip, 0, ".", ".") . '</th>';
            echo '</tr>';
        } else {
            echo '<tr>';
            echo '<th colspan="5"></th>';
            echo '<th colspan="2"  style = "border-right:1px solid black;font-size:12px;">Total</th>';
            echo '<th style = "border:1px solid black;text-align:right;font-size:12px;">Rp.' . number_format($TotalSlip, 0, ".", ".") . '</th>';
            echo '</tr>';
            echo '<tr>';
            echo '<th colspan="5"></th>';
            echo '<th colspan="2" style = "border-right:1px solid black;font-size:12px;">Pot BPJS</th>';
            echo '<th style = "border:1px solid black;text-align:right;font-size:12px;">Rp.' . number_format($bpjs, 0, ".", ".") . '</th>';
            echo '</tr>';
            echo '<tr>';
            echo '<th colspan="5"></th>';
            echo '<th colspan="2" style = "border-right:1px solid black;font-size:12px;">Total</th>';
            echo '<th style = "border:1px solid black;text-align:right;font-size:12px;">Rp.' . number_format($RealTotalSlip, 0, ".", ".") . '</th>';
            echo '</tr>';
        }




        echo '</tbody>';
        echo '</table>';
        if ($count % 2 == 0) //jika sudah 2x hitung pindah page
        {
            echo '<table id="BotTable" class="Table Table-bordered" style ="width100%;page-break-after: always;" >';
        } else {

            echo '<table id="BotTable" class="Table Table-bordered" style ="width100%;" >';
        }

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
        echo '<td style ="text-align:center;">Pembuat</td>';
        echo '<td></td>';
        echo '<td style ="text-align:center;">Pengecek</td>';
        echo '<td></td>';
        echo '<td style ="text-align:center;">Penyetuju</td>';
        echo '<td></td>';
        echo '<td style ="text-align:center;">Penerima</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td><br><br><br></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td style ="text-align:center;font-size:12px;">' . $this->karyawan_model->ReplacewithSpace($Pembuat, '%20') . '</td>';
        echo '<td></td>';
        echo '<td style ="text-align:center;font-size:12px;">' . $this->karyawan_model->ReplacewithSpace($Pembayar, '%20') . '</td>';
        echo '<td></td>';
        echo '<td style ="text-align:center;font-size:12px;">' . $this->karyawan_model->ReplacewithSpace($Penyetuju, '%20') . '</td>';
        echo '<td></td>';
        echo '<td style ="text-align:center;font-size:12px;">' . $row1["NamaLengkap"] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><br><br></td>';
        echo '</tr>';
        echo '</table>';
    }
    ?>

</div>

<script>
    function printarea(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        location.reload(1);
    }

    function CreatePDFfromHTML() {
        var HTML_Width = $(".printarea").width() + 50;
        var HTML_Height = $(".printarea").height();
        var top_left_margin = 15;
        var PDF_Width = HTML_Width + (top_left_margin * 2);
        var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
        var canvas_image_width = HTML_Width;
        var canvas_image_height = HTML_Height;

        var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

        html2canvas($(".printarea")[0]).then(function(canvas) {
            var imgData = canvas.toDataURL("image/jpeg", 1.0);
            var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
            pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
            for (var i = 1; i <= totalPDFPages; i++) {
                pdf.addPage(PDF_Width, PDF_Height);
                pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height * i) + (top_left_margin * 4), canvas_image_width, canvas_image_height);
            }
            pdf.save("Your_PDF_Name.pdf");
            $(".printarea").hide();
        });
    }

    // $(document).ready(function()
    // {
    //     $('#BodyTable').DataTable();

    // });
</script>