<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    private $jenis_kelamin = [
        "0" => "Laki-Laki",
        "1" => "Perempuan"
    ];

    public function index()
    {
        $obatobatan = [
            'count' => $this->obatModel->countAll(),
            'title' => 'Data Obat'
        ];
        $pasien = [
            'count' => $this->pasienModel->countAll(),
            'title' => 'Data Pasian'
        ];
        $supplier = [
            'count' => $this->supplierModel->countAll(),
            'title' => 'Data Supplier'
        ];
        $pengguna = [
            'count' => $this->userModel->countAll(),
            'title' => 'Stok Obat Telah Habis !'
        ];

        return view('dashboard/index', [
            'title' => 'Dashboard',
            'navLink' => 'dashboard',
            'obat' => $obatobatan,
            'pasien' => $pasien,
            'supplier' => $supplier,
            'pengguna' => $pengguna,
            'accessRight' => $this->accessRights
        ]);
    }

    public function kelola_user()
    {
        $users = $this->userModel->orderBy('updated_at', 'DESC')->findAll();
        $dataUser = [];
        foreach ($users as $user) {
            $id_role = $user['id_user_role'];
            $roleById = $this->roleModel->find($id_role);
            if ($user['is_active'] == 'y') {
                $is_active = "Aktif";
            } else {
                $is_active = "Tidak Aktif";
            }

            $data = [
                'id_user' => $user['id_user'],
                'full_name' => $user['full_name'],
                'email' => $user['email'],
                'password' => $user['password'],
                'id_user_role' => $roleById['nama_role'],
                'is_active' => $is_active
            ];
            array_push($dataUser, $data);
        }

        $is_active = [
            'y' => 'Aktif',
            'n' => 'Tidak Aktif'
        ];

        return view('user/user_list', [
            'title' => 'Kelola Pengguna',
            'card_title' => 'Kelola Data Pengguna',
            'navLink' => 'pengguna',
            'accessRight' => $this->accessRights,
            'roles' => $this->roleModel->findAll(),
            'dataUser' => $dataUser,
            'is_active' => $is_active,
        ]);
    }

    public function roleUser()
    {
        $roles = $this->roleModel->orderBy('updated_at', 'DESC')->findAll();

        return view('role/role_user', [
            'title' => 'Role Pengguna',
            'card_title' => 'Kelola Role Pengguna',
            'navLink' => 'role-pengguna',
            'accessRight' => $this->accessRights,
            'roles' => $roles
        ]);
    }

    public function viewAkses($id)
    {
        $menu_akses = $this->aksesModel->orderBy('no_order', 'ASC')->findAll();
        $hakAkses = $this->hakAksesModel->findAll();
        foreach ($hakAkses as $hak) {
            if ($id == $hak['id_role']) {
                $currentAkses[] = $hak['id_menu'];
            }
        }

        return view('role/role_akses', [
            'title' => 'Daftar Hak Akses',
            'card_title' => 'Kelola Role Pengguna',
            'navLink' => 'role-pengguna',
            'accessRight' => $this->accessRights,
            'menu_akses' => $menu_akses,
            'currentAkses' => isset($currentAkses) ? $currentAkses : ''
        ]);
    }

    public function roleForm()
    {
        return view('role/role_form', [
            'title' => 'Tambah Hak Akses',
            'card_title' => 'Tambah Hak Akses',
            'navLink' => 'role-pengguna',
            'accessRight' => $this->accessRights,
        ]);
    }

    public function resep_pasien()
    {
        $data_dokter = $this->dokterModel->orderBy('nama_dokter', 'ASC')->findAll();
        $data_pasien = $this->pasienModel->orderBy('no_resep', 'ASC')->findAll();

        foreach ($data_pasien as $pasien) {
            $no_resep = $pasien['no_resep'];
        }
        $noUrut = (int) substr($no_resep, 0, 6);
        $noUrut++;
        $kodeBaru = sprintf("%06s", $noUrut);

        $status = [
            "0" => "BPJS",
            "1" => "UMUM"
        ];

        return view('dashboard/pasien', [
            'title' => 'Data Resep Pasien',
            'card_title' => 'Data Resep Pasien',
            'navLink' => 'resep-pasien',
            'accessRight' => $this->accessRights,
            'jenis_kelamin' => $this->jenis_kelamin,
            'status_pasien' => $status,
            'db_dokter' => $data_dokter,
            'data_pasien' => $data_pasien,
            'kode_baru' => $kodeBaru
        ]);
    }

    public function supplier()
    {
        $supplier = $this->supplierModel->orderBy('updated_at', 'DESC')->findAll();

        return view('dashboard/supplier', [
            'title' => 'Data Supplier',
            'card_title' => 'Kelola Data Supplier',
            'navLink' => 'supplier',
            'accessRight' => $this->accessRights,
            'data_supplier' => $supplier
        ]);
    }

    public function stok_obat()
    {
        $stok_obat = $this->stokObatModel->orderBy('updated_at', 'DESC')->findAll();

        return view('dashboard/stok_obat', [
            'title' => 'Stok Obat',
            'card_title' => 'Kelola Data Stok Obat',
            'navLink' => 'stok-obat',
            'accessRight' => $this->accessRights,
            'stok_obat' => $stok_obat
        ]);
    }

    public function obat_obatan()
    {
        $no_obat_akhir = $this->obatModel->orderBy('kode_obat', 'ASC')->findAll();
        foreach ($no_obat_akhir as $obat) {
            $kode_obat = $obat['kode_obat'];
        }

        $noUrut = (int) substr(preg_replace("/[^0-9]/", "", $kode_obat), 0, 6);
        $noUrut++;
        $kodeBaru = sprintf("%04s", $noUrut);

        $satuan_obat = [
            '0' => 'Tablet',
            '1' => 'Botol',
            '2' => 'Ampul',
            '3' => 'Strip',
            '4' => 'Sachet',
            '5' => 'Kapsul'
        ];

        return view('dashboard/obat_obatan', [
            'title' => 'Data Obat',
            'card_title' => 'Kelola Data Obat-Obatan',
            'navLink' => 'obat-obatan',
            'accessRight' => $this->accessRights,
            'obat_obatan' => $this->obatModel->orderBy('kode_obat', 'ASC')->findAll(),
            'satuan' => $satuan_obat,
            'kode_obat_baru' => $kodeBaru
        ]);
    }

    public function data_dokter()
    {
        $data_dokter = $this->dokterModel->orderBy('updated_at', 'DESC')->findAll();

        $poli = [
            "1" => "POLI GIGI",
            "2" => "POLI UMUM",
            "3" => "POLI KIA"
        ];

        return view('dashboard/dokter', [
            'title' => 'Data Dokter',
            'card_title' => 'Data Dokter',
            'navLink' => 'data-dokter',
            'accessRight' => $this->accessRights,
            'data_dokter' => $data_dokter,
            'jenis_kelamin' => $this->jenis_kelamin,
            'poli' => $poli
        ]);
    }

    public function aturan_obat()
    {
        $aturan_obat = $this->aturanModel->orderBy('updated_at', 'DESC')->findAll();
        $aturan_usia = [
            '0' => 'Bayi',
            '1' => 'Anak-Anak',
            '2' => 'Dewasa',
        ];

        return view('dashboard/aturan_obat', [
            'title' => 'Data Aturan Obat',
            'card_title' => 'Data Aturan Pemakaian Obat',
            'navLink' => 'aturan-obat',
            'accessRight' => $this->accessRights,
            'aturan_usia' => $aturan_usia,
            'aturan_obat' => $aturan_obat
        ]);
    }

    public function pengambilan_obat()
    {
        return view('dashboard/pengambilan_obat', [
            'title' => 'Pengambilan Obat',
            'card_title' => 'Pengambilan Obat',
            'navLink' => 'pengambilan-obat',
            'accessRight' => $this->accessRights,
            'resep_pasien' => $this->pasienModel->orderBy('no_resep', 'ASC')->findAll(),
            'obat_obatan' => $this->obatModel->orderBy('kode_obat', 'ASC')->findAll(),
            'aturan_obat' => $this->aturanModel->orderBy('dosis_aturan_obat', 'DESC')->findAll()
        ]);
    }

    public function resep_obat()
    {
        return view('dashboard/resep_obat', [
            'title' => 'Salinan Resep',
            'card_title' => 'Salinan Resep',
            'navLink' => 'resep-obat',
            'accessRight' => $this->accessRights,
            'resep_obat' => $this->resepModel->orderBy('tanggal', 'ASC')->findAll(),
            'detailObat' => $this->resepDetailModel->orderBy('id_transaksi', 'ASC')->findAll()
        ]);
    }

    public function pengeluaran_harian()
    {
        $pemakaian_obat = $this->pengeluaranModel->orderBy('updated_at', 'DESC')->findAll();

        return view('dashboard/pengeluaran_harian', [
            'title' => 'Data Pengeluaran Harian',
            'card_title' => 'Kelola Data Pengeluaran Harian',
            'navLink' => 'pengeluaran-harian',
            'accessRight' => $this->accessRights,
            'pemakaian_obat' => $pemakaian_obat
        ]);
    }

    public function laporan_barang_keluar()
    {
        $pemakaian_obat = $this->pengeluaranModel->orderBy('updated_at', 'DESC')->findAll();

        return view('dashboard/laporan_barang_keluar', [
            'title' => 'Surat Bukti Barang Keluar',
            'card_title' => 'Laporan Data Barang Keluar',
            'navLink' => 'laporan-barang-keluar',
            'accessRight' => $this->accessRights,
            'laporan_barang_keluar' => $pemakaian_obat
        ]);
    }

    public function pesanan_obat()
    {
        return view('dashboard/pesanan_obat', [
            'title' => 'Pengajuan Obat',
            'card_title' => 'Pengajuan Obat',
            'navLink' => 'pengajuan-obat',
            'accessRight' => $this->accessRights,
            'permintaan_obat' => $this->permintaanModel->orderBy('tanggal', 'DESC')->findAll(),
            'supplier' => $this->supplierModel->orderBy('nama_supplier', 'ASC')->findAll()
        ]);
    }
}
