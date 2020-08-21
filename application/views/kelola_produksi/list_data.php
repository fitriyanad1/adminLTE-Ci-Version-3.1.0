<?php
 $no = 1;
  // foreach ($dataKelola) {
    ?>
    <tr>
    <!--   <td style="min-width:230px;"><?php echo $produksi->tgl; ?></td> -->
      <td><?php echo $no; ?></td>
      <td><?php echo $dataKelola->tahun_produksi; ?></td>
       <td><?php echo $dataKelola->bulan_produksi; ?></td>
       <td><?php echo $dataKelola->volume; ?></td>
       <td><?php echo $dataKelola->total_pajak; ?></td>
       <td><?php echo $dataKelola->pajak_bayar; ?></td>
       <td><?php echo $dataKelola->ket_bayar; ?></td>
      <td class="text-center" style="min-width:230px;">
        <button class="btn btn-warning update-dataBayar" data-id="<?php echo $dataKelola->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Bayar <?php echo $dataKelola->id; ?></button>
      </td>
    </tr>
    <?php
      $no++;
  // }
?>