<?php


function hpost(string $url, array $param = [])
{

//    exemple pour le param $url : 'http://server.com/path'
//    exemple pour le param $param : array('key1' => 'value1', 'key2' => 'value2');
//    use key 'http' even if you send the request to https://...


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





