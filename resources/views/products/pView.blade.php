<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content=width=device-width, initial-scale=1.0>
    <title>Product View</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('CSS/Style.css') }}">

    <script>

        function redirectToAnotherPage() {
            window.location.href = "{{ route('product.ProductRegistration') }}";
        }

        function redirectToAnotherPage1() {
            window.location.href = "{{ route('product.pView') }}";
        }

        function redirectToAnotherPage2() {
            window.location.href = "{{ route('customer.cView') }}";
        }

        function redirectToAnotherPage3() {
            window.location.href = "{{ route('freeissue.fView') }}";
        }

        function redirectToAnotherPage4() {
            window.location.href = "{{ route('oRder.discountView') }}";
        }

        function redirectToAnotherPage5() {
            window.location.href = "{{ route('order.oView') }}";
        }

    </script>

</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" onclick="redirectToAnotherPage1()">Products</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" onclick="redirectToAnotherPage2()">Customers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="redirectToAnotherPage3()">Free Issues</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="redirectToAnotherPage4()">Discount</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="redirectToAnotherPage5()">Order Placing</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<br>
<br>

<button onclick="redirectToAnotherPage()" class="btn btn-primary">Add Product</button>

<br>
<br>

<table class="table">
        <tr>
            <th scope="col">Product Name</th>
            <th scope="col">Product Code</th>
            <th scope="col">Price</th>
            <th scope="col">Expiry Date</th>
            <th scope="col">Operation</th>
        </tr>
        @foreach($products as $product)
            <tr>
                <td>{{$product -> proName}}</td>
                <td>{{$product -> proCode}}</td>
                <td>Rs.{{ number_format($product -> price, 2) }}</td>
                <td>{{$product -> exDate}}</td>
                <td>
                    <button class="btn btn-success"><a id="bn6" href="{{route('product.edit', ['product' => $product])}}"> Edit </a></button>
                    <form method="post" action="{{route('product.delete', ['product' => $product])}}">
                        @csrf
                        @method('delete')
                        <button class="bn8 btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
</table>

</body>
</html>