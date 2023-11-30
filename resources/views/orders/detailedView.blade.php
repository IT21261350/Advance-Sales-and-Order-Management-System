<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placing Order</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('CSS/Style.css') }}">
    <!-- Ensure the correct path for the CSS file as per your project structure -->
</head>
<body>

<div class="net1">
    <label class="tab1">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Order ID&emsp;</label>
    <input type="text" class="net2" name="quantity" readonly value="&emsp;&emsp;&emsp;&emsp;&emsp;{{ $orders->first()->orderCode ?? '' }}">
    
    <label class="tab1">&emsp;&emsp;&emsp;&emsp;&emsp;Date&emsp;</label>
    <input type="text" class="net2" name="quantity" readonly value="&emsp;&emsp;&emsp;{{ $orders->first()->order_date ?? '' }}">
    
    <label class="tab1">&emsp;&emsp;&emsp;&emsp;&emsp;Time&emsp;</label>
    <input type="text" class="net2" name="quantity" readonly value="&emsp;&emsp;&emsp;&emsp;{{ $orders->first()->order_time ?? '' }}">
</div>

<br>
<br>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Customer Name</th>
            <th scope="col">Product Name</th>
            <th scope="col">Unit Price</th>
            <th scope="col">Discount (%)</th>
            <th scope="col">Quantity</th>
            <th scope="col">Free Quantity</th>
            <th scope="col">NetAmount</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <!-- Display details of each order -->
            <tr>
                <td>{{ $order->cName ?? '' }}</td>
                <td>{{ $order->pProduct ?? '' }}</td>
                <td>Rs.{{ number_format($order->price ?? '', 2) }}</td>
                <td>{{ $order->discount }}%</td>
                <td>{{ $order->quantity ?? '' }}</td>
                <td>{{ $order->freeQty ?? '' }}</td>
                <td>Rs.{{ number_format($order->totalAmt ?? '', 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="net1">
    <!-- Calculating the total amount for the 'totalAmt' column -->
    @php
        $overallTotal = 0;
    @endphp

    @foreach ($orders as $order)
        @php
            $overallTotal += $order->totalAmt ?? 0;
        @endphp
    @endforeach

    <label class="tab1">
        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
        Total&emsp;
    </label>
    <input type="text" class="net2" name="quantity" readonly value="&emsp;&emsp;&emsp;Rs.{{ number_format($overallTotal, 2) }}">
</div>

<br>
<button class="bn8 btn btn-primary"><a id="bn6" href="{{ route('oRder.orderView') }}"> Back </a></button>
<!-- Use the appropriate route name for 'orderView' -->
</body>
</html>
