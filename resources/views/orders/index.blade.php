@extends('layouts.app')
@section('content')
    <div class="container-fluid pt-5 pb-3 mb-5 bg-white">
        @if ($lackOfStocks)
            <div class="alert alert-warning d-flex justify-content-between align-items-center" role="alert">
                <strong>Some boards is out of stocks!</strong>
                <a href="#" class="btn btn-sm btn-link">Purchase Now</a>
            </div>
        @endif

        <div class="d-flex justify-content-between mb-3">
            <x-search-input placeholder="Search order id..." index-route="orders.index" />
            <div>
                <a href="{{ route('orders.create') }}" class="btn btn-outline-primary">Add Order +</a>
            </div>
        </div>
        <table class="table border">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Customer</th>
                    <th scope="col">EDD</th>
                    <th scope="col">Status</th>
                    <th scope="col">Products</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td><a href="{{ route('orders.show', $order->id) }}">{{ $order->id }}</a></td>
                        <td>{{ $order->customer->user->name }}</td>
                        <td>{{ $order->estimated_delivery_date->format('d M, Y') }}
                            ({{ $order->estimated_delivery_date->diffForHumans('d') }})
                        </td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->products_count }}</td>
                        <td>
                            <a href="#" class="btn"
                                onclick="navigator.clipboard.writeText('{{ route('orders.show', $order->id) }}'); alert('copied link to order {{ route('orders.show', $order->id) }}')"><i
                                    class="fa text-info fa-copy"></i></a>
                            <a href="#" class="btn"><i class="fa text-primary fa-edit"></i></a>
                            <a href="#" class="btn btn-delete" data-toggle="modal" data-target="#deleteModal"
                                data-id="{{ $order->id }}"><i class="fa text-danger fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        <div class="d-flex justify-content-between align-items-center">
            Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of total {{ $orders->total() }} entries
            {{ $orders->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection

@push('modal')
    <!-- Logout Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete order</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-4 text-center">
                    <div class="rounded-circle bg-danger pt-3 mx-auto mb-2" style="width:54px;height:54px;">
                        <i class="fa fa-trash text-white"></i>
                    </div>
                    <p>Are you sure to delete this order? This proccess cannot be undo.</p>
                </div>
                <div class="modal-footer">
                    <form id="delete-form" action="{{ route('orders.destroy', '') }}" method="POST">
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
