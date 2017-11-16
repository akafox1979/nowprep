<?php
Class RestCurl {
    public static function exec($method, $url, $obj = array()) {

        $curl = curl_init();

        switch($method) {
            case 'GET':
                if(strrpos($url, "?") === FALSE) {
                    $url .= '?' . http_build_query($obj);
                }
                break;
            case 'POST':
                curl_setopt($curl, CURLOPT_POST, TRUE);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($obj));
                break;
            case 'PUT':
            case 'DELETE':
            default:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, strtoupper($method)); // method
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($obj)); // body
        }
        var_dump($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=utf-8', 'Transfer-Encoding: chunked', 'Connection: keep-alive'));
        //curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36");

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE);

        // Exec
        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);

        // Data
        $header = trim(substr($response, 0, $info['header_size']));
        $body = substr($response, $info['header_size']);

        return array('status' => $info['http_code'], 'header' => $header, 'data' => $body);
    }
    public static function get($url, $obj = array()) {
        return RestCurl::exec("GET", $url, $obj);
    }
    public static function post($url, $obj = array()) {
        return RestCurl::exec("POST", $url, $obj);
    }
    public static function put($url, $obj = array()) {
        return RestCurl::exec("PUT", $url, $obj);
    }
    public static function delete($url, $obj = array()) {
        return RestCurl::exec("DELETE", $url, $obj);
    }
}