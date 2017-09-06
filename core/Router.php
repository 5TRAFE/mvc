<?php
class Router {
    private $routes;

    private $uri;


    /**
     * Router constructor.
     */
    function __construct()
    {
        $this->routes = Config::getRoutes();
        $this->parseUri();
        $this->postData();
        ob_start();
        session_start();
        Sessions::setSession();
    }
    private function ProtectRoutes($protected){

        $check = new ProtectedRoutes();
        $result = $check->$protected();

        if(!$result){
            return false;
        }
        return true;

    }
    /**
     * @param $uri
     * @param $router
     * @param array $params
     * @return bool
     */
    private function createController($uri, $router, $params = []){

        $result = $this->ProtectRoutes($router[$uri]['protected']);
       if(!$result){

           return false;

       }

        $controllerName = $router[$uri]['controller'] . 'Controller';
        $actionName = $router[$uri]['action'];
        $controller = new $controllerName();

        Storage::set('method', $router[$uri]['method']);

        if(!(empty($params))){

            if($router[$uri]['params'] == 'id' && count($params) > 1){
                echo 'передано больше 1 параметра';

                return false;
            }

            $controller->$actionName($params);


        }else
        {
            $controller->$actionName();
        }
        return true;
    }


    /**
     * @return bool
     */
    public function run()
    {
        $params = [];
        $router = $this->routes;
        $uri = strtolower(trim($this->uri, '/'));

        if (empty($uri)){
            $this->createController($uri, $router);
            return true;
        }


        while (!empty($uri)) {

            if (isset($router[$uri])) {

                $params = array_reverse($params);

                if ((!(isset($router[$uri]['params']))) && (!empty($params)) || isset($router[$uri]['params']) && empty($params)) {
                    echo 'что-то не так';
                    break;
                }
                if ($this->createController($uri, $router, $params)) {
                    return true;
                }
            }

            $uri = explode('/', $uri);
            $params[] = array_pop($uri);
            $uri = implode($uri, '/');
        }

        Page::get404();

    }

    /**
     * @return bool
     */
    private function parseUri()
    {
        $uri = parse_url($_SERVER['REQUEST_URI']);

            if(isset($uri['query'])) {

                $query = [];

                foreach ($_GET as $key => $val)
                {
                    $val = trim($val);
                    $val = stripslashes($val);
                    $val = htmlspecialchars($val);

                   $query[] = [$key => $val];
                }

            }else {

                $query = null;

            }
            $uri = trim(urldecode($uri['path']), '/');

            $this->uri = $uri;

            Storage::set('get' ,$query);
            Storage::set('uri', $uri);

           return true;
    }

    /**
     *
     */
    private function postData(){
        $post = [];
        if(!(empty($_POST))){

            foreach ($_POST as $key => $val)

            {
                $val = trim($val);
                $val = stripslashes($val);
                $val = htmlspecialchars($val);
               $post[$key] = $val;
            }
            Storage::set('post', $post);
        }
    }



    /**
     *
     */


}
