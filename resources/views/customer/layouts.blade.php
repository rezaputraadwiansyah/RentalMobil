<!DOCTYPE html>
<html lang="en">

<head>
    <title>Rental Mobil Reza</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{asset('customer')}}/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('customer')}}/css/animate.css">

    <link rel="stylesheet" href="{{asset('customer')}}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{asset('customer')}}/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{asset('customer')}}/css/magnific-popup.css">

    <link rel="stylesheet" href="{{asset('customer')}}/css/aos.css">

    <link rel="stylesheet" href="{{asset('customer')}}/css/ionicons.min.css">

    <link rel="stylesheet" href="{{asset('customer')}}/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="{{asset('customer')}}/css/jquery.timepicker.css">


    <link rel="stylesheet" href="{{asset('customer')}}/css/flaticon.css">
    <link rel="stylesheet" href="{{asset('customer')}}/css/icomoon.css">
    <link rel="stylesheet" href="{{asset('customer')}}/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.html">Rental Mobil <span>Reza</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{$active == 'home' ? 'active' : ''}}"><a href="/home" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item {{$active == 'car' ? 'active' : ''}}"><a href="/car" class="nav-link">Cars</a>
                    </li>
                    <li class="nav-item"><a href="/logout" class="nav-link">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | Rental Mobil Reza
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg></div>
    <script>
        @if(Session::has('message'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{ session('message') }}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.error("{{ session('error') }}");
  @endif

  @if(Session::has('info'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.warning("{{ session('warning') }}");
  @endif
    </script>

    <script src="{{asset('customer')}}/js/jquery.min.js"></script>
    <script src="{{asset('customer')}}/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="{{asset('customer')}}/js/popper.min.js"></script>
    <script src="{{asset('customer')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('customer')}}/js/jquery.easing.1.3.js"></script>
    <script src="{{asset('customer')}}/js/jquery.waypoints.min.js"></script>
    <script src="{{asset('customer')}}/js/jquery.stellar.min.js"></script>
    <script src="{{asset('customer')}}/js/owl.carousel.min.js"></script>
    <script src="{{asset('customer')}}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{asset('customer')}}/js/aos.js"></script>
    <script src="{{asset('customer')}}/js/jquery.animateNumber.min.js"></script>
    <script src="{{asset('customer')}}/js/bootstrap-datepicker.js"></script>
    <script src="{{asset('customer')}}/js/jquery.timepicker.min.js"></script>
    <script src="{{asset('customer')}}/js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false">
    </script>
    <script src="{{asset('customer')}}/js/google-map.js"></script>
    <script src="{{asset('customer')}}/js/main.js"></script>
</body>

</html>