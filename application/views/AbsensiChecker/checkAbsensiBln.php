<div class="row mb-2">
    <h4 class="col-xs-12 col-sm-6 mt-0">Daftar Absensi Bulanan </h4>
    <div class="col-xs-12 col-sm-6 ml-auto text-right">
        <form action="" method="post">
            <div class="row">
                <div class="col">
                        <select name="bagian" id="bagian" class="form-control">
                            <option value="" disabled selected>-- Pilih Divisi --</option>
                            <?php 
                            if($Devisi == ""){
                                echo "<option value='Warehouse'>Warehouse</option>";
                            }else{
                                echo "<option value='Warehouse' selected>Warehouse</option>";
                            }
                            ?>
                            <?php foreach($all_bagian as $bn => $bt):
                                if($bt->Devisi=="Produksi-Pembahanan" ||$bt->Devisi=="Produksi-Finishing" ||$bt->Devisi=="Produksi-Packing" || $bt->Devisi=="Produksi-Bongkar Muat" ||$bt->Devisi=="Sample"){
                                        //kosongan
                                    }else{ ?>
                                <option value="<?= $bt->Devisi; ?>" <?= ($bt->Devisi == $Devisi) ? 'selected' : '' ?>><?= $bt->Devisi; ?></option>
                                <?php } endforeach; ?>
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
                        <option value="" disabled selected>-- Pilih Tahun</option>
                        <?php for($i = date('Y'); $i >= (date('Y') - 5); $i--): ?>
                            <option value="<?= $i ?>" <?= ($i == $tahun) ? 'selected' : '' ?>><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
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
                        <tr>
                            <th class="border-0 py-0">Devisi</th>
                            <th class="border-0 py-0">:</th>        
                            <th class="border-0 py-0">
                                <?php 
                                    If($bulan!="")
                                    {
                                        echo $Devisi;
                                    }
                                ?>
                            </th>  
                        </tr>
                    </table>
                </div>       
                <!-- Ini Nati Tempa Menu Export--->
            
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
                                    <th>Nama</th>
                                    <?php 
                                        foreach($hari as $i => $h)
                                        {
                                            $Libur=$crud->CekHariLibur($h['tgl']);
                                            iF($Libur==True)
                                            {
                                                echo "<th style=background-color:#FF0000>";
                                            } else {
                                                echo "<th>";
                                            }
                                            echo date('d', strtotime($h['tgl'])).'</th>'; 
                                        } 
                                    ?>
                                    <th>TELAT</th>
                                    <th>IJIN/CUTI</th>
                                    <!-- <th>SAKIT</th> -->
                                    <th>ALFA</th>
                                </thead>
                                <tbody> 
                                    
                                    <?php
                                    $blnthn = $tahun .'-'.$bulan;
                                    $min = explode("-", $tglmin);
                                    $max = explode("-", $tglmax);
                                        foreach($Karyawan as $i => $k)
                                        {
                                            $Telat[$i]=0;
                                            $Ijin[$i]=0;
                                            $Sakit[$i]=0;
                                            $Alfa[$i]=0;
                                            $Masuk[$i]=0;
                                        }
                                        $no = 1;
                                        $j=0;
                                        foreach($Karyawan as $k)
                                        {
                                            $idkrj = $k['ID_Krj'];
                                            echo "<tr>";            
                                            echo "<td>".$no++."</td>";
                                            echo "<td>".$k['NamaLengkap']."</td>";
                                            foreach($hari as $h)
                                            {
                                                $i = date('d', strtotime($h['tgl']));
                                                $Libur=$crud->CekHariLibur($h['tgl']);
                                                iF($Libur==True)
                                                {
                                                    echo "<td class=bg-danger text-white>";
                                                } Else {
                                                    echo "<td>";
                                                }
                                                //UNTUK PRINT KETERANGAN
                                                $this->db->select('*');
                                                $this->db->where('ID_Krj', $idkrj);
                                                $this->db->where('Tanggal_Masuk', date('Y-m-d', strtotime($h['tgl'])));
                                                $absen = $this->db->get('hrd_detail_absensi')->result_array();
                                                if ($i < $min['2']) {
                                                    echo "-";
                                                } elseif ($i > $max['2']) {
                                                    echo "-";
                                                } else {
                                                    if ($absen == null) {
                                                        $this->db->select('*');
                                                        $this->db->where('ID_Krj', $idkrj);
                                                        $this->db->where('Tgl_Cuti', date('Y-m-d',strtotime($h['tgl'])));
                                                        $izin = $this->db->get('hrd_daftarizin')->result_array();
                                                        //$izin = null;
                                                        if(date('Y-m-d',strtotime($h['tgl'])) <= $k['Tanggal_Masuk']){
                                                            echo "-";
                                                        }elseif($Libur==true){
                                                            echo "-";
                                                        }else{
                                                            if ($izin == null) {
                                                                $Alfa[$j]++;
                                                                echo "-";
                                                            } else {
                                                                $Ijin[$j]++;
                                                                echo "I";
                                                            }
                                                        }
                                                    } else {
                                                        $cek = $absen['0'];
                                                        if ($cek['Absen_Masuk'] <= $cek['Jam_Masuk']) {
                                                            $Masuk[$j]++;
                                                            echo "M";
                                                        } else {
                                                            $Telat[$j]++;
                                                            echo "T";
                                                        }
                                                    }
                                                }
                                                //END
                                                echo "</td >";
                                            }
                                            echo "<td>".$Telat[$j]."</td>";
                                            echo "<td>".$Ijin[$j]."</td>";
                                            // echo "<td>".$Sakit[$j]."</td>";
                                            echo "<td>".$Alfa[$j]."</td>";
                                            echo "</tr>";
                                            $j++;
                                        } 
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