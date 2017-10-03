<?php
	include 'conexion.php';
	include 'index.php';

	$nombreCliente = $_REQUEST["nombreCliente"];
	$folio = $_REQUEST["folio"];
	$prendas_select = $_REQUEST["prendas_select"];
	$dificultad = $_REQUEST["dificultad_select"];

	$operador = $_REQUEST["operador_select"];
	$urgencia = $_REQUEST["urgencia_select"];
	$tiempo_estimado = $_REQUEST["tiempoEstimado"];
	$comentario = $_REQUEST["comentario"];


?>