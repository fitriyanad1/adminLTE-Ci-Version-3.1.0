<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <div class="col-md-6" style="padding: 0;">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-admin"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data Admin Cabang Dinas</button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Username</th>
          <th>Password</th>
          <th>Foto</th>
          <th>Nama Cabang Dinas</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-admin">
        
      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_tambah_admin; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataAdmin', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'Admin';
  $data['url'] = 'Admin/import';
  echo show_my_modal('modals/modal_import', 'import-admin', $data);
?>