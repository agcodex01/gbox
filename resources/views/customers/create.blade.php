@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <form action="{{ route('customers.store') }}" method="POST">
                @csrf

                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('customers.index') }}" class="btn border-right mr-2"><i
                            class="fa fa-chevron-left"></i>
                        Back</a>
                        Create Customer
                    </div>
                   
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="font-weight-bold">Personal Info</h6>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="nameHelp"
                                    name="name" value="{{ $customer->name }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control  @error('address') is-invalid @enderror" id="address" aria-describedby="addressHelp"
                                    name="address" value="{{ $customer->address }}">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <h6 class="font-weight-bold">Contact Info</h6>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" aria-describedby="emailHelp" name="email"
                                    value="{{ $customer->email }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" aria-describedby="phoneHelp"
                                    name="phone" value="{{ $customer->phone }}">
                            </div>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <div class="text-center">
                                <h6 class="font-weight-bold">Products</h6>
                                <img width="200px" class="my-4 mx-auto d-block"
                                    src="{{ asset('img/products.svg') }}" alt="products">
                                <small>Create a new customer to associate products to them.</small>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
