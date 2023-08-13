@extends('layouts.master')
@section('title', 'Leave Requests')
@section('topTitle', 'Leave Requests')
@section('content')

    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <table class="table table-hover">
                <thead class="table-primary">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Duration</th>
                    <th>Status</th>
                </thead>
                <tbody>
                    @foreach ($leaveorders as $leaveorder)
                        <tr>
                            <td>{{ $leaveorder->id }}</td>
                            <td>{{ $leaverequest->name }}</td>
                            <td>{{ $leaveorder->leave_date }}</td>
                            <td>{{ $leaveorder->duration }} Days</td>
                            @if ($leaveorder->status == 'pending')
                                <td class="btn-warning ">
                                    {{ $leaveorder->status }}
                                </td>
                            @elseif ($leaveorder->status == 'accepted')
                                <td class="text-outline-success">
                                    {{ $leaveorder->status }}
                                </td>
                            @else
                            <td class="text-outline-danger">
                                {{ $leaveorder->status }}
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $leaveorders->withQueryString()->links() }}
    </div>
@endsection
