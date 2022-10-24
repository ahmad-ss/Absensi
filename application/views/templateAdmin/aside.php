<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo base_url(); ?>dashboard/index" class="nav-link">
    <img src="<?php echo base_url(); ?>assets/img/logofinal.png" class="brand-image thumbnail elevation-3" style="opacity: .8;background-color: white;">
    <span class="brand-text font-weight-light">&nbsp; </span>
  </a>

  <!-- Sidebar -->
  <?php
  $id = $this->session->userdata('id_user');
  $foto = $this->db->get_where('hrd_biodata', array('ID_Krj' => $id))->result_array();
  ?>
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php if ($foto == null) {
                    echo base_url() . '/assets/dist/img/user3-128x128.jpg';
                  } else {
                    echo base_url() . $foto['0']['Foto'];
                  } ?>" class="img-square elevation-2" alt="User Image"></img>
      </div>
      <div class="info">
        <a href="<?php echo base_url() . "dashboard/Editkary/" . $this->session->userdata('id_user'); ?>" class="d-block"><?php echo $this->session->userdata('nama'); ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <?php if ($this->session->userdata('level') == "Admin") {   ?>
          <li class="nav-item">
            <a class="nav-link text-white">
              <h2 class="my-0 text-center">
                <label id="timestamp"></label>
              </h2>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <!-- menu-open  -->

            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-sign-in"></i>
              <p>
                Tambah Karyawan
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>dashboard/Inputkar/Harian" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>Harian</p>
                </a>
              </li>
            </ul>

            <!-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url() . "dashboard/Inputkar/Bulanan"; ?>" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>Bulanan</p>
                </a>
              </li>
            </ul> -->

          </li>
          <li class="nav-item has-treeview">
            <!-- menu-open  -->
            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Master
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>dashboard/Karyawan" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>Info Karyawan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>dashboard/Bagian" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>Karyawan Bagian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); 
                          ?>dashboard/Divisi" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>Divisi</p>
                </a>
              </li>


              <li class="nav-item">
                <a href="<?php echo base_url(); ?>dashboard/Cabang" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>Cabang</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="<?php //echo base_url(); 
                          ?>dashboard/Jabatan" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>Jabatan</p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>dashboard/KodeType" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>Shift</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="<?php //echo base_url(); 
                          ?>dashboard/KodeGaji" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>Kode Gaji</p>
                </a>
              </li> -->
            </ul>
          </li>

          <li class="nav-item has-treeview">
          <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-signal"></i>
              <p>
                Check Absensi
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- <li class="nav-item">
                <a href="<?php echo base_url(); ?>dashboard/check" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>Checker</p>
                </a>
              </li>
            </ul> -->
            <li class="nav-item">
                <a href="<?php echo base_url(); ?>checker/checkabsensibulanan" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>Absensi Bulanan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>checker/kartuabsensi" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>Kartu Absensi</p>
                </a>
              </li>
            </ul>

          </li>
          <li class="nav-item has-treeview">
            <!-- menu-open  -->

            

            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-clock-o"></i>
              <p>
                Absensi & Slip Gaji
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>dashboard/MenuInputAbsensiMassalLayout" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>Input Absensi Harian Massal</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item has-treeview">
                <a href="<?php echo base_url(); ?>dashboard/" class="nav-link">
                  <i class="nav-icon "></i>
                  <p>
                    Slip Gaji
                    <i class="right fa fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url(); ?>dashboard/CheckSlipGaji/Harian" class="nav-link">
                      <i class="nav-icon"></i>
                      <p>All</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url(); ?>dashboard/CheckSlipGaji/Single/Harian" class="nav-link">
                      <i class="nav-icon"></i>
                      <p>Single</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url(); ?>dashboard/CheckSlipGaji/Summary/Harian" class="nav-link">
                      <i class="nav-icon"></i>
                      <p>Summary</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>

          </li>

          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Other
                <span class="right fa fa-angle-left"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>dashboard/Naikgaji/" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>Naik Gaji Harian</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>dashboard/Potbpjs/" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>Input BPJS</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>dashboard/Pecatkary/" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>Karyawan Keluar</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>dashboard/Pindah_Bagian/" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>Pindah Bagian</p>
                </a>
              </li>
            </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>dashboard/Hari_Libur/" class="nav-link">
                <i class="nav-icon"></i>
                <p>Hari Libur</p>
              </a>
            </li>
          </ul>
          </li>


          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-id-badge"></i>
              <p>
                Absensi Bulanan
                <span class="right fa fa-angle-left"></span>
              </p>
            </a>
            <!-- <ul class="nav nav-treeview">
              <li class="nav-item has-treeview">
                <a href="<?php echo base_url(); ?>dashboard/" class="nav-link">
                  <i class="nav-icon "></i>
                  <p>
                    Absen
                    <i class="right fa fa-angle-left"></i>
                  </p>
                </a> -->
                
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Absensi_Mini/List_Staff" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>Absensi Staff</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Absensi_Harianumum/List_Harian_umum" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>Absensi Harian Umum</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Absensi_Security/List_Security" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>Absensi Security</p>
                </a>
              </li>
            </ul>
            </a>
            <!-- </li>
            </ul> -->

            <!-- <ul class="nav nav-treeview">
              <li class="nav-item has-treeview">
                <a href="<?php echo base_url(); ?>dashboard/" class="nav-link">
                  <i class="nav-icon "></i>
                  <p>
                    Slip Gaji
                    <i class="right fa fa-angle-left"></i>
                  </p>
                </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>dashboard/Pindah_Bagian/" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>Kartu Absensi</p>
                </a>
              </li>
            </ul>
          </li>
          <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>dashboard/Potbpjs/" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>Absensi Harian Umum</p>
                </a>
              </li>
            </ul>
          </li>
          </li>
            </ul> -->

            <li class="nav-item has-treeview">
            <!-- menu-open  -->

            

            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-transgender-alt"></i>
              <p>
                Kartu Absen Bulanan
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Report_KartuAbsensi/List_KartuAbsensi" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>Kartu Absen</p>
                </a>
              </li>
            </ul>
            
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url(); ?>Report_AbsensiHarian/List_AbsensiHarian" class="nav-link">
                      <i class="nav-icon"></i>
                      <p>List Absensi Staff Perhari</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url(); ?>Report_AbsensiBulan/List_AbsensiBulan" class="nav-link">
                      <i class="nav-icon"></i>
                      <p>List Absensi Staff Perbulan</p>
                    </a>
                  </li>
                </ul>
                
          </li>





        <?php  } ?>
        <li class="nav-item">
          <a href="<?php echo base_url(); ?>dashboard/Logout" class="nav-link">
            <i class="nav-icon fa fa-sign-out"></i>
            <p>
              Logout

            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?php if ($title != null) {
                                      echo $title;
                                    } ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <?php if ($breadcrumb != null) {
            echo $breadcrumb;
          } ?>
          <!--<ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Starter Page</li>
          </ol>-->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content container-fluid">
    <!--------------------------
  | Your Page Content Here |
-------------------------->