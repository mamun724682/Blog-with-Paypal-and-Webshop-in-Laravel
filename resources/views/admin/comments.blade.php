@extends('layouts.admin')

@section('title', 'User Comments')

@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-light">
					Admin Comments
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
								@foreach ($comments as $comment)
								<tr>
									<td>{{ $comment->id }}</td>
									<td class="text-nowrap"><a href="{{ route('singlePost', $comment->post->id) }}" target="_blank">{{ $comment->post->title }}</a></td>
									<td>{{ $comment->content }}</td>
									<td>{{ $comment->created_at->diffForHumans() }}</td>
									<td>
										<form id="delete_comment_{{ $comment->id }}" action="{{ route('adminCommentDelete', $comment->id) }}" method="post">
											@csrf		
										</form>
										<button type="button" class="btn btn-danger" onclick="document.getElementById('delete_comment_{{ $comment->id }}').submit()">X</button>
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