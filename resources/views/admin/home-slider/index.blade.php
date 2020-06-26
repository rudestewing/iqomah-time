@extends('layouts.admin.index')

@section('content')
    <div class="container">
        <div class="row">
            @forelse ($data as $item)
                <div class="col-12 col-md-4">
                    <div class="card mb-3 tw-shadow-md" style="min-height: 300px;">
                        <div class="card-body">
                            <div class=" tw-font-extrabold">
                                 {{$item->title}}
                            </div>
                            <div class="tw-mb-4">
                                <p class="">
                                    {{$item->description}}
                                </p>
                            </div>
                            <img src="{{asset('storage/'.$item->image_path)}}" alt="" style="height: 240px; width: 240px; object-fit: cover; object-position: center;">
                            <div class="tw-mt-5">
                                <form action="{{route('admin.homeSlider.destroy', $item->id)}}" method="post">
                                    @csrf
                                    @method('delete')

                                    <button type="submit" class="btn btn-md btn-danger btn-block"> Delete Slider  </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    No Data
                </div>
            @endforelse
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{route('admin.homeSlider.create')}}" class="btn btn-md btn-primary">Add New Slider</a>
            </div>
        </div>
    </div>
@endsection