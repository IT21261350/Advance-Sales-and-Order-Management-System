<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Define Free Issues</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('CSS/Style.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {


            // Event listener for the "pro" dropdown
            $("#proDropdown").change(function() {
                var selectedProduct = $(this).val();
                $("input[name='pro']").val(selectedProduct);
            });

        });

        function redirectToAnotherPage() {
            window.location.href = "{{ route('oRder.discountView') }}";
        }
    </script>
</head>
<body>
    <div class="topic">
        <h3> Add Discount Form </h3>
    </div>

    <div class="container proForm">
        <form action="{{route('oRder.disStore')}}" method="post">
            @csrf
            @method('post')
            <div class="form-group">
                <p>Discount Label</p>
                <input type="text" class="form-control @error('disLabel') is-invalid @enderror" name="disLabel" placeholder="Discount Label:" value="{{ old('disLabel') }}">
                @error('fIssue')
                    <div class="alert alert-danger">{{ "Free Issue Label is required" }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="proDropdown">Purchase Product</label>
                <select name="pro" id="proDropdown" class="form-control @error('pro') is-invalid @enderror">
                    <option value="" selected disabled hidden>Select Product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->proName }}">{{ $product->proName }}</option>
                    @endforeach
                </select>
                @error('pro')
                    <div class="alert alert-danger">{{ "Purchase Product field is required / Selected Product is already add" }}</div>
                @enderror
            </div>

            <div class="form-group">
                <p>Purchase Quantity</p>
                <input type="text" class="form-control @error('proQuan') is-invalid @enderror" name="proQuan" id="proQuan" placeholder="Purchase Quantity:" value="{{ old('proQuan') }}">
                @error('proQuan')
                    <div class="alert alert-danger">{{ "Purchase Quantity field is required" }}</div>
                @enderror
            </div>

            <div class="form-group">

                <p>Discount Amount</p>
                <input type="text" class="form-control @error('dAmt') is-invalid @enderror" name="dAmt" id="dAmt" placeholder="Discount Amount:" value="{{ old('dAmt') }}">
                @error('pQuan')
                    <div class="alert alert-danger">{{ "Purchase Quantity field is required" }}</div>
                @enderror

            </div>


            <div class="form-group bn">
                <input type="submit" class="btn btn-primary" value="ADD" name="submit">
            </div>
        </form>
    </div>

    <div class="con">
        <div class="con1">
            <button onclick="redirectToAnotherPage()" class="btn btn-success">View</button>
        </div>
    </div>
</body>
</html>
