@extends('layouts.layoutadmin')

@section('title', 'Add Admin')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

<div class="pagetitle">
<h1>Tambah Admin</h1>
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

        <form action="users-add" method="post">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="Username" class="form-control" placeholder="Isi Username" >
            </div>
            <div class="mb-3">
                <label class="form-label" for="password" >Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Isi Password"/>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="Isi No Telepon">
            </div>
            <div class="mb-3">
                <label class="form-label" for="address" >Address</label>
                <textarea type="text" id="address" name="address" class="form-control" placeholder="Isi Alamat Admin" ></textarea>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select name="roles" id="role" class="from-control" >
                    @foreach ($roles as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
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
});</script>
@endsection