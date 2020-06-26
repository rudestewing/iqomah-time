@extends('layouts.admin.index')

@section('content')
    <div class="container">
        <form action="{{route('admin.homeSlider.store')}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control">
                @error('title')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
                @error('description')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Image</label>
                <input type="file" name="image" class="form-control">
                @error('image')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-md btn-primary">Save</button>
            </div>
        </form>
    </div>
@endsection