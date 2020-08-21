<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <div class="col-md-6" style="padding: 0;">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-pencadangan"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Perusahaan</button>
    </div>
<!--      <div class="col-md-3">
        <a href="<?php echo base_url('Pegawai/export'); ?>" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</a>
    </div> 
  <div class="col-md-3">
        <button class="form-control btn btn-default" data-toggle="modal" data-target="#import-pegawai"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Import Data Excel</button>
    </div> -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Pemohon</th>
          <th>Luas Wilayah</th>
           <th>Desa</th>
          <th>Kecamatan</th>
          <th>Kabupaten</th>
          <th>Bahan Galian</th>
          <th>SK/Surat</th>
          <th>Tanggal Pengajuan</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-pencadangan">
       
      </tbody>
    </table>
  </div>    
</div>

<?php echo $modal_tambah_pencadangan; ?>
<!-- <?php echo $modal_approve_pencadangan; ?> -->

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataPerusahaan', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<!-- <?php show_my_confirm('approve-pencadangan', 'approve-dataPencadangan', 'Approve Data Ini?', 'Ya, Approve Data Ini'); ?> -->
 <?php
  $data['judul'] = 'Perusahaan';
  $data['url'] = 'Perusahaan/import';
  echo show_my_modal('modals/modal_import', 'import-perusahaan', $data);
?>