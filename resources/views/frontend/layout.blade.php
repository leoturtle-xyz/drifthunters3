<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Black Bike</title>

    {{-- bootstrap links --}}
        <link rel="stylesheet" href="{{ asset('assets/user/css/bootstrap.min.css') }}">

    {{-- <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}"> --}}
    <!-- flaticon css -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/flaticon.css') }}">

    <!-- slicknav css -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/slicknav.css') }}">
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/common-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
    <!-- responsive css -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/responsive.css') }}">
    <script src="{{ asset('assets/user/js/jquery-3.3.1.min.js') }}"></script>
          <!-- plugin css -->
          <link rel="stylesheet" href="{{asset('assets/frontend/css/plugin.min.css')}}">

    {{-- icons styles --}}
<link rel="stylesheet" href="{{ asset('assets/fonts/flaticon.css') }}">
        {{-- Main custom styles --}}
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>

<body>
    <!--   header area start   -->
    <div class="header-area header-absolute @yield('no-breadcrumb')">
        <div class="container">
            @includeIf('frontend.partials.navbar')
        </div>
    </div>

    @yield('content')


    {{-- footer starts --}}
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 d-flex flex-column justify-content-between">
                    <div>
                        <img src="{{ asset('assets/frontend/images/logo.png') }}" alt="">
                    </div>
                    <div class="footer-location">
                        <span>
                            Asamoah Gyan Centre, <br>
                            Kumasi, Ghana.
                        </span>
                    </div>
                    <div>
                        <p><span class="event-time">9:00AM - 10:00AM</span> <br>
                            <span class="event-date">11th November, 2023</span>
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <h3>STAY CONNECTED</h3>
                    <div class="footer-socials">
                        <a href=""><i class="fab fa-twitter"></i></a>
                        <a href=""><i class="fab fa-linkedin"></i></a>
                        <a href=""><i class="fab fa-instagram"></i></a>
                    </div>
                </div>

                <div class="col-md-4">
                    <h3>REGISTER FOR THE EVENT</h3>
                    <a href="#" class="get-ticket-btn bg-white">GET YOUR TICKETS</a>
                </div>
            </div>
            <hr>
            <div class="col-md-12 text-center" style="padding: 2rem 0">
                <p>&copy; Black Bike 2023</p>
            </div>
        </div>
    </footer>

    <div id="cartIconWrapper">
        <a class="d-block" id="cartIcon" href="{{route('front.cart')}}">
            <div class="cart-length">
                <i class="fas fa-cart-plus"></i>
                <span class="length">{{cartLength()}} {{__('ITEMS')}}</span>
            </div>
            <div class="cart-total">
                {{cartTotal()}}
            </div>
        </a>
    </div>


    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- popper js -->
    <script src="{{ asset('assets/user/js/popper.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('assets/user/js/bootstrap.min.js') }}"></script>
    <!-- owl carousel js -->
    <script src="{{ asset('assets/user/js/owl.carousel.min.js') }}"></script>
    <!-- slicknav js -->
    <script src="{{ asset('assets/user/js/jquery.slicknav.min.js') }}"></script>
    <!-- slick js -->
    <script src="{{ asset('assets/user/js/slick.min.js') }}"></script>
    <!-- isotope js -->
    <script src="{{ asset('assets/user/js/isotope.pkgd.min.js') }}"></script>
    <!-- magnific popup js -->
    <script src="{{ asset('assets/user/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- nice select js -->
    <script src="{{ asset('assets/user/js/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/user/js/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/lazyload.min.js') }}"></script>
    <!-- Summernote JS -->
    <script src="{{ asset('assets/admin/js/plugin/summernote/summernote-bs4.js') }}"></script>

    <!-- main js -->
    <script src="{{ asset('assets/user/js/main.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        var imgupload = "{{ route('user.summernote.upload') }}";
    </script>

    <!-- custom js -->
    <script src="{{ asset('assets/user/js/custom.js') }}"></script>

    @yield('scripts')

    @if (session()->has('success'))
        <script>
            toastr["success"]("{{ __(session()->get('success')) }}");
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            toastr["error"]("{{ __(session('error')) }}");
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true
            });
        });
    </script>
</body>

</html>