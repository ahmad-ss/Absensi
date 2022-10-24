<!--Datatable-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css">
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Naik Gaji Harian</h5>
                <form method="POST" action="<?php echo base_url() . "index.php/Editp/update_gajikary_harian"; ?>">
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Nama Karyawan</label>
                        <div class="col-sm-5">
                            <select class="selectpicker form-control" name="idkrj" id="idkrj" data-live-search="true" required>
                                <option data-tokens="">Pilih Karyawan</option>
                                <?php
                                foreach ($karyawan as $kry) {
                                    echo "<option data-tokens='" . $kry->ID_Krj . " -- " . $kry->NamaLengkap . "'>" . $kry->ID_Krj . ", -- " . $kry->NamaLengkap . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Gaji</label>
                        <div class="col-sm-5">
                            <input type="number" class="form-control" id="gaji" name="gaji" placeholder="Rp. 000000" required>
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
                                <th class="text-center text-uppercase">NIK</th>
                                <th class="text-center text-uppercase">NIP</th>
                                <th class="text-center text-uppercase">ID</th>
                                <th class="text-center text-uppercase">Nama Lengkap</th>
                                <th class="text-center text-uppercase">Tanggal Mulai</th>
                                <th class="text-center text-uppercase">Gaji</th>
                                <th class="text-center text-uppercase">Gaji Harian</th>
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
                                    <td class="text-left"><?php echo $usr->GajiarPer; ?></td>
                                    <td class="text-left"><?php echo $usr->GajiPerHari; ?></td>
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