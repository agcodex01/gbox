@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card bg-transparent border-0 ">
            <div class="card-header bg-white border d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ route('orders.index') }}" class="btn border-right mr-2"><i class="fa fa-chevron-left"></i>
                        Back</a>
                    <strong> <em>{{ $order->customer->user->name }} </em></strong> Order
                </div>
            </div>

            <div class="card-body px-0">
                <div class="alert alert-info d-flex justify-content-between align-items-center" role="alert">
                    <div>
                        Status: <span class="badge badge-secondary">
                            {{ $order->status }} </span>
                    </div>

                    <form action="#" method="post">
                        <button type="submit" class="btn btn-sm btn-outline-primary ml-1">Approve</button>
                    </form>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <form action="{{ route('orders.store') }}" method="POST" id="orderForm">
                            @csrf
                            <customer-info class="mb-3" :selected-customer-id="{{ $order->customer_id }}"></customer-info>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <div class="card border-0 bg-transparent">
                            <div
                                class="card-header border bg-primary text-white d-flex justify-content-between align-items-center">
                                <h6 class="m-0">Items</h6>
                                Total: {{ $order->total }}
                            </div>
                            <div class="card-body px-0 pt-2">
                                <div id="accordion">
                                    @foreach ($order->products as $key => $product)
                                        <div class="card p-0 mb-1">
                                            <div class="card-header py-1 d-flex justify-content-between align-items-center"
                                                id="headingOne">
                                                <h6 class="mb-0">
                                                    {{ $product->name }}
                                                </h6>
                                                <button class="btn btn-sm btn-link" data-toggle="collapse"
                                                    data-target="#viewdetail{{ $key }}" aria-expanded="false"
                                                    aria-controls="viewdetail{{ $key }}">
                                                    View Details
                                                </button>
                                            </div>

                                            <div id="viewdetail{{ $key }}" class="collapse"
                                                aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <h6>Components</h6>
                                                            <ol>
                                                                @foreach ($product->components as $component)
                                                                    <li>
                                                                        {{ $component->name }}
                                                                        ({{ $component->getQtyByProductQty($product->pivot->quantity) }})
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <h6>Boards in Components</h6>
                                                            @foreach ($product->components as $key => $component)
                                                                <li class="dropdown">
                                                                    <a href="#" class="btn btn-sm btn-link"
                                                                        id="boardComponent{{ $key }}"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">
                                                                        {{ $component->board->code }}
                                                                        ({{ $component->getBoardQty($product->pivot->quantity) }})
                                                                    </a>
                                                                    <div class="dropdown-menu"
                                                                        aria-labelledby="boardComponent{{ $key }}">
                                                                        <h6 class="dropdown-header">Other Details</h6>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item disabled"
                                                                            href="#"><strong>Type: </strong>
                                                                            {{ $component->board->type }}
                                                                        </a>
                                                                        <a class="dropdown-item disabled"
                                                                            href="#"><strong>Stocks: </strong>
                                                                            {{ $component->board->stocks }}
                                                                        </a>
                                                                        <a class="dropdown-item disabled"
                                                                            href="#"><strong>Dimension: </strong>
                                                                            {{ $component->board->width }} X
                                                                            {{ $component->board->heigth }}
                                                                        </a>
                                                                    </div>

                                                                </li>
                                                            @endforeach
                                                        </div>
                                                        <div class="col-md-4">
                                                            <h6>Board by Product</h6>


                                                            <li class="dropdown">
                                                                <a href="#" class="btn btn-sm btn-link"
                                                                    id="boardByProduct" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    {{ $product->board->code }}
                                                                    ({{ $product->getBoardQty() }})
                                                                </a>
                                                                <div class="dropdown-menu" aria-labelledby="boardByProduct">
                                                                    <h6 class="dropdown-header">Other Details</h6>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item disabled"
                                                                        href="#"><strong>Type: </strong>
                                                                        {{ $product->board->type }}
                                                                    </a>
                                                                    <a class="dropdown-item disabled"
                                                                        href="#"><strong>Stocks: </strong>
                                                                        {{ $product->board->stocks }}
                                                                    </a>
                                                                    <a class="dropdown-item disabled"
                                                                        href="#"><strong>Dimension: </strong>
                                                                        {{ $product->board->width }} X
                                                                        {{ $product->board->heigth }}
                                                                    </a>
                                                                </div>

                                                            </li>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
