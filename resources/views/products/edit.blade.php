@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <form action="{{ route('products.update', $product) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-header bg-white border d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('products.index') }}" class="btn border-right mr-2"><i
                                class="fa fa-chevron-left"></i>
                            Back</a>
                        Create Product
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="font-weight-bold">Personal Info</h6>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" aria-describedby="nameHelp"
                                    name="name" value="{{ $product->user->name ?? old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" aria-describedby="addressHelp"
                                    name="address" value="{{ $product->user->address ?? old('address') }}">
                            </div>
                            <h6 class="font-weight-bold">Contact Info</h6>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                    name="email" value="{{ $product->user->email ?? old('email')}}">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" aria-describedby="phoneHelp"
                                    name="phone" value="{{ $product->user->phone ?? old('phone') }}">
                            </div>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <div class="text-center">
                                <h6 class="font-weight-bold">Products</h6>
                                <img width="50px" class="mb-2 mx-auto d-block"
                                    src="{{ asset('img/undraw_profile_1.svg') }}" alt="">
                                <small>Save a new product to associate product to them.</small>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
