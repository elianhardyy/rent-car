@extends('layouts.layoutadmin')
@section('title','Rental Edit')
<link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
  <link href="{{asset('assets/css/mdi.css')}}" rel="stylesheet">
@section('content')
<div class="main-content container-fluid">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
          <div class="row">
            <div class="col-lg-12">

            <!--Train Details-->
              <div id='printReceipt' class="invoice">
                <div class="row invoice-header">
                  <div class="col-sm-7">
                    <div class="invoice-logo"></div>
                  </div>
                  <div class="col-sm-5 invoice-order"><span class="invoice-id">Rental Mobil</span><span class="incoice-date">{{ $rent->user->username }}</span></div>
                </div>
                <div class="row invoice-data">
                  <div class="col-sm-5 invoice-person"><span class="name">{{ $rent->user->username}}</span><span>{{ $rent->user->alamat}}</span></div>
                  <div class="col-sm-2 invoice-payment-direction"></div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <table class="table table-bordered" >
                    <thead>
                      <tr>
                        <th>Train Number</th>
                        <th>Train</th>
                        <th>Departure</th>
                        <th>Arrival</th>
                        <th>Dep.Time</th>
                        <th>Fare</th>
                      </tr>
                    </thead>
                    <form action="/rent-edit/{{ $rent->mobil->slug }}/{{$rent->id}}" method="post">
                    <tbody>
                       
                      <tr>
                        <td>{{ $rent->mobil->nama_mobil }}</td>
                        <td>{{ number_format($rent->mobil->harga) }}</td>
                        <td><img src="{{ asset('storage/'.$rent->KTP)}}" alt="" width="120px" height="60px"></td>
                        <td><img src="{{ asset('storage/'.$rent->SIM) }}" alt="" width="120px" height="60px"></td>
                        <td>{{ $rent->rent_date }}</td>
                        <td><input type="date" name="return_date" id=""></td>
                      </tr>
                      <hr>
                        
                    </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row invoice-footer">
                  <div class="col-lg-12">
                      @csrf
                      @method('put')
                      <button id="print" type="submit" class="btn btn-space btn-success">Terima</button>
                    </form>
                  </div>
                </div>
            </div>
          </div>
        </div>
@endsection