<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Tambah Izin IUP Pencadangan Wilayah</h3>

  <form id="form-tambah-pencadangan" method="POST">
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
      <input type="text" class="form-control" placeholder="NomorSK" name="nmr_sk_pw" aria-describedby="sizing-addon2">
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
     <input type="date" class="form-control" placeholder="Tanggal Pengajuan" name="tgl_sk_pw" aria-describedby="sizing-addon2">
    </div>
    <div class="form-group">
      <div class="col-md-12">
        
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Izin Pencadangan Wilayah</button>
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