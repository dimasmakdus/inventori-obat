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
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
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
                        <h3 class="card-title">Kelola Data Pasien</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- form start -->
                        <form class="form-horizontal" action="<?= base_url('pasien/update'); ?>" method="POST">
                            <?= csrf_field(); ?>
                            <div class="form-group row">
                                <label for="no-rekamedis" class="col-sm-2 col-form-label">No Rekamedis</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" value="<?= $getPasien['no_rekamedis'] ?>" placeholder=" No Rekamedis" disabled>
                                    <input type="hidden" name="no-rekamedis" value="<?= $getPasien['no_rekamedis'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no-ktp" class="col-sm-2 col-form-label">No KTP *</label>
                                <div class="col-sm-10">
                                    <input type="nummber" class="form-control" name="no-ktp" id="no-ktp" value="<?= $getPasien['no_ktp'] ?>" placeholder="No KTP">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no-bpjs" class="col-sm-2 col-form-label">No BPJS</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="no-bpjs" id="no-bpjs" value="<?= $getPasien['no_bpjs'] ?>" placeholder="No BPJS">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama-pasien" class="col-sm-2 col-form-label">Nama Pasien *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama-pasien" id="nama-pasien" value="<?= $getPasien['nama_pasien'] ?>" placeholder="Nama Pasien">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status-pasien" class="col-sm-2 col-form-label">Status Pasien *</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" style="width: 100%;" name="status-pasien" id="status-pasien">
                                        <?php foreach ($statusPasien as $status) : ?>
                                            <option <?= $status == $getPasien['status_pasien'] ? 'selected' : '' ?>><?= $status ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jenis-kelamin" class="col-sm-2 col-form-label">Jenis Kelamin *</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" style="width: 100%;" name="jenis-kelamin" id="jenis-kelamin">
                                        <?php foreach ($jenisKelamin as $key => $value) : ?>
                                            <option value="<?= $key ?>" <?= $key == $getPasien['jenis_kelamin'] ? 'selected' : '' ?>><?= $value ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tempat-lahir" class="col-sm-2 col-form-label">Tempat Lahir *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="tempat-lahir" id="tempat-lahir" value="<?= $getPasien['tempat_lahir'] ?>" placeholder="Tempat Lahir">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tgl-lahir" class="col-sm-2 col-form-label">Tanggal Lahir *</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tgl-lahir" id="tgl-lahir" value="<?= date("Y-m-d", strtotime($getPasien['tanggal_lahir'])); ?>" placeholder="Tanggal Lahir">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat *</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" row="3" name="alamat" id="alamat" placeholder="Alamat"><?= $getPasien['alamat'] ?></textarea>
                                </div>
                            </div>

                    </div>
                    <div class="card-footer justify-content-between">
                        <button type="submit" class="btn bg-olive"><i class="fas fa-save"></i> Simpan Data</button>
                        <a href="<?= base_url('pasien') ?>" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Kembali</a>
                    </div>
                    </form>

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