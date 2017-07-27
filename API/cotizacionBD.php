<?php
/** 
 * @web http://www.jc-mouse.net/
 * @author jc mouse
 */
class PeopleDB {
    
    protected $mysqli;
    const LOCALHOST = 'localhost';
    const USER = 'root';
    const PASSWORD = '';
    const DATABASE = 'wordpress';
    
    /**
     * Constructor de clase
     */
    public function __construct() {           
        try{
            //conexión a base de datos
            $this->mysqli = new mysqli(self::LOCALHOST, self::USER, self::PASSWORD, self::DATABASE);
        }catch (mysqli_sql_exception $e){
            //Si no se puede realizar la conexión
            http_response_code(500);
            exit;
        }     
    } 
    
    /**
     * obtiene un solo registro dado su ID
     * @param int $id identificador unico de registro
     * @return Array array con los registros obtenidos de la base de datos
     */
    public function getCotizacion($id_cotizacion=0){      
        $stmt = $this->mysqli->prepare("SELECT * FROM cotizacion WHERE id_cotizacion=? ; ");
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();        
        $cotizacion = $result->fetch_all(MYSQLI_ASSOC); 
        $stmt->close();
        return $cotizacion;              
    }
    
    /**
     * obtiene todos los registros de la tabla "people"
     * @return Array array con los registros obtenidos de la base de datos
     */
    public function getCotizacion(){        
        $result = $this->mysqli->query('SELECT * FROM cotizacion');          
        $cotizacion = $result->fetch_all(MYSQLI_ASSOC);          
        $result->close();
        return $cotizacion; 
    }
    
    /**
     * añade un nuevo registro en la tabla persona
     * @param String $name nombre completo de persona
     * @return bool TRUE|FALSE 
     */
    public function insert($nombre='', $marca='', $modelo='',$pFactura='',$email='',$img='',$rutaImg=''){
        $stmt = $this->mysqli->prepare("INSERT INTO cotizacion(nombre,marca,modelo,precioFactura,email,img,rutaImg) VALUES (?, ? ,?, ?, ?, ?, ? ); ");
        $stmt->bind_param('s', $name);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;        
    }
    
    /**
     * elimina un registro dado el ID
     * @param int $id Identificador unico de registro
     * @return Bool TRUE|FALSE
     */
    public function delete($id_cotizacion=0) {
        $stmt = $this->mysqli->prepare("DELETE FROM cotizacion WHERE id_cotizacion = ? ; ");
        $stmt->bind_param('s', $id);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;
    }
    
    /**
     * Actualiza registro dado su ID
     * @param int $id Description
     */
    public function update($id, $newName) {
        if($this->checkID($id)){
            $stmt = $this->mysqli->prepare("UPDATE people SET name=? WHERE id = ? ; ");
            $stmt->bind_param('ss', $newName,$id);
            $r = $stmt->execute(); 
            $stmt->close();
            return $r;    
        }
        return false;
    }
    
    /**
     * verifica si un ID existe
     * @param int $id Identificador unico de registro
     * @return Bool TRUE|FALSE
     */
    public function checkID($id){
        $stmt = $this->mysqli->prepare("SELECT * FROM people WHERE ID=?");
        $stmt->bind_param("s", $id);
        if($stmt->execute()){
            $stmt->store_result();    
            if ($stmt->num_rows == 1){                
                return true;
            }
        }        
        return false;
    }
    
}
?>