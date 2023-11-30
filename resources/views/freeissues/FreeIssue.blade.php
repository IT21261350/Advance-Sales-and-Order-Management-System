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
            // Hide all fields initially
            $("#fQuan, #fQuan1, #fQuan3, #fQuan2, #fQuan5, #t1, #t2, #t3, #t4").hide();

            // Add change event listener to the 'type' dropdown
            $("select[name='type']").change(function() {
                var selectedType = $(this).val();
                if (selectedType === "Flat") {
                    $("#fQuan, #t1").show();
                    $("#fQuan1, #fQuan2, #fQuan3, #fQuan5, #t2, #t3, #t4").hide();
                } else if (selectedType === "Multiple") {
                    $("#fQuan1, #fQuan2, #fQuan3, #fQuan5, #t2, #t3, #t4").show();
                    $("#fQuan, #t1").hide();
                } else {
                    // Handle other cases if needed
                    $("#fQuan, #fQuan1, #fQuan2, #fQuan3, #fQuan5, #t1, #t2").hide();
                }
            });

            // Event listener for the "pro" dropdown
            $("#proDropdown").change(function() {
                var selectedProduct = $(this).val();
                $("input[name='pro']").val(selectedProduct);
            });

            $(document).ready(function() {
                // Event listener for the "pro" dropdown
                $("#proDropdown").change(function() {
                var selectedProduct = $(this).find(":selected").text(); // Get the text of the selected option
                // Update the fPro input field and the display container
                    $("input[name='fPro']").val(selectedProduct);
                    $("#selectedProduct").text(selectedProduct);
                });
            });

            $("#pQuan").on('input', function() {
                var pQuanVal = $(this).val(); // Get the value from the input field
                $("#fQuan2").val(pQuanVal); // Set the value of #fQuan2 to the value of #pQuan
            });

            $("#fQuan1, #fQuan2, #pQuan").on('input', function() {
                // Recalculate fQuan0 based on fQuan1 and fQuan2 values
                var fQuan1Val = ($("#fQuan1").val());
                var fQuan2Val = ($("#fQuan2").val());
                var pQuanVal = ($("#pQuan").val());

                if (!isNaN(fQuan1Val) && !isNaN(fQuan2Val) && !isNaN(pQuanVal) && fQuan2Val !== 0) {
                    var fQuan0 = (fQuan1Val / fQuan2Val) * pQuanVal; // Recalculate fQuan0
                    $("#fQuan3").val(fQuan0); // Display fQuan0 in fQuan3 input field
                } else {
                    $("#fQuan3").val(''); // Clear fQuan3 if inputs are invalid
                }
            });

            $("#fQuan1, #fQuan2").on('input', function() {
                var fQuan1Val = $("#fQuan1").val();
                var fQuan2Val = $("#fQuan2").val();
                
                if (fQuan1Val && fQuan2Val) {
                    var fQuan5 = fQuan1Val + '/' + fQuan2Val; // Create the string in the format "1/10"
                    $("#fQuan5").val(fQuan5); // Display fQuan0 in fQuan3 input field
                } else {
                    $("#fQuan5").val(''); // Clear fQuan3 if inputs are empty
                }
            });
        });

        function redirectToAnotherPage() {
            window.location.href = "{{ route('freeissue.fView') }}";
        }
    </script>
</head>
<body>
    <div class="topic">
        <h3> Add Define Free Issues Form </h3>
    </div>

    <div class="container proForm">
        <form action="{{route('freeissue.store')}}" method="post">
            @csrf
            @method('post')
            <div class="form-group">
                <p>Free Issue Label</p>
                <input type="text" class="form-control @error('fIssue') is-invalid @enderror" name="fIssue" placeholder="Free Issue Label:" value="{{ old('fIssue') }}">
                @error('fIssue')
                    <div class="alert alert-danger">{{ "Free Issue Label is required" }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" class="form-control @error('type') is-invalid @enderror">
                    <option value="" selected disabled hidden>Select Flat/Multiple</option>
                    <option value="Flat">Flat</option>
                    <option value="Multiple">Multiple</option>
                </select>
                @error('type')
                    <div class="alert alert-danger">{{ "Type field is required" }}</div>
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
                <p>Free Product</p>
                <div id="selectedProduct" class="form-control">Free Product</div>
            </div>

            <div class="form-group">
                <p>Purchase Quantity</p>
                <input type="text" class="form-control @error('pQuan') is-invalid @enderror" name="pQuan" id="pQuan" placeholder="Purchase Quantity:">
                @error('pQuan')
                    <div class="alert alert-danger">{{ "Purchase Quantity field is required" }}</div>
                @enderror
            </div>

            <div class="form-group">
                <p id="t1">Free Quantity (Flat)</p>
                <input type="text" name="fQuan" placeholder="Free Flat quantity:" id="fQuan">
            </div>

            <div class="form-group">
                <p id="t2">Free Quantity (Multiple)</p>
                <input type="text" name="fQuan1" placeholder="Ex: (2/ ? )" id="fQuan1">
                <input type="text" name="fQuan2" placeholder="Ex: ( ? /100)" id="fQuan2" readonly>
            </div>
            
            <div class="form-group">
                <p id="t3">Calculation (Multiple)</p>
                <input type="text" name="fQuan5" placeholder="Calculation" id="fQuan5" readonly>
            </div>
            
            <div class="form-group">
                <p id="t4">Calculated Free Quantity (Multiple)</p>
                <input type="text" name="fQuan3" placeholder="Calculated Free Quantity" id="fQuan3" readonly>
            </div>
            
            <div class="form-group">
                <p>Upper Limit</p>
                <input type="text" class="form-control @error('uLimit') is-invalid @enderror" name="uLimit" placeholder="Upper Limit:">
                @error('uLimit')
                    <div class="alert alert-danger">{{ "Upper Limit field is required" }}</div>
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
