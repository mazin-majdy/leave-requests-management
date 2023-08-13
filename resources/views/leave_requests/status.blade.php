@extends('layouts.master')
@section('title', 'Leave Requests')
@section('topTitle', 'Leave Requests')

@section('content')
    {{-- @if ($msg)
        <div class="alert alert-success">{{ $msg }}</div>
    @endif --}}

    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <table class="table table-hover">
                <thead class="table-primary">
                    <th>Leave Type</th>
                    <th>Start Date</th>
                    <th>Duration <small>(days)</small></th>
                    <th>Status</th>
                    <th>Send At</th>
                    <th>Admin Comment</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($leaveRequests as $leaveRequest)
                        <tr>
                            <td>{{ $leaveRequest->leaveType->name }}</td>
                            <td>{{ $leaveRequest->leave_date }}</td>
                            <td>{{ $leaveRequest->duration_days }}<small> days</small></td>
                            @if ($leaveRequest->status == 'pending')
                                <td class="text-warning fw-bold">{{ $leaveRequest->status }}</td>
                            @elseif ($leaveRequest->status == 'approved')
                                <td class="text-success fw-bold">{{ $leaveRequest->status }}</td>
                            @else
                                <td class="text-danger fw-bold">{{ $leaveRequest->status }}</td>
                            @endif
                            <td>{{ $leaveRequest->created_at->diffForHumans() }}</td>
                            <td>{{ $leaveRequest->admin_comment }}</td>
                            <td>
                                <button class="btn btn-outline-danger btn-delete" type="submit"><i
                                        class="fas fa-trash"></i></button>
                                <form class="d-inline" action="{{ route('leave-requests.destroy', $leaveRequest->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('delete')

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <x-delete-btn />
@endpush
