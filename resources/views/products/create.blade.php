@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card bg-transparent border-0">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="card-header bg-white border d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('products.index') }}" class="btn border-right mr-2"><i
                                class="fa fa-chevron-left"></i>
                            Back</a>
                        Create Product
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <div class="card-body  border-0 px-0">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="font-weight-bold">Details</h6>
                                </div>
                                <div class="card-body">
                                    <customer-select :customers="{{ $customers }}"
                                        :selected-customer-id="{{ $customer->id ?? (old('customer_id') ?? 0) }}"
                                        @error('customer_id') errors="{{ $message }}" @enderror></customer-select>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="code">Code</label>
                                                <input type="text"
                                                    class="form-control @error('code') is-invalid @enderror" id="code"
                                                    aria-describedby="codeHelp" name="code"
                                                    value="{{ $product->code ?? old('code') }}">
                                                @error('code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="category">Category</label>
                                                <input type="text"
                                                    class="form-control  @error('category') is-invalid @enderror"
                                                    id="category" aria-describedby="categoryHelp" name="category"
                                                    value="{{ $product->category ?? old('category') }}">
                                                @error('category')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
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
                                        <input type="text"
                                            class="form-control  @error('description') is-invalid @enderror"
                                            id="description" aria-describedby="descriptionHelp" name="description"
                                            value="{{ $product->description ?? old('description') }}">
                                        @error('description')
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
                            </div>


                        </div>
                        <div class="col-md-6">
                            <component-list :components="{{ $components }}"></component-list>

                            <div class="card mt-3">
                                <div class="card-header">
                                    <h6 class="font-weight-bold">Board Info</h6>
                                </div>
                                <div class="card-body">
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
                                        <label for="estimate">Qty</label>
                                        <input type="number" class="form-control  @error('estimate') is-invalid @enderror"
                                            id="estimate" aria-describedby="estimateHelp" name="estimate"
                                            value="{{ $product->estimate ?? old('estimate') }}">
                                        @error('estimate')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
