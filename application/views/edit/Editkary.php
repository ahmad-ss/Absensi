    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form enctype="multipart/form-data" method="POST" action="<?php echo base_url() . "index.php/editp/uploadfoto/" . $users['0']['ID_Krj']; ?>">
                        <?php //echo form_open_multipart('index.php/editp/uploadfoto/' . $users['0']['ID_Krj']); 
                        ?>
                        <div class="mb-3 row">
                            <?php if ($users['0']['Foto'] == NULL) {
                                echo '<img style="width: 15rem;" class="card-img-top" src="../../excel/download.svg" alt="Foto Profil Belom Ada">';
                            } else { ?>
                                <img style="width: 15rem;" class="card-img-top" src="<?php echo base_url() . $users['0']['Foto'] ?>" alt="Foto Profil">
                            <?php } ?>
                            <label class="col-sm-2 col-form-label">Foto Profil</label>
                            <div class="col-sm-3">
                                <input type="file" class="form-control-file" id="foto" name="foto" accept="image/*" />
                            </div>
                            <input type="hidden" class="form-control" id="nik" name="nik" value="<?php echo $users['0']['NIK']; ?>">
                            <div class="col-sm-2"><button type="submit" name="fotoprofil" class="btn btn-secondary">Upload</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="<?php echo base_url() . "index.php/Editp/update_karyawan/" . $users['0']['ID_Krj']; ?>" autocomplete="off">
                        <div class="mb-3 row">
                            <label for="1" class="col-sm-3 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="1" name="NAMA" value="<?php echo $users['0']['NamaLengkap']; ?>" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="2" class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="NIK" name="NIK" value="<?php echo $users['0']['NIK']; ?>" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="3" class="col-sm-3 col-form-label">NKK</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="NKK" name="NKK" value="<?php echo $users['0']['NKK']; ?>" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="4" class="col-sm-3 col-form-label">NIP</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="NIP" name="NIP" value="<?php echo $users['0']['NIP']; ?>" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="4" class="col-sm-3 col-form-label">BPJS KIS</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="bpjskis" name="bpjskis" value="<?php echo $users['0']['BPJS_KIS']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="4" class="col-sm-3 col-form-label">BPJS TK</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="bpjstk" name="bpjstk" value="<?php echo $users['0']['BPJS_TK']; ?>">
                            </div>
                        </div>
                        <div class=" mb-3 row">
                            <label for="5" class="col-sm-3 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="TmptLhr" name="TmptLhr" value="<?php echo $users['0']['Tempat_lahir']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="6" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="TglLhr" name="TglLhr" value="<?php echo $users['0']['Tanggal_lahir']; ?>">
                            </div>
                        </div>
                        <fieldset disabled>
                            <div class="mb-3 row form-group">
                                <label for="disabledSelect" class="col-sm-3 col-form-label">Kode Gaji</label>
                                <div class="col-sm-8">
                                    <select id="disabledSelect" class="form-control" name="kdgaji">
                                        <?php
                                        foreach ($kdgaji as $gj) {
                                            if ($users['0']['Kd_Gaji'] == $gj->Kd_Waktu) {
                                                echo "<option value='" . $gj->Kd_Waktu . "' selected>" . $gj->Waktu . "</option>";
                                            } else {
                                                echo "<option value='" . $gj->Kd_Waktu . "'>" . $gj->Waktu . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="" class="col-sm-3 col-form-label">Cabang</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="cbg" name="cbg">
                                        <?php
                                        foreach ($kdcabang as $cb) {
                                            if ($users['0']['Kd_Cabang'] == $cb->Kd_Cabang) {
                                                echo "<option value='" . $cb->Kd_Cabang . "' selected>" . $cb->Cabang . "</option>";
                                            } else {
                                                echo "<option value='" . $cb->Kd_Cabang . "'>" . $cb->Cabang . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="" class="col-sm-3 col-form-label">Jabatan</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="jbtn" name="jbtn">
                                        <?php
                                        foreach ($kdjbtn as $jb) {
                                            if ($users['0']['Kd_Jabatan'] == $jb->Kd_Jabatan) {
                                                echo "<option value='" . $jb->Kd_Jabatan . "' selected>" . $jb->Jabatan . "</option>";
                                            } else {
                                                echo "<option value='" . $jb->Kd_Jabatan . "'>" . $jb->Jabatan . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="" class="col-sm-3 col-form-label">Divisi</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="div" name="div">
                                        <option value="">Pilih Salah Satu</option>
                                        <?php
                                        foreach ($kddiv as $dv) {
                                            if ($users['0']['Kd_Divisi'] == $dv->Kd_Divisi) {
                                                echo "<option value='" . $dv->Kd_Divisi . "'selected>" . $dv->Devisi . "</option>";
                                            } else {
                                                echo "<option value='" . $dv->Kd_Divisi . "'>" . $dv->Devisi . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Tanggal Masuk</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="tglmasuk" name="tglmasuk" value="<?php echo $users['0']['Tanggal_Masuk']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Gaji</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="gaji" name="gaji" value="<?php
                                                                                                        if ($gaji == null) {
                                                                                                            echo "";
                                                                                                        } else {
                                                                                                            echo $gaji['0']['GajiPerHari'];
                                                                                                        }
                                                                                                        ?>"" required>
                            </div>
                        </div>
                        <div class=" mb-3 row">
                                <label for="4" class="col-sm-3 col-form-label">Gaji Lembur</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="gajilembur" name="gajilembur" value="<?php
                                                                                                                        if ($gaji == null) {
                                                                                                                            echo "";
                                                                                                                        } else {
                                                                                                                            echo $gaji['0']['GajiPerJam'];
                                                                                                                        }
                                                                                                                        ?>"" required>
                                </div>
                            </div>
                            <div class=" mb-3 row">
                                    <label for="" class="col-sm-3 col-form-label">Nama User</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="usr" name="usr" value="<?php echo $users['0']['Nama_User']; ?>" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="" class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="pass" name="pass" value="<?php echo $users['0']['Password']; ?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-9"></div><button type="submit" class="btn btn-primary">Update</button>
                                </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form enctype="multipart/form-data" method="POST" action="<?php echo base_url() . "index.php/editp/uploadberkas/" . $users['0']['ID_Krj']; ?>">
                        <div class="mb-3 row">
                            <label for="1" class="col-sm-3 col-form-label">Foto BPJS KIS</label>
                            <div class="col-sm-6">
                                <input type='file' name='bpjskis' />
                            </div>
                            <?php
                            if ($users['0']['Foto_BPJS_KIS'] == null) {
                                echo "<a class='col-sm-2 btn btn-secondary disabled' href='#'>BPJS KIS</a>";
                            } else {
                                echo "<a class='col-sm-2 btn btn-primary' href='" . base_url() . $users['0']['Foto_BPJS_KIS'] . "' alt='" . base_url() . $users['0']['Foto_BPJS_KIS'] . "'>BPJS KIS</a>";
                            }
                            ?>
                        </div>
                        <div class="mb-3 row">
                            <label for="1" class="col-sm-3 col-form-label">Foto BPJS TK</label>
                            <div class="col-sm-6">
                                <input type="file" name="bpjstk" />
                            </div>
                            <?php
                            if ($users['0']['Foto_BPJS_TK'] == null) {
                                echo "<a class='col-sm-2 btn btn-secondary disabled' href='#'>BPJS TK</a>";
                            } else {
                                echo "<a class='col-sm-2 btn btn-primary' href='" . base_url() . $users['0']['Foto_BPJS_TK'] . "'>BPJS TK</a>";
                            }
                            ?>
                        </div>
                        <div class="mb-3 row">
                            <label for="1" class="col-sm-3 col-form-label">Foto KK</label>
                            <div class="col-sm-6">
                                <input type="file" name="kk" />
                            </div>
                            <?php
                            if ($users['0']['Foto_KK'] == null) {
                                echo "<a class='col-sm-2 btn btn-secondary disabled' href='#'>KK</a>";
                            } else {
                                echo "<a class='col-sm-2 btn btn-primary' href='" . base_url() . $users['0']['Foto_KK'] . "'>KK</a>";
                            }
                            ?>
                        </div>
                        <div class="mb-3 row">
                            <label for="1" class="col-sm-3 col-form-label">Foto KTP</label>
                            <div class="col-sm-6">
                                <input type="file" name="ktp" />
                            </div>
                            <?php
                            if ($users['0']['Foto_KTP'] == null) {
                                echo "<a class='col-sm-2 btn btn-secondary disabled' href='#'>KTP</a>";
                            } else {
                                echo "<a class='col-sm-2 btn btn-primary' href='" . base_url() . $users['0']['Foto_KTP'] . "'>KTP</a>";
                            }
                            ?>
                        </div>
                        <div class="mb-3 row">
                            <label for="1" class="col-sm-3 col-form-label">Foto Akte</label>
                            <div class="col-sm-6">
                                <input type="file" name="akte" />
                            </div>
                            <?php
                            if ($users['0']['Foto_Akte'] == null) {
                                echo "<a class='col-sm-2 btn btn-secondary disabled' href='#'>Akte</a>";
                            } else {
                                echo "<a class='col-sm-2 btn btn-primary' href='" . base_url() . $users['0']['Foto_Akte'] . "'>Akte</a>";
                            }
                            ?>
                        </div>
                        <div class="mb-3 row">
                            <label for="1" class="col-sm-3 col-form-label">Foto Kontrak</label>
                            <div class="col-sm-6">
                                <input type="file" name="kontrak" />
                            </div>
                            <?php
                            if ($users['0']['Foto_Kontrak'] == null) {
                                echo "<a class='col-sm-2 btn btn-secondary disabled' href='#'>Kontrak</a>";
                            } else {
                                echo "<a class='col-sm-2 btn btn-primary' href='" . base_url() . $users['0']['Foto_Kontrak'] . "'>Kontrak</a>";
                            }
                            ?>
                        </div>
                        <div class="mb-3 row">
                            <label for="1" class="col-sm-3 col-form-label">Foto Lamaran</label>
                            <div class="col-sm-6">
                                <input type="file" name="lamaran" />
                            </div>
                            <?php
                            if ($users['0']['Foto_Lamaran'] == null) {
                                echo "<a class='col-sm-2 btn btn-secondary disabled' href='#'>Lamaran</a>";
                            } else {
                                echo "<a class='col-sm-2 btn btn-primary' href='" . base_url() . $users['0']['Foto_Lamaran'] . "'>Lamaran</a>";
                            }
                            ?>
                        </div>
                        <div class="mb-3 row">
                            <label for="1" class="col-sm-3 col-form-label">Foto SKCK</label>
                            <div class="col-sm-6">
                                <input type="file" name="skck" />
                            </div>
                            <?php
                            if ($users['0']['Foto_SKCK'] == null) {
                                echo "<a class='col-sm-2 btn btn-secondary disabled' href='#'>SKCK</a>";
                            } else {
                                echo "<a class='col-sm-2 btn btn-primary' href='" . base_url() . $users['0']['Foto_SKCK'] . "'>SKCK</a>";
                            }
                            ?>
                        </div>
                        <div class="mb-3 row">
                            <label for="1" class="col-sm-3 col-form-label">Foto Ijazah</label>
                            <div class="col-sm-6">
                                <input type="file" name="ijazah" />
                            </div>
                            <?php
                            if ($users['0']['Foto_Ijazah'] == null) {
                                echo "<a class='col-sm-2 btn btn-secondary disabled' href='#'>Ijazah</a>";
                            } else {
                                echo "<a class='col-sm-2 btn btn-primary' href='" . base_url() . $users['0']['Foto_Ijazah'] . "'>Ijazah</a>";
                            }
                            ?>
                        </div>
                        <div class="mb-3 row">
                            <label for="1" class="col-sm-3 col-form-label">Foto CV</label>
                            <div class="col-sm-6">
                                <input type="file" name="cv" />
                            </div>
                            <?php
                            if ($users['0']['Foto_CV'] == null) {
                                echo "<a class='col-sm-2 btn btn-secondary disabled' href='#'>CV</a>";
                            } else {
                                echo "<a class='col-sm-2 btn btn-primary' href='" . base_url() . $users['0']['Foto_CV'] . "'>CV</a>";
                            }
                            ?>
                        </div>
                        <div class="mb-3 row">
                            <label for="1" class="col-sm-3 col-form-label">Foto Sertifikat</label>
                            <div class="col-sm-6">
                                <input type="file" name="sertif" />
                            </div>
                            <?php
                            if ($users['0']['Foto_Sertifikat'] == null) {
                                echo "<a class='col-sm-2 btn btn-secondary disabled' href='#'>Sertifikat</a>";
                            } else {
                                echo "<a class='col-sm-2 btn btn-primary' href='" . base_url() . $users['0']['Foto_Sertifikat'] . "'>Sertifikat</a>";
                            }
                            ?>
                        </div>
                        <div class="mb-3 row">
                            <label for="1" class="col-sm-3 col-form-label">Foto SIM</label>
                            <div class="col-sm-6">
                                <input type="file" name="sim" />
                            </div>
                            <?php
                            if ($users['0']['Foto_SIM'] == null) {
                                echo "<a class='col-sm-2 btn btn-secondary disabled' href='#'>SIM</a>";
                            } else {
                                echo "<a class='col-sm-2 btn btn-primary' href='" . base_url() . $users['0']['Foto_SIM'] . "'>SIM</a>";
                            }
                            ?>
                        </div>
                        <div class="mb-3 row">
                            <input type="hidden" class="form-control" id="nik" name="nik" value="<?php echo $users['0']['NIK']; ?>">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>