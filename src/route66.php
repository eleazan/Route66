<?php

class Route66 {
    const DEFAULT_REGEX = "@((?<!/)/[^/?#]+)|/@";
    private $_vars = array();

    public function parse($route) {
        if (!preg_match_all(
            self::DEFAULT_REGEX, $route, $matches
        )) {
            return $route;
        }
        
        $routeData = array();
        foreach($matches[0] as $match) {
            $routeData[] = array(
                    "type" => ($this->isVariable($match) ? "var" : "cons" ),
                    "value" => $match);
        }
        
        return $routeData;
    }
    function isVariable($match) {
        return preg_match('|^/{.*}|', $match);
    }

    function get($pattern, $function) {
       $this->resolve($pattern, $function, "get");
    }
    
    function post($pattern, $function) {
       $this->resolve($pattern, $function, "post");
    }
    
    function put($pattern, $function) {
       $this->resolve($pattern, $function, "put");
    }
    
    function delete($pattern, $function) {
       $this->resolve($pattern, $function, "delete");
    }
    
    function resolve($pattern, $function, $method) {
       if(!$this->isMethod($method)) return false;
       $parsed_route = $this->parse($pattern);
       $URI = $_SERVER['REQUEST_URI'];

       if($this->checkRoute($parsed_route)) {
           call_user_func_array($function, $this->_vars);
       }
        
    }
    function checkRoute($routeData){
         $URI = $_SERVER['REQUEST_URI'];
         $URIParsed = $this->parse($URI);
         
         if(count($URIParsed) != count($routeData)) return false;
         $vars = array();
         for($i = 0; $i < count($URIParsed); $i++) {
             if($routeData[$i]["type"] == "cons" && $routeData[$i]["value"] != $URIParsed[$i]["value"]) return false;
             if($routeData[$i]["type"] == "var") {
                 $vars[] = substr($URIParsed[$i]["value"],1);
             }
         }
         $this->_vars = $vars;
         return true;
    }
    
    function isMethod($method) {
        return (strtoupper($_SERVER['REQUEST_METHOD']) == strtoupper($method)) || (strtoupper($_SERVER['REQUEST_METHOD']) == "POST" && strtoupper($_POST['_mehtod']) == strtoupper($method) );
    }
    
}
