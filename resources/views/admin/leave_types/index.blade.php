@extends('layouts.master')
@section('title', 'Leave Types')
@section('topTitle', 'Leave Types')
@section('addNew')
    <a href="{{ route('admin.leavetypes.create') }}"
        class="btn btn-label-warning btn-bold btn-sm btn-icon-h kt-margin-l-10">
        Add New
    </a>
@endsection
@section('content')
    @if ($msg)
        <div class="alert alert-success">{{ $msg }}</div>
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
                    @foreach ($leavetypes as $leavetype)
                        <tr>
                            <td>{{ $leavetype->id }}</td>
                            <td>{{ $leavetype->name }}</td>
                            <td>
                                <a href="{{ route('admin.leavetypes.edit', $leavetype->id) }}"
                                    class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                <button class="btn btn-outline-danger btn-delete"><i class="fa-solid fa-trash"></i></button>
                                <form action="{{ route('admin.leavetypes.destroy', $leavetype->id) }}" method="post"
                                    class="d-inline">
                                    @csrf
                                    @method('delete')

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $leavetypes->withQueryString()->links() }}
    </div>
@endsection

@push('scripts')
    <x-delete-btn />
@endpush
