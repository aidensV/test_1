<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
        <!-- Latest compiled and minified CSS -->
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> --}}
        <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6/css/select2.min.css" rel="stylesheet" />
{{-- <script src="{{asset('assets/select2/css/select2.min.css')}}" charset="utf-8"></script> --}}
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body id="body">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">0o0</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                  {{-- <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li> --}}
                  <li class="nav-item">
                      <a class="nav-link" href="{{url('data_item')}}">Data Item</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{url('data_unit')}}">Data Unit</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{url('data_stock')}}">Data Stock</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{url('data_owner')}}">Data Owner</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{url('sales')}}">Sales</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{url('distribution/create')}}">Distribution</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{url('distribution')}}">List Distribution</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{url('order/create')}}">Order</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{url('order')}}">List Order</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{url('master_user')}}">Manajemen User</a>
                  </li>


              </ul>
              <form class="form-inline my-2 my-lg-0">
                  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
              </form>
          </div>
      </nav>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </div>
            @endif

            <div class="content">
                {{-- <div class="title m-b-md">
                    Laravel
                </div> --}}

                @yield('content')

            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.js" charset="utf-8"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" charset="utf-8"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
  {{-- <script src="{{asset('assets/select2/js/select2.full.min.js')}}" charset="utf-8"></script> --}}
  {{-- <script src="{{asset('js/plugins-init/select2-init.js')}}" charset="utf-8"></script> --}}
  <script src="{{asset('js/validator.js')}}" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        });

      $(document).ready(function() {
        $(".js-example-basic-single").select2({
          dropdownParent: $("#modal-form")
        });
      });
    </script>

  @yield('js')
</html>
