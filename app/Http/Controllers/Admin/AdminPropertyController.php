<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\News;

class AdminPropertyController extends AdminController
{
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->get();
        return view('admin.news.news', compact('news'));
    }
}
