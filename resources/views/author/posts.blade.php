@extends('layouts.admin')

@section('title', 'Author Posts')

@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-light">
					<h1>All Posts</h1>
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
									<th>Title</th>
									<th>Created At</th>
									<th>Updated At</th>
									<th>Comments</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach (Auth::user()->posts as $post)
								<tr>
									<td>{{ $post->id }}</td>
									<td class="text-nowrap"><a href="{{ route('singlePost', $post->id) }}" target="_blank">{{ $post->title }}</a></td>
									<td>{{ $post->created_at->diffForHumans() }}</td>
									<td>{{ $post->updated_at->diffForHumans() }}</td>
									<td>{{ $post->comments->count() }}</td>
									<td>
										<div class="text-nowrap">
											<a href="{{ route('postEdit', $post->id) }}" class="btn btn-info">Edit</a>

											<!-- Delete Button trigger modal -->
											<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_post_modal_{{ $post->id }}">X</button>
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

@foreach (Auth::user()->posts as $post)
<!-- Modal -->
<div class="modal fade" id="delete_post_modal_{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">You are about to delete - {{ $post->title }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Are you sure?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No, keep it.</button>
				<form id="" action="{{ route('postDelete', $post->id) }}" method="post"">
					@csrf
					
				<button type="submit" class="btn btn-danger">Yes, delete it</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endforeach

@endsection