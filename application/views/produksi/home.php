<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
<div class="col-md-3">
       <form action="/esdm/Produksi/export" method="POST">
       <!--  <input type="hidden" name="id" value="<?php echo $dataHarga->id; ?>"> -->
        <button type="submit" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data PDF</button>
        </form>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Perusahaan</th>
          <th>Kabupaten</th>
          <th>Komoditas</th>
          <th>Status</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-produksi">
        
      </tbody>
    </table>
  </div>
</div>


<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataProduksi', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'Pegawai';
  $data['url'] = 'Pegawai/import';
  echo show_my_modal('modals/modal_import', 'import-pegawai', $data);
?>