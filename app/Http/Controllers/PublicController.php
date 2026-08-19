<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Setting;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    // Helper privat untuk mengambil data setting sebagai array
    private function getSettings()
    {
        return Setting::pluck('value', 'key')->toArray();
        
    }

    public function index()
    {
        $settings = $this->getSettings();
        $galleries = Gallery::latest()->take(6)->get();
        return view('public.home', compact('settings', 'galleries'));
    }

    public function about()
    {
        $settings = $this->getSettings();
        return view('public.about', compact('settings'));
    }

    public function gallery()
    {
        $settings = $this->getSettings();
        $galleries = Gallery::latest()->paginate(9);
        return view('public.gallery', compact('settings', 'galleries'));
    }

    public function contact()
    {
        $settings = $this->getSettings();
        return view('public.contact', compact('settings'));
    }
}
