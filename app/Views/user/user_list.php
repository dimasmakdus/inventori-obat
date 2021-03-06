<?= $this->extend('templates/adminlte_template') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><?= $title ?></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Beranda</a></li>
          <li class="breadcrumb-item active"><?= $title ?></li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><?= $card_title ?></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <?php
            if (session()->getFlashData('success')) {
            ?>
              <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fas fa-check"></i>
                <?= session()->getFlashData('success') ?>
                </button>
              </div>
            <?php
            }
            ?>
            <a class="btn bg-olive mb-3" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah Pengguna</a>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Lengkap</th>
                  <th>Email</th>
                  <th>Role Pengguna</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1 ?>
                <?php foreach ($dataUser as $user) : ?>
                  <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $user['full_name'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['id_user_role'] ?></td>
                    <td><?= $user['is_active'] ?></td>
                    <td>
                      <a class="btn btn-sm bg-olive btn-edit-user" data-toggle="modal" data-target="#edit-<?= $user['id_user'] ?>"><i class="fas fa-edit"></i> Ubah</a>

                      <a class="btn btn-sm btn-danger btn-delete-user" data-toggle="modal" data-target="#hapus-<?= $user['id_user'] ?>"><i class="fas fa-trash-alt"></i> Hapus</a>
                    </td>
                  </tr>

                  <!-- Modal Hapus  -->
                  <div class="modal fade" id="hapus-<?= $user['id_user'] ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Konfirmasi Hapus</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Apakah anda yakin ingin manghapus data ini?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <a class="btn btn-default" data-dismiss="modal">Tidak</a>
                          <a href="<?= base_url('pengguna/delete') ?>/<?= $user['id_user'] ?>" class="btn btn-danger">Hapus</a>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->

                  <!-- Modal Edit -->
                  <div class="modal fade" id="edit-<?= $user['id_user'] ?>">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <form class="form-horizontal" action="<?= base_url('pengguna/update'); ?>" method="POST">
                          <div class="modal-header">
                            <h4 class="modal-title">Tambah Data Pengguna</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                            <div class="form-group row">
                              <label for="nama-lengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama-lengkap" value="<?= $user['full_name'] ?>" placeholder="Nama Lengkap" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="email" class="col-sm-2 col-form-label">Email</label>
                              <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" value="<?= $user['email'] ?>" placeholder="Email" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputPassword3" class="col-sm-2 col-form-label">Password Baru</label>
                              <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" placeholder="Password Baru" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="role" class="col-sm-2 col-form-label">Role Pengguna</label>
                              <div class="col-sm-10">
                                <select class="form-control select2" style="width: 100%;" name="role" required>
                                  <option value="" disabled>-- Pilih --</option>
                                  <?php foreach ($roles as $role) : ?>
                                    <option value="<?= $role['id_role'] ?>" <?= $user['id_user_role'] == $role['nama_role'] ? 'selected' : '' ?>><?= $role['nama_role'] ?></option>
                                  <?php endforeach ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="role" class="col-sm-2 col-form-label">Status Aktif</label>
                              <div class="col-sm-10">
                                <select class="form-control select2" style="width: 100%;" name="status" required>
                                  <?php foreach ($is_active as $key => $value) : ?>
                                    <option value="<?= $key ?>" <?= $user['is_active'] == $value ? "selected" : "" ?>><?= $value ?></option>
                                  <?php endforeach ?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn bg-olive"><i class="fas fa-save"></i> Simpan</button>
                            <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Kembali</a>
                          </div>
                        </form>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->

                  <?php endforeach ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- Modal Tambah -->
        <div class="modal fade" id="modal-tambah">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <form class="form-horizontal" action="<?= base_url('pengguna/create'); ?>" method="POST">
                <div class="modal-header">
                  <h4 class="modal-title">Tambah Data Pengguna</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <?= csrf_field(); ?>
                  <div class="form-group row">
                    <label for="nama-lengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama-lengkap" placeholder="Nama Lengkap" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="role" class="col-sm-2 col-form-label">Role Pengguna</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" style="width: 100%;" name="role" required>
                        <option value="" selected disabled>-- Pilih --</option>
                        <?php foreach ($roles as $role) : ?>
                          <option value="<?= $role['id_role'] ?>"><?= $role['nama_role'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="role" class="col-sm-2 col-form-label">Status Aktif</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" style="width: 100%;" name="status" required>
                        <option value="y" selected>Aktif</option>
                        <option value="n">Tidak Aktif</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn bg-olive"><i class="fas fa-save"></i> Tambah</button>
                  <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Kembali</a>
                </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
<?= $this->include('templates/script') ?>
<?= $this->endSection('content') ?>