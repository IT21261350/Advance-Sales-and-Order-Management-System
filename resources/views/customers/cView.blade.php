<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content=width=device-width, initial-scale=1.0>
    <title>Customer View</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('CSS/Style.css') }}">

    <script>

        function redirectToAnotherPage() {
            window.location.href = "{{ route('customer.CustomerRegistration') }}";
        }

        function redirectToAnotherPage1() {
            window.location.href = "{{ route('customer.cView') }}";
        }

        function redirectToAnotherPage2() {
            window.location.href = "{{ route('product.pView') }}";
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
        <a class="navbar-brand" onclick="redirectToAnotherPage1()">Customers</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" onclick="redirectToAnotherPage2()">Products</a>
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

<button onclick="redirectToAnotherPage()" class="btn btn-primary">Add Customer</button>

<br>
<br>

<table class="table">
        <tr>
            <th scope="col">Customer Name</th>
            <th scope="col">Customer Code</th>
            <th scope="col">Address</th>
            <th scope="col">Contact</th>
            <th scope="col">Operation</th>
        </tr>
        @foreach($customers as $customer)
            <tr>
                <td>{{$customer -> name}}</td>
                <td>{{$customer -> id}}</td>
                <td>{{$customer -> address}}</td>
                <td>{{$customer -> contact}}</td>
                <td>
                    <button class="btn btn-success"><a id="bn6" href="{{route('customer.edit', ['customer' => $customer])}}"> Edit </a></button>
                    <form method="post" action="{{route('customer.delete', ['customer' => $customer])}}">
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