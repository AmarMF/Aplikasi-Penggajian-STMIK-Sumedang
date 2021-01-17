<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Penggajian | Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('assets/vendor/metisMenu/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('assets/dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    {{-- <link href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"> --}}
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        * {
          box-sizing: border-box;
          margin: 0;
          padding: 0;
          font-weight: 300;
        }
        body {
          font-family: 'Source Sans Pro', sans-serif;
          color: white;
          font-weight: 300;
        }
        body ::-webkit-input-placeholder {
          /* WebKit browsers */
          font-family: 'Source Sans Pro', sans-serif;
          color: white;
          font-weight: 300;
        }
        body :-moz-placeholder {
          /* Mozilla Firefox 4 to 18 */
          font-family: 'Source Sans Pro', sans-serif;
          color: white;
          opacity: 1;
          font-weight: 300;
        }
        body ::-moz-placeholder {
          /* Mozilla Firefox 19+ */
          font-family: 'Source Sans Pro', sans-serif;
          color: white;
          opacity: 1;
          font-weight: 300;
        }
        body :-ms-input-placeholder {
          /* Internet Explorer 10+ */
          font-family: 'Source Sans Pro', sans-serif;
          color: white;
          font-weight: 300;
        }
        .wrapper {
          background: rgb(0,46,109);
          background: linear-gradient(0deg, rgba(0,46,109,1) 0%, rgba(0,46,109,1) 100%);
          position: absolute;
          left: 0;
          width: 100%;
          height: 100%;
          overflow: hidden;
        
        }
        
        .wrapper.form-success .container h1 {
          -webkit-transform: translateY(85px);
              -ms-transform: translateY(85px);
                  transform: translateY(85px);
        }
        .container {
          max-width: 600px;
          margin: 0 auto;
          padding: 80px 0;
          height: 400px;
          text-align: center;
        }
        .container h1 {
          font-size: 40px;
          -webkit-transition-duration: 1s;
                  transition-duration: 1s;
          -webkit-transition-timing-function: ease-in-put;
                  transition-timing-function: ease-in-put;
          font-weight: 200;
        }
        form {
          padding: 20px 0;
          position: relative;
          z-index: 2;
        }
        form input {
          -webkit-appearance: none;
             -moz-appearance: none;
                  appearance: none;
          outline: 0;
          border: 1px solid rgba(255, 255, 255, 0.4);
          background-color: rgba(255, 255, 255, 0.2);
          width: 250px;
          border-radius: 3px;
          padding: 10px 15px;
          margin: 0 auto 10px auto;
          display: block;
          text-align: center;
          font-size: 18px;
          color: white;
          -webkit-transition-duration: 0.25s;
                  transition-duration: 0.25s;
          font-weight: 300;
        }
        form input:hover {
          background-color: rgba(255, 255, 255, 0.4);
        }
        /* form input:focus {
          background-color: white;
          width: 300px;
          color: #53e3a6;
        } */
        form button {
          -webkit-appearance: none;
             -moz-appearance: none;
                  appearance: none;
          outline: 0;
          background-color: white;
          border: 0;
          padding: 10px 15px;
          color: #53e3a6;
          border-radius: 3px;
          width: 250px;
          cursor: pointer;
          font-size: 18px;
          -webkit-transition-duration: 0.25s;
                  transition-duration: 0.25s;
        }
        form button:hover {
          background-color: #f5f7f9;
        }
        .bg-bubbles {
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          z-index: 1;
        }
        .bg-bubbles li {
          position: absolute;
          list-style: none;
          display: block;
          width: 40px;
          height: 40px;
          background-color: rgba(255, 255, 255, 0.15);
          bottom: -160px;
          -webkit-animation: square 25s infinite;
          animation: square 25s infinite;
          -webkit-transition-timing-function: linear;
          transition-timing-function: linear;
        }
        .bg-bubbles li:nth-child(1) {
          left: 10%;
        }
        .bg-bubbles li:nth-child(2) {
          left: 20%;
          width: 80px;
          height: 80px;
          -webkit-animation-delay: 2s;
                  animation-delay: 2s;
          -webkit-animation-duration: 17s;
                  animation-duration: 17s;
        }
        .bg-bubbles li:nth-child(3) {
          left: 25%;
          -webkit-animation-delay: 4s;
                  animation-delay: 4s;
        }
        .bg-bubbles li:nth-child(4) {
          left: 40%;
          width: 60px;
          height: 60px;
          -webkit-animation-duration: 22s;
                  animation-duration: 22s;
          background-color: rgba(255, 255, 255, 0.25);
        }
        .bg-bubbles li:nth-child(5) {
          left: 70%;
        }
        .bg-bubbles li:nth-child(6) {
          left: 80%;
          width: 120px;
          height: 120px;
          -webkit-animation-delay: 3s;
                  animation-delay: 3s;
          background-color: rgba(255, 255, 255, 0.2);
        }
        .bg-bubbles li:nth-child(7) {
          left: 32%;
          width: 160px;
          height: 160px;
          -webkit-animation-delay: 7s;
                  animation-delay: 7s;
        }
        .bg-bubbles li:nth-child(8) {
          left: 55%;
          width: 20px;
          height: 20px;
          -webkit-animation-delay: 15s;
                  animation-delay: 15s;
          -webkit-animation-duration: 40s;
                  animation-duration: 40s;
        }
        .bg-bubbles li:nth-child(9) {
          left: 25%;
          width: 10px;
          height: 10px;
          -webkit-animation-delay: 2s;
                  animation-delay: 2s;
          -webkit-animation-duration: 40s;
                  animation-duration: 40s;
          background-color: rgba(255, 255, 255, 0.3);
        }
        .bg-bubbles li:nth-child(10) {
          left: 90%;
          width: 160px;
          height: 160px;
          -webkit-animation-delay: 11s;
                  animation-delay: 11s;
        }
        @-webkit-keyframes square {
          0% {
            -webkit-transform: translateY(0);
                    transform: translateY(0);
          }
          100% {
            -webkit-transform: translateY(-700px) rotate(600deg);
                    transform: translateY(-700px) rotate(600deg);
          }
        }
        @keyframes square {
          0% {
            -webkit-transform: translateY(0);
                    transform: translateY(0);
          }
          100% {
            -webkit-transform: translateY(-700px) rotate(600deg);
                    transform: translateY(-700px) rotate(600deg);
          }
        }
        .img-logo-login{
            width: 150px;
            margin-top: 30px;
            margin-bottom: 15px;
        }
        .panel-default._login{
            width: 430px;
            background: #000000a8;
            border: none;
        }
        </style>        

</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="display: flex;justify-content:center;align-items:center;">
                    
                    <div class="panel panel-default _login" style="    width: 430px;
                    background: #000000a8;">
                    <p class="text-center">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Penggajian" class="img-logo-login" />
                    </p>
                        <div class="panel-heading" style="    background: transparent;
                        color: #fff;">
                            <h3 class="panel-title">Login SI Penggajian</h3>
                        </div>
                        <div class="panel-body">
                            @if($errors->has('notification'))
                              <div class="alert alert-danger" role="alert">E-mail atau Password salah!</div>
                            @endif
                            <form action="{{ route('karyawan.login.store') }}" method="post">
                                <fieldset>
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Nomor Induk Karyawan" name="nik" type="text" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                    </div>
                                    <button type="submit" class="btn btn-lg  btn-block" style="background-color: #F7B500 !important; color: #09081f;"><i class="fa fa-sign-in-alt"></i> Login</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         
        <ul class="bg-bubbles">
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
        </ul>
      </div>   

    {{-- <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <p class="text-center" style="padding-top: 50px;">
                    <img src="{{ asset('assets/img/logo-forweb.png') }}" alt="Penggajian" width="250" />
                </p>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login Karyawan</h3>
                    </div>
                    <div class="panel-body">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Panduan Penggunaan</a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse">
                                  <div class="panel-body">
                                      <ul class="timeline">
                                        <li>
                                          <div class="timeline-badge primary"><i class="fa fa-user"></i></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Login</h4>
                                                </div>
                                                <div class="timeline-body">
                                                    <small>Isi <b>Nomor Induk Karyawan</b> dan <b>Password</b></small>
                                                </div>
                                            </div>
                                          </li>
                                          <li class="timeline-inverted">
                                              <div class="timeline-badge warning"><i class="fa fa-print  "></i>
                                              </div>
                                              <div class="timeline-panel">
                                                  <div class="timeline-heading">
                                                      <h4 class="timeline-title">Slip Gaji</h4>
                                                  </div>
                                                  <div class="timeline-body">
                                                    <small>Slip gaji yang muncul hanya yang sudah di <i><b>Published</b></i> oleh Bag. Keuangan</small>
                                                  </div>
                                              </div>
                                          </li>
                                          <li>
                                              <div class="timeline-badge success"><i class="fa fa-check"></i>
                                              </div>
                                              <div class="timeline-panel">
                                                  <div class="timeline-heading">
                                                      <h4 class="timeline-title">Selesai</h4>
                                                  </div>
                                                  <div class="timeline-body">
                                                      <small>Jangan lupa untuk Logout jika sudah selesai</small>
                                                  </div>
                                              </div>
                                          </li>
                                      </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($errors->has('notification'))
                          <div class="alert alert-danger" role="alert">Nomor Induk Karyawan atau Password salah!</div>
                        @endif
                        <form action="{{ route('karyawan.login.store') }}" method="post">
                            <fieldset>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input class="form-control" placeholder="NIK" name="nik" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-primary btn-block"><i class="fa fa-sign-in-alt"></i> Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- jQuery -->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('assets/vendor/metisMenu/metisMenu.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('assets/dist/js/sb-admin-2.js') }}"></script>

</body>

</html>
