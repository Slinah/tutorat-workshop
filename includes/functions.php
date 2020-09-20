<?php


function hpost(string $url, array $param = [])
{
    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($param)
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return json_decode($result);
}


function hget(string $url)
{
    return json_decode(file_get_contents($url));
}


function sanitize($string)
{



    return filter_var($string, FILTER_SANITIZE_FULL_SPECIAL_CHARS);




}



















