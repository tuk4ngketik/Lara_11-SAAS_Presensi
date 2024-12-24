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
     
  <div class="container-fluid"> 
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <!-- <div class="card text-black" style="border-radius: 25px;"> -->
        <div class=" text-black" style="">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">

              <div class="col-md-10 col-lg-6 col-xl-5 order-1 order-lg-1">
                @if (session('status'))
                  <div class="alert alert-warning">
                      {{ session('status') }}
                  </div>
                @endif
                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Registrasi</p>

                <form class="mx-1 mx-md-4" action="{{url('daftar_act')}}" method="POST" id="form"> 
                    @csrf
 
                  <div class="form-floating mb-3">
                    <input type="" value="{{old('nama_lengkap')}}" name="nama_lengkap" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Nama Lengkap</label>
                                    @error('nama_lengkap')
                                            <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                    <div class="text text-danger nama_lengkap"></div>
                  </div>
                  
                  <div class="form-floating mb-3">
                    <input type="email" value="{{old('email')}}" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email</label>
                                    @error('email')
                                            <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="text text-danger email"></div>
                  </div>
 
                  <div class="form-floating mb-3">
                    <input type="password" value="{{old('password')}}" name="password" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Kata sandi</label>
                                    @error('password')
                                            <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="text text-danger password"></div>
                  </div> 
 
                  <div class="form-floating mb-3">
                    <input type="password" value="{{old('password_confirm')}}" name="password_confirm" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Ulangi Kata sandi</label>
                                    @error('password_confirm')
                                            <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="text text-danger password_confirm"></div>
                  </div>

                  <!-- <div class="form-check d-flex justify-content-center mb-5">
                    <input class="form-check-input  btn-outline-primar me-2" type="checkbox" value="" id="form2Example3c" />
                    <label class="form-check-label" for="form2Example3">
                      I agree all statements in <a href="#!">Terms of service</a>
                    </label>
                  </div> -->

                  <div class="clearfix">
                    <button type="submit"  class="btn btn-primary float-start">Kirim</button> 
                    <span class="float-end">
                      
                      <a class="btn btn-outline-default" href="{{'login'}}">
                          <i class="fas fa-sign-in-alt"></i> Sudah punya akun 
                      </a>
                    </span> 
                  </div>

                </form>

              </div>

              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                  class="img-fluid" alt="Sample image">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
 
    <script src="{{asset('vendors')}}/bootstrap5/bootstrap.bundle.min.js"></script>  
    <script src="{{asset('don')}}/js/hr.js"></script>  
    <script>
        const inputs = [
              'nama_lengkap','email','password','password_confirm' 
          ]   
          
        $('#form').submit(function(e) { 
              e.preventDefault();
              _cursorWait();
              var action = $(this).attr('action');
              var formData = $(this).serialize();
              _submitFromRedirect(action, formData, inputs);   
        }); 
    </script> 
  </body>
</html>
