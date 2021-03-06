<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>YPDM Pasundan | Login</title>

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <img class="logo-name" src="{{asset('img/logo.png')}}" alt="logo">
            </div>
            <h3>Yayasan Pendidikan Dasar dan Menengah Pasundan</h3>
            <p>Login</p>
            <form method="POST" class="m-t" role="form" action="{{url('/postlogin')}}">
                @csrf
                <div class="form-group">
                    <input name="email" type="email" class="form-control" placeholder="Email" required="" value="{{old('email')}}">
                    @error('email')
                    <li class="text-danger small">
                        <strong>{{ $message }}</strong>
                    </li>
                    @enderror
                </div>
                <div class="form-group">
                    <input name="password" type="password" class="form-control" placeholder="Password" required="">
                    @error('password')
                    <li class="text-danger small">
                        <strong>{{ $message }}</strong>
                    </li>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <!-- <a href="#"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a> -->
            </form>
            <p class="m-t">
                <small>
                    Jalan Babakan Ciparay 112/194A Telp. (022) 6026149 <br> Bandung 40221 <br>
                    NPSN : 20219816 NSS. 104026015023 <br> Email: sdpasundan2@gmail.com
                </small>
            </p>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>

</body>

</html>
