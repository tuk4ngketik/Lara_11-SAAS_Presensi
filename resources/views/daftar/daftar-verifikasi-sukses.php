<?php
    if (session('status') ==''){
      // return redirect('daftar/daftar');
      return view('daftar/daftar'); 
    }
    ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran</title>
    
    <script src="{{asset('plugins')}}/jquery-3.7.1.min.js"></script>
    <script src="{{asset('vendors')}}/sweetalerts2/sweetalert2.all.min.js"></script>  
     
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('lte')}}/css/adminlte.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('plugins')}}/fontawesome-free/css/all.min.css">
    
    <!-- vendor --> 
    <link href="{{asset('vendors')}}/bootstrap5/bootstrap.min.css" rel="stylesheet" >  
    <link href="{{asset('vendors')}}/datatables/datatables.min.css" rel="stylesheet" >  
    <link href="{{asset('vendors')}}/sweetalerts2/sweetalert2.min.css" rel="stylesheet" > 
</head>
<body>
 
<!-- Section: Design Block -->
<section class="">
  <!-- Jumbotron -->
  <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
    <div class="container">
    

    <div class="alert alert-success">
        {{ session('status') }}
    </div>

      <div class="row  align-items-center">

        <!-- Banner / Info Text -->
        <div class="mb-5 mb-lg-0">
          <h1 class="my-5 display-3 fw-bold ls-tight">
            Terima kasih<br />
            <span class="text-primary">dapatkan pengalaman baik bersama kami</span>
          </h1>
          <p style="color: hsl(217, 10%, 50.8%)"> 
            Untuk dapat melanjukan lakukukan pengecekan Email untuk verifikasi dari 
            link yang kami berikan.
          </p>
          <br>
          <a href="{{url('login')}}" class="btn btn-outline-success btn-lg">Login</a>
        </div> 

      </div>
    </div>
  </div>
  <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
