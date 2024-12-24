

  <!-- Main Sidebar Container -->

  <aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
  <!-- <aside class="main-sidebar main-sidebar-custom  elevation-4" style="background-color:black"> --> 

    <!-- Brand Logo -->

    <a href="#" class="brand-link">
	    <img src="{{asset('images/logo-100.jpg')}}" class="brand-image elevation-3" style="opacity:"/>   
      <span class="brand-text font-weight-light">SAAS Presensi</span> 
    </a>
     

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex"> 
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->nama}}</a>
        </div>
      </div>
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"> 
  
           
          <li class="nav-item @yield('nav-item')">
            <a href="{{url('beranda')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Perusahaan</p>
            </a>
          </li> 
          
          <li class="nav-item"> <hr> </li>  
          <!-- Presensi -->
          <li class="nav-item @yield('nav-item-presensi')">
              <a href="#" class="nav-link  @yield('menu-open-presensi')"> 
                <i class="nav-icon  fas fa-user-check"></i>
                <p>Presensi<i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview ml-3">
                <li class="nav-item">
                  <a href="{{url('master-cuti')}}" class="nav-link @yield('menu-open-master-cuti')"> 
                    <p>Master Cuti</p> 
                  </a>
                </li>  
                <li class="nav-item">
                  <a href="{{url('jenis-cuti')}}" class="nav-link @yield('menu-open-presensi-jenis-cuti')"> 
                    <p>Pengaturan Cuti</p> 
                  </a>
                </li>  
                <li class="nav-item">
                  <a href="{{url('presensi')}}" class="nav-link  @yield('menu-open-presensi-list')">
                    <p>Kehadiran</p> 
                  </a>
                </li>   
                <li class="nav-item">
                  <a href="{{url('cuti')}}" class="nav-link  @yield('menu-open-cuti-list')">
                    <p>Cuti</p> 
                  </a>
                </li>   
                <li class="nav-item">
                  <a href="{{url('sakit')}}" class="nav-link  @yield('menu-open-sakit-list')">
                    <p>Sakit</p> 
                  </a>
                </li>   
              </ul>
          </li>   

           
          <li class="nav-item"> <hr> </li>  
          <!-- DEpartemen -->
          <li class="nav-item @yield('nav-item-department')">
              <a href="#" class="nav-link  @yield('menu-open-department')"> 
                  <i class="nav-icon fas fa-window-restore"></i>
                <p>Departemen<i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview ml-3">
                <li class="nav-item">
                  <a href="{{url('buat-department')}}" class="nav-link @yield('menu-open-department-add')"> 
                    <p>Buat Departemen</p> 
                  </a>
                </li>  
                <li class="nav-item">
                  <a href="{{url('department')}}" class="nav-link  @yield('menu-open-department-list')">
                    <p>Daftar Departemen</p> 
                  </a>
                </li>  
                <li class="nav-item">
                  <a href="{{url('divisi')}}" class="nav-link  @yield('menu-open-divisi-list')">
                    <p>Daftar Divisi</p> 
                  </a>
                </li>  
              </ul>
          </li>   
             
          <!-- Jabatan -->
          <li class="nav-item  @yield('nav-item-jabatan')">
              <a href="#" class="nav-link  @yield('menu-open-jabatan')"> 
                <i class="nav-icon fas fa-layer-group"></i>
                <p>
                  Jabatan
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview ml-3">
                <li class="nav-item">
                  <a href="{{url('buat-jabatan')}}" class="nav-link @yield('menu-open-jabatan-add')"> 
                    <p>Buat Jabatan</p> 
                  </a>
                </li>  
                <li class="nav-item">
                  <a href="{{url('jabatan')}}" class="nav-link  @yield('menu-open-jabatan-list')">
                    <p>Daftar Jabatan</p> 
                  </a>
                </li>  
              </ul>
          </li>  

             
          <!-- KAryawan -->
          <li class="nav-item  @yield('nav-item-karyawan')">
            <a href="#" class="nav-link  @yield('menu-open-karyawan')">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Karyawan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview pl-3">
              <li class="nav-item">
                <a href="{{url('tambah-karyawan')}}" class="nav-link @yield('menu-open-karyawan-add')"> 
                  <p>Tambah Karyawan</p> 
                </a>
              </li>  
              <li class="nav-item">
                <a href="{{url('karyawan')}}" class="nav-link  @yield('menu-open-karyawan-list')">
                  <p>Daftar Karyawan</p> 
                </a>
              </li>  
              <li><hr></li>
              <li class="nav-item">
                <a href="{{url('karyawan-jadwal')}}" class="nav-link  @yield('menu-open-karyawan-jadwal')">
                  <p>Jadwal Karyawan</p> 
                </a> 
              </li>  
            </ul>
          </li>   
                     
           <li class="nav-header"><h5><i class="fas fa-users-cog"></i> Attribut</h5> </li> 
          <!-- Setting / Attribut   -->
          <li class="nav-item  @yield('nav-item-lokasikerja')">
            <a href="#" class="nav-link  @yield('menu-open-lokasikerja')">
              <i class="nav-icon fas fa-map-marker-alt"></i>
              <p>
                Lokasi Kerja
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview pl-3">
              <li class="nav-item">
                <a href="{{url('tambah-lokasi-kerja')}}" class="nav-link @yield('menu-open-lokasikerja-add')"> 
                  <p>Tambah Lokasi Kerja</p> 
                </a>
              </li>  
              <li class="nav-item">
                <a href="{{url('lokasi-kerja')}}" class="nav-link  @yield('menu-open-lokasikerja-list')">
                  <p>Daftar Lokasi Kerja</p> 
                </a>
              </li>  
            </ul>
          </li>  

          <!-- Absensi Waktu  / JAm kerja   -->
          <li class="nav-item @yield('nav-item-jamkerja')">
            <a href="#" class="nav-link  @yield('menu-open-jamkerja')">
              <i class="nav-icon fas fa-clock"></i>
              <p>
                Atur Jam Kerja
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview pl-3">
              <li class="nav-item">
                <a href="{{url('buat-jamkerja')}}" class="nav-link @yield('menu-open-jamkerja-add')"> 
                  <p>Buat Jam Kerja</p> 
                </a>
              </li>  
              <li class="nav-item">
                <a href="{{url('jamkerja')}}" class="nav-link  @yield('menu-open-jamkerja-list')">
                  <p>Daftar Jam Kerja</p> 
                </a>
              </li>  
            </ul>
          </li>  

           
           
        </ul>
      </nav>
      <!-- /.sidebar-menu -->

    </div>
    <!-- /.sidebar -->

  </aside>