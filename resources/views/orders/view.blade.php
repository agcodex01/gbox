@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card bg-transparent border-0 ">
            <div class="card-header bg-white border">
                <div class="row">
                    <a href="{{ route('orders.index') }}" class="col-md-1 btn border-right "><i class="fa fa-chevron-left"></i>
                        Back</a>
                    <div class="col-md-11 d-flex justify-content-between align-items-center w-100">
                        <strong> <em>{{ $order->customer->user->name }} </em></strong>
                        Estimated Delivery On: {{ $order->estimated_delivery_date->format('D, M d') }}
                    </div>
                </div>
            </div>

            <div class="card-body px-0">
                <div class="rounded border p-3 mb-3 d-flex justify-content-between align-items-center" role="alert">
                    <div>
                        Status: <span class="badge badge-secondary">
                            {{ Str::upper($order->status) }} </span>
                    </div>
                    @if ($order->status === 'PENDING')
                        <form action="{{ route('orders.approve', $order) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-primary ml-1">Approve</button>
                        </form>
                    @elseif ($order->status === 'APPROVED')
                        <form action="{{ route('orders.approve', $order) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-primary ml-1"
                                @if ($lackStocks) disabled @endif>Create Job Order</button>
                        </form>
                    @endif

                </div>
                <div class="row">
                    <div class="col-md-4">

                        <customer-info class="mb-3" :selected-customer-id="{{ $order->customer_id }}"></customer-info>

                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-header text-primary font-weight-bold">
                                Board Summary
                            </div>
                            <div class="card-body py-2">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0 py-2">
                                        <div class="row">
                                            <div class="col-5">
                                                <small><strong>CODE</strong></small>
                                            </div>
                                            <div class="col-3"> <small><strong>OUT</strong></small> </div>
                                            <div class="col-4"> <small><strong>STOCKS</strong></small></div>
                                        </div>
                                    </li>
                                    @foreach ($boards as $key => $value)
                                        <li class="list-group-item px-0 py-2">
                                            <div class="row">
                                                <div class="col-5"> <small>{{ $key }} </small> </div>
                                                <div class="col-3"> <small>{{ transformNumber($value['out'], 2) }}
                                                    </small>
                                                </div>
                                                <div class="col-4"> <small> {{ $value['stocks'] }}
                                                        {!! stocksStatus(transformNumber($value['out'], 2), $value['stocks']) !!}
                                                    </small>
                                                </div>
                                            </div>

                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="card border-0 bg-transparent">
                            <div
                                class="card-header border text-white d-flex justify-content-between align-items-center font-weight-bold text-primary">
                                <h6 class="m-0 font-weight-bold text-primary">Items</h6>
                                Total: {{ $order->total }}
                            </div>
                            <div class="card-body px-0 pt-2">
                                <div id="accordion">
                                    @foreach ($order->products as $key => $product)
                                        <div class="card p-0 mb-1">
                                            <div class="card-header py-1 d-flex justify-content-between align-items-center"
                                                id="headingOne">
                                                <h6 class="m-0 font-weight-bold">
                                                    {{ $product->name }} ({{ $product->pivot->quantity }}pcs)
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
                                                                        ({{ transformNumber($component->getQtyByProductQty($product->pivot->quantity), 2) }})
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <h6>Boards in Components</h6>
                                                            @foreach ($product->components as $key => $component)
                                                                <x-board-info :board="$component->board" :label="$component->board->code .
                                                                    '  (' .
                                                                    transformNumber(
                                                                        $component->getBoardQty(
                                                                            $product->pivot->quantity,
                                                                        ),
                                                                        2,
                                                                    ) .
                                                                    ')'"
                                                                    id="board-component-{{ $key }}" />
                                                            @endforeach
                                                        </div>
                                                        <div class="col-md-4">
                                                            <h6>Board by Product</h6>
                                                            <x-board-info :board="$product->board" :label="$product->board->code .
                                                                '  (' .
                                                                transformNumber($product->getBoardQty(), 2) .
                                                                ')'"
                                                                id="board-product-{{ $key }}" />
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
