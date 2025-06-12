<?php
    require_once '../model/funcoesCliente.php';

    $input = json_decode(file_get_contents('php://input'), true);

    // Valida se todos os campos obrigatórios estão presentes
    if (
        !isset($input['idCliente']) || !isset($input['nome']) || !isset($input['email']) || !isset($input['telefone'])
    ) {
        responder(400, ['Alguma informação não foi enviada corretamente.']);
    }

    // Tenta alterar e responde de acordo com o sucesso
    if ($alterar($input) > 0) {
        responder(200, ['Registro alterado com sucesso!']);
    } else {
        responder(200, ['Nenhum registro foi alterado.']);
    }
?>