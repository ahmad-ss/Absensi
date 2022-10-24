<!--Datatable-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css">
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div id="alert-users"></div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tbKaryawan" style="font-size:12px;">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase">NO</th>
                                <th class="text-center text-uppercase">Kode ID</th>
                                <th class="text-center text-uppercase">NIK</th>
                                <th class="text-center text-uppercase">NIP</th>
                                <th class="text-center text-uppercase">Nama Lengkap</th>
                                <th class="text-center text-uppercase">Cabang</th>
                                <th class="text-center text-uppercase">Divisi</th>
                                <th class="text-center text-uppercase">Jabatan</th>
                                <th class="text-center text-uppercase">Tanggal Masuk</th>

                                <th class="text-center text-uppercase">Gaji</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $bagian = ''; ?>
                            <?php $idx = 0;
                            foreach ($users as $usr) : ?>
                                <tr>
                                    <td class="text-left"><?php echo $usr->NIK; ?></td>
                                    <td class="text-left"><?php echo $usr->NIP; ?></td>
                                </tr>
                            <?php $idx++;
                            endforeach; ?>
                        </tbody>
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