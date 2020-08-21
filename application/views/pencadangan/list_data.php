<?php
  //$current_date = date('Y-m-d');
 $no = 1;
  foreach ($dataPencadangan as $pencadangan) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $pencadangan->nm_perusahaan; ?></td>
      <td><?php echo $pencadangan->luas_wilayah; ?></td>
      <td><?php echo $pencadangan->nm_desa; ?></td>
      <td><?php echo $pencadangan->nm_kecamatan; ?></td>
      <td><?php echo $pencadangan->nm_kabupaten; ?></td>
      <td><?php echo $pencadangan->nm_komoditas; ?></td>
     <td><?php echo $pencadangan->nmr_sk_pw; ?></td>
      <td><?php echo $pencadangan->tgl_sk_pw; ?></td>
      <td class="text-center" style="min-width:230px;">
        <button class="btn btn-warning update-dataPencadangan" data-id="<?php echo $pencadangan->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Update Data</button>
        <button class="btn btn-success approve-dataPencadangan" data-id="<?php echo $pencadangan->id; ?>"><i class="glyphicon glyphicon-ok"></i> Approve</button>
       <!--  <button class="btn btn-danger konfirmasiHapus-pencadangan" data-id="<?php echo $pencadangan->id; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button> -->
      </td>
    </tr>
    <?php
      $no++;
  }

?>
