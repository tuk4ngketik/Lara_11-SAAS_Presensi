
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="{{asset('img/logo-60.png')}}">
  <title>@yield('title-web')</title>
    
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

    <!-- DON -->
    <link rel="stylesheet" href="{{asset('don')}}/css/don.css"></script>  

  <script>
      var heightSCreen = $(window).height();  
      var url = "{{url("/")}}" 
    $(document).ready(function(){    
      $('#example').DataTable();
    })
  </script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<!-- Site wrapper -->
<div class="wrapper"> 


@include('layout.nav-header')
 
@include('layout.nav-side')     



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <br>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid"> 
        @yield('content')
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
@include('layout.bottom')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  
</div>
<!-- ./wrapper -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-bg-primary">
        <h5 class="modal-title" id="exampleModalLabel"></h5> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
          <!-- <span aria-hidden="true">&times;</span> -->
        </button>
      </div>
      <div class="modal-body">
        <center><i class="fas fa-circle-notch fa-spin text-blue"></i></center>
      </div>
      <div class="modal-footer"> 
      </div>
    </div>
  </div>
</div>


<!-- Static Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-bg-primary">
        <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <center><i class="fas fa-circle-notch fa-spin text-blue"></i></center>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

 

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
 
<!-- vendors -->
<!-- datatables -->
<script src="{{asset('vendors')}}/bootstrap5/bootstrap.bundle.min.js"></script>  
<script src="{{asset('vendors')}}/datatables/datatables.min.js"></script>  

<script>  
  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
  const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>  
<!-- AdminLTE App --> 
<script src="{{asset('lte')}}/js/adminlte.min.js"></script>  
<script src="{{asset('don')}}/js/hr.js"></script>  
 
@yield('js')

</body>
</html>

 
</body>
</html>