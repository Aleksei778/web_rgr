<?php

namespace App\Http\Controllers;

use App\Models\AboutCompanyAwards;
use App\Models\AboutCompanyHistory;
use App\Models\AboutCompanyServices;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $histories = AboutCompanyHistory::orderBy('id')->get();
        $services = AboutCompanyServices::orderBy('id')->get();
        $awards = AboutCompanyAwards::orderBy('id')->get();

        return view('about-company', compact('histories', 'services', 'awards'));
    }
}
