<!--Datatable-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css">
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Karyawan Keluar</h5>
                <form method="POST" action="<?php echo base_url() . "index.php/Editp/pecat_karyawan"; ?>">
                    <div class="mb-3 row">
                        <label for="" class="col-sm-2 col-form-label">Karyawan</label>
                        <div class="col-sm-5">
                            <select class="selectpicker form-control" id="kryw" name="kryw" data-live-search="true">
                                <option>Pecat/Resign</option>
                                <?php $idkrj = 0;
                                foreach ($karyawan as $id) :
                                    if ($idkrj == 0 || $idkrj != $id->ID_Krj) {
                                        echo "<option value='" . $id->ID_Krj . "'>" . $id->ID_Krj . ", -- " . $id->NamaLengkap . "</option>";
                                        $idkrj = $id->ID_Krj;
                                    } else {
                                    }
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Tanggal Keluar</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control" id="tglklr" name="tglklr" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Alasan</label>
                        <div class="col-sm-5">
                            <textarea class="form-control" id="alasan" name="alasan"></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-8">
                            <input type="submit" class="btn btn-primary" value="Simpan">
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
                                <th class="text-center text-uppercase">NO</th>
                                <th class="text-center text-uppercase">ID</th>
                                <th class="text-center text-uppercase">NAMA</th>
                                <th class="text-center text-uppercase">NIK</th>
                                <th class="text-center text-uppercase">NIP</th>
                                <th class="text-center text-uppercase">Alasan</th>
                                <th class="text-center text-uppercase">Tanggal Keluar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $bagian = '';
                            $idkrj = 0; ?>
                            <?php $idx = 0;
                            $no = 0;
                            foreach ($users as $usr) :
                                if ($idkrj == 0 || $idkrj != $usr->ID_Krj) { ?>
                                    <tr>
                                        <td class="text-left"><?php echo $no = $no + 1; ?></td>
                                        <td class="text-left"><?php echo $usr->ID_Krj; ?></td>
                                        <td class="text-left"><?php echo $usr->NamaLengkap; ?></td>
                                        <td class="text-left"><?php echo $usr->NIK; ?></td>
                                        <td class="text-left"><?php echo $usr->NIP; ?></td>
                                        <td class="text-left"><?php echo $usr->Alasan_Keluar; ?></td>
                                        <td class="text-left"><?php echo $usr->Tanggal_Keluar; ?></td>
                                    </tr>
                            <?php $idx++;
                                    $idkrj = $usr->ID_Krj;
                                } else {
                                }
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
<script src="js/demo/datatables-demo.js"></script>