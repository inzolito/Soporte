<?php

class systemClass
{

    function conectaDB()
    {
        $mysqli = @new mysqli('localhost', 'root', '', 'checksupport');

        if ($mysqli->connect_error) {
            die('Error de conexión: ' . $mysqli->connect_error);
        }
        return $mysqli;
    }
    
    function urlSystem()
    {
        return "http://localhost/soporte";
    }

    
    function validarSesion()
    {
        $conn= new systemClass();
        $conn->conectaDB();
        session_start();
        if ($_SESSION["user"]== false) {
            echo '<meta http-equiv="refresh" content="0; url='.$conn->urlSystem().'/pages/login/login.php">';
        }
    }

    function formatoFecha($fecha,$tipoFecha)
    {
        if($tipoFecha=="DB" || $fecha=="BD")
        {
            return date("Y-m-d", strtotime($fecha));

        }
        if($tipoFecha=="vista")
        {
            return date("d-m-Y", strtotime($fecha));

        }
        if($tipoFecha=="vistaDT")
        {
            return date("d-m-Y , H:i", strtotime($fecha));

        }
        if($tipoFecha=="lectura")
        {
           // setlocale(LC_TIME, "spanish");
          //  return date("l d  F  Y", strtotime($fecha));
         // return strftime("%A, %d de %B de %Y", strtotime($fecha));
         $dias = array("domingo","lunes","martes","miércoles","jueves","viernes","sábado");
         $meses = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
        
         return $dias[date('w', strtotime($fecha))] . " " . date('d', strtotime($fecha)) . " de " . $meses[date('n', strtotime($fecha))-1] . " del " . date('Y', strtotime($fecha));
      
        }
    }
}
 
 
