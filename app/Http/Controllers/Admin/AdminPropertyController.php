<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyCategory;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Validator;

class AdminPropertyController extends AdminController
{
    public function index()
    {
        $categories = PropertyCategory::whereNull('parent_id')->with('child')->get();
        $properties = Property::where('is_active', true)->with(['category', 'images'])->get();

        return view('admin.property', compact('properties', 'categories'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'longitude' => 'nullable|numeric|between:-180,180',
            'latitude' => 'nullable|numeric|between:-90,90',
            'description' => 'nullable|string|max:2000',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'photos' => 'required|array|min:2',
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'title.required' => 'Заголовок обязателен для заполнения',
            'address.required' => 'Адрес обязателен для заполнения',
            'price.required' => 'Цена обязательна для заполнения',
            'price.numeric' => 'Цена должна быть числом',
            'price.min' => 'Цена не может быть отрицательной',
            'photos.required' => 'Необходимо загрузить фотографии',
            'photos.min' => 'Минимум 2 фотографии',
            'photos.*.image' => 'Файл должен быть изображением',
            'photos.*.max' => 'Размер изображения не должен превышать 2MB'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $categoryId = $request->input('category_select');

            $property = Property::create([
                'title' => $request->title,
                'address' => $request->address,
                'longitude' => $request->longitude,
                'latitude' => $request->latitude,
                'price' => $request->price,
                'category_id' => $categoryId,
            ]);
            
            if ($request->hasFile('photos')) {
                $i = 1;

                foreach ($request->file('photos') as $photo) {
                    $customFilename = "{$i}.jpg";
                    $path = $photo->storeAs("properties/{$property->id}", $customFilename, 'public');
                    
                    $photo_image = PropertyImage::create([
                        'property_id' => $property->id,
                        'path' => $path
                    ]);

                    $i++;
                }
            }

            return redirect()->back()
                ->with('success','Недвижимость успешно сохранена');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e)->withInput();
        }
    }

    public function destroy(Property $property) {
        $property->delete();

        return redirect()->route('admin.property.index')->with('success', 'Недвижимость успешно удалена');
    }
}
