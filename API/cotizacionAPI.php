<?php
class cotizacionAPI {    
    public function API(){
        header('Content-Type: application/JSON');                
        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method) {
        case 'GET'://consulta
            echo 'GET';
            break;     
        case 'POST'://inserta
            echo 'POST';
            break;                
        case 'PUT'://actualiza
            echo 'PUT';
            break;      
        case 'DELETE'://elimina
            echo 'DELETE';
            break;
        default://metodo NO soportado
            echo 'METODO NO SOPORTADO';
            break;
        }
    }
    
}
?>