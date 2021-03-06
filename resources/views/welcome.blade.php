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
        <div id="app"class="container" style="margin-top: 25px;">
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
                <div class="col-12">
                    <div class="jumbotron">
                        <div class="row">
                            <h6>Teste do envio do certificado Via AJAX JQUERY</h6>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div>
                                    <label for="">Handler</label>
                                    <input type="text" class="form-control" id="handler" value="17971">
                                </div>
                            </div>
                            <div class="col-4">
                                <div >
                                    <label for="">Token</label>
                                    <input type="text" class="form-control" id="token" value="671duq8x5jrjlonipb91556041181534">
                                </div>
                            </div>
                            <div class="col-1">
                                <div >
                                    <label for="">Senha Cert</label>
                                    <input type="text" class="form-control" id="senhacertificado" value="1234">
                                </div>
                            </div>

                            <div class="form-group col-3">
                                <div >
                                    <label for="">Certificado</label>
                                    <input type="file" class="form-control" id="cert">
                                </div>
                            </div>
                            <div>
                                <button  class="btn btn-primary" onclick="enviarCertificado()">Atualizar Certificado</button>
                            </div>

                            <div class="col-12">
                                <h2>Response: </h2>
                                <div class="col-12" id="resultado">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-12">
                    <div class="jumbotron">
                        <form action="{{ route('create.account')  }}" method="post">
                            {{csrf_field()}}
                            <h6>Teste de Cadastro de Cliente</h6>
                            <div class="row">
                                <div class="col-4">
                                    <div >
                                        <label for="">Token</label>
                                        <input type="text" class="form-control" name="token" id="token" value="671f6o06eoqp9yq4cxr1562596034661">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div >
                                        <label for="">CNPJ CLIENTE</label>
                                        <input type="text" name="cnpj" class="form-control" id="cnpj" value="">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div >
                                        <label for="">NOME CLIENTE</label>
                                        <input type="text" name="razaosocial" class="form-control" id="razaosocial" value="">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div >
                                        <button class="btn btn-primary">SALVAR</button>
                                    </div>
                                </div>

                            </div>
                        </form>
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
            var senhacertificado = document.getElementById('senhacertificado').value;
            var url = "https://managersaas.tecnospeed.com.br:1337/api/v1/empresa/"+handler+"?token="+token;
            //var url = 'https://webhook.site/a42b5236-f545-438e-88e4-0c82d9ac8fa5';
            var form = new FormData();
            var file = document.getElementById('cert').files[0]
            form.append("certificadobinario", file );
            form.append("senhacertificado", senhacertificado);
            form.append("handle", "17971");

            var divresult = document.getElementById('resultado');

            var settings = {
                async: true,
                crossDomain: true,
                url: url,
                method: "PUT",
                headers: {
                    // "cache-control": "no-cache",
                    //"Content-Type": "multipart/form-data; boundary=--------------------------090374872533917031043226",
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
