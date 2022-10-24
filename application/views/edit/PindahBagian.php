<!--Datatable-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css">
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Form Pindah Bagian</h5>
                <form method="POST" action="<?php echo base_url() . "index.php/Editp/pindah_bagian"; ?>">
                    <div class="mb-3 row">
                        <label for="" class="col-sm-2 col-form-label">Karyawan</label>
                        <div class="col-sm-5">
                            <select class="selectpicker form-control" id="kryw" name="kryw" data-live-search="true">
                                <option>Pilih Karyawan</option>
                                <?php $idkrj = 0;
                                foreach ($users as $id) {
                                    if ($idkrj == 0 || $idkrj != $id->ID_Krj) :
                                        echo "<option value='" . $id->ID_Krj . "'>" . $id->ID_Krj . ", -- " . $id->NamaLengkap . "</option>";
                                        $idkrj = $id->ID_Krj;
                                    endif;
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Pindah Jabatan</label>
                        <div class="col-sm-5">
                            <select class="form-control" id="jbtn" name="jbtn">
                                <option value="">Pilih Salah Satu</option>
                                <?php
                                foreach ($kdjbtn as $jb) {
                                    echo "<option value='" . $jb->Kd_Jabatan . "'>" . $jb->Jabatan . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Pindah Divisi</label>
                        <div class="col-sm-5">
                            <select class="form-control" id="div" name="div">
                                <option value="">Pilih Salah Satu</option>
                                <?php
                                foreach ($kddiv as $div) {
                                    echo "<option value='" . $div->Kd_Divisi . "'>" . $div->Devisi . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Pindah Cabang</label>
                        <div class="col-sm-5">
                            <select class="form-control" id="cbg" name="cbg">
                                <option value="">Pilih Salah Satu</option>
                                <?php
                                foreach ($kdcabang as $cb) {
                                    echo "<option value='" . $cb->Kd_Cabang . "'>" . $cb->Cabang . "</option>";
                                }
                                ?>
                            </select>
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
                                <th class="text-center text-uppercase">NAMA</th>
                                <th class="text-center text-uppercase">ID</th>
                                <th class="text-center text-uppercase">Jabatan</th>
                                <th class="text-center text-uppercase">Divisi</th>
                                <th class="text-center text-uppercase">Cabang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $bagian = '';
                            $idkrj = 0; ?>
                            <?php $idx = 0;
                            $no = 0;
                            foreach ($users as $usr) :
                                if ($idkrj == 0 || $idkrj != $usr->ID_Krj) : ?>
                                    <tr>
                                        <td class="text-left"><?php echo $no = $no + 1; ?></td>
                                        <td class="text-left"><?php echo $usr->NamaLengkap; ?></td>
                                        <td class="text-left"><?php echo $usr->ID_Krj; ?></td>
                                        <td class="text-left"><?php echo $usr->Jabatan; ?></td>
                                        <td class="text-left"><?php echo $usr->Devisi; ?></td>
                                        <td class="text-left"><?php echo $usr->Cabang; ?></td>
                                    </tr>
                            <?php $idx++;
                                    $idkrj = $usr->ID_Krj;
                                endif;
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