@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<div class="container">

    @if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <h2>Edit Item</h2>

    <form action="{{ route('update', $buku->id) }}" method="POST" enctype="multipart/form-data">
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
            <input type="text" name="penulis" class="form-control" id="penulis" value="{{ old('penulis', $buku->penulis) }}">
        </div>

        <!-- Input Harga -->
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="text" name="harga" class="form-control" id="harga" value="{{ old('harga', $buku->harga) }}">
        </div>

        <!-- Input Tanggal Terbit -->
        <div class="form-group">
            <label for="tgl_terbit">Tanggal Terbit</label>
            <input type="text" id="tgl_terbit" name="tgl_terbit" class="date form-control" placeholder="yyyy/mm/dd" value="{{ old('tgl_terbit', $buku->tgl_terbit) }}">
        </div>

        <!-- Input Thumbnail -->
        <div class="form-group">
        <!-- Jika ada file thumbnail, tampilkan gambar yang ada -->
        @if($buku->filename)
        <div class="mb-3">
            <label>Thumbnail saat ini:</label>
            <div class="gallery_item mb-2" id="current-thumbnail">
                <img src="{{ asset('storage/uploads/' . $buku->filename) }}" alt="Thumbnail Buku" class="rounded object-cover object-center" width="200">
            </div>
        </div>
        @endif

            <label for="thumbnail">Thumbnail Buku:</label>
            <input type="file" id="thumbnail" name="thumbnail" class="form-control">
        </div>

        <!-- Display Current Gallery Images -->
        <div>Current Gallery Images:</div>
        <div class="gallery_items mb-3">
            @foreach($buku->galleries as $gallery)
                <div class="gallery_item mb-2" id="gallery-{{ $gallery->id }}">
                    <img
                        class="rounded object-cover object-center"
                        src="{{ asset($gallery->path) }}"
                        alt="Gambar Galeri"
                        width="200"
                    />
                    <button
                        type="button"
                        class="btn btn-danger btn-sm mt-2 delete-gallery-button"
                        data-gallery-id="{{ $gallery->id }}"
                    >
                        Hapus
                    </button>
                </div>
            @endforeach
        </div>

        <!-- Input Gallery for Adding New Images -->
        <div>Tambah Gambar ke Gallery</div>
        <div id="gallery-inputs">
            <div class="file-input mb-3">
                <input type="file" name="gallery[]" class="form-control">
            </div>
        </div>
        
        <button type="button" class="btn btn-secondary mt-2" onclick="addGalleryInput()">Tambah Gambar</button>

        <!-- Tombol Simpan -->
        <button type="submit" class="btn btn-primary mt-3">Simpan</button>

        <!-- Tombol Kembali -->
        <a href="/buku" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>

<!-- Include jQuery and Bootstrap Datepicker Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" 
        integrity="sha384-H+K7U5CnXl1h5ywQd7iiabKP7kH9RVrF8E2eF3ibJkPzBI64WE0K8zUDL91v2g9a" 
        crossorigin="anonymous"></script>

<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        // Inisialisasi Datepicker
        $('.date').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true
        });

        // Fungsi Tambah Input Galeri
        window.addGalleryInput = function () {
            const galleryContainer = document.getElementById('gallery-inputs');
            const fileInputDiv = document.createElement('div');
            fileInputDiv.className = 'file-input mb-3';

            const input = document.createElement('input');
            input.type = 'file';
            input.name = 'gallery[]';
            input.className = 'form-control';

            fileInputDiv.appendChild(input);
            galleryContainer.appendChild(fileInputDiv);
        };

        // Fungsi Hapus Gambar Galeri
        const deleteButtons = document.querySelectorAll('.delete-gallery-button');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const galleryId = this.getAttribute('data-gallery-id');
                const confirmed = confirm('Apakah Anda yakin ingin menghapus gambar ini?');

                if (confirmed) {
                    // AJAX Request untuk menghapus galeri
                    fetch(`/gallery/${galleryId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Gambar berhasil dihapus');
                            document.getElementById(`gallery-${galleryId}`).remove();
                        } else {
                            alert(data.message || 'Gagal menghapus gambar');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menghapus gambar');
                    });
                }
            });
        });
    });
</script>
@endsection
