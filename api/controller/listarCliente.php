<?php
	require_once "../model/funcoesCliente.php";

	$registros = $listar();
	responder(200, $registros);
?>