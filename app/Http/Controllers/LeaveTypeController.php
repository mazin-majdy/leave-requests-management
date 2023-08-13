<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $leavetypes = LeaveType::filter($request->query())
            ->orderByDesc('created_at')
            ->paginate(10);

        $msg = session('msg');

        return view('admin.leave_types.index', compact('leavetypes', 'msg'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.leave_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
        ]);

        LeaveType::create($request->all());

        return redirect()->route('admin.leavetypes.index')->with('msg', 'Leave Type Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $leavetype = LeaveType::findOrFail($id);
        return view('admin.leave_types.edit', compact('leavetype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required',
        ]);
        $leavetype = LeaveType::findOrFail($id);
        $leavetype->update($request->all());

        return redirect()->route('admin.leavetypes.index')->with('msg', 'Leave Type Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $leavetype = LeaveType::findOrFail($id);
        $leavetype->delete();
        return redirect()->route('admin.leavetypes.index')->with('msg', 'Leave Type Deleted Successfully');
    }
}
