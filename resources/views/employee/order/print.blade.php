<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/styles.min.css') }}" />
    <title>Invoice Print</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: small
        }
    </style>
</head>
<body>
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
                    <div>Rider Name: {{ $order->rider->name }}</div>
                    <div>Rider Phone: {{ $order->rider->phone }}</div>
                    @endif
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
                <div class="col-8">
                    <table class="table table-bordered" style="width: 100%;">
                        <tbody>
                            @foreach ($order->transaction as $transaction)
                            <tr>
                                <td class="left">
                                    {{ $transaction->gateway }}
                                </td>
                                <td class="right">
                                    {{ $transaction->amount }} TK
                                </td>
                                <td class="right">
                                    {{ $transaction->transaction_id }}
                                </td>
                                <td class="right">
                                    {{ $transaction->transaction_id }}
                                </td>
                                <td class="right">
                                    {{ date('d M Y', strtotime($transaction->created_at)) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-4 ms-auto">
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
        </div>
    </div>
</body>
</html>