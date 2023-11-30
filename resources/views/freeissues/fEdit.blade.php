<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content=width=device-width, initial-scale=1.0>
    <title>Define Free Issues</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('CSS/Style.css') }}">

</head>
<body>

    <div class="topic">
        <h3> Edit Define Free Issue Registration </h3>
    </div>

    <div class="container proForm">

        <form action="{{route('freeissue.update', ['freeissue' => $freeissue])}}" method="post">
            @csrf
            @method('put')
            <div class="form-group">
                    <p>Free Issue Label</p>
                    <input type="text" class="form-control" name="fIssue" placeholder="Free Issue Label:"  
                    value="{{$freeissue -> fIssue}}">
            </div>

            <div class="form-group">
                <p>Already selected type in the database (Readonly)</p>
                <input type="text" class="form-control" name="type" placeholder="Product Type:" readonly
                value="{{$freeissue -> type}}">
            </div>

            <div class="form-group">
                <p>Already selected product in the database (Readonly)</p>
                <input type="text" class="form-control" name="pro" placeholder="Product Type:" readonly
                value="{{$freeissue -> pro}}">
            </div>

            <div class="form-group">
                <p>Already selected free product in the database (Readonly)</p>
                <input type="text" class="form-control" name="fPro" placeholder="Product Type:" readonly
                value="{{$freeissue -> fPro}}">
            </div>

            <div class="form-group">
                <p>Purchase Quantity</p>
                <input type="text" class="form-control" name="pQuan" placeholder="Purchase Quantity:"
                value="{{$freeissue -> pQuan}}">
            </div>

            <div class="form-group">
                <p>Free Quantity</p>
                <input type="text" class="form-control" name="fQuan" placeholder="free quantity:" readonly
                value="{{$freeissue -> fQuan}}">
            </div>

            <div class="form-group">
                <p>Upper Limit</p>
                <input type="text" class="form-control" name="uLimit" placeholder="Upper Limit:"
                value="{{$freeissue -> uLimit}}">
            </div>

            <div class="form-group bn">
                <input type="submit" class="btn btn-primary" value="Update  " name="submit">
            </div>

        </form>
    <div>


</body>
</html>