<?php

namespace app\Route;

/**
 * ControllerParamsFromUrl class allocates controller parameters from URL
 */
class RouteParamManager {

    /**
     * @param string $controllerParam
     * @param string $url
     * @return array
     */
    public static function getParams($controllerParam, $url)
    {
        $urlParams = explode('/', $url);
        $controllerParams[1] = RouteParamManager::addMarker($urlParams[1], 'Action');

        return array('controller' => $controllerParam, 'action' => $controllerParams[1], 'id' => $urlParams[2]);// - если все роуты кроме '/' содержат {id}-параметры
        //return (!empty($urlParams[2])) ? array('controller' => $controllerParam, 'action' => $controllerParams[1], 'id' => $urlParams[2]) : array('controller' => $controllerParam, 'action' => $controllerParams[1]);
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