<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css">
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NIK</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">Tanggal Masuk/Tidak</th>
                            <?php
                            for ($i = 1; $i <= $tglakhir; $i++) {
                                echo "<th>" . $i . "</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $min = explode("-", $tglmin);
                        $max = explode("-", $tglmax);
                        foreach ($Data as $row) {
                            $idkrj = $row['ID_Krj'];
                            echo '<tr><th scope="row">' . $no++ . '</th>';
                            echo '<td>' . $row['NIK'] . '</td>';
                            echo '<td>' . $row['NamaLengkap'] . '</td>';
                            echo '<td>1 - ' . $tglakhir . '</td>';
                            for ($i = 1; $i <= $tglakhir; $i++) {
                                $timestamp    = strtotime($bulan);
                                $tgl = date('Y-m-' . $i, $timestamp);
                                $this->db->select('*');
                                $this->db->where('ID_Krj', $idkrj);
                                $this->db->where('Tanggal_Masuk', $tgl);
                                $absen = $this->db->get('hrd_detail_absensi')->result_array();
                                if ($i < $min['2']) {
                                    echo "<td>-</td>";
                                } elseif ($i > $max['2']) {
                                    echo "<td>-</td>";
                                } else {
                                    if ($absen == null) {
                                        $timestamp    = strtotime($bulan);
                                        $tglcuti = date("Y-m-" . $i . "", $timestamp);
                                        $this->db->select('*');
                                        $this->db->where('ID_Krj', $idkrj);
                                        $this->db->where('Tgl_Cuti', $tglcuti);
                                        $izin = $this->db->get('hrd_daftarizin');
                                        //$izin = null;
                                        if ($izin == null) {
                                            echo "<td>I</td>";
                                        } else {
                                            echo "<td>-</td>";
                                        }
                                    } else {
                                        $cek = $absen['0'];
                                        if ($cek['Jam_Masuk'] == $cek['Absen_Masuk']) {
                                            echo "<td>M</td>";
                                        } else {
                                            echo "<td>T</td>";
                                        }
                                    }
                                }
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>