<?php

namespace app\Route;

/**
 * ControllerParamsFromUrl class allocates controller parameters from URL
 */
class RouteParamManager {

/**
$data = ['id' => 2, 'page'=>'good', 'size' => '4'];
$template = ['localhost/{id}/{page}/{size}',
'localhost/{page}/{size}/{id}',
'localhost/{page}/{id}/{size}',
'localhost/{id}/{size}/{page}'
];

function ($data, $template) {

}

result:
localhost/good/2/2   ? localhost/good/4/2
localhost/good/2/4
localhost/2/4/good
 * */

    //public static function task($data, $template){
    public static function task()
    {
        $data = ['id' => 2, 'page' => 'good', 'size' => '4'];
        $template = ['localhost/{id}/{page}/{size}',
            'localhost/{page}/{size}/{id}',
            'localhost/{page}/{id}/{size}',
            'localhost/{id}/{size}/{page}'];

        return str_replace( array_map(function ($v)  { return '{'.$v.'}'; }, array_keys($data)), $data, $template);
    }

    /**
     * @param string $controllerParam
     * @param string $url
     * @return array
     */
    public static function getParams($controllerParam, $url)
    {
        $urlParams = explode('/', $url);
        $controllerParams[1] = self::addMarker($urlParams[1], 'Action');
        return ['controller' => $controllerParam, 'action' => $controllerParams[1], 'id' => $urlParams[2]];
    }

    /**
     * @param string $a
     * @param string $b
     * @return string
     */
    public static function addMarker($a, $b) {
        return $a . $b;
    }

}