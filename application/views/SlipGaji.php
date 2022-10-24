<style type="text/css">
@media print { body { -webkit-print-color-adjust: exact; } }
</style>
<div class="content-wrapper">
<!-- <link  href="http://bymartasia.myftp.org:82/b_erp/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
<link rel="stylesheet" type="text/css"  href="http://bymartasia.myftp.org:82/b_erp/assets/plugins/datatables/dataTables.bootstrap.css">
<script type="text/javascript" src="http://bymartasia.myftp.org:82/b_erp/assets/plugins/jQuery/jquery.min.js"></script>
<script type="text/javascript" src="http://bymartasia.myftp.org:82/b_erp/assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://bymartasia.myftp.org:82/b_erp/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://bymartasia.myftp.org:82/b_erp/assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<h1>Slip Gaji <?php echo $Bagian1 ?></h1>
            
                <!-- <nav class="nav-fixed">
                <button onclick="closeWindow();">(X) Tutup</button>
                <button onclick="printarea('printarea');">Print</button>
                </nav> -->
                
                <?php 
                // echo '<nav class="nav-fixed">';
                // echo '<button onclick="closeWindow();">(X) Tutup</button>';
                // echo '<button onclick="printarea('.'printarea'.');">Print</button>';
                // echo '</nav>';
                //print as PDF BUTTON
                echo '<a href="'.base_url().'index.php/General/ShowSlipGajiPeriodePDF/'.$Type.'/'.$Mulai.'/'.$Akhir.'/'.$Bagian1.'/'.$Pembuat.'/'.$Pembayar.'/'.$Penyetuju.'">';
                echo '<i class="fa fa-th"></i> <span>Print as PDF</span>';
                echo ' <span class="pull-right-container"></span>';
                echo '</a>';
                ///////////////////////
                $count=0;
                foreach($Data as $row1)
                {
                    $id =$row1["id_Karyawan"];
                    $Nama=$row1["Nama"]; 
                    //Ambil Tgl Join
                    $CheckJoin = "SELECT `TglJoin` FROM `daftarkaryawanmasuk` WHERE `id_Karyawan` = '$id' ORDER BY `TglJoin` DESC LIMIT 1";
                    $query2 = $this->db->query($CheckJoin);
                    $joindata =$query2->row_array();
                    $tglJoin = $joindata["TglJoin"];
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
                        echo '<td style="text-align:center;" colspan="1">'.$count.'</td>';
                        echo '<td colspan="2">Nama</td>';
                        echo '<td colspan="4">:'.$Nama.'</td>';
                    echo '</tr>'; 
                    echo '<tr>'; 
                        echo '<td style="text-align:center;" colspan="1"></td>';
                        echo '<td colspan="2">Bagian</td>';
                        echo '<td colspan="4">:'.$row1["SubBagian"].'</td>';
                    echo '</tr>'; 
                    echo '<tr>'; 
                        echo '<td style="text-align:center;" colspan="1"></td>';
                        echo '<td colspan="2">Tanggal Masuk</td>';
                        echo '<td colspan="4">:'.$tglJoin.'</td>';
                    echo '</tr>'; 

                    echo '</table>';
                        echo '<table id="BodyTable" class="Table Table-bordered" style ="width:80%;" >';
                        echo '<thead>';
                        echo '<tr style="font-family:Courier New, Courier, monospace;">';
                                
                            echo '<th style = "border:1px solid black;width:5%;text-align:center;" rowspan="2">No</th>';
                            echo '<th style = "border:1px solid black;width:10%;text-align:center;"rowspan="2">Hari</th>';
                            echo '<th style = "border:1px solid black;width:10%;text-align:center;"rowspan="2">Tanggal</th>';
                            echo '<th style = "border:1px solid black;width:10%;text-align:center;"colspan="2">Absen</th>';
                            echo '<th style = "border:1px solid black;width:10%;text-align:center;"rowspan="2">Upah</th>';
                            echo '<th style = "border:1px solid black;width:10%;text-align:center;"rowspan="2">Lembur</th>';
                            if($Bagian1 == 'WAREHOUSE')
                            {
                                
                            }else if($Bagian1 == 'UMUM')
                            {
                                echo '<th style = "border:1px solid black;width:10%;text-align:center;"rowspan="2">Potongan</th>';
                            }
                            echo '<th style = "border:1px solid black;width:10%;text-align:center;"rowspan="2">Total</th>';
                            echo '<th style = "border:1px solid black;width:10%;text-align:center;"rowspan="2">Keterangan</th>';
                            
                        echo '</tr>';
    
                        echo '<tr>';
                            echo '<th style = "border:1px solid black;width:10%;text-align:center;">Masuk</th>';
                            echo '<th style = "border:1px solid black;width:10%;text-align:center;">Keluar</th>';
                        echo '</tr>';
                        echo '</thead>';

                        echo '<tbody>';
                        $Count=0;
                        $TotalSlip=0;
                        $RealTotalSlip=0;

                        $takedayOnly3 = new DateTime($tglJoin);
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
                        
                        $DateRange = $this->DateDiff->dateDiffInDays($Mulai,$Akhir);
                        //////////////////////////////////////////////
                        for($i =0; $i<=$DateRange; $i++)
                        {
                            //Panggil Data Pernama dan Pertanggal
                            $NamaPegawai = $row1["Nama"];
                            ////tanggal yang bisa bergerak
                            
                            $Tanggal= date('Y-m-d', strtotime($Mulai. ' + '.$i.' days'));
                            
                            ///////////////////////
                            $PanggilAbsen = "SELECT * FROM `absensiharian` WHERE `id_Karyawan` = '$id' AND `TglAbsensi_Karyawan` = '$Tanggal'";
                            $query2 = $this->db->query($PanggilAbsen);
                            $result = $query2->row_array();//manggil hasil
                            $num_rows =$query2->num_rows();//ngecek apakah datanya atau tidak
                            $Hari = date("l",strtotime($Tanggal));
                            /////////////

                            // colspan
                            $colspan_lainlain = 0;

                            if($num_rows>0)
                            {
                                $colspan_lainlain = 7;

                                //ganti format tanggal
                                $tanggalnewFormat= date("d-m-Y",strtotime($result["TglAbsensi_Karyawan"]));
                                /////////////////////
                                echo '<tr>';
                                $Count++;
                                echo '<td style = "border:1px solid black;text-align:center;">'.$Count.'</td>';
                                echo '<td style = "border:1px solid black;text-align:center;">'.$result["Hari"].'</td>';
                                echo '<td style = "border:1px solid black;text-align:center;">'.$tanggalnewFormat.'</td>';
                                echo '<td style = "border:1px solid black;text-align:center;">'.$result["JamMasuk_Karyawan"].'</td>';
                                echo '<td style = "border:1px solid black;text-align:center;">'.$result["JamKeluar_Karyawan"].'</td>';
                                echo '<td style = "border:1px solid black;text-align:right;">Rp.'. number_format($result["GjHarian_Karyawan"], 0, ".", ".").'</td>';
                                echo '<td style = "border:1px solid black;text-align:right;">Rp.'. number_format($result["GjLembur"], 0, ".", ".").'</td>';
                                if($Bagian1 == 'WAREHOUSE')
                                {
                                    
                                }else if($Bagian1 == 'UMUM')
                                {
                                    $colspan_lainlain = 8;
                                    echo '<td style = "border:1px solid black;text-align:right;">Rp.'. number_format($result["Potongan_Harian"], 0, ".", ".").'</td>';
                                }
                                echo '<td style = "border:1px solid black;text-align:right;">Rp.'. number_format($result["TotalGj_Karyawan"], 0, ".", ".").'</td>';
                                echo '<td style = "border:1px solid black;text-align:center;">'.$result["Keterangan"].'</td>';
                                echo '</tr>';
                                $TotalSlip= $TotalSlip + $result["TotalGj_Karyawan"];//itung total gaji slip
                            }else{
                                $colspan_lainlain = 7;

                                $Keterangan="";
                                //Cek Hari Libur
                                $PanggilLIbur = "SELECT `Nama_Hari_Libur` FROM `hari_libur` WHERE `Date` = '$Tanggal'";
                                $query2 = $this->db->query($PanggilLIbur);
                                $result = $query2->row_array();//manggil hasil
                                $num_rows =$query2->num_rows();//ngecek apakah datanya atau tidak
                                if($num_rows>0)
                                {
                                    $Keterangan = $result["Nama_Hari_Libur"];
                                }else{
                                    //Cek Alasan Alpha
                                    $PanggilLIbur = "SELECT `Reason` FROM `tidakmasukabsen` WHERE `Date` = '$Tanggal' AND `id_Karyawan` = '$id' ORDER BY `DateAdd` desc limit 1";
                                    $query2 = $this->db->query($PanggilLIbur);
                                    $result = $query2->row_array();//manggil hasil
                                    $num_rows =$query2->num_rows();//ngecek apakah datanya atau tidak
                                    if($num_rows)
                                    {
                                        $Keterangan = $result["Reason"];
                                    }else{

                                        $Keterangan="";
                                    }
                                }
                                ///////////
                                //ganti format tanggal
                                $tanggalnewFormat= date("d-m-Y",strtotime($Tanggal));
                                /////////////////////
                                echo '<tr>';
                                $Count++;
                                echo '<td style = "border:1px solid black;text-align:center;background-color:red;">'.$Count.'</td>';
                                echo '<td style = "border:1px solid black;text-align:center;background-color:red;">'.$Hari.'</td>';
                                echo '<td style = "border:1px solid black;text-align:center;background-color:red;">'.$tanggalnewFormat.'</td>';
                                echo '<td style = "border:1px solid black;text-align:center;background-color:red;"></td>';
                                echo '<td style = "border:1px solid black;text-align:center;background-color:red;"></td>';
                                echo '<td style = "border:1px solid black;text-align:center;background-color:red;"></td>';
                                echo '<td style = "border:1px solid black;text-align:center;background-color:red;"></td>';
                                if($Bagian1 == 'WAREHOUSE')
                                {
                                    
                                }else if($Bagian1 == 'UMUM')
                                {
                                    $colspan_lainlain = 8;
                                    echo '<td style = "border:1px solid black;text-align:center;background-color:red;"></td>';
                                }
                                echo '<td style = "border:1px solid black;text-align:center;background-color:red;"></td>';
                                echo '<td style = "border:1px solid black;text-align:center;background-color:red;">'.$Keterangan.'</td>';
                                echo '</tr>';
                            }
                        }

                        // Tambahan lain-lain
                        // Cek apakah data ada / tidak
                        $data_lain = $crud->get_where('biayalain',array('id_pk_karyawan'=>$row1["id_pk_karyawan"],'id_Karyawan'=>$row1["id_Karyawan"],'tglawal >='=>$Mulai,'tglakhir <='=>$Akhir))->result();

                        if(count($data_lain) > 0){
                            foreach($data_lain as $dl){
                                echo '<form action="'.base_url().'index.php/biayalain/updatesave" method="POST">';
                                echo '
                                    <input type="hidden" name="id_biayalain" value="'.$dl->id_biayalain.'">
                                    <input type="hidden" name="id_pk_karyawan" value="'.$dl->id_pk_karyawan.'">
                                    <input type="hidden" name="id_Karyawan" value="'.$dl->id_Karyawan.'">
                                    <input type="hidden" name="tglawal" value="'.$dl->tglawal.'">
                                    <input type="hidden" name="tglakhir" value="'.$dl->tglakhir.'">

                                    <input type="hidden" name="tipe" value="'.$Type.'">
                                    <input type="hidden" name="bagian1" value="'.$Bagian1.'">
                                    <input type="hidden" name="pembuat" value="'.$Pembuat.'">
                                    <input type="hidden" name="pembayar" value="'.$Pembayar.'">
                                    <input type="hidden" name="penyetuju" value="'.$Penyetuju.'">
                                ';
                                echo '<tr>';
                                echo '<td colspan="'.$colspan_lainlain.'">';
                                echo '
                                    <input type="text" class="form-control" name="ket_lainlain" placeholder="Keterangan" value="'.$dl->keterangan.'">
                                ';
                                echo '</td>';
                                echo '<td>';
                                echo '
                                    <input type="number" class="form-control text-right" name="nom_lainlain" placeholder="Nominal" value="'.$dl->nominal.'">
                                ';
                                echo '</td>';
                                echo '<td>';
                                echo '
                                    <button class="btn btn-default" type="submit" name="submit"><i class="fa fa-plus"></i> Update</button>
                                ';
                                echo '</td>';
                                echo '</tr>';
                                echo '</form>';

                                $TotalSlip = $TotalSlip+$dl->nominal;
                            }
                        }else{
                            echo '<form action="'.base_url().'index.php/biayalain/savedata" method="POST">';
                            echo '
                                <input type="hidden" name="id_pk_karyawan" value="'.$row1["id_pk_karyawan"].'">
                                <input type="hidden" name="id_Karyawan" value="'.$row1["id_Karyawan"].'">
                                <input type="hidden" name="tglawal" value="'.$Mulai.'">
                                <input type="hidden" name="tglakhir" value="'.$Akhir.'">

                                <input type="hidden" name="tipe" value="'.$Type.'">
                                <input type="hidden" name="bagian1" value="'.$Bagian1.'">
                                <input type="hidden" name="pembuat" value="'.$Pembuat.'">
                                <input type="hidden" name="pembayar" value="'.$Pembayar.'">
                                <input type="hidden" name="penyetuju" value="'.$Penyetuju.'">
                            ';
                            echo '<tr>';
                            echo '<td colspan="'.$colspan_lainlain.'">';
                            echo '
                                <input type="text" class="form-control" name="ket_lainlain" placeholder="Keterangan Tambahan">
                            ';
                            echo '</td>';
                            echo '<td>';
                            echo '
                                <input type="number" class="form-control text-right" name="nom_lainlain" placeholder="Nominal" value="0">
                            ';
                            echo '</td>';
                            echo '<td>';
                            echo '
                                <button class="btn btn-default" type="submit" name="submit"><i class="fa fa-plus"></i> Input</button>
                            ';
                            echo '</td>';
                            echo '</tr>';
                            echo '</form>';
                        }

                        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

                        // //ambil bpjs berdasarkan tahun
                        $bpjs = $this->RumusGaji->HitungPotonganBPJS($id,$Akhir);
                        //////////////////////

                        $RealTotalSlip =$TotalSlip- $bpjs;

                        if($Bagian1 == 'UMUM')
                        {
                            echo '<tr>';
                                echo '<th colspan="6"></th>';
                                echo '<th colspan="2"  style = "border-right:1px solid black;font-size:12px;">Total</th>';
                                echo '<th style = "border:1px solid black;text-align:right;font-size:12px;">Rp.'. number_format($TotalSlip , 0, ".", ".").'</th>';
                            echo '</tr>';
                            echo '<tr>';
                                echo '<th colspan="6"></th>';
                                echo '<th colspan="2" style = "border-right:1px solid black;font-size:12px;">Pot BPJS</th>';
                                echo '<th style = "border:1px solid black;text-align:right;font-size:12px;">Rp.'. number_format($bpjs , 0, ".", ".").'</th>';
                            echo '</tr>';
                            echo '<tr>';
                                echo '<th colspan="6"></th>';
                                echo '<th colspan="2" style = "border-right:1px solid black;font-size:12px;">Total</th>';
                                echo '<th style = "border:1px solid black;text-align:right;font-size:12px;">Rp.'. number_format($RealTotalSlip , 0, ".", ".").'</th>';
                            echo '</tr>';
                            
                        }else /*if($Bagian1 == 'UMUM')*/
                        {
                            echo '<tr>';
                                echo '<th colspan="5"></th>';
                                echo '<th colspan="2"  style = "border-right:1px solid black;font-size:12px;">Total</th>';
                                echo '<th style = "border:1px solid black;text-align:right;font-size:12px;">Rp.'. number_format($TotalSlip , 0, ".", ".").'</th>';
                            echo '</tr>';
                            echo '<tr>';
                                echo '<th colspan="5"></th>';
                                echo '<th colspan="2" style = "border-right:1px solid black;font-size:12px;">Pot BPJS</th>';
                                echo '<th style = "border:1px solid black;text-align:right;font-size:12px;">Rp.'. number_format($bpjs , 0, ".", ".").'</th>';
                            echo '</tr>';
                            echo '<tr>';
                                echo '<th colspan="5"></th>';
                                echo '<th colspan="2" style = "border-right:1px solid black;font-size:12px;">Total</th>';
                                echo '<th style = "border:1px solid black;text-align:right;font-size:12px;">Rp.'. number_format($RealTotalSlip , 0, ".", ".").'</th>';
                            echo '</tr>';
                        }


                        

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
                            echo '<td style ="text-align:center;">Pembuat</td>';
                            echo '<td></td>';
                            echo '<td style ="text-align:center;">Pembayar</td>';
                            echo '<td></td>';
                            echo '<td style ="text-align:center;">Penyetuju</td>';
                            echo '<td></td>';
                            echo '<td style ="text-align:center;">Penerima</td>';
                        echo '</tr>';

                        echo '<tr>';
                            echo '<td><br><br><br><br></td>';
                        echo '</tr>';

                        echo '<tr>';
                            echo '<td style ="text-align:center;">'.$this->RumusGaji->ReplacewithSpace($Pembuat,'%20').'</td>';
                            echo '<td></td>';
                            echo '<td style ="text-align:center;">'.$this->RumusGaji->ReplacewithSpace($Pembayar,'%20').'</td>';
                            echo '<td></td>';
                            echo '<td style ="text-align:center;">'.$this->RumusGaji->ReplacewithSpace($Penyetuju,'%20').'</td>';
                            echo '<td></td>';
                            echo '<td style ="text-align:center;">'.$row1["Nama"].'</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td><br><br></td>';
                        echo '</tr>';
                    echo '</table>';
                
                    
                }
                ?>
                
</div>

<script>
    // $(document).ready(function()
    // {
    //     $('#BodyTable').DataTable();
   
    // });
        
    function printarea(divName){
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        location.reload(1);    
    }

    function closeWindow(){
        if (confirm("Are you sure to close ?")) {
            close();
        }
    }
        
        // $(document).ready(function()
        // {
        //     $('#BodyTable').DataTable();
    
        // });

</script>
