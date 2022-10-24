<!--Datatable-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css">
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div id="alert-users"></div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tbKaryawan" style="width:100%;table-layout: auto;">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase">NO</th>
                                <th class="text-center text-uppercase">NIK</th>
                                <th class="text-center text-uppercase">NIP</th>
                                <th class="text-center text-uppercase">ID</th>
                                <th class="text-center text-uppercase">Nama Lengkap</th>
                                <th class="text-center text-uppercase">Tanggal Masuk</th>
                                
                                <th class="text-center text-uppercase">Gaji Harian</th>
                                <th class="text-center text-uppercase">Gaji Lembur</th>
                                <th class="text-center text-uppercase">Cabang</th>
                                <th class="text-center text-uppercase">Jabatan</th>
                                <th class="text-center text-uppercase">Divisi</th>
                                <th class="text-center text-uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $bagian = ''; ?>
                            <?php $idx = 1;
                            foreach ($users as $usr) : ?>
                                <tr>
                                    <td class="text-left"><?php echo $idx; ?></td>
                                    <td class="text-left"><?php echo $usr->NIK; ?></td>
                                    <td class="text-left"><?php echo $usr->NIP; ?></td>
                                    <td class="text-left"><?php echo $usr->ID_Krj; ?></td>
                                    <td class="text-left"><?php echo $usr->NamaLengkap; ?></td>
                                    <td class="text-left"><?php echo $usr->Tgl_Mulai; ?></td>
                                    
                                    <td class="text-left"><?php echo $usr->GajiPerHari; ?></td>
                                    <td class="text-left"><?php echo $usr->GajiPerJam; ?></td>
                                    <td class="text-left"><?php echo $usr->Cabang; ?></td>
                                    <td class="text-left"><?php echo $usr->Jabatan; ?></td>
                                    <td class="text-left"><?php echo $usr->Devisi; ?></td>
                                    <td class="text-left"><?php if ($usr->Aktif == '0') {
                                                                echo 'Tidak Aktif';
                                                            } else {
                                                                echo 'Aktif';
                                                            } ?></td>       
                                </tr>
                            <?php $idx++;
                            endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center text-uppercase">NO</th>
                                <th class="text-center text-uppercase">NIK</th>
                                <th class="text-center text-uppercase">NIP</th>
                                <th class="text-center text-uppercase">ID</th>
                                <th class="text-center text-uppercase">Nama Lengkap</th>
                                <th class="text-center text-uppercase">Tanggal Masuk</th>
                                
                                <th class="text-center text-uppercase">Gaji Harian</th>
                                <th class="text-center text-uppercase">Gaji Lembur</th>
                                <th class="text-center text-uppercase">Cabang</th>
                                <th class="text-center text-uppercase">Jabatan</th>
                                <th class="text-center text-uppercase">Divisi</th>
                                <th class="text-center text-uppercase">Status</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('#tbKaryawan').DataTable({
            "ordering": false
        });
    });

    function preChangeStatus(id_user, v) {
        var cf = '';
        if (v == 1) {
            cf = confirm("Are you sure to active this user ?");
        } else {
            cf = confirm("Are you sure to not active this user ?");
        }

        if (cf) {
            changeStatus(id_user, v);
        }
    }
</script>