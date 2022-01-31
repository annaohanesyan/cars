@include('layouts.header')

    <div class="container-scroller">

        @include('layouts.sidebar')

        <div class="container-fluid page-body-wrapper">

            @include('layouts.navbar')

            <div class="main-panel">

                @yield('content')

                @include('layouts.footer')

            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('adminpage/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('adminpage/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('adminpage/vendors/progressbar.js/progressbar.min.js')}}"></script>
    <script src="{{asset('adminpage/vendors/jvectormap/jquery-jvectormap.min.js')}}"></script>
    <script src="{{asset('adminpage/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{asset('adminpage/vendors/owl-carousel-2/owl.carousel.min.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('adminpage/js/off-canvas.js')}}"></script>
    <script src="{{asset('adminpage/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('adminpage/js/misc.js')}}"></script>
    <script src="{{asset('adminpage/js/settings.js')}}"></script>
    <script src="{{asset('adminpage/js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{asset('adminpage/js/dashboard.js')}}"></script>
   
    <!-- End custom js for this page -->
    @yield('js_scripts')
  </body>
</html>

