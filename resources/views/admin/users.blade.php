@extends('layouts.admin')

@section('title', 'All Users')

@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-light">
					All Users
				</div>

				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Email</th>
									<th>Role</th>
									<th>Posts</th>
									<th>Coments</th>
									<th>Created At</th>
									<th>Updated At</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($users as $user)
								<tr>
									<td>{{ $user->id }}</td>
									<td>{{ $user->name }}</td>
									<td>{{ $user->email }}</td>
									<td>
										@if ($user->admin == true)
											<font color="red">Admin</font>
										@elseif($user->author == true)
											<font color="blue">Author</font>
										@else
											<font color="Orange">User</font>		
										@endif
									</td>
									<td>{{ $user->posts->count() }}</td>
									<td>{{ $user->comments->count() }}</td>
									<td>{{ $user->created_at->diffForHumans() }}</td>
									<td>{{ $user->updated_at->diffForHumans() }}</td>
									<td>
										<a href="{{ route('adminUserEdit', $user->id) }}" class="btn btn-info"><i class="icon icon-pencil"></i></a>
										<form id="delete_user_{{ $user->id }}" action="{{ route('adminUserDelete', $user->id) }}" method="post" style="display: none;">
											@csrf		
										</form>
										<button type="button" class="btn btn-danger" onclick="document.getElementById('delete_user_{{ $user->id }}').submit()">X</button>
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