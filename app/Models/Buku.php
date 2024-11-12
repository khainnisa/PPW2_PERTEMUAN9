<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Gallery;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'books';

    // Jika Anda ingin menentukan kolom yang bisa diisi (fillable)
    protected $fillable = ['id', 'judul', 'penulis', 'harga', 'tgl_terbit', 'created_at', 'updated_at', 'filename', 'filepath'];
   // Relasi Buku memiliki banyak Galeri
   
    // Tambahkan properti $dates untuk kolom tgl_terbit
    protected $dates = ['tgl_terbit'];

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'books_id'); // pastikan field foreign key benar
    }
    
}
