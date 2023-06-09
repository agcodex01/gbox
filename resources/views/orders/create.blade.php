@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card bg-transparent border-0">
            <form action="{{ route('orders.store') }}" method="POST" id="orderForm">
                @csrf
                <div class="card-header bg-white border d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('orders.index') }}" class="btn border-right mr-2"><i class="fa fa-chevron-left"></i>
                            Back</a>
                        Add New Order
                    </div>
                    <button data-toggle="tooltip" title="Disabled tooltip" type="submit" class="btn btn-primary">Save <i
                            class="fa fa-save ml-1"></i></button>
                </div>
                <div class="card-body px-0">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h6 class="font-weight-bold">Basic Info</h6>
                                </div>
                                <div class="card-body">
                                    <customer-select :customers="{{ $customers }}"
                                        :selected-customer-id="{{ $customer?->id ?? (old('customer_id') ?? 0) }}"
                                        @error('customer_id') errors="{{ $message }}" @enderror></customer-select>
                                    <div class="form-group">
                                        <label for="estimated_delivery_date">Estimated Delivery Date</label>
                                        <input type="date" name="estimated_delivery_date" id="estimated_delivery_date"
                                            class="form-control @error('estimated_delivery_date') is-invalid @enderror"
                                            required />
                                        @error('estimated_delivery_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <product-list :selected-customer-id="{{ $customer?->id ?? (old('customer_id') ?? 0) }}">
                            </product-list>

                        </div>
                        <div class="col-md-4">
                            <customer-info :selected-customer-id="{{ $customer?->id ?? (old('customer_id') ?? 0) }}"
                                class="mb-3"></customer-info>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
