@extends('layouts.admin.index')

@section('content')
    <div class="container">
        <h3 class="pb-4">
            Setting Background Image
        </h3>

        <form action="#" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="form-group">
                <img src="{{asset('storage/'.$data->image_path)}}" alt="" style="height: 300px;">
            </div>
            <div class="form-group">
                <label for="">Upload New Image</label>
                <input type="file" name="image" id="" class="form-control">
                @error('image')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <button class="btn btn-md btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>
@endsection