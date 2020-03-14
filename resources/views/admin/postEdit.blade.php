@extends('layouts.admin')

@section('title') Editing - {{ $post->title }} @endsection

@section('content')
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header bg-light">
						<h1>Edit Post</h1>
						@if (Session::has('success'))
						<div class="alert alert-success">
							{{ session('success') }}
						</div>
						@endif
					</div>

					<form action="{{ route('updatePost', $post->id) }}" method="post">
						@csrf						
						<div class="card-body">				

							<div class="row mt-6">
								<div class="col-md-12">
									<div class="form-group">
										<label for="required-input" class="require">Post Title</label>
										<input id="required-input" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $post->title }}">

										@error('title')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>
							</div>

							<div class="row mt-6">

								<div class="col-md-12">
									<div class="form-group">
										<label for="textarea" class="require">Content</label>
										<textarea id="textarea" class="form-control @error('content') is-invalid @enderror" rows="10" name="content">{{ $post->content }}</textarea>

										@error('content')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>
							</div>
							<div class="row mt-6">
								<div class="col-md-12">
									<div class="form-group">
										<button type="submit" class="btn btn-primary px-5">Update Post</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection