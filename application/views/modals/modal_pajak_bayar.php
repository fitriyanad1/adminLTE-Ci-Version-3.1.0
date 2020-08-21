<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data Pembayaran Pajak Produksi</h3>
      <form method="POST" id="form-pajak-bayar" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $dataKelola->id_produksi; ?>">
        <input type="hidden" name="total_pajak" value="<?php echo $dataKelola->total_pajak?>" />
        <input type="hidden" name="pajak_bayar" value="<?php echo $dataKelola->pajak_bayar?>" />
        <div class="input-group form-group">          
          <span class="input-group-addon" id="basic-addon2">Rp</span>
          <input type="number" class="form-control" placeholder="Nominal Bayar" id="nominal_input" name="nominal" min="1" max="<?php echo $dataKelola->total_pajak-$dataKelola->pajak_bayar; ?>" aria-describedby="sizing-addon2">
        </div>
        <div class="form-group">
              <label for="inputFoto" class="col-sm-10 control-label">Unggah Bukti Bayar (.jpg / .png / .pdf ) [Max: 5 MB] </label>
              <div class="col-sm-14">
                <input type="file" class="form-control" placeholder="Bukti Bayar" name="bukti_bayar">
              </div>
        </div>
        
        <div class="form-group">
          <div class="col-md-12">
              <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Pembayaran</button>
          </div>
        </div>        
      </form>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('#nominal_input').keyup(function(){
      var nominal = parseInt($('#nominal_input').val()) || 0;
      var total_pajak = <?php echo $dataKelola->total_pajak; ?>;
      var pajak_bayar = <?php echo $dataKelola->pajak_bayar; ?>;
      $('#nominal_input').val(nominal);
      if (nominal == 0){$('#nominal_input').val(0)}
      if(nominal < 0){$('#nominal_input').val(0);}
      if(nominal > (total_pajak-pajak_bayar)){$('#nominal_input').val(total_pajak-pajak_bayar);}
    });
  });
</script>
