<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'books';

    // Tambahkan properti $dates untuk kolom tgl_terbit
    protected $dates = ['tgl_terbit'];

    // Jika Anda ingin menentukan kolom yang bisa diisi (fillable)
    protected $fillable = ['judul', 'penulis', 'harga', 'tgl_terbit'];
}
