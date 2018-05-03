<?php


namespace app\Route;

/**
 * Router class gets the data from the config-file, creates the path.
 */
class Route{

    /**
     * Property $routeParams, the array contains the parameters of the router
     */
    public $routeParams;

    /**
     * Constructor __construct (array $config) has received an array $config - data from the file.
     */
    public function __construct(array $config){
        $this->routeParams = $config;
    }

    /**
     * Method match ($url) (match - case pick up a pair, match)
     * goes through $this -> routeParams and is an option.
     * return the desired settings - returns array ( 'controller' => 'controller', 'action' => 'method')
     * or array('controller' => $controllerParam, 'action' => $controllerParams[1], 'id' => $urlParams[2]).
     */
/*    public function match($url){
        foreach($this->routeParams as $param){
            if ( $param[0] == $url ){
                $controllerParams = explode('.', $param[1]);
                return array('controller' => $controllerParams[0], 'action' => $controllerParams[1]);
            }else{
                    $controllerParams = explode('.', $param[1]);
                    $urlParams = explode('/', $url);
                    $controllerParams[1] = $urlParams[1] . 'Action';

                    if(!empty($urlParams[2])){
                        $controllerParams[2] = $urlParams[2];
                        return array('controller' => $controllerParams[0], 'action' => $controllerParams[1], 'id' => $controllerParams[2]);
                    }
                    return array('controller' => $controllerParams[0], 'action' => $controllerParams[1]);
                }
        }
    }*/

    public function match($url){
        foreach($this->routeParams as $param){
            $controllerParams = explode('.', $param[1]);

 /*           if ( $url == '/index' ) {

echo'<pre>!!!',var_dump($url),'</pre>';
                return;
            }*/
            return ($param[0] == $url) ? array('controller' => $controllerParams[0], 'action' => $controllerParams[1]) : RouteParamManager::getParams($controllerParams[0], $url);
        }
    }

}
?>