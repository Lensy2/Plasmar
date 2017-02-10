<?php
  abstract class Conexion {
      
      public function conectar(){
         $mysqli = new mysqli('localhost','admingestor','admingestor2017','gestorproductos',3306);
         
         if ($mysqli->connect_errno)
            header('Location: offline.html');

        $mysqli->set_charset('utf8');
         
         return $mysqli;
      }
      
   }
?>