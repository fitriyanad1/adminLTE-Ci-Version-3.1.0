<?php
  foreach ($dataAdmin as $admin) {
    ?>
    <tr>
      <td style="min-width:230px;"><?php echo $admin->username; ?></td>
      <td><?php echo $admin->password; ?></td>
      <td><?php echo "<img src='".base_url("/assets/img/".$admin->foto)."' width='40' height='40'>"; ?></td>
      <td><?php echo $admin->nama; ?></td>
      <td class="text-center" style="min-width:330px;">
        <button class="btn btn-warning update-dataAdmin" data-id="<?php echo $admin->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Kelola</button>
        <button class="btn btn-danger konfirmasiHapus-admin" data-id="<?php echo $admin->id; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Hapus</button>
      </td>
    </tr>
    <?php
  }
?>