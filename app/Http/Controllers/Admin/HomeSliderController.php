<?php

namespace App\Http\Controllers\Admin;

use App\HomeSlider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeSliderController extends Controller
{
    public function index()
    {
        $data = HomeSlider::all();
        return view('admin.home-slider.index', compact('data'));
    }

    public function create()
    {
        return view('admin.home-slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image' => ['required', 'mimes:jpeg,png,jpg', 'max:2000'],
        ]);

        HomeSlider::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $request->file('image')->store('/', 'public'),
        ]);

        return redirect()->back()->with('success', 'berhasil menambahkan data');
    }

    public function show(HomeSlider $homeSlider)
    {

    }

    public function edit(HomeSlider $homeSlider)
    {
        return view('admin.home-slider.edit', compact('homeSlider'));
    }

    public function update(Request $request, HomeSlider $homeSlider)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'mimes:jpeg,png,jpg', 'max:2000'],
        ]);
        
        $homeSlider->update([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $request->iamge ? $request->file('image')->store('/', 'public') : $homeSlider->image_path,
        ]);

        return redirect()->back()->with('success', 'berhasil update');
    }

    public function destroy(HomeSlider $homeSlider)
    {
        $homeSlider->delete();

        return redirect()->back()->with('warning', 'berhasil menghapus');
    }
}
