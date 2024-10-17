@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
    <h4>Tambah Buku</h4>
    
    @if (count($errors) > 0)
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="post" action="{{ route('store') }}">
        @csrf
        <div>Judul <input type="text" name="judul" class="form-control"></div>
        <div>Penulis <input type="text" name="penulis" class="form-control"></div>
        <div>Harga <input type="text" name="harga" class="form-control"></div>
        <div>Tanggal Terbit 
            <input type="text" id="tgl_terbit" name="tgl_terbit" class="date form-control" placeholder="yyyy/mm/dd">
        </div> 
        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        <a href="/buku" class="btn btn-secondary mt-3">Kembali</a>
    </form>

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
