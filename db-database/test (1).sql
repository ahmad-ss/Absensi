-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2022 at 08:49 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftarizin`
--

CREATE TABLE `daftarizin` (
  `no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrd_absensi`
--

CREATE TABLE `hrd_absensi` (
  `id_Absensi` int(6) NOT NULL,
  `NIK` varchar(16) NOT NULL DEFAULT '' COMMENT 'Nomer Induk Kependudukan',
  `NIP` varchar(20) NOT NULL DEFAULT '' COMMENT 'Nomer Induk Pegawai',
  `NamaLengkap` varchar(50) NOT NULL DEFAULT '' COMMENT 'Nama Pegawai',
  `periode1` date DEFAULT NULL,
  `periode2` date DEFAULT NULL,
  `Kd_Jabatan` varchar(2) NOT NULL DEFAULT '' COMMENT 'Kode Jabatan',
  `Jabatan` varchar(50) DEFAULT NULL COMMENT 'Nama Jabatan',
  `Keterangan` varchar(200) DEFAULT '' COMMENT 'Keterangan Absensi',
  `Sub_Total` double NOT NULL DEFAULT '0',
  `Pot_BPJS` double DEFAULT NULL,
  `BiayaLain` double DEFAULT NULL,
  `Grade_Total` double DEFAULT NULL,
  `Tanggal_Insert` date DEFAULT NULL COMMENT 'Tanggalan insert'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrd_biodata`
--

CREATE TABLE `hrd_biodata` (
  `id` int(6) NOT NULL,
  `NIK` varchar(16) NOT NULL DEFAULT '' COMMENT 'Nomer Induk Kependudukan',
  `NKK` varchar(16) NOT NULL DEFAULT '' COMMENT 'Nomer Kartu Keluarga',
  `NIP` varchar(20) NOT NULL DEFAULT '' COMMENT 'Nomer Induk Pegawai',
  `ID_Krj` varchar(10) NOT NULL DEFAULT '' COMMENT 'ID Karyaan Milik Program Bapak Wiliam',
  `NamaLengkap` varchar(50) NOT NULL DEFAULT '' COMMENT 'Nama Pegawai',
  `Tempat_lahir` varchar(50) NOT NULL DEFAULT '' COMMENT 'Tempat Kelahiran',
  `Tanggal_lahir` date DEFAULT NULL COMMENT 'Tanggal Lahir',
  `Nama_User` varchar(50) DEFAULT NULL COMMENT 'Nama User untuk membukan program',
  `Password` varchar(50) DEFAULT NULL COMMENT 'Password untuk membuka program',
  `Level` varchar(50) NOT NULL DEFAULT '' COMMENT 'Level Account',
  `Foto` varchar(100) DEFAULT NULL COMMENT 'Foto Pengawai',
  `BPJS_KIS` varchar(20) NOT NULL DEFAULT '' COMMENT 'Nomer Kartu BPJS Kesehatan',
  `Foto_BPJS_KIS` varchar(100) DEFAULT NULL COMMENT 'Foto Kartu BPJS Kesehartan',
  `BPJS_TK` varchar(20) NOT NULL DEFAULT '' COMMENT 'Nomer Kartu BPJS Tenga Kerja',
  `Foto_BPJS_TK` varchar(100) DEFAULT NULL COMMENT 'Foto Kartu BPJS Tenaga Kerja',
  `Foto_KK` varchar(100) DEFAULT NULL COMMENT 'Foto Kartu Keluarga',
  `Foto_KTP` varchar(100) DEFAULT NULL COMMENT 'Foto KTP',
  `Foto_Akte` varchar(100) DEFAULT NULL COMMENT 'Foto Akte Kelahiran',
  `Foto_Kontrak` varchar(100) DEFAULT NULL COMMENT 'Foto Perjanjian Kontrak',
  `Foto_Lamaran` varchar(100) DEFAULT NULL COMMENT 'Foto Surat Lamaran',
  `Foto_SKCK` varchar(100) DEFAULT NULL COMMENT 'Foto Surat Keterangan Catatan Kepolisian',
  `Foto_Ijazah` varchar(100) DEFAULT NULL COMMENT 'Foto Ijazah',
  `Foto_CV` varchar(100) DEFAULT NULL COMMENT 'Foto Curriculum Vita/Riwayat hidup',
  `Foto_Sertifikat` varchar(100) DEFAULT NULL COMMENT 'Foto Sertifikat',
  `Foto_SIM` varchar(100) DEFAULT NULL COMMENT 'Foto SIM'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrd_cabang`
--

CREATE TABLE `hrd_cabang` (
  `id` int(6) NOT NULL,
  `Kd_Cabang` varchar(4) NOT NULL DEFAULT '' COMMENT 'Kode Cabang',
  `Cabang` varchar(50) NOT NULL DEFAULT '' COMMENT 'Nama Cabang',
  `Alamat` varchar(200) NOT NULL DEFAULT '' COMMENT 'Nama Cabang'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrd_daftarizin`
--

CREATE TABLE `hrd_daftarizin` (
  `id` int(6) NOT NULL,
  `id_Absensi` int(6) DEFAULT NULL COMMENT 'Id dari Absensi untuk pembuat Slip Gaji',
  `NIK` varchar(16) NOT NULL DEFAULT '' COMMENT 'Nomer Induk Kependudukan',
  `NIP` varchar(20) NOT NULL DEFAULT '' COMMENT 'Nomer Induk Pegawai',
  `ID_Krj` varchar(10) NOT NULL DEFAULT '' COMMENT 'ID Karyaan Milik Program Bapak Wiliam',
  `NamaLengkap` varchar(50) NOT NULL DEFAULT '' COMMENT 'Nama Pegawai',
  `Tgl_Pengajuan` date DEFAULT NULL COMMENT 'Tanggal Pengajuan Cuti',
  `Tgl_Cuti` date DEFAULT NULL COMMENT 'Tanggal Cuti',
  `Alasan` varchar(20) DEFAULT '' COMMENT 'Alasan Ijin',
  `Kd_Ijin` char(2) NOT NULL DEFAULT '' COMMENT 'Kode Cuti',
  `Nm_Ijin` char(20) NOT NULL DEFAULT '' COMMENT 'Nama Cuti'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrd_detail_absensi`
--

CREATE TABLE `hrd_detail_absensi` (
  `id` int(6) NOT NULL,
  `id_Absensi` int(6) DEFAULT NULL COMMENT 'Id dari Absensi untuk pembuat Slip Gaji',
  `NIK` varchar(16) NOT NULL DEFAULT '' COMMENT 'Nomer Induk Kependudukan',
  `NIP` varchar(20) NOT NULL DEFAULT '' COMMENT 'Nomer Induk Pegawai',
  `ID_Krj` varchar(10) NOT NULL DEFAULT '' COMMENT 'ID Karyaan Milik Program Bapak Wiliam',
  `NamaLengkap` varchar(50) NOT NULL DEFAULT '' COMMENT 'Nama Pegawai',
  `Kd_Gaji` char(2) NOT NULL DEFAULT '' COMMENT 'Kode Gajian Bulanan atau harian',
  `GajiarPer` varchar(20) DEFAULT NULL COMMENT 'Gajian Per Bulanan atau harian',
  `Kd_Cabang` varchar(4) NOT NULL DEFAULT '' COMMENT 'Kode Cabang',
  `Cabang` varchar(50) DEFAULT NULL COMMENT 'Nama Cabang',
  `Kd_Divisi` varchar(3) NOT NULL DEFAULT '' COMMENT 'Kode Divisi',
  `Devisi` varchar(50) DEFAULT NULL COMMENT 'Nama Devisi',
  `Kd_Jabatan` varchar(2) NOT NULL DEFAULT '' COMMENT 'Kode Jabatan',
  `Jabatan` varchar(50) DEFAULT NULL COMMENT 'Nama Jabatan',
  `Tanggal_Masuk` date DEFAULT NULL COMMENT 'Tanggal Absensi',
  `Jam_Masuk` time DEFAULT NULL COMMENT 'Jam Masuk',
  `Absen_Masuk` time DEFAULT NULL COMMENT 'Jam Masuk Cek dari Absensi Shiff',
  `Terlambat` double DEFAULT NULL COMMENT 'Penapunga Keterlabatan dalam menit',
  `Tanggal_Pulang` date DEFAULT NULL COMMENT 'Tanggal Absensi',
  `Jam_Pulang` time DEFAULT NULL COMMENT 'Jam Masuk',
  `Absen_Pulang` time DEFAULT NULL COMMENT 'Absens Masuk',
  `Lembur` double DEFAULT NULL COMMENT 'Penapunga Waktu Lembur dlm jam sudah di hitung',
  `GajiPerhari` double DEFAULT NULL COMMENT 'Gaji Pokok Perhari',
  `PotonganTerlambat` double DEFAULT NULL COMMENT 'Potongan Terlambat',
  `GajiPerJam` double DEFAULT NULL COMMENT 'Gaji Perjam',
  `GajiLembur` double DEFAULT NULL COMMENT 'Gaji Lembur=Lembur*Perjam',
  `Tot_Gaji` double DEFAULT NULL COMMENT 'Sub Total Gaji=GajiPerhari-PotonganTerlambat+GajiLembur',
  `Keterangan` varchar(200) DEFAULT '' COMMENT 'Keterangan Absensi',
  `Hari` varchar(10) NOT NULL COMMENT 'Hari Kerja',
  `Jam_Kerja` double NOT NULL COMMENT 'Jam Kerja Karyawan',
  `Tanggal_Insert` date DEFAULT NULL COMMENT 'Tanggalan Insert'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrd_divisi`
--

CREATE TABLE `hrd_divisi` (
  `id` int(6) NOT NULL,
  `Kd_Divisi` varchar(3) NOT NULL DEFAULT '' COMMENT 'Kode Divisi',
  `Devisi` varchar(50) NOT NULL DEFAULT '' COMMENT 'Nama Devisi'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrd_gajikarywan`
--

CREATE TABLE `hrd_gajikarywan` (
  `id` int(6) NOT NULL,
  `NIK` varchar(16) NOT NULL DEFAULT '' COMMENT 'Nomer Induk Kependudukan',
  `NIP` varchar(20) NOT NULL DEFAULT '' COMMENT 'Nomer Induk Pegawai',
  `ID_Krj` varchar(10) NOT NULL DEFAULT '' COMMENT 'ID Karyaan Milik Program Bapak Wiliam',
  `NamaLengkap` varchar(50) NOT NULL DEFAULT '' COMMENT 'Nama Pegawai',
  `Kd_Gaji` char(2) NOT NULL DEFAULT '' COMMENT 'Kode Gajian Bulanan atau harian',
  `GajiarPer` varchar(20) DEFAULT NULL COMMENT 'Gajian Per Bulanan atau harian',
  `GajiPerBulan` double DEFAULT NULL COMMENT 'Gaji Pokok Perbulan',
  `GajiPerHari` double DEFAULT NULL COMMENT 'Gaji Pokok PerHari',
  `GajiPerJam` double DEFAULT NULL COMMENT 'Gaji Pokok PerJam atau Gaji Lebur Perjam',
  `PotBPJS` double DEFAULT NULL COMMENT 'Potongan BPJS TK+KES (Total)',
  `PotGaji` double DEFAULT NULL COMMENT 'Potongan Jika Terlabat',
  `Tanggal_BPJS` date DEFAULT NULL COMMENT 'Tanggalan Input BPJS',
  `MaxTerlabat` int(6) NOT NULL DEFAULT '0' COMMENT 'MAX Terlabat',
  `Tgl_Mulai` date DEFAULT NULL COMMENT 'Tanggal Mulai Berlaku',
  `Tgl_Akhir` date DEFAULT NULL COMMENT 'Tanggal Mulai Berlaku',
  `JmlCuti` int(6) NOT NULL DEFAULT '0' COMMENT 'Jumlah Jatah Cuti',
  `Aktif` char(1) NOT NULL DEFAULT '1' COMMENT 'Status Gaji Aktif=1 ',
  `Gaji_Lama` double DEFAULT NULL COMMENT 'Gaji Lama sebelum di update',
  `Tanggal_NaikGaji` date DEFAULT NULL COMMENT 'Tanggal Naik Gaji'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrd_harilibur`
--

CREATE TABLE `hrd_harilibur` (
  `id` int(6) NOT NULL,
  `Tanggal` date DEFAULT NULL COMMENT 'Tanggal Hari Libur',
  `NamaHariLibur` varchar(50) NOT NULL DEFAULT '' COMMENT 'NamaHari Libur'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrd_jabatan`
--

CREATE TABLE `hrd_jabatan` (
  `id` int(6) NOT NULL,
  `Kd_Jabatan` varchar(2) NOT NULL DEFAULT '' COMMENT 'Kode Jabatan',
  `Jabatan` varchar(50) NOT NULL DEFAULT '' COMMENT 'Nama Jabatan'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrd_jenisizin`
--

CREATE TABLE `hrd_jenisizin` (
  `id` int(6) NOT NULL,
  `Kd_Ijin` char(2) NOT NULL DEFAULT '' COMMENT 'Kode Cuti',
  `Nm_Ijin` char(20) NOT NULL DEFAULT '' COMMENT 'Nama Cuti'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrd_joinbagian`
--

CREATE TABLE `hrd_joinbagian` (
  `id` int(6) NOT NULL,
  `NIK` varchar(16) NOT NULL DEFAULT '' COMMENT 'Nomer Induk Kependudukan',
  `NIP` varchar(20) NOT NULL DEFAULT '' COMMENT 'Nomer Induk Pegawai',
  `ID_Krj` varchar(10) NOT NULL DEFAULT '' COMMENT 'ID Karyaan Milik Program Bapak Wiliam',
  `NamaLengkap` varchar(50) NOT NULL DEFAULT '' COMMENT 'Nama Pegawai',
  `Tanggal_Masuk` date DEFAULT NULL COMMENT 'Tanggal Masuk',
  `Kd_Gaji` char(2) NOT NULL DEFAULT '' COMMENT 'Kode Gajian Bulanan atau harian',
  `GajiarPer` varchar(20) DEFAULT NULL COMMENT 'Gajian Per Bulanan atau harian',
  `Kd_Cabang` varchar(4) NOT NULL DEFAULT '' COMMENT 'Kode Cabang',
  `Cabang` varchar(50) DEFAULT NULL COMMENT 'Nama Cabang',
  `Kd_Divisi` varchar(3) NOT NULL DEFAULT '' COMMENT 'Kode Divisi',
  `Devisi` varchar(50) DEFAULT NULL COMMENT 'Nama Devisi',
  `Kd_Jabatan` varchar(2) NOT NULL DEFAULT '' COMMENT 'Kode Jabatan',
  `Jabatan` varchar(50) DEFAULT NULL COMMENT 'Nama Jabatan',
  `Tanggal_Keluar` date DEFAULT NULL COMMENT 'Tanggal Masuk',
  `Alasan_Keluar` varchar(200) NOT NULL DEFAULT '' COMMENT 'Alasan Keluar'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrd_shiff`
--

CREATE TABLE `hrd_shiff` (
  `id` int(6) NOT NULL,
  `Kd_Shiff` char(4) NOT NULL DEFAULT '' COMMENT 'Kode Shiff',
  `Nm_Shiff` varchar(50) NOT NULL DEFAULT '' COMMENT 'Nama Shiff',
  `DateAdd` date NOT NULL COMMENT 'Tanggal',
  `WorkTime` int(11) NOT NULL DEFAULT '8' COMMENT 'Jam Kerja',
  `Jam_Masuk` time DEFAULT NULL COMMENT 'Jam Masuk Kerja',
  `Harisama` char(1) NOT NULL DEFAULT '1' COMMENT 'Masuk Dan Pulang pada hari yang sama=1',
  `Jam_Pulang` time DEFAULT NULL COMMENT 'Jam Pulang Kerja',
  `TelatMax` int(11) NOT NULL DEFAULT '5' COMMENT 'Telat'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrd_waktugajian`
--

CREATE TABLE `hrd_waktugajian` (
  `id` int(6) NOT NULL,
  `Kd_Waktu` varchar(2) NOT NULL DEFAULT '' COMMENT 'Kode Waktu',
  `Waktu` varchar(50) NOT NULL DEFAULT '' COMMENT 'WaktuGajian'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sdm_absensi`
--

CREATE TABLE `sdm_absensi` (
  `id` int(6) NOT NULL,
  `Kd_Bagian` varchar(2) NOT NULL,
  `Nm_Bagian` varchar(50) NOT NULL,
  `No_Urut` varchar(4) DEFAULT NULL,
  `Nama` varchar(100) DEFAULT NULL,
  `TanggalAbsen` date DEFAULT NULL COMMENT 'Tanggal Masuk',
  `JamMasuk` time DEFAULT NULL COMMENT 'Jam Masuk',
  `JamPulang` time DEFAULT NULL COMMENT 'Jam Pulang',
  `Keterangan` varchar(200) DEFAULT NULL,
  `Kd_Status` char(2) DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sdm_bagian`
--

CREATE TABLE `sdm_bagian` (
  `id` int(6) NOT NULL,
  `Kd_Bagian` varchar(2) NOT NULL,
  `Nm_Bagian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sdm_jamkerja`
--

CREATE TABLE `sdm_jamkerja` (
  `id` int(6) NOT NULL,
  `StartMasuk` time DEFAULT NULL COMMENT 'Mulai Absen',
  `JamMasuk` time DEFAULT NULL COMMENT 'Jam Masuk',
  `JamPulang` time DEFAULT NULL COMMENT 'Jam Pulang'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sdm_pegawai`
--

CREATE TABLE `sdm_pegawai` (
  `id` int(6) NOT NULL,
  `Kd_Bagian` varchar(2) NOT NULL,
  `Nm_Bagian` varchar(50) NOT NULL,
  `No_Urut` varchar(4) DEFAULT NULL,
  `Nama` varchar(100) DEFAULT NULL,
  `WaktuMasuk` varchar(50) NOT NULL DEFAULT '',
  `Sabtu` varchar(1) NOT NULL DEFAULT '1',
  `Spesial` char(1) NOT NULL DEFAULT '0',
  `Aktif` char(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sdm_status`
--

CREATE TABLE `sdm_status` (
  `id` int(6) NOT NULL,
  `Kd_Status` char(2) DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(4) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` int(1) NOT NULL COMMENT '1="Super Admin",2=""',
  `lb` char(5) DEFAULT 'ba',
  `ip` varchar(25) DEFAULT NULL,
  `hak_akses` char(10) DEFAULT 'su'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `level`, `lb`, `ip`, `hak_akses`) VALUES
(1, 'admin', 'admin', 'admin', 1, 'ba', NULL, 'su');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hrd_absensi`
--
ALTER TABLE `hrd_absensi`
  ADD PRIMARY KEY (`id_Absensi`) USING BTREE;

--
-- Indexes for table `hrd_biodata`
--
ALTER TABLE `hrd_biodata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrd_cabang`
--
ALTER TABLE `hrd_cabang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrd_daftarizin`
--
ALTER TABLE `hrd_daftarizin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrd_detail_absensi`
--
ALTER TABLE `hrd_detail_absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrd_divisi`
--
ALTER TABLE `hrd_divisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrd_gajikarywan`
--
ALTER TABLE `hrd_gajikarywan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrd_harilibur`
--
ALTER TABLE `hrd_harilibur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrd_jabatan`
--
ALTER TABLE `hrd_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrd_jenisizin`
--
ALTER TABLE `hrd_jenisizin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrd_joinbagian`
--
ALTER TABLE `hrd_joinbagian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrd_shiff`
--
ALTER TABLE `hrd_shiff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrd_waktugajian`
--
ALTER TABLE `hrd_waktugajian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sdm_absensi`
--
ALTER TABLE `sdm_absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sdm_bagian`
--
ALTER TABLE `sdm_bagian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sdm_jamkerja`
--
ALTER TABLE `sdm_jamkerja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sdm_pegawai`
--
ALTER TABLE `sdm_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sdm_status`
--
ALTER TABLE `sdm_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hrd_absensi`
--
ALTER TABLE `hrd_absensi`
  MODIFY `id_Absensi` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrd_biodata`
--
ALTER TABLE `hrd_biodata`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrd_cabang`
--
ALTER TABLE `hrd_cabang`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrd_daftarizin`
--
ALTER TABLE `hrd_daftarizin`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrd_detail_absensi`
--
ALTER TABLE `hrd_detail_absensi`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrd_divisi`
--
ALTER TABLE `hrd_divisi`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrd_gajikarywan`
--
ALTER TABLE `hrd_gajikarywan`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrd_harilibur`
--
ALTER TABLE `hrd_harilibur`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrd_jabatan`
--
ALTER TABLE `hrd_jabatan`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrd_jenisizin`
--
ALTER TABLE `hrd_jenisizin`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrd_joinbagian`
--
ALTER TABLE `hrd_joinbagian`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrd_shiff`
--
ALTER TABLE `hrd_shiff`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrd_waktugajian`
--
ALTER TABLE `hrd_waktugajian`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sdm_absensi`
--
ALTER TABLE `sdm_absensi`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sdm_bagian`
--
ALTER TABLE `sdm_bagian`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sdm_jamkerja`
--
ALTER TABLE `sdm_jamkerja`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sdm_pegawai`
--
ALTER TABLE `sdm_pegawai`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sdm_status`
--
ALTER TABLE `sdm_status`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
