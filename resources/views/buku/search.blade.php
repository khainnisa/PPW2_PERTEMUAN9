@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
    @if(count($data_buku))
        <div class="alert alert-success">
            Ditemukan <strong>{{ count($data_buku) }}</strong> data dengan judul: <strong>{{ $cari }}</strong>
        </div>

        @if (Session::has('pesan'))
            <div class="alert alert-success">
                {{ Session::get('pesan') }}
            </div>
        @endif

        <h1 class="mb-4">Daftar Buku</h1>

        {{-- search box --}}
        <form action="{{ route('buku.search') }}" method="get">
            @csrf
            <div class="input-group">
                <input type="text" name="kata" class="form-control" placeholder="Cari ..." style="width: 30%; display: inline; margin-top: 10px; margin-bottom: 10px; float: right;">
                <button class="btn btn-outline-secondary" type="submit" id="button-search" style="width: 5%; display: inline; margin-top: 10px; margin-bottom: 10px; float: right;">Cari</button>
            </div>
        </form>

        <a href="{{ route('create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus"></i>Tambah Buku</a>

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
                    <td style="display: flex; gap: 10px;">
                        <a href="{{ route('edit', $buku->id) }}" class="btn btn-warning">Edit</a>

                        <form action="{{ route('destroy', $buku->id) }}" method="post" style="display:inline-block;">
                            @csrf
                            @method('delete')
                            <button onclick="return confirm('Yakin mau dihapus?')" type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $data_buku->links('pagination::bootstrap-5') }}
        </div>

        <a href="/buku" class="btn btn-secondary mt-3">Kembali</a>

        {{-- <p>Jumlah Buku: {{ $jumlah_buku }}</p>
        <p>Total Harga Semua Buku: Rp {{ number_format($total_harga, 2, ',', '.') }}</p> --}}
    @else
        <div class="alert alert-warning">
            <h4>Data {{ $cari }} tidak ditemukan</h4>
            <a href="/buku" class="btn btn-warning">Kembali</a>
        </div>
    @endif
@endsection
