@extends('layouts.app')
@section('content')
    <div class="container-fluid pt-5 pb-3 mb-5 bg-white">
        <div class="d-flex justify-content-between mb-3">
            <form action="{{ route('products.index') }}" method="GET" class="w-75 d-flex align-items-center">
                <div class="input-group w-50 mr-2">
                    <input type="text" class="form-control" placeholder="Search product code..." aria-label="product code"
                        aria-describedby="search" name="search">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-primary"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
            <div>
                <a href="{{ route('products.create') }}" class="btn btn-outline-primary">Add product +</a>
            </div>
        </div>
        <div>

        </div>
        <table class="table border">
            <thead>
                <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Category</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->code }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product) }}" class="btn"><i
                                    class="text-primary fa fa-edit"></i></a>
                            <a href="#" class="btn btn-delete" data-toggle="modal" data-target="#deleteModal"
                                data-id="{{ $product->id }}"><i class="fa text-danger fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        <div class="d-flex justify-content-between align-items-center">
            Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of total {{ $products->total() }} entries
            {{ $products->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection

@push('modal')
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete product</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-4 text-center">
                    <div class="rounded-circle bg-danger pt-3 mx-auto mb-2" style="width:54px;height:54px;">
                        <i class="fa fa-trash text-white"></i>
                    </div>
                    <p>Are you sure to delete this product? This proccess cannot be undo.</p>
                </div>
                <div class="modal-footer">
                    <form id="delete-form" action="{{ route('products.destroy', '') }}" method="POST">
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
