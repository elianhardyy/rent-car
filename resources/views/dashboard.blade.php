@extends('layouts.layoutadmin')

@section('title', 'Dashboard')

@section('content')

<div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
      
      </nav>
    </div>

<section class="section dashboard">
      <div class="row">

        <div class="col-lg-12">
          <div class="row">

            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Users</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$user_count}}</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-xxl-4 col-md-4">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Kategori</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-list"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$category_count}}</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-xxl-4 col-md-4">
              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Katalog Mobil</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-book"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$mobil_count}}</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Data Rental</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-car-front"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$rent_count}}</h6>

                    </div>
                  </div>

                </div>
              </div>

            </div>

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

        </div><!-- End Right side columns -->

      </div>
    </section>

@endsection