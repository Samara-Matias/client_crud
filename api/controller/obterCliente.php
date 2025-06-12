<?php
    require_once '../model/funcoesCliente.php';

    $input = $_GET;

    // Verifica se o ID foi enviado corretamente
    if (!isset($input['idCliente']) || $input['idCliente'] === '') {
        responder(400, ['Alguma informação não foi enviada.']);
    }

    // Busca o cliente pelo ID
    $registro = $obter((int) $input['idCliente']);
    responder(200, $registro);
?>