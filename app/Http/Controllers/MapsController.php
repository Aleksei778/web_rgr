<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class MapsController extends Controller
{
    public function index()
    {
        $addresses = Property::select('title', 'longitude', 'latitude', 'address')->get();

        return view('location-map', compact('addresses'));
    }
}
