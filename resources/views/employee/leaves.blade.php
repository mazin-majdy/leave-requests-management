@extends('layouts.master')
@section('title', 'All Leaves')
@section('topTitle', 'All Leaves')
@section('content')

    @if ($msg)
        <div class="alert alert-success">{{ $msg }}</div>
    @endif
    @if ($error)
        <div class="alert alert-dangre">{{ $error }}</div>
    @endif
    <div class="row">
        <div class="col-12">
            <form action="{{ URL::current() }}" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search..." name="search"
                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <button class="input-group-text btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <table class="table table-hover">
                <thead class="table-primary">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($leaverequests as $leaverequest)
                        <tr>
                            <td>{{ $leaverequest->id }}</td>
                            <td>{{ $leaverequest->name }}</td>
                            <td>
                                <form action="{{ route('create', $leaverequest->id) }}" method="GET">
                                    @csrf
                                    <button class="btn btn-outline-primary">Request</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $leaverequests->withQueryString()->links() }}
    </div>
@endsection
