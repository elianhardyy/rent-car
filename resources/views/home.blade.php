@extends('layouts.layoutclient')

@section('title', 'Home')

@section('content')

<section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url(/img/slide/123.png)">
        
          <div class="carousel-container">
            <div class="container">
              <h2 class="animate__animated animate__fadeInDown">Welcome to <span>Rental Mobil</span></h2>
              <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
            </div>
          </div>
        </div>


      </div>

      <a  href="#heroCarousel" role="button" data-bs-slide="prev">
        <span  aria-hidden="true"></span>
      </a>

      <a  href="#heroCarousel" role="button" data-bs-slide="next">
        <span  aria-hidden="true"></span>
      </a>

    </div>
@endsection