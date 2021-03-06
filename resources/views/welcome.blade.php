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
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      @foreach ($posts as $post)
      <div class="post-preview">
        <a href="{{ route('singlePost', $post->id) }}">
          <h2 class="post-title">
            {{ $post->title }}
          </h2>
          {{-- <h3 class="post-subtitle">
            Problems look mighty small from 150 miles up
          </h3> --}}
        </a>
        <p class="post-meta">Posted by
          <a href="#">{{ $post->user->name }}</a>
        on {{ date_format($post->created_at, 'F d, y') }}  
        | <i class="fa fa-comment" aria-hidden="true">{{ $post->comments->count() }}</i>
      </p>
      </div>
      <hr>
      @endforeach
      <!-- Pager -->
      <div class="clearfix float-right">        
        {{ $posts->links() }}
      </div>
    </div>
  </div>
</div>
@endsection