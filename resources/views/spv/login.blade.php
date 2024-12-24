<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> -->
    
    <link href="{{asset('vendors')}}/bootstrap5/bootstrap.min.css" rel="stylesheet" > 
    <script src="{{asset('plugins')}}/jquery-3.7.1.min.js"></script>
</head>
<body>
<div class="container"> 
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4"> 
            <form action="{{url('login_act')}}" method="post" id="login-form">
                @csrf
                <!-- 2 column grid layout with text inputs for the first and last names --> 
                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Login</p>

                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form3Example3">Email</label>
                <input type="email" id="form3Example3" class="form-control" />
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form3Example4">Kata sandi</label>
                <input type="password" id="form3Example4" class="form-control" />
                </div>


                <!-- Submit button -->
                <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary">
                Login
                </button>
                <a class="btn btn-outline-primary" href="{{'/'}}">Batal</a>  

            </form>
        </div>
        <div class="col-sm-4"></div>
    </div>
 
</div>
 
</body>
</html>