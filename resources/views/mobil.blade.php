@extends('layouts.layoutadmin')

@section('title', 'Katalog Mobil')

@section('content')
<div class="pagetitle">
<h1>Data Mobil</h1>
      <nav>
      </nav>
    </div>

    <div class="mt-3 d-flex justify-content-end">
        <a href="mobil-add" class="btn btn-primary">Tambah Data Mobil</a>
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
      <th scope="col">Nopol</th>
      <th scope="col">Nama Mobil</th>
      <th scope="col">Harga</th>
      <th scope="col">Status</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
    @foreach ($mobils as $item)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$item->nopol}}</td>
        <td>{{$item->nama_mobil}}</td>
        <td>{{$item->harga}}</td>
        <td>{{$item->status}}</td>
        <td>
            <a href="mobil-edit/{{$item->slug}}"><i class='bi bi-pencil'></i></a>|
            <a href="mobil-delete/{{$item->slug}}"><i class='bi bi-trash'></i></a>
        </td>
</tr>
@endforeach
  </tbody>
</table>
@endsection