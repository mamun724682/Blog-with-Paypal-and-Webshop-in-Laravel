@extends('layouts.admin')

@section('title', 'User Comments')

@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-light">
					Striped Rows
				</div>

				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>Post</th>
									<th>Content</th>
									<th>Created At</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach (Auth::user()->comments as $comment)
								<tr>
									<td>{{ $comment->id }}</td>
									<td class="text-nowrap"><a href="{{ route('singlePost', $comment->post->id) }}" target="_blank">{{ $comment->post->title }}</a></td>
									<td>{{ $comment->content }}</td>
									<td>{{ $comment->created_at->diffForHumans() }}</td>
									<td>
										
										<!-- Delete Button trigger modal -->
										<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_comment_modal_{{ $comment->id }}">X</button>
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

@foreach (Auth::user()->comments as $comment)
<!-- Modal -->
<div class="modal fade" id="delete_comment_modal_{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">You are about to delete comment for post - {{ $comment->post->title }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Are you sure?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No, keep it.</button>
				<form id="" action="{{ route('commentDelete', $comment->id) }}" method="post"">
					@csrf
					
					<button type="submit" class="btn btn-danger">Yes, delete it</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endforeach

@endsection