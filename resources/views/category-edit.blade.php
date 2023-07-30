@extends('layouts.layoutadmin')

@section('title', 'Edit Category')

@section('content')

<div class="pagetitle">
<h1>Edit Kategori Mobil</h1>
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

        <form action="/category-edit/{{$category->slug}}" method="post">
            @csrf
            @method('put')
            <div>
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{$category->name}}" 
                placeholder="Nama Kategori">
</div>

<div>
    <button class="btn btn-success mt-3" type="submit">Update</button>
</div>
</form>
</div>

@endsection