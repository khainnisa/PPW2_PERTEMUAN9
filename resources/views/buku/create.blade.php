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

    <form method="post" action="{{ route('store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul">
        </div>
        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" class="form-control" id="penulis" name="penulis">
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" class="form-control" id="harga" name="harga">
        </div>
        <div class="mb-3">
            <label for="tgl_terbit" class="form-label">Tanggal Terbit</label>
            <input type="text" id="tgl_terbit" name="tgl_terbit" class="date form-control" placeholder="yyyy/mm/dd">
        </div>
        <div class="mb-3">
            <label for="thumbnail" class="block text-sm font-medium leading-6 text-gray-900">Thumbnail</label>
                <div class="mt-2">
                    <input type="file" name="thumbnail" class="form-control mb-2" id="thumbnail" onchange="previewThumbnail(event)">
                </div>
                <!-- Preview Thumbnail -->
                <div id="thumbnailPreviewContainer" class="mt-3">
                    <img id="thumbnailPreview" src="" alt="Thumbnail Preview" style="max-width: 150px; display: none;" />
                </div>

            <label for="gallery" class="form-label">Gallery</label>
            <div class="upload-container">
                <input id="fileInput" type="file" name="gallery[]" class="form-control mb-2" multiple>
                <div id="previewContainer" class="mt-3 mb-3 d-flex flex-wrap gap-2"></div>
                <button type="button" class="btn btn-secondary mt-2" id="addFileButton">Tambah Gambar</button>
            </div>
        </div>

        <button class="btn btn-primary" type="submit">Simpan</button>
        <a class="btn btn-outline-danger" href="{{ url('/buku') }}">Kembali</a>
    </form>

    <!-- Include jQuery and Bootstrap Datepicker Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/3/7dM9ePjA3Fv8U5TkHlxWJttz8P0Z5STZ1qF" crossorigin="anonymous"></script>
{{-- <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script> --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('.date').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true
        });
    });

    function addGalleryInput() {
            const galleryInputs = document.getElementById('gallery-inputs');
            const newInputDiv = document.createElement('div');
            newInputDiv.classList.add('file-input', 'mt-2');
            newInputDiv.innerHTML = '<input type="file" name="gallery[]" class="form-control">';
            galleryInputs.appendChild(newInputDiv);
        }
</script>
@endsection
