<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\News;

class AdminPagesController extends AdminController
{
    public function index() {
        return view('admin.pages');
    }
}
