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
                                <th class="text-center text-uppercase">NKK</th>
                                <th class="text-center text-uppercase">NIP</th>
                                <th class="text-center text-uppercase">ID</th>
                                <th class="text-center text-uppercase">Nama Lengkap</th>
                                <th class="text-center text-uppercase">Tempat Lahir</th>
                                <th class="text-center text-uppercase">Tanggal Lahir</th>
                                <th class="text-center text-uppercase">BPJS KES</th>
                                <th class="text-center text-uppercase">BPJS TK</th>
                                <th class="text-center text-uppercase">Berkas-Berkas</th>
                                <th class="text-center text-uppercase">Action</th>
                                <th class="text-center text-uppercase">Tanggal Keluar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $idkrj = 0; ?>
                            <?php $idx = 0;
                            $no = 0;
                            foreach ($users as $usr) :
                                if ($idkrj == 0 || $idkrj != $usr->ID_Krj) : ?>
                                    <tr>
                                        <td class="text-left"><?php echo $no = $no + 1; ?></td>
                                        <td class="text-left"><?php echo $usr->NIK; ?></td>
                                        <td class="text-left"><?php echo $usr->NKK; ?></td>
                                        <td class="text-left"><?php echo $usr->NIP; ?></td>
                                        <td class="text-left"><?php echo $usr->ID_Krj; ?></td>
                                        <td class="text-left"><?php echo $usr->NamaLengkap; ?></td>
                                        <td class="text-left"><?php echo $usr->Tempat_lahir; ?></td>
                                        <td class="text-left"><?php echo $usr->Tanggal_lahir; ?></td>
                                        <td class="text-left"><?php echo $usr->BPJS_KIS; ?></td>
                                        <td class="text-left"><?php echo $usr->BPJS_TK; ?></td>

                                        <td class="text-left">
                                            <table style="border:0;">
                                                <tr style="border:none;height: 35px;">
                                                    <td style="border:none; padding: 0;width: 75px;">
                                                        <?php if ($usr->Foto_KK != null) : ?>
                                                            <a class="btn btn-info btn-sm" href="<?php echo base_url() . $usr->Foto_KK; ?>">KK</a>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td style="border:none; padding: 0;width: 75px;">
                                                        <?php if ($usr->Foto_KTP != null) : ?>
                                                            <a class="btn btn-info btn-sm" href="<?php echo base_url() . $usr->Foto_KTP; ?>">KTP</a>
                                                        <?php endif; ?>
                                                    </td>

                                                </tr>
                                                <tr style="border:none;height: 35px;">
                                                    <td style="border:none; padding: 0;width: 75px;">
                                                        <?php if ($usr->Foto_Akte != null) : ?>
                                                            <a class="btn btn-info btn-sm" href="<?php echo base_url() . $usr->Foto_Akte; ?>">Akte</a>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td style="border:none; padding: 0;width: 75px;">
                                                        <?php if ($usr->Foto_Kontrak != null) : ?>
                                                            <a class="btn btn-info btn-sm" href="<?php echo base_url() . $usr->Foto_Kontrak; ?>">Komtrak</a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr style="border:none;height: 35px;">
                                                    <td style="border:none; padding: 0;width: 75px;">
                                                        <?php if ($usr->Foto_Lamaran != null) : ?>
                                                            <a class="btn btn-info btn-sm" href="<?php echo base_url() . $usr->Foto_Lamaran; ?>">Lamaran</a>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td style="border:none; padding: 0;width: 75px;">
                                                        <?php if ($usr->Foto_SKCK != null) : ?>
                                                            <a class="btn btn-info btn-sm" href="<?php echo base_url() . $usr->Foto_SKCK; ?>">SKCK</a>
                                                        <?php endif; ?>
                                                    </td>

                                                </tr>

                                                <tr style="border:none;height: 35px;">
                                                    <td style="border:none; padding: 0;width: 75px;">
                                                        <?php if ($usr->Foto_Ijazah != null) : ?>
                                                            <a class="btn btn-info btn-sm" href="<?php echo base_url() . $usr->Foto_Ijazah; ?>">Ijazah</a>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td style="border:none; padding: 0;width: 75px;">
                                                        <?php if ($usr->Foto_CV != null) : ?>
                                                            <a class="btn btn-info btn-sm" href="<?php echo base_url() . $usr->Foto_CV; ?>">CV</a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border:none; padding: 0;width: 75px;">
                                                        <?php if ($usr->Foto_Sertifikat != null) : ?>
                                                            <a class="btn btn-info btn-sm" href="<?php echo base_url() . $usr->Foto_Sertifikat; ?>">Sertifikat</a>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td style="border:none; padding: 0;width: 75px;">
                                                        <?php if ($usr->Foto_SIM != null) : ?>
                                                            <a class="btn btn-info btn-sm" href="<?php echo base_url() . $usr->Foto_SIM; ?>">SIM</a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td><a href="<?php echo base_url() . 'dashboard/Editkary/' . $usr->ID_Krj ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a></td>
                                        <td class="text-left"><?php echo $usr->Tanggal_Keluar; ?></td>
                                    </tr>
                            <?php $idx++;
                                endif;
                                $idkrj = $usr->ID_Krj;
                            endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center text-uppercase">NO</th>
                                <th class="text-center text-uppercase">NIK</th>
                                <th class="text-center text-uppercase">NKK</th>
                                <th class="text-center text-uppercase">NIP</th>
                                <th class="text-center text-uppercase">ID</th>
                                <th class="text-center text-uppercase">Nama Lengkap</th>
                                <th class="text-center text-uppercase">Tempat Lahir</th>
                                <th class="text-center text-uppercase">Tanggal Lahir</th>
                                <th class="text-center text-uppercase">BPJS KES</th>
                                <th class="text-center text-uppercase">BPJS TK</th>
                                <th class="text-center text-uppercase">Berkas-Berkas</th>
                                <th class="text-center text-uppercase">Action</th>
                                <th class="text-center text-uppercase">Tanggal Keluar</th>
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
<script src="js/demo/datatables-demo.js"></script>