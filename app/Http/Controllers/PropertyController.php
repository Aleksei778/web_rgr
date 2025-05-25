<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Property;
use App\Models\PropertyRequest;
use App\Models\PropertyCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Models\PropertyImage;
use App\Models\User;
use App\Notifications\NewPropertyRequestNotification;

class PropertyController extends Controller
{
    public function index()
    {
        $categories = PropertyCategory::whereNull('parent_id')->with('child')->get();
        $properties = Property::where('is_active', true)->with(['category', 'images'])->get();

        return view('property.main', compact('properties', 'categories'));
    }

    public function showForm($property_id) 
    {
        $property = Property::findOrFail($property_id);
        $adminEmail = User::where('is_admin', true)->first()->email;

        return view('property.form', compact('property', 'adminEmail'));
    }

    public function submitPropertyForm(Request $request) {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $prop_request = PropertyRequest::create([
            'user_id' => Auth::user()->id,
            'property_id' => $request->property_id,
            'message' => $request->message,
            'status' => 'sended'
        ]);

        $admins = User::where('is_admin', true)->get();

        Notification::send($admins, new NewPropertyRequestNotification($prop_request));

        // Добавляем редирект после регистрации
        return redirect()->route('property');
    }
}
