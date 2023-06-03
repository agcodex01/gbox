@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card border-0 bg-transparent">
            <form action="{{ route('boards.update', $board) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-header bg-white border d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('boards.index') }}" class="btn border-right mr-2"><i class="fa fa-chevron-left"></i>
                            Back</a>
                        Edit Board
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <div class="card-body px-0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6>Basic Info</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="code">Code</label>
                                        <input type="text" class="form-control" id="code"
                                            aria-describedby="codeHelp" name="code" value="{{ $board->code }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <input type="text" class="form-control" id="type"
                                            aria-describedby="typeHelp" name="type" value="{{ $board->type }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="stocks">Stocks</label>
                                        <input type="number" class="form-control" id="stocks"
                                            aria-describedby="stocksHelp" name="stocks" value="{{ $board->stocks }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="width">Width</label>
                                        <input type="text" class="form-control" id="width"
                                            aria-describedby="widthHelp" name="width" value="{{ $board->width }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="heigth">Heigth</label>
                                        <input type="text" class="form-control" id="heigth"
                                            aria-describedby="heigthHelp" name="heigth" value="{{ $board->heigth }}">
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
