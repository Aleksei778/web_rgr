<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\News;

class AdminNewsController extends AdminController
{
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->get();
        return view('admin.news.index', compact('news'));
    }

    public function create() {
        return view('admin.news.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        News::create($validated);

        return redirect()->route('admin.news.index')->with('success','Новость успешно создана');
    }

    public function edit(News $news) {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news) {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $news->update($validated);

        return redirect()->route('admin.news.index')->with('success','Новость успешно обновлена');
    }

    public function destroy(News $news) {
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Новость успешно удалена');
    }
}
