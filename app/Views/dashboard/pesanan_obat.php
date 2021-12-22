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
                        <?php
                        if (session()->getFlashData('error')) {
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="icon fas fa-exclamation-triangle"></i>
                                <?= session()->getFlashData('error') ?>
                                </button>
                            </div>
                        <?php
                        }
                        ?>
                        <a href="<?= base_url('pesanan-obat-add') ?>" class="btn bg-olive mb-3"><i class="fas fa-plus"></i> Tambah Data</a>
                        <a target="_blank" href="<?= base_url('cetak-lpo') ?>" class="btn bg-primary mb-3"><i class="fas fa-print"></i> Cetak Laporan</a>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Obat</th>
                                    <th>Nama Obat</th>
                                    <th>Jenis Obat</th>
                                    <th>Jumlah</th>
                                    <th>Nama Supplier</th>
                                    <th>Email Supplier</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($pesanan_obat as $pesanan) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $pesanan['kode_obat'] ?></td>
                                        <td><?= $pesanan['nama_obat'] ?></td>
                                        <td><?= $pesanan['jenis_obat'] ?></td>
                                        <td><?= $pesanan['jumlah'] ?></td>
                                        <td><?= $pesanan['nama_supplier'] ?></td>
                                        <td><?= $pesanan['email_supplier'] ?></td>
                                        <td><span class="badge <?= $pesanan['status'] == 'Terkirim' ? 'bg-primary' : 'bg-danger' ?>"><?= $pesanan['status'] ?></span></td>
                                        <td>
                                            <a href="<?= base_url('kirim-ulang') ?>/<?= $pesanan['id_pesanan'] ?>" class="btn btn-sm bg-info"><i class="fas fa-envelope"></i> Kirim</a>
                                            <a class="btn btn-sm btn-danger btn-delete-pesanan" data-toggle="modal" data-target="#hapus-pesanan-<?= $pesanan['id_pesanan'] ?>"><i class="fas fa-trash-alt"></i> Hapus</a>
                                        </td>
                                    </tr>
                                    <!-- Modal Hapus  -->
                                    <div class="modal fade" id="hapus-pesanan-<?= $pesanan['id_pesanan'] ?>">
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
                                                    <a href="<?= base_url('pesanan-obat/delete') ?>/<?= $pesanan['id_pesanan'] ?>" class="btn btn-danger">Hapus</a>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
<?= $this->endSection('content') ?>