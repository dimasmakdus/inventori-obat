<?php

namespace App\Models;

use CodeIgniter\Model;

class ResepModel extends Model
{
    protected $table      = 'tbl_resep';
    protected $primaryKey = 'id_transaksi';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'id_transaksi',
        'kode_resep',
        'status_pasien',
        'nama_pasien',
        'umur',
        'alamat',
        'tanggal',
        'nama_dokter',
        'total'
    ];
}
