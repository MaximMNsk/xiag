<?PHP

class Route
{
    static function start()
    {
        $controllerName = 'Main';
        $actionName = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if ( !empty($routes[1]) )
        {
            $controllerName = $routes[1];
        }

        if ( !empty($routes[2]) )
        {
            $actionName = $routes[2];
        }
        $modelName = 'Model'.ucfirst($controllerName);
        $controllerName = 'Controller'.ucfirst($controllerName);
        $actionName = 'action'.ucfirst($actionName);


        $modelFile = $modelName.'.php';
        $modelPath = "application/models/".$modelFile;

        if(file_exists($modelPath))
        {
            include $modelPath;
        }


        $controllerFile = $controllerName.'.php';
        $controllerPath = "application/controllers/".$controllerFile;

        if(file_exists($controllerPath))
        {
            include $controllerPath;
        }
        else
        {
            self::ErrorPage404();
        }

        $fullControllerName = 'application\\controllers\\'.$controllerName;

        $controller = new $fullControllerName;
        $action = $actionName;

        if(method_exists($controller, $action))
        {
            $controller->$action();
        }
        else
        {
            self::ErrorPage404();
        }
       
    }

    static function ErrorPage404()
    {
        $routes = explode('/', $_SERVER['REQUEST_URI']);
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }

}



