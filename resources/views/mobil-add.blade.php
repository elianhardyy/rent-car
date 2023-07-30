@extends('layouts.layoutadmin')

@section('title', 'Add Katalog')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<style>
    .error{
        color: red;
    }
    
</style>
<div class="pagetitle">
<h1>Tambah Data Mobil</h1>
      <nav>
      </nav>
    </div>

    <div class="mt-5">
<!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif -->

        <form action="mobil-add" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nopol" class="form-label">Nopol</label>
                <input type="text" name="nopol" id="nopol" class="form-control @error('nopol')
                    is-invalid
                @enderror" placeholder="Isi Nopol" value="{{ old('nopol') }}">
                @error('nopol')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nama Mobil</label>
                <input type="text" name="nama_mobil" id="name" class="form-control @error('nama_mobil')
                    is-invalid
                @enderror" placeholder="Nama Mobil" value="{{ old('nama_mobil') }}">
                @error('nama_mobil')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">Gambar Mobil</label>
                <input type="file" name="images" id="img" class="form-control @error('images')
                    is-invalid @enderror" 
                    placeholder="Nama Mobil" 
                    value="{{ old('images') }}" 
                    onchange="previewImage()">
                   
                <img class="img-preview img-fluid mb-3 col-sm-7">
                @error('images')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga Sewa</label>
                <input type="number" name="harga" id="harga" class="form-control @error('harga')
                    is-invalid
                @enderror" placeholder="Harga Sewa" value="{{ old('harga') }}">
                @error('harga')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select name="categories[]" id="category" class="from-select select-multiple @error('categories')
                    is-invalid
                @enderror" multiple>
                    @foreach ($categories as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
                @error('categories')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

<div>
    <button class="btn btn-success mt-3" type="submit">Simpan</button>
</div>
</form>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js "></script>
<script>
$(document).ready(function() {
    $('.select-multiple').select2();
});
function previewImage()
{
    const img = document.querySelector("#img");
      const imgPreview = document.querySelector(".img-preview")

      imgPreview.style.display = 'block';
    //   imgPreview.style.marginTop = '5px';
    //   imgPreview.style.width = '100px';
    //   imgPreview.style.height = '60px';
      const reader = new FileReader();
      reader.readAsDataURL(img.files[0]);
      reader.onload = function(event) {

         imgPreview.src = event.target.result;
      }
}
</script>
@endsection