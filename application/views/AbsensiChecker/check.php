<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css">
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?php echo base_url() . "dashboard/checkShow" ?>">
                    <div class="mb-3 row">
                        <label for="bln" class="col-sm-2 col-form-label">Pilih Bulan</label>
                        <div class="col-sm-5">
                            <input type="month" class="form-control" id="bln" name="bln" required>
                        </div>
                    </div>
                    <!-- <div class="mb-3 row">
                        <label for="1" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control" id="tglak" name="tglak" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="1" class="col-sm-2 col-form-label">Jabatan</label>
                        <div class="col-sm-5">
                            <select class="form-control" id="jbtn" name="jbtn">
                                <option value="">Pilih Salah Jabatan</option>
                                <?php
                                /*foreach ($jbtn as $jb) {
                                    echo "<option value='" . $jb->Jabatan . "'>" . $jb->Jabatan . "</option>";
                                }*/
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="1" class="col-sm-2 col-form-label">Divisi</label>
                        <div class="col-sm-5">
                            <select class="form-control" id="div" name="div">
                                <option value="">Pilih Salah Divisi</option>
                                <?php
                                /*foreach ($divisi as $div) {
                                    echo "<option value='" . $div->Devisi . "'>" . $div->Devisi . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="1" class="col-sm-2 col-form-label">Cabang</label>
                        <div class="col-sm-5">
                            <select class="form-control" id="cbg" name="cbg">
                                <option value="">Pilih Salah Satu</option>
                                <?php
                                foreach ($cabang as $cb) {
                                    echo "<option value='" . $cb->Cabang . "'>" . $cb->Cabang . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="1" class="col-sm-2 col-form-label">Pembuat</label>
                        <div class="col-sm-5">
                            <select class="form-control" id="pmbt" name="pmbt">
                                <option value="">Pilih Salah Satu</option>
                                <?php
                                foreach ($atasan as $ats) {
                                    echo "<option value='" . $ats->NamaLengkap . "'>" . $ats->NamaLengkap . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="1" class="col-sm-2 col-form-label">Pembayar</label>
                        <div class="col-sm-5">
                            <select class="form-control" id="pmbyr" name="pmbyr">
                                <option value="">Pilih Salah Satu</option>
                                <?php
                                foreach ($atasan as $ats) {
                                    echo "<option value='" . $ats->NamaLengkap . "'>" . $ats->NamaLengkap . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="1" class="col-sm-2 col-form-label">Penyetuju</label>
                        <div class="col-sm-5">
                            <select class="form-control" id="ttd" name="ttd">
                                <option value="">Pilih Salah Satu</option>
                                <?php
                                foreach ($atasan as $ats) {
                                    echo "<option value='" . $ats->NamaLengkap . "'>" . $ats->NamaLengkap . "</option>";
                                }*/
                                ?>
                            </select>
                        </div>
                    </div> -->
                    <div class="mb-3 row">
                        <div class="col-sm-2"></div><button type="submit" class="btn btn-primary">Show</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>