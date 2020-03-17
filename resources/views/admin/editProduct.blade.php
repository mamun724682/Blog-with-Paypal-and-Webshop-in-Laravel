@extends('layouts.admin')

@section('title') Edit Product @endsection

@section('content')
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header bg-light">
						<h1>Edit Product</h1>
						@if (Session::has('success'))
						<div class="alert alert-success">
							{{ session('success') }}
						</div>
						@endif
					</div>

					<form action="{{ route('adminEditProductPost', $product->id) }}" method="post" enctype="multipart/form-data">
						@csrf						
						<div class="card-body">				

							<div class="row mt-6">
								<div class="col-md-6">
									<div class="form-group">
										<label for="required-input" class="require">Thumbnail</label>
										<input id="required-input" class="form-control @error('thumbnail') is-invalid @enderror" type="file" name="thumbnail" value="">

										@error('thumbnail')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>
								<div class="col-md-6">
									<label for="" class="">Old Thumbnail</label>
									<img src="{{ asset($product->thumbnail) }}" width="100">
								</div>
							</div>

							<div class="row mt-6">
								<div class="col-md-12">
									<div class="form-group">
										<label for="required-input" class="require">Title</label>
										<input id="required-input" class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ $product->title }}">

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
										<label for="required-input" class="require">Price</label>
										<input id="required-input" class="form-control @error('price') is-invalid @enderror" type="text" name="price" value="{{ $product->price }}">

										@error('price')
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
										<label for="textarea" class="require">Description</label>
										<textarea id="textarea" class="form-control @error('description') is-invalid @enderror" rows="10" name="description">{{ $product->description }}</textarea>

										@error('description')
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
										<button type="submit" class="btn btn-primary px-5">Update Product</button>
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