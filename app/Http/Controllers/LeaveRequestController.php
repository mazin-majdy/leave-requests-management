<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Leaverequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    public function submitLeaveRequest(Request $request)
    {
        // Validate the request data

        $request->validate([
            'leave_type_id' => 'required|exists:leave_types,id',
            'start_date' => 'required|date',
            'duration_days' => 'required|integer|min:1',
        ]);
        // Create a new leave request record in the database
        $leaveRequest = new Leaverequest([
            'leave_type_id' => $request->input('leave_type_id'),
            'start_date' => $request->input('start_date'),
            'duration_days' => $request->input('duration_days'),
        ]);

        $leaveRequest->save();

        // Redirect back with a success message
        return redirect()->route('show-leaves')->with('msg', 'Leave request submitted successfully.');
    }

    public function viewLeaveRequestStatus()
    {
        // Retrieve the authenticated user's leave requests
        $user = Auth::user();
        $leaveRequests = $user->leaveRequests;

        return view('leave_requests.status', [
            'leaveRequests' => $leaveRequests,
        ]);
    }

    public function adminViewLeaveRequests()
    {
        // Retrieve and display leave requests for administrators
        $leaverequests = Leaverequest::with('user', 'leaveType')->get();
        $msg = session('msg');

        return view('admin.leave_requests.index', compact('leaverequests', 'msg'));
    }

    public function approveLeaveRequest(Leaverequest $request)
    {
        $request->update([
            'status' => 'Approved',
            'admin_comment' => 'Leave request approved.',
        ]);


        return redirect()->back()->with('msg', 'Leave request approved successfully.');
    }

    public function denyLeaveRequest(Request $myRequest, Leaverequest $request)
    {
        $request->update([
            'status' => 'denied',
            'admin_comment' => 'Leave request denied: ' . $myRequest->admin_comment,
        ]);


        return redirect()->back()->with('msg', 'Leave request denied successfully.');
    }
}
