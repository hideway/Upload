<?php

namespace Core;

class Application
{

    protected static $_instance;

    protected $_controller = 'HomeController';
    protected $_action = 'index';
    protected $_parmas = null;

    public static function getInstance()
    {
        if(is_null(self::$_instance)){
            self::$_instance = new Application();
        }
        return self::$_instance;
    }

    public function load()
    {

        if(isset($_GET['url']))
        {
            $url_browser = explode('%2F', urlencode(trim(filter_var($_GET['url'], FILTER_SANITIZE_URL), '/')));

            $this->_controller = $url_browser[0]; // Controller

            if(isset($url_browser[1]))
            {
                $this->_action = $url_browser[1]; // Action

                if(isset($url_browser[2]))
                {
                    $this->_parmas = $url_browser; // Params
                }

            }
            unset($url_browser);
        }

    }

}