<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content=width=device-width, initial-scale=1.0>
    <title>Product Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('CSS/Style.css') }}">

    <link> 
    <link>

</head>
<body>

    <div class="topic">
        <h3> Product Edit Form </h3>
    </div>

    <div class="container proForm">

        <form action="{{route('product.update', ['product' => $product])}}" method="post">
            @csrf
            @method('put')
            <div class="form-group">
                <p>Product Name</p>
                <input type="text" class="form-control" name="proName" placeholder="Product Name:" value="{{$product -> proName}}">
            </div>

            <div class="form-group">
                <p>Product Code</p>
                <input type="text" class="form-control" name="proCode" placeholder="Product Code:" value="{{$product -> proCode}}">
            </div>

            <div class="form-group">
                <p>Price</p>
                <input type="text" class="form-control" name="price" placeholder="Price:" value="{{$product -> price}}">
            </div>

            <div class="form-group">
                <p>Expiry Date</p>
                <input type="date" class="form-control" name="exDate" value="{{$product -> exDate}}">
            </div>

            <div class="form-group bn">
                <input type="submit" class="btn btn-primary" value="Update" name="submit">
            </div>

        </form>

    </div>


        

</body>
</html>