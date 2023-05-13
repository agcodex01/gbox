@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <form action="{{ route('boards.store') }}" method="POST">
                @csrf

                <div class="card-header d-flex justify-content-between align-items-center">
                    Create Board
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" class="form-control" id="code" aria-describedby="codeHelp"
                                    name="code" value="{{ $board->code }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <input type="text" class="form-control" id="type" aria-describedby="typeHelp"
                                    name="type" value="{{ $board->type }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="width">Width</label>
                        <input type="text" class="form-control" id="width" aria-describedby="widthHelp"
                            name="width" value="{{ $board->width }}">
                    </div>
                    <div class="form-group">
                        <label for="heigth">Heigth</label>
                        <input type="text" class="form-control" id="heigth" aria-describedby="heigthHelp"
                            name="heigth" value="{{ $board->heigth }}">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
