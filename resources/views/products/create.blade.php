@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="card-header d-flex justify-content-between align-items-center">
                    Add New Product
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="font-weight-bold">Basic Info</h6>
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror"
                                    id="code" aria-describedby="codeHelp" name="code"
                                    value="{{ $product->code ?? old('code') }}">
                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" aria-describedby="nameHelp" name="name"
                                    value="{{ $product->name ?? old('name') }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control  @error('description') is-invalid @enderror"
                                    id="description" aria-describedby="descriptionHelp" name="description"
                                    value="{{ $product->description ?? old('description') }}">
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <input type="text" class="form-control  @error('category') is-invalid @enderror"
                                    id="category" aria-describedby="categoryHelp" name="category"
                                    value="{{ $product->category ?? old('category') }}">
                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                    id="price" aria-describedby="priceHelp" name="price"
                                    value="{{ $product->price ?? old('price') }}">
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="font-weight-bold">Board Info</h6>
                            <div class="form-group">
                                <label for="board">Board</label>
                                <select name="board_id" id="board"
                                    class="form-control  @error('board_id') is-invalid @enderror">
                                    <option value="0" selected>Select a board</option>
                                    @foreach ($boards as $id => $name)
                                        <option value="{{ $id }}"> {{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('board_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="estimate">Estimated /pc</label>
                                <input type="number" class="form-control  @error('estimate') is-invalid @enderror"
                                    id="estimate" aria-describedby="estimateHelp" name="estimate"
                                    value="{{ $product->estimate ?? old('estimate') }}">
                                @error('estimate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <h6 class="font-weight-bold">Customer Info</h6>


                            <div class="form-group">
                                <label for="customer">Customer</label>
                                <select name="customer_id" id="customer"
                                    class="form-control @error('customer_id') is-invalid @enderror">
                                    <option value="0" selected>Select a customer</option>
                                    @foreach ($customers as $id => $name)
                                        <option value="{{ $id }}"
                                            @if ($customer?->id == $id) selected @endif> {{ $name }}</option>
                                    @endforeach
                                </select>
                                <small>Note: You cannot change it after you create a product.</small>
                                @error('customer_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
