<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content=width=device-width, initial-scale=1.0>
    <title>Define Free Issues View</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('CSS/Style.css') }}">

    <script>

        function redirectToAnotherPage() {
            window.location.href = "{{ route('freeissue.FreeIssue') }}";
        }

        function redirectToAnotherPage1() {
            window.location.href = "{{ route('freeissue.fView') }}";
        }

        function redirectToAnotherPage2() {
            window.location.href = "{{ route('product.pView') }}";
        }

        function redirectToAnotherPage3() {
            window.location.href = "{{ route('customer.cView') }}";
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
        <a class="navbar-brand" onclick="redirectToAnotherPage1()">Free Issues</a>
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

    <button onclick="redirectToAnotherPage()" class="btn btn-primary">Add Define Free Issues</button>

<br>
<br>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Free Issue Label</th>
            <th scope="col">ID</th>
            <th scope="col">Type</th>
            <th scope="col">Purchase Product</th>
            <th scope="col">Free Product</th>
            <th scope="col">Purchase Quantity</th>
            <th scope="col">Free Quantity</th>
            <th scope="col">Lower Limit</th>
            <th scope="col">Upper Limit</th>
            <th scope="col">Operation</th>
            <!-- ... Other table headers ... -->
        </tr>
    </thead>
    <tbody>
        @foreach($freeissue as $row)
            <tr>
                <th scope="row">{{ $row->fIssue }}</th>
                <td>{{ $row->id }}</td>
                <td>{{ $row->type }}</td>
                <td>{{ $row->pro }}</td>
                <td>{{ $row->fPro }}</td>
                <td>{{ $row->pQuan }}</td>
                <!-- Calculate and display the final count -->
                <td>
                    @php
                        $parts = explode("/", $row->fQuan);
                        if (count($parts) === 2) {
                            $numerator = intval($parts[0]);
                            $denominator = intval($parts[1]);
                            $finalCount = ($numerator / $denominator) * $row->pQuan;
                            echo $finalCount;
                        } else {
                            echo $row->fQuan;
                        }
                    @endphp
                </td>
                <td>{{ $row->lLimit }}</td>
                <td>{{ $row->uLimit }}</td>
                <td>
                    <button class="btn btn-success"><a id="bn6" href="{{ route('freeissue.edit', ['freeissue' => $row->id]) }}"> Edit </a></button>
                    <form method="post" action="{{ route('freeissue.delete', ['freeissue' => $row->id]) }}">
                        @csrf
                        @method('delete')
                        <button class="bn8 btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>