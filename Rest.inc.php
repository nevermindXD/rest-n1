<?php
	//en caso de json en vez de jsonp habría que habilitar CORS:
    //header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");  
	header('Access-Control-Allow-Credentials: true');  
    header('Access-Control-Max-Age: 86400');  
	header('Access-Control-Allow-Origin: *');   //borrar
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");  
  //  header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");  
      

	class REST {
		
		public $_allow = array();
		public $_content_type = "application/json";
		public $_request = array();
		
		private $_method = "";		
		private $_code = 200;
		
		public function __construct(){
			$this->inputs();
		}
		
		public function get_referer(){
			return $_SERVER['HTTP_REFERER'];
		}
		
		public function response($data,$status){
			$this->_code = ($status)?$status:200;
			$this->set_headers();
			echo $data;
			exit;
		}
		// For a list of http codes checkout http://en.wikipedia.org/wiki/List_of_HTTP_status_codes
		private function get_status_message(){
			$status = array(
						200 => 'OK',  
					    201 => 'Created',  
					    202 => 'Accepted',  
					    204 => 'No Content',  
					    301 => 'Moved Permanently',  
					    302 => 'Found',  
					    303 => 'See Other',  
					    304 => 'Not Modified',  
					    400 => 'Bad Request',  
					    401 => 'Unauthorized',  
					    403 => 'Forbidden',  
					    404 => 'Not Found',  
					    405 => 'Method Not Allowed',  
					    500 => 'Internal Server Error');
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
				case "DELETE":
					$this->_request = $this->cleanInputs($_GET);
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
?>