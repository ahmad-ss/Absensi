<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Absen <?= $Karyawan->Nama ?> bulan <?= bulan($bulan) . ', ' . $tahun ?></title>

    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    
    <style type="text/css">
        table tr td,
        table tr th{
            font-size: 8pt;
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <div class="row mt-2">
        <div class="mt-2">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <div class="float-left">
                                <table class="table">
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
                        </div>

                        <div class="card-body">
                            <h5 class="card-title mb-4">Absen Bulan : <?= bulan($bulan) . ' ' . $tahun ?></h5>
                            <!-- <p> -->
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Keluar</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
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
                            
                                </tbody>
                            </table>
                        <!-- </p> -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>