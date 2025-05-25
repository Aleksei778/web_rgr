<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PropertyRequest;

class AdminPropertyRequestController extends AdminController
{
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by', 'property_requests.id');
        $order = $request->get('order','asc');

        // $propRequests = PropertyRequest::with('user', 'property')
        //                 ->orderBy($sortBy, $order)
        //                 ->paginate(10);

        $propRequests = PropertyRequest::query()
            ->select('property_requests.*', 'users.last_name', 'users.first_name', 'users.middle_name', 'properties.address')
            ->join('properties', 'property_requests.property_id', '=', 'properties.id')
            ->join('users', 'property_requests.user_id', '=', 'users.id')
            ->orderBy($sortBy, $order)
            ->paginate(10);

        return view('admin.requests', compact('propRequests', 'sortBy', 'order'));
    }
}
