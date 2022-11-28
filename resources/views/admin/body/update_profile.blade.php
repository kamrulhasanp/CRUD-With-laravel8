@extends('admin.admin_master')

@section('admin')

@error('oldpassword') 
    <span class="text-danger">{{ $message }}</span>
@enderror

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>{{session('success')}}</strong>

<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>

@endif

<div class="card-body p-5">
<h4 class="text-dark mb-2 text-center">User Profile Update</h4>
<form action="{{ route('user.profile.update') }}" class="form-pill" method="post">
@csrf
<div class="form-group col-md-12 mb-4">
  <lavel for="exampleFormControlInput3"> User Name </lavel>
 <input type="text" class="form-control "  name="name" value=" {{$user->name}}">

</div>

<div class="form-group col-md-12 mb-4">
  <lavel for="exampleFormControlInput3"> User Email </lavel>
 <input type="email" class="form-control "  name="email" value=" {{$user->email}}">

</div>



<button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Save</button>

</div>

</form>

</div>
@endsection