<?php

class Controller extends Application {
    protected $_controller;
    protected $_action;
    protected $view;

    public function __construct($controller, $action) {
        parent::__construct();
        $this->_controller = $controller;
        $this->_action = $action;
        $this->view = new View($this);
    }

    /*public function load_model($path){
        if(file_exists(ROOT . DS . 'app'. DS . 'models' . DS . $path . '.php')){
            include(ROOT . DS . 'app'. DS . 'models' . DS . $path . '.php');
        }

    }*/
    function load_model($model_name) {
        // Build the path to the model file
        $model_file_path = ROOT . DS . 'app'. DS . 'models' . DS . $model_name . '.php';
    
        // Check if the model file exists
        if (file_exists($model_file_path)) {
            // If it does, include the file
            include_once $model_file_path;
    
            // Instantiate the model object and return it
            $model_class_name = ucfirst($model_name);
            return new $model_class_name();
        } else {
            // If the model file doesn't exist, throw an exception
            throw new Exception("Model file $model_file_path not found");
        }
    }

    
}