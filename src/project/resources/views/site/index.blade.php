<html>
    <head>
        <style>
            body{
                text-align: right;
                direction: rtl;
            }
        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card text-center">
                        <div class="card-header">
                            Home Page
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                @auth
                                    <a href="{{ route('admin.index') }}" class="btn btn-primary">Admin Pannel</a>

                                    <a href="{{ route('auth.logout') }}" class="btn btn-warning">Exit</a>
                                @else
                                    <a href="{{ route('auth.login') }}" class="btn btn-success">Login</a>
                                    <a href="{{ route('auth.register') }}" class="btn btn-primary">Register</a>
                                @endauth
                            </div>
                        </div>
                        <div class="card-footer text-muted">

                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </body>
</html>
