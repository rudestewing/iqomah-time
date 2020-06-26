@extends('layouts.admin.index')

@section('content')
    <div class="container">
        <div class="card tw-shadow-md mb-3">
            <div class="card-header">
                Setting Count
            </div>
            <div class="card-body">
                <form action="{{route('admin.setting.spare.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12 col-md-4">
                            <label for="">Countdown Iqomah</label>
                            <div class="input-group mb-3">
                                <input name="iqomah" type="text" class="form-control" placeholder="0000" aria-label="0000" aria-describedby="basic-addon2" value="{{$settingSpare->iqomah}}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Detik</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12 col-md-4">
                            <label for="">Iqomah Alert</label>
                            <div class="input-group mb-3">
                                <input name="iqomah_alert" type="text" class="form-control" placeholder="0000" aria-label="0000" aria-describedby="basic-addon2" value="{{$settingSpare->iqomah_alert}}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Detik</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12 col-md-4">
                            <label for="">Reminder Upcoming</label>
                            <div class="input-group mb-3">
                                <input name="upcoming" type="text" class="form-control" placeholder="0000" aria-label="0000" aria-describedby="basic-addon2" value="{{$settingSpare->upcoming}}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Detik</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <button type="submit" class="btn btn-block btn-primary"> Save </button>
                        </div>
                    </form>
                </div>
            </div>
           
        </div>

        <div class="card  tw-shadow-md mb-3">
            <div class="card-header">
                Setting Background Image
            </div>
            <div class="card-body">
                <form action="{{route('admin.setting.background.store')}}" method="post" enctype="multipart/form-data"> 
                    @csrf
                    <div class="form-group">
                        <img src="{{asset('storage/'.$settingBackground->image_path)}}" alt="" style="height: 300px;">
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
        </div>
    </div>
@endsection