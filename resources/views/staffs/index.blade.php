@extends('layouts.app')
@section('content')
    <div class="container-fluid pt-5 pb-3 mb-5 bg-white">
        <div class="d-flex justify-content-between mb-3">
            <form action="{{ route('staffs.index') }}" method="GET" class="w-75 d-flex align-items-center">
                <div class="input-group w-50 mr-2">
                    <input type="search" class="form-control" placeholder="Search staff name..." aria-label="staff code"
                        aria-describedby="search" name="search" value="{{ Request::query()['search'] ?? '' }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-primary"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
            <div>
                <a href="{{ route('staffs.create') }}" class="btn btn-outline-primary">Add Staff +</a>
            </div>
        </div>
        @if ($staffs->isEmpty() && isset(Request::query()['search']))
            <x-empty-list index-route="staffs.index"></x-empty-list>
        @endif
        @if (!$staffs->isEmpty())
            <table class="table border">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Added On</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($staffs as $staff)
                        <tr>
                            <td>{{ $staff->user->name }}</td>
                            <td>{{ $staff->user->email }}</td>
                            <td>{{ $staff->getRole() }}</td>
                            <td>{{ $staff->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('staffs.edit', $staff) }}" class="btn"><i
                                        class="fa text-primary fa-edit"></i></a>
                                @if ($staff->user->id != auth()->user()->id)
                                    <a href="#" class="btn btn-delete" data-toggle="modal" data-target="#deleteModal"
                                        data-id="{{ $staff->id }}"><i class="fa text-danger fa-trash"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center">
                Showing {{ $staffs->firstItem() }} to {{ $staffs->lastItem() }} of total {{ $staffs->total() }} entries
                {{ $staffs->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
        @endif

    </div>
@endsection

@push('modal')
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete staff</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-4 text-center">
                    <div class="rounded-circle bg-danger pt-3 mx-auto mb-2" style="width:54px;height:54px;">
                        <i class="fa fa-trash text-white"></i>
                    </div>
                    <p>Are you sure to delete this staff? This proccess cannot be undo.</p>
                </div>
                <div class="modal-footer">
                    <form id="delete-form" action="{{ route('staffs.destroy', '') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <script>
        $('.btn-delete').on('click', function() {
            $('#delete-form').attr('action', $('#delete-form').attr('action') + '/' + $(this).data('id'))
        })
    </script>
@endpush
