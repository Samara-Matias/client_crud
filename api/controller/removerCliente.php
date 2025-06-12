<?php
    require_once '../model/funcoesCliente.php';

    $input = json_decode(file_get_contents('php://input'), true);

    // Valida se o ID foi enviado corretamente
    if (!isset($input['idCliente']) || $input['idCliente'] === '') {
        responder(400, ['Alguma informação não foi enviada corretamente.']);
    }

    // Tenta remover e responde de acordo
    if ($remover((int) $input['idCliente']) > 0) {
        responder(204);
    } else {
        responder(400, ['Nenhum registro foi removido.']);
    }
?>