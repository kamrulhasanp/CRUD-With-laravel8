@extends('admin.admin_master')

@section('admin')

<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Edit Slider</h2>
    </div>
    <div class="card-body">
        <form action="{{ url('slider/update/'.$sliders->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="old_image" value="{{ $sliders->image }}">
            <div class="form-group">
                <label for="exampleFormControlInput1">Update Slider Title</label>
                <input type="text" name="title" class="form-control" id="exampleFormControlInput1"   value="{{ $sliders->title }}">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Update Description</label>
                <textarea class="form-control" type="text" id="exampleFormControlTextarea1" name="description" rows="3"  value="{{ $sliders->description }}"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Update Slider Image</label>
                <input type="file" class="form-control-file"  name="image"  value="{{ asset($sliders->image) }}">
            </div>
            <div class="form-footer pt-4 pt-5 mt-4 border-top">
                <button type="submit" class="btn btn-primary btn-default">Update Slider</button>
   
            </div>
        </form>
    </div>
</div>

@endsection