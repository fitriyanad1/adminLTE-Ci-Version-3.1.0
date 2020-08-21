<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Tambah Data Perusahaan</h3>

  <form id="form-tambah-perusahaan" method="POST">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <input type="text" class="form-control" placeholder="NamaPerusahaan" name="nm_perusahaan" aria-describedby="sizing-addon2">
    </div>
     <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-file"></i>
      </span>
      <input type="text" class="form-control" placeholder="NomorSK" name="nomor_sk" aria-describedby="sizing-addon2">
    </div>
     <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-flag"></i>
      </span>
      <input type="number" step="0.01" class="form-control" placeholder="LuasWilayah" name="luas_wilayah" aria-describedby="sizing-addon2">
        <span class="input-group-addon" id="basic-addon2">HA</span>
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-map-marker"></i>
      </span>
      <select name="kabupaten" id="kabupaten" class="form-control" aria-describedby="sizing-addon2">
         <option value="">-- Pilih Kabupaten --</option>
          <?php
            foreach ($dataKabupaten as $kabupaten) {
              ?>
              <option value="<?php echo $kabupaten->id_kabupaten; ?>">
                <?php echo $kabupaten->nama; ?>
              </option>
              <?php
            }
            ?>
      </select>
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-map-marker"></i>
      </span>
      <select name="kecamatan" id="kecamatan" class="form-control" aria-describedby="sizing-addon2">
         <option value="">-- Pilih Kecamatan --</option>
      </select>
    </div>    
     <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-map-marker"></i>
      </span>
     <select name="desa" id="desa" class="form-control" aria-describedby="sizing-addon2">
         <option value="">-- Pilih Desa --</option>
        </select>
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-tint"></i>
      </span>
      <select name="jenis_izin" id="jenis_izin_select" class="form-control" aria-describedby="sizing-addon2">
         <option value="">-- Pilih Jenis Izin --</option>
          <?php
            foreach ($dataJenisIzin as $izin) {
              ?>
              <option value="<?php echo $izin->id_izin; ?>">
                <?php echo $izin->jenis_izin; ?>
              </option>
              <?php
            }
            ?>
      </select>
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-asterisk"></i>
      </span>
      <select name="komoditas" id="komoditas" class="form-control" aria-describedby="sizing-addon2">
         <option value="">-- Pilih Komoditas --</option>
        </select>
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
      <!-- <input type="date" class="form-control" placeholder="Tanggal Mulai" name="tgl_mulai" aria-describedby="sizing-addon2"> -->
      <input name="tgl_mulai" placeholder="Tanggal Mulai Berlaku" class="form-control" type="text" onfocus="(this.type = 'date')" id="date">
    </div>

    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
      <!-- <input type="date" class="form-control" placeholder="Tanggal Berakhir" name="tgl_berakhir" aria-describedby="sizing-addon2"> -->
      <input name="tgl_berakhir" placeholder="Tanggal Berakhir" class="form-control" type="text" onfocus="(this.type = 'date')" id="date">
    </div>

    <div class="input-group form-group" id="myStatusDiv">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-tint"></i>
      </span>
      <select name="status" id="status_select" class="form-control" aria-describedby="sizing-addon2">
          <option value="">-- Pilih Status --</option>
          <option value="Berproduksi">Berproduksi</option>
          <option value="Dalam Proses Perpanjangan">Dalam Proses Perpanjangan</option>  
          <option value="Tidak Berproduksi">Tidak Berproduksi</option>
          <option value="Habis Masa Berlaku">Habis Masa Berlaku</option>
          <option value="-">-</option>
      </select>
    </div>
    
    <div class="form-group">
      <div class="col-md-12">        
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Data Perusahaan</button>
      </div>
    </div>
  </form>
</div>

<script type="text/javascript">
$(function () {
    $(".select2").select2();

    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });
});
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#status_select').children('option[value="-"]').css('display','none');
    $('#jenis_izin_select').change(function() {
      var id_izin = $('#jenis_izin_select').val();
      var x = document.getElementById("myStatusDiv");
      if(id_izin != 2){      
        x.style.display = "none";
        $('#status_select').val("-");
      }else{
        x.style.display = "";
        $('#status_select').val("");
      }
  });
});
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#kabupaten').change(function() {
    var id_kabupaten = $('#kabupaten').val();
    if(id_kabupaten != '')
    {
      $.ajax({
      url: "<?php echo base_url();?>Perusahaan/load_kecamatan",
      method: "POST",
      data: {id_kabupaten:id_kabupaten},
      success:function(data){
        $('#kecamatan').html(data);
      }
      })
    }
    else {
      $('#kecamatan').html('<option value="">-- Pilih Kecamatan --</option>');
      $('#desa').html('<option value="">-- Pilih Desa --</option>');
    }
  });

   $('#kecamatan').change(function(){
      var id_kecamatan = $('#kecamatan').val();
      if(id_kecamatan != ''){
        $.ajax({
          url: "<?php echo base_url();?>Perusahaan/load_desa",
          method: "POST",
          data: {id_kecamatan:id_kecamatan},
          success:function(data){
          $('#desa').html(data);
          }
        })
      }else{
        $('#desa').html('<option value="">-- Pilih Desa --</option>');
      }
    });

});
</script>
<script type="text/javascript">
  $(document).ready(function(){
  $('#kabupaten').change(function(){
      var id_kabupaten = $('#kabupaten').val();
      if(id_kabupaten != ''){
        $.ajax({
          url: "<?php echo base_url();?>Perusahaan/load_komoditas",
          method: "POST",
          data: {id_kabupaten:id_kabupaten},
          success:function(data){
          $('#komoditas').html(data);
          }
        })
      }else{
        $('#komoditas').html('<option value="">-- Pilih Komoditas --</option>');
      }
    });
  });
</script>