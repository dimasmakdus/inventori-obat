<?php

namespace App\Models;

use CodeIgniter\Model;

class ObatModel extends Model
{
    protected $table      = 'tbl_obat';
    protected $useTimestamps = true;
    protected $primaryKey = 'kode_obat';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'kode_obat',
        'nama_obat',
        'stok',
        'satuan',
        'tgl_kadaluarsa',
        'created_at',
        'updated_at'
    ];
}
