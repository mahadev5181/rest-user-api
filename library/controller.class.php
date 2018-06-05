<?php
class Controller {

	protected $_model;
	protected $_controller;
	protected $_action;
	protected $_template;
	
	public $_allow = array();
	public $_content_type = "application/json";
	public $_request = array();
	private $_method = "";
	private $_code = 200;

	function __construct($model, $controller, $action) {
	  
		$this->inputs();
		$this->_controller = $controller;
		$this->_action = $action == ''?"index":$action;
		$this->_model = $model;
		
		$this->$model = new $model;

	}

	public function get_referer(){
		return $_SERVER['HTTP_REFERER'];
	}
		
	public function response($data,$status){ print_r($data);exit;
		$this->_code = ($status)?$status:200;
		$this->set_headers();
		echo $data;
		exit;
	}
	/*
		Function : json
		Purpose : to encode the data to json string
		Return : encoded json string
	*/
	protected function json($data,$message,$statusCode,$status)
	{
		if(is_array($data)){
			$response = array();
			$response['status'] = $status;
			$response['statusCode'] = $statusCode;
			$response['message'] = $message;
			$response['result'] = $data;

			return json_encode($response);
		}
	}
		private function get_status_message(){
			$status = array( 
						200 => 'OK',  
						307 => 'Temporary Redirect',  
						400 => 'Bad Request',  
						404 => 'Not Found', 
						500 => 'Internal Server Error',
						502 => 'Bad Gateway',    
						504 => 'Gateway Timeout');
			return ($status[$this->_code])?$status[$this->_code]:$status[500];
		}
		
		public function get_request_method(){
			return $_SERVER['REQUEST_METHOD'];
		}
		
		private function inputs(){
		   
			switch($this->get_request_method()){
				case "POST":
					$this->_request = $this->cleanInputs($_POST);
					break;
				case "GET":
				   
					$this->_request = $this->cleanInputs($_GET);
					break;
				case "DELETE":
					parse_str(file_get_contents("php://input"),$this->_request); 
					$this->_request = $this->cleanInputs($this->_request);
					break;
				case "PUT":
				   
					parse_str(file_get_contents("php://input"),$this->_request); 
					$this->_request = $this->cleanInputs($this->_request);
					break;
				default:
					$this->response('',406);
					break;
			}
		}		
		
		private function cleanInputs($data){
			$clean_input = array();
			if(is_array($data)){
				foreach($data as $k => $v){
					$clean_input[$k] = $this->cleanInputs($v);
				}
			}else{
				if(get_magic_quotes_gpc()){
					$data = trim(stripslashes($data));
				}
				$data = strip_tags($data);
				$clean_input = trim($data);
			}
			
			return $clean_input;
		}		
		
		private function set_headers(){
			header("HTTP/1.1 ".$this->_code." ".$this->get_status_message());
			header("Content-Type:".$this->_content_type);
		}

}
