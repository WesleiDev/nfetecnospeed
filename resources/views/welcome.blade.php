<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/css/app.css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
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
                font-size: 12px;
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
    <body >
        <div id="app"class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="row">
                <div class="col-2">
                    <div>
                        <label for="">Handler</label>
                        <input type="text" class="form-control" id="handler" value="17971">
                    </div>
                </div>
                <div class="col-5">
                    <div >
                        <label for="">Token</label>
                        <input type="text" class="form-control" id="token" value="671l9yopxq720w45cdi1553099793404">
                    </div>
                </div>

                <div class="form-group col-3">
                    <div >
                        <label for="">Certificado</label>
                        <input type="file" class="form-control" id="cert">
                    </div>
                </div>
                <div>
                    <button href="#" class="btn btn-primary" onclick="enviarCertificado()">Atualizar Certificado</button>
                </div>

                <div class="col-12">
                    <h2>Response: </h2>
                    <div class="col-12" id="resultado">

                    </div>
                </div>




            </div>
        </div>

        <script src="/js/app.js"></script>
    <script>
        function enviarCertificado(){
            console.log('Enciando certificado')
            var token =  document.getElementById('token').value;
            var handler = document.getElementById('handler').value;
            var url = "https://managersaas.tecnospeed.com.br:1337/api/v1/empresa/"+handler+"?token="+token;
            //var url = 'https://webhook.site/8e08f81e-9f60-4e10-82ee-9c5b67910c30';
            var form = new FormData();
            var file = document.getElementById('cert').files[0]
            form.append("certificadobinario", file );
            form.append("senhacertificado", "1234");
            form.append("handle", "17971");

            var divresult = document.getElementById('resultado');

            var settings = {
                async: true,
                crossDomain: true,
                url: url,
                method: "PUT",
                headers: {
                    "Content-Type": "multipart/form-data; boundary=--------------------------090374872533917031043226",
                    // "Cache-Control": "no-cache"
                },
                processData: false,
                contentType: false,
                mimeType: "multipart/form-data",
                data: form
            }

            $.ajax(settings)
                .done(function (response) {
                    divresult.innerHTML = response
                    console.log(response);
                }).fail(function(err){
                console.log('ERRO',err)
            });

        }
    </script>
    </body>
</html>
