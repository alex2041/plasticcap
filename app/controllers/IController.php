<?php

class IController {
    public function render($file, $array) {

        foreach ($array as $k => $v){
            $$k = $v;
        }
        
        ob_start();
        include_once($file);
        return ob_get_clean();
    }
}