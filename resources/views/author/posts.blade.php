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
											<form id="delete_post_{{ $post->id }}" action="{{ route('postDelete', $post->id) }}" method="post" style="display: none;">
												@csrf		
											</form>
											<button type="button" class="btn btn-danger" onclick="document.getElementById('delete_post_{{ $post->id }}').submit()">X</button>
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
@endsection