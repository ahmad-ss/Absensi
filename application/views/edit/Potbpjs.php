<!--Datatable-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css">
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Input Potongan BPJS</h5>
                <form method="POST" action="<?php echo base_url() . "index.php/Editp/update_bpjs"; ?>">
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Nama Karyawan</label>
                        <div class="col-sm-5">
                            <select class="selectpicker form-control" id="idkrj" name="idkrj" data-live-search="true">
                                <option data-tokens="">Pilih Karyawan</option>
                                <?php
                                foreach ($users as $usr) {
                                    echo "<option data-tokens='" . $usr->ID_Krj . " -- " . $usr->NamaLengkap . "'>" . $usr->ID_Krj . ", -- " . $usr->NamaLengkap . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Potongan BPJS</label>
                        <div class="col-sm-5">
                            <input type="number" class="form-control" id="potbpjs" name="potbpjs">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-5">
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
                                <th class="text-center text-uppercase">NIK</th>
                                <th class="text-center text-uppercase">NIP</th>
                                <th class="text-center text-uppercase">ID</th>
                                <th class="text-center text-uppercase">Nama Lengkap</th>
                                <th class="text-center text-uppercase">Tanggal Berlaku BPJS</th>
                                <th class="text-center text-uppercase">Pot BPJS</th>
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
                                    <td class="text-left"><?php echo $usr->Tanggal_BPJS; ?></td>
                                    <td class="text-left"><?php echo $usr->PotBPJS; ?></td>
                                    <td class="text-left"><?php if ($usr->Aktif == '0') {
                                                                echo 'Tidak Aktif';
                                                            } else {
                                                                echo 'Aktif';
                                                            } ?></td>

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