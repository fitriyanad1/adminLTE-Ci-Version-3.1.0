<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data Perusahaan</h3>
      <form method="POST" id="form-update-perusahaan">
        <input type="hidden" name="id" value="<?php echo $dataPerusahaan->id; ?>">
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-user"></i>
          </span>
          <input type="text" class="form-control"laceholder="NamaPerusahaan" name="nm_perusahaan" aria-describedby="sizing-addon2" value="<?php echo $dataPerusahaan->nm_perusahaan; ?>">
        </div>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-file"></i>
          </span>
          <input type="text" class="form-control" placeholder="NomorSK" name="nomor_sk" aria-describedby="sizing-addon2" value="<?php echo $dataPerusahaan->nomor_sk; ?>">
        </div>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
             <i class="glyphicon glyphicon-flag"></i>
          </span>
          <input type="number" step="0.01" class="form-control" placeholder="LuasWilayah" name="luas_wilayah" aria-describedby="sizing-addon2" value="<?php echo $dataPerusahaan->luas_wilayah; ?>">
            <span class="input-group-addon" id="basic-addon2">HA</span>
        </div>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
           <i class="glyphicon glyphicon-map-marker"></i>
          </span>
        <select name="kabupaten" id="kabupaten" class="form-control" aria-describedby="sizing-addon2">
         <option value="">Pilih kabupaten</option>
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
             <option value="">Pilih kecamatan</option>
          </select>
        </div> 
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
           <i class="glyphicon glyphicon-map-marker"></i>
          </span>
          <select name="desa" id="desa" class="form-control" aria-describedby="sizing-addon2">
         <option value="">Pilih desa</option>
        </select>
        </div>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
           <i class="glyphicon glyphicon-tint"></i>
          </span>
        <select name="kegiatan" class="form-control" aria-describedby="sizing-addon2">
          <option value="PencandanganWilayah">Pencadangan Wilayah</option>
          <option value="IUPEksplorasi">IUP Eksplorasi</option>  
          <option value="OperasiPoduksi">Operasi Produksi</option>   
        </select>
        </div>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
           <i class="glyphicon glyphicon-asterisk"></i>
          </span>
        <select name="komoditas" id="komoditas" class="form-control" aria-describedby="sizing-addon2">
         <option value="">Pilih komoditas</option>
        </select>
        </div>
          <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-calendar"></i>
          </span>
         <input type="date" class="form-control" placeholder="Tanggal Mulai" name="tgl_mulai" aria-describedby="sizing-addon2"  value="<?php echo $dataPerusahaan->tgl_mulai; ?>">
         </div>

        <div class="input-group form-group">
           <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-calendar"></i>
          </span>
          <input type="date" class="form-control" placeholder="Tanggal Berakhir" name="tgl_berakhir" aria-describedby="sizing-addon2" value="<?php echo $dataPerusahaan->tgl_berakhir; ?>">
        </div>
        <?php echo $dataPerusahaan->id; ?>
        <div class="form-group">
          <div class="col-md-12">
              <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
          </div>
        </div>
      </form>
</div>

<!-- <script type="text/javascript">
$(function () {
    $(".select2").select2();
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });
});
</script> -->
<script type="text/javascript">
  $(document).ready(function(){
    $('#kabupaten').change(function() {
    var id_kabupaten = $('#kabupaten').val();
    if(kabupaten != '')
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
      $('#kecamatan').html('<option value="">Pilih Kecamatan</option>');

      $('#desa').html('<option value="">Pilih Desa</option>');
    }
  });

   $('#kecamatan').change(function(){
      var id_kecamatan = $('#kecamatan').val();
      if(kecamatan != ''){
        $.ajax({
          url: "<?php echo base_url();?>Perusahaan/load_desa",
          method: "POST",
          data: {id_kecamatan:id_kecamatan},
          success:function(data){
          $('#desa').html(data);
          }
        })
      }

    });

});
</script>
<script type="text/javascript">
  $(document).ready(function(){
  $('#kabupaten').change(function(){
      var id_kabupaten = $('#kabupaten').val();
      if(kabupaten != ''){
        $.ajax({
          url: "<?php echo base_url();?>Perusahaan/load_komoditas",
          method: "POST",
          data: {id_kabupaten:id_kabupaten},
          success:function(data){
          $('#komoditas').html(data);
          }
        })
      }

    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
  $('#kabupaten').change(function(){
      var id_kabupaten = $('#kabupaten').val();
      if(kabupaten != ''){
        $.ajax({
          url: "<?php echo base_url();?>Perusahaan/load_komoditas",
          method: "POST",
          data: {id_kabupaten:id_kabupaten},
          success:function(data){
          $('#komoditas').html(data);
          }
        })
      }

    });
  });
</script>