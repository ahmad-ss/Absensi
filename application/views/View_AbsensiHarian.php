<div class="row mb-2">
    <h4 class="col-xs-12 col-sm-6 mt-0">Daftar Absensi Harian <?= $Nama_Bagian; ?></h4>
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
                    <input type="date" class="form-control" name="date_out" value="<?= $Tanggal; ?>"/>
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
                            <th class="border-0 py-0">Hari</th>
                            <th class="border-0 py-0">:</th>
                            <th class="border-0 py-0"><?= $this->crud->getHari($Tanggal) ?></th>  
                        </tr>
                        <tr>
                            <th class="border-0 py-0">Tanggal</th>
                            <th class="border-0 py-0">:</th>
                            <th class="border-0 py-0"><?= date('d-F-Y',strtotime($Tanggal)) ?></th> 


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
                            <a href="<?= base_url('LaporanHarian'. $this->uri->segment(3) . "?Bagian=$Nama_Bagian&Tanggal=$Tanggal&Format=_PDF") ?>" class="dropdown-item" target="_blank"><i class="fa fa-file-pdf-o"></i>PDF</a>
                            <a href="<?= base_url('LaporanHarian'. $this->uri->segment(3) . "?Bagian=$Nama_Bagian&Tanggal=$Tanggal&Format=_XLS") ?>" class="dropdown-item" target="_blank"><i class="fa fa-file-excel-o"></i>Excel</a>
                        </div>
                        
                        
                    </div>
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
                                <th>Nama</th>
                                <th>In</th>
                                <th>Out</th>
                                <th>Keterangan</th>
                            </thead>
                            <tbody> 
                                <?php foreach($Karyawan as $i => $k): ?>
                                    <tr>
                                        <td><?= ($i+1) ?></td>
                                        <td><?= $k->Nama; ?></td>
                                        <?php $Ketemu="0"; ?>
                                        <?php foreach($absen  as $j => $a): ?>
                                            <?php        
                                                If ($k->Nama==$a->Nama And $k->No_Urut==$a->No_Urut)
                                                {
                                                    $Ketemu="1";
                                                    echo "<td>".$a->JamMasuk."</td>"; 
                                                    echo "<td>".$a->JamPulang."</td>"; 
                                                    echo "<td>".$a->Keterangan."</td>";
                                                }
                                            ?>
                                        <?php endforeach; ?>  
                                        <?php 
                                            if ($Ketemu=="0")
                                            {
                                                echo "<td></td>"; 
                                                echo "<td></td>"; 
                                                echo "<td></td>";
                                            }
                                        ?>
                                    </tr>
                                <?php endforeach; ?>  
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