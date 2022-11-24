@extends('admin.admin_master')

@section('admin')

<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Create Slider</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('store.slider') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="old_image" value="{{ $brands->image }}">
            <div class="form-group">
                <label for="exampleFormControlInput1">Slider Title</label>
                <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Slider Title">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Slider Image</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
            </div>
            <div class="form-footer pt-4 pt-5 mt-4 border-top">
                <button type="submit" class="btn btn-primary btn-default">Submit</button>
   
            </div>
        </form>
    </div>
</div>

@endsection