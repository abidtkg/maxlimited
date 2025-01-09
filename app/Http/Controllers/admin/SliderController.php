<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('rank')->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'rank' => 'required|integer',
            'image' => 'required|mimes:png,jpg,jpeg,svg'
        ], [
            'title.required' => 'Title required',
            'rank.required' => 'Rank required',
            'image.required' => 'Image must be png,jpg,jpeg,svg'
        ]);

        if ($request->hasFile('image')) {
            $extension = $request->image->getClientOriginalExtension();
            $imageName =  uniqid() . '.' . $extension;
            $request->image->move('uploads/', $imageName);
        }

        try {
            Slider::create([
                'title' => $request->title,
                'rank' => $request->rank,
                'url' => $imageName,
            ]);
            return redirect()->route('admin.slider.index')->with('success', 'Slider has created!');
        } catch (Exception $e) {
            return back()->with('error', 'Some error occured!');
        }
    }

    public function delete(string $id)
    {
        // FIND IMAGE
        $image = Slider::findOrFail($id);

        if (!$image) return back()->with('error', 'Slider not found!');

        $imagePath = public_path('uploads/' . $image->url);
        if (File::exists($imagePath)) {
            unlink($imagePath);
        }

        try {
            $image->delete();
            return back()->with('success', 'Slider delete success');
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function edit_view(string $id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'title' => 'required|string|max:255',
            'rank' => 'required|integer',
        ], [
            'id.required' => 'ID is required',
            'title.required' => 'Title is required',
            'rank.required' => 'Rank is required'
        ]);

        $slider = Slider::findOrFail($request->id);

        if (!$slider) return redirect()->route('admin.slider.edit')->with('error', 'Slider not found!');

        $update_payload = [
            'title' => $request->title,
            'rank' => $request->rank
        ];

        try {
            Slider::where('id', $request->id)->update($update_payload);
            return redirect()->route('admin.slider.index')->with('success', 'Slider has updated');
        } catch (Exception $e) {
            return back()->with('error', 'Slider update error');
        }
    }
}
