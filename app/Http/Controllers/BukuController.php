<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    public function index() {
        // Ambil data buku dan urutkan berdasarkan id secara descending dengan pagination
        $data_buku = Buku::orderByDesc('id')->paginate(10); // 10 adalah jumlah data per halaman
    
        // Hitung jumlah buku
        $jumlah_buku = Buku::count();
    
        // Hitung total harga semua buku
        $total_harga = Buku::sum('harga');
    
        // Kirim data ke view
        return view('buku.index', compact('data_buku', 'jumlah_buku', 'total_harga'));
    }
    
    

    // mengarahkan ke view create
    public function create(){
        return view('buku.create');
    }

    // mengarahkan ke view store
    public function store(Request $request){
        $this->validate($request, [
            'judul'=> 'required',
            'penulis'=> 'required',
            'harga'=> 'required',
            'tgl_terbit'=> 'required',  
        ]);
        
        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->save();
    
        return redirect(to: '/buku')->with('pesan','Data buku berhasil ditambah');
    }
    
    
    // mengarahkan ke view destroy
    public function destroy($id){
        $buku = Buku::find($id);
        $buku->delete();
    
        return redirect(to: '/buku')->with('pesan','Data buku berhasil dihapus');
    }

    public function edit($id){
        $buku = Buku::find($id);
        return view('buku.edit', compact('buku'));
    }

    // mengarahkan ke view update, pas diedit lalu simpan
    public function update(Request $request, $id){
        // Validasi input
        $this->validate($request, [
            'judul' => 'required',
            'penulis' => 'required|max:30',
            'harga' => 'required',
            'tgl_terbit' => 'required',  
        ]);
        
        // Cari data buku berdasarkan ID
        $buku = Buku::findOrFail($id);
    
        // Update data buku
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        
        // Simpan perubahan
        $buku->save();
        
        // Redirect kembali ke halaman buku dengan pesan sukses
        return redirect('/buku')->with('pesan', 'Data buku berhasil diedit');
    }

    public function search(Request $request)
    {
        $batas = 5;
        $cari = $request->kata;
        $data_buku = Buku::where('judul', 'like', "%" . $cari . "%")
            ->orwhere('penulis', 'like', "%" . $cari . "%")
            ->paginate($batas);
        $jumlah_buku = $data_buku->count();
        $no = $batas * ($data_buku->currentPage() - 1);

        return view('buku.search', compact('data_buku', 'no' ,'jumlah_buku', 'cari'));
    }
    
}
