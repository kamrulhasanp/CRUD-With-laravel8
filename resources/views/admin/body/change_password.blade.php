@extends('admin.admin_master')

@section('admin')
<div class="card-body p-5">
<h4 class="text-dark mb-2 text-center">Change Password</h4>
<form action="{{ route('password.update') }}" class="form-pill" method="post">
@csrf
<div class="form-group col-md-12 mb-4">
<input type="password" class="form-control input-lg" id="current_password" name="oldpassword"
    aria-describedby="emailHelp" placeholder="Current Password">
    @error('oldpassword') 
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="form-group col-md-12 ">
<input type="password"  id="password" class="form-control input-lg"  name="password" placeholder="New Password">
@error('password') 
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="form-group col-md-12 ">
<input type="password" id="password_confirmation" class="form-control input-lg"  name="password_confirmation"
    placeholder="Confirm Password">
    @error('password_confirmation') 
    <span  class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="col-md-12">
<div class="d-flex my-2 justify-content-between">
    
    <p><a class="text-blue" href="#">Forgot Your Password?</a></p>
</div>
<button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Save</button>
<p>Don't have an account yet ?
    <a class="text-blue" href="{{ route('register') }}"> Save</a>
</p>
</div>

</form>

</div>
@endsection