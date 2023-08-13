<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Leaverequest;
use App\Models\LeaverequestUser;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeLeaveController extends Controller
{
    //
    public function showLeaves(Request $request)
    {

        $leaverequests = LeaveType::OrderByDesc('created_at')
            ->filter($request->query())
            ->paginate(10);

        $msg = session('msg');
        $error = session('error');

        return view('employee.leaves', compact('leaverequests', 'msg', 'error'));
    }
    public function create(String $id)
    {
        $leavetype = LeaveType::findOrFail($id);
        return view('employee.create', compact('leavetype'));
    }

    public function destroy(String $id)
    {
        // $user_id = Auth::user()->id;
        // $leaverequest_id = $id;
        // dd($user_id,$leaverequest_id);
        $leaverequest = Leaverequest::findOrFail($id);
        $leaverequest->delete();

        return redirect()->back()->with('msg', 'Leave Request Deleted Successfully');
    }
}
