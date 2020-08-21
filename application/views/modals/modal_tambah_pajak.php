<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Tambah Data Produksi <?php echo $dataHarga->id; ?></h3>

  <form id="form-tambah-pajak" method="POST">
    <input type="hidden" name="id" value="<?php echo $dataHarga->id; ?>">
    <?php
      foreach($dataKelola as $produksi){
    ?>
        <input type="hidden" name="tahun_produksi[]" value="<?php echo $produksi->tahun_produksi; ?>">
        <input type="hidden" name="bulan_produksi[]" value="<?php echo $produksi->bulan_produksi; ?>">
        <input type="hidden" name="id_produksi[]" value="<?php echo $produksi->id_produksi; ?>">
        <input type="hidden" name="volume_awal[]" value="<?php echo $produksi->volume; ?>" >
        <input type="hidden" name="total_pajak_awal[]" value="<?php echo $produksi->total_pajak; ?>" >
    <?php
      }
    ?>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
    <?php 
        $yearArray = range(2000, 2050); ?>
      <select name="tahun" id="year-select" class="form-control" aria-describedby="sizing-addon2">
          <option value="">--Select Year--</option>
          <?php
          foreach ($yearArray as $year) {
              // if you want to select a particular year
              $selected = ($year == 2018) ? 'selected' : '';
              echo '<option '.$selected.' value="'.$year.'">'.$year.'</option>';
          }
          ?>
      </select>
    </div>
    <div class="input-group form-group" id="myStatusDiv">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
      <select name="bulan" id="status_select" class="form-control" aria-describedby="sizing-addon2">
          <option value="">-- Pilih Bulan --</option>
          <option value="Januari">Januari</option>
          <option value="Februari">Februari</option>  
          <option value="Maret">Maret</option>
          <option value="April">April</option>
          <option value="Mei">Mei</option>
          <option value="Juni">Juni</option>
          <option value="Juli">Juli</option>
          <option value="Agustus">Agustus</option>
          <option value="September">September</option>
          <option value="Oktober">Oktober</option>
          <option value="November">November</option>
          <option value="Desember">Desember</option>
      </select>
    </div>
     <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-tint"></i>
      </span>
      <input type="number" class="form-control" placeholder="Volume" name="volume" id="volume_input" min="1" aria-describedby="sizing-addon2">
        <span class="input-group-addon" id="basic-addon2">M3</span>
    </div>


     <label class="col-sm-12 control-label"><font color='#EF1C1C'><b>Total Pajak Bayar : </b></font></label>

    <div class="input-group form-group">
       <span class="input-group-addon" id="basic-addon2">Rp</span>
     <input type="number" class="form-control" value="0" name="total_pajak" id="total_pajak" aria-describedby="sizing-addon2" readonly="readonly" value="">
     </div>
    
    <div class="form-group">
      <div class="col-md-12">        
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Data Produksi</button>
      </div>
    </div>
  </form>
</div>
    <!-- jQuery 2.2.3 -->
<script src="http://localhost/esdm/assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript"> 
  $(document).ready(function(){
    $('#volume_input').keyup(function(){
      var vol = parseFloat($('#volume_input').val()) || 0;
      var tarif = <?php echo $dataTarif->tarif; ?>;
      var harga_komoditas = <?php echo $dataHarga->harga_komoditas; ?>;
      $('#total_pajak').val(vol*tarif*harga_komoditas);    
    });
  });
  
</script>