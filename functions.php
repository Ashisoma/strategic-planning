<?php


function myJsonResponse($code, $message, $data = null)
{
    $response = [];
    $response['code'] = $code;
    $response['message'] = $message;
    $response['data'] = $data;
    return json_encode($response);
}
