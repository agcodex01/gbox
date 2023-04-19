@extends('layouts.app')
@section('content')
    <div class="container-fluid pt-5 mb-5 bg-white">
        <div class="d-flex justify-content-between mb-3">
            <form action="{{ route('boards.index') }}" method="GET" class="w-75 d-flex align-items-center">
                <div class="input-group w-25 mr-2">
                    <input type="text" class="form-control" placeholder="Search board code..." aria-label="Board code"
                        aria-describedby="search" name="search">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                Show Filter <input type="checkbox"  placeholder="Search board code..." aria-label="Board code"
                aria-describedby="search">
            </form>
            <div>
                <button class="btn btn-outline-primary">Add Board +</button>
            </div>
        </div>
        <table class="table border">
            <thead>
                <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Type</th>
                    <th scope="col">Size</th>
                    <th scope="col">Stocks</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($boards as $board)
                    <tr>
                        <td>{{ $board->code }}</td>
                        <td>{{ $board->type }}</td>
                        <td>{{ $board->size }}</td>
                        <td>{{ $board->stocks }}</td>
                        <td class="w-25">
                            <a href="{{ route('boards.edit', $board)}}" class="btn btn-primary">Edit</a>
                            <a href="#" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        <div class="d-flex justify-content-between align-items-center">
            Showing {{ $boards->firstItem() }} to {{ $boards->lastItem() }} of total {{ $boards->total() }} entries
            {{ $boards->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
