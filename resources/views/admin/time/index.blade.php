@extends('layouts.admin.index')


@section('content')
    <div class="container">
        @foreach ($data as $item)
            <div class="card mb-3 tw-shadow-md">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="form-group">
                                Name : {{$item->name}}
                            </div>
                            <div class="form-group">
                                Title : {{$item->title}}
                            </div>
                            <div>
                                <a href="{{route('admin.time.edit', $item->id)}}" class="btn btn-sm btn-primary"> Edit Background </a>
                            </div>
                        </div>
                        <div class="col-12 col-md-4" style="height: 100px;">
                            <img src="{{asset('storage/'.$item->image_path)}}" alt="" style="height: 100px; width: auto; object-fit: cover; object-position: center;">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection