@extends('layouts.master')
@section('title', 'All Leave Requests')
@section('content')

    @if ($msg)
        <div class="alert alert-success">
            {{ $msg }}
        </div>
    @endif
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <table class="table table-hover">
                <thead class="table-primary">
                    <th>User Name</th>
                    <th>Leave Type</th>
                    <th>Start Date</th>
                    <th>Duration <small>(days)</small></th>
                    <th>Status</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($leaverequests as $leaverequest)
                        <tr>
                            <td>{{ $leaverequest->user->name }}</td>
                            <td>{{ $leaverequest->leaveType->name }}</td>
                            <td>{{ $leaverequest->leave_date }}</td>
                            <td>{{ $leaverequest->duration_days }}</td>
                            @if ($leaverequest->status == 'pending')
                                <td class="text-warning fw-bold">{{ $leaverequest->status }}</td>
                            @elseif ($leaverequest->status == 'approved')
                                <td class="text-success fw-bold">{{ $leaverequest->status }}</td>
                            @else
                                <td class="text-danger fw-bold">{{ $leaverequest->status }}</td>
                            @endif
                            <td>
                                <form class="d-inline"
                                    action="{{ route('admin.leave-requests.approve', ['request' => $leaverequest]) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-success w-25">Approve</button>
                                </form>
                                |
                                <form class="d-inline my-form"
                                    action="{{ route('admin.leave-requests.deny', ['request' => $leaverequest]) }}"
                                    method="POST">
                                    @csrf
                                    <button type="button" class="btn btn-outline-danger w-25" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">Deny</button>

                                    <div class="mt-3">

                                        <textarea class="form-control w-75" id="message-text" name="admin_comment" placeholder="message for deny.."></textarea>
                                    </div>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Denied Message</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">You will deny it and send your message!</label>

                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                            <button name="submit" type="submit" class="btn btn-danger btn-deny">Ok</button>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.btn-deny').on('click', function() {
            let form = $('.my-form'); // Find the closest parent of a given element (in this case, "form")
            form.submit();
        })
    </script>
@endpush
