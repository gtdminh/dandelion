<?php

class FactoryUtils
{

    public function element($param)
    {
        if (file_exists(ELEMENTS . $param . '.php'))
        {
            require_once(ELEMENTS . $param . '.php');
            $get = 'get' . $param;
            $element = new $param;
            return $element->$get();
        }
        else
            return false;
    }

    static public function elementModule($element, $module)
    {

        if (file_exists(MODULES . $module . '/views/elements/' . $element . '.php'))
        {
            $get = 'get' . $element;
            $elementController = 'Element' . ucfirst($module) . 'Controller';
            require_once MODULES . $module . '/views/elements/' . $element . '.php';
            require_once MODULES . $module . '/controllers/' . $elementController . '.php';
            $element = new $elementController;
            return $element->$get();
        }
        else
            return false;
    }

}

?>
