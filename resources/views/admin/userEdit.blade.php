@extends('layouts.admin')

@section('title') Editing - {{ $user->name }} @endsection

@section('content')
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header bg-light">
						<h1>Account Settings</h1>
						@if (Session::has('error'))
						<div class="alert alert-danger">{{ session('error') }}</div>
						@endif

						@if (Session::has('success'))
						<div class="alert alert-success">{{ session('success') }}</div>
						@endif
					</div>

					<form action="{{ route('adminUpdateUser', $user->id) }}" method="post">
						@csrf
						<div class="card-body">
							<div class="row mb-5">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="form-control-label">Name</label>
												<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ $user->name }}">
												@error('name')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
												@enderror
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="form-control-label">Email Address</label>
												<input class="form-control @error('email') is-invalid @enderror" name="email" type="email" value="{{ $user->email }}">

												@error('email')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
												@enderror
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="form-control-label">Permission</label><br>
												<input class="@error('checkbox') is-invalid @enderror" name="admin" type="checkbox" value=1 {{ $user->admin == true? 'checked' : '' }}> Admin &nbsp;&nbsp;
												<input class="@error('checkbox') is-invalid @enderror" name="author" type="checkbox" value=1 {{ $user->author == true? 'checked' : '' }}> Author

												@error('checkbox')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
												@enderror
											</div>
										</div>
									</div>

									<div class="card-footer bg-light text-left">
										<button type="submit" class="btn btn-primary">Save Changes</button>
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