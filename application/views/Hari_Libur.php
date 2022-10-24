<!--Datatable-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css">
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Tambah Hari Libur -> Insert</h5>
                <form method="POST" action="<?php echo base_url() . "index.php/inputp/add_harilibur" ?>">
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Nama Hari Libur</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="namahr" name="namahr">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Tanggal Hari Libur</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control" id="tgllbr" name="tgllbr">
                        </div>
                        <div class="col-sm-3">
                            <input type="submit" class="btn btn-primary" id="tgllbr" value="Simpan">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div id="alert-users"></div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tbKaryawan" style="font-size:12px;">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase">ID</th>
                                <th class="text-center text-uppercase">Tanggal</th>
                                <th class="text-center text-uppercase">Nama Hari Libur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $bagian = ''; ?>
                            <?php $idx = 0;
                            foreach ($users as $usr) : ?>
                                <tr>
                                    <td class="text-left"><?php echo $usr->id; ?></td>

                                    <td class="text-left">
                                        <?php if ($usr->Tanggal != null && $usr->Tanggal != '0000-00-00') {
                                            echo date('d F Y', strtotime($usr->Tanggal));
                                        }
                                        ?>

                                    </td>
                                    <td class="text-left"><?php echo $usr->NamaHariLibur; ?></td>
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