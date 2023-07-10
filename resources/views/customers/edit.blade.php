@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card border-0 bg-transparent">
            <form action="{{ route('customers.update', $customer) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-header bg-white border rounded d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('customers.index') }}" class="btn border-right mr-2"><i
                                class="fa fa-chevron-left"></i>
                            Back</a>
                        Edit Customer
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <div class="card-body px-0 ">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h6 class="font-weight-bold">Personal Info</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" aria-describedby="nameHelp" name="name"
                                            value="{{ $customer->user->name ?? old('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                                            id="address" aria-describedby="addressHelp" name="address"
                                            value="{{ $customer->user->address ?? old('address') }}">
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="font-weight-bold">Contact Info</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" aria-describedby="emailHelp" name="email"
                                            value="{{ $customer->user->email ?? old('email') }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" aria-describedby="phoneHelp" name="phone"
                                            value="{{ $customer->user->phone ?? old('phone') }}">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>




                        </div>

                        @if (count($customer->orders) > 0)
                            <div class="col-md-6">
                                <h6 class="font-weight-bold">Product Info</h6>
                                <div class="d-flex justify-content-between align-items-end">
                                    List
                                    <div>
                                        <a href="{{ route('orders.create', ['customer_id' => $customer]) }}"
                                            class="btn btn-sm btn-outline-info">Create Order</button>
                                            <a href="{{ route('products.create') }}?customer_id={{ $customer->id }}"
                                                class="btn btn-sm btn-outline-primary">Add Product</a>
                                    </div>

                                </div>
                                <ul class="list-group mt-3">
                                    @foreach ($customer->products as $product)
                                        <li class="list-group-item">{{ $product->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <div class="text-center">
                                <h6 class="font-weight-bold">Order Histories</h6>
                                <img width="200px" class="my-4 mx-auto d-block" src="{{ asset('img/products.svg') }}"
                                    alt="">
                                <p>Currently no order to this customer.</p>
                                <a href="{{ route('orders.create') }}?customer_id={{ $customer->id }}"
                                    class="btn btn-sm btn-outline-primary">Add Order</a>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
