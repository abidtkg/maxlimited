@extends('layouts.admin.master')
@section('page-title', 'Order View - Max Limited')
@section('dashboard-content')
<div class="card">
    <div class="card-header">
        Invoice ID: <strong> {{ $order->id }} </strong>
        <span class="float-end">
            <strong>Status:</strong>
            <span style="text-transform: capitalize;"> {{ $order->status }}</span>
        </span>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-sm-6">
                <h6 class="mb-3">From:</h6>
                <div>
                    <strong>Max Speed</strong>
                </div>
                <div>Kaligong, Bangabondhu Hat</div>
                <div>Jaldhaka Nilphamari</div>
                <div>Website: www.maxspeed.net.bd</div>
                <div>Phone: +880 9639005330</div>
            </div>
            <div class="col-sm-6">
                <h6 class="mb-3">To:</h6>
                <div>
                    <strong> {{ $order->user->name }} </strong>
                </div>
                <div>Invoice Date: <b>{{ date('d M Y', strtotime($order->created_at)) }}</b> </div>
                <div>Phone: {{ $order->user->phone }}</div>
                <div>Invoice ID: <b>{{ $order->id }}</b>  </div>
                @if($order->rider)
                <div class="text-danger">Rider Name: {{ $order->rider->name }}</div>
                <div class="text-danger">Rider Phone: {{ $order->rider->phone }}</div>
                @endif
                </div>
            </div>
        </div>
        <div class="table-responsive-sm">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="center">#</th>
                        <th>Item / Description</th>
                        <th class="right">Unit Cost</th>
                        <th class="center">Qty</th>
                        <th class="right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->products as $product)
                    <tr>
                        <td class="center"> {{ $loop->index + 1 }} </td>
                        <td class="left strong">{{ $product->product->name }}</td>
                        <td class="right"> {{ $product->product->price }} TK </td>
                        <td class="center"> {{ $product->quantity }} </td>
                        <td class="right"> {{ $product->total }} TK </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-lg-8 col-sm-5">
                @if($order->due != 0)
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">ADD PAYMENT</button>
                @endif
                <table class="table table-bordered">
                    <tbody>
                        @foreach ($order->transaction as $transaction)
                        <tr>
                            <td class="left">
                                <strong>{{ $transaction->gateway }}</strong>
                            </td>
                            <td class="right">
                                <strong>{{ $transaction->amount }} TK</strong>
                            </td>
                            <td class="right">
                                <strong>{{ $transaction->transaction_id }}</strong>
                            </td>
                            <td class="right">
                                <strong>{{ $transaction->transaction_id }}</strong>
                            </td>
                            <td class="right">
                                @if($transaction->verified == false)
                                <strong>Verification Pending</strong>
                                @endif
                                @if($transaction->verified == True)
                                <strong>Verified</strong>
                                @endif
                            </td>
                            <td class="right">
                                <strong>{{ date('d M Y', strtotime($transaction->created_at)) }}</strong>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4 col-sm-5 ms-auto">
                <table class="table table-clear">
                    <tbody>
                        <tr>
                            <td class="left">
                                <strong>Subtotal</strong>
                            </td>
                            <td class="right">{{ $order->total_product_price }} TK</td>
                        </tr>
                        <tr>
                            <td class="left">
                                <strong>Delivery Fee</strong>
                            </td>
                            <td class="right">
                                <strong>{{ $order->delivery_fee }} TK</strong>
                            </td>
                        </tr>
                        <tr>
                            <td class="left">
                                <strong>Discount</strong>
                            </td>
                            <td class="right">
                                <strong>-{{ $order->discount }} TK</strong>
                            </td>
                        </tr>
                        <tr>
                            <td class="left">
                                <strong>Total</strong>
                            </td>
                            <td class="right">
                                <strong>{{ $order->payable }} TK</strong>
                            </td>
                        </tr>
                        @if($order->due > 0)
                        <tr class="bg-warning">
                            <td class="left">
                                <strong>Due</strong>
                            </td>
                            <td class="right">
                                <strong>{{ $order->due }} TK</strong>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer">
        NOTE: This is computer generated invoice and does not require physical signature.
        <span class="float-end">
            <a href="{{ route('employee.order.print', $order->id) }}" class="btn btn-dark" target="_blank">PRINT</a>
        </span>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('employee.order.payment.create') }}" method="POST">
            @csrf
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Payment</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="text" class="form-control" id="amount" name="amount">
                    </div>
                    <div class="mb-3">
                        <label for="method" class="form-label">Payment Method</label>
                        <select class="form-select" id="method" name="gateway">
                            <option value="cash">Cash</option>
                            <option value="bkash">Bkash</option>
                            <option value="rocket">Rocket</option>
                            <option value="nagad">Nagad</option>
                            <option value="bank">Bank</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="transaction_id" class="form-label">Transaction ID</label>
                        <input type="text" class="form-control" id="transaction_id" name="transaction_id">
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Note</label>
                        <textarea class="form-control" id="note" name="note"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
