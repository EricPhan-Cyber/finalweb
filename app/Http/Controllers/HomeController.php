<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('layouts.app');
        $sliders = Slider::where('status', '0')->get();
        $trendingProducts = Product::where('trending', '1')->latest()->take(15)->get();
        $newArrivalsProducts = Product::latest()->take(14)->get();
        $featuredProducts = Product::where('featured', '1')->latest()->take(14)->get();
        return view('frontend.index', compact('sliders', 'trendingProducts', 'newArrivalsProducts', 'featuredProducts'));
    }
}