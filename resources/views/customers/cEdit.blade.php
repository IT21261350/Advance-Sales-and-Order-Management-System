<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content=width=device-width, initial-scale=1.0>
    <title>Customer Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('CSS/Style.css') }}">

</head>
<body>

    <div class="topic">
        <h3> Customer Edit Form </h3>
    </div>

    <div class="container proForm">

        <form action="{{route('customer.update', ['customer' => $customer])}}" method="post">
            @csrf
            @method('put')
            <div class="form-group">
                <p>Customer Name</p>
                <input type="text" class="form-control" name="name" placeholder="Customer Name:" value="{{$customer -> name}}">
            </div>

            <div class="form-group">
                <p>Customer Code</p>
                <input type="text" class="form-control" name="id" placeholder="Customer id:" value="{{$customer -> id}}" readonly>
            </div>

            <div class="form-group">
                <p>Address</p>
                <input type="text" class="form-control" name="address" placeholder="Customer Address:" value="{{$customer -> address}}">
            </div>

            <div class="form-group">
                <p>Contact</p>
                <input type="text" class="form-control" name="contact" placeholder="Customer Contact:" value="{{$customer -> contact}}">
            </div>

            <div class="form-group bn">
                <input type="submit" class="btn btn-primary" value="Update" name="submit">
            </div>

        </form>
    <div>


        <!-- <div class="con">

            <div class="con1">
               <a href = "cView.php"> <input type="submit" class="btn2 btn-primary" value="View" name="View"> </a>
            </div>
        
        </div>     -->

</body>
</html>