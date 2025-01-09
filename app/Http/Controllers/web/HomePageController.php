<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $notice = Option::where('key', 'homescrollnotice')->first();
        $sliders = Slider::orderBy('rank')->get();
        return view('index', compact('notice', 'sliders'));
    }
}
