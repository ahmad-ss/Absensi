<div class="row mb-2">
    <h4 class="col-xs-12 col-sm-6 mt-0">Daftar Absensi Bulanan <?= $Nama_Bagian; ?></h4>
    <div class="col-xs-12 col-sm-6 ml-auto text-right">
        <form action="" method="post">
            <div class="row">
                <div class="col">
                    <select name="bagian" id="bagian" class="form-control">
                        <option value="" disabled selected>-- Pilih Bagian --</option>
                        <?php foreach($all_bagian as $bn => $bt): ?>
                            <option value="<?= $bt->Kd_Bagian; ?>" <?= ($bt->Kd_Bagian == $Bagian) ? 'selected' : '' ?>><?= $bt->Nm_Bagian; ?></option>
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
                    </table>
                </div>       
                <div class="col-xs-12 col-sm-6 ml-auto text-right mb-2">
                    <div class="dropdown d-inline">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="droprop-action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-print"></i>
                                Export Laporan
                        </button>
                        <div class="dropdown-menu" aria-labelledby="droprop-action">
                            <a href="<?= base_url('LaporanBulanan'. $this->uri->segment(3) . "?Nm_Bagian=$Nama_Bagian&Bulan=$bulan&tahun=$tahun&Format=_PDF") ?>" class="dropdown-item" target="_blank"><i class="fa fa-file-pdf-o"></i>PDF</a>
                            <a href="<?= base_url('LaporanBulanan'. $this->uri->segment(3) . "?Nm_Bagian=$Nama_Bagian&Bulan=$bulan&tahun=$tahun&Format=_XLS") ?>" class="dropdown-item" target="_blank"><i class="fa fa-file-excel-o"></i>Excel</a>
                        </div>

                    </div>
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
                                    <th>SAKIT</th>
                                    <th>ALFA</th>
                                </thead>
                                <tbody> 
                                    
                                    <?php 
                                        foreach($Karyawan as $i => $k)
                                        {
                                            $Telat[$i]=0;
                                            $Ijin[$i]=0;
                                            $Sakit[$i]=0;
                                            $Alfa[$i]=0;
                                            $Masuk[$i]=0;
                                        }
                                        foreach($Karyawan as $i => $k)
                                        {
                                            echo "<tr>";            
                                            echo "<td>".($i+1)."</td>";
                                            echo "<td>".$k->Nama."</td>";
                                            foreach($hari as $h)
                                            {
                                                $Libur=$crud->CekHariLibur($h['tgl']);
                                                iF($Libur==True)
                                                {
                                                    echo "<td class=bg-danger text-white>";
                                                } Else {
                                                    echo "<td>";
                                                }
                                                foreach($absen as $r => $a)
                                                {
                                                    If (($a->Kd_Bagian==$k->Kd_Bagian) && ($a->Nama==$k->Nama) && date('Y-m-d', strtotime($a->TanggalAbsen))==date('Y-m-d', strtotime($h['tgl'])))
                                                    {
                                                        echo $a->Kd_Status; 
                                                        If ($a->Kd_Status=="T")
                                                        {  $Telat[$i]++;     }
                                                        If ($a->Kd_Status=="I")
                                                        {  $Ijin[$i]++;   }
                                                        If ($a->Kd_Status=="C")
                                                        { $Ijin[$i]++;     }
                                                        If ($a->Kd_Status=="S")
                                                        { $Sakit[$i]++;   }
                                                        If ($a->Kd_Status=="A")
                                                        { $Alfa[$i]++;        }
                                                        If ($a->Kd_Status=="M")
                                                        {  $Masuk[$i]++;      }
                                                    }
                                                }
                                                echo "</td >";
                                            }
                                            echo "<td>".$Telat[$i]."</td>";
                                            echo "<td>".$Ijin[$i]."</td>";
                                            echo "<td>".$Sakit[$i]."</td>";
                                            echo "<td>".$Alfa[$i]."</td>";
                                            echo "</tr>";
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