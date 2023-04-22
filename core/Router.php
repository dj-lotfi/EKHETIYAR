<?php

class Router {
    public static function route($url)
    {
        //controller
        
        $controller = (isset($url[0]) && $url != '') ?ucwords($url[0]).'Controller' : DEFAULT_CONTROLLER.'Controller';
        $controller_name = str_replace('Controller','',$controller);
        if ($controller_name == 'Login' || $controller_name == 'Admin' ) {
            Router::redirect('Error404');
            exit;
        } elseif ($controller_name == ucwords(Admin)) {
            $controller_name = 'Admin';
            $controller = 'Admin'.'Controller';

        } elseif ($controller_name == ucwords(Login)) {
            $controller_name = 'Login';
            $controller = 'Login'.'Controller';
        }
        array_shift($url);

        //action
        $action = (isset($url[0]) && $url != '') ?ucwords($url[0]) : DEFAULT_ACTION;
        $action_name = $action;
        array_shift($url);

        //params
        $queryParams = $url;


        if (!class_exists($controller)) {
            
            Router::redirect('Error404');
            exit;
        }else {
            if(!method_exists($controller, $action)){//$action existe dans la classe controlleur...
                Router::redirect('Error404');
                

                exit;
            }
        }          
        

        $dispatch = new $controller($controller_name, $action); //creer une instance de la classe $controller_name
        call_user_func_array([$dispatch, $action], $queryParams);//<=>$dispatch.$action($queryParams)


    }

    public static function redirect($location)
    {
        if(!headers_sent()) {
            header('Location: ' . PROOT. DS . $location);
            
            exit();
        } else {
            echo '<script type)"text/javascript">';
            echo 'window.location.href="'.PROOT. DS .$location.'";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url='.$location.'" />';
            echo '<noscript>';exit;
        }
    }
}

