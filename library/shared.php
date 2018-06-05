<?php

/** Main Call Function **/

function callHook() {
	global $url;

	$urlArray = array();
	$urlArray = explode("/",$url);
		
	if (!in_array("index", $urlArray))
	    {
		$urlArray[2] = $urlArray[1];
		$urlArray[1] = "index";
		
	    }
	    
	$controller = $urlArray[0];
	array_shift($urlArray);
	
	if (preg_match("/\d+$/", $urlArray[0], $matches)) {
	    $urlArray[0] = "index";
	}
	
	$action = $urlArray[0] == ''?"index":$urlArray[0];
	
	array_shift($urlArray);
	
	$queryString = $urlArray;

	$controllerName = $controller;
	$controller = ucwords($controller);
	$model = rtrim($controller, 's');
	$controller .= 'Controller';
	
	$dispatch = new $controller($model,$controllerName,$action);

	if ((int)method_exists($controller, $action)) {
		call_user_func_array(array($dispatch,$action),$queryString);
	} else {
		/* Error Generation Code Here */
	}
}

/** Autoload any classes that are required **/

function __autoload($className) {
	if (file_exists(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php')) {
		require_once(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php');
	} else if (file_exists(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php')) {
		require_once(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php');
	} else if (file_exists(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php')) {
		require_once(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php');
	} else {
		/* Error Generation Code Here */
	}
}

//setReporting();
//removeMagicQuotes();
//unregisterGlobals();
callHook();
