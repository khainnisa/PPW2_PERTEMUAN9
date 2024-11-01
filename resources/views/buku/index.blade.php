@extends('auth.layouts')

@section('content')
<div class="container mt-3">
    <!-- Pesan Sukses -->
    @if (Session::has('pesan'))
        <div class="alert alert-success">
            {{ Session::get('pesan') }}
        </div>
    @endif

    {{-- tombol tambah --}}
    <h1 class="mb-4">Daftar Buku</h1>

    <a href="{{ route('create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus"></i>Tambah Buku</a>

    {{-- search box --}}
    <form action="{{ route('buku.search') }}" method="get">
        @csrf
        <div class="input-group">
            <input type="text" name="kata" class="form-control" placeholder="Cari ..." style="width: 30%; display: inline; margin-top: 10px; margin-bottom: 10px; float: right;">
            <button class="btn btn-outline-secondary" type="submit" id="button-search" style="width: 5%; display: inline; margin-top: 10px; margin-bottom: 10px; float: right;">Cari</button>
        </div>
    </form>
    
    <!-- Tabel Data Buku -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tanggal Terbit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data_buku as $buku)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->penulis }}</td>
                <td>{{ "Rp. ".number_format($buku->harga, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}</td>
                @if(Auth::check() && Auth::user()->level == 'admin')
                <td class="d-flex gap-2">
                    <!-- Tombol edit -->
                    <a href="{{ route('edit', $buku->id) }}" class="btn btn-warning">Edit</a>
                
                    <!-- Tombol hapus -->
                    <form action="{{ route('destroy', $buku->id) }}" method="post" style="display:inline-block;">
                        @csrf
                        @method('delete')
                        <button onclick="return confirm('Yakin mau dihapus?')" type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                    
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $data_buku->links('pagination::bootstrap-5') }}
    </div>

    <!-- Jumlah buku di luar tabel -->
    <p>Jumlah Buku: {{ $jumlah_buku }}</p>

    <!-- Total harga semua buku di luar tabel -->
    <p>Total Harga Semua Buku: Rp {{ number_format($total_harga, 2, ',', '.') }}</p>
</div>
@endsection