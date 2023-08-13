@extends('layouts.master')
@section('title', 'Order Leave Request')
@section('topTitle', 'Order ' . '(' . $leavetype->name . ')')
@section('content')

@include('errors')



    <form action="{{ route('leave-request.submit', $leavetype->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <input hidden type="text" class="form-control" id="leave_type_id" placeholder="Leave type id" name="leave_type_id" value="{{ $leavetype->id }}">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input disabled type="name" class="form-control" id="name" placeholder="Name" name="name" value="{{ $leavetype->name }}">
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="start_date" placeholder="Start Date" name="start_date">
        </div>
        <div class="mb-3">
            <label for="duration_days" class="form-label">Duration <small>(Days)</small></label>
            <input type="number" class="form-control" id="duration_days" placeholder="Duration Days" name="duration_days">
        </div>
        <button class="btn btn-primary">Request</button>
    </form>
@endsection
