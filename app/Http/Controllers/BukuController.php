<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Gallery;
use Intervention\Image\Facades\Image;

class BukuController extends Controller
{
    public function index() {
        $data_buku = Buku::orderByDesc('id')->paginate(10);
        $jumlah_buku = Buku::count();
        $total_harga = Buku::sum('harga');

        return view('buku.index', compact('data_buku', 'jumlah_buku', 'total_harga'));
    }

    public function create(){
        return view('buku.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'judul'=> 'required',
            'penulis'=> 'required',
            'harga'=> 'required',
            'tgl_terbit'=> 'required',
            'thumbnail' => 'image|mimes:jpeg,jpg,png|max:2048',
            'gallery.*' => 'image|mimes:jpeg,jpg,png|max:2048'  // Validate multiple gallery images
        ]);

        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;

        if ($request->hasFile('thumbnail')) {
            $thumbnailFile = $request->file('thumbnail');
            $thumbnailName = time() . ' ' . $thumbnailFile->getClientOriginalName();
            $thumbnailPath = $thumbnailFile->storeAs('uploads', $thumbnailName, 'public');

            Image::make(storage_path('app/public/uploads/' . $thumbnailName))
                ->fit(240, 320)
                ->save();

            $buku->filename = $thumbnailName;
            $buku->filepath = '/storage/' . $thumbnailPath;
        }

        $buku->save();

        $id = $buku->id;  // Get the ID of the newly created book

        
        if ($request->file('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');

                Gallery::create([
                    'nama_galeri' => $fileName,
                    'path' => '/storage/' . $filePath,
                    'foto' => $fileName,
                    'books_id' => $id  // Associate the gallery image with the book ID
                ]);
            }
        }

        return redirect('/buku')->with('pesan', 'Data buku berhasil ditambah');
    }

    public function destroy($id){
        $buku = Buku::find($id);
        $buku->delete();

        return redirect('/buku')->with('pesan', 'Data buku berhasil dihapus');
    }

    public function edit($id){
        $buku = Buku::find($id);
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'judul' => 'required',
            'penulis' => 'required|max:30',
            'harga' => 'required',
            'tgl_terbit' => 'required',
            'thumbnail' => 'image|mimes:jpeg,jpg,png|max:2048',
            'gallery.*' => 'image|mimes:jpeg,jpg,png|max:2048'
        ]);

        $buku = Buku::findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            $fileName = time() . '_' . $request->thumbnail->getClientOriginalName();
            $filePath = $request->file('thumbnail')->storeAs('uploads', $fileName, 'public');

            $buku->filename = $fileName;
            $buku->filepath = '/storage/' . $filePath;

            Image::make(storage_path('app/public/uploads/' . $fileName))
                ->fit(240, 320)
                ->save();
        }

        if ($request->file('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');

                Gallery::create([
                    'nama_galeri' => $fileName,
                    'path' => '/storage/' . $filePath,
                    'foto' => $fileName,
                    'books_id' => $id
                ]);
            }
        }

        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->save();

        return redirect('/buku')->with('pesan', 'Data buku berhasil diedit');
    }

    public function search(Request $request) {
        $batas = 5;
        $cari = $request->kata;
        $data_buku = Buku::where('judul', 'like', "%" . $cari . "%")
            ->orWhere('penulis', 'like', "%" . $cari . "%")
            ->paginate($batas);
        $jumlah_buku = $data_buku->count();
        $no = $batas * ($data_buku->currentPage() - 1);

        return view('buku.search', compact('data_buku', 'no', 'jumlah_buku', 'cari'));
    }

    public function __construct(){
        $this->middleware('auth');
    }
}
