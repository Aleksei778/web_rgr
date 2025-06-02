<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use App\Models\PropertyRequest;
use App\Models\User;
use App\Notifications\CheckRequestResultNotification;

class AdminPropertyRequestController extends AdminController
{
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by', 'property_requests.id');
        $order = $request->get('order','asc');

        $propRequests = PropertyRequest::query()
            ->select('property_requests.*', 'users.last_name', 'users.first_name', 'users.middle_name', 'properties.address')
            ->join('properties', 'property_requests.property_id', '=', 'properties.id')
            ->join('users', 'property_requests.user_id', '=', 'users.id')
            ->orderBy($sortBy, $order)
            ->paginate(10);

        return view('admin.requests', compact('propRequests', 'sortBy', 'order'));
    }

    public function acceptRequest(Request $request, $id) {
        $propertyRequest = PropertyRequest::with('user')->findOrFail($id);
        
        Log::info("Заявка #$id принята", [
            'admin_message' => $request->get('approval_message'),
            'admin_id' => auth()->id(),
        ]);
        
        $propertyRequest->update([
            'status' => 'accepted',
            'admin_message' => $request->get('approval_message'),
        ]);
        
        $user = $propertyRequest->first()->user;
    
        Notification::send($user, new CheckRequestResultNotification($propertyRequest->first()));
    
        return redirect()->back()->with('success','Заявка одобрена');
    }
    
    public function rejectRequest(Request $request, $id) {
        $propertyRequest = PropertyRequest::with('user')->findOrFail($id);
        
        Log::info("Заявка #$id отклонена", [
            'admin_message' => $request->get('rejection_reason'),
            'admin_id' => auth()->id(),
        ]);
        
        $propertyRequest->update([
            'status' => 'rejected',
            'admin_message' => $request->get('rejection_reason'),
        ]);
    
        $user = $propertyRequest->first()->user;
    
        Notification::send($user, new CheckRequestResultNotification($propertyRequest));
    
        return redirect()->back()->with('success','Заявка отклонена');
    }
}
