<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>


<div class="box">
  <div class="box-header">
 <div class="col-md-6" style="padding: 0;">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-pajak"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Produksi</button>
    </div>
        <div class="col-md-3">
        <form action="/esdm/KelolaProduksi/export" method="POST">
        <input type="hidden" name="id" value="<?php echo $dataHarga->id; ?>">
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
          <th>Tahun</th>
          <th>Bulan</th>
          <th>Volume</th>
          <th>Total Pajak</th>
          <th>Pajak Bayar</th>          
          <th>Bukti Pembayaran</th>
          <th>Keterangan</th>
          <!-- <th>Tanggal Upload</th> -->
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-kelolaproduksi">
        <?php if ($dataKelola != null) {
           $no = 1;
            foreach($dataKelola as $dataKelola) {
              ?>
              <tr>
              <!--   <td style="min-width:230px;"><?php echo $produksi->tgl; ?></td> -->
                <td><?php echo $no; ?></td>
                <td><?php echo $dataKelola->tahun_produksi; ?></td>
                <td><?php echo $dataKelola->bulan_produksi; ?></td>
                <td><?php echo number_format($dataKelola->volume,0,',','.'); ?> M3</td>
                <td><?php echo "Rp ".number_format($dataKelola->total_pajak,0,',','.'); ?></td>
                <td><?php echo "Rp ".number_format($dataKelola->pajak_bayar,0,',','.'); ?></td>
                <td>
                  <?php 
                    $list_bukti = $dataKelola->nm_bukti;
                    $array_bukti = explode("<br>", $list_bukti);
                    // echo "<pre>";
                    // echo print_r($array_bukti);
                    // echo "</pre>";
                    foreach($array_bukti as $nm_bukti){
                  ?>
                      <a download="<?php echo $nm_bukti; ?>" href="<?php echo base_url('assets/buktibayar/'.$nm_bukti);?>"><?php echo $nm_bukti; ?></a><br>
                  <?php
                    }
                  ?>
                  <!-- <?php echo $list_bukti; ?> -->
                </td>
                <td>
                  <?php
                    if($dataKelola->ket_bayar == 'Kurang Bayar Pajak'){
                      echo "<font color='#EF1C1C'><b>$dataKelola->ket_bayar</b></font>";
                    }elseif($dataKelola->ket_bayar == 'Sudah Bayar Pajak'){
                      echo "<font color='#64DD17'><b>$dataKelola->ket_bayar</b></font>";
                    }
                  ?>
                </td>
                 <!-- <td><?php echo $dataKelola->tgl; ?></td> -->
                <td class="text-center" style="min-width:230px;">
                  <?php 
                    if($dataKelola->ket_bayar == 'Kurang Bayar Pajak'){
                  ?>
                      <button class="btn btn-warning update-dataBayar" data-id="<?php echo $dataKelola->id_produksi; ?>"><i class="glyphicon glyphicon-repeat"></i> Bayar </button>
                  <?php
                    }
                  ?>
                </td>
              </tr>
              <?php
                $no++;
              }
            }
          ?>
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