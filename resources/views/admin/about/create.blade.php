@extends('admin.admin_master')

@section('admin')

<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Create About</h2>
    </div>
    <div class="card-body">
        <form action="{{route('store.about')}}" method="post" >
            @csrf
           
            <div class="form-group">
                <label for="exampleFormControlInput1">Slider Title</label>
                <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="About Title">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Short Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="short_dis" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Long Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="long_dis" rows="3"></textarea>
            </div>
            <div class="form-footer pt-4 pt-5 mt-4 border-top">
                <button type="submit" class="btn btn-primary btn-default">Submit</button>
   
            </div>
        </form>
    </div>
</div>

@endsection