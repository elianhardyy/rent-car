@extends('layouts.layoutclient')
@section('title','Rent Car')
@section('content')
<div class ="row">
        <div class ="col-12 col-sm-100">

        </div>

        <div class ="col-12 col-sm-6">
            <div class="input-group mb-3">
                <input >
            </div>
        </div>
    </div>
<div class="my-5 container">

    <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Vertical Form</h5>
    
                  <!-- Vertical Form -->
                  <form class="row g-3" action="/rent-add" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="mobil_id" value="{{ $mobil->id }}">
                    <div class="col-12">
                      <label for="inputNanme4" class="form-label">KTP</label>
                      <input type="file" class="form-control" id="imgKTP" name="KTP" onchange="piKTP()">
                      <img class="img-preview-ktp">
                    </div>
                    <div class="col-12">
                      <label for="inputEmail4" class="form-label">SIM</label>
                      <input type="file" class="form-control" id="imgSIM" name="SIM" onchange="piSIM()">
                      <img class="img-preview-sim">
                    </div>
                    <div class="col-12">
                      <label for="inputPassword4" class="form-label">Sewa</label>
                      <input type="date" class="form-control" id="inputPassword4" name="rent_date">
                    </div>
                    <div class="col-12">
                      <label for="inputAddress" class="form-label">Total</label>
                      <input type="number" class="form-control" id="inputAddress" name="total" value="{{ number_format($mobil->harga) }}">
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                  </form><!-- Vertical Form -->
    
                </div>
              </div>
</div>

<script>
function piKTP()
{
  const imgKtp = document.querySelector("#imgKTP");
  const ktpPreview = document.querySelector(".img-preview-ktp");
  ktpPreview.style.display = 'block';
  const reader = new FileReader();
  ktpPreview.style.width = '140px';
  ktpPreview.style.height = '70px';
  reader.readAsDataURL(imgKtp.files[0]);
  reader.onload = function(event){
    ktpPreview.src = event.target.result;
  }
}
function piSIM()
{
  const imgSim = document.querySelector("#imgSIM");
  const simPreview = document.querySelector(".img-preview-sim");
  simPreview.style.display = 'block';
  const reader = new FileReader();
  simPreview.style.width = '140px';
  simPreview.style.height = '70px';
  reader.readAsDataURL(imgSim.files[0]);
  reader.onload = function(event){
    simPreview.src = event.target.result;
  }
}
</script>

@endsection