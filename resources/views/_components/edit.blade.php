@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <form action="{{ route('components.store') }}" method="POST">
                @csrf

                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('orders.index') }}" class="btn border-right mr-2"><i class="fa fa-chevron-left"></i>
                            Back</a>
                        Edit Component
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="font-weight-bold">Basic Info</h6>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" aria-describedby="nameHelp"
                                    name="name" value="{{ $component->name }}">
                            </div>
                            <div class="form-group">
                                <label for="board_id">Board</label>
                                <select name="board_id" id="board_id"
                                    class="form-control @error('board_id') is-invalid @enderror">
                                    <option value="0" selected>Select a board</option>
                                    @foreach ($boards as $board)
                                        <option value="{{ $board->id }}"
                                            @if (in_array($board->id, [$component->board_id, old('board_id')])) selected @endif> {{ $board->code }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('board_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <h6 class="font-weight-bold">Ratio</h6>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="is">Is</label>
                                        <input type="number" class="form-control" id="is" aria-describedby="isHelp"
                                            name="is" value="{{ $component->ratio->is ?? old('is') }}">
                                        @error('is')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-1 text-center align-self-center mt-3">
                                    :
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="to">To</label>
                                        <input type="number" class="form-control" id="to" aria-describedby="toHelp"
                                            name="to" value="{{ $component->ratio->to ?? old('to') }}">
                                        @error('to')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                            </div>


                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
