@extends('layouts.master')

@section('content')
<!-- Page Header -->
<header class="masthead" style="background-image: url('/assets/img/home-bg.jpg')">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading">
          <h1>{{ $product->title }}</h1>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- Main Content -->
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <img src="{{ asset($product->thumbnail) }}" width="60%">
    </div>
    <div class="col-md-6">
      <h2>{{ $product->title }}</h2> <hr>
      <{{ $product->description }} <hr>
      <b>${{ $product->price }} USD</b>&nbsp <br> <br> 
      <a href="" class="btn btn-primary">Checkout With Paypal</a>
    </div>
  </div>
</div>

@endsection