@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ route('orders.index') }}" class="btn border-right mr-2"><i class="fa fa-chevron-left"></i>
                        Back</a>
                    Add New Order
                </div>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('orderForm').submit()">Save <i
                        class="fa fa-save ml-1"></i></button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <form action="{{ route('orders.store') }}" method="post" id="orderForm">
                            @csrf
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h6 class="font-weight-bold">Basic Info</h6>
                                </div>
                                <div class="card-body">
                                    <livewire:customer.select :customer="$order->customer" />
                                    <div class="form-group">
                                        <label for="estimated_delivery_date">Estimated Delivery Date</label>
                                        <input type="date" name="estimated_delivery_date" id="estimated_delivery_date"
                                            class="form-control @error('estimated_delivery_date') is-invalid @enderror" value="{{ $order->estimated_delivery_date->format('Y-m-d') ?? old('estimated_delivery_date')}}" />
                                        @error('estimated_delivery_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="customer">Status</label>
                                        <select name="status" id="customer" class="form-control @error('status') is-invalid @enderror" wire:change="onSelect($event.target.value)">
                                            <option value="0" selected>Select a status</option>
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status['key'] }}" @if ($status['key'] == $order->status) selected @endif> {{ $status['display'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <livewire:customer.order-form :customer="$order->customer" />
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header">
                                Customer Info
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                Board Info
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
