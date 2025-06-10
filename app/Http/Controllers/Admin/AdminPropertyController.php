<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyCategory;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AdminPropertyController extends AdminController
{
    public function index()
    {
        $categories = PropertyCategory::whereNull('parent_id')->with('child')->get();
        $properties = Property::where('is_active', true)->with(['category', 'images'])->get();

        return view('admin.property', compact('properties', 'categories'));
    }

    public function store(Request $request) 
    {
        // Add logging to see what data is being received
        Log::info('Store method called', $request->all());
        
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'longitude' => 'nullable|numeric|between:-180,180',
            'latitude' => 'nullable|numeric|between:-90,90',
            'description' => 'nullable|string|max:2000',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'category_select' => 'required|exists:property_categories,id', // Add this validation
        ], [
            'title.required' => 'Заголовок обязателен для заполнения',
            'address.required' => 'Адрес обязателен для заполнения',
            'price.required' => 'Цена обязательна для заполнения',
            'price.numeric' => 'Цена должна быть числом',
            'price.min' => 'Цена не может быть отрицательной',
            'category_select.required' => 'Категория обязательна для выбора',
            'category_select.exists' => 'Выбранная категория не существует',
        ]);
    
        if ($validator->fails()) {
            Log::error("Validation failed", $validator->errors()->toArray());
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        try {
            $categoryId = $request->input('category_select');
            Log::info('Category ID: ' . $categoryId);
    
            // Check if Property model has fillable fields
            $property = Property::create([
                'title' => $request->title,
                'address' => $request->address,
                'longitude' => $request->longitude ?: null,
                'latitude' => $request->latitude ?: null,
                'description' => $request->description,
                'price' => $request->price,
                'category_id' => $categoryId,
                'is_active' => true,
            ]);
            
            Log::info('Property created with ID: ' . $property->id);
            
            if ($request->hasFile('photos')) {
                $i = 1;
    
                foreach ($request->file('photos') as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $customFilename = "{$i}.{$extension}";
                    
                    $path = $photo->storeAs("properties/{$property->id}", $customFilename, 'public');
                    
                    // Check the correct column name in PropertyImage model
                    PropertyImage::create([
                        'property_id' => $property->id,
                        'image_path' => $path,
                    ]);
    
                    $i++;
                }
            }
    
            Log::info('Property and images saved successfully');
            
            return redirect()->back()
                ->with('success','Недвижимость успешно сохранена');
                
        } catch (\Exception $e) {
            Log::error('Error in store method: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return redirect()->back()
                ->withErrors(['error' => 'Произошла ошибка при сохранении: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function destroy(Property $property) {
        $property->delete();

        return redirect()->route('admin.property.index')->with('success', 'Недвижимость успешно удалена');
    }
}
