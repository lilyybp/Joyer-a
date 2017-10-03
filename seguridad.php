<?php
	//Reanudamos la sesión 
	session_start(); 
	//Validamos si existe realmente una sesión activa o no 
	if($_SESSION["logueado"] != true){	 
	  	//Si no hay sesión activa, lo direccionamos al inicio.php (inicio de sesión) 
	  	header("Location: inicio.php"); 
	  	exit(); 
	}


?>