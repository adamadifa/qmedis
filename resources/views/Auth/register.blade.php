<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
     <title>Register | Sistem Informasi Pegawai Persis 80 Al Amin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{asset('klorofil/css/4.6/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('klorofil/vendor/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('klorofil/vendor/linearicons/style.css')}}">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{asset('klorofil/css/main.css')}}">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="{{asset('klorofil/css/demo.css')}}">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('klorofil/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('klorofil/img/favicon.png')}}">
</head>

<body>
    <!-- WRAPPER -->
    <div id="wrapper">
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle">
                <div class="auth-box" style="height: 600px !important">
                    <div class="left">
                        <div class="content">
                            <div class="header">
                                <div class="logo" style="margin-bottom:20px"><img
                                        src="{{asset('klorofil/img/logo-dark.png')}}" alt="Klorofil Logo">
                                </div>
                                <p class="lead">Daftar</p>
                            </div>
                            <form class="" novalidate action="{{route('postregister')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label sr-only">NPP</label>
                                    <input type="text" class="form-control @error('npp') is-invalid @enderror"
                                        name="npp" placeholder="NPP" value="{{old('npp')}}">
                                    @error('npp')
                                    <div class="mb-2 mt-2 text-left invalid-feedback">{{ucwords($message)}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label sr-only">Nama Lengkap</label>
                                    <input type="text" class="form-control  @error('nama_lengkap') is-invalid @enderror"
                                        name="nama_lengkap" placeholder="Nama Lengkap" value="{{old('nama_lengkap')}}">
                                    @error('nama_lengkap')
                                    <div class="mb-2 mt-2 text-left invalid-feedback">{{ucwords($message)}}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="signin-password" name="password" placeholder="Password"
                                        value="{{old('password')}}">
                                    @error('password')
                                    <div class="mb-2 mt-2 text-left invalid-feedback">{{ucwords($message)}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Konfirmasi
                                        Password</label>
                                    <input type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        name="password_confirmation" placeholder="Konfirmasi Password"
                                        value="{{old('password_confirmation')}}">
                                    @error('password_confirmation')
                                    <div class="mb-2 mt-2 text-left invalid-feedback">{{ucwords($message)}}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-success btn-lg btn-block">DAFTAR</button>
                                <div class="bottom mt-3">
                                    <span class="helper-text"><i class="fa fa-user mr-3"></i> Sudah Punya Akun ? <a
                                            href="/login">login</a></span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="right">
                        <div class="overlay"></div>
                        <div class="content text">
                            <h1 class="heading">SISTEM INFORMASI PEGAWAI Ver. 1.0</h1>
                            <p>Pesantren Persis 80 Al-amin Sindangkasih</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END WRAPPER -->
</body>

</html>
