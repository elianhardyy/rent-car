@extends('layouts.layoutadmin')

@section('title', 'Home')

@section('content')

<div class="pagetitle">
<h1>Data Kategori Mobil</h1>
      <nav>
      </nav>
    </div>

    <div class="mt-3 d-flex justify-content-end">
        <a href="category-add" class="btn btn-primary">Tambah Data Kategori</a>
</div>

<div class="mt-5">
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
</div>

<table class="table mt-3">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
    @foreach ($categories as $item)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$item->name}}</td>
        <td>
            <a href="category-edit/{{$item->slug}}" ><i class='bi bi-pencil'></i></a>|
            <a href="category-delete/{{$item->slug}}"><i class='bi bi-trash'></i></a>
        </td>
</tr>
@endforeach
  </tbody>
</table>

@endsection