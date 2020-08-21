<?php
$current_date = date('Y-m-d');
 $no = 1;
  foreach ($dataPerusahaan as $perusahaan) {

    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $perusahaan->nm_perusahaan; ?></td>
      <td><?php echo $perusahaan->jenis_izin; ?></td>
      <td><?php echo $perusahaan->nomor_sk; ?></td> 
      <td><?php echo $perusahaan->luas_wilayah; ?></td>
      <td><?php echo $perusahaan->nm_desa; ?></td>
      <td><?php echo $perusahaan->nm_kecamatan; ?></td>
      <td><?php echo $perusahaan->nm_kabupaten; ?></td>
      <td><?php echo $perusahaan->nm_komoditas; ?></td>
      <td><?php echo date('d F Y', strtotime($perusahaan->tgl_mulai)); ?></td>
      <td><?php echo date('d F Y', strtotime($perusahaan->tgl_berakhir)); ?></td>
      <td>
         <?php 
          if($perusahaan->status == 'Habis Masa Berlaku'){
            echo "<font color='#EF1C1C'><b>$perusahaan->status</b></font>";
          }elseif($perusahaan->status == 'Tidak Berproduksi'){
            echo "<font color='#FFAF00'><b>$perusahaan->status</b></font>";
          }elseif($perusahaan->status == 'Berproduksi'){
            echo "<font color='#64DD17'><b>$perusahaan->status</b></font>";
          }elseif($perusahaan->status == 'Dalam Proses Perpanjangan'){
            echo "<font color='#2196F3'><b>$perusahaan->status</b></font>";
          }
          else{
            echo $perusahaan->status;
          }
        ?>
                      
       </td>
      <td class="text-center" style="min-width:20px;">
        <button class="btn btn-warning update-dataPerusahaan" data-id="<?php echo $perusahaan->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Update Data</button>
       <!--  <button class="btn btn-danger konfirmasiHapus-perusahaan" data-id="<?php echo $perusahaan->id; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button> -->
      </td>
    </tr>
    <?php
     $no++;
  }
?>
