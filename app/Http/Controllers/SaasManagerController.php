<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SaasManagerController extends Controller
{
    function createEmpresa(Request $request){
        $http =  new Client;
        $data = $request->all();
        $token = $data['token'];

        //A Empresa vai cadastrar no Gruop 'TesteVitorTecno'
        $data['idgrupo']            = 14112;
        $data['iduf']               = 21;
        $data['idcidade']           = 4120;
        $data['identificacao']      = $data['razaosocial'];
        $data['descricao']          = $data['razaosocial'];
        $data['inscricaomunicipal'] = '123';
        $data['nfe[situacao]']      = 0;
        $data['nfe[tipocontrato]']  = 0;
        $data['nfce[situacao]']     = 0;
        $data['nfce[tipocontrato]'] = 0;


        $headers =
            [
                'Content-Type'  => 'multipart/form-data'
            ];

        $body = [];
        foreach ($data as $key => $aux){
            array_push($body, [
                'name' => $key,
                'contents' => $aux
            ]);
        }

        $options = [
            'headers' => $headers,
            'multipart' =>  $body
            ,
        ];

        //Para poder enviar sem dar erro descomente o código abaixo, porém não vai alterar os campos referente a NFe e NFce
//        $options = [
//            'form_params' =>  $data
//        ];

        $url_webhook = 'https://webhook.site/9fce7d62-f4f1-4d63-af6a-df30b4816595';
        $url_tecnospeed = 'https://managersaas.tecnospeed.com.br:1337/';


        $request = $http->request('POST',
            $url_tecnospeed.'api/v1/empresa?token='.$token,
             //$url_webhook,
            $options
        );

        $resp = (string) $request->getBody();
        dd($resp);
    }
}
