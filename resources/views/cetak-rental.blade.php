<link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
  
  <link href="{{asset('assets/css/admin.css')}}" rel="stylesheet">
<div class="pagetitle">

      <nav>
      </nav>
    </div>
    
      
        
     
    

<h1>{{ $title }}</h1>
<div class="date-filter d-flex flex-col">
    
    <p><strong>Mulai</strong> : {{ date('l d-M-Y',strtotime($from)) }}</p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p><strong>Sampai</strong> : {{ date('l d-M-Y',strtotime($to)) }}</p>
</div>


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
  </tr>
  @endforeach
    </tbody>
  </table>

<script src="{{asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{asset('assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('assets/vendor/quill/quill.min.js')}}"></script>
  <script src="{{asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>

