<div class="col-md-offset-1 col-md-12 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Kelola Data Admin Cabang Dinas</h3>

<div class="row">
  <div class="col-md-3">
    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
         <input type="hidden" name="id" value="<?php echo $dataAdmin->id; ?>">
        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url(); ?>assets/img/<?php echo $dataAdmin->foto; ?>" alt="User profile picture">

        <h3 class="profile-username text-center"><?php echo $dataAdmin->nama; ?></h3>

        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Username</b> <a class="pull-right"><?php echo $dataAdmin->username; ?></a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="col-md-9">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
        <li><a href="#password" data-toggle="tab">Ubah Password</a></li>
      </ul>
      <div class="tab-content">

        <div class="active tab-pane" id="settings">
         <form method="POST"  id="form-update-admin" class="form-horizontal" enctype="multipart/form-data">
<!-- <form method="POST"  id="form-update-admin" class="form-horizontal"> -->
          <input type="hidden" name="id" value="<?php echo $dataAdmin->id; ?>">
            <div class="form-group">
              <label for="inputUsername" class="col-sm-2 control-label">Username</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id= placeholder="Username" name="username" value="<?php echo $dataAdmin->username; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputNama" class="col-sm-2 control-label">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Name" name="nama" value="<?php echo $dataAdmin->nama; ?>">
              </div>
            </div>
           <div class="form-group">
              <label for="inputFoto" class="col-sm-2 control-label">Foto</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" placeholder="Foto" name="foto">
              </div>
            </div>
            <?php echo $dataAdmin->id; ?>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                 <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
              </div>
            </div>
          </form>
        </div>
        <div class="tab-pane" id="password">
          <form class="form-horizontal" id="form-update-admin-pass" method="POST">
            <div class="form-group">
              <label for="passLama" class="col-sm-2 control-label">Password Lama</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" placeholder="Password Lama" name="passLama">
              </div>
            </div>
            <div class="form-group">
              <label for="passBaru" class="col-sm-2 control-label">Password Baru</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" placeholder="Password Baru" name="passBaru">
              </div>
            </div>
            <div class="form-group">
              <label for="passKonf" class="col-sm-2 control-label">Konfirmasi Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" placeholder="Konfirmasi Password" name="passKonf">
              </div>
            </div>
             <?php echo $dataAdmin->id; ?>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>