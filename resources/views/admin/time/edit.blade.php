@extends('layouts.admin.index')

@section('content')
    <div class="container">
        <form action="{{route('admin.time.update', $time->id)}}" enctype="multipart/form-data" method="post"> 
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="">Background Image</label>
                <img src="{{asset('storage/'.$time->image_path)}}" alt="" style="height: 200px;">
            </div>
            <div class="form-group">
                <label for="">Upload New Image</label>
                <input type="file" name="image" id="" class="form-control">
                @error('image')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-md btn-primary"> Save </button>
            </div>
        </form>
    </div>
@endsection