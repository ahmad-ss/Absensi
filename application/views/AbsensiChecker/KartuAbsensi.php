<div class="row mb-2">
    <!-- <h4 class="col-xs-12 col-sm-6 mt-0">Kartu Absensi</h4> -->
    <!-- <div class="col-xs-12 col-sm-6 ml-auto text-Left"> -->
    <!-- <div class="col-md-12">
        <?php // echo 'Id Karywan : '.$karyawan;?>
    </div>  -->   
    <div class="col-md-12">
        <form action="" method="post">    
            <div class="row">
                <!-- <div class="col">
                    <select name="pegawai" id="pegawai" class="form-control">
                        <option value="" disabled selected>-- Pilih Karyawan --</option>
                        <?php foreach($All_karyawan as $bk => $ak): ?>
                            <option value="<?= $ak->ID_Krj ?>" <?= ($ak->ID_Krj == $karyawan) ? 'selected' : '' ?>><?= $ak->NamaLengkap ?></option>
                        <?php endforeach; ?>
                    </select>
                </div> -->
                <div class="col">
                    <select name="pegawai" id="pegawai" class="selectpicker form-control" data-live-search="true">
                        <option data-token="" disabled selected>-- Pilih Karyawan --</option>
                        <?php foreach($All_karyawan as $bk => $ak): ?>
                            <option data-token="<?= $ak->ID_Krj ?> <?= $ak->NamaLengkap ?>" <?= ($ak->ID_Krj == $karyawan) ? 'selected' : '' ?>><?= $ak->NamaLengkap ?> --,<?= $ak->ID_Krj ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col">
                    <select name="bulan" id="bulan" class="form-control">
                        <option value="" disabled selected>-- Pilih Bulan --</option>
                        <?php foreach($all_bulan as $bn => $bt): ?>
                            <option value="<?= $bn ?>" <?= ($bn == $bulan) ? 'selected' : '' ?>><?= $bt ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col ">
                    <select name="tahun" id="tahun" class="form-control">
                        <option value="" disabled selected>- Pilih Tahun -</option>
                        <?php for($i = date('Y'); $i >= (date('Y') - 5); $i--): ?>
                            <option value="<?= $i ?>" <?= ($i == $tahun) ? 'selected' : '' ?>><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col">
                </div>
                <div class="col">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary btn-fill btn-block">Tampilkan</button>
                </div>
            </div>
        </form>    
    </div>
</div>

<div class="row">
<div class="col-md-12">
    <div class="card">
       <!---- Test 123 --->
        <div class="card-header border-bottom">
            <div class="row"> 
                <div class="col-xs-12 col-sm-6">
                    <table class="table border-0">
                        <tr>
                            <th class="border-0 py-0">Nama Pegawai</th>
                            <th class="border-0 py-0">:</th>
                            <th class="border-0 py-0">
                                <?php echo $namakaryawan.'('.$bagian.')'; 
                                ?>
                            </th>
                        </tr>
                        <tr>
                            
                            <th class="border-0 py-0">Absensi Bulan</th>
                            <th class="border-0 py-0">:</th>

                            <th class="border-0 py-0">
                                <?php 
                                    If($bulan!="")
                                    {
                                        echo $this->crud->getBulan($bulan).' '.$tahun;     
                                    }
                                ?>
                            </th>  
                        </tr>
                    </table>
                </div>       
            
            </div>
        </div>  
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Masuk</th>
                                    <th>Tanggal Pulang</th>
                                    <th>Keluar</th>
                                    <th>Keterangan</th>
                                    
                                </thead>
                                <tbody> 
                                    <?php 
                                        
                                        foreach($hari as $i => $h)
                                        {   
                                            If($crud->CekHariLibur($h['tgl'])==true)
                                            {
                                                echo "<tr class=bg-danger text-white>";
                                            } else {
                                                echo "<tr>";
                                            }
                                                echo "<td>".($i+1)."</td>";
                                                echo "<td>".$h['hari'] . ', ' . $h['tgl']."</td>";
                                                $ada=false;
                                                foreach($absen as $r => $a)
                                                {
                                                    If (date('Y-m-d', strtotime($a->Tanggal_Masuk))==date('Y-m-d', strtotime($h['tgl'])))
                                                    {
                                                        echo "<td>".$a->Jam_Masuk."</td>";
                                                        echo "<td>".$a->Tanggal_Pulang."</td>";
                                                        echo "<td>".$a->Jam_Pulang."</td>";
                                                        echo "<td>".$a->Keterangan."</td>";
                                                        $ada=true;
                                                    }
                                                }
                                                If ($ada==False)
                                                {
                                                    $this->db->select('*');
                                                    $this->db->where('ID_Krj', $ID_Krj);
                                                    $this->db->where('Tgl_Cuti', date('Y-m-d',strtotime($h['tgl'])));
                                                    $izin = $this->db->get('hrd_daftarizin')->result_array();
                                                    if($izin != null){
                                                        echo "<td></td>";
                                                        echo "<td></td>";
                                                        echo "<td></td>";
                                                        echo "<td>, ". $izin['0']['Alasan']."</td>";
                                                    }else{
                                                        echo "<td></td>";
                                                        echo "<td></td>";
                                                        echo "<td></td>";
                                                        echo "<td></td>"; 
                                                    }
                                                }
                                            echo "<tr>";
                                        }
                                        
                                        // foreach($Karyawan as $i => $k)
                                        // {
                                        //                                                         //     
                                        //     echo "<td>".$k->Nama."</td>";
                                        //     foreach($hari as $h)
                                        //     {
                                        //         $Libur=$crud->CekHariLibur($h['tgl']);
                                        //         iF($Libur==True)
                                        //         {
                                        //             echo "<td class=bg-danger text-white>";
                                        //         } Else {
                                        //             echo "<td>";
                                        //         }
                                        //         foreach($absen as $r => $a)
                                        //         {
                                        //             If (($a->Kd_Bagian==$k->Kd_Bagian) && ($a->Nama==$k->Nama) && date('Y-m-d', strtotime($a->TanggalAbsen))==date('Y-m-d', strtotime($h['tgl'])))
                                        //             {
                                        //                 echo $a->Kd_Status; 
                                        //                 If ($a->Kd_Status=="T")
                                        //                 {  $Telat[$i]++;     }
                                        //                 If ($a->Kd_Status=="I")
                                        //                 {  $Ijin[$i]++;   }
                                        //                 If ($a->Kd_Status=="C")
                                        //                 { $Ijin[$i]++;     }
                                        //                 If ($a->Kd_Status=="S")
                                        //                 { $Sakit[$i]++;   }
                                        //                 If ($a->Kd_Status=="A")
                                        //                 { $Alfa[$i]++;        }
                                        //                 If ($a->Kd_Status=="M")
                                        //                 {  $Masuk[$i]++;      }
                                        //             }
                                        //         }
                                        //         echo "</td >";
                                        //     }
                                            // echo "<td>".$Telat[$i]."</td>";
                                            // echo "<td>".$Ijin[$i]."</td>";
                                            // echo "<td>".$Sakit[$i]."</td>";
                                            // echo "<td>".$Alfa[$i]."</td>";
                                            // echo "</tr>";
                                        //} 
                                    ?>                                    
                                </tbody>
                            </table>    
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
</div>