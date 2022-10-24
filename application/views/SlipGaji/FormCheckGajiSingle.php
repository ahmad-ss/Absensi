<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css">
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?php echo base_url() . "dashboard/TumpuanShowSlipGaji/" . $this->uri->segment(3); ?>">
                    <div class="mb-3 row">
                        <label for="1" class="col-sm-2 col-form-label">Tanggal Mulai</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control" id="tglml" name="tglml" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="1" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control" id="tglak" name="tglak" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="1" class="col-sm-2 col-form-label">Nama Karyawan</label>
                        <div class="col-sm-6">
                            <select class="selectpicker form-control" id="idkrj" name="idkrj" data-live-search="true">
                                <option data-tokens="">Pilih Salah Satu</option>
                                <?php
                                foreach ($karyawan as $kry) {
                                    echo "<option data-tokens='" . $kry->ID_Krj . "'>" . $kry->ID_Krj . ", -- " . $kry->NamaLengkap . "</option>";
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
                        <label for="1" class="col-sm-2 col-form-label">Pengecek</label>
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
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-2"></div><button type="submit" class="btn btn-primary">Show</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>