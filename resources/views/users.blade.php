@extends('layouts.layoutadmin')

@section('title', 'Home')

@section('content')

<div class="pagetitle">
      <h1>Data User</h1>
      <nav>
      </nav>
    </div>

    <div class="mt-3 d-flex justify-content-end">
        <a href="users-add" class="btn btn-primary">Tambah Admin</a>
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
      <th scope="col">Username</th>
      <th scope="col">Phone</th>
      <th scope="col">Address</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
    @foreach ($users as $item)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$item->username}}</td>
        <td>{{$item->phone}}</td>
        <td>{{$item->address}}</td>
        <td>
            <a href="users-edit/{{$item->slug}}"><i class='bi bi-pencil'></i></a>|
            <a href="users-delete/{{$item->slug}}"><i class='bi bi-trash'></i></a>
        </td>
</tr>
@endforeach
  </tbody>
</table>
@endsection