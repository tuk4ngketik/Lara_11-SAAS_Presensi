<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar berhasil</title>
    
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
    

    <!-- <div class="alert alert-success">
        {{ session('status') }}
    </div> -->

      <div class="row  align-items-center">

        <!-- Banner / Info Text -->
        <div class="mb-5 mb-lg-0">
          <h1 class="my-5 display-3 fw-bold ls-tight">
            Terima kasih<br />
            <span class="text-primary">Dapatkan pengalaman baik bersama kami</span>
          </h1>
          <p style="color: hsl(217, 10%, 50.8%)" class='fs-4'> 
            Untuk dapat melanjukan, lakukan verifikasi dengan cara klik pada tautan yang kami berikan pada email anda.
            Batas waktu verifikasi 24jam dari anda mendaftar. 
            <br><br>
          <a href="{{url('login')}}" class="btn btn-outline-success btn-lg">Login</a>
        </div> 

      </div>
    </div>
  </div>
  <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->


  </body>
</html>
