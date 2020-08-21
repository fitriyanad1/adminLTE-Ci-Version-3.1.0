<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url(); ?>assets/img/<?php echo $userdata->foto; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $userdata->nama; ?></p>
        <!-- Status -->
      </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">MENU</li>
      <!-- Optionally, you can add icons to the links -->
    <?php if ($userdata->hak_akses == 1) { ?>
 
      <li <?php if ($page == 'home') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Home'); ?>">
          <i class="fa fa-home"></i>
          <span>Home</span>
        </a>
      </li>
      
      <li <?php if ($page == 'perusahaan') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Perusahaan'); ?>">
          <i class="fa fa-building"></i>
          <span>Daftar Izin Usaha Pertambangan</span>
        </a>
      </li>

      <li <?php if ($page == 'pencadangan') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Pencadangan'); ?>">
          <i class="fa fa-building-o"></i>
          <span>Data IUP Pencadangan Wilayah</span>
        </a>
      </li>

      <li <?php if ($page == 'produksi' || $page == 'kelola_produksi') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Produksi'); ?>">
          <i class="fa fa-area-chart"></i>
          <span>Produksi</span>
        </a>
      </li>

<!--     <li <?php if ($page == 'kelola_produksi') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('KelolaProduksi'); ?>">
          <i class="fa fa-briefcase"></i>
          <span>Kelola</span>
        </a>
      </li> -->


      <li <?php if ($page == 'admin') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Admin'); ?>">
          <i class="fa fa-users"></i>
          <span>Kelola admin daerah</span>
        </a>
      </li>

     <li <?php if ($page == 'kelola_produksi') {echo 'class="active"';} ?>
     <?php echo base_url('KelolaProduksi'); ?> >
      </li>

    <?php } else { ?>
      <li <?php if ($page == 'produksi') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Produksi'); ?>">
          <i class="fa fa-area-chart"></i>
          <span>Produksi</span>
        </a>
      </li>
    <?php } ?>

    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>