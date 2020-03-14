@extends('layouts.admin')

@section('title', 'User Profile')

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

					<form action="{{ route('userProfilePost') }}" method="post">
						@csrf
						<div class="card-body">
							<div class="row mb-5">
								<div class="col-md-4 mb-4">
									<div>Profile Information</div>
									<div class="text-muted small">These information are visible to the public.</div>
								</div>

								<div class="col-md-8">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="form-control-label">Name</label>
												<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ Auth::user()->name }}">
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
												<input class="form-control @error('email') is-invalid @enderror" name="email" type="email" value="{{ Auth::user()->email }}">

												@error('email')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
												@enderror
											</div>
										</div>
									</div>
								</div>
							</div>

							<hr>

							<div class="row mt-5">
								<div class="col-md-4 mb-4">
									<div>Access Credentials</div>
									<div class="text-muted small">Leave credentials fields empty if you don't wish to change the password.</div>
								</div>

								<div class="col-md-8">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-control-label">Current Password</label>
												<input type="password" name="password" class="form-control @error('password') is-invalid @enderror">

												@error('password')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
												@enderror
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label class="form-control-label">New Password</label>
												<input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror">

												@error('new_password')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
												@enderror
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label class="form-control-label">New Password Confirmation</label>
												<input name="new_password_confirmation" type="password" class="form-control">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="card-footer bg-light text-right">
							<button type="submit" class="btn btn-primary">Save Changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection