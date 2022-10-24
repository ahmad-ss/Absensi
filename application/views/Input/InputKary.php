<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css">
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?php echo base_url() . "index.php/inputp/add_karyawan/" . $this->uri->segment(3); ?>">
                    <div class="mb-3 row">
                        <label for="1" class="col-sm-2 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="1" name="NAMA" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="2" class="col-sm-2 col-form-label">NIK</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="NIK" name="NIK" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="3" class="col-sm-2 col-form-label">NKK</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="NKK" name="NKK" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="4" class="col-sm-2 col-form-label">NIP</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="NIP" name="NIP" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="4" class="col-sm-2 col-form-label">BPJS KIS</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="bpjskis" name="bpjskis">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="4" class="col-sm-2 col-form-label">BPJS TK</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="bpjstk" name="bpjstk">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="5" class="col-sm-2 col-form-label">Tempat Lahir</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="TmptLhr" name="TmptLhr">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="6" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control" id="TglLhr" name="TglLhr">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="waktu" class="col-sm-2 col-form-label">Kode Gaji</label>
                        <div class="col-sm-5">
                            <input type="hidden" class="form-control" id="kdgaji" name="kdgaji" value="<?php echo $kdgaji['0']['Kd_Waktu']; ?>">
                            <input type="text" class="form-control" id="waktu" name="waktu" value="<?php echo $kdgaji['0']['Waktu']; ?>" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-2 col-form-label">Cabang</label>
                        <div class="col-sm-5">
                            <select class="form-control" id="cbg" name="cbg" required>
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
                        <label for="" class="col-sm-2 col-form-label">Jabatan</label>
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
                        <label for="" class="col-sm-2 col-form-label">Divisi</label>
                        <div class="col-sm-5">
                            <select class="form-control" id="div" name="div" required>
                                <option value="">Pilih Salah Satu</option>
                                <?php
                                foreach ($kddiv as $dv) {
                                    echo "<option value='" . $dv->Kd_Divisi . "'>" . $dv->Devisi . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="4" class="col-sm-2 col-form-label">Gaji</label>
                        <div class="col-sm-5">
                            <input type="number" class="form-control" id="gaji" name="gaji" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="4" class="col-sm-2 col-form-label">Gaji Lembur</label>
                        <div class="col-sm-5">
                            <input type="number" class="form-control" id="gajilembur" name="gajilembur" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control" id="tglmasuk" name="tglmasuk" required>
                        </div>
                    </div>
                    <!-- <div class="mb-3 row">
                        <label for="" class="col-sm-2 col-form-label">Nama User</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="namausr" name="namausr">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-5">
                            <input type="password" class="form-control" id="pwd" name="pwd">
                        </div>
                    </div> -->
                    <div class="mb-3 row">
                        <div class="col-sm-7"></div><button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>