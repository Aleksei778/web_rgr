<?php

namespace App\Http\Controllers\Admin;

use App\Models\AboutCompanyAwards;
use App\Models\AboutCompanyHistory;
use App\Models\AboutCompanyServices;
use Illuminate\Http\Request;

class AdminPagesController extends AdminController
{
    public function index() {
        $histories = AboutCompanyHistory::orderBy('id')->get();
        $services = AboutCompanyServices::orderBy('id')->get();
        $awards = AboutCompanyAwards::orderBy('id')->get();

        return view('admin.pages.index', compact('histories', 'services', 'awards'));
    }

    // History methods
    public function editHistory($id) {
        $history = AboutCompanyHistory::findOrFail($id);
        return view('admin.pages.history.edit', compact('history'));
    }

    public function updateHistory(Request $request, $id) {
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

        $history = AboutCompanyHistory::findOrFail($id);
        $history->update($data);

        return redirect()->route('admin.pages.index')->with('success', 'История успешно обновлена');
    }

    public function createHistory() {
        return view('admin.pages.history.create');
    }

    public function storeHistory(Request $request) {
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

        AboutCompanyHistory::create($data);

        return redirect()->route('admin.pages.index')->with('success', 'История успешно добавлена');
    }

    public function deleteHistory($id) {
        AboutCompanyHistory::findOrFail($id)->delete();
        return redirect()->route('admin.pages.index')->with('success', 'История удалена');
    }

    // Services methods
    public function editService($id) {
        $service = AboutCompanyServices::findOrFail($id);
        return view('admin.pages.services.edit', compact('service'));
    }

    public function updateService(Request $request, $id) {
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

        $service = AboutCompanyServices::findOrFail($id);
        $service->update($data);

        return redirect()->route('admin.pages.index')->with('success', 'Услуга успешно обновлена');
    }

    public function createService() {
        return view('admin.pages.services.create');
    }

    public function storeService(Request $request) {
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

        AboutCompanyServices::create($data);

        return redirect()->route('admin.pages.index')->with('success', 'Услуга успешно добавлена');
    }

    public function deleteService($id) {
        AboutCompanyServices::findOrFail($id)->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Услуга удалена');
    }

    // Awards methods
    public function editAward($id) {
        $award = AboutCompanyAwards::findOrFail($id);
        return view('admin.pages.awards.edit', compact('award'));
    }

    public function updateAward(Request $request, $id) {
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

        $award = AboutCompanyAwards::findOrFail($id);
        $award->update($data);

        return redirect()->route('admin.pages.index')->with('success', 'Награда успешно обновлена');
    }

    public function createAward() {
        return view('admin.pages.awards.create');
    }

    public function storeAward(Request $request) {
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

        AboutCompanyAwards::create($data);

        return redirect()->route('admin.pages.index')->with('success', 'Награда успешно добавлена');
    }

    public function deleteAward($id) {
        AboutCompanyAwards::findOrFail($id)->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Награда удалена');
    }
}