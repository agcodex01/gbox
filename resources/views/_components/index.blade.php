@extends('layouts.app')
@section('content')
    <div class="container-fluid pt-5 pb-3 mb-5 bg-white">
        <div class="d-flex justify-content-between mb-3">
            <form action="{{ route('components.index') }}" method="GET" class="w-75 d-flex align-items-center">
                <div class="input-group w-50 mr-2">
                    <input type="text" class="form-control" placeholder="Search component code..."
                        aria-label="component code" aria-describedby="search" name="search">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-primary"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
            <div>
                <a href="{{ route('components.create') }}" class="btn btn-outline-primary">Add component +</a>
            </div>
        </div>
        <div>

        </div>
        <table class="table border">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Board</th>
                    <th scope="col">Ratio</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($components as $component)
                    <tr>
                        <td>{{ $component->id }}</td>
                        <td>{{ $component->name }}</td>
                        <td>{{ $component->board->code }}</td>
                        <td>{{ $component->ratio->is }} : {{ $component->ratio->to }}</td>
                        <td>
                            <a href="{{ route('components.edit', $component) }}" class="btn"><i
                                    class="fa text-primary fa-edit"></i></a>
                            <a href="#" class="btn" data-toggle="modal" data-target="#deleteModal"
                                data-id="{{ $component->id }}"><i class="fa text-danger fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        <div class="d-flex justify-content-between align-items-center">
            Showing {{ $components->firstItem() }} to {{ $components->lastItem() }} of total {{ $components->total() }}
            entries
            {{ $components->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-4') }}
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete component</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-4 text-center">
                    <div class="rounded-circle bg-danger pt-3 mx-auto mb-2" style="width:54px;height:54px;">
                        <i class="fa fa-trash text-white"></i>
                    </div>
                    <p>Are you sure to delete this component? This proccess cannot be undo.</p>
                </div>
                <div class="modal-footer">
                    <form id="delete-form" action="{{ route('components.destroy', '') }}" method="POST">
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
