@extends('layouts.layoutadmin')

@section('title', 'Dashboard')

@section('content')
<div class="pagetitle">
<h1>Data Mobil</h1>
      <nav>
      </nav>
    </div>
    
      <!-- 

      div
        div for add
        div for filter
          div detail
       -->
       <form action="/date-range-filter" method="get">
       

        
           <br>
           <div class="row">
           <div class="col-md-3">
            <label for="">Cari Berdasarkan</label>
            <select name="category_date_select" id="category_date" onchange="category()" class="form-select">
              <option value="rent_date">Mobil Pinjam</option>
              <option value="return_date">Mobil Kembali</option>
              <option value="created_at">Waktu Peminjaman</option>
              <option value="return_user_date">Mobil Kembali dan Pengguna</option>
            </select>
           </div>
             <div class="col-md-3 user none">
               <label for="from-date">Nama Pengguna</label>
               <select name="return_user_date" id="user-date" class="form-select">
                  @foreach ($users as $u)
                  <option value="{{ $u->id }}">{{ ucfirst($u->username) }}</option>
                  @endforeach
                    
               </select>
             </div>
             <div class="col-md-3">
               <label for="from-date">Mulai Tanggal</label>
               <input type="date" name="from" id="from-date" class="from-date form-control">
             </div>
             <div class="col-md-3">
               <label for="to-date">Akhir Tanggal</label>
               <input type="date" name="to" id="to-date" class="to-date form-control">
             </div>
             <div class="col-md-3" style="margin-top: 24px;">
               <button type="submit" class="btn btn-primary">Saring</button>
             </div>

           </div>
           
        
      </form>
        
     
    

<div class="mt-5">
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
</div>
<p id="coba"></p>
<div class="content">

  <table class="table table-bordered mt-3">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Mobil Pinjam</th>
        <th scope="col">Mobil Kembali</th>
        <th scope="col">Waktu Peminjaman</th>
        <th scope="col">Pengguna</th>
        <th scope="col">KTP</th>
        <th scope="col">SIM</th>
        <th scope="col">Mobil</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody class="table-group-divider">
      @foreach ($datarental as $item)
      <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{ date('l d-M-Y',strtotime($item->rent_date)) }}</td>
          @if ($item->return_date == null)
            <td>-</td>
          @else
          <td>{{date('l d-M-Y',strtotime($item->return_date))}}</td>

          @endif
          <td>{{date('l d-M-Y H:i:s',strtotime($item->created_at))}}</td>
          <td>{{$item->user->username}}</td>
          <td><img src="{{ asset('storage/'.$item->KTP)}}" alt="" width="120px" height="60px"></td>
          <td><img src="{{ asset('storage/'.$item->SIM) }}" alt="" width="120px" height="60px"></td>
          <td>{{$item->mobil->nama_mobil}}</td>
          <td>
              <a href="rent-edit/{{ Crypt::encrypt($item->slug)}}"><i class='bi bi-pencil'></i></a>|
              <a href="rent-delete/{{$item->slug}}"><i class='bi bi-trash'></i></a>
          </td>
  </tr>
  @endforeach
    </tbody>
  </table>
</div>
<script>
  var fromDate = document.getElementById("from-date");
  var toDate = document.getElementById("to-date");
  var cob = document.getElementById("coba");
  function category()
  {
    var categoryDate = document.getElementById("category_date").value; 
    var userDisplay = document.getElementsByClassName("user")[0];
    if(categoryDate == "created_at"){
      fromDate.type = "datetime-local";
      toDate.type = "datetime-local";
      userDisplay.classList.add("none");
    }
    else if(categoryDate == 'return_user_date'){
      fromDate.type = "date";
      toDate.type = "date";
      userDisplay.classList.remove("none");
    }
    else{
      fromDate.type = "date";
      toDate.type = "date";
      userDisplay.classList.add("none");
    }
  }
</script>
@endsection