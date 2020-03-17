@extends('layouts.admin')

@section('title') All Products @endsection

@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-light">
					<h1> Admin Products
						<a href="{{ route('adminNewProduct') }}" class="btn btn-success" style="text-align: right;">Add Product</a>
					</h1>
					@if (Session::has('success'))
					<div class="alert alert-success">
						{{ session('success') }}
					</div>
					@endif
				</div>

				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>Thumbnail</th>
									<th>Title</th>
									<th>Description</th>
									<th>Price</th>
									<th>Created At</th>
									<th>Updated At</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($products as $product)
								<tr>
									<td>{{ $product->id }}</td>
									<td><img src="{{ asset($product->thumbnail) }}" width="100"></td>
									<td class="text-nowrap"><a href="" target="_blank">{{ $product->title }}</a></td>
									<td>{{ Str::limit($product->description, 20) }}</td>
									<td>{{ $product->price }} USD</td>
									<td>{{ $product->created_at->diffForHumans() }}</td>
									<td>{{ $product->updated_at->diffForHumans() }}</td>
									<td>
										<div class="text-nowrap">
											<a href="{{ route('adminEditProduct', $product->id) }}" class="btn btn-info"><i class="icon icon-pencil"></i></a>

											<!-- Delete Button trigger modal -->
											<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_product_modal_{{ $product->id }}">X</button>
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@foreach ($products as $product)
<!-- Modal -->
<div class="modal fade" id="delete_product_modal_{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">You are about to delete - {{ $product->title }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Are you sure?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No, keep it.</button>
				<form id="" action="" method="post"">
					@csrf
					
					<button type="submit" class="btn btn-danger">Yes, delete it</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endforeach
@endsection