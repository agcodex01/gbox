@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <form action="{{ route('customers.update', $customer) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-header d-flex justify-content-between align-items-center">
                    Update Customer
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="font-weight-bold">Personal Info</h6>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" aria-describedby="nameHelp"
                                    name="name" value="{{ $customer->user->name ?? old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" aria-describedby="addressHelp"
                                    name="address" value="{{ $customer->user->address ?? old('address') }}">
                            </div>
                            <h6 class="font-weight-bold">Contact Info</h6>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                    name="email" value="{{ $customer->user->email ?? old('email') }}">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" aria-describedby="phoneHelp"
                                    name="phone" value="{{ $customer->user->phone ?? old('phone') }}">
                            </div>
                        </div>

                        @if (count($customer->products) > 0)
                            <div class="col-md-6">
                                <h6 class="font-weight-bold">Product Info</h6>
                                <div class="d-flex justify-content-between align-items-end">
                                    List
                                    <div>
                                        <a href="{{ route('orders.create', ['customer_id' => $customer]) }}" class="btn btn-sm btn-outline-info">Create Order</button>
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
                                    <h6 class="font-weight-bold">Products</h6>
                                    <img width="200px" class="my-4 mx-auto d-block"
                                    src="{{ asset('img/products.svg') }}" alt="">
                                    <p>Currently no proucts to this customer. Add one.</p>
                                    <a href="{{ route('products.create') }}?customer_id={{ $customer->id }}"
                                        class="btn btn-sm btn-outline-primary">Add Product</a>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
