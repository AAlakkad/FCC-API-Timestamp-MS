<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

$app->get('/', function () use ($app) {
    return file_get_contents('./readme.html');
});

$app->get('/{timestamp}', function ($timestamp = null) use ($app) {

    if (is_numeric($timestamp)) {
        // send the timestamp as human readable text
        $json = [
            'unix'    => $timestamp,
            'natural' => date('F d, Y', $timestamp),
        ];
    } else {
        // send the equivilent unix timestamp
        $unix = strtotime(urldecode($timestamp));
        if ($unix === false) {
            return 'Bad request';
        }

        $json = [
            'unix'    => $unix,
            'natural' => urldecode($timestamp),
        ];
    }

    return $json;
});
