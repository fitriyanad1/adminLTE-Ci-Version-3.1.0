<?php
 $no = 1;
  foreach ($dataProduksi as $produksi) {
    ?>
    <tr>
    <td><?php echo $no; ?></td>
     <td><?php echo $produksi->nm_perusahaan; ?></td>
     <td><?php echo $produksi->nm_kabupaten; ?></td>
      <td><?php echo $produksi->nm_komoditas; ?></td>
      <td><?php echo "<font color='#64DD17'><b>$produksi->status</b></font>" ?></td>
      <td class="text-center" style="min-width:230px;">
       <!-- <button  class="btn btn-warning kelola-dataProduksi" data-id="<?php echo $produksi->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Kelola data <?php echo $produksi->id; ?></button> -->
      <form action="/esdm/KelolaProduksi/" method="POST" id="kelola-dataProduksi">
      <input type="hidden" name="id" value="<?php echo $produksi->id; ?>">
      <button type="submit" class="btn btn-warning kelola-dataProduksi" data-id="<?php echo $produksi->id; ?>"><i class="glyphicon glyphicon-edit"></i> Kelola Pajak </button>
      </form>

      </td>
    </tr>
    <?php
      $no++;
  }
?>