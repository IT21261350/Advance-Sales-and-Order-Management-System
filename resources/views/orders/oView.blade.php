<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placing Order View</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('CSS/Style.css') }}">

    <script>

        function redirectToAnotherPage() {
            window.location.href = "{{ route('order.placingOrder') }}";
        }

        function redirectToAnotherPage1() {
            window.location.href = "{{ route('order.oView') }}";
        }

        function redirectToAnotherPage2() {
            window.location.href = "{{ route('product.pView') }}";
        }

        function redirectToAnotherPage3() {
            window.location.href = "{{ route('customer.cView') }}";
        }

        function redirectToAnotherPage4() {
            window.location.href = "{{ route('freeissue.fView') }}";
        }

        function redirectToAnotherPage5() {
            window.location.href = "{{ route('oRder.discountView') }}";
        }

        function redirectToAnotherPage6() {
            window.location.href = "{{ route('oRder.orderView') }}";
        }

    </script>

</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" onclick="redirectToAnotherPage1()">Order Placing</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" onclick="redirectToAnotherPage2()">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="redirectToAnotherPage3()">Customers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="redirectToAnotherPage4()">Free Issues</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="redirectToAnotherPage5()">Discount</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<br>
<br>

<button onclick="redirectToAnotherPage()" class="btn btn-primary"> Placing Order </button>

<br>
<br>

<table class="table">
    <thead>
        <tr>
        <th scope="col">Customer Name</th>
        <th scope="col">Product Name</th>
        <th scope="col">Order ID</th>
        <th scope="col">Price</th>
        <th scope="col">Discount Limit</th>
        <th scope="col">Discount (%)</th>
        <th scope="col">Product Quantity</th>
        <th scope="col">Free Quantity</th>
        <th scope="col">Amount</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($orders as $order)
            <tr>
                <th scope="row">{{ $order->cName }}</th>
                <td>{{ $order->pProduct }}</td>
                <td>{{ $order->orderCode }}</td>
                <td>Rs.{{ number_format($order->price, 2) }}</td>
                <td>{{ $order->discountLimit }}</td>
                <td>{{ $order->discount }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->freeQty }}</td>
                <td>Rs.{{ number_format($order->totalAmt, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

    <br>
    <div class="net1">
        <label class="tab1">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                    Net Amount&emsp;
        </label>
        <input type="text" class="net2" name="quantity" readonly value="&emsp;&emsp;&emsp;Rs.{{ number_format($netAmo, 2) }}">
    </div>
    <br>

    <form action="{{ route('order.convertEx') }}" method="post">
        @csrf <!-- Add this line to include CSRF token -->
        <button name="submit" class="bn8 btn btn-success">Print</button>
    </form>

    <button class="bn8 btn btn-primary"><a id="bn6" onclick="redirectToAnotherPage6()"> Order View </a></button>

</body>
</html>