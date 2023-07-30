@extends('layouts.layoutadmin')

@section('title', 'Add Category')

@section('content')

<div class="pagetitle">
<h1>Tambah Kategori Mobil</h1>
      <nav>
      </nav>
    </div>

    <div class="mt-5">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <form action="category-add" method="post">
            @csrf
            <div>
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Nama Kategori">
</div>

<div>
    <button class="btn btn-success mt-3" type="submit">Simpan</button>
</div>
</form>
</div>

@endsection