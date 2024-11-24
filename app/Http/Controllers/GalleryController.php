<?php

namespace App\Http\Controllers;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('buku.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('buku.edit', compact('gallery'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // Temukan data galeri berdasarkan ID
    $gallery = Gallery::findOrFail($id);

    // Hapus file dari direktori penyimpanan
    if (Storage::exists('public/storage/uploads/' . $gallery->path)) {
        Storage::delete('public/storage/uploads/' . $gallery->path);
    }

    // Hapus data galeri dari database
    $gallery->delete();

    // Mengembalikan response JSON
    return response()->json(['success' => true]);
}

}
