<?php

    class LoginController extends Controller 
    {
        private $model;   

        public function __construct($controller, $action)
        {
            parent::__construct($controller, $action);
            $this->model = $this->load_model('LoginModel');
            $this->view = new LoginView($this);
            $this->view->setLayout('default');

            
        }

        public function indexAction() //nom_de_la_method+Action
        {
            $this->view->render();
        }

        public function authenticate()
        {    
            if($_SERVER["REQUEST_METHOD"] == "POST") 
            {
                //get the submitted username and password
                $username = $_POST["username"];
                $password = $_POST["password"];
                
                $trouv = 0;
                $_SESSION['log-in_error'] = '';
                // Validate the input data
                if (empty($username) || empty($password)) {
                    $_SESSION['log-in_error'] = "Please enter both username and password.";
                } else {
                    $logs = $this->model->getLogs();

                    for ($i=0; $i < sizeof($logs) ; $i++) 
                    {   
                        if($logs[$i]->username == $username && $logs[$i]->password == $password)     //hash
                        {
                            $_SESSION["loggedin"] = true;
                            $trouv = 1;
                            Router::redirect(Admin);
                        }

                    }

                    if ($trouv == 0) {
                        $_SESSION['log-in_error'] = "Wrong username or password.";
                    }
                }   
            }   
        }    
    }
?>