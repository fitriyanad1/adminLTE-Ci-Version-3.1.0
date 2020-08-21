<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Approve Izin IUP Pencadangan Wilayah <?php echo $dataPencadangan->nm_perusahaan; ?></h3>

  <form id="form-approve-pencadangan" method="POST">
        <input type="hidden" name="id" value="<?php echo $dataPencadangan->id; ?>">
     <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-file"></i>
      </span>
      <input type="text" class="form-control" placeholder="Nomor SK" name="nomor_sk" aria-describedby="sizing-addon2">
    </div>



    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
     <input type="date" class="form-control" placeholder="Tanggal Mulai" name="tgl_mulai" aria-describedby="sizing-addon2">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
     <input type="date" class="form-control" placeholder="Tanggal Berakhir" name="tgl_berakhir" aria-describedby="sizing-addon2">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-tint"></i>
      </span>
      <select name="jenis_izin" id="kabupaten" class="form-control" aria-describedby="sizing-addon2">
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
        <i class="glyphicon glyphicon-tint"></i>
      </span>
      <select name="status" class="form-control" aria-describedby="sizing-addon2">
          <option value="">-- Pilih Status --</option>
          <option value="Berproduksi">Berproduksi</option>
          <option value="Dalam Proses Perpanjangan">Dalam Proses Perpanjangan</option>  
          <option value="Tidak Berproduksi">Tidak Berproduksi</option>
          <option value="Habis Masa Berlaku">Habis Masa Berlaku</option>
      </select>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        
          <button type="submit" class="form-control btn btn-success"> <i class="glyphicon glyphicon-ok"></i> Approve Izin Pencadangan Wilayah</button>
      </div>
    </div>
  </form>
</div>

<!-- <script type="text/javascript">
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
      $('#kecamatan').html('<option value="">-- Pilih Kecamatan</option>');

      $('#desa').html('<option value="">-- Pilih Desa --</option>');
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
</script> -->