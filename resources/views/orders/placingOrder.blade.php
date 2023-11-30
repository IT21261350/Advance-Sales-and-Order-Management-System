<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Placing Order</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
        $(document).ready(function() {

            // Functions Creating Part

            function updateProductCode(selectedProduct, productCodeInput) {
                $.ajax({
                    url: "{{ route('order.getProductCode') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        product: selectedProduct
                    },
                    success: function(response) {
                        productCodeInput.val(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Log the error for debugging
                    }
                });
            }
            
            
            
            function updateProductPrice(selectedProduct, priceInput) {
                $.ajax({
                    url: "{{ route('order.getProductPrice') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        product: selectedProduct
                    },
                    success: function(response) {
                        priceInput.val(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Log the error for debugging
                    }
                });
            }

            function updateProductDiscountLimit(selectedProduct, discountLimitInput) {
                $.ajax({
                    url: "{{ route('order.getDiscountLimit') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        product: selectedProduct
                    },
                    success: function(discountLimitResponse) {
                        // Check if response is valid
                        if (discountLimitResponse !== null && !isNaN(discountLimitResponse)) {
                            discountLimitInput.val(discountLimitResponse);
                        } else {
                            // If response is not valid, set discountLimitInput value to 0
                            discountLimitInput.val(0);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Log the error for debugging
                        // Set discountLimitInput value to 0 in case of an error
                        discountLimitInput.val(0);
                    }
                });
            }


            function updateProductDiscount(selectedProduct, discountInput) {
                $.ajax({
                    url: "{{ route('order.getProductDiscount') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        product: selectedProduct
                    },
                    success: function(productDiscount) {
                        // Check if productDiscount is valid
                        if (productDiscount !== null && !isNaN(productDiscount)) {
                            discountInput.val(productDiscount);
                        } else {
                            // If productDiscount is not valid, set discountInput value to 0
                            discountInput.val(0);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Log the error for debugging
                        // Set discountInput value to 0 in case of an error
                        discountInput.val(0);
                    }
                });
            }

            function updateFreeQuantity(selectedProduct, freeInput, pQuanInput) {
                $.ajax({
                    url: "{{ route('order.getFreeQuantity') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        product: selectedProduct
                    },
                    success: function(response) {
                        // Check if response is valid
                        if (response !== null && response !== undefined) {
                            freeInput.val(response);

                            if (response.includes("/")) {
                                var parts = response.split("/");
                                var valOne = parseInt(parts[0]); // Convert the numerator to an integer
                                var valTwo = parseInt(parts[1]);
                                var originalVal = parseInt(pQuanInput.val());
                                        
                                // Calculate the ratio
                                var ratio = valOne / valTwo;
                                        
                                // Calculate the rounded down value
                                var roundedValue = Math.floor(originalVal / valTwo) * valTwo;
                                        
                                // Calculate the final count
                                var finalCount = Math.floor(ratio * roundedValue);
                                        
                                // Display the calculated value in the freeQuan input field of the current row
                                freeInput.val(finalCount);
                            }
                        } else {
                            // If response is not valid, set freeInput value to 0
                            freeInput.val(0);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Log the error for debugging
                        // Set freeInput value to 0 in case of an error
                        freeInput.val(0);
                    }
                });
            }



            function getFreeQuantityAndUpperLimit(selectedProduct, freeInput, pQuanInput) {
                $.ajax({
                    url: "{{ route('order.getUpperLimit') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        product: selectedProduct
                    },
                    success: function(upperLimitResponse) {
                        // Check if upperLimitResponse is valid
                        if (upperLimitResponse !== null && !isNaN(upperLimitResponse)) {
                            // Assuming 'order.getFreeQuantity' as the endpoint for free quantity retrieval
                            $.ajax({
                                url: "{{ route('order.getFreeQuantity') }}",
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    product: selectedProduct
                                },
                                success: function(freeQuantityResponse) {
                                    // Check if freeQuantityResponse is valid
                                    if (freeQuantityResponse !== null && freeQuantityResponse !== undefined) {
                                        freeInput.val(freeQuantityResponse);

                                        if (freeQuantityResponse.includes("/")) {
                                            var parts = freeQuantityResponse.split("/");
                                            var valOne = parseInt(parts[0]); // Convert the numerator to an integer
                                            var valTwo = parseInt(parts[1]);
                                            var originalVal = parseInt(upperLimitResponse);

                                            // Calculate the ratio
                                            var ratio = valOne / valTwo;

                                            // Calculate the rounded down value
                                            var roundedValue = Math.floor(originalVal / valTwo) * valTwo;

                                            // Calculate the final count
                                            var finalCount = Math.floor(ratio * roundedValue);

                                            // Display the calculated value in the freeInput field
                                            freeInput.val(finalCount);
                                        }
                                    } else {
                                        // If freeQuantityResponse is not valid, set freeInput value to 0
                                        freeInput.val(0);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                    // Set freeInput value to 0 in case of an error
                                    freeInput.val(0);
                                }
                            });
                        } else {
                            // If upperLimitResponse is not valid, set freeInput value to 0
                            freeInput.val(0);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Set freeInput value to 0 in case of an error
                        freeInput.val(0);
                    }
                });
            }



            function checkAndUpdateQuantityLimits(selectedProduct, freeInput, pQuanInput) {
                $.ajax({
                    url: "{{ route('order.getLowerLimit') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        product: selectedProduct
                    },
                    success: function(lowerLimitResponse) {
                        // Check if lowerLimitResponse is valid
                        if (lowerLimitResponse !== null && !isNaN(lowerLimitResponse)) {
                            $.ajax({
                                url: "{{ route('order.getUpperLimit') }}",
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    product: selectedProduct
                                },
                                success: function(upperLimitResponse) {
                                    // Check if upperLimitResponse is valid
                                    if (upperLimitResponse !== null && !isNaN(upperLimitResponse)) {
                                        var lowerLimit = parseInt(lowerLimitResponse);
                                        var upperLimit = parseInt(upperLimitResponse);
                                        var enteredQuantity = parseInt(pQuanInput.val());

                                        if (enteredQuantity < lowerLimit) {
                                            freeInput.val(0);
                                        }
                                        if (enteredQuantity > upperLimit) {
                                            getFreeQuantityAndUpperLimit(selectedProduct, freeInput, pQuanInput);
                                        }
                                        if (enteredQuantity >= lowerLimit && enteredQuantity <= upperLimit) {
                                            updateFreeQuantity(selectedProduct, freeInput, pQuanInput);
                                        }
                                    } else {
                                        // If upperLimitResponse is not valid, set freeInput value to 0
                                        freeInput.val(0);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });
                        } else {
                            // If lowerLimitResponse is not valid, set freeInput value to 0
                            freeInput.val(0);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Set freeInput value to 0 in case of an error
                        freeInput.val(0);
                    }
                });
            }

            // Uses of Functions

            $(document).on('change', '.productDropdown', function() {
                var selectedProduct = $(this).val();
                var currentRow = $(this).closest('tr');

                updateProductCode(selectedProduct, currentRow.find(".productCode"));
                updateProductPrice(selectedProduct, currentRow.find(".price"));
                updateProductDiscountLimit(selectedProduct, currentRow.find(".discountLimit"))
                updateProductDiscount(selectedProduct, currentRow.find(".discount"));
            });

            $(document).on('change', '.pQuan', function() {
                var currentRow = $(this).closest('tr');
                var selectedProduct = currentRow.find(".productDropdown").val();
                var pQuanInput = currentRow.find(".pQuan");
                var freeInput = currentRow.find(".freeQuan");

                checkAndUpdateQuantityLimits(selectedProduct, freeInput, pQuanInput);
            });

            function updateAmount(quantityInput, priceInput, discountLimitInput, discountInput, amountInput) {
                var quantity = parseInt(quantityInput.val()) || 0;
                var price = parseFloat(priceInput.val()) || 0;
                var limit = parseFloat(discountLimitInput.val()) || 0;
                var discount = parseFloat(discountInput.val()) || 0;

                var amount = 0; // Initialize amount outside the condition

                if (limit <= quantity) {
                    var amount1 = quantity * price;
                    var amount2 = (amount1 * discount) / 100;
                    amount = amount1 - amount2;
                } else {
                    amount = quantity * price; // Set the amount without discount if limit condition is not met
                }

                amountInput.val(amount.toFixed(2));
            }

            $(document).on('change', '.pQuan', function() {
                var currentRow = $(this).closest('tr');
                var quantityInput = currentRow.find(".pQuan");
                var priceInput = currentRow.find(".price");
                var discountLimitInput = currentRow.find(".discountLimit"); // Add the discountLimit input selector
                var discountInput = currentRow.find(".discount");
                var amountInput = currentRow.find(".amount");

                updateAmount(quantityInput, priceInput, discountLimitInput, discountInput, amountInput);
            });

            // Dynamic Table Creation
            
            $("#add").click(function () {
                let i = $('.sl').length + 1;
                let html = '<tr>' +
                            '<td>' +
                            '<input type="text" class="form-control sl" name="no[]" value="' + i + '" readonly>' +
                            '</td>' +
                            '<td>' +
                            '<select name="prod[]" id="pr_name' + i + '" class="productDropdown">' +
                            '<option value="" selected disabled hidden>Select Product</option>'+
                            '@foreach($products as $product)'+
                            '<option value="{{ $product->proName }}">{{ $product->proName }}</option>'+
                            '@endforeach'+
                            '</select>' +
                            '</td>' +
                            '<td><input type="text" name="proCode[]" id="pc' + i + '" class="productCode" placeholder="" readonly></td>' +
                            '<td><input type="text" name="price[]" id="pr' + i + '" class="price" placeholder="" readonly></td>' +
                            '<td><input type="text" name="discountLimit[]" id="dcl' + i + '" class="discountLimit" placeholder="" readonly></td>'+
                            '<td><input type="text" name="discount[]" id="dc' + i + '" class="discount" placeholder="" readonly></td>'+
                            '<td><input type="text" name="pQuan[]" id="pq' + i + '" class="pQuan" placeholder=""></td>' +
                            '<td><input type="text" name="freeQuan[]" id="fq' + i + '" class="freeQuan" placeholder="" readonly></td>' +
                            '<td><input type="text" name="amount[]" id="am' + i + '" class="amount" placeholder="" readonly></td>' +
                            '<td><button class="btn btn-danger remove" type="button" name="remove">Remove</button></td>' +
                            '</tr>';

                $("#table_field").append(html);
                i++;
            });

            $("#table_field").on('click', '.remove', function () {
                $(this).closest('tr').remove();
                i--;
            });

            
        });
        
        function redirectToAnotherPage() {
            window.location.href = "{{ route('order.oView') }}";
        }

    </script>
</head>
<body>
    <div class="container">
        <form class="insert-form" id="insert_form" action="{{route('order.store')}}" method="post">
        @csrf
        @method('post')
            <hr>
            <h1 class="text-center">Placing Order</h1>
            <hr>

            <div class="form-group">
                <h5>Customer Name</h5>
                <select class="form-control" name="name[]">
                    <option value="" selected disabled hidden>Select Name</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->name }}">{{ $customer->name }}</option>
                            @endforeach
                </select>
            </div>

            <br>
            <br>

            <div class="input-field">
                <table class="table table-bordered" id="table_field">
                    <tr>
                        <!-- <th>Customer Name</th> -->
                        <th>Count</th>
                        <th>Product Name</th>
                        <th>Product Code</th>
                        <th>Price</th>
                        <th>Discount Limit</th>
                        <th>Discount (%)</th>
                        <th>Quantity</th>
                        <th>Free quantity</th>
                        <th>Amount</th>
                    </tr>

                        <tr>
                        <td>
                            <input type="text" class="form-control sl" name="no[]" id="no" value="1" readonly="">
                        </td>
                        <td>
                            <select name="prod[]" id="pr_name" class="productDropdown">
                            <option value="" selected disabled hidden>Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->proName }}">{{ $product->proName }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" name="proCode[]" id="pc" class="productCode" placeholder="" readonly></td>
                        <td><input type="text" name="price[]" id="pr" class="price" placeholder="" readonly></td>
                        <td><input type="text" name="discountLimit[]" id="dcl" class="discountLimit" placeholder="" readonly></td>
                        <td><input type="text" name="discount[]" id="dc" class="discount" placeholder="" readonly></td>
                        <td><input type="text" name="pQuan[]" id="pq" class="pQuan" placeholder="" ></td>
                        <td><input type="text" name="freeQuan[]" id="fq" class="freeQuan" placeholder="" readonly></td>
                        <td><input type="text" name="amount[]" id="am" class="amount" placeholder="" readonly></td>
                        <td><input class="btn btn-warning" type="button" name="add" id="add" value="Add"></td>
                    </tr>
                </table>
                <center>
                    <td><input class="btn btn-success" type="submit" name="save" id="save" value="Save Data"></td>
                </center>
            </div>
        </form>

        <div class="con">
            <div class="con1">
                <button onclick="redirectToAnotherPage()" class="btn btn-primary">View</button>
            </div>
        </div>

    </div>
</body>
</html>