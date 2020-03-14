@extends('layouts.master')

@section('content')
<!-- Page Header -->
<header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading">
          <h1><img src="{{ asset('assets/img/devFaculty.png') }}"></h1>
          <span class="subheading">{{ remove_spaces('A Dynamic Project with Laravel') }}</span>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- Main Content -->

@endsection