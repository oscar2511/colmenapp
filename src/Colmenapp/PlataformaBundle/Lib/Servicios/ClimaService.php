<?php

namespace Colmenapp\PlataformaBundle\Lib\Servicios;


class ClimaService extends BaseClimaService
{

    public function getClimaActual($lat=null, $long=null)
    {
        return  "http://api.openweathermap.org/data/2.5/weather?q=La_Rioja%2Car&APPID=05a6193e5aceca0e58d419717731fba7&mode=html";
        /*$curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.openweathermap.org/data/2.5/weather?q=La_Rioja%2Car&APPID=05a6193e5aceca0e58d419717731fba7&mode=html",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: 1c12da2c-1d27-01e7-0401-8a9e6d35be3e"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }

        */
    }

    public function getClimaExtendido($lat, $long)
    {

    }



}