<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content=width=device-width, initial-scale=1.0>
    <title>Customer Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('CSS/Style.css') }}">

    <script>

        function redirectToAnotherPage1(){
            window.location.href = "{{ route('customer.cView') }}";
        }
        
        </script>

</head>
<body>
    
    
    <div class="topic">
        <h3> Customer Registration </h3>
    </div>
    
    <div class="container proForm">
        
        <form action="{{route('customer.store')}}" method="post">
            @csrf
            @method('post')
            <div class="form-group">
                <p>Customer Name</p>
                <input type="text" class="form-control" name="name" placeholder="Customer Name:">
            </div>
            
            <div class="form-group">
                <p>Address</p>
                <input type="text" class="form-control" name="address" placeholder="Customer Address:">
            </div>
            
            <div class="form-group">
                <p>Contact</p>
                <input type="text" class="form-control" name="contact" placeholder="Customer Contact:">
            </div>
            
            <div class="form-group bn">
                <input type="submit" class="btn btn-primary" value="ADD" name="submit">
            </div>
            
        </form>

            <br>

        <div class="con">
            <div class="con1">
                <button onclick="redirectToAnotherPage1()" class="btn btn-success">Back</button>
            </div>
        </div>
        
    </div>

            
</body>
</html>