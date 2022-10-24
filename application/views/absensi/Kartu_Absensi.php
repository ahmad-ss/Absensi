<div class="row mb-2">
    <h4 class="col-xs-12 col-sm-6 mt-0">Detail Absen</h4>
    <div class="col-xs-12 col-sm-6 ml-auto text-right">
        <form action="" method="get">
            <div class="row">
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
                <div class="col ">
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
                            <th class="border-0 py-0">Nama</th>
                            <th class="border-0 py-0">:</th>
                            <th class="border-0 py-0"><?= $Karyawan->Nama ?></th> 
                        </tr>
                        <tr>
                            <th class="border-0 py-0">Divisi</th>
                            <th class="border-0 py-0">:</th>
                            <th class="border-0 py-0"><?= $Karyawan->Bagian.'-'. $Karyawan->SubBagian ?></th>
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
                                <a href="<?= base_url('LaporanF' . $this->uri->segment(3) . "?bulan=$bulan&tahun=$tahun") ?>" class="dropdown-item" target="_blank"><i class="fa fa-file-pdf-o"></i> PDF</a>
                                <!--
                                <a href="<?= base_url('absensi/export_pdf/' . $this->uri->segment(3) . "?bulan=$bulan&tahun=$tahun") ?>" class="dropdown-item" 
                                    get="_blank"><i class="fa fa-file-pdf-o"></i> PDF</a> -->
                                <a href="<?= base_url('absensi/export_excel/' . $this->uri->segment(3) . "?bulan=$bulan&tahun=$tahun") ?>" class="dropdown-item" target="_blank"><i class="fa fa-file-excel-o"></i> Excel</a>
                        </div>
                    </div>
                </div>
            
            </div>
            
        </div>  
  
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Absen Bulan : <?php echo $crud->getBulan($bulan).' '.$tahun ?></h4>
                        <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Keterangan</th>
                            </thead>
                            <tbody>
                                <?php if($absen): //print_r($libur); //print_r($absen); ?>
                                    <?php foreach($hari as $i => $h): ?>
                                        <?php
                                            If($h['tgl']!=''){
                                                $absen_harian =$crud->getDataWhere('absensiharian',array('TglAbsensi_Karyawan' => date('Y-m-d',strtotime($h['tgl'])),'id_Karyawan'=>$Karyawan->id_Karyawan))->result();   
                                                $hari_libur=$crud->getDataWhere('hari_libur',array('Date'=>date('Y-m-d',strtotime($h['tgl']))))->result();
                                            }

                                        ?>

                                        <tr
                                            <?php 
                                                foreach($hari_libur as $hl)  {
                                                    if($hl->Date!='')
                                                    {
                                                        echo 'class="bg-danger text-white"';
                                                    }
                                                    
                                                } 
                                                if($h['hari']=='Minggu')
                                                    {echo 'class="bg-danger text-white"'; }   
                                            ?>   
                                        >
                                        <td><?= ($i+1) ?></td>
                                        <td><?= $h['hari'] . ', ' . $h['tgl'] ?></td>
                                        <td>
                                            <?php 
                                                foreach($absen_harian as $a)  {
                                                    echo $a->JamMasuk_Karyawan.'<br>';
                                                } 
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                foreach($absen_harian as $a)  {
                                                    echo $a->JamKeluar_Karyawan.'<br>';
                                                } 
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                $Ket='';
                                                foreach($absen_harian as $a)  {
                                                   if($a->Keterangan!='') 
                                                   {
                                                        $Ket=$Ket.$a->Keterangan;
                                                   }
                                                } 
                                                  
                                                foreach($hari_libur as $hl)  {
                                                    if($hl->Nama_hari_libur!='')
                                                    {
                                                        if ($Ket!='') {$Ket=$Ket.",";}
                                                        $Ket=$Ket.$hl->Nama_hari_libur;
                                                    }
                                                }
                                                echo $Ket;
                                            ?>

                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td class="bg-light" colspan="4">Tidak ada data absen</td>
                                    </tr>
                                <?php endif; ?>
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