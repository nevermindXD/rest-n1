<?php
 	require_once("../Rest.inc.php");
	require ("../config.php");
	class API extends REST {
	
		public $data = "";
		public $mainUrl = MAIN_URL;
		
		const DB_SERVER = DB_HOST;
		const DB_USER = DB_USR;
		const DB_PASSWORD = DB_PASS;
		const DB = DB_DATABASE;

		private $db = NULL;
		private $mysqli = NULL;
		private $tableName = NULL;
		private $tableColumns = NULL;
		private $tableID = NULL;

		public function __construct(){
			parent::__construct();				// Init parent contructor
			$this->dbConnect();					// Initiate Database connection
			$this->tableName 	= "cotizacion";
			$this->tableColumns = array('id_cotizacion', 'nombre', 'marca', 'modelo', 'precioFactura', 'email', 'img', 'rutaImg');
			$this->tableID 		= "id_cotizacion";
		}
		
		/*
		 *  Connect to Database
		*/
		private function dbConnect(){
			$this->mysqli = new mysqli(self::DB_SERVER, self::DB_USER, self::DB_PASSWORD, self::DB);
			$this->mysqli->set_charset("utf8"); //Muy importante!!
		}
		
		/*
		 * Dynmically call the method based on the query string
		 */
		public function processApi(){
			//SECURITY IMPLEMENT
			$func = strtolower(trim(str_replace("/","",$_REQUEST['x'])));
			if((int)method_exists($this,$func) > 0)
				$this->$func();
			else
				$this->response('',404); // If the method not exist with in this class "Page not found".
		}
						
		private function get(){	
			if($this->get_request_method() != "GET"){
				$this->response('',406);
			}
			
			$id = (!isset($this->_request['id'])) ? 0 : (int)$this->_request['id'];

			if($id > 0){	//ONLY ONE
				$result = array();
				$query="SELECT * FROM ".$this->tableName." where ".$this->tableID." =$id";
				$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
				if($r->num_rows > 0) {
					$result = array();
					while($row = $r->fetch_assoc()){
						$result[] = $row;
					}
					$this->response($this->json($result), 200); // send user details
				}
			}
			else{			//ALL ELEMENTS

				$query="SELECT * FROM ".$this->tableName;
				$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);

				if($r->num_rows > 0){
					$result = array();
					while($row = $r->fetch_assoc()){
						$result[] = $row;
					}
					$this->response($this->json($result), 200); // send user details
				}
			}
			$this->response('',204);	// If no records "No Content" status
		}


		private function insert(){
			if($this->get_request_method() != "POST"){
				$this->response('',406);
			}

			$recordObject = json_decode(file_get_contents("php://input"),true);
			$column_names = $this->tableColumns;

			$keys = array_keys($recordObject);
			$columns = '';
			$values = '';
			foreach($column_names as $desired_key){ // Check the recordObject received. If blank insert blank into the array.
			   if(!in_array($desired_key, $keys)) {
			   		$$desired_key = '';
				}else{
					$$desired_key = $recordObject[$desired_key];
				}
				$columns = $columns.$desired_key.',';
				$values = $values."'".$$desired_key."',";
			}
			$query = "INSERT INTO ".$this->tableName." (".trim($columns,',').") VALUES(".trim($values,',').")";
			// echo $query;
			if(!empty($recordObject)){
				$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);

				$recordObject[$this->tableID]= $this->mysqli->insert_id;
				$success = array('status' => "Success", "msg" => "Record Created Successfully.", "id" => $this->mysqli->insert_id, "data" => $recordObject);
				$this->response($this->json($success),200);
			}else
				$this->response('Not Content',204);	//"No Content" status
		}

		private function update(){
			if($this->get_request_method() != "POST"){
				$this->response('',406);
			}

			$column_names = $this->tableColumns;
			$recordObject = json_decode(file_get_contents("php://input"),true);
			$keys = array_keys($recordObject);
			
			$id = (int)$_REQUEST['id'];
			$columns = '';
			$values = '';
			foreach($column_names as $desired_key){ // Check the recordObject received. If key does not exist, insert blank into the array.
			   if(!in_array($desired_key, $keys)) {
			   		$$desired_key = '';
				}else{
					$$desired_key = $recordObject[$desired_key];
					$columns = $columns.$desired_key."='".$$desired_key."',";
				}
			}
			$query = "UPDATE ".$this->tableName." SET ".trim($columns,',')." WHERE ".$this->tableID." =$id";
			if(!empty($recordObject)){
				$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
				$success = array('status' => "Success", "msg" => "Record ".$id." Updated Successfully.", "data" => $recordObject);
				$this->response($this->json($success),200);
			}else
				$this->response('Not Content',204);	// "No Content" status
		}
		
	
		private function delete(){
			if($this->get_request_method() != "GET"){
				$this->response('',406);
			}
			$id = (int)$this->_request['id'];
			if($id > 0){				
				$query="DELETE FROM ".$this->tableName." WHERE ".$this->tableID." = $id";
				$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
				$success = array('status' => "Success", "msg" => "Successfully deleted record # ".$id);
				$this->response($this->json($success),200);
			}else
				$this->response('',204);	// If no records "No Content" status
		}
		
		/*
		 *	Encode array into JSON
		*/
		private function json($data){
			if(is_array($data)){
				return json_encode($data, JSON_PRETTY_PRINT);
			}
		}
	}
	
	// Initiiate Library
	$api = new API;
	$api->processApi();
?>
