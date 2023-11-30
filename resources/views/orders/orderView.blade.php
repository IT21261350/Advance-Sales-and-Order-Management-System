<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('CSS/Style.css') }}">

    <script>

        function redirectToAnotherPage() {
            window.location.href = "{{ route('order.oView') }}";
        }

        // function generatePDF() {
        //     // Submit the form when Generate PDF button is clicked
        //     $('form#generatePdfForm').submit();
        // }

        function generatePDF() {
            // Submit the form when Generate PDF Order Details button is clicked
            $('form#generatePdfForm').attr('action', "{{ route('oRder.generate.pdf') }}").submit();
        }

        function generatePDFSummary() {
            // Submit the form when Generate PDF Order Summary button is clicked
            $('form#generatePdfForm').attr('action', "{{ route('oRder.generate.summary') }}").submit();
        }

    </script>

</head>
<body>

<h1 class="text-center">Order View Page</h1>

<br>
<br>
<br>

<form id="generatePdfForm" method="post" >
    @csrf
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Order Number</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Order Date</th>
            <th scope="col">Order Time</th>
            <th scope="col">Select</th>
            <th scope="col">Detailed View</th>
        </tr>
        </thead>
        <tbody>
            @php
                $displayedOrderCodes = []; // Array to keep track of displayed order codes
            @endphp

            @foreach ($orders as $order)
                <tr>
                    @if (!in_array($order->orderCode, $displayedOrderCodes))
                        <th scope="row">{{ $order->orderCode }}</th>
                        <td>{{ $order->cName }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>{{ $order->order_time }}</td>
                        <td>
                            <input type="checkbox" name="selected_orders[]" value="{{ $order->orderCode }}">
                        </td>
                        <td>
                            <button class="btn btn-success">
                                <a id="bn6" href="{{ route('oRder.detailedView', ['orderCode' => $order->orderCode]) }}"> View </a>
                            </button>
                        </td>
                        @php
                            $displayedOrderCodes[] = $order->orderCode; // Add displayed orderCode to the array
                        @endphp
                    @else
                    
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <button type="button" onclick="generatePDF()" class="btn btn-primary">Generate PDF Order Details</button>
    <button type="button" onclick="generatePDFSummary()" class="btn btn-primary">Generate PDF Order Summary</button>
    <br>
</form>

<button class="bn8 btn btn-primary"><a id="bn6" onclick="redirectToAnotherPage()"> Back </a></button>

<style>
    .page-break {
        page-break-after: always;
    }
</style>
</body>
</html>
