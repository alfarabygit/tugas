<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = "mahasiswa";
    protected $primaryKey = "id_mahasiswa";
    protected $returnType = "object";
    protected $useTimestamps = true;
    protected $allowedFields = ['id_mahasiswa', 'nim', 'nama', 'jenis_kelamin', 'no_telp', 'email', 'alamat'];
}
