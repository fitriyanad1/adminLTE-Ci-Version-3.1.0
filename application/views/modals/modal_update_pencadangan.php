<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data IUP Pencadangan Wilayah</h3>
      <form method="POST" id="form-update-pencadangan">
        <input type="hidden" name="id" value="<?php echo $dataPencadangan->id; ?>">
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-user"></i>
          </span>
          <input type="text" class="form-control" placeholder="Nama Pemohon" name="nm_perusahaan" aria-describedby="sizing-addon2" value="<?php echo $dataPencadangan->nm_perusahaan; ?>">
        </div>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-file"></i>
          </span>
          <input type="text" class="form-control" placeholder="Nomor SK Pengajuan" name="nmr_sk_pw" aria-describedby="sizing-addon2" value="<?php echo $dataPencadangan->nmr_sk_pw; ?>">
        </div>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
             <i class="glyphicon glyphicon-flag"></i>
          </span>
          <input type="number" step="0.01" class="form-control" placeholder="LuasWilayah" name="luas_wilayah" aria-describedby="sizing-addon2" value="<?php echo $dataPencadangan->luas_wilayah; ?>">
            <span class="input-group-addon" id="basic-addon2">HA</span>
        </div>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
           <i class="glyphicon glyphicon-map-marker"></i>
          </span>
        <select name="kabupaten" id="kabupaten_select" class="form-control" aria-describedby="sizing-addon2">
         <option value="">-- Pilih Kabupaten --</option>
           <?php
            foreach ($dataKabupaten as $kabupaten) {
              ?>
              <option data-kab="<?php echo $kabupaten->id_kabupaten; ?>" 
                value="<?php echo $kabupaten->id_kabupaten; ?>">
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
          <select name="kecamatan" id="kecamatan_select" class="form-control" aria-describedby="sizing-addon2">
             <option value="">-- Pilih Kecamatan --</option>
          </select>
        </div> 
       <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-map-marker"></i>
          </span>
          <select name="desa" id="desa_select" class="form-control" aria-describedby="sizing-addon2">
            <option value="">-- Pilih Desa -- </option>
          </select>
        </div>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
           <i class="glyphicon glyphicon-asterisk"></i>
          </span>
        <select name="komoditas" id="komoditas_select" class="form-control" aria-describedby="sizing-addon2">
         <option value="">-- Pilih Komoditas --</option>
        </select>
        </div>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-calendar"></i>
          </span>
          <input type="date" class="form-control" placeholder="Tanggal Pengajuan" name="tgl_sk_pw" aria-describedby="sizing-addon2"  value="<?php echo $dataPencadangan->tgl_sk_pw; ?>">
        </div>
        <?php //echo $dataPerusahaan->id; ?>
       <!--  <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-tint"></i>
          </span>
          <select id="status_select" name="status" class="form-control" aria-describedby="sizing-addon2">
              <option value="Berproduksi">Berproduksi</option>
              <option value="Dalam Proses Perpanjangan">Dalam Proses Perpanjangan</option>  
              <option value="Tidak Berproduksi">Tidak Berproduksi</option>
              <option value="Habis Masa Berlaku">Habis Masa Berlaku</option>   
          </select>
        </div> -->
        <div class="form-group">
          <div class="col-md-12">
              <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
          </div>
        </div>
        
      </form>
</div>
<script type="text/javascript">
  $('#kabupaten_select').val("<?php echo $dataPencadangan->id_kabupaten; ?>"); 
</script>
<script type="text/javascript">
  $(document).ready(function(){
    var id_kabupaten_awal = <?php echo $dataPencadangan->id_kabupaten; ?>;
    $('#kabupaten_select').change(function() {
    var id_kabupaten = $('#kabupaten_select').find(':selected').data('kab');
    // console.log(id_kabupaten+" -> id_kabupaten yang diselect");
    if(id_kabupaten != '' && typeof id_kabupaten !== 'undefined')
    {
      $.ajax({
        url: "<?php echo base_url();?>Pencadangan/load_kecamatan",
        method: "POST",
        data: {id_kabupaten:id_kabupaten},
        success:function(data){
          $('#kecamatan_select').html(data);
          // console.log("id_kec : "+$('#kecamatan_select').find(':selected').data('kec'));
          // console.log(id_kabupaten_awal+"=> id_kab_awal success");
          // console.log(id_kabupaten+" => id_kab if");
          // console.log(id_kabupaten == id_kabupaten_awal);
          if(id_kabupaten == id_kabupaten_awal){
            $('#kecamatan_select').val(<?php echo $dataPencadangan->id_kecamatan; ?>);
            id_kabupaten_awal = '-';
          }else{
            // $('#kecamatan_select').html('<option value="">-- Pilih Kecamatan --</option>');
            $('#desa_select').html('<option value="">-- Pilih Desa --</option>');
          }
        }
      })
    }
    else {
      $('#kecamatan_select').html('<option value="">-- Pilih Kecamatan --</option>');
      $('#desa_select').html('<option value="">-- Pilih Desa --</option>');
    }
  });
  // $('#kabupaten_select').trigger('change');
  var id_kecamatan_awal = <?php echo $dataPencadangan->id_kecamatan; ?>;
  var id_kabupaten_awal1 = <?php echo $dataPencadangan->id_kabupaten; ?>;
  $('#kecamatan_select').change(function(){
      var id_kabupaten = $('#kabupaten_select').find(':selected').data('kab');
      var id_kecamatan = $('#kecamatan_select').find(':selected').data('kec');
      var id_kec = id_kecamatan;
      if(id_kecamatan != ''){
        // console.log("id_kecamatan != kosong => "+(id_kecamatan != ''));
        // console.log("id_kecamatan === undefined => "+(typeof id_kecamatan === 'undefined' ));
        if(typeof id_kecamatan === 'undefined'){
          id_kec = id_kecamatan_awal;
          // console.log("masuk jika undefined: "+id_kec);
        }else{
          id_kec = id_kecamatan;
          // console.log("masuk jika tidak undefined: "+id_kec);
        }
        console.log("id_kec yang diload: "+id_kec);
        $.ajax({
          url: "<?php echo base_url();?>Pencadangan/load_desa",
          method: "POST",
          data: {id_kecamatan:id_kec},
          success:function(data){
            $('#desa_select').html(data);
            // console.log("id_kabupaten: "+id_kabupaten+" (<?php echo $dataPencadangan->nm_kabupaten; ?>)");
            // console.log("id_kabupaten_awal: "+id_kabupaten_awal1+" (<?php echo $dataPencadangan->nm_kabupaten; ?>)");
            // console.log("id_kecamatan: "+id_kecamatan+" (<?php echo $dataPencadangan->nm_kecamatan; ?>)");
            // console.log("id_kecamatan_awal: "+id_kecamatan_awal+" (<?php echo $dataPencadangan->nm_kecamatan; ?>)");
            // console.log("id_desa_awal: "+<?php echo $dataPencadangan->id_desa; ?>+" (<?php echo $dataPencadangan->nm_desa; ?>)");
            // console.log(id_kabupaten == id_kabupaten_awal1);
            // console.log(id_kecamatan == id_kecamatan_awal);

            if(id_kabupaten == id_kabupaten_awal1){
              $('#desa_select').val(<?php echo $dataPencadangan->id_desa; ?>);
              id_kabupaten_awal1 = '-';
            }else{  
              // id_kecamatan_awal = id_kecamatan;
            }  
          }
        });
      }else {
        $('#desa_select').html('<option value="">-- Pilih Desa --</option>');
        // $('#desa_select').val(<?php echo $dataPencadangan->id_desa; ?>);
      } 
  });
  $('#kecamatan_select').trigger('change');
  // $('#desa_select').trigger('change');
});
</script>
 <script type="text/javascript">
  $(document).ready(function(){
  var id_kabupaten_awal = <?php echo $dataPencadangan->id_kabupaten; ?>;
  $('#kabupaten_select').change(function(){
      var id_kabupaten = $('#kabupaten_select').find(':selected').data('kab');
      if(id_kabupaten != '' && typeof id_kabupaten !== 'undefined'){
        $.ajax({
          url: "<?php echo base_url();?>Pencadangan/load_komoditas",
          method: "POST",
          data: {id_kabupaten:id_kabupaten},
          success:function(data){
            $('#komoditas_select').html(data);
            // console.log("id kab : "+id_kabupaten);
            // console.log("id kab awal : "+id_kabupaten_awal);
            if(id_kabupaten == id_kabupaten_awal){
              $('#komoditas_select').val(<?php echo $dataPencadangan->id_komoditas; ?>);
              id_kabupaten_awal = '-';
            }else{
              // $('#komoditas_select').html('<option value="">-- Pilih Komoditasiii --</option>');
            }
          }
        })
      }else{
          $('#komoditas_select').html('<option value="">-- Pilih Komoditas --</option>');
      }
    });
  });
  $('#kabupaten_select').trigger('change');
</script>
