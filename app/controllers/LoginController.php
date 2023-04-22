<?php

class LoginController extends Controller 
{
    public $model;   

    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->model = $this->load_model('LoginModel');
        $this->view->setLayout('default');

        
    }

    public function indexAction() //nom_de_la_method+Action
    {
        $this->view->render('login');
    }

    public function authenticate()
    {    
        if($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            //get the submitted username and password
            $username = $_POST["username"];
            $password = $_POST["password"];

             
            $logs = $this->model->getLogs();

            for ($i=0; $i < sizeof($logs) ; $i++) 
            {   
                if($logs[$i]->username == $username && $logs[$i]->password == $password)     //hash
                {
                    $_SESSION["loggedin"] = true;
                    Router::redirect(Admin);
                }

            }

            Router::redirect(Login);
            
        }

           
    }    
}