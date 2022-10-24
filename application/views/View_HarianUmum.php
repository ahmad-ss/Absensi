<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title float-left"> <?php echo "Absensi Tanggal : ".$Tgl ?></h4>
                <div class="d-inline ml-auto float-right">
                    <a href="#" class="btn btn-success btn-sm btn-add-divisi" data-toggle="modal" data-target="#modal-add-divisi"><i class="fa fa-plus"></i> Absensi</a>
                    <a href="#" class="btn btn-success btn-sm btn-add-divisi" data-toggle="modal" data-target="#modal-add-Absen"><i class="fa fa-plus"></i> Absensi Khusus</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                         
							<th>Nama Pegawai</th>
							<th>Tanggal</th>
							<th>In</th>
							<th>Out</th>
							<th>Keterangan</th>
                            <th>Hapus</th>
                        </thead>
                        <tbody id="tbody-divisi">
                            <?php foreach($divisi as $i => $d): ?>
                                <tr id="<?= 'divisi-' . $d->id ?>">
								
									<td class="nama-divisi"><?= $d->Nama ?></td>
                                    <td class="nama-divisi"><?= $d->TanggalAbsen ?></td>
                                    <td class="nama-divisi"><?= $d->JamMasuk ?></td>
                                    <td class="nama-divisi"><?= $d->JamPulang ?></td>
                                    <td class="nama-divisi"><?= $d->Keterangan ?></td>
                                    <td>
                                        <a href="<?= base_url('Absensi_HarianUmum/destroy/'.$d->id) ?>"
                                           class="btn btn-danger btn-sm btn-delete ml-2" Onclick="return confirm('Anda Yakin Absensi ini akan dihapus?')">
                                            <i class="fa fa-trash" ></i>
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-add-divisi" tabindex="-1" role="dialog" aria-labelledby="modal-add-divisi-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-add-divisi" action="<?= base_url('Absensi_HarianUmum/SaveAbsensi_Staff') ?>" method="post" >
				
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-add-divisi-label">Absen Normal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
                    </button>
                </div>
				
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama-divisi">Nama Pegawai :</label>
                        <select name="Pegawai" id="Pegawai" class="form-control">
                            <option value="" disabled selected>-- Pilih Pegawai --</option>
                            <?php foreach($Karyawan as $bn => $bt): ?>
                                <option value="<?= $bt->id; ?>" <?= ($bn == $Status) ? 'selected' : '' ?>><?= $bt->Nama.'('.$bt->WaktuMasuk.')'; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama-divisi">Tanggal :</label>
                        <input type="date" class="form-control" name="date_out" value="<?php echo isset($itemOutData->date_out) ? set_value('date_out', date('m/d/Y', strtotime($itemOutData->date_out))) : set_value('date_out'); ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="nama-divisi">Jam Masuk :</label>
                        <input type="time" name="JamMasuk" id="edit-start" class="form-control" placeholder="Jam Masuk" required="reuired" value="08:00"/>
                       
                    </div>
                    <div class="form-group">
                        <label for="nama-divisi">Jam Pulang :</label>
						<input type="time" name="JamPulang" id="edit-finish" class="form-control" placeholder="Jam Pulang" required="reuired" value="16:00" />
                    </div>
                    <div class="form-group">
                        <label for="nama-divisi">Keterangan :</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Keteranga" required="reuired" />
                    </div>
                    <div class="form-group">
						
                        <label for="nama-divisi">Status :</label>
						<select name="status" id="status" class="form-control">
							<option value="" disabled selected>-- Masuk/Telat/Ijin/Cuti/ --</option>
							<?php foreach($Status as $bn => $bt): ?>
                            <option value="<?= $bt->Kd_Status; ?>" <?= ($bn == $Status) ? 'selected' : '' ?>><?= $bt->Status; ?></option>
							<?php endforeach; ?>
						</select>
                    </div>
                </div>
				
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

 <div class="modal fade" id="modal-add-Absen" tabindex="-1" role="dialog" aria-labelledby="modal-add-divisi-label" aria-hidden="true">   
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-add-divisi" action="<?= base_url('Absensi_HarianUmum/SaveAbsensi_Staff_Khsus') ?>" method="post" >
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-add-divisi-label">Absen Khusu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama-divisi">Nama Pegawai :</label>
                        <select name="Pegawai" id="Pegawai" class="form-control">
                            <option value="" disabled selected>-- Pilih Pegawai --</option>
                            <?php foreach($Karyawan as $bn => $bt): ?>
                                <option value="<?= $bt->id; ?>" <?= ($bn == $Status) ? 'selected' : '' ?>><?= $bt->Nama; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama-divisi">Tanggal :</label>
                        <input type="date" class="form-control" name="date_out" value="<?php echo isset($itemOutData->date_out) ? set_value('date_out', date('m/d/Y', strtotime($itemOutData->date_out))) : set_value('date_out'); ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="nama-divisi">Keterangan :</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Keteranga" required="reuired" />
                    </div>
                    <div class="form-group">
                        
                        <label for="nama-divisi">Status :</label>
                        <select name="status" id="status" class="form-control">
                            <option value="" disabled selected>-- Masuk/Telat/Ijin/Cuti/ --</option>
                            <?php foreach($Status as $bn => $bt): ?>
                            <option value="<?= $bt->Kd_Status; ?>" <?= ($bn == $Status) ? 'selected' : '' ?>><?= $bt->Status; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>  

            </form>
        </div>
    </div>
</div>