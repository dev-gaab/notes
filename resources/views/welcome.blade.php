<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Notas Test - @yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <style type="text/css">
            .login {
                margin-top: 200px; 
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="#">
                <img src="https://www.ach.edu/wp-content/uploads/2017/01/Notes2.png" width="30" height="30" class="d-inline-block align-top" alt="">
                Notas Test
            </a>
            <div id="logout">
            </div>
        </nav>

        <div class="container">
            @yield('content')
        </div>

       <script
         src="https://code.jquery.com/jquery-3.3.1.min.js"
         integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
         crossorigin="anonymous"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 

       <script type="text/javascript">
            $(document).ready(function () {

                var pathname = window.location.pathname;
                console.log(pathname);
                if(pathname !== '/login') {
                    console.log('algo')
                    $('#logout').html(`<button class="btn btn-danger float-right" onclick="logout()" >Cerrar Sesion</button>`);
                }

                $('#login').on('submit', function(e) {

                    e.preventDefault();

                    var email = $('#email').val();
                    var password = $('#password').val();

                    var data = {
                        email: email,
                        password: password
                    };

                    $.ajax({
                        url: '/auth/login',
                        type: 'POST',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (res) {
                            // mostrar la alerta
                            if(!res.error) window.location.href = '/notas';
                            console.log(res);
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    })
                });
            });

            function logout() {
                $.ajax({
                    url: '/auth/logout',
                    success: function (res) {
                        // mostrar la alerta
                        if(!res.error) window.location.href = '/login';
                        console.log(res);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                })
            }
       </script>

       @yield('script')
    </body>
</html>
