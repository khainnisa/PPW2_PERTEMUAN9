<?php

namespace App\Http\Controllers\Api;

// import Model "Buku"
use App\Models\Buku;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// import Resource "BookResource"
use App\Http\Resources\BookResource;

class BookApiController extends Controller
{
    public function index() {
        $books = Buku::latest()->paginate(5);

        return new BookResource(true, 'List Data Buku', $books);
    }

    public function store(Request $request)
    {
    $validatedData = $request->validate([
        'judul' => 'required|string|max:255',
        'penulis' => 'required|string|max:255',
        'harga' => 'required|integer',
        'tgl_terbit' => 'required|date',
    ]);

    $book = Buku::create($validatedData);

    return new BookResource(true, 'Data Buku Berhasil Ditambahkan', $book);
    }

}
