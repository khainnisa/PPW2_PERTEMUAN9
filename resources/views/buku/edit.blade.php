@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<div class="container">

    @if (count($errors) > 0)
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            </li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <h2>Edit Item</h2>

    <form action="{{ route('update', $buku->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Input Judul -->
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" name="judul" class="form-control" id="judul" value="{{ old('judul', $buku->judul) }}">
        </div>

        <!-- Input Penulis -->
        <div class="form-group">
            <label for="penulis">Penulis</label>
            <input type="text" name="penulis" class="form-control" id="penulis" value="{{ old('penulis', $buku->penulis) }}" >
        </div>

        <!-- Input Harga -->
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="text" name="harga" class="form-control" id="harga" value="{{ old('harga', $buku->harga) }}" >
        </div>

        <!-- Input Tanggal Terbit -->
        <div class="form-group">
            <label for="tgl_terbit">Tanggal Terbit</label>
            <input type="text" id="tgl_terbit" name="tgl_terbit" class="date form-control" placeholder="yyyy/mm/dd" value="{{ old('tgl_terbit', $buku->tgl_terbit) }}" >
        </div>

        <!-- Tombol Simpan -->
        <button type="submit" class="btn btn-primary mt-3">Simpan</button>

        <!-- Tombol Kembali -->
        <a href="/buku" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>

<!-- Include jQuery and Bootstrap Datepicker Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/3/7dM9ePjA3Fv8U5TkHlxWJttz8P0Z5STZ1qF" crossorigin="anonymous"></script>
<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.date').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true
        });
    });
</script>
@endsection
