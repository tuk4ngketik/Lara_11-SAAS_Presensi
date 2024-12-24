<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login  </title> 
    <link href="{{asset('vendors')}}/bootstrap5/bootstrap.min.css" rel="stylesheet" >  
    <link rel="stylesheet" href="{{asset('plugins')}}/fontawesome-free/css/all.min.css"> 
    <script src="{{asset('plugins')}}/jquery-3.7.1.min.js"></script> 
    <script src="{{asset('vendors')}}/sweetalerts2/sweetalert2.all.min.js"></script> 
    <link href="{{asset('vendors')}}/sweetalerts2/sweetalert2.min.css" rel="stylesheet" > 
  </head>
<body>
 
<!-- Section: Design Block -->
<section class="">
  <!-- Jumbotron -->
  <div class="px-4 py-5 px-md-5 text-lg-start" style="background-color: hsl(0, 0%, 96%)">
    <div class="container">
      <div class="row gx-lg-5">

        <!-- Banner / Info Text -->
        <div class="col-lg-6 mb-5 mb-lg-0">
          <h1 class="my-5 display-3 fw-bold ls-tight">
            Pengalaman baik  <br />
            <span class="text-primary">untuk bisnis anda</span>
          </h1>
          <p style="color: hsl(217, 10%, 50.8%)">
            "SaAS Presensi" membantu anda untuk mengelola kehadiran karyawan, menetapkan penjadwalan,
            menghitung jarak kehadiran dari lokasi kerja dengan keahlian pengenalan wajah karyawan tanpa 
            harus menekan tombol <i>Capure</i>
          </p>
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5"> 

              <form action="{{url('login_act')}}" method="post" id="form">
                @csrf
                <!-- 2 column grid layout with text inputs for the first and last names --> 
                <!-- <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Login</p> -->
                <p class="text-center fs-3">AttendFace</p>

                <!-- Email input -->  
                <div class="form-floating mb-3">
                  <input type="email" value="{{old('email')}}" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                  <label for="floatingInput">Email address</label> 
                                  <div class="text text-danger email"></div>
                </div>

                <!-- Password input --> 
                <div class="form-floating">
                  <input type="password"  name="password" class="form-control" id="floatingPassword" placeholder="Password">
                  <label for="floatingPassword">Password</label> 
                  <div class="text text-danger password"></div>
                </div>   

                <!-- Submit button -->
                <br>
                <div class="clearfix">  
                    <div class="d-grid gap-2">
                      <button class="btn btn-secondary fs-5" type="submit">Login</button> 
                    </div>

                    <div class="mt-3 text-center">  
                        <a class="btn fs-5 text-primary text-opacity-80" href="{{'daftar'}}">
                            Belum punya akun
                        </a>  
                      <a class="btn fs-5 .text-info-emphasis text-opacity-50" href="{{url('lupapasswd')}}">Lupa kata sandi ?</a> 
                       
                    </div>
                </div>   
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <!-- Jumbotron -->
</section>
<!-- Section: Design Block --> 
   <script src="{{asset('vendors')}}/bootstrap5/bootstrap.bundle.min.js"></script>  
  <script src="{{asset('don')}}/js/hr.js"></script>  
  <script>
      const inputs = [ 'email','password' ]   
      $('#form').submit(function(e) { 
            e.preventDefault();
            _cursorWait();
            var action = $(this).attr('action');
            var formData = $(this).serialize();
            _submitFrom(action, formData, '{{url("beranda")}}', inputs);   
      }); 
  </script> 
</body>
</html>
