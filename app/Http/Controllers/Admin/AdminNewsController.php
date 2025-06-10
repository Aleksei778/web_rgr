<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\News;

class AdminNewsController extends AdminController
{
    public function index()
    {
        $news = News::all();
        return view('admin.news.index', compact('news'));
    }

    public function create() {
        return view('admin.news.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title_ru' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'content_ru' => 'required|string',
            'content_en' => 'required|string',
        ]);

        $data = [
            'title' => ['ru' => $validated['title_ru'], 'en' => $validated['title_en']],
            'content' => ['ru' => $validated['content_ru'], 'en' => $validated['content_en']],
        ];

        News::create($data);

        return redirect()->route('admin.news.index')->with('success','Новость успешно создана');
    }

    public function edit(News $news) {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news) {
        $validated = $request->validate([
            'title_ru' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'content_ru' => 'required|string',
            'content_en' => 'required|string',
        ]);

        $data = [
            'title' => ['ru' => $validated['title_ru'], 'en' => $validated['title_en']],
            'content' => ['ru' => $validated['content_ru'], 'en' => $validated['content_en']],
        ];

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success','Новость успешно обновлена');
    }

    public function destroy(News $news) {
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Новость успешно удалена');
    }
}
