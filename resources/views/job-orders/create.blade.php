@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card border-0 bg-transparent">
            <form action="{{ route('job-orders.store') }}" method="POST">
                @csrf
                <div class="card-header bg-white border d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('job-orders.index') }}" class="btn border-right mr-2"><i class="fa fa-chevron-left"></i>
                            Back</a>
                        Create Job Order
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                {{ $order }}
                <div class="card-body px-0">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <h6>Basic Info</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="code">Code</label>
                                        <input type="text" class="form-control" id="code"
                                            aria-describedby="codeHelp" name="code" value="{{ $jobOrder->code }}">
                                    </div>
                                    <order-select :orders="{{ $orders }}"></order-select>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
