@extends('admin.admin_master')

@section('admin')

<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Create About</h2>
    </div>
    <div class="card-body">
        <form action="{{url('about/update/'.$abouts->id)}}" method="post" >
            @csrf
           
            <div class="form-group">
                <label for="exampleFormControlInput1">Update Slider Title</label>
                <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="{{$abouts->title}}">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Update Short Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="short_dis" rows="3">{{$abouts->short_dis}}</textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Update Long Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="long_dis" rows="3">{{$abouts->long_dis}}</textarea>
            </div>
            <div class="form-footer pt-4 pt-5 mt-4 border-top">
                <button type="submit" class="btn btn-primary btn-default">Update</button>
   
            </div>
        </form>
    </div>
</div>

@endsection