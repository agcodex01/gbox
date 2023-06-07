@extends('layouts.app')
@section('content')
    <div class="container-fluid pt-5 pb-3 mb-5 bg-white">
        <div class="d-flex justify-content-between mb-3">
            <x-search-input placeholder="Search customer name..." index-route="customers.index" />
            <div>
                <a href="{{ route('customers.create') }}" class="btn btn-outline-primary">Add customer +</a>
            </div>
        </div>
        @if ($customers->isEmpty() && Request::query()['search'])
            <x-empty-list index-route="customers.index"></x-empty-list>
        @endif
        @if (!$customers->isEmpty())
            <table class="table border">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Added On</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->user->name }}</td>
                            <td>{{ $customer->user->email }}</td>
                            <td>{{ $customer->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('customers.edit', $customer) }}" class="btn "><i
                                        class="fa text-primary fa-edit"></i></a>
                                <a href="#" class="btn btn-delete" data-toggle="modal" data-target="#deleteModal"
                                    data-id="{{ $customer->id }}"><i class="fa text-danger fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            <div class="d-flex justify-content-between align-items-center">
                Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }} of total {{ $customers->total() }}
                entries
                {{ $customers->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-4') }}
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete customer</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-4 text-center">
                    <div class="rounded-circle bg-danger pt-3 mx-auto mb-2" style="width:54px;height:54px;">
                        <i class="fa fa-trash text-white"></i>
                    </div>
                    <p>Are you sure to delete this customer? This proccess cannot be undo.</p>
                </div>
                <div class="modal-footer">
                    <form id="delete-form" action="{{ route('customers.destroy', '') }}" method="POST">
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
        $('.btn-danger').on('click', function() {
            $('#delete-form').attr('action', $('#delete-form').attr('action') + '/' + $(this).data('id'))
        })
    </script>
@endpush
